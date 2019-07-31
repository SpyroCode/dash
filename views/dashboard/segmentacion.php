<?php
$ejecutivos=array();
$i=0;
foreach( $segmentos_ejecutivos as  $segmentos_ejecutivo){
        $ejecutivos[$i]=$segmentos_ejecutivo['IDEjecutivo'];
        $i++;
}  
$recorrido=$i;

$i=0;
$j=0;
$acumula_seg=0;
$segmentos_cant=array();
foreach($segmentos_ejecs as $segmento){
for ($j=0; $j < $recorrido ; $j++) { 
        $segmentos_cant[$i][$j+1]=0;
    }
    $i++;
}
$i=0;
foreach($segmentos_ejecs as $segmento){
    if($segmento["Segmento"]>$acumula_seg){
        $i++;
        
    }
    $segmentos_cant[$i][0]=$segmento["DescSegmento"];
    
    for ($j=0; $j < $recorrido; $j++) { 
       if($segmento['IDEjecutivo']==$ejecutivos[$j]){
            $segmentos_cant[$i][$j+1]=$segmento['cant'];
        } 
    }
    $acumula_seg=$segmento["Segmento"];
}
$no_segmentos=$i;

?>
<div class="row">
    <div class="col-6" id="seg_cmu">
        <script>
                Highcharts.chart('seg_cmu', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Segmentacion por CMU, <?=date("Y")?>'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Cant(%)',
                        colorByPoint: true,
                        data: [
                               <?php
                                foreach($segmentos_cmu as $segmento_cmu){
                                    $descSegmento=$segmento_cmu['DescSegmento'];
                                    $cant=$segmento_cmu['cant'];
                                    echo "{name: '$descSegmento',y: $cant,}, ";
                                }
                               ?> 
                               
                            ]
                    }]
                });
        </script>

    </div>
    <div class="col-6" id="seg_cma">
        <script>
               Highcharts.chart('seg_cma', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Segmentacion por CMA, <?=date("Y")?>'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Cant(%)',
                        colorByPoint: true,
                        data: [
                            <?php
                                foreach($segmentos_cma as $segmento_cma){
                                    $descSegmento=$segmento_cma['DescSegmento'];
                                    $cant=$segmento_cma['cant'];
                                    echo "{name: '$descSegmento',y: $cant,}, ";
                                }
                               ?> 
                            ]
                    }]
                });
        </script>
    </div>
</div>
<div class="row">
    <div class="col-12" id="seg_eje">
            <script>
                Highcharts.chart('seg_eje', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Segmentacion por Ejecutivo'
                    },
                    xAxis: {
                        categories: [
                            <?php
                                foreach($segmentos_ejecutivos as $segmentos_ejecutivo){
                                    $ejecutivo=$segmentos_ejecutivo['Ejecutivo'];
                                    echo "'$ejecutivo',";
                                }
                            ?>
                            
                            ]
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Total de Clientes'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        x: -30,
                        verticalAlign: 'top',
                        y: 25,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                            }
                        }
                    },
                    series: [
                             <?php
                                for ($i=0; $i <=$no_segmentos ; $i++) { 
                                      echo "{ name: '".$segmentos_cant[$i][0]."',data: [";  
                                    for ($j=1; $j <=$recorrido ; $j++) { 
                                      echo  $segmentos_cant[$i][$j].","; 
                                    }
                                    echo "]},";
                                }
                             ?>   
                             
                             
                            ]
                });
            </script>

    </div>
</div>