<?php include 'login-header.php';
    $_SESSION["id"] = $_POST["id"];
    echo '<div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Kayıt Güncelleme</h1>
                </div>
            </div>
            <form action="admin-order-detail.php" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Son Durum</label>';
                            include 'dbsettings.php';
                            $result = mysqli_query($connection,
                            "CALL durum_combobox()") or die("Query fail: " . mysqli_error());
                            echo
                            '
                                <select name="durumlar" class="form-control phones selectpicker" data-container="body">';
                                while ($row = mysqli_fetch_array($result)){
                                echo '<option value = "'.$row["durum"].'">'.$row["durum"].'</option>';
                                    }
                                 echo '
                                </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Arıza Detayı</label>
                            <input type="text" class="form-control" placeholder="Detay" name="detay">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Arıza Ücreti</label>
                            <input type="text" class="form-control" placeholder="Ücret" name="ucret">
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <button type="submit" class="btn btn-success" name="guncelle"><i class="fa fa-refresh"></i> Güncelle</button>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <a href="admin-all-orders.php" class="btn btn-danger"><i class="fa fa-ban"></i> İptal</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>';
?>

