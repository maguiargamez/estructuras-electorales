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

function getActivities(vdataSelect=0)
 {
    $.ajax({
        type: "GET",
        url: vuri + '/type/activities',
        data: {
          method: 'get'
        },
        success: function(response) {
            var html ='';
                html+='<option value="">--- Ocupacion ---</option>';
            for ( var i=0; i<response.respuesta.length; i++ ) {
                html+='<option value='+response.respuesta[i].id+'>'+response.respuesta[i].description+'</option>';
            }
            $('#activity_id').html(html);

            if (vdataSelect != 0 )
                $('#activity_id').val(vdataSelect).trigger('change');
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
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
        $('#section_id').empty();
        $('#dvSection').hide();
        $('#dvMunicipality').show();
        getMunicipality_Dtto(0, id);
    }
    else {
        $('#municipality_id').empty();        
        $('#dvMunicipality').hide();
        $('#section_id').empty();
        $('#dvSection').hide();
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
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
                html+='<option value='+json.respuesta[i].municipality_key+'>'+json.respuesta[i].municipality+'</option>';
            }
            $('#municipality_id').html(html);
            $('#municipality_id').attr('onChange', 'onChangeSectionMpio('+ dtto_loc +')');
            
            if (selectOpt != 0 ) {                
                $('#municipality_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangeSectionMpio( dtto_loc)
 {
    var id=$("#municipality_id").val();
    if ( id != "" ) {
        $('#dvSection').show();
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
        getSectionMpio(0, dtto_loc, id);
    }
    else {
        $('#section_id').empty();
        $('#dvSection').hide();
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
    }
 }


function getSectionMpio(selectOpt=0, dtto_loc=0, mpio)
 {      
    $.ajax({
        type: "GET",
        url: vuri + '/type/sections',
        data: {
            method: 'get',
            municipality: mpio,
            local_district: dtto_loc
        },
        success: function(json) {
            var html ='';
                html+='<option value="">--- Seccion ---</option>';
            for ( var i=0; i<json.respuesta.length; i++ ) {
                html+='<option value='+json.respuesta[i].section+'>'+json.respuesta[i].section+'</option>';
            }
            $('#section_id').html(html);
            $('#section_id').attr('onChange', 'onChangePromoterSection()');
           
            if (selectOpt != 0 ) {                
                $('#section_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangePromoterSection()
 {
    var id=$("#section_id").val();

    if ( id != "" ) {
        $('#dvPromoter').show();
        getPromotersSection(0, id);
    }
    else {
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
    }
 }

function getPromotersSection(selectOpt=0, section)
 {      
    $.ajax({
        type: "GET",
        url: vuri + '/type/promoters',
        data: {
            method: 'get',
            section_id: section
        },
        success: function(json) {
            var html ='';
                html+='<option value="">--- Promotor ---</option>';
            for ( var i=0; i<json.respuesta.length; i++ ) {
                html+='<option value='+json.respuesta[i].id+'>'+json.respuesta[i].coordinator+'</option>';
            }
            $('#promoter_id').html(html);
           
            if (selectOpt != 0 ) {                
                $('#promoter_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }