<?php include 'login-header.php';
    $sayac=0;
    include 'dbsettings.php';
    $result = mysqli_query($connection,
    "CALL butun_ariza_kayitlarini_goster()") or die("Query fail: " . mysqli_error());
    while ($row = mysqli_fetch_array($result)){
        $sayac++;
    }
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
                                <table class="table table-bordered table-hover table-striped filtered">
                                    <thead>
                                        <tr>
                                            <th class="skip-filter">Arıza No #</th>
                                            <th class="skip-filter">Durum</th>
                                            <th>Telefon Marka</th>
                                            <th class="skip-filter">Telefon Model</th>
                                            <th class="skip-filter">Detay</th>
                                            <th class="skip-filter">Ücret</th>
                                            <th class="skip-filter">Verilme Tarihi</th>
                                            <th class="skip-filter">İşlem Geçmişi</th>
                                            <th class="skip-filter">Kaydı Güncelle</th>
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
                                                    <td><button type="submit" class="btn btn-primary" name="goruntule" formaction="admin-order-detail.php"><i class="fa fa-eye"></i> Görüntüle</button></td>
                                                    <td><button type="submit" class="btn btn-success" name="guncelle" formaction="admin-order-update.php"><i class="fa fa-refresh"></i> Güncelle</button></td>
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

