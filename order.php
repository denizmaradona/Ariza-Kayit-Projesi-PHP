<?php include 'login-header.php';
    echo '
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Arıza Kaydı Oluşturma</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <form action="">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">
                                        ';
                                            include 'dbsettings.php';
                                            $result = mysqli_query($connection,
                                            "CALL marka_combobox()") or die("Query fail: " . mysqli_error());

                                            echo '
                                            <form action="" method="post">
                                                <select id="marka" name="markalar" class="form-control selectpicker data-container="body">';
                                                while ($row = mysqli_fetch_array($result))
                                                    echo '<option value = '.$row["marka"].'>'.$row["marka"].'</option>';
                                                echo '</select>
                                            </form>
                                            ';

                                        echo '
                                        </div>
                                    </div>
                                </div>';
                                if (isset($_POST["ileri"])){
                                    echo '<div class="col-xs-6">
                                            <div class="info-content">
                                                <div class="form-group">';
                                                include 'dbsettings.php';
                                                $result = mysqli_query($connection,
                                                "CALL model_combobox('".$_POST["markalar"]."')") or die("Query fail: " . mysqli_error());

                                                echo '<select id="model" name="modeller" class="form-control selectpicker" data-container="body">';
                                                while($row = mysqli_fetch_array($result))
                                                    echo '<option value = '.$row["model"].'>'.$row["model"].'</option>';
                                                echo '</select>';
                                            echo '

                                        </div>
                                    </div>
                                </div>';}
                                echo '
                                <div class="col-xs-12">
                                    <div class="info-content">
                                        <div class="form-group">
                                            <textarea name="" id="" cols="30" rows="5" class="form-control" placeholder="Açıklamanız"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <input type="submit" class="btn btn-success" value="Gönder" name="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Successful Modal -->
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Kayıt İşlemi Başarılı</h4>
                    <h4 class="modal-title" id="myModalLabel">Kayıt İşlemi Başarısız</h4>
                </div>
                <div class="modal-body">
                    <div class="icon-wrapper">
                        <i class="fa fa-check-circle"></i>
                        <i class="fa fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    ';
?>
