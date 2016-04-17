<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>Telefon Arıza Kayıt Sistemi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/less" href="assets/css/main.less">

    <script src="https://cdn.jsdelivr.net/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/less/2.6.1/less.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/locales/bootstrap-datepicker.tr.min.js" charset="UTF-8"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3,respond@1.4.2"></script>
    <![endif]-->
    <script>
        jQuery(document).ready(function() {
            // Datepicker
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                clearBtn: true,
                language: "tr",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
    <script>less.watch();</script>
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".site-navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" class="img-responsive"></a>
                    </div>
                    <div class="collapse navbar-collapse site-navigation">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Ana Sayfa</a></li>
                            <li><a href="#">Hizmetler</a></li>
                            <li><a href="#">Hakkımızda</a></li>
                            <li><a href="#">S.S.S</a></li>
                            <li><a href="#">İletişim</a></li>
                        </ul>
                    </div>
                    <div class="phone-number pull-right hidden-xs">
                        <span><i class="fa fa-phone"></i>444 44 44</span>
                    </div>
                </div>
            </nav>
        </div>
    </header>