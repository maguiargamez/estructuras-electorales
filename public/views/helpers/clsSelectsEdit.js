var id_distrito = 0;
var _edit = 0;

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

function getDistrictLocalMunicipality(vdataSelect=0, vmunicipality=0, vsection=0, vcoordinator=0)
 {
    id_distrito = vdataSelect;
    _edit = 1;

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
            $('#district_id').attr('onChange', 'onChangeMunicipioDtto('+ vmunicipality +', '+ vsection +', '+ vcoordinator +')');

            if (vdataSelect != 0 )
                $('#district_id').val(vdataSelect).trigger('change');
        },
        error: function(json) { }
    });
 }

function onChangeMunicipioDtto(vmunicipality=0, vsection=0, vcoordinator=0)
 {
    var id=$("#district_id").val();
    if(_edit > 1)
    {
        vmunicipality=0;
        vsection=0;
        vcoordinator=0;
    }   
    
    if ( id != "" ) {      
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
        $('#section_id').empty();
        $('#dvSection').hide();
        $('#municipality_id').val('').trigger('change');
        $('#dvMunicipality').show();
        getMunicipality_Dtto(vmunicipality, vsection, vcoordinator, id);
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

function getMunicipality_Dtto(selectOpt=0, selectSection=0, selectCoordinator=0, dtto_loc)
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
            $('#municipality_id').attr('onChange', 'onChangeSectionMpio('+ selectSection +', '+ selectCoordinator + ', ' + dtto_loc +')');
            
            if (selectOpt != 0 ) {                
                $('#municipality_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangeSectionMpio(section=0, coordinator=0, dtto_loc=0)
 {
    if(_edit == 2)
    {
        coordinator=0;
        section=0;
        _edit = 3;
    }  

    var id=$("#municipality_id").val();
    
    if ( id != "" ) {
        $('#dvSection').show();
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
        getSectionMpio(section, coordinator, dtto_loc, id);
    }
    else {
        $('#section_id').empty();
        $('#dvSection').hide();
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
    }
 }


function getSectionMpio(selectOpt=0, coordinator=0, dtto_loc=0, mpio)
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
            $('#section_id').attr('onChange', 'onChangePromoterSection('+ coordinator +')');
           
            if (selectOpt != 0 ) {                
                $('#section_id').val(selectOpt).trigger('change');
            }
        },
        error: function(json) { }
    });
 }

function onChangePromoterSection(coordinator)
 {    
    if(_edit==2){
        _edit=3;
        coordinator=0;
    }

    var id=$("#section_id").val();

    if ( id != "" ) {
        $('#dvPromoter').show();
        getPromotersSection(coordinator, id);
    }
    else {
        $('#promoter_id').empty();
        $('#dvPromoter').hide();
    }
 }

function getPromotersSection(selectOpt=0, section)
 {      
    _edit=2;

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