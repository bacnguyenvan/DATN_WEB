<?php 
    
   require_once "../libraries/database.php";
   require_once"../libraries/function.php";
   $db = new database;

   $sql_temperature = "SELECT  day as '0',ROUND(avg(nhiet_do),2) as '1' FROM thong_so_moi_truong GROUP BY day ";
    $data_tem = $db->fetchSql($sql_temperature);

    // $sql_soil_moist = "SELECT ROUND(avg(do_am),2) as value_soil_moist_avg, day FROM thong_so_moi_truong GROUP BY day ";
    
    // $data['soil_moist'] = $db->fetchSql($sql_soil_moist);

 

    for($i = 0 ; $i < count($data_tem) ; $i++){
        $data_tem[$i][1] = (int)$data_tem[$i][1];
    }

    $data = json_encode($data_tem);
    // _debug($data);
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
        type: 'column'
    },
    title: {
        text: '<p style="font-size:22px;font-family:cursive;">Biểu đồ tổng sản phẩm của từng danh mục</p>'
    },
    subtitle: {
        text: 'Source: <a style="color:blue" href="../index.php">Admin đẹp trai</a>'
    },
    xAxis: {
        type: 'category',
        title: {
            text: '<p style="font-weight:bold;font-size:20px;">Danh mục</p>'
        },
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '<p style="font-weight:bold;font-size:20px;">Tổng sản phẩm</p>',

        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Nhiệt độ trung bình : <b>{point.y:.1f} ° C</b>'
    },
    series: [{
        name: 'Population',
        data: <?php echo $data ?>,
       

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
