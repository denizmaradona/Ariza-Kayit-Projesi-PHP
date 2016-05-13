<?php
    include 'login-header.php';

    if (isset($_POST["goruntule"])){
        $_SESSION["id"] = $_POST["id"];
    }
    else if(isset($_POST["onayla"])){
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL fiyati_onayla('".$_SESSION["id"]."')") or die("Query fail: " . mysqli_error());
        if ($result){
            $icerik = "Verilen Ücreti Başarıyla Onayladınız. Telefonunuz Kısa Bir Süre Sonra Onarım Aşamasına Geçecektir";
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

        }
    }
    else if(isset($_POST["onaylama"])){
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL fiyati_onaylama('".$_SESSION["id"]."')") or die("Query fail: " . mysqli_error());
        if ($result){
            $icerik = "Verilen Ücreti Onaylamadınız. Telefonunuz Kısa Bir Süre Sonra Kargoya Verilecektir";
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

        }

    }
    else if(isset($_POST["guncelle"])){
        $required = array('markalar','modeller','problem');
        $error = false;
        foreach ($required as $field) {
            if (empty($_POST[$field])){
                $error = true;
                break;
            }
        }
        if ($error){
            $icerik = "Tüm Alanların Doldurulduğuna Emin Olunuz";
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
            $marka = $_POST["markalar"];
            $model = $_POST["modeller"];
            $problem = $_POST["problem"];
            include 'dbsettings.php';
            $result = mysqli_query($connection,
            "CALL ariza_bilgilerini_degistir('".$_SESSION["id"]."','$marka','$model','$problem',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);
            if ($row[@bilgi]=="degistirildi"){
                $icerik = "Arıza Kaydınızı Başarıyla Güncellediniz";
                $durum = true;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                    </script>
                <?php
            }
            else{ //Degistirilemez

            }
        }

    }
?>
<?php
    echo '
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Arıza Kayıt Detayları</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Arıza No</th>
                                        <th>Durum</th>
                                        <th>Telefon Marka</th>
                                        <th>Telefon Model</th>
                                        <th>Problem</th>
                                        <th>Ücret</th>
                                        <th>Verilme Tarihi</th>
                                        <th>İşlem Geçmişi</th>
                                        <th>Kaydı Güncelle</th>
                                        <th>Kaydı Sil</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $durumlar = array("Onay bekliyor","Onaylanmadı","Teslimat tamamlandı"); // Silinebilecek durumlar
                                    include 'dbsettings.php';
                                    $result = mysqli_query($connection,
                                    "CALL ariza_detay_goster('".$_SESSION['id']."')") or die("Query fail: " . mysqli_error());

                                    $row = mysqli_fetch_array($result);
                                        echo '
                                            <tr>
                                                <td>'.$_SESSION["id"].'</td>
                                                <td>'.$row[0].'</td>
                                                <td>'.$row[1].'</td>
                                                <td>'.$row[2].'</td>
                                                <td>'.$row[3].'</td>
                                                <td>'.$row[4].'</td>
                                                <td>'.$row[5].'</td>';
                                            if (in_array($row[0], $durumlar)){
                                                $class_sil="";

                                            }
                                            else{
                                                $class_sil="disabled";
                                            }
                                            if ($row[0]=="Onay bekliyor"){ // Güncellenecek durum
                                                $class_guncelle = "";
                                            }
                                            else{
                                                $class_guncelle = "disabled";
                                            }
                                            echo'
                                                <td><a href="order-detail.php" class="btn btn-primary"><i class="fa fa-eye"></i> Görüntüle</a></td>
                                                <td><a href="order-update.php" class="btn btn-success '.$class_guncelle.'"><i class="fa fa-refresh"></i> Güncelle</a></td>
                                                <td><a href="#" class="btn btn-danger btn-delete '.$class_sil.'"><i class="fa fa-trash-o"></i> Sil</a></td>
                                            </tr>';
                                    echo '
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <a href="dashboard.php" class="btn btn-primary"><i class="fa fa-step-backward"></i> Geri Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p>Kaydı <b>silmek</b> istediğinize emin misiniz?</p>
                </div>
                <form action="dashboard.php" method="post">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" value="Evet" name="sil">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
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
</body>
</html>';
?>