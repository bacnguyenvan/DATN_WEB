<?php 
    require_once "autoload/autoload.php";
    $active = 'control'; // to active menu


    $getSensorValue = $db->getLatest("thong_so_moi_truong");

    $read_sensor = true;  // include read_sensor.js file

?>

<?php require_once 'header.php' ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Chào mừng bạn đến với trang quản trị
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url(). "admin" ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row text-center">
                    <h1> Thông số môi trường</h1>
                    <p style="font-size: 25px">
                      <!-- <i class="fa fa-thermometer-half" style="font-size:3.0rem;color:#62a1d3;"></i>  -->
                      <span class="dht-labels">Nhiệt độ : </span> 
                      <span id="TemperatureValue"><?php if(!empty($getSensorValue)) echo $getSensorValue['nhiet_do']; else echo "0"; ?></span>
                      <sup class="units">&deg;C</sup>
                    </p>
                    <p style="font-size: 25px">
                      <!-- <i class="fa fa-tint" style="font-size:3.0rem;color:#75e095;"></i> -->
                      <span class="dht-labels">Độ ẩm đất : </span>
                      <span id="HumidityValue"><?php if(!empty($getSensorValue)) echo $getSensorValue['do_am']; else echo "0"; ?></span>
                      <sup class="units">%</sup>
                    </p>
                    <p>
                      <i class="far fa-clock" style="font-size:1.0rem;color:#e3a8c7;"></i>
                      <span style="font-size:2.0rem;"> </span>
                      <span id="time" style="font-size:2.0rem;"></span>
                      
                      <i class="far fa-calendar-alt" style="font-size:1.0rem;color:#f7dc68";></i>
                      <span style="font-size:2.0rem;"> </span>
                      <span id="date" style="font-size:2.0rem;"></span>
                    </p>
                </div>


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once 'footer.php' ?>    
