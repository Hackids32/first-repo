<?php
include "config/koneksi.php";
include "detect.php";
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JSC System | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to JSC System</h2>

                <p>
                    Silahkan masuk kedalam akun anda
                </p>

                <p>
                    IP Address:<br><?php echo $ipaddress; ?>
                </p>

                <p>
                    OS:<br><?php echo $os; ?>
                </p>

                <p>
                    Browser:<br><?php echo $browser; ?>, <?php echo $agent; ?>
                </p>

                <p>
                    <small>Segala aktifitas anda tercatat oleh administrator</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="check" method="post">
                        <div class="form-group">
                            <label><i class="fa fa-user-circle-o" aria-hidden="true"></i> Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-key" aria-hidden="true"></i> Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html"><i class="fa fa-pencil" aria-hidden="true"></i> Create an account</a>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Jakarta Skin Center | Powered by Hackids & Jun's
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-<?php echo date('Y'); ?></small>
            </div>
        </div>
    </div>

</body>

</html>
