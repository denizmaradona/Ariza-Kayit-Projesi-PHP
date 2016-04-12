<?php include 'login-header.php'; 
    
?>
<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
        document.getElementById('form1').submit();
    }
</script>
<?php 
    echo '<div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Arıza Kayıtları</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped filtered">
                                    <thead>
                                        <tr>
                                            <th class="skip-filter">Arıza No #</th>
                                            <th class="skip-filter">Durum</th>
                                            <th>Telefon Marka</th>
                                            <th class="skip-filter">Telefon Model</th>
                                            <th class="skip-filter">Detay</th>
                                            <th class="skip-filter">Ücret</th>
                                            <th class="skip-filter">Verilme Tarihi</th>
                                            <th class="skip-filter">İşlem Geçmişi</th>
                                            <th class="skip-filter">Kaydı Güncelle</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        include 'dbsettings.php';
                                        $result = mysqli_query($connection, 
                                        "CALL butun_ariza_kayitlarini_goster()") or die("Query fail: " . mysqli_error());
                                                
                                        while($row = mysqli_fetch_array($result)){
                                            echo '
                                            <form action="" method="post" id="form1"> 
                                                <tr>
                                                    <td>'.$row[0].'<input type="hidden" name="id" value="'.$row[0].'"></td>
                                                    <td>'.$row[1].'</td>
                                                    <td>'.$row[2].'</td>
                                                    <td>'.$row[3].'</td>
                                                    <td>'.$row[4].'</td>
                                                    <td><i class="fa fa-try"></i> '.$row[6].'</td>
                                                    <td>'.$row[5].'</td>'
                                                    ?>
                                                    <td><input type="button" class="btn btn-primary" value="Görüntüle" onclick="submitForm('admin-order-detail.php')"></td>
                                                    <td><input type="button" class="btn btn-success" value="Güncelle" onclick="submitForm('admin-order-update.php')"></td>
                                                </tr>
                                            </form>
                                            <?php
                                        }
                                        
                                        echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>';
?>

    