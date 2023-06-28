$(document).ready(
    function() {  
        getDistrictLocal();
		getSchoolGrade();
		getActivities();

		var f_ine = vuri + "/img/credencial/frente.jpg";
        var r_ine = vuri + "/img/credencial/reverso.png";
        $('#dvImgOutFrente').css("background-image", "url(" + f_ine + ")" ); 
        $('#dvImgWrapFrente').css("background-image", "url(" + f_ine + ")" );

        $('#dvImgOutReverso').css("background-image", "url(" + r_ine + ")" ); 
        $('#dvImgWrapReverso').css("background-image", "url(" + r_ine + ")" );

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

		$('.btn-create-promotor').attr('onclick', 'confirmarStore()');
	}
);

function confirmarStore()
 {
    /**
     * Muestra mensaje de confirmación para guardar un promotor
     * 23 de Junio de 2023
     * */

    Swal.fire({
        title: "Esta seguro de agregar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {         
            store();  
        }
        else if (result.dismiss === "cancel") {
            Swal.fire("Cancelado", "El usuario cancelo la acción.", "error")
        }
    });      
}

function store()
 {
    /**
     * Manda a llamar la URI promotor para registrar los datos
     * 23 de Junio de 2023
     * */

    var vformularioFile=document.getElementById("frmPromotor");
    var vformData = new FormData(vformularioFile);
    if ( validaForm('frmPromotor') ) {
        $.ajax({
            type: 'POST',
            url: vuri + '/promotores',
            data: vformData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(vresponse, vtextStatus, vjqXHR) {

                if( vresponse.codigo == 1 )
                {
                    Swal.fire({
                        icon: vresponse.icono,
                        title: 'promotores',                
                        text: vresponse.mensaje,
                        showConfirmButton: false,
                        timer: 2800
                    });

                    setTimeout(
                        function () {
                            window.location = vuri + '/promotores';
                        },
                        1500
                    );
                } 
                else
                {
                    Swal.fire({
                        icon: vresponse.icono,
                        title: 'promotores',                
                        text: vresponse.mensaje,
                        showConfirmButton: false,
                        timer: 2800
                    });
                }               

            },
            error: function(vjqXHR, vtextStatus, verrorThrown) { 
                
            }
        });
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
            $('#district_id').attr('onChange', 'onChangeDtto()');

            if (vdataSelect != 0 )
                $('#district_id').val(vdataSelect).trigger('change');
        },
        error: function(json) { }
    });
 }

function onChangeDtto()
 {
    var id=$("#district_id").val();
    if ( id != "" ) {      
        $('#coordinator_id').empty();
        $('#dvCoordinator').hide();       
        $('#dvMunicipality').show();
        getMunicipality(0, id);
    }
    else {
        $('#municipality_id').empty();        
        $('#dvMunicipality').hide();       
        $('#coordinator_id').empty();
        $('#dvCoordinator').hide();
    }
 }

function getMunicipality(selectOpt=0, dtto_loc)
 {      
    $.ajax({
        type: "GET",
        url: vuri + '/type/municipality',
        data: {
            method: 'get',
            dtto_loc: dtto_loc
        },
        success: function(json) {
            var html ='';
                html+='<option value="">--- Municipio ---</option>';
            for ( var i=0; i<json.respuesta.length; i++ ) {
                html+='<option value='+json.respuesta[i].municipality_key+'>'+json.respuesta[i].municipality+'</option>';
            }
            $('#municipality_id').html(html);
            $('#municipality_id').attr('onChange', 'onChangeMpio('+ dtto_loc +')');
            
            if (selectOpt != 0 ) {                
                $('#municipality_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangeMpio(dtto_loc)
 {
    var id=$("#municipality_id").val();
    if ( id != "" ) {
        $('#dvCoordinator').show();        
        getCoordinators(0, dtto_loc, id);
    }
    else {
        $('#coordinator_id').empty();
        $('#dvCoordinator').hide();       
    }
 }

function getCoordinators(selectOpt=0, dtto_loc=0, mpio)
 {      
    $.ajax({
        type: "GET",
        url: vuri + '/type/municipality-coordinator',
        data: {
            method: 'get',
            municipality: mpio,
            local_district: dtto_loc
        },
        success: function(json) {
            var html ='';
                html+='<option value="">--- Coordinador ---</option>';
            for ( var i=0; i<json.respuesta.length; i++ ) {
                html+='<option value='+json.respuesta[i].id+'>'+json.respuesta[i].coordinator+'</option>';
            }
            $('#coordinator_id').html(html);
           
            if (selectOpt != 0 ) {                
                $('#coordinator_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }