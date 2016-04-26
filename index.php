<?php 
    include 'header.php';
	include 'dbsettings.php';

	if(isset($_POST["kayit_ol"])){ // kayit oldugunda
        $required = array('ad', 'soyad', 'eposta', 'cep_tel', 'adres', 'dogum_tarih','sifre','sifre_tekrar');
        $error = false;
        foreach ($required as $field) {
            if (empty($_POST[$field])){
                $error = true;
                break;
            }
        }
        if ($error){
            $icerik = "Tüm Alanlar Doldurulmalıdır";
            $durum = false;
            ?>
            <script type="text/javascript">
                $(function(){
                    $('#success-modal').modal('show');
                })
                </script>
            <?php
        }
        else{
            if ($_POST["sifre"] == $_POST["sifre_tekrar"]){
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
                $durum = false;

                if ($row[@bilgi]=="kayit basarili"){
                    $icerik = "Kullanıcı Kaydınız Başarıyla Gerçekleşmiştir";
                    $durum = true;
                    ?>
                    <script type="text/javascript">
                        $(function(){

                            $('#success-modal').modal('show');
                        })
                    </script>
                    <?php
                }
                else{
                    $icerik = "E-mail kullanılmaktadır. Lütfen başka bir e-mail ile kayıt olunuz";
                    $durum = false;?>
                    <script type="text/javascript">
                        $(function(){
                            $('#success-modal').modal('show');
                        })
                    </script>
                    <?php
                }
            }
            else{
                $icerik = "Şifreler Birbiriyle Uyuşmuyor";
                $durum = false;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
            
        }
    }
    else if(isset($_POST["giris_yap"])){ //giris icin
        $required = array('eposta', 'sifre');
        $error = false;
        foreach ($required as $field) {
            if (empty($_POST[$field])){
                $error = true;
                break;
            }
        }
        if ($error){
            $icerik = "E-mail veya Şifre Boş Bırakılamaz";
            $durum = false;
            ?>
            <script type="text/javascript">
                $(function(){
                    $('#success-modal').modal('show');
                })
            </script>
            <?php
        }
        else{
            $eposta = $_POST["eposta"];
            $sifre = $_POST["sifre"];

            $result = mysqli_query($connection,
            "CALL giris_yap('$eposta','$sifre',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);

            if ($row[@bilgi]=="kullanici girisi basarili"){
                session_start();
                $_SESSION["eposta"] = $eposta;
                $_SESSION["rank"] = 1;

                include 'dbsettings.php'; // isim cekilmesi
                $result = mysqli_query($connection,
                "CALL isim_cek('$eposta',@kul_isim)") or die("Query fail: " . mysqli_error());
                $row = mysqli_fetch_array($result);
                $_SESSION["isim"] = $row[@kul_isim];

                header("Location:dashboard.php");
            }
            else if($row[@bilgi]=="temsilci girisi basarili"){
                session_start();
                $_SESSION["eposta"] = $eposta;
                $_SESSION["rank"] = 2;
                header("Location:admin-dashboard.php");
            }

            else { // kullanıcı adı veya şifre yanlış
                $icerik = "Girdiğiniz Kullanıcı Adı veya Şifre Yanlış!";
                $durum = false;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
        }
        
    }
    else if(isset($_POST["gonder"])){
        $eposta = $_POST["eposta"];
        $result = mysqli_query($connection,
        "CALL sifre_unuttum('$eposta',@sifre,@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);

        if ($row[@bilgi]=="kullanici var"){
            include 'mail-config.php';
            $mail -> Subject = "Bilgilendirme";
            $mail -> Body = 'Şifreniz : '.$row[@kul_sifre];
            $mail -> AddAddress($eposta);

            if (!$mail->Send()){ //mail gönderilemedi
                $icerik = "E-mail gönderilemedi";
                $durum = false;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
            else{   // mail gönderildi
                $icerik = "Şifreniz Belirtilen E-mail Adresine Gönderilmiştir. Lütfen Gelen Kutunuza Bakınız";
                $durum = true;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
        }
        else{ // sistemde böyle bir mail mevcut değil
            $icerik = "Sistemde Böyle Bir E-maile Ait Kayıt Bulunamadı";
            $durum = false;
            ?>
            <script type="text/javascript">
                $(function(){
                    $('#success-modal').modal('show');
                })
            </script>
            <?php
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
                                        <button class="btn btn-login" type="submit" name="giris_yap">Giriş Yap</button>
                                        <a href="#" class="register" data-toggle="modal" data-target="#register-modal">Kayıt Ol</a>
                                        <a href="#" class="forgot" data-toggle="modal" data-target="#lost-password-modal">Şifremi Unuttum</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Register Modal -->
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
                                    <input type="password" class="form-control" placeholder="Şifreniz Tekrar" name="sifre_tekrar">
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
                                    <button type="submit" class="btn btn-register"  name="kayit_ol">Kayıt Ol</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    if ($durum == true){
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    else{
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    echo '
                </div>
                <div class="modal-body">
                    <div class="icon-wrapper">';
                    if ($durum == true){
                        echo '<i class="fa fa-check-circle"></i>';
                    }
                    else{
                        echo '<i class="fa fa-times-circle"></i>';
                    }
                    echo '
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lost Password Modal -->
    <div class="modal fade" id="lost-password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Şifremi Unuttum</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="E-Posta Adresinizi Giriniz" name="eposta">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-register" value="Gönder" name="gonder">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
?>
<?php include 'footer.php'; ?>