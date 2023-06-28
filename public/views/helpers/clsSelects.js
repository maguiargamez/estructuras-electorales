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

