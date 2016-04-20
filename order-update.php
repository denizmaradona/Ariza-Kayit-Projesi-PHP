<?php include 'login-header.php';
    if (isset($_POST[""]))
?>
<?php 
    echo '<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Kayıt Güncelleme</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">';
                                            include 'dbsettings.php';
                                            $result = mysqli_query($connection,
                                            "CALL marka_combobox()") or die("Query fail: " . mysqli_error());
                                            echo '
                                            <form action="" method="post">
                                                <select id="marka" name="markalar" class="form-control selectpicker data-container="body" onchange="if(this.value != 0) {this.form.submit(); }">';
                                                while ($row = mysqli_fetch_array($result)){
                                                    
                                                    if ($_POST["markalar"] == $row["marka"]){
                                                        echo '<option selected="true" value = '.$row["marka"].'>'.$row["marka"].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value = '.$row["marka"].'>'.$row["marka"].'</option>';
                                                    }
                                                    
                                                }
                                                echo '</select>
                                            </form>';
                                            echo '
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">';
                                            if (isset($_POST["markalar"])){
                                            
                                                include 'dbsettings.php';
                                                $result = mysqli_query($connection,
                                                "CALL model_combobox('".$_POST["markalar"]."')") or die("Query fail: " . mysqli_error());

                                                echo '<select id="model" name="modeller" class="form-control selectpicker" data-container="body">';
                                                while($row = mysqli_fetch_array($result))
                                                    echo '<option value = "'.$row["model"].'">'.$row["model"].'</option>';
                                                echo '
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="info-content">
                                                        <div class="form-group">
                                                            <textarea name="problem" id="" cols="30" rows="5" class="form-control" placeholder="Açıklamanız"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <button type="submit" class="btn btn-success" name="guncelle" formaction="order-view.php">Gönder</button>
                                                </div>
                                                    ';  
                                        }
                                                                                                                  
                                        else echo '                                            
                                        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
?>
        