<?php include 'login-header.php';
    if (isset($_POST["gonder"])){
        $mesaj = $_POST["mesaj"];
        include 'dbsettings.php';
        $result = mysqli_query($connection, 
        "CALL kul_talep_cevapla('".$_SESSION['id']."','$mesaj','".$_SESSION['eposta']."',@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);
        if ($row[@bilgi]=="iletildi"){

        }
        else{

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
                                    $result = mysqli_query($connection, 
                                    "CALL konusma_gecmis_goster('".$_SESSION['id']."')") or die("Query fail: " . mysqli_error());
                                    while ($row = mysqli_fetch_array($result)){                                                        
                                                     
                                        if ($row['yazan']!='Müşteri Temsilcisi'){
                                            echo '      
                                                <article class="pull-left">
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
                                                <article class="pull-right text-right">
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
                                    }

                                    echo '
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <textarea name="mesaj" cols="30" rows="5" class="form-control ticket-textarea" placeholder="Açıklamanız"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-2">
                                <a href="support.php" class="btn btn-primary btn-send">Geri Dön</a>
                            </div>
                            <div class="col-xs-12 col-md-2 col-md-offset-2">
                                <input type="submit" class="btn btn-success btn-send" value="Gönder" name="gonder">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
?>

        