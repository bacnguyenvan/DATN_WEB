<?php 
    
   require_once "../libraries/database.php";
   require_once"../libraries/function.php";
   $db = new database;

   $sql_temperature = "SELECT  day as '0',ROUND(avg(nhiet_do),2) as '1' FROM thong_so_moi_truong GROUP BY day ";
    $data_tem = $db->fetchSql($sql_temperature);

    $sql_soil_moist = "SELECT ROUND(avg(do_am),2) as '0' FROM thong_so_moi_truong GROUP BY day ";
    
    $data_soil_moist = $db->fetchSql($sql_soil_moist);

    $temperature = [];
    $soil_moist = [];
    $date = [];

    for($i = 0 ; $i < count($data_tem) ; $i++){
        $data_tem[$i][1] = (float)$data_tem[$i][1];
        $data_soil_moist[$i][0] = (int)$data_soil_moist[$i][0];

        array_push($temperature, $data_tem[$i][1]);
        array_push($date, $data_tem[$i][0]);

        array_push($soil_moist, $data_soil_moist[$i][0]);

    }

    $temperature = json_encode($temperature);
    $date = json_encode($date);
    $soil_moist = json_encode($soil_moist);
    // _debug($temperature);
    // die();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../public/uploads/kmt.png"/>
        <title>Biểu đồ</title>

        <style type="text/css">
            .highcharts-credits{
                /*display: none;*/
            }
        </style>
    </head>
    <body>
        <script src="highcharts/highcharts.js"></script>
        <script src="highcharts/highcharts-3d.js"></script>
        <script src="jquery/jquery.js" ></script>

        <div id="container" style="min-width: 300px; height: 400px; margin: 10% auto"></div>



            <script type="text/javascript">
            Highcharts.chart('container', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Biểu đồ nhiệt độ và độ ẩm đất'
                },
                xAxis: [{
                    categories: <?php echo $date ?>
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value} °C',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Nhiệt độ',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Độ ẩm đất',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value} %H',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    opposite: true
                }],

                // tooltip: {
                //     shared: true
                // },

                series: [
                {
                    name: 'Nhiệt độ',
                    // type: 'spline',
                    type: 'column',
                    data: <?php echo $temperature ?>,
                    tooltip: {
                        pointFormat: '<span style="font-weight: bold; color: {series.color}">{series.name}</span>: <b>{point.y:.1f}°C </b> '
                    },
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.1f}', 
                        y: 10, 
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
               
                },{
                    name: 'Độ ẩm đất',
                    type: 'column',
                    yAxis: 1,
                    data: <?php echo $soil_moist ?>,
                    tooltip: {
                        pointFormat: '<span style="font-weight: bold; color: {series.color}">{series.name}</span>: <b>{point.y:.1f} %H </b> '
                    },
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.1f}', 
                        y: 10, 
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }]
            });
            </script>

    </body>
</html>
