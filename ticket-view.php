<?php include 'login-header.php';
    if (isset($_POST["gonder"])){
        if (empty($_POST["mesaj"])){
            $icerik = "Mesaj Kısmı Boş Bırakılamaz";
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
            $mesaj = $_POST["mesaj"];
            include 'dbsettings.php';
            $result = mysqli_query($connection,
            "CALL kul_talep_cevapla('".$_SESSION['id']."','$mesaj','".$_SESSION['eposta']."',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);
            if ($row[@bilgi]=="iletildi"){
                $icerik = "Mesajınız Başarıyla İletildi";
                $durum = true;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                    </script>
                <?php
            }
            else if($row[@bilgi]=="iletilemez"){
                $icerik = "Mesajınızın İlk Önce Cevaplandırılmasını Bekleyiniz";
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
                $icerik = "Yanıtlama İşlemi Başarısız";
                $durum = false;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                    </script>
                <?php
            }
        }
    }
    else if (isset($_POST["goruntule"])){
            $_SESSION["id"] = $_POST["id"];
            $_SESSION["konu"] = $_POST["konu"];
    }
?>
<?php
    echo '<div class="page-wrapper">
            <div class="container-fluid">
                <div class="info-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="page-header">Talep Görüntüleme</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title ticket-title"><strong>Konu: '.$_SESSION["konu"].'</strong></h3>
                                </div>
                                <div class="panel-body">
                                    ';
                                    include 'dbsettings.php';
                                    $result = mysqli_query($connection,"CALL konusma_gecmis_goster('".$_SESSION['id']."')") or die("Query fail: " . mysqli_error());
                                    while ($row = mysqli_fetch_array($result)){
                                        if (strpos($row[0],'Temsil')===false){
                                            echo '
                                            <article>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-2">
                                                        <div class="article-heading">
                                                            <span>'.$row[0].'</span><br>
                                                            <time>'.$row[2].'</time>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-10">
                                                        <div class="article-body">
                                                            <p>'.$row[1].'</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>';
                                        }
                                        else{
                                            echo '
                                            <article class="text-right">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-10">
                                                        <div class="article-body">
                                                            <p>'.$row[1].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-2">
                                                        <div class="article-heading mtop">
                                                            <span>'.$row[0].'</span><br>
                                                            <time>'.$row[2].'</time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>';
                                        }
                                        $son_yazan = $row[0];
                                    }
                                    echo '
                                </div>
                            </div>
                        </div>
                    </div>';
                    if (strpos($son_yazan,'Temsil')!==false){
                        echo '
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <textarea name="mesaj" cols="30" rows="5" class="form-control ticket-textarea" placeholder="Açıklamanız"></textarea>
                                    </div>
                                </div>
                            </div>';}
                            echo '
                            <div class="row">
                                <div class="col-xs-12 col-md-2">
                                    <a href="support.php" class="btn btn-primary"><i class="fa fa-step-backward"></i> Geri Dön</a>
                                </div>';
                                if (strpos($son_yazan,'Temsil')!==false){
                                    echo '
                                <div class="col-xs-12 col-md-2 col-md-offset-2">
                                    <button type="submit" class="btn btn-success" name="gonder"><i class="fa fa-paper-plane-o"></i> Gönder</button>
                                </div>
                            </div>
                        </form>';
                    }
                    echo '
                </div>
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