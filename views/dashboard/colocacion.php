<?php 

$i=0;
$j=0;
$k=0;
$ap=array(0,0,0,0,0,0,0,0,0,0,0,0);
$vp=array(0,0,0,0,0,0,0,0,0,0,0,0);
$cr=array(0,0,0,0,0,0,0,0,0,0,0,0);
$totalap=0;
$totalvp=0;
$totalcr=0;
foreach ($datos as $dato) {
    
    if($dato["Producto"]=='AP'){
            $j=$dato['periodo'];
                        
            $montoap= $dato['Monto'];
            $totalap=$totalap+$montoap;
            $j--;
            $ap[$j]=$montoap;
    }
    
    if($dato["Producto"]=='VP'){
            $i=$dato['periodo'];
                        
            $montovp= $dato['Monto'];
            $totalvp=$totalvp+$montovp;
            
            $i--;
            $vp[$i]=$montovp;
    }
    if($dato["Producto"]=='CR'){
            $k=$dato['periodo'];
                        
            $montocr= $dato['Monto'];
            $totalcr=$totalcr+$montocr;
            
            $k--;
            $cr[$k]=$montocr;
    }
    
    
}
foreach ($metas as $meta) {
    $metaap=$meta['metaAP'];
    $metavp=$meta['metaVP'];
    $metacr=$meta['metaCR'];
    $cumap=($totalap*100)/$metaap;
    $cumvp=($totalvp*100)/$metavp;
    $cumcr=($totalcr*100)/$metacr; 
}
$mnormal=0;
$mcasa=0;
$mreferenciado=0;
$mempleado=0;
foreach ($colTipoCte as $ctCte){
    $idTcte=$ctCte['IDTipoCte'];
    if($idTcte==1){
        $anormal=$ctCte['TipoCliente'];
        $mnormal=$ctCte['Monto'];
    }elseif ($idTcte==2){
        $acasa=$ctCte['TipoCliente'];
        $mcasa=$ctCte['Monto'];
    }elseif ($idTcte==3){
        $areferenciado=$ctCte['TipoCliente'];
        $mreferenciado=$ctCte['Monto'];
    }elseif ($idTcte==4){
        $aempleado=$ctCte['TipoCliente'];
        $mempleado=$ctCte['Monto'];
    }
}
$tipoap=0;
$tipovp=0;
$tipolc=0;
$tipopq=0;
$tiporef=0;
$tiposim=0;
$tipodc=0;
$tipoavio=0;

foreach ($colProducto as $producto){
    if($producto['Producto']=='Arrendamiento'){
        $tipoap=$producto['Monto'];
    }elseif(($producto['Producto']=='Venta a Plazo')) {
        $tipovp=$producto['Monto'];
    }elseif(($producto['Producto']=='CUENTA CORRIENTE')) {
        $tipolc=$producto['Monto'];
    }elseif(($producto['Producto']=='QUIROGRAFARIO')) {
        $tipopq=$producto['Monto'];
    }elseif(($producto['Producto']=='DIRECTO CON COLATERAL')) {
        $tipodc=$producto['Monto'];
    }elseif(($producto['Producto']=='REFACCIONARIO')) {
        $tiporef=$producto['Monto'];
    }elseif(($producto['Producto']=='SIMPLE')) {
        $tiposim=$producto['Monto'];
    }elseif(($producto['Producto']=='AVIO')) {
        $tipoavio=$producto['Monto'];
    }  
  
}
$ctcCRn=0;
$ctcAPn=0;
$ctcVPn=0;
foreach($colTipoCteN as $montoNormal){
    if($montoNormal['clave']=='CR'){
        $ctcCRn= $montoNormal['Monto'];
    }elseif ($montoNormal['clave']=='AP') {
        $ctcAPn= $montoNormal['Monto'];
    }elseif ($montoNormal['clave']=='VP') {
        $ctcVPn= $montoNormal['Monto'];
    }
    
}
$ctcCRc=0;
$ctcAPc=0;
$ctcVPc=0;
foreach($colTipoCteC as $montoCasa){
    if($montoCasa['clave']=='CR'){
        $ctcCRc= $montoCasa['Monto'];
    }elseif ($montoCasa['clave']=='AP') {
        $ctcAPc= $montoCasa['Monto'];
    }elseif ($montoCasa['clave']=='VP') {
        $ctcVPc= $montoCasa['Monto'];
    }
    
}
$ctcCRe=0;
$ctcAPe=0;
$ctcVPe=0;
foreach($colTipoCteE as $montoemp){
    if($montoemp['clave']=='CR'){
        $ctcCRe= $montoemp['Monto'];
    }elseif ($montoemp['clave']=='AP') {
        $ctcAPe= $montoemp['Monto'];
    }elseif ($montoemp['clave']=='VP') {
        $ctcVPe= $montoemp['Monto'];
    }
    
}
$ctcCRr=0;
$ctcAPr=0;
$ctcVPr=0;
foreach($colTipoCteR as $montoRef){
    if($montoRef['clave']=='CR'){
        $ctcCRr= $montoRef['Monto'];
    }elseif ($montoRef['clave']=='AP') {
        $ctcAPr= $montoRef['Monto'];
    }elseif ($montoRef['clave']=='VP') {
        $ctcVPr= $montoRef['Monto'];
    }
    
}
$i=0;
$j=0;
$ejecutivosCol=array();
$idEjecutivo=0;
$NumEjecutivos=0;
foreach( $colEjecutivos as $colEjecutivo){
    
    if($idEjecutivo!=$colEjecutivo['IDEjecutivo']){
        $NumEjecutivos++;
        
    }
    $idEjecutivo=$colEjecutivo['IDEjecutivo'];
    
}
for ($j=0; $j < $NumEjecutivos; $j++) { 
    for ($i=0; $i < 5; $i++) { 
        $ejecutivosCol[$j][$i]=0;
    }
}
$i=0;
$j=0;

foreach( $colEjecutivos as $colEjecutivo){
        if($j>0){
            if($idEjecutivo==$colEjecutivo['IDEjecutivo']){
                $j--;
            }
        }   
        $idEjecutivo=$colEjecutivo["IDEjecutivo"];   
        $ejecutivosCol[$j][$i]=$colEjecutivo["IDEjecutivo"];
        $ejecutivosCol[$j][$i+1]=$colEjecutivo["Ejecutivo"];
        if($colEjecutivo["clave"]=='CR'){
        $ejecutivosCol[$j][$i+2]=$colEjecutivo["Monto"];    
        }elseif ($colEjecutivo["clave"]=='AP') {
            $ejecutivosCol[$j][$i+3]=$colEjecutivo["Monto"]; 
        }elseif ($colEjecutivo["clave"]=='VP') {
            $ejecutivosCol[$j][$i+4]=$colEjecutivo["Monto"]; 
        }
        $j++;
  
}
$zonasCol=array();
for ($j=0; $j < 3; $j++) { 
    for ($i=0; $i < 12; $i++) { 
        $zonasCol[$j][$i]=0;
    }
}
$zonasCol[0][0]="CELAYA";
$zonasCol[0][0]="IRAPUATO";
$zonasCol[0][0]="LEON";
foreach ($colZonas as $colZona) {
    if($colZona["zona"]=='CELAYA'){
        $zonasCol[0][0]=$colZona["zona"];
        $cont_cel=$colZona["periodo"];
        $zonasCol[0][$cont_cel]=$colZona["Monto"];
    }elseif ($colZona["zona"]=='IRAPUATO') {
        $zonasCol[1][0]=$colZona["zona"];
        $cont_ira=$colZona["periodo"];
        $zonasCol[1][$cont_ira]=$colZona["Monto"];
    }elseif ($colZona["zona"]=='LEON') {
        $zonasCol[2][0]=$colZona["zona"];
        $cont_leo=$colZona["periodo"];
        $zonasCol[2][$cont_leo]=$colZona["Monto"];
    }
}

?>
<div class="row">
            <div class="col-12">

                <form action="<?=base_url?>colocacion/index" method="post" class="form-inline my-2 my-lg-0">

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="customCheck1" id="customCheck1" checked="true">
                        <label class="custom-control-label" for="customCheck1">Metas</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="customSwitch1" id="customSwitch1" checked="">
                        <label class="custom-control-label" for="customSwitch1">Clientes Casa</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="customSwitch2" id="customSwitch2" checked="">
                        <label class="custom-control-label" for="customSwitch2">PQ</label>
                    </div>

              
                    <select class="custom-select" id="p" name="p" required>
                        <option selected="">Periodo</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Mazro</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <select class="custom-select" id="yy" name="yy" required>
                        <option selected="">Año</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>

                    </select>
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Enviar</button>

                </form>

            </div>
        </div>


        <?php if ($_POST["customCheck1"]): 
            # code...
        ?>
        <div class="row">
            <div class="col" id="tg1">
                <span class="badge badge-pill badge-warning">Creditos</span>
                <input type="text" value="<?php echo number_format($cumcr); ?>" class="cr">
            </div>
            <div class="col" id="tg2">
                <span class="badge badge-pill badge-info">Arrendamiento</span>
                <input type="text" value="<?php echo number_format($cumap); ?>" class="ap">
            </div>
            <div class="col" id="tg3">
                <span class="badge badge-pill badge-success">Venta a Plazo</span>
                <input type="text" value="<?php echo number_format($cumvp); ?>" class="vp">
            </div>
        <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-9" id="metas">

                <script>
                    Highcharts.chart('metas', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Colocacion'
                        },
                        subtitle: {
                            text: 'Colocacion en el Año : <?php echo $yy; ?> Tipo Cte : <?=$casa?> (<?=$pq?>)'
                        },
                        xAxis: {
                            categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dic']
                        },
                        yAxis: {
                            title: {
                                text: 'Miles (1000)'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [{
                            name: 'Creditos',
                            data: <?php
                                    echo "[";
                                    for ($i=0; $i < 12; $i++) { 
                                        echo ($cr[$i]);
                                        
                                        if($i<11){
                                          echo ",";  
                                        }
                                    }
                                    echo "]";
                                ?>
                        }, {
                            name: 'Arrendamiento',
                            data: <?php
                                    echo "[";
                                    for ($i=0; $i < 12; $i++) { 
                                        echo ($ap[$i]);
                                        
                                        if($i<11){
                                          echo ",";  
                                        }
                                    }
                                    echo "]";
                                    ?>
                        }, {
                            name: 'Venta a Plazo',
                            
                            data: <?php
                                    echo "[";
                                    for ($i=0; $i < 12; $i++) { 
                                        echo ($vp[$i]);
                                        
                                        if($i<11){
                                          echo ",";  
                                        }
                                    }
                                    echo "]";
                                    ?>
                        }]
                    });

                </script>
            </div>
            <div class="col-3" id="productos">
                <script>
                    // Build the chart
                    Highcharts.chart('productos', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Colocacion de Producto, Periodo : <?=$p?> Año : <?=$yy?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Porcentajes(%)',
                            colorByPoint: true,
                            data: [{
                                name: 'Linea CR',
                                y: <?=$tipolc?>
                                
                            }, {
                                name: 'D. Colateral',
                                y: <?=$tipodc?>
                            }, {
                                name: 'PQ',
                                y: <?=$tipopq?>
                            },{
                                name: 'AVIO',
                                y: <?=$tipoavio?>
                            }, {
                                name: 'Ref.',
                                y: <?=$tiporef?>
                            }, {
                                name: 'Sim.',
                                y: <?=$tiposim?>
                            }, {
                                name: 'AP',
                                y: <?=$tipoap?>
                            },{
                                name: 'VP',
                                y: <?=$tipovp?>
                            }]
                        }]
                    });


                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-6" id="ejecutivos">
                <script>
                    Highcharts.chart('ejecutivos', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Colocacion por Ejecutivo Periodo : <?=$p?> Año : <?=$yy?>  '
                        },
                        subtitle: {
                             text: 'Fuente : <?=$casa?> (<?=$pq?>)'
                         },
                        xAxis: {
                            categories: [
                                <?php
                                    for ($j=0; $j < $NumEjecutivos; $j++) { 
                                        
                                            echo "'".$ejecutivosCol[$j][1]."',";
                                                                           
                                    }
                                ?>
                            ]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Total Colocado en Miles'
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal'
                            }
                        },
                        series: [{
                            name: 'Creditos',
                            data: [
                                <?php
                                    for ($j=0; $j < $NumEjecutivos; $j++) { 
                                        
                                            echo $ejecutivosCol[$j][2].",";
                                                                           
                                    }
                                ?>
                            ]
                        }, {
                            name: 'Arrendamiento',
                            data: [
                                <?php
                                    for ($j=0; $j < $NumEjecutivos; $j++) { 
                                        
                                            echo $ejecutivosCol[$j][3].",";
                                                                           
                                    }
                                ?>
                            ]
                        }, {
                            name: 'Venta Plazo',
                            data: [<?php
                                    for ($j=0; $j < $NumEjecutivos; $j++) { 
                                        
                                            echo $ejecutivosCol[$j][4].",";
                                                                           
                                    }
                                ?>]
                        }]
                    });
                </script>
            </div>

            <div class="col-3" id="colemp">
                <script>
                    // Build the chart
                    function renderIcons() {

                                // Move icon
                                if (!this.series[0].icon) {
                                    this.series[0].icon = this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
                                        .attr({
                                            stroke: '#303030',
                                            'stroke-linecap': 'round',
                                            'stroke-linejoin': 'round',
                                            'stroke-width': 2,
                                            zIndex: 10
                                        })
                                        .add(this.series[2].group);
                                }
                                this.series[0].icon.translate(
                                    this.chartWidth / 2 - 10,
                                    this.plotHeight / 2 - this.series[0].points[0].shapeArgs.innerR -
                                        (this.series[0].points[0].shapeArgs.r - this.series[0].points[0].shapeArgs.innerR) / 2
                                );

                                // Exercise icon
                                if (!this.series[1].icon) {
                                    this.series[1].icon = this.renderer.path(
                                        ['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8,
                                            'M', 8, -8, 'L', 16, 0, 8, 8]
                                    )
                                        .attr({
                                            stroke: '#ffffff',
                                            'stroke-linecap': 'round',
                                            'stroke-linejoin': 'round',
                                            'stroke-width': 2,
                                            zIndex: 10
                                        })
                                        .add(this.series[2].group);
                                }
                                this.series[1].icon.translate(
                                    this.chartWidth / 2 - 10,
                                    this.plotHeight / 2 - this.series[1].points[0].shapeArgs.innerR -
                                        (this.series[1].points[0].shapeArgs.r - this.series[1].points[0].shapeArgs.innerR) / 2
                                );

                                // Stand icon
                                if (!this.series[2].icon) {
                                    this.series[2].icon = this.renderer.path(['M', 0, 8, 'L', 0, -8, 'M', -8, 0, 'L', 0, -8, 8, 0])
                                        .attr({
                                            stroke: '#303030',
                                            'stroke-linecap': 'round',
                                            'stroke-linejoin': 'round',
                                            'stroke-width': 2,
                                            zIndex: 10
                                        })
                                        .add(this.series[2].group);
                                }

                                this.series[2].icon.translate(
                                    this.chartWidth / 2 - 10,
                                    this.plotHeight / 2 - this.series[2].points[0].shapeArgs.innerR -
                                        (this.series[2].points[0].shapeArgs.r - this.series[2].points[0].shapeArgs.innerR) / 2
                                );
                                }

                                Highcharts.chart('colemp', {

                                chart: {
                                    type: 'solidgauge',
                                    height: '110%',
                                    events: {
                                        render: renderIcons
                                    }
                                },

                                title: {
                                    text: 'Activity',
                                    style: {
                                        fontSize: '24px'
                                    }
                                },

                                tooltip: {
                                    borderWidth: 0,
                                    backgroundColor: 'none',
                                    shadow: false,
                                    style: {
                                        fontSize: '16px'
                                    },
                                    pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}%</span>',
                                    positioner: function (labelWidth) {
                                        return {
                                            x: (this.chart.chartWidth - labelWidth) / 2,
                                            y: (this.chart.plotHeight / 2) + 15
                                        };
                                    }
                                },

                                pane: {
                                    startAngle: 0,
                                    endAngle: 360,
                                    background: [{ // Track for Move
                                        outerRadius: '112%',
                                        innerRadius: '88%',
                                        backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0])
                                            .setOpacity(0.3)
                                            .get(),
                                        borderWidth: 0
                                    }, { // Track for Exercise
                                        outerRadius: '87%',
                                        innerRadius: '63%',
                                        backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[1])
                                            .setOpacity(0.3)
                                            .get(),
                                        borderWidth: 0
                                    }, { // Track for Stand
                                        outerRadius: '62%',
                                        innerRadius: '38%',
                                        backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[2])
                                            .setOpacity(0.3)
                                            .get(),
                                        borderWidth: 0
                                    }]
                                },

                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    lineWidth: 0,
                                    tickPositions: []
                                },

                                plotOptions: {
                                    solidgauge: {
                                        dataLabels: {
                                            enabled: false
                                        },
                                        linecap: 'round',
                                        stickyTracking: false,
                                        rounded: true
                                    }
                                },

                                series: [{
                                    name: 'Move',
                                    data: [{
                                        color: Highcharts.getOptions().colors[0],
                                        radius: '112%',
                                        innerRadius: '88%',
                                        y: 80
                                    }]
                                }, {
                                    name: 'Exercise',
                                    data: [{
                                        color: Highcharts.getOptions().colors[1],
                                        radius: '87%',
                                        innerRadius: '63%',
                                        y: 65
                                    }]
                                }, {
                                    name: 'Stand',
                                    data: [{
                                        color: Highcharts.getOptions().colors[2],
                                        radius: '62%',
                                        innerRadius: '38%',
                                        y: 50
                                    }]
                                }]
                    });

                </script>
            </div>
            <div class="col-3" id="suc">
                <script>
                    // Build the chart
                    Highcharts.chart('suc', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Tipo de Cliente, Periodo <?=$p?> Año : <?=$yy?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Porcentaje en Miles(%)',
                            colorByPoint: true,
                            data: [
                                {
                                name: 'Normal',
                                y: <?=$mnormal?>,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Casa',
                                y: <?=$mcasa?>,
                                sliced: true,
                                selected: true
                            },{
                                name: 'Referenciado',
                                y: <?=$mreferenciado?>,
                                sliced: true,
                                selected: true
                            },{
                                name: 'Empleado',
                                y: <?=$mempleado?>,
                                sliced: true,
                                selected: true
                            }  
                            ]
                        }]
                    });


                </script>
            </div>
            

        </div>
        <div class="row">
        <div class="col-6" id="tipocte">

            <script>
                Highcharts.chart('tipocte', {

                    chart: {
                        type: 'column'
                    },

                    title: {
                        text: 'Colocacion Periodo : <?=$p?> Año <?=$yy?> tipo de Cliente'
                    },

                    xAxis: {
                        categories: ['Credito', 'Arrendamiento', 'Venta a Plazo']
                    },

                    yAxis: {
                        allowDecimals: false,
                        min: 0,
                        title: {
                            text: 'Miles (1000)'
                        }
                    },

                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.x + '</b><br/>' +
                                this.series.name + ': ' + this.y + '<br/>' +
                                'Total: ' + this.point.stackTotal;
                        }
                    },

                    plotOptions: {
                        column: {
                            stacking: 'normal'
                        }
                    },

                    series: [{
                        name: 'Normal',
                        data: [
                            <?=$ctcCRn.",".$ctcAPn.",".$ctcVPn;?>
                        ],
                        stack: 'normal'
                    }, {
                        name: 'Casa',
                        data: [
                            
                            <?=$ctcCRc.",".$ctcAPc.",".$ctcVPc;?>
                        ],
                        stack: 'casa'
                    }, {
                        name: 'Referenciado',
                        data: [
                            <?=$ctcCRr.",".$ctcAPr.",".$ctcVPr;?>                       ],
                        stack: 'normal'
                    }, {
                        name: 'Empleado',
                        data: [
                            <?=$ctcCRe.",".$ctcAPe.",".$ctcVPe;?>
                        ],
                        stack: 'casa'
                    }]
                });
            </script>
        </div>
        
    
        <div class="col-6" id="zonas">

            <script>
                Highcharts.chart('zonas', {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: 'Colocacion por Zona en el Año <?=$yy?>'
                    },
                    subtitle: {
                             text: 'Fuente : <?=$casa?> (<?=$pq?>)'
                    },
                    
                    xAxis: {
                        allowDecimals: false,
                        labels: {
                            formatter: function () {
                                return this.value; // clean, unformatted number for year
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Miles (1000)'
                        },
                        labels: {
                            formatter: function () {
                                return this.value / 1000 + 'k';
                            }
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name} total Colocado en Miles <b>{point.y:,.0f}</b><br/> en {point.x}'
                    },
                    plotOptions: {
                        area: {
                            pointStart: 1,
                            marker: {
                                enabled: false,
                                symbol: 'circle',
                                radius: 2,
                                states: {
                                    hover: {
                                        enabled: true
                                    }
                                }
                            }
                        }
                    },
                    series: [{
                        name: '<?=$zonasCol[0][0]?>',
                        data: [
                           
                            <?php
                                for ($i=1; $i < 12; $i++) { 
                                    echo $zonasCol[0][$i].",";
                                }
                            ?>
                        ]
                    }, {
                        name: '<?=$zonasCol[1][0]?>',
                        data: [
                            <?php
                                for ($i=1; $i < 12; $i++) { 
                                    echo $zonasCol[1][$i].",";
                                }
                            ?>
                        ]
                    }, {
                        name: '<?=$zonasCol[2][0]?>',
                        data: [
                            <?php
                                for ($i=1; $i < 12; $i++) { 
                                    echo $zonasCol[2][$i].",";
                                }
                            ?>
                        ]
                    }]
                });


            </script>
        </div>
        

            
    </div>
    <div class="row">
        <div class="col-6" id="poranio">
                <script>
                    var chart = Highcharts.chart('poranio', {

                            title: {
                                text: 'Colocacion Acumulada por Año'
                            },
                            subtitle: {
                            text: ' Tipo Cte : <?=$casa?> (<?=$pq?>)'
                            },
                            

                            xAxis: {
                                categories: [
                                    <?php
                                        foreach ($colporyy as $colyy) {
                                            echo "'".$colyy['yy']."',";
                                        }
                                    ?>
                                ]
                            },

                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: [
                                    <?php
                                        foreach ($colporyy as $colyy) {
                                            echo $colyy['Monto'].",";
                                        }
                                    ?>
                                ],
                                showInLegend: false
                            }]

                    });
                           
                </script>
        </div>
        <div class="col-6" id="pqs">
                             <?php 
                                $totCartera=(350941634/1000);
                                $totPQa=53548610/1000;
                                $limpq=20;
                                $limitePQ=$totCartera*($limpq/100);
                                $remanente=$limitePQ-$totPQa;
                            ?>
                    <script>
                        Highcharts.chart('pqs', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Limite Pqs'
                                },
                                xAxis: {
                                    categories: ['Cartera' ]
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Cartera Total',
                                    data: [<?=$totCartera?>]
                                }, {
                                    name: 'Total PQs',
                                    data: [<?=$totPQa?>]
                                }, {
                                    name: 'Limite 20%',
                                    data: [<?=$limitePQ?>]
                                }, {
                                    name: 'Remanente',
                                    data: [<?=$remanente?>]
                                }]
                            });
                               

                    </script>
        </div>
    </div>    