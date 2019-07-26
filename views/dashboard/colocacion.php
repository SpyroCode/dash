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


?>
<div class="row">
            <div class="col-12">

                <form action="<?=base_url?>colocacion/index" method="post" class="form-inline my-2 my-lg-0">

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="customCheck1" id="customCheck1" checked="">
                        <label class="custom-control-label" for="customCheck1">Metas</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="customSwitch1" id="customSwitch1" checked="">
                        <label class="custom-control-label" for="customSwitch1">Clientes Casa</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="customSwitch2" id="customSwitch2" checked="">
                        <label class="custom-control-label" for="customSwitch2">PQ, DC</label>
                    </div>

                    <select class="custom-select" id="pro" name="pro" required>
                        <option selected="">Producto</option>
                        <option value="1">Creditos</option>
                        <option value="2">Arrendamiento</option>
                        <option value="3">Venta a Plazo</option>
                    </select>
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
                            text: 'Colocacion en el Año : <?php echo $yy; ?> Tipo Cte : <?=$casa?>'
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
                            name: 'Monto(Miles)',
                            colorByPoint: true,
                            data: [{
                                name: 'Linea CR',
                                y: 61.41,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'D. Colateral',
                                y: 11.84
                            }, {
                                name: 'PQ',
                                y: 10.85
                            }, {
                                name: 'Ref.',
                                y: 4.67
                            }, {
                                name: 'Sim.',
                                y: 4.18
                            }, {
                                name: 'AP',
                                y: 7.05
                            },{
                                name: 'VP',
                                y: 8.04
                            }
                            
                            
                            ]
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
                            text: 'Colocacion por Ejecutivo Periodo : <?=$p?> Año : <?=$yy?>'
                        },
                        xAxis: {
                            categories: ['Lilia S', 'Armando M', 'Ulises V', 'Martin T', 'Carlos C']
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
                            data: [50, 30, 40, 70, 20]
                        }, {
                            name: 'Arrendamiento',
                            data: [20, 20, 30, 20, 10]
                        }, {
                            name: 'Venta Plazo',
                            data: [3, 4, 4, 2, 5]
                        }]
                    });
                </script>
            </div>

            <div class="col-3" id="tipoc">
                <script>
                    // Build the chart
                    Highcharts.chart('tipoc', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Sectores<br><?=$yy?>',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    distance: -50,
                                    style: {
                                        fontWeight: 'bold',
                                        color: 'white'
                                    }
                                },
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                size: '110%'
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Sectores',
                            innerSize: '50%',
                            data: [
                                ['Agricola', 58.9],
                                ['Servicios', 13.29],
                                ['Construccion', 13],
                                ['Gobierno', 3.78],
                                ['Comercio', 3.42],
                                {
                                    name: 'Otro',
                                    y: 7.61,
                                    dataLabels: {
                                        enabled: false
                                    }
                                }
                            ]
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
                            text: 'Tipo de Cliente, <?=$yy?>'
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
                            name: 'Monto en Miles(1000)',
                            colorByPoint: true,
                            data: [{
                                name: 'Normal',
                                y: 61.41,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Referenciado',
                                y: 11.84
                            }, {
                                name: 'Casa',
                                y: 10.85
                            }, {
                                name: 'Empleado',
                                y: 4.67
                            }, {
                                name: 'Otro',
                                y: 4.18
                            }]
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
                        data: [5, 3, 4],
                        stack: 'normal'
                    }, {
                        name: 'Casa',
                        data: [3, 4, 4],
                        stack: 'casa'
                    }, {
                        name: 'Empleado',
                        data: [2, 5, 6],
                        stack: 'casa'
                    }, {
                        name: 'Referenciado',
                        data: [3, 2, 4],
                        stack: 'normal'
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
                        pointFormat: '{series.name} total Colocado <b>{point.y:,.0f}</b><br/> en {point.x}'
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
                        name: 'IRAPUATO',
                        data: [
                           
                            20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224
                        ]
                    }, {
                        name: 'LEON',
                        data: [
                            30062, 32049, 33952, 35804, 37431, 39197, 45000, 43000, 41000
                        ]
                    }, {
                        name: 'CELAYA',
                        data: [
                            37000, 35, 330, 31000, 29000, 270, 25000, 24000, 23000
                        ]
                    }]
                });


            </script>
        </div>
        

            
    </div>