        <div class="sidebar" data-active-color="red" data-background-color="black" data-image="<?php echo base_url();?>assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="<?php echo base_url();?>" class="simple-text">
                    ManjainSBU
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="<?php echo base_url();?>" class="simple-text">
                ManjainSBU
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?php echo base_url();?>assets/img/faces/avatar.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <?php echo $_SESSION['username']; ?>
                            <b class="caret"></b>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url();?>Myir/gantipassword">Ganti Password</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/logout">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo base_url();?>Myir/dashboard">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <?php if($_SESSION['agency']=='AGN00001' || $_SESSION['agency']=='AGN00074' || $_SESSION['agency']=='AGN00075'){?>

                    <li>
                        <a data-toggle="collapse" href="#menuwitel">
                            <i class="material-icons">how_to_reg</i>
                            <p>Inbox Consumer
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="menuwitel">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url();?>Myir/uploaddata">Upload data SCBE</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/uploaddataps">Upload data PS</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/followupsc">Follow Up SC</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/rekapdatascbe">Rekap Data SCBE</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>

                    <?php }?>
                    <?php if($_SESSION['agency']=='AGN00001' || $_SESSION['agency']=='AGN00073' || $_SESSION['agency']=='AGN00075'){?>
                    <li>
                        <a data-toggle="collapse" href="#inboxa2">
                            <i class="material-icons">content_paste</i>
                            <p>Inbox A2
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="inboxa2">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url();?>Myir/praorder">Follow Up pra-order</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/sudahterfeedback">Sudah Terfeedback</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/rekapfu">Rekap Follow Up Per User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/rekapallfu">Rekap All Follow Up</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['agency']=='AGN00001' ||  ($_SESSION['agency']!='AGN00075' 
                    && $_SESSION['agency']!='AGN00075' && $_SESSION['agency']!='AGN00073' 
                    && $_SESSION['agency']!='AGN00074' && $_SESSION['agency']!='AGN00000'
                    && $_SESSION['agency']!='AGN00001' && $_SESSION['agency']!='AGN00002')){?>
                    <li>
                        <a data-toggle="collapse" href="#inboxagency">
                            <i class="material-icons">settings_backup_restore</i>
                            <p>Inbox Agency
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="inboxagency">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url();?>Myir/feedbackagency">Feedback Agency</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/rekapagency">Rekap Agency</a>
                                    
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if( $_SESSION['agency']=='AGN00001' ) {?>
                    <li>
                        <a data-toggle="collapse" href="#menuadmin">
                            <i class="material-icons">build</i>
                            <p>Menu Admin
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="menuadmin">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url();?>Myir/adduser">Add User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/edituser">Edit User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/addkcontact">Add K-contact</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/editkcontact">Edit K-contact</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/addagency">Add Agency</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>Myir/editagency">Edit Agency</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <!-- <div class="footercustom"><iframe src="https://open.spotify.com/embed/playlist/37i9dQZF1DWWQRwui0ExPn" width="100%" height="100%" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></div> -->
            </div>
            
        </div>