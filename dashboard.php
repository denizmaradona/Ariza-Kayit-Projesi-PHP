<?php 
    include 'login-header.php';
    if (isset($_POST["sil"])){
        include 'dbsettings.php';
        $result = mysqli_query($connection,
        "CALL ariza_kaydini_sil('".$_SESSION['id']."',@bilgi)") or die("Query fail: " . mysqli_error());
        $row = mysqli_fetch_array($result);
        if ($row[@bilgi]=="silindi"){ // silindi
            $icerik = "Arıza Kaydınız Başarıyla Silinmiştir";
            $durum = true;
            ?>
            <script type="text/javascript">
                $(function(){

                    $('#success-modal').modal('show');
                })
            </script>
            <?php
        }
        else{ // silinemedi
            $icerik = "Arıza Kaydınız İşlem Aşamasında Olduğundan Dolayı Silinemez";
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
    else if (isset($_POST["gonder"])){
        $required = array('markalar','modeller','problem');
        $error = false;
        foreach ($required as $field) {
            if (empty($_POST[$field])){
                $error = true;
                break;
            }
        }
        if ($error){
            $icerik = "Arıza Kaydı Verirken Tüm Alanları Doldurduğunuza Emin Olunuz";
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
            $marka = $_POST["markalar"];
            $model = $_POST["modeller"];
            $problem = $_POST["problem"];

            include 'dbsettings.php';
            $result = mysqli_query($connection,
            "CALL ariza_kaydi_ver('".$_SESSION["eposta"]."','$marka','$model','$problem',@bilgi)") or die("Query fail: " . mysqli_error());
            $row = mysqli_fetch_array($result);
            if ($row[@bilgi]=="verildi"){
                $icerik = "Arıza Kaydınız Başarıyla Verilmiştir";
                $durum = true;
                ?>
                <script type="text/javascript">
                    $(function(){
                        $('#success-modal').modal('show');
                    })
                </script>
                <?php
            }
            else{

            }
        }
        
    }
?>
<?php
        include 'dbsettings.php';
		$result = mysqli_query($connection,
	    "CALL ariza_kayitlarini_goster('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());
	    $kayit_sayi=0;

	    while($row = mysqli_fetch_array($result)){
	    	$kayit_sayi++;
		}

		include'dbsettings.php';
    	$result = mysqli_query($connection,"CALL musteri_talepleri('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());
    	$talep_sayi=0;

    	while ($row = mysqli_fetch_array($result)){
    		$talep_sayi++;
    	}

	echo '<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">
                            Kullanıcı Paneli <small>Genel Bakış</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hoşgeldiniz!</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-edit fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right count">
                                                <div class="huge">'.$kayit_sayi.'</div>
                                                <div>Arıza Kayıtlarınız</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-support fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right count">
                                                <div class="huge">'.$talep_sayi.'</div>
                                                <div>Destek Talepleriniz</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                if ($kayit_sayi!=0){
                    echo '<div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit fa-fw"></i> Arıza Kayıtlarınız</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id = "tablo" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>İşlem Tarihi</th>
                                                <th>Telefon Marka</th>
                                                <th>Telefon Model</th>
                                                <th>Kayıt Durumu</th>
                                                <th>Kayıt Detayları</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            include 'dbsettings.php';
                                            $result = mysqli_query($connection,
                                            "CALL ariza_kayitlarini_goster('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());

                                            while($row = mysqli_fetch_array($result)) {
                                            echo
                                                '<form action="order-view.php" method="post">
                                                    <tr>
                                                        <input type="hidden" name="id" value="'.$row[0].'">
                                                        <td class="col-xs-2">'.$row[3].'</td>
                                                        <td class="col-xs-2">'.$row[1].'</td>
                                                        <td class="col-xs-2">'.$row[2].'</td>
                                                        <td class="col-xs-2">'.$row[5].'</td>
                                                        <td class="col-xs-2">
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
                    </div>
                </div>';
                }
                echo '
            </div>
        </div>
    </div>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    if ($durum == true){
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    else{
                        echo '<h4 class="modal-title" id="myModalLabel">'.$icerik.'</h4>';
                    }
                    echo '
                </div>
                <div class="modal-body">
                    <div class="icon-wrapper">';
                    if ($durum == true){
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