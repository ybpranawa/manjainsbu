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
                                    <h4 class="card-title">Data User</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                <th class="text-center">No</th>
                                                    <th>Username</th>
                                                    <th>Nama</th>
                                                    <th>Unit/Agency</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no=1;
                                                foreach ($query as $row){
                                                    ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++;?></td>
                                                    
                                                    <td><?php echo $row->login_username;?></td>
                                                    <td><?php echo $row->login_nama;?></td>
                                                    <td><?php echo $row->agn_name; ?></td>
                                                    <td class="td-actions text-center" width="20%">
                                                        <a href="deleteuser/<?php echo $row->login_username;?>" class="btn btn-danger btn-simple">
                                                            <i class="material-icons">delete_forever</i>
                                                        </a>
                                                    </td>
                                                    
                                                </tr>

                                                <?php 
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
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