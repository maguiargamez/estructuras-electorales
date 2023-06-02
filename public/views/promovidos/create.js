$(document).ready(
    function() {
    	getDistrictLocalMunicipality();
		getSchoolGrade();


		var f_ine = vuri + "/img/credencial/frente.jpg";
        var r_ine = vuri + "/img/credencial/reverso.png";
        $('#dvImgOutFrente').css("background-image", "url(" + f_ine + ")" ); 
        $('#dvImgWrapFrente').css("background-image", "url(" + f_ine + ")" );

        $('#dvImgOutReverso').css("background-image", "url(" + r_ine + ")" ); 
        $('#dvImgWrapReverso').css("background-image", "url(" + r_ine + ")" );

        $('#red_social').on('change', function() {
		  if( this.value == 1 )
		  	$('#dvRedesSociales').show();
		  else
		  	$('#dvRedesSociales').hide();
		});

		$('input[name="afiliacion"]').on('change', function(e) {
		    var value = e.target.value;
		    if(value == 1 ) $('#dvOrganizacion').show(); else $('#dvOrganizacion').hide();
		});
	}
);