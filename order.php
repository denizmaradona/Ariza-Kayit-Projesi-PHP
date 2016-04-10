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
                                    <input type="submit" class="btn btn-success btn-send" value="Gönder" name="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>