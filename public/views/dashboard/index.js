var table; 

$(document).ready(
    function() {  
        handleSearchDatatable();  
    }
);

function loadData()
{
    $.ajax({
        type: 'GET',
        url: vuri + '/panel-control/result-index',
        dataType: "JSON",           
        success: function(vresponse, vtextStatus, vjqXHR) {
                         
            if(vresponse.codigo==1)
            {
                var vrespuesta=vresponse.respuesta;
                var hombres = vresponse.respuesta.hombres_promovido;
                var mujeres = vresponse.respuesta.mujeres_promovido;
                var menor_edad = vresponse.respuesta.menorEdad;
                var mayor_edad = vresponse.respuesta.mayorEdad;
                var metaP = vresponse.respuesta.metaGlobal;
                var avanceP = vresponse.respuesta.avance_promovidos;
                var totalSecciones = vresponse.respuesta.totalSecciones;
                var totalSeccionesConProm = vresponse.respuesta.totalSeccionesConPromovidos;
                var porcAvanceSecciones = vresponse.respuesta.porcentajeAvanceSeccion;

                var totalMunicipios = vresponse.respuesta.totalMunicipios;
                var totalMunicipiosConProm = vresponse.respuesta.totalMunicipiosConPromovidos;
                var porcAvanceMunicipios = vresponse.respuesta.porcentajeAvanceMunicipios;
                var lstPromMpio = vresponse.respuesta.lstPromovidosPorMunicipio;                

                $('#spTotalGlobalPromovidos').html(vrespuesta.promovidos);
                $('#spTotalGlobal').html(vrespuesta.metaGlobal);
                
                $('#spTotalCordEstatal').html(vrespuesta.coordEstatal);
                $('#spTotalCordDistrital').html(vrespuesta.coordDistrital);
                $('#spTotalCordMunicipal').html(vrespuesta.coordMunicipal);
                $('#spTotalPromovidos').html(vrespuesta.promovidos);


                var avance = (vrespuesta.promovidos * 100) / vrespuesta.metaGlobal;
                $('#spAvance').html(avance.toFixed(1)); 

                var htmlAvance='';

                htmlAvance+='   <div role="progressbar" style="width: '+ avance.toFixed(1) +'%;" aria-valuenow="'+ avance.toFixed(1) +'" aria-valuemin="0" aria-valuemax="100" class="bg-success rounded h-20px"></div>';              
                $('#dvPorcentajeAvance').html(htmlAvance);

                $('#spMetaPromovidos').html(metaP);
                $('#spAvancePromovidos').html(avanceP);
                $('#spFaltantesPromovidos').html(metaP-avanceP);

                $('#spPromovidosAv').html(avanceP);
                $('#spPromovidosTot').html(metaP);

                var porcAvance = (avanceP / metaP) * 100;
                var vhtmlPorc='';

                if(porcAvance=='Infinity')
                    porcAvance=0;

                $('#spPorcentajePromovidos').html(porcAvance.toFixed(1));

                vhtmlPorc+='<div class="progress h-7px bg-info bg-opacity-50 mt-7">';
                vhtmlPorc+='    <div class="progress-bar bg-info" role="progressbar" style="width: '+ porcAvance +'%" aria-valuenow="'+ porcAvance +'" aria-valuemin="0" aria-valuemax="100"></div>';
                vhtmlPorc+='</div>';

                $('.dvPorcentajeAvance').html(vhtmlPorc); 

                $('#spTotalSecciones').html(totalSecciones);
                $('#spTotalSeccionesConPromovidos').html(totalSeccionesConProm);
                $('#spSeccionesSinPromovidos').html(totalSecciones - totalSeccionesConProm);
                $('#spPorcentajeSecciones').html(porcAvanceSecciones);

                $('#spTotalMunicipios').html(totalMunicipios);
                $('#spTotalMunicipiosConPromovidos').html(totalMunicipiosConProm);
                $('#spPorcentajeAvanceMunicipios').html(porcAvanceMunicipios);
                $('#spMunicipiosSinPromovidos').html(totalMunicipios - totalMunicipiosConProm);             

                loadDonutSexo(hombres, mujeres);
                loadDonutEdad(menor_edad, mayor_edad);
                loadPromByMpio(lstPromMpio);
           
            }               
        },       
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });   
}


function loadDonutSexo(data1, data2)
{
    var total = data1 + data2;
    var porcHombres = (data1 / total) * 100;
    var porcMujeres = (data2 / total) * 100;

    $('#spTotalSexo').html(total);
    $('#spSexoHombres').html(data1);
    $('#spSexoMujeres').html(data2);

    $('#spPorcentajeHombres').html(porcHombres.toFixed(1));
    $('#spPorcentajeMujeres').html(porcMujeres.toFixed(1));
    
    var ctx = document.getElementById("kt_chart_sexo");
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Hombres', 'Mujeres'],
        datasets: [{      
          data: [data1, data2],
          backgroundColor: [ "#009EF7","#F1416C" ]
        }]
      },
      options: {
        chart:{fontFamily:"inherit"},
        cutoutPercentage:75,
        responsive:!0,
        maintainAspectRatio:!1,
        cutout:"75%",
        title:{display:!1},
        animation:{
            animateScale:!0,
            animateRotate:!0
        },
        tooltips:{
            enabled:!0,
            intersect:!1,
            mode:"nearest",
            bodySpacing:5,
            yPadding:10,
            xPadding:10,
            caretPadding:0,
            displayColors:!1,
            backgroundColor:"#20D489",
            titleFontColor:"#ffffff",
            cornerRadius:4,
            footerSpacing:0,
            titleSpacing:0
        },
        plugins:{ legend:{display:!1 } }
      }
    });
}

function loadDonutEdad(data1, data2)
{
    var total = data1 + data2;
    var porcMenor = (data1 / total) * 100;
    var porcMayor = (data2 / total) * 100;

    $('#spTotalVotantes').html(total);
    $('#spMenorEdad').html(data1);
    $('#spMayorEdad').html(data2);

    $('#spPorcentajeMenores').html(porcMenor.toFixed(1));
    $('#spPorcentajeMayores').html(porcMayor.toFixed(1));
    
    var ctx = document.getElementById("kt_chart_votantes");
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['18 años', 'Mayor de 18'],
        datasets: [{      
          data: [data1, data2],
          backgroundColor: [ "#7CB31A","#FF9801" ]
        }]
      },
      options: {
        chart:{fontFamily:"inherit"},
        cutoutPercentage:75,
        responsive:!0,
        maintainAspectRatio:!1,
        cutout:"75%",
        title:{display:!1},
        animation:{
            animateScale:!0,
            animateRotate:!0
        },
        tooltips:{
            enabled:!0,
            intersect:!1,
            mode:"nearest",
            bodySpacing:5,
            yPadding:10,
            xPadding:10,
            caretPadding:0,
            displayColors:!1,
            backgroundColor:"#20D489",
            titleFontColor:"#ffffff",
            cornerRadius:4,
            footerSpacing:0,
            titleSpacing:0
        },
        plugins:{ legend:{display:!1 } }
      }
    });
}

function loadPromByMpio(data)
{
    var vhtml ='';  
           
    vhtml+='<div class="table-responsive">';
    vhtml+='    <table id="table-mpio" class="table table-bordered align-middle table-row-gray-400 fs-6 gy-3" width="100%">';
    vhtml+='        <thead>';
    vhtml+='            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">';
    vhtml+='                <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1">#</th>';
    vhtml+='                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">DISTRITO</th>';
    vhtml+='                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">MUNICIPIO</th>';
    vhtml+='                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">PROMOVIDOS</th>';
    vhtml+='                <th class="min-w-100px sorting_disabled text-end" rowspan="1" colspan="1">OPCION</th>';
    vhtml+='            </tr>';
    vhtml+='        </thead>';
    vhtml+='        <tbody>';
    for ( vi=0; vi < data.length; vi++ ) {               
        vhtml+='        <tr class="border-dashed border-bottom-2 border-gray-400">';
        vhtml+='            <td class="ps-1">' + (vi + 1) + '</td>';
        vhtml+='            <td>Distrito ' + data[vi].local_district + '</td>';
        vhtml+='            <td>' + data[vi].municipality + '</td>';
        vhtml+='            <td>' + data[vi].total + '</td>';        
        vhtml+='            <td class="text-end">';
        vhtml+='                <a href="'+ vuri +'/panel-control/promovidos/'+ data[vi].municipality_key +'/municipio" class="btn btn-icon btn-light-twitter btn-sm me-3">';
        vhtml+='                    <i class="bi bi-arrow-right fs-4"></i>';
        vhtml+='                </a>';
        vhtml+='           </td>';        
        vhtml+='        </tr>';
    }               
    vhtml+='        </tbody>';
    vhtml+='    </table>';
    vhtml+='</div>';

    $('#promoteds').html(vhtml);  
    table = $('#table-mpio').dataTable({
                searching: true,
                responsive: true,
                pageLength: 25,
                bLengthChange : false,
                language: {
                    url: vuri + '/views/spanish.json'
                }
            });
}

var handleSearchDatatable = function () {  
    const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

    filterSearch.addEventListener('keyup', function (e) {
        table.dataTable().fnFilter(e.target.value);
    });    
}