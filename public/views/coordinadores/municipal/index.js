 var table; 

$(document).ready(
    function() {  
        load_coordinadores();
        handleSearchDatatable();  
    }
);

function load_coordinadores()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/coordinador-municipal/results',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;

            $("#spTotal").html(vrespuesta.length);
            var vhtml ='';                
            for ( vi=0; vi < vrespuesta.length; vi++ ) {
                vhtml+='        <tr id="trId_'+ vrespuesta[vi].id +'" class="border-dashed border-bottom-2 border-gray-400">';
                vhtml+='            <td class="ps-1">' + (vi + 1) + '</td>';
                vhtml+='            <td>Distrito ' + vrespuesta[vi].local_district + '</td>';
                vhtml+='            <td>' + vrespuesta[vi].position + '</td>';
                vhtml+='            <td>' + vrespuesta[vi].coordinator + '</td>';
                vhtml+='            <td>' + vrespuesta[vi].electoral_key + '</td>';
                vhtml+='            <td>' + vrespuesta[vi].electoral_key_validity + '</td>';
                vhtml+='            <td class="text-end" style="padding-right: 10px">';
                vhtml+='                <div class="d-flex justify-content-end flex-shrink-0">';
                vhtml+='                    <a href="'+ vuri + '/coordinador-municipal/'+ vrespuesta[vi].id +'/edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">';
                vhtml+='                        <span class="svg-icon svg-icon-3">';
                vhtml+='                            <i class="icon-xl fas fa-user-edit fs-2"></i>';
                vhtml+='                        </span>';
                vhtml+='                    </a>';
                vhtml+='                </div>';
                vhtml+='            </td>';
                vhtml+='        </tr>';
            }               

            $('#body-content').append(vhtml);  

            table = $('#table-coordinadores').dataTable({
                searching: true,
                responsive: true,
                pageLength: 50,
                language: {
                    url: vuri + '/views/spanish.json'
                }
            });
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
