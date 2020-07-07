<html lang="en">
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
                                <form method="post" action="<?php echo base_url();?>Myir/updatefusc" class="form-horizontal">
                                    <?php
                                    if (isset($query[0]->kc_agency)){
                                    ?>
                                    <input type="text" name="agency" id="" value="<?php echo $query[0]->kc_agency;?>" hidden>
                                    <?php
                                    }else{
                                    ?>
                                    <input type="text" name="agency" id="" value="CUST" hidden>
                                    <?php
                                    }
                                    ?>
                                    <input type="text" name="agenta2" id="" value="<?php echo $query[0]->fu_agenta2;?>" hidden>
                                    <div class="card-header card-header-text" data-background-color="red">
                                        <h4 class="card-title">Follow Up</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Track ID</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="trackid" text="<?php  echo $query[0]->scbe_trackid;?>" value="<?php  echo $query[0]->scbe_trackid;?>" class="form-control" readonly required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Customer Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="cp" id="textinput1" type="text" value="<?php  echo $query[0]->scbe_custname;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Alamat</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <textarea name="alamat" id="textinput2" class="form-control" required readonly><?php  echo $query[0]->scbe_addressinst;?>
                                                    </textarea>
                                                    <!-- <input id="textinput2" type="text" value="<?php  echo $query[0]->scbe_addressinst;?>" class="form-control" value> -->
                                                    <span id="cek2" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Acuan Alamat</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <textarea name="alamat" id="textinput2" class="form-control" required readonly><?php  echo $query[0]->fu_acuanalamat;?>
                                                    </textarea>
                                                    <!-- <input id="textinput2" type="text" value="<?php  echo $query[0]->fu_acuanalamat;?>" class="form-control" value> -->
                                                    <span id="cek2" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Manja</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="cp" id="textinput1" type="text" value="<?php  echo $query[0]->fu_manja;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">K-Contact</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="cp" id="textinput1" type="text" value="<?php  echo $query[0]->scbe_kcontact;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Paket</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="cp" id="textinput1" type="text" value="<?php  echo $query[0]->scbe_package;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Nomor SC</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="scid" id="textinput1" placeholder="Sertakan huruf SC tanpa spasi & tanda hubung. Contoh: SC123456" type="text" value=<?php echo $query[0]->fusc_scid;?> class="form-control" required>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
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
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>
    </div>
</body>
<?php $this->load->view('template/footer.php');?>
<script>
$(document).ready(function() {
    md.initSliders();
    demo.initFormExtendedDatetimepickers();

    $('#dropdown1').change(function() {
    if( $(this).val() == 'val1') {
        $('#textinput1').prop( "readonly", true );
        $('#dropdown1').prop( "disabled", false );
        document.getElementById("cek1").innerHTML = "done";
    } else {       
        $('#textinput1').prop( "readonly", false );
        document.getElementById("cek1").innerHTML = "";
    }
    });

    $('#dropdown2').change(function() {
    if( $(this).val() == 'val1') {
        $('#textinput2').prop( "readonly", true );
        $('#dropdown2').prop( "disabled", false );
        document.getElementById("cek2").innerHTML = "done";
    } else {       
        $('#textinput2').prop( "readonly", false );
        document.getElementById("cek2").innerHTML = "";
    }
    });

    
        
});
</script>
</html>