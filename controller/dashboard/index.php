<?php
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    //ot propose
    $ot_propose = $koneksi->query("SELECT id_osc FROM overtime WHERE create_by = '$_SESSION[username]' AND stat_post = 'Propose'");
    $ot_propose_c = mysqli_num_rows($ot_propose);
    //ot pending
    $ot_pending = $koneksi->query("SELECT id_osc FROM overtime WHERE create_by = '$_SESSION[username]' AND stat_post = 'Pending'");
    $ot_pending_c = mysqli_num_rows($ot_pending);
    //ot posted
    $ot_posted = $koneksi->query("SELECT id_osc FROM overtime WHERE create_by = '$_SESSION[username]' AND stat_post = 'Posted'");
    $ot_posted_c = mysqli_num_rows($ot_posted);

    //lp propose
    $lp_propose = $koneksi->query("SELECT id_apps FROM leave_application WHERE created = '$_SESSION[username]' AND stat_leave = 'Propose'");
    $lp_propose_c = mysqli_num_rows($lp_propose);
    //lp pending
    $lp_pending = $koneksi->query("SELECT id_apps FROM leave_application WHERE created = '$_SESSION[username]' AND stat_leave = 'Pending'");
    $lp_pending_c = mysqli_num_rows($lp_pending);
    //lp posted
    $lp_posted = $koneksi->query("SELECT id_apps FROM leave_application WHERE created = '$_SESSION[username]' AND stat_leave = 'Posted'");
    $lp_posted_c = mysqli_num_rows($lp_posted);
?>
    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-danger float-right">Propose</span>
                        </div>
                        <h5>Overtime</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $ot_propose_c; ?></h1>
                        <small>OT Dibuat</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">Pending</span>
                        </div>
                        <h5>Overtime</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $ot_pending_c; ?></h1>
                        <small>Approve Pimpinan</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Posted</span>
                        </div>
                        <h5>Overtime</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $ot_posted_c; ?></h1>
                        <small>Approve HRD</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-danger float-right">Propose</span>
                        </div>
                        <h5>Leave Permit</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $lp_propose_c; ?></h1>
                        <small>Permit Dibuat</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">Pending</span>
                        </div>
                        <h5>Leave Permit</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $lp_pending_c; ?></h1>
                        <small>Approve Pimpinan</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Posted</span>
                        </div>
                        <h5>Leave Permit</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $lp_posted_c; ?></h1>
                        <small>Approve HRD</small>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php } ?>