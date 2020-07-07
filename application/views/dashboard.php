<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:29:18 GMT -->
<head>
    <?php $this->load->view('template/header.php');?>
    <style>
        .ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
            stroke: #ff0303;
        }
        .ct-series-b .ct-bar, .ct-series-b .ct-line, .ct-series-b .ct-point, .ct-series-b .ct-slice-donut {
            stroke: #14ba3e;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('template/menu.php'); ?>
        <div class="main-panel">
            <?php $this->load->view('template/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">archive</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Inputan Hari Ini</p>
                                    <h3 class="card-title"><?php echo $jmlinputan[0]->jml;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i>
                                        <?php echo date('Y-m-d');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="rose">
                                    <i class="material-icons">assignment_turned_in</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Data FU Tim A2</p>
                                    <h3 class="card-title"><?php echo $jmlfua2[0]->jml;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> <?php echo date('Y-m-d');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">exit_to_app</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Data FU SC</p>
                                    <h3 class="card-title"><?php echo $jmlfusc[0]->jml;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> <?php echo date('Y-m-d');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">how_to_vote</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Validitas Inputan</p>
                                    <h3 class="card-title"><?php echo number_format((float)$persenvalid,2,'.','').'%'; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> <?php echo date('Y-m-d');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="green">
                                    <i class="material-icons">language</i>
                                </div>
                                <div class="card-content " >
                                    <h4 class="card-title">Peringkat Agency Bulan <?php setlocale(LC_TIME, 'id_ID');echo strftime("%B",time());?></h4>
                                    <div class="row">
                                        <div class="col-md-8" style="overflow-y:auto;height: 400px;">
                                            <div class="table-responsive table-sales">
                                                <table class="table">
                                                    <thead>
                                                        <th>Ranking</th>
                                                        <th>Agency</th>
                                                        <th>Jml Input</th>
                                                        <th>Jml Valid</th>
                                                        <th>%Valid</th>
                                                        <th>PS</th>
                                                        <th>%PS</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $number=1;
                                                        // var_dump($ranking);
                                                        foreach ($ranking as $row){
                                                            // $agnname=$row->agn_name;
                                                            // echo $agnname."|";
                                                            if($number<=5){
                                                                echo "<tr>";
                                                            }else{
                                                                echo "<tr bgcolor='#fc5603'> ";
                                                            }
                                                            ?>
                                                                <td><?php echo $number;$number++; ?></td>
                                                                <td>
                                                                    <?php 
                                                                    if($row->agn_name==NULL){
                                                                        echo 'CHANNEL LAIN';
                                                                    }else{
                                                                        echo $row->agn_name; 
                                                                    }
                                                                    ?>
                                                                </td>
                                                                
                                                                <td class="text-right">
                                                                    <?php echo $row->jmlinputscbe; ?>
                                                                </td>
                                                                <?php
                                                                if ($row->jmlvalid<$row->jmlps){
                                                                    echo "<td class='text-right' bgcolor='#fca903'>";
                                                                }else{
                                                                    echo "<td class='text-right' >";
                                                                }
                                                                ?>
                                                                <!-- <td class="text-right"> -->
                                                                    <?php echo $row->jmlvalid; ?>
                                                                </td>

                                                                <td class="text-right">
                                                                    <?php echo number_format((float)$row->persen,2,'.','').'%'; ?>
                                                                </td>
                                                                <?php
                                                                if ($row->jmlvalid<$row->jmlps){
                                                                    echo "<td class='text-right' bgcolor='#fca903'>";
                                                                }else{
                                                                    echo "<td class='text-right' >";
                                                                }
                                                                ?>
                                                                <!-- <td class="text-right"> -->
                                                                    <?php echo $row->jmlps; ?>
                                                                </td>

                                                                <td class="text-right">
                                                                    <?php echo number_format((float)$row->persenps,2,'.','').'%'; ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <!-- <div id="worldMap" class="map"></div> -->
                                            <img src="<?php echo base_url();?>assets/img/podium.jpg" alt="">
                                            <table class="table">
                                                <tr>
                                                    <td bgcolor="#fc5603"></td>
                                                    <td>Zona tidak aman</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#fca903"></td>
                                                    <td>Indikasi bypass A2</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">insert_chart</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Input vs Valid
                                        <small>- Per STO</small>
                                    </h4>
                                </div>
                                <div id="multipleBarsChart" class="ct-chart"></div>
                                
                            </div>
                        </div>
                    </div>


                    
                    
                </div>
            </div>
            <?php $this->load->view('template/footerpage.php'); ?>
        </div>
    </div>

</body>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        // demo.initDashboardPageCharts();

        // demo.initVectorMap();

        // demo.initCharts();
    });
    var x={
        labels:[],
        series:[]
    };
    $.ajax({
        type: 'GET',
        url: 'getDataPerSO',
        dataType: 'JSON',
        async: false,
        // cache: false,
        success: function(response) {
            // alert(response[9].fu_sto);
            var dataarray1=[];
            var dataarray2=[];
            if (response.length>0){

                for (i=0;i<response.length;i++){
                    x.labels.push(response[i].fu_sto);
                    
                }
                for (i=0;i<2;i++){
                    
                    for (i=0;i<response.length;i++){
                        dataarray1.push(Number(response[i].input));
                        dataarray2.push(Number(response[i].valid));
                    }
                    x.series.push(dataarray1,dataarray2);
                }
                
                console.log(x.series);
            }
        },
        error: function (response) {
            alert(response.length);  
        }
    });
    // alert(x.labels);
    var dataMultipleBarsChart = {
            
            labels: ['BBE', 'GSK', 'KBL', 'KJR', 'KLN', 'KNN', 'KPS', 'KRP', 'LKI', 'LMG', 'MGO', 'TNS'],
            series: [
                [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
                [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
            ]
        };
        // alert(dataMultipleBarsChart.labels);
        console.log(dataMultipleBarsChart.series);
        var optionsMultipleBarsChart = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false,
            },
            axisY: {
                onlyInteger: true,
                scaleMinSpace: 1
            },
            height: '300px'
        };

        var responsiveOptionsMultipleBarsChart = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        var multipleBarsChart = Chartist.Bar('#multipleBarsChart', x, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(multipleBarsChart);
</script>

<script type="text/javascript">
$(document).ready(function(){
    swal({
        title: "HAI GAES",
        text: "<i>SELAMAT TAHUN BARU 2020</i> - <small>wish you all the best</small>",
        buttonsStyling: false,
        confirmButtonClass: "btn btn-success",
        confirmButtonText: "Siap",
        type: "success"
    });
});
</script>


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:16 GMT -->
</html>