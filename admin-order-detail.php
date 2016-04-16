<?php include 'login-header.php';
if (isset($_POST["guncelle"])){
    $durum = $_POST["durumlar"];
    $detay = $_POST["detay"];
    $ucret = $_POST["ucret"];
    $id = $_SESSION["id"];

    include 'dbsettings.php';
    $result = mysqli_query($connection,
    "CALL ariza_durum_guncelle('$id','$durum','$detay','$ucret')") or die("Query fail: " . mysqli_error());

}
else if(isset($_POST["goruntule"])){
    $id = $_POST["id"];
}
else
    $id = $_SESSION["id"];

    echo '<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">İşlem Geçmişi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Arıza No #</strong> '.$id.'</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Durum</th>
                                    <th>İşlem Tarihi</th>
                                    <th>Ücret</th>
                                </tr>
                                </thead>
                                <tbody>';
                                include 'dbsettings.php';
                                $result = mysqli_query($connection,
                                "CALL durum_gecmis_goster('$id')") or die("Query fail: " . mysqli_error());
                                while ($row = mysqli_fetch_array($result)){
                                    echo '
                                    <tr>
                                        <td class="col-xs-4">'.$row[0].'</td>
                                        <td class="col-xs-4">'.$row[2].'</td>
                                        <td class="col-xs-4"><i class="fa fa-try"></i> '.$row[3].'</td>
                                    </tr>';
                                }
                                include 'dbsettings.php';
                                $result = mysqli_query($connection,
                                "CALL toplam_maliyet('$id',@toplam)") or die("Query fail: " . mysqli_error());
                                $row = mysqli_fetch_array($result);
                                echo '
                                <tr>
                                    <td colspan="2"><strong>Toplam Ücret:</strong></td>
                                    <td colspan="1"><i class="fa fa-try"></i> '.$row[@toplam].'</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <a href="admin-all-orders.php" class="btn btn-primary"><i class="fa fa-step-backward"></i> Geri Dön</a>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>';
?>




