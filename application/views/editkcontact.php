<!doctype html>
<html>
<head>
    <?php $this->load->view('template/header.php');?>
</head>
<body>
    <div class="wrapper">
        <?php $this->load->view('template/menu.php'); ?>
        <div class="main-panel">
            <?php $this->load->view('template/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Rekap Data SCBE</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>ID Kcontact</th>
                                                    <th>Nama</th>
                                                    <th>CP 1</th>
                                                    <th>CP 2</th>
                                                    <th>Email</th>
                                                    <th>Alamat</th>
                                                    <th>Agency</th>
                                                    <th>Mapping STO</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no=1;
                                                foreach ($query as $row){
                                                    ?>
                                                <tr>
                                                    <td class="text-center"> <?php echo $no++;?> </td>
                                                    <td> <?php echo $row->kc_id;?> </td>
                                                    <td> <?php echo $row->kc_name;?> </td>
                                                    <td> <?php echo $row->kc_cp;?> </td>
                                                    <td> <?php echo $row->kc_cp2;?> </td>
                                                    <td> <?php echo $row->kc_email;?> </td>
                                                    <td> <?php echo $row->kc_alamat;?> </td>
                                                    <td> <?php echo $row->agn_name;?> </td>
                                                    <td> <?php echo $row->kc_mappingsto;?> </td>
                                                    <td> <?php echo 'disable';?> </td> 
                                                </tr>

                                                <?php 
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                        <div class="row" style="display: none;">
                                            <div class="col-md-6">
                                                <legend>Sliders</legend>
                                                <div id="sliderRegular" class="slider"></div>
                                                <div id="sliderDouble" class="slider slider-info"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>

            </div>
        </div>
    </div>
</body>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders();
        demo.initFormExtendedDatetimepickers();
        
        var table = $('#datatables').DataTable( {
            scrollY:        "400px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            columnDefs: [
                { "width": '20px', 
                "targets": 0 }
            ],
            fixedColumns: false,
            fixedWidth: false
        } );
    } );
</script>
</html>

