$(document).ready(
    function() {
        loadData();

        $('.btn-edit-coordinador-dtto').attr('onclick', 'confirmUpdate("frmCoordinadorDtto")');
        $('#has_social_networks').on('change', function() {
          if( this.value == 1 )
            $('#dvRedesSociales').show();
          else{
                $('#facebook').val('');
                $('#instagram').val('');
                $('#twitter').val('');
                $('#tiktok').val('');
                $('#dvRedesSociales').hide();
            }
        });
    }
);

function loadData()
 {
    /**
     * 28 de Junio 2023
     * Cargar los datos del coordinador distrital seleccionado.
     * */

    vidCoordinator=$('#idCoordinator').val();
    $.ajax({
        type: 'GET',
        url: vuri + '/coordinador-distrital/get-datos',
        dataType: "JSON",
        data: {
            method: 'show',
            id_coordinador: vidCoordinator
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;

            if ( parseInt(vresponse.codigo) == 1 ) {

                $.each(vresponse.respuesta, function ( key, data ) {        
                    if ( data != null || data != '' ) {  
                        switch ( key ) {
                            case 'sex':               
                                $('#' + key).val(data).trigger('change');                               
                              break;  
                            case 'has_social_networks':
                                if(data == 1)
                                    $('#dvRedesSociales').show();
                                $('#' + key).val(data).trigger('change');                               
                              break; 
                            case 'membership': 
                                if(data == 1)                                
                                    $("#rdSi").prop("checked", true);
                                else
                                    $("#rdNo").prop("checked", true);
                              break;
                            case 'political_organization': 
                                if(data == 1)                                
                                    $("#rdSiOrg").prop("checked", true);
                                else
                                    $("#rdNoOrg").prop("checked", true);
                              break;                            
                            case 'birth_date':
                                $('#' + key).val(format(data));
                                $('#' + key).flatpickr({dateFormat: "d/m/Y"});
                              break;
                            case 'school_grade_id':
                                getSchoolGrade(data);
                              break;
                            case 'activity_id':
                                getActivities(data);
                              break;
                            case 'district_id':
                                getDistrictLocal(data);
                              break;
                            default:
                                $('#' + key).val(data);
                              break;                              
                        }                                              
                    }
                });

                load_ine(vrespuesta.credential_front, vrespuesta.credential_back);

            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });   
 }

function load_ine(frente, reverso)
 {
    /**
     * 28 de Junio de 2023
     * Cargar las imagenes de las credencial, si en dado caso existieran.
     * */

    if ( frente != null && reverso != null ) {
        var f_ine = vuri_ine + '/' + frente;
        var r_ine = vuri_ine + '/' + reverso;

        $('#dvImgOutFrente').css("background-image", "url(" + f_ine + ")" ); 
        $('#dvImgWrapFrente').css("background-image", "url(" + f_ine + ")" );

        $('#dvImgOutReverso').css("background-image", "url(" + r_ine + ")" ); 
        $('#dvImgWrapReverso').css("background-image", "url(" + r_ine + ")" );   
    }
    else {
        var f_ine = vuri + "/img/credencial/frente.jpg";
        var r_ine = vuri + "/img/credencial/reverso.png";
        $('#dvImgOutFrente').css("background-image", "url(" + f_ine + ")" ); 
        $('#dvImgWrapFrente').css("background-image", "url(" + f_ine + ")" );

        $('#dvImgOutReverso').css("background-image", "url(" + r_ine + ")" ); 
        $('#dvImgWrapReverso').css("background-image", "url(" + r_ine + ")" );
    }  
 }

function getDistrictLocal(vdataSelect=0)
 {
    $.ajax({
        type: "GET",
        url: vuri + '/type/district',
        data: {
          method: 'get'
        },
        success: function(response) {
            var html ='';
                html+='<option value="">--- Distrito ---</option>';
            for ( var i=0; i<response.respuesta.length; i++ ) {
                html+='<option>'+response.respuesta[i].dtto_loc+'</option>';
            }
            $('#district_id').html(html);            
            
            if (vdataSelect != 0 )
                $('#district_id').val(vdataSelect).trigger('change');
        },
        error: function(json) { }
    });
 }

function confirmUpdate(idFormulario)
 {
    Swal.fire({
        title: "Esta seguro de actualizar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            update(idFormulario);
        }
        else if (result.dismiss === "cancel") {
            Swal.fire("Cancelado", "El usuario cancelo la acción.", "error")
        }
    });  
 }


function update(idFormulario)
 {
    var vformularioFile=document.getElementById(idFormulario);
    var vformData = new FormData(vformularioFile);
    if ( validaForm(idFormulario) ) {
        $.ajax({
            type: "POST",
            url: vuri + '/coordinador-distrital/update',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: vformData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(".btn-edit-coordinador-dtto").prop('disabled', true);
            },
            success: function(vresponse, vtextStatus, vjqXHR) {  
                
                Swal.fire({
                    icon: vresponse.icono,
                    title: 'Notificación',
                    text: vresponse.mensaje,
                    showConfirmButton: false,
                    timer: 1500                      
                }); 

                if ( vresponse.codigo == 1 ) {
                    setTimeout(
                        function () {
                            window.location = vuri + '/coordinador-distrital';
                        },
                        1500
                    );
                }

                if ( vresponse.codigo == 0 )
                    $(".btn-edit-coordinador-dtto").prop('disabled', false);
                               
            },
            error: function(vjqXHR, vtextStatus, verrorThrown) {
                var jsonString= vjqXHR.responseJSON;        
                $(".btn-edit-coordinador-dtto").prop('disabled', false);                
            },
            complete: function() {}
        });
    }
 }