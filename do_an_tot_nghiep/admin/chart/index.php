<?php 
    
   require_once "../libraries/database.php";
   require_once"../libraries/function.php";
   $db = new database;

   $categories = $db->fetchAll_condition('category'," deleted_at=0");
   $list_id = $list_name = [];
   foreach($categories as $item){
        array_push($list_id,$item['id']);
        array_push($list_name,$item['name']);
   }


   $count_product = array_map(function($id){
        global $db;
        $sql = "SELECT SUM(number) as count FROM products WHERE category_id = $id ";
        $result = $db->fetchSql_no_array($sql);
        return $result;
   },$list_id);

   
   $count_product = array_column($count_product, 'count');

    function run($a, $b)
    {
        return [$a,(int)$b];
    }

    $data = array_map('run', $list_name , $count_product);

    $data = json_encode($data);

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
                display: none;
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
        pointFormat: 'tổng sản phẩm : <b>{point.y:.1f} máy</b>'
    },
    series: [{
        name: 'Population',
        // data: [
        //     ['Shanghai', 24.2],
        //     ['Beijing', 20.8],
        //     ['Karachi', 14.9],
        //     ['Shenzhen', 13.7],
        //     ['Guangzhou', 13.1]
            
        // ],
        data : <?php echo $data ?>,

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
