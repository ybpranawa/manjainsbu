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
                                <form method="post" action="<?php echo base_url();?>Myir/dofollowup" class="form-horizontal">
                                    <?php
                                    if (isset($query[0]->kc_agency)){
                                    ?>
                                        <input type="text" name="agency" id="" value="<?php echo $query[0]->kc_agency;?>" hidden>
                                    <?php
                                    }else{?>
                                        <input type="text" name="agency" id="" value="CUST" hidden>
                                    <?php
                                    }
                                    ?>
                                    
                                    <div class="card-header card-header-text" data-background-color="red">
                                        <h4 class="card-title">Follow Up Track ID</h4>
                                    </div>
                                    <div class="card-content">
                                        
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Track ID</label>
                                            <div class="col-sm-7">

                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="trackid" text="<?php  echo $query[0]->scbe_trackid;?>" value="<?php  echo $query[0]->scbe_trackid;?>" class="form-control" readonly="readonly" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" >
                                            <label class="col-sm-2 label-on-left">Indikasi Dobel Input</label>
                                            <div class="col-sm-7">

                                                <div class="form-group label-floating is-empty" id="dobelinput">
                                                    <label class="control-label" ></label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-warning btn-block" onclick="cekvalidasi()">Cek Double Input</button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Nama</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="nama" id="textinput1" type="text" value="<?php  echo $query[0]->scbe_custname;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            
                                        </div>


                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Contact Person</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="cp" id="textinput1" type="text" value="<?php  echo $query[0]->scbe_cp;?>" class="form-control" value required readonly>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="isvalidcp" id="dropdown1" class="selectpicker" data-style="btn btn-success btn-round" title="Validate" data-size="7" required>
                                                    <option value="VAL001">Valid</option>
                                                    <option value="VAL002">CP RNA</option>
                                                    <option value="VAL003">Nomor Salah</option>
                                                </select>
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
                                            <div class="col-sm-3">
                                                <select name="isvalidalamat" id="dropdown2" class="selectpicker" data-style="btn btn-success btn-round" title="Validate" data-size="7" required>
                                                    <option value="VAL001">Valid</option>
                                                    <option value="VAL004">Alamat Salah</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Perkiraan alamat</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="acuanalamat" id="textinput" type="text" value class="form-control" value required>
                                                    <span id="cek" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">STO</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="sto" id="textinput3" type="text" value="<?php  echo $query[0]->scbe_sto;?>" class="form-control" value required >
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="isvalidsto" id="dropdown3" class="selectpicker" data-style="btn btn-success btn-round" title="Validate" data-size="7" required>
                                                    <option value="VAL001">Valid</option>
                                                    <option value="VAL015">NOK</option>
                                                </select>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Verifikasi A2</label>
                                            <div class="col-sm-7">
                                                
                                                <div class="col-sm-4">
                                                    <select name="oknok" id="dropdown" class="selectpicker" data-style="btn btn-success btn-round" title="OK/NOK" data-size="7" required>
                                                        <option value="VAL000">OK</option>
                                                        <option value="VAL015">NOK</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select name="keterangana2" id="dropdown" class="selectpicker" data-style="btn btn-success btn-round" title="Keterangan" data-size="7">
                                                        <option value="VAL005">Double Input MYIR</option>
                                                        <option value="VAL006">Ada Layanan Aktif</option>
                                                        <option value="VAL007">Ada Tunggakan</option>
                                                        <option value="VAL008">Pending</option>
                                                        <option value="VAL009">Batal Pasang</option>
                                                        <option value="VAL010">Sudah Ter SC</option>
                                                        <option value="VAL011">Sudah PS</option>
                                                        <option value="VAL012">Masuk CAM</option>
                                                        <option value="VAL013">BGES</option>
                                                        <option value="VAL014">Go Indi</option>
                                                        <option value="VAL017">Channel Lain</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select name="actioninputan" id="dropdown" class="selectpicker" data-style="btn btn-success btn-round" title="Tindak Lanjut" data-size="7" required>
                                                        <option value="VAL016">Lanjut SC</option>
                                                        <option value="VAL018">Butuh Feedback Agency</option>
                                                        <option value="VAL019">Drop Inputan</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Manajemen Janji</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="manja" type="text" class="form-control datetimepicker" value />
                                                    <span id="cek3" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Detail Keterangan A2</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input name="detilketa2" id="textinput" type="text" value class="form-control" value required>
                                                    <span id="cek" class="material-icons form-control-feedback"></span>
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
                                        
                                        <div class="row">
                                            <hr>
                                            <div class="col-md-6 col-md-offset-2">
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
    if( $(this).val() == 'VAL001') {
        $('#textinput1').prop( "readonly", true );
        $('#dropdown1').prop( "disabled", false );
        document.getElementById("cek1").innerHTML = "done";
    } else {       
        $('#textinput1').prop( "readonly", false );

        document.getElementById("cek1").innerHTML = "";
    }
    });

    $('#dropdown2').change(function() {
    if( $(this).val() == 'VAL001') {
        $('#textinput2').prop( "readonly", true );
        $('#dropdown2').prop( "disabled", false );
        document.getElementById("cek2").innerHTML = "done";
    } else {       
        $('#textinput2').prop( "readonly", false );

        document.getElementById("cek2").innerHTML = "";
    }
    });

    $('#dropdown3').change(function() {
    if( $(this).val() == 'VAL001') {
        $('#textinput3').prop( "readonly", true );
        $('#dropdown3').prop( "disabled", false );
        document.getElementById("cek3").innerHTML = "done";
    } else {       
        $('#textinput3').prop( "readonly", false );

        document.getElementById("cek3").innerHTML = "";
    }
    });
        
});
var BASE_URL = "<?php echo base_url();?>";
function cekvalidasi(){
    var trackid = $("input[name='trackid']").val();
    var cp = $("input[name='cp']").val();

    $.ajax({
        url: BASE_URL+"Myir/cekdobelinput",
        type: 'POST',
        data:{'trackid' : trackid,'cp':cp},
        // dataType : "html",
        // contentType:"application/x-www-form-urlencoded; charset=UTF-8",
        error: function() {
            alert("Sistem checking double input error, hubungi admin");
        },
        success: function(data) {
            if (data==0){
                $("#dobelinput").empty();
                $("#dobelinput").append("<div class='alert alert-success'><button type='button' aria-hidden='true' class='close'><i class='material-icons'>close</i></button><span><b> OK - </b> Inputan tidak terindikasi double input</span></div>");
                $("#dobelinput").append("<input type='hidden' name='doubleinput' value='NO' class='form-control' readonly required hidden>");
            }else{
                $("#dobelinput").empty();
                $("#dobelinput").append("<div class='alert alert-warning'><button type='button' aria-hidden='true' class='close'><i class='material-icons'>close</i></button><span><b> Terimakasih - </b> Sudah mengeklik tombol dobel input</span></div>");
                $("#dobelinput").append("<input type='hidden' name='doubleinput' value='YES' class='form-control' readonly required>");
            }
            
            // alert(data);  
        }
    });
}
</script>
</html>