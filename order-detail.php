<?php 
    include 'login-header.php';
    include 'dbsettings.php';
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
                                <h3 class="panel-title"><strong>Arıza No #</strong> '.$_SESSION["id"].'</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Durum</th>
                                                <th>Detay</th>
                                                <th>İşlem Tarihi</th>
                                                <th>Ücret</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            $result = mysqli_query($connection,
                                            "CALL durum_gecmis_goster('".$_SESSION['id']."')") or die("Query fail: " . mysqli_error());
                                            $onay='';
                                            while ($row = mysqli_fetch_array($result)){
                                                echo '
                                                <tr>
                                                    <td class="col-xs-2">'.$row[0].'</td>
                                                    <td class="col-xs-6">'.$row[1].'</td>
                                                    <td class="col-xs-2">'.$row[2].'</td>
                                                    <td class="col-xs-2"><i class="fa fa-try"> '.$row[3].'</i></td>
                                                </tr>';
                                                $onay=$row[0];
                                            }
                                            include 'dbsettings.php';
                                            $result = mysqli_query($connection,
                                            "CALL toplam_maliyet('".$_SESSION['id']."',@toplam)") or die("Query fail: " . mysqli_error());
                                            $row = mysqli_fetch_array($result);
                                            echo '
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <a href="order-view.php" class="btn btn-primary"><i class="fa fa-step-backward"></i> Geri Dön</a>
                    </div>';
                    if (strpos($onay,'Arıza')!==false){ //Fiyat verildiyse
                        echo'
                    <div class="col-xs-12 col-md-2 col-md-offset-3">
                        <a href="#" class="btn btn-success center-block" data-toggle="modal" data-target="#confirm-modal1">Onaylıyorum</a>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <a href="#" class="btn btn-danger center-block" data-toggle="modal" data-target="#confirm-modal2">Onaylamıyorum</a>
                    </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped total-price">
                                    <tbody>
                                        <tr>
                                            <td><strong>Toplam Ücret:</strong></td>
                                            <td><i class="fa fa-try"> '.$row[@toplam].'</i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
                    }
                    else {
                        echo '
                        <div class="col-xs-12 col-md-3 col-md-offset-7">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped total-price">
                                    <tbody>
                                        <tr>
                                            <td><strong>Toplam Ücret:</strong></td>
                                            <td><i class="fa fa-try"> '.$row[@toplam].'</i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
                    }
                    echo '
                </div>
            </div>
        </div>
    </div>

    <!-- Onaylama Modal -->
    <div class="modal fade" id="confirm-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p>Emin misiniz?</p>
                </div>
                <div class="modal-footer">
                <form action="order-view.php" method="post">
                    <input type="submit" class="btn btn-success" name="onayla" value="Evet">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Onaylamama Modal -->
    <div class="modal fade" id="confirm-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p>Emin misiniz?</p>
                </div>
                <div class="modal-footer">
                <form action="order-view.php" method="post">
                    <input type="submit" class="btn btn-success" name="onaylama" value="Evet">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
?>