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