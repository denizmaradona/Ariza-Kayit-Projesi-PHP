<?php
    include 'login-header.php';
    include 'dbsettings.php';
    $result = mysqli_query($connection,
    "CALL kullanicilari_goster()") or die("Query fail: " . mysqli_error());

    echo '<div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Kayıtlı Kullanıcılar</h1>
                </div>
            </div>';
            if (mysqli_num_rows($result)!=0){
                echo '<div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th>Soyisim</th>
                                            <th>E-Posta</th>
                                            <th>Telefon</th>
                                            <th>Kayıt Olduğu Tarih</th>
                                            <th>Adres</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        while($row = mysqli_fetch_array($result)){
                                            echo '
                                            <tr>
                                                <td class="col-xs-1">'.$row[0].'</td>
                                                <td class="col-xs-1">'.$row[1].'</td>
                                                <td class="col-xs-2">'.$row[2].'</td>
                                                <td class="col-xs-2">'.$row[3].'</td>
                                                <td class="col-xs-2">'.$row[4].'</td>
                                                <td class="col-xs-4">'.$row[5].'</td>
                                            </tr>';
                                        }
                                        echo '
                                    </tbody>
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
</body>
</html>';
?>