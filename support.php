<?php include 'login-header.php';
    include 'dbsettings.php';  
    if (isset($_POST["talep_olustur"])){
        $konu = $_POST["konu"];
        $mesaj = $_POST["mesaj"];

        $result = mysqli_query($connection, 
        "CALL talep_olustur('$konu','$mesaj','".$_SESSION['eposta']."',@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);
        if ($row[@bilgi]=="basarili"){ //TALEP OLUSTURULDU

        }
        else if($row[@bilgi]=="basarisiz"){ // TALEP OLUSTURULAMADI

        }
        else{//NEDENI BILINMIYOR
            
        }

         
    }
?>

<?php 
     
    echo '<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Destek Talebi</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Destek talepleriniz en kısa süre içerisinde cevaplandırılacaktır.</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-support fa-fw"></i> Talep Geçmişi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Talep No #</th>
                                                <th>Oluşturulma Tarihi</th>
                                                <th>Son İşlem Tarihi</th>
                                                <th>Konu</th>
                                                <th>Durum</th>
                                                <th>Talebi Görüntüle</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        include 'dbsettings.php';
                                        $result = mysqli_query($connection,"CALL musteri_talepleri('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());
                                        
                                        while ($row = mysqli_fetch_array($result)){
                                            echo '<tr>
                                                    <td class="col-xs-1">'.$row[0].'</td>
                                                    <td class="col-xs-1">'.$row[1].'</td>
                                                    <td class="col-xs-1">'.$row[2].'</td>
                                                    <td class="col-xs-3">'.$row[3].'</td>
                                                    <td class="col-xs-1"><i class="fa fa-info-circle"></i>'.$row[4].'</td>
                                                    <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                                </tr>';
                                        }
                                            
                                        echo '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <a href="#" class="btn btn-danger btn-ticket" data-toggle="modal" data-target="#support-modal">Talep Oluştur</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="support-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <form action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Talep Oluştur</h3>
                </div>
                
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Konu" name="konu">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea class="form-control" cols="30" rows="5" placeholder="Mesajınız" name="mesaj"></textarea>
                                </div>
                            </div>
                        </div>                       
                    </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Kaydet" name="talep_olustur">
                    <button type="button" class="btn btn-danger">Kapat</button>
                </div>
                </form>       
        </div>
    </div>
</div>
</body>
</html>';    
                                        
?>

        