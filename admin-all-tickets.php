<?php include 'login-header.php'; 
    echo '<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">Destek Talepleri</h1>
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
                                        <th class="skip-filter">Talep No #</th>
                                        <th class="skip-filter">Oluşturan</th>
                                        <th class="skip-filter">Son Yazan</th>
                                        <th class="skip-filter">Talep Tarihi</th>
                                        <th class="skip-filter">Son İşlem Tarihi</th>
                                        <th class="skip-filter">Konu</th>
                                        <th>Durum</th>
                                        <th class="skip-filter">Talebi Görüntüle</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                include 'dbsettings.php';
                                $result = mysqli_query($connection,"CALL talepleri_goster()") or die("Query fail: " . mysqli_error());
                                        
                                while ($row = mysqli_fetch_array($result)){
                                    if ($row[6]=="Cevaplandırıldı")
                                        $i_class='fa fa-check-circle';
                                        
                                    else
                                        $i_class='fa fa-info-circle';
                                    
                                    echo '
                                    <form action="admin-ticket-view.php" method="post">
                                        <tr>
                                            <td class="col-xs-1">'.$row[0].'<input type="hidden" name="id" value="'.$row[0].'"</td>
                                            <td class="col-xs-1">'.$row[1].'</td>
                                            <td class="col-xs-1">'.$row[2].'</td>
                                            <td class="col-xs-2">'.$row[3].'</td>
                                            <td class="col-xs-2">'.$row[4].'</td>
                                            <td class="col-xs-2">'.$row[5].'</td>
                                            <td class="col-xs-2"><i class="'.$i_class.'"></i>'.$row[6].'</td>
                                            <td class="col-xs-1"><input type="submit" value="İncele" name="incele" class="btn btn-primary"></td>
                                        </tr>
                                    </form>
                                    ';
                                }
                                echo '</tbody>
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

