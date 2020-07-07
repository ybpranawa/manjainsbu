<html lang="en">
<head>
    <?php $this->load->view('template/header.php');?>
</head>
<body>
    <?php if(!isset($result)){$result=-1;}?>
        <input type="text" id="valcounter" value="<?php echo $result; ?>" hidden>
    <div class="wrapper">
        <?php $this->load->view('template/menu.php'); ?>
        <div class="main-panel">
            <?php $this->load->view('template/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="post" action="<?php echo base_url();?>Myir/insertuser" class="form-horizontal">
                                    <div class="card-header card-header-text" data-background-color="red">
                                        <h4 class="card-title">Add User</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">User ID</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="username" value class="form-control" placeholder="Masukkan userid Mis. YBPRANAWA" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Password</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input type="password" name="passwd" value class="form-control" placeholder="Masukkan Massword" required>
                                                    <span id="cek1" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Nama</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating is-empty has-success">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="nama" value class="form-control" placeholder="Nama Lengkap Mis. YOGA PRANAWA" required>
                                                    <span id="cek2" class="material-icons form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                       

                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Agency</label>
                                            <div class="col-sm-8">
                                                <select name="agency" id="dropdown3" class="selectpicker" data-style="btn btn-success btn-round" title="Pilih Agency" data-size="7" required>
                                                    <?php foreach ($query as $row){
                                                        echo "<option value='".$row->agn_id."'>$row->agn_name</option>";
                                                    }?>
                                                    
                                                </select>
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
</script>

<script type="text/javascript">
var x=document.getElementById("valcounter").value;
$(document).ready(function(){
    
    if (x>0){
        swal({
            title: "Sukses!",
            text: "Jumlah data dimasukkan : "+x,
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "success"
        });
    }
    else if(x==0){
        swal({
            title: "Gagal!",
            text: "Terjadi duplikasi data",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "error"
        });
    }
    x=-1;
    
});
</script>

</html>