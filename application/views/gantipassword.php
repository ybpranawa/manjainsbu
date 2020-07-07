<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:29:18 GMT -->
<head>
    <?php $this->load->view('template/header.php');?>
</head>

<body>
    <?php if(!isset($flag)){ $flag=-1; }?>
    <input type="text" id="valcounter" value="<?php echo $flag; ?>" hidden>
    <div class="wrapper">
        <?php $this->load->view('template/menu.php'); ?>
        <div class="main-panel">
            <?php $this->load->view('template/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">lock</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Password Lama</h4>
                                    <form class="form-horizontal" action="dogantipassword" method="post">
                                        <div class="row">
                                            <label class="col-md-3 label-on-left">Password Lama</label>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" name="passwordlama" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 label-on-left">Password Baru</label>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" name="passwordbaru1" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 label-on-left">Ulangi Password Baru</label>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" name="passwordbaru2" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3"></label>
                                            <div class="col-md-9">
                                                <div class="form-group form-button">
                                                    <button type="submit" class="btn btn-fill btn-success">Ubah Password</button>
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
            <?php $this->load->view('template/footerpage.php'); ?>
        </div>
    </div>
    
</body>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });
</script>
<script type="text/javascript">
var x=document.getElementById("valcounter").value;
$(document).ready(function(){
    
    if (x>0){
        swal({
            title: "Sukses!",
            text: "Password berhasil dirubah",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "success"
        });
    }
    else if(x==0){
        swal({
            title: "Gagal!",
            text: "Password gagal dirubah, pastikan password lama sesuai dan password baru sudah diulang 2x",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "error"
        });
    }
    x=-1;
    
});
</script>

<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:16 GMT -->
</html>