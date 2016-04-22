<?php include 'login-header.php';
?>

<?php
    include 'dbsettings.php';
    $talep_sayi=0;
    $result = mysqli_query($connection,"CALL musteri_talepleri('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());
    while ($row = mysqli_fetch_array($result)){
        $talep_sayi++;
    }
    if (isset($_POST["talep_olustur"])){
        $required = array('konu','mesaj');
        $error = false;
        foreach ($required as $field) {
            if (empty($_POST[$field])){
                $error = true;
                break;
            }
        }
        if ($error){
            $icerik = "Tüm Alanlar Doldurulmalıdır";
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
            $konu = $_POST["konu"];
            $mesaj = $_POST["mesaj"];

            include 'dbsettings.php';
            $result = mysqli_query($connection,
            "CALL talep_olustur('$konu','$mesaj','".$_SESSION['eposta']."',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);
            if ($row[@bilgi]=="basarili"){ //TALEP OLUSTURULDU
                $icerik = "Talebiniz Başarıyla Verilmiştir";
                $durum = true;
                ?>
                <script type="text/javascript">
                    $(function(){
                        
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
                $talep_sayi++;
            }
            else if($row[@bilgi]=="basarisiz"){ // TALEP OLUSTURULAMADI
                $icerik = "Beş Talepten Fazla Verilmez";
                $durum = false;
                ?>
                <script type="text/javascript">
                    $(function(){
                        
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
            else{//NEDENI BILINMIYOR

            }
        }

    }
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
                </div>';
                if ($talep_sayi!=0){
                    echo '<div class="row">
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
                                            if ($row[4]=="Cevaplandırıldı"){
                                                $i_class='fa fa-check-circle';
                                            }
                                            else{
                                                $i_class='fa fa-info-circle';
                                            }
                                            echo '
                                                    <form action="ticket-view.php" method="post">
                                                        <tr>
                                                            <input type="hidden" name="id" value="'.$row[0].'">
                                                            <td class="col-xs-2">'.$row[1].'</td>
                                                            <td class="col-xs-2">'.$row[2].'</td>
                                                            <td class="col-xs-2">'.$row[3].'<input type="hidden" name="konu" value="'.$row[3].'"></td>
                                                            <td class="col-xs-1"><i class="'.$i_class.'"></i>'.$row[4].'</td>
                                                            <td class="col-xs-1">
                                                                <button type="submit" class="btn btn-primary" name="goruntule"><i class="fa fa-eye"></i> Görüntüle</button>
                                                            </td>
                                                        </tr>
                                                    </form>';
                                        }

                                        echo '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                    if ($talep_sayi < 5){
                        $class="";
                    }
                    else{
                        $class="disabled";
                    }
                    echo '
                    <div class="col-xs-12 col-md-3">
                        <a href="#" class="btn btn-danger '.$class.'" data-toggle="modal" data-target="#support-modal"><i class="fa fa-plus-square-o"></i> Talep Oluştur</a>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    if ($durum){
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    else{
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    echo '
                    
                </div>
                <div class="modal-body">
                    <div class="icon-wrapper">';
                    if ($durum){
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








