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

		$('.btn-create-coordinador-dtto').attr('onclick', 'confirmarStore()');
	}
);

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

function confirmarStore()
 {
    /**
     * Muestra mensaje de confirmación para guardar un coordinador distrital
     * 28 de Junio de 2023
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
     * 28 de Junio de 2023
     * */

    var vformularioFile=document.getElementById("frmCoordinadorDtto");
    var vformData = new FormData(vformularioFile);
    if ( validaForm('frmCoordinadorDtto') ) {
        $.ajax({
            type: 'POST',
            url: vuri + '/coordinador-distrital',
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
                        title: 'Coordinadores distritales',                
                        text: vresponse.mensaje,
                        showConfirmButton: false,
                        timer: 2800
                    });

                    setTimeout(
                        function () {
                            window.location = vuri + '/coordinador-distrital';
                        },
                        1500
                    );
                } 
                else
                {
                    Swal.fire({
                        icon: vresponse.icono,
                        title: 'Coordinadores distritales',                
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