 var table; 

$(document).ready(
    function() {  
        load_data();
        handleSearchDatatable();  
    }
);

function load_data()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/panel-control/promovidos/municipio/results',
        dataType: "JSON",
        data: {
            method: 'get',
            id_municipio: $('#id_municipio').val()
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;

            if(vresponse.codigo == 1)
            {
                var total_prom = vrespuesta.length;
                $('#spTotalPromovidos').html(total_prom);
                var vhtml ='';         

                vhtml+='<div class="table-responsive">';
                vhtml+='    <table id="table-promoteds" class="table table-row-bordered table-row-gray-100 align-middle gs-4 gy-4 gx-4">';
                vhtml+='        <thead>';
                vhtml+='            <tr class="fw-bolder fw-bolder fs-5 text-white border-0 m-4" style="background: linear-gradient(112.14deg, #bdc3c7 0%, #2c3e50 100%)">';
                vhtml+='                <th class="min-w-80px">#</th>';
                vhtml+='                <th class="min-w-80px">SECCION</th>';
                vhtml+='                <th class="min-w-140px">NOMBRE</th>';
                vhtml+='                <th class="min-w-140px">CLAVE ELECTOR</th>';
                vhtml+='                <th class="min-w-140px">VIGENCIA</th>';
                vhtml+='                <th class="min-w-140px">CURP</th>';
                vhtml+='            </tr>';
                vhtml+='        </thead>';
                vhtml+='        <tbody class="border-bottom border-dashed">';
                for ( vi=0; vi < vrespuesta.length; vi++ ) {               
                    vhtml+='        <tr class="border-dashed border-bottom-2 border-gray-400">';
                    vhtml+='            <td>' + (vi + 1) + '</td>';
                    vhtml+='            <td>' + vrespuesta[vi].section + '</td>';
                    vhtml+='            <td>' + vrespuesta[vi].firstname +' '+ vrespuesta[vi].lastname + '</td>';
                    vhtml+='            <td>' + vrespuesta[vi].electoral_key + '</td>';        
                    vhtml+='            <td>' + vrespuesta[vi].electoral_key_validity + '</td>';        
                    vhtml+='            <td>' + vrespuesta[vi].curp + '</td>';        
                    vhtml+='        </tr>';
                }    
                vhtml+='        </tbody>';
                vhtml+='    </table>';
                vhtml+='</div>  ';               

                $('#promoteds').html(vhtml);  
                table = $('#table-promoteds').dataTable({
                            searching: true,
                            responsive: true,
                            pageLength: 25,
                            bLengthChange : false,
                            language: {
                                url: vuri + '/views/spanish.json'
                            }
                        });
            }            
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

var handleSearchDatatable = function () {  
    const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

    filterSearch.addEventListener('keyup', function (e) {
        table.dataTable().fnFilter(e.target.value);
    });    
}