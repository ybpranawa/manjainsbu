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
                                    <h4 class="card-title">Rekap Data FU A2 All</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Track ID</th>
                                                    <th>Order Date</th>
                                                    <th>Cust. Name</th>
                                                    <th>Witel</th>
                                                    <th>CP Valid</th>
                                                    <th>Alamat Valid</th>
                                                    <th>K-contact</th>
                                                    <th>Agency</th>
                                                    <th>STO</th>
                                                    <th>OK/NOK</th>
                                                    <th>Keterangan Verifikasi</th>
                                                    <th>Detil Verifikasi A2</th>
                                                    <th>Manja</th>
                                                    <th>Tindak Lanjut</th>
                                                    <th>Agent A2</th>
                                                    <th>Feedback Agency</th>
                                                    <th>SCID</th>
                                                    <th>Status PS</th>
                                                   
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no=1;
                                                foreach ($query as $row){
                                                    ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++;?></td>
                                                    <td><?php echo $row->scbe_trackid;?></td>
                                                    <td><?php echo $row->scbe_orderdate;?></td>
                                                    <td><?php echo $row->scbe_custname;?></td>
                                                    <td><?php echo $row->scbe_witel;?></td>
                                                    <td><?php echo $row->fu_validcp;?></td>
                                                    <td><?php echo $row->fu_alamat;?></td>
                                                    
                                                    <td><?php echo $row->scbe_kcontact;?></td>
                                                    <td><?php echo $row->agn_name;?></td>
                                                    <td><?php echo $row->scbe_sto;?></td>
                                                    <td><?php echo $row->oknok;?></td>
                                                    <td><?php echo $row->keterangana2;?></td>
                                                    <td><?php echo $row->fu_detilketerangan;?></td>
                                                    <td><?php echo $row->fu_manja;?></td>
                                                    <td><?php echo $row->feedback;?></td>
                                                    <td><?php echo $row->fu_agenta2;?></td>
                                                    <td><?php echo $row->feed_feedback;?></td>
                                                    <td><?php echo $row->fusc_scid;?></td>
                                                    <td><?php echo $row->ps_status;?></td>
                                                    <td class="td-actions text-right" width="20%">
                                                        <a href="editfua2/<?php echo $row->scbe_trackid;?>" class="btn btn-success btn-simple">
                                                            <i class="material-icons">edit</i>
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

                        <div class="col-md-12">
                            <div class="card">
                                
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Filter Follow Up</h4>
                                    <form method="post" action="filterrekapalla2" class="form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Tgl Mulai</label>
                                            <div class="col-sm-3">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="start" type="text" class="form-control datepicker" value required/>
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-left">Tgl Berakhir</label>
                                            <div class="col-sm-3">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="end" type="text" class="form-control datepicker" value required/>
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="display: none;">
                                            <div class="col-md-6">
                                                <legend>Sliders</legend>
                                                <div id="sliderRegular" class="slider"></div>
                                                <div id="sliderDouble" class="slider slider-info"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-fill btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Download</h4>
                                    <form method="post" action="downloaddata" class="form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Tgl Mulai</label>
                                            <div class="col-sm-3">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="start" type="text" class="form-control datepicker" value required/>
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-left">Tgl Berakhir</label>
                                            <div class="col-sm-3">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="end" type="text" class="form-control datepicker" value required/>
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="display: none;">
                                            <div class="col-md-6">
                                                <legend>Sliders</legend>
                                                <div id="sliderRegular" class="slider"></div>
                                                <div id="sliderDouble" class="slider slider-info"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-fill btn-success">Download</button>
                                            </div>
                                        </div>
                                    </form>
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