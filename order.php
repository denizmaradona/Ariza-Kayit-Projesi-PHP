<?php include 'login-header.php'; ?>
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
                                        <?php
                                        	include 'dbsettings.php';
                                        	$result = mysqli_query($connection,
     										"CALL marka_combobox()") or die("Query fail: " . mysqli_error());

                                            echo '<select name="markalar" class="form-control phones selectpicker onChange="changeTest(this)" data-container="body">';
                                            while ($row = mysqli_fetch_array($result)){
                                            	echo '<option value = '.$row["marka"].'>'.$row["marka"].'</option>';
                                            }
                                            echo '</select>';

                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">
                                        <?php
                                        	$result = mysqli_query($connection,
     										"CALL model_combobox('$marka')") or die("Query fail: " . mysqli_error());

     										echo '<select name="modeller" class="form-control models iphone active selectpicker" data-container="body">';
     										while($row = mysqli_fetch_array($result)){
     											echo '<option value = '.$row["model"].'>'.$row["model"].'</option>';
     										}
     										echo '<select/>';
                                        ?>

                                        </div>
                                    </div>
                                </div>
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