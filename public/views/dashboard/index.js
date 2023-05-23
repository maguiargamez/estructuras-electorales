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

                $('#spTotalGlobalPromovidos').html(vrespuesta.promovidos);
                $('#spTotalGlobal').html(vrespuesta.metaGlobal);

                $('#spTotalCordEstatal').html(vrespuesta.coordEstatal);
                $('#spTotalCordDistrital').html(vrespuesta.coordDistrital);
                $('#spTotalCordMunicipal').html(vrespuesta.coordMunicipal);
                $('#spTotalPromovidos').html(vrespuesta.promovidos);


                var avance = (vrespuesta.promovidos * 100) / vrespuesta.metaGlobal;
                $('#spAvance').html(avance.toFixed(1));

                var htmlAvance='';

                htmlAvance+='   <div role="progressbar" style="width: '+ avance.toFixed(1) +'%;" aria-valuenow="'+ avance.toFixed(1) +'" aria-valuemin="0" aria-valuemax="100" class="bg-success rounded h-30px"></div>';              
                $('#dvPorcentajeAvance').html(htmlAvance);

              

                console.log(vrespuesta);
                // var ultimos = vresponse.respuesta.ultimosComites;              
                // var lideres = vresponse.respuesta.lideres;
                // var promovidos = vresponse.respuesta.promovidos;
                // var metaP = vresponse.respuesta.meta_promovidos;
                // var avanceP = vresponse.respuesta.avance_promovidos;
                // var hombres = vresponse.respuesta.hombres_promovido;
                // var mujeres = vresponse.respuesta.mujeres_promovido;
                // var totalVotantes = vresponse.respuesta.menorEdad + vresponse.respuesta.mayorEdad;
                

                // $('#spIntegrados').html(vrespuesta.comitesIntegrados);
                // $('#spNoIntegrados').html(vrespuesta.pendientesIntegrar);
                // $('#spCoordinador').html(vrespuesta.totalCoordinadores);
                
                // $('#spTotalSeccion').html(vrespuesta.totalSecciones);
                // $('#spTotalSeccionIntegrados').html(vrespuesta.seccionesConComiteIntegrados);
                // $('#spPorcentajeSeccion').html(vrespuesta.porcentajeAvanceSeccion);
                // $('#spSeccionSinComite').html(vrespuesta.totalSecciones - vrespuesta.seccionesConComiteIntegrados);

                // $('#spTotalMunicipios').html(vrespuesta.totalMunicipios);
                // $('#spTotalMunicipiosIntegrados').html(vrespuesta.totalMunConComiteIntegrados);
                 
                // $('#spPorcentajeMunicipiosIcon').html(vrespuesta.porcentajeAvanceMunicipios);
                // $('#spPorcentajeMunicipios').html(vrespuesta.porcentajeAvanceMunicipios);
                // $('#spMunicipiosSinComite').html(vrespuesta.totalMunicipios - vrespuesta.totalMunConComiteIntegrados);


                // $('#spMetaPromovidos').html(metaP);
                // $('#spAvancePromovidos').html(avanceP);
                // $('#spFaltantesPromovidos').html(metaP-avanceP);
                
                // $('#spPromovidosAv').html(avanceP);
                // $('#spPromovidosTot').html(metaP);
                
                // var porcAvance = (avanceP / metaP) * 100;
                // var vhtmlPorc='';

                // $('#spPorcentajePromovidos').html(porcAvance.toFixed(2));

                // vhtmlPorc+='<div class="progress h-7px bg-info bg-opacity-50 mt-7">';
                // vhtmlPorc+='    <div class="progress-bar bg-info" role="progressbar" style="width: '+ porcAvance +'%" aria-valuenow="'+ porcAvance +'" aria-valuemin="0" aria-valuemax="100"></div>';
                // vhtmlPorc+='</div>';

                // $('.dvPorcentajeAvance').html(vhtmlPorc); 

                loadDonutSexo(hombres, mujeres);
                loadDonutEdad(menor_edad, mayor_edad);
           
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