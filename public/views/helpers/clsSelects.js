function getSchoolGrade(vdataSelect=0)
 {
    $.ajax({
        type: "GET",
        url: vuri + '/type/school-grade',
        data: {
          method: 'get'
        },
        success: function(response) {
            var html ='';
                html+='<option value="">--- Estudios ---</option>';
            for ( var i=0; i<response.respuesta.length; i++ ) {
                html+='<option value='+response.respuesta[i].id+'>'+response.respuesta[i].description+'</option>';
            }
            $('#school_grade_id').html(html);

            if (vdataSelect != 0 )
                $('#school_grade_id').val(vdataSelect).trigger('change');
        },
        error: function(json) { }
    });
 }

function getDistrictLocalMunicipality(vdataSelect=0)
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
            $('#district_id').attr('onChange', 'onChangeMunicipioDtto()');

            if (vdataSelect != 0 )
                $('#district_id').val(vdataSelect).trigger('change');
        },
        error: function(json) { }
    });
 }

function onChangeMunicipioDtto()
 {
    var id=$("#district_id").val();
    if ( id != "" ) {
        $('#coordinator_id').empty();
        $('#dvCoordinators').hide();
        $('#dvMunicipality').show();
        getMunicipality_Dtto(0, id);
    }
    else {
        $('#municipality_id').empty();        
        $('#dvMunicipality').hide();
        $('#coordinator_id').empty();
        $('#dvCoordinators').hide();
    }
 }


function getMunicipality_Dtto(selectOpt=0, dtto_loc)
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
                html+='<option value='+json.respuesta[i].id+'>'+json.respuesta[i].municipality+'</option>';
            }
            $('#municipality_id').html(html);
            $('#municipality_id').attr('onChange', 'onChangeCoordinatorsMpio()');
            
            if (selectOpt != 0 ) {                
                $('#municipality_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangeCoordinatorsMpio()
 {
    var id=$("#municipality_id").val();
    if ( id != "" ) {
        $('#dvCoordinators').show();
        getCoordinatorsMpio(0, id);
    }
    else {
        $('#coordinator_id').empty();
        $('#dvCoordinators').hide();
    }
 }

function getCoordinatorsMpio(selectOpt=0, mpio)
 {      
    $.ajax({
        type: "GET",
        url: vuri + '/type/coordinators',
        data: {
            method: 'get',
            municipality: mpio
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