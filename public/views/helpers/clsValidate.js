$(document).ready(
    function() {
        keyPressValidateForm();
    }
);

function keyPressValidateForm()
 {
    $('.removeIsInvalid').keypress(function(event){
        if ($("#" + this.id).hasClass("is-invalid")) {
            $("#" + this.id).removeClass("is-invalid");
        }     
    });

    $('.removeIsInvalidSelect').change(function(){       
        if ($("#" + this.id).hasClass("is-invalid")) {
            $("#" + this.id).removeClass("is-invalid");
        }
    });
 }

function clearForm(vidFormulario)
 {
    var vformulario = document.getElementById(vidFormulario);
    for (vj = 0; vj < vformulario.elements.length; vj++) {
        if (vformulario.elements[vj].type == "text") $('#' + vformulario.elements[vj].id).val('');
        if (vformulario.elements[vj].type == "select-one") $('#' + vformulario.elements[vj].id).val(0).trigger('change');
    }
 }

function validaForm(vidFormulario)
 {
    limpiarCSS(vidFormulario);
    var vstatus = true;
    var vformulario = document.getElementById(vidFormulario);
    for (vj = 0; vj < vformulario.elements.length; vj++) {        
        if (vformulario.elements[vj].type == "text") {
            
            if ($('#' + vformulario.elements[vj].id).val() == '') {
                if (
                   
                    vformulario.elements[vj].id != 'facebook' &&                    
                    vformulario.elements[vj].id != 'instagram' && 
                    vformulario.elements[vj].id != 'twitter' && 
                    vformulario.elements[vj].id != 'tiktok'
                ) {
                    $('#' + vformulario.elements[vj].id).addClass("is-invalid");
                    if (vstatus) {
                        $('#' + vformulario.elements[vj].id).focus();
                    }
                    vstatus = false;
                }                
            }
               
        }

        if (vformulario.elements[vj].type == "textarea") {
            if ($('#' + vformulario.elements[vj].id).val() == '') {
                $('#' + vformulario.elements[vj].id).addClass("is-invalid");
                if (vstatus) {
                    $('#' + vformulario.elements[vj].id).focus();
                }
                vstatus = false;
            }
        }

        if (vformulario.elements[vj].type == "select-one") {
            if ($('#' + vformulario.elements[vj].id).val() == '') {
                $('#' + vformulario.elements[vj].id).addClass("is-invalid");
                if (vstatus) {
                    $('#' + vformulario.elements[vj].id).focus();
                }
                vstatus = false;
            }
        }       
    }
    return vstatus;
 }

function limpiarCSS(idFormulario)
 {
    var vformulario = document.getElementById(idFormulario);
    for (j = 0; j < vformulario.elements.length; j++) {
        if (vformulario.elements[j].type == "text") {
            if ($("#" + vformulario.elements[j].id).hasClass("is-invalid")) {
                $("#" + vformulario.elements[j].id).removeClass("is-invalid");
            }           
        }
        else if (vformulario.elements[j].type == "select-one") {
            if ($("#" + vformulario.elements[j].id).hasClass("is-invalid")) {
                $("#" + vformulario.elements[j].id).removeClass("is-invalid");
            }            
        }
        else if (vformulario.elements[j].type == "textarea") {
            if ($("#" + vformulario.elements[j].id).hasClass("is-invalid")) {
                $("#" + vformulario.elements[j].id).removeClass("is-invalid");
            }            
        }
    }
 }