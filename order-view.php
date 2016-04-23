<?php include 'login-header.php';
    if (isset($_POST["goruntule"])){
        $_SESSION["id"] = $_POST["id"];
    }
    else if(isset($_POST["onayla"])){
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL fiyati_onayla('".$_SESSION["id"]."')") or die("Query fail: " . mysqli_error());
    }
    else if(isset($_POST["onaylama"])){
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL fiyati_onaylama('".$_SESSION["id"]."')") or die("Query fail: " . mysqli_error());
    }
    else if(isset($_POST["guncelle"])){
        $marka = $_POST["markalar"];
        $model = $_POST["modeller"];
        $problem = $_POST["problem"];
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL ariza_bilgilerini_degistir('".$_SESSION["id"]."','$marka','$model','$problem',@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);
        if ($row[@bilgi]=="degistirildi"){

        }
        else{ //Degistirilemez

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
                                        <th>Durum</th>
                                        <th>Telefon Marka</th>
                                        <th>Telefon Model</th>
                                        <th>Detay</th>
                                        <th>Ücret</th>
                                        <th>Verilme Tarihi</th>
                                        <th>İşlem Geçmişi</th>
                                        <th>Kaydı Güncelle</th>
                                        <th>Kaydı Sil</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $durumlar = array("Onay bekliyor","Onaylanmadı","Teslimat tamamlandı");
                                    include 'dbsettings.php';
                                    $result = mysqli_query($connection,
                                    "CALL ariza_detay_goster('".$_SESSION['id']."')") or die("Query fail: " . mysqli_error());

                                    while($row = mysqli_fetch_array($result)) {
                                        echo '
                                            <tr>
                                                <td>'.$row[0].'</td>
                                                <td>'.$row[1].'</td>
                                                <td>'.$row[2].'</td>
                                                <td>'.$row[3].'</td>
                                                <td>'.$row[4].'</td>
                                                <td>'.$row[5].'</td>';
                                            if (in_array($row[0], $durumlar)){
                                                $class="";
                                            }
                                            else{
                                                $class="disabled";
                                            }
                                            echo'
                                                <td><a href="order-detail.php" class="btn btn-primary"><i class="fa fa-eye"></i> Görüntüle</a></td>
                                                <td><a href="order-update.php" class="btn btn-success '.$class.'"><i class="fa fa-refresh"></i> Güncelle</a></td>
                                                <td><a href="#" class="btn btn-danger btn-delete '.$class.'"><i class="fa fa-trash-o"></i> Sil</a></td>
                                            </tr>';
                                        }
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
</body>
</html>';
?>