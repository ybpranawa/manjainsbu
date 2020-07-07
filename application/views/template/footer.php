
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/material.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/perfect-scrollbar.jquery.min.js')?>" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="<?php echo base_url('assets/js/jquery.validate.min.js')?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
<!--  Charts Plugin -->
<script src="<?php echo base_url('assets/js/chartist.min.js')?>"></script>
<!--  Plugin for the Wizard -->
<script src="<?php echo base_url('assets/js/jquery.bootstrap-wizard.js')?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js')?>"></script>
<!--   Sharrre Library    -->
<script src="<?php echo base_url('assets/js/jquery.sharrre.js')?>"></script>
<!-- DateTimePicker Plugin -->
<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js')?>"></script>
<!-- Vector Map plugin -->
<script src="<?php echo base_url('assets/js/jquery-jvectormap.js')?>"></script>
<!-- Sliders Plugin -->
<script src="<?php echo base_url('assets/js/nouislider.min.js')?>"></script>
<!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
<!-- Select Plugin -->
<script src="<?php echo base_url('assets/js/jquery.select-bootstrap.js')?>"></script>
<!--  DataTables.net Plugin    -->
<script src="<?php echo base_url('assets/js/jquery.datatables.js')?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?php echo base_url('assets/js/sweetalert2.js')?>"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?php echo base_url('assets/js/jasny-bootstrap.min.js')?>"></script>
<!--  Full Calendar Plugin    -->
<script src="<?php echo base_url('assets/js/fullcalendar.min.js')?>"></script>
<!-- TagsInput Plugin -->
<script src="<?php echo base_url('assets/js/jquery.tagsinput.js')?>"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url('assets/js/material-dashboard.js')?>"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js')?>"></script>

<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
        var agn=document.getElementById("sesagn").value;
        
        // alert(agn);
        if (agn=='AGN00073'){
            // notifa2();
            setInterval( notifa2, 6000 );
        }else if(agn=='AGN00074'){
            // notifcons();
            setInterval( notifcons, 6000 );
        }else if (agn=='AGN00075' || agn=='AGN00001' || agn=='AGN00002'){
            // notifwitel();
            setInterval( notifwitel, 6000 );
        }else{
            // notifagency();
            setInterval( notifagency, 6000 );
        }
        // setInterval( notification, 5000 );
    });

    function notifyagency(jumlah){
        $.notify({
            message: jumlah+" data butuh di feedback, klik untuk melihat",
            url: "feedbackagency"
            
        },{
            type: "success",
            newest_on_top: true
        },{
            delay:"100"
        });
    }

    function notifya2(jumlah){
        $.notify({
            message: jumlah+" data butuh update, klik untuk melihat",
            url: "sudahterfeedback"
            
        },{
            type: "success",
            newest_on_top: true
        },{
            delay:"100"
        });
    }

    function notifycons(jumlah){
        $.notify({
            message: jumlah+" data butuh Follow Up, klik untuk melihat",
            url: "followupsc"
            
        },{
            type: "success",
            newest_on_top: true
        },{
            delay:"100"
        });
    }
    
    function notifagency(){
        $(function(){
            var base_url=document.getElementById("base").value;
            $.ajax({
                type: 'GET',
                url: base_url+'Myir/getnotifagency',
                dataType: 'JSON',
                success: function(response) {
                    if (response.length>0){
                        notifyagency(response.length);
                    }
                },
                error: function (response) {
                    
                }
            });
        });
    }


    function notifa2(){
        $(function(){
            var base_url=document.getElementById("base").value;
            
            $.ajax({
                type: 'GET',
                url: base_url+'Myir/getnotifa2',
                dataType: 'JSON',
                // cache: false,
                success: function(response) {
                    
                    if (response.length>0){
                        notifya2(response.length);
                    }
                },
                error: function (response) {
                    
                }
            });
        });
    }

    function notifcons(){
        $(function(){
            // alert('tes 5 detik CONS');
            $(function(){
                var base_url=document.getElementById("base").value;
                $.ajax({
                    type: 'GET',
                    url: base_url+'Myir/getnotifcons',
                    dataType: 'JSON',
                    // cache: false,
                    success: function(response) {
                        
                        if (response.length>0){
                            notifycons(response.length);
                        }
                    },
                    error: function (response) {
                        
                    }
                });
            });
        });
    }

    function notifwitel(){
        $(function(){
            // alert('tes 5 detik WITEL');
        });
    }

    function clearNotif(){
        var agn=document.getElementById("sesagn").value;
        var base_url=document.getElementById("base").value;
        
        $.ajax({
            type: 'POST',
            url: base_url+'Myir/clearnotif',
            data: 'agency='+agn,
            success:function(m){
                $('#jmlnotif').empty();
                var jmlnotif=0;
                $('#jmlnotif').append(jmlnotif);
            },
            error:function(m){
            }
        });
    }
    

</script>