$(document).ready(
    function() {
    	getDistrictLocalMunicipality();
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

		$('.btn-create-promovido').attr('onclick', 'confirmarStore()');
	}
);


function confirmarStore()
 {
    /**
     * Muestra mensaje de confirmación para guardar un promovido
     * 05 de Junio de 2023
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
     * Manda a llamar la URI promovidos para registrar los datos
     * 05 de Junio de 2023
     * */

    var vformularioFile=document.getElementById("frmPromovido");
    var vformData = new FormData(vformularioFile);
    if ( validaForm('frmPromovido') ) {
        $.ajax({
            type: 'POST',
            url: vuri + '/promovidos',
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
	                    title: 'promovidos',                
	                    text: vresponse.mensaje,
	                    showConfirmButton: false,
	                    timer: 2800
	                });

	                setTimeout(
	                    function () {
	                        window.location = vuri + '/promovidos';
	                    },
	                    1500
	                );
            	} 
            	else
            	{
            		Swal.fire({
	                    icon: vresponse.icono,
	                    title: 'promovidos',                
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