<?php include 'header.php';
	include 'dbsettings.php';

	if(isset($_POST["kayit_ol"])){ // kayit oldugunda
		$ad = $_POST["ad"];
		$soyad = $_POST["soyad"];
		$eposta = $_POST["eposta"];
		$sifre = $_POST["sifre"];
		$dogum_tarih = $_POST["dogum_tarih"];
		$adres = $_POST["adres"];
		$cep_tel = $_POST["cep_tel"];

		$result = mysqli_query($connection,
     	"CALL kayit_ol('$eposta','$ad','$soyad','$sifre','$cep_tel','$dogum_tarih','$adres',@bilgi)") or die("Query fail: " . mysqli_error());

     	$row = mysqli_fetch_array($result);

     	if ($row[@bilgi]=="kayit basarili"){
     		header("Location:index.php");
     	}
     	else{
            header("Location:index.php");
     	}

	}

	else if(isset($_POST["giris_yap"])){ //giris icin
     	$eposta = $_POST["eposta"];
		$sifre = $_POST["sifre"];

		$result = mysqli_query($connection,
     	"CALL giris_yap('$eposta','$sifre',@bilgi)") or die("Query fail: " . mysqli_error());

     	$row = mysqli_fetch_array($result);

     	if ($row[@bilgi]=="kullanici girisi basarili"){
     		session_start();
     		$_SESSION["oturum"] = true;
     		$_SESSION["eposta"] = $eposta;
     		header("Location:dashboard.php");

     	}
     	else if($row[@bilgi]=="temsilci girisi basarili"){
            session_start();
            $_SESSION["oturum"] = true;
            $_SESSION["eposta"] = $eposta;
     		header("Location:admin-dashboard.php");
        }

        else { // kullanıcı adı veya şifre yanlış
            header("Location:index.php");
        }
    }
?>

<?php
		echo '<section class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div id="home-slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/img/iphone.png" class="img-responsive center-block">
                            </div>
                            <div class="item">
                                <img src="assets/img/nokia-lumia.png" class="img-responsive center-block">
                            </div>
                            <div class="item">
                                <img src="assets/img/asus-zenfone.png" class="img-responsive center-block">
                            </div>
                            <div class="item">
                                <img src="assets/img/samsung-galaxy.png" class="img-responsive center-block">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#home-slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                        <a class="right carousel-control" href="#home-slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="content-header">
                        <h1>Cep telefonunuz mu bozuldu ?</h1>
                    </div>
                    <div class="content-area">
                        <div class="info row">
                            <div class="info-inner">
                                <div class="col-xs-2">
                                    <i class="fa fa-cab"></i>
                                </div>
                                <div class="col-xs-10">
                                    <p>Siparişi verdiğiniz gün içinde ekiplerimiz ayağınıza gelsin, telefonunuzu teslim alsın.</p>
                                </div>
                            </div>
                            <div class="info-inner">
                                <div class="col-xs-2">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="col-xs-10">
                                    <p>Tamir esnasında yedekte kullanacağınız telefonunuzu teslim edilsin. İşleriniz aksamasın.</p>
                                </div>
                            </div>
                            <div class="info-inner">
                                <div class="col-xs-2">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="col-xs-10">
                                    <p>Arıza tespiti ardından, sizlerin onayı ile telefonunuzu tamir edip, en kısa sürede elinize ulaştıralım.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="content-header">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                <h1>Hemen Giriş Yapın</h1>
                            </div>
                        </div>
                    </div>
                    <div class="content-area">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="E-Posta Adresiniz" name="eposta">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Şifreniz" name="sifre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                    <div class="form-group">
                                        <input class="btn btn-login" type="submit" value="Giriş Yap" name="giris_yap">
                                        <a href="#" class="register" data-toggle="modal" data-target="#register-modal">Kayıt Ol</a>
                                        <a href="#" class="forgot">Şifremi Unuttum</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Kayıt Ol</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Adınız" name="ad">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Soyadınız" name="soyad">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="E-Posta Adresiniz" name="eposta">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Şifreniz" name="sifre">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Şifreniz Tekrar">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Telefon Numaranız" name="cep_tel">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" data-provide="datepicker" placeholder="Doğum Tarihiniz" name="dogum_tarih">
                                </div>
                                <div class="form-group">
                                    <textarea cols="30" rows="3" class="form-control" placeholder="Adres" name="adres"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-register" value="Kayıt Ol" name="kayit_ol">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

?>



<?php include 'footer.php'; ?>