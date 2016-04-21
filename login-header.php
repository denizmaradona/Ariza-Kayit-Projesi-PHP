<?php
    session_start();
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/less" href="assets/css/main.less">

    <script src="https://cdn.jsdelivr.net/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/less/2.6.1/less.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/locales/bootstrap-datepicker.tr.min.js" charset="UTF-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/js/bootstrap-select.min.js"></script>
    <script src="assets/js/ddtf.js"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3,respond@1.4.2"></script>
    <![endif]-->
    <script>less.watch();</script>
    <script>
        $(window).load(function() {
            $(".filtered").ddTableFilter();
        });

        jQuery(document).ready(function() {
            /*
            // Select Box Control
            $(".phones").on("change", function() {
                //remove active
                $(".models.active").removeClass("active");
                $(".models").css('cssText', 'display: none !important');
                var subList = $(".models select.models." + $(this).val());
                if (subList.length) {
                    subList.addClass("active");
                    subList.parent('.models').css('cssText', 'display: block !important');
                }
            });*/

            // Order Delete Control
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).closest('tr').data('id');
                $('#delete-modal').data('id', id).modal('show');
            });
            $('#delete-confirm').click(function() {
                var id = $('#delete-modal').data('id');
                $('[data-id=' + id + ']').remove();
                $('#delete-modal').modal('hide');
            });

            // Selectpicker
            $('.selectpicker').selectpicker({
                dropupAuto: true,
                size: 'false'
            });

            // Datepicker
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                clearBtn: true,
                language: "tr",
                todayHighlight: true,
                autoclose: true
            });

            // Price Check Control
            if ($('.table-responsive td:contains("Arıza tespit edildi ve fiyat verildi")').length > 0) {
                $('.page-wrapper .confirm,.page-wrapper .reject').css('cssText', 'display: block !important');
            }
            else {
                $('.page-wrapper .confirm,.page-wrapper .reject').css('cssText', 'display: none !important');
            }
            $('#confirm-modal .btn-success').mouseup(function() {
                $('.page-wrapper .confirm a,.page-wrapper .reject a').addClass('disabled');
            });

            $(function() {
                switch (window.location.pathname) {
                    case '/proje/dashboard.php':
                        $('.side-nav li:first-child').addClass('active');
                        break;
                    case '/proje/profile.php':
                        $('.side-nav li:nth-child(2)').addClass('active');
                        break;
                    case '/proje/order.php':
                        $('.side-nav li:nth-child(3)').addClass('active');
                        break;
                    case '/proje/support.php':
                        $('.side-nav li:nth-child(4)').addClass('active');
                        break;

                    case '/proje/dashboard.php':
                        $('.side-nav li:first-child').addClass('active');
                        break;
                    case '/proje/profile.php':
                        $('.side-nav li:nth-child(2)').addClass('active');
                        break;
                    case '/proje/order.php':
                        $('.side-nav li:nth-child(3)').addClass('active');
                        break;
                    case '/proje/support.php':
                        $('.side-nav li:nth-child(4)').addClass('active');
                        break;
                }
            });

            /* Admin Controls
            if ($('.navbar-brand:contains("Admin")').length > 0) {
                $('.admin').css('cssText', 'display: block !important');
                $('.customer').css('cssText', 'display: none !important');
            }
            else {
                $('.admin').css('cssText', 'display: none !important');
            }
            */
        });
    </script>
</head>
<?php 
    $rank = $_SESSION["rank"];

    echo '<body id="dashboard">
    <div class="wrapper">
        <header class="dashboard-header">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="dashboard.php">';if($rank==1){
                            echo 'Hoşgeldin '.$_SESSION["isim"];
                        }  
                        else echo 'ADMİN PANEL';
                        echo '</a>
                    </div>
                    <ul class="nav navbar-right top-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Hesabım <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="profile.php"><i class="fa fa-fw fa-user"></i>Profil</a>
                                </li>
                                <li>
                                    <a href="exit.php"><i class="fa fa-fw fa-power-off"></i>Çıkış</a>

                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-collapse sidebar-navigation collapse">
                        <ul class="nav side-nav">';
                        if ($rank == 1){
                            echo '
                            <li class="customer">
                                <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i>Kullanıcı Paneli</a>
                            </li>
                            <li class="customer">
                                <a href="profile.php"><i class="fa fa-fw fa-wrench"></i>Profil Bilgileriniz</a>
                            </li>
                            <li class="customer">
                                <a href="order.php"><i class="fa fa-fw fa-edit"></i>Arıza Kaydı Oluştur</a>
                            </li>
                            <li class="customer">
                                <a href="support.php"><i class="fa fa-fw fa-support"></i>Destek Talebi</a>
                            </li>
                            ';        
                        }
                        else{
                            echo '
                            <li class="admin">
                                <a href="admin-dashboard.php"><i class="fa fa-fw fa-dashboard"></i>Admin Paneli</a>
                            </li>
                            <li class="admin">
                                <a href="admin-users.php"><i class="fa fa-fw fa-users"></i>Kayıtlı Kullanıcılar</a>
                            </li>
                            <li class="admin">
                                <a href="admin-all-orders.php"><i class="fa fa-fw fa-cogs"></i>Arıza Kayıtları</a>
                            </li>
                            <li class="admin">
                                <a href="admin-all-tickets.php"><i class="fa fa-fw fa-support"></i>Destek Talepleri</a>
                            </li>
                            ';
                        }
                        echo '                            
                        </ul>
                    </div>
                </div>
            </nav>
        </header>';
?>
