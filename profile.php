<?php include 'login-header.php'; 
		include 'dbsettings.php';
		if (isset($_POST["guncelle"])){
			$ad = $_POST["ad"];
			$soyad = $_POST["soyad"];
			$eposta = $_POST["eposta"];
			$cep_tel = $_POST["cep_tel"];
			$adres = $_POST["adres"];
			$dogum_tarih = $_POST["dogum_tarih"];

			$result = mysqli_query($connection,"CALL kisisel_bilgileri_guncelle('$ad','$soyad','$eposta','$cep_tel','$dogum_tarih','$adres')") or die("Query fail: " . mysqli_error());			
		}
		else if(isset($_POST["sil"])){

		}

?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Profil Bilgileriniz</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <form action="" method="post">
                        <?php
                            $result = mysqli_query($connection, 
                            "CALL kisisel_bilgileri_cek('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());

                            $row = mysqli_fetch_array($result);

                        ?>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Adınız</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input name ="ad" class="form-control" type="text" value=<?php echo $row[0]?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Soyadınız</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input name="soyad" class="form-control" type="text" value=<?php echo $row[1]?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>E-Posta Adresiniz</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input name="eposta" class="form-control" type="text" value=<?php echo $_SESSION['eposta']?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Telefon</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input name="cep_tel" class="form-control" type="text" value=<?php echo $row[2]?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Adres</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <?php echo "<input name ='adres' class='form-control' type='text' value='" . $row[4] . "'>" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Doğum Tarihiniz</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input name="dogum_tarih" type="text" class="form-control datepicker" data-provide="datepicker" placeholder="Gün/Ay/Yıl" value=<?php echo $row[3]?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <input type="submit" class="btn btn-success btn-send" value="Bilgileri Güncelle" name="guncelle">
                                </div>
                                <div class="col-xs-12 col-md-3 col-md-offset-2">
                                    <input type="submit" class="btn btn-danger btn-send" value="Hesabı Sil" name="sil">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p>Hesabınız <strong>kalıcı</strong> olarak silinecektir. Bu işlem geri döndürülemez. Emin misiniz?</p>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" data-dismiss="modal" value="Evet" name="">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>