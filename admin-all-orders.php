<?php 
    include 'login-header.php';
    include 'dbsettings.php';
    $result = mysqli_query($connection,
    "CALL butun_ariza_kayitlarini_goster()") or die("Query fail: " . mysqli_error());
    $sayac = mysqli_num_rows($result);
?>
<?php
    echo '<div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Arıza Kayıtları</h1>
                </div>
            </div>
            ';
            if ($sayac!=0){
                echo '
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Arıza No #</th>
                                            <th>Durumu</th>
                                            <th>Telefon Markası</th>
                                            <th>Telefon Modeli</th>
                                            <th>Detay</th>
                                            <th>Olası Ücret</th>
                                            <th>Verilme Tarihi</th>
                                            <th>İşlem Geçmişi</th>
                                            <th>Kaydı Güncelle</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        include 'dbsettings.php';
                                        $result = mysqli_query($connection,
                                        "CALL butun_ariza_kayitlarini_goster()") or die("Query fail: " . mysqli_error());
                                        while($row = mysqli_fetch_array($result)){
                                            echo '
                                            <form method="post">
                                                <tr>
                                                    <td>'.$row[0].'<input type="hidden" name="id" value='.$row[0].'></td>
                                                    <td>'.$row[1].'</td>
                                                    <td>'.$row[2].'</td>
                                                    <td>'.$row[3].'</td>
                                                    <td>'.$row[4].'</td>
                                                    <td><i class="fa fa-try"></i>'.$row[6].'</td>
                                                    <td>'.$row[5].'</td>
                                                    <td><button type="submit" class="btn btn-primary" name="goruntule" formaction="admin-order-detail.php"><i class="fa fa-eye"></i> Görüntüle</button></td>';
                                                    if (strpos($row[1], "tespit edildi") || $row[1]=="Teslimat tamamlandı"){
                                                        $class="disabled";
                                                    }
                                                    else{
                                                        $class="";
                                                    }
                                                    echo '
                                                    <td><button type="submit" class="btn btn-success '.$class.'" name="guncelle" formaction="admin-order-update.php"><i class="fa fa-refresh"></i> Güncelle</button></td>
                                                </tr>
                                            </form>';
                                        }
                                        echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>'
            ;}
            echo '
        </div>
    </div>
</div>
</body>
</html>';
?>