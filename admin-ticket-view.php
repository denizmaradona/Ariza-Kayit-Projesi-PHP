<?php include 'login-header.php';
    if (isset($_POST["incele"])){
        $_SESSION["id"] = $_POST["id"];
    }
    else if (isset($_POST["gonder"])){
        $mesaj = $_POST["mesaj"];
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL admin_talep_cevapla('".$_SESSION["id"]."','$mesaj',@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);
        if($row[@bilgi]=="iletildi"){
            include 'dbsettings.php';
            $result = mysqli_query($connection, "select kullanici.email from kullanici, talep where talep.id='".$_SESSION["id"]."' and talep.kullanici_id = kullanici.id") or die ("Query fail: " .mysqli_error());
            if ($result){
                $row = mysqli_fetch_array($result);
                $eposta = $row[0];
                require_once 'class.phpmailer.php';
                $mail = new phpmailer();
                error_reporting(0);
                $mail -> IsSMTP();
                $mail -> SMTPDebug = 1;
                $mail -> SMTPAuth = true;
                $mail -> SMTPSecure = 'ssl';
                $mail -> Host = 'smtp.yandex.com.tr';
                $mail -> Port = 465;
                $mail -> IsHTML(true);
                $mail -> CharSet = 'utf-8';
                $mail -> Username = "iletisim@okanuzun.com";
                $mail -> Password = "135Okan246";
                $mail -> SetFrom("iletisim@okanuzun.com");
                $mail -> Subject = "Bilgilendirme";
                $mail -> Body = "#'".$_SESSION["id"]."' nolu talebiniz cevaplandırıldı";
                $mail -> AddAddress($eposta);

                if (!$mail->Send()){ //mail gönderildi

                }
                else{   // mail gönderilemedi

                }
            }
        }
        else if($row[@bilgi]=="iletilemez"){

        }
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
                            <h3 class="panel-title ticket-title"><strong>Konu: </strong>Telefonum söylenilen tarihte teslim edilmedi.</h3>
                            <span class="ticket-id pull-right">Talep No # '.$_SESSION["id"].'</span>
                        </div>
                        <div class="panel-body">';
                        include 'dbsettings.php';
                        $result = mysqli_query($connection,
                        "CALL konusma_gecmis_goster('".$_SESSION["id"]."')") or die("Query fail: " . mysqli_error());
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
            if (strpos($son_yazan,'Temsilci')===false){
                echo '
                <form action="" method="post">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <textarea name="mesaj" cols="30" rows="5" class="form-control ticket-textarea" placeholder="Açıklamanız"></textarea>
                        </div>
                    </div>
                </div>';
            }
                echo '
                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <a href="admin-all-tickets.php" class="btn btn-primary"><i class="fa fa-step-backward"></i> Geri Dön</a>
                    </div>';
                if (strpos($son_yazan,'Temsilci')===false){
                    echo '
                    <div class="col-xs-12 col-md-2 col-md-offset-2">
                        <button type="submit" class="btn btn-success" name="gonder"><i class="fa fa-paper-plane-o"></i> Gönder</button>
                    </div>
                    ';
                }
                    echo '
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>';
?>