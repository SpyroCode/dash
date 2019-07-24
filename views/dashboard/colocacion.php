<?php 
$dbHost = 'localhost';
$dbName = 'etl';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}
$yy=date('Y');
$p=date('n');
if($_POST){
    
    if($_POST['yy']){
       $yy=$_POST['yy']; 
    }
    if($_POST['p']);
        $p=$_POST['p'];
    
}
if($_POST){
    $queryResult=$pdo->query("SELECT
	periodo,
	clave AS Producto,
	SUM(Monto) / 1000 AS Monto
FROM
	etl_colocacion_resume
WHERE
	yy = $yy
GROUP BY
	periodo,
	clave
ORDER BY
	Producto,periodo ASC ");
}else {
    $queryResult=$pdo->query("SELECT
	periodo,
	clave AS Producto,
	SUM(Monto) / 1000 AS Monto
FROM
	etl_colocacion_resume
WHERE
 yy = $yy
AND IDTipoCte <> 2
AND IDTipoCte <> 4
GROUP BY
	periodo,
	clave ");
}
$i=0;
$j=0;
$k=0;
$ap=array(0,0,0,0,0,0,0,0,0,0,0,0);
$vp=array(0,0,0,0,0,0,0,0,0,0,0,0);
$cr=array(0,0,0,0,0,0,0,0,0,0,0,0);


while($row=$queryResult->fetch(PDO::FETCH_ASSOC)) {
       if($row['Producto']=='AP'){
                    $j=$row['periodo'];
                    
                    $montoap= $row['Monto'];
                    
                    $j--;
                    $ap[$j]=$montoap;
        } 
        if($row['Producto']=='VP'){
                    $k=$row['periodo'];
                    $montovp= $row['Monto'];
                    
                    $k--;
                    $vp[$k]=$montoap;
        } 
        if($row['Producto']=='CR'){
                    $i=$row['periodo'];
                    $montocr= $row['Monto'];
                    
                    $i--;
                    $cr[$i]=$montoap;
        } 
           
   
}
$queryResult2=$pdo->query("SELECT SUM(Monto) as Monto FROM etl_colocacion_resume WHERE clave='CR' and yy=$yy ");
while($row=$queryResult2->fetch(PDO::FETCH_ASSOC)) {
    $montoacr=$row['Monto'];
}

$queryResult2=$pdo->query("SELECT SUM(Monto) as Monto FROM etl_colocacion_resume WHERE clave='AP' and yy=$yy ");
while($row=$queryResult2->fetch(PDO::FETCH_ASSOC)) {
    $montoaap=$row['Monto'];
}

$queryResult2=$pdo->query("SELECT SUM(Monto) as Monto FROM etl_colocacion_resume WHERE clave='VP' and yy=$yy ");
while($row=$queryResult2->fetch(PDO::FETCH_ASSOC)) {
    $montoavp=$row['Monto'];
}
$queryResult2=$pdo->query("SELECT * FROM etl_metas WHERE yy=$yy ");

while($row=$queryResult2->fetch(PDO::FETCH_ASSOC)) {
    $metacr=$row['metaCR'];
    $metaap=$row['metaAP'];
    $metavp=$row['metaVP'];
}
$cumap=($montoaap*100)/$metaap;
$cumvp=($montoavp*100)/$metavp;
$cumcr=($montoacr*100)/$metacr;  

$queryResult3=$pdo->query("SELECT
Producto,
sum(Monto) AS Monto
FROM
etl_colocacion_resume
WHERE
yy = $yy
GROUP BY
Producto");



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
                            text: 'Colocacion en el Año : <?php echo $yy; ?>'
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
                                        echo number_format($cr[$i]);
                                        
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
                                        echo number_format($ap[$i]);
                                        
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
                                        echo number_format($vp[$i]);
                                        
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