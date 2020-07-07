<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:29:18 GMT -->
<head>
    <?php $this->load->view('template/header.php');?>
</head>

<body>
    <?php if(!isset($counter)){ $counter=-1; }?>
    <input type="text" id="valcounter" value="<?php echo $counter; ?>" hidden>
    <div class="wrapper">
        <?php $this->load->view('template/menu.php'); ?>
        <div class="main-panel">
            <?php $this->load->view('template/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">cloud_upload</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Upload Data PS</h4>
                                    <form action="douploadps" method="post" enctype="multipart/form-data">
                                        <div class="fileinput fileinput-new text-center col-sm-4 col-sm-offset-4" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-danger btn-round btn-file">
                                                    <span class="fileinput-new">Select File</span>
                                                    <span class="fileinput-exists">Ubah</span>
                                                    <input type="file" name="datascbe" required accept=".xls,.xlsx" />
                                                </span>
                                                <a href="#pablo" class="btn btn-warning btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                            <button type="submit" class="btn btn-danger btn-simple btn-wd btn-lg">Upload!</button>
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
            text: "Jumlah data dimasukkan : "+x,
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "success"
        });
    }
    else if(x==0){
        swal({
            title: "Gagal!",
            text: "Terjadi duplikasi data atau kesalahan format",
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