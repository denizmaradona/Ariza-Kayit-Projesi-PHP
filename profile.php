<?php   include 'login-header.php';
		include 'dbsettings.php';

		if (isset($_POST["guncelle"])){
			$ad = $_POST["ad"];
			$soyad = $_POST["soyad"];
			$eposta = $_POST["eposta"];
			$cep_tel = $_POST["cep_tel"];
			$adres = $_POST["adres"];
			$dogum_tarih = $_POST["dogum_tarih"];

			$result = mysqli_query($connection,"CALL kisisel_bilgileri_guncelle('$ad','$soyad','".$_SESSION['eposta']."','$eposta','$cep_tel','$dogum_tarih','$adres')") or die("Query fail: " . mysqli_error());
            if ($result){
                $_SESSION["eposta"] = $eposta;
            }
		}

		else if(isset($_POST["sil"])){
            $sifre = $_POST["sifre"];
            $result = mysqli_query($connection,"CALL hesabi_sil('".$_SESSION['eposta']."','$sifre',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);
            
            if ($row[@bilgi]=="silindi"){
                die("<script>location.href = 'index.php'</script>");
            }
            else if ($row[@bilgi]=="silinemez"){

            }
            else if ($row[@bilgi]=="hatali sifre"){

            }
		}
        
        else if(isset($_POST["degistir"])){
            if ($_POST["yeni_sifre"]==$_POST["yeni_sifre_tekrar"]){
                $result = mysqli_query($connection,"CALL sifre_degistir('".$_SESSION['eposta']."','".$_POST["yeni_sifre"]."')") or die("Query fail: " . mysqli_error());
            }
        }
?>

    <div class="page-wrapper profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Profil Bilgileriniz</h1>
                    <form action="" method="post">
                        <?php
                            $result = mysqli_query($connection,
                            "CALL kisisel_bilgileri_cek('".$_SESSION["eposta"]."')") or die("Query fail: " . mysqli_error());
                            $row = mysqli_fetch_array($result);
                        ?>
                        <div class="col-xs-12 col-md-8">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>Adınız</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <input name ="ad" class="form-control" type="text" value=<?php echo $row[0]?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>Soyadınız</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <input name="soyad" class="form-control" type="text" value=<?php echo $row[1]?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>E-Posta Adresiniz</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <input name="eposta" class="form-control" type="text" value=<?php echo $_SESSION['eposta']?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>Telefon</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <input name="cep_tel" class="form-control" type="text" value=<?php echo $row[2]?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>Adres</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <?php echo "<input name ='adres' class='form-control' type='text' value='" . $row[4] . "'>" ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <h3>Doğum Tarihiniz</h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <input name="dogum_tarih" type="text" class="form-control datepicker" data-provide="datepicker" placeholder="Gün/Ay/Yıl" value=<?php echo $row[3]?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-4">
                                        <button type="submit" class="btn btn-success" name="guncelle"><i class="fa fa-refresh"></i> Bilgileri Güncelle</button>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#change-password-modal"><i class="fa fa-random"></i> Şifremi Değiştir</a>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-account-modal"><i class="fa fa-trash-o"></i> Hesabımı Sil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p class="lead">Hesabınız <strong>kalıcı</strong> olarak silinecektir. Bu işlem geri döndürülemez. Emin misiniz?</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Şifrenizi giriniz" name="sifre">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Evet" name="sil">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Şifremi Değiştir</h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Yeni Şifreniz" name="yeni_sifre">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Yeni Şifreniz Tekrar" name="yeni_sifre_tekrar">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Değiştir" name="degistir">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Successful Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Güncelleme Başarılı</h4>
                    <h4 class="modal-title" id="myModalLabel">Güncelleme Başarısız</h4>
                </div>
                <div class="modal-body">
                    <div class="icon-wrapper">
                        <i class="fa fa-check-circle"></i>
                        <i class="fa fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>