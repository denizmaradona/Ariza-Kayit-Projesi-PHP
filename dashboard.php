<?php include 'login-header.php'; ?>
        <script type="text/javascript">
        function a(){
            var Row = document.getElementsByTagName("tr");
            var Cells = Row.getElementById("ariza_no");
            alert(Cells);             
        }
            
        </script>
        <div class="page-wrapper">
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
                            <div class="col-xs-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-edit fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right count">
                                                <div class="huge">3</div>
                                                <div>Arıza Kayıtlarınız</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-support fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right count">
                                                <div class="huge">5</div>
                                                <div>Destek Talepleriniz</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit fa-fw"></i> Arıza Kayıtlarınız</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Arıza No #</th>
                                                <th>İşlem Tarihi</th>
                                                <th>Telefon Marka</th>
                                                <th>Telefon Model</th>
                                                <th>Kayıt Durumu</th>
                                                <th>Kayıt Detayları</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'dbsettings.php';
                                                $result = mysqli_query($connection, 
                                                "CALL ariza_kayitlarini_goster('".$_SESSION['eposta']."')") or die("Query fail: " . mysqli_error());
                                                
                                                while($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr id="somerow">
                                                    
                                                        <td id="ariza_no" class="col-xs-2"><?php echo $row[0]?></td>
                                                        <td class="col-xs-2"><?php echo $row[3]?></td>
                                                        <td class="col-xs-2"><?php echo $row[1]?></td>
                                                        <td class="col-xs-2"><?php echo $row[2]?></td>
                                                        <td class="col-xs-2"><?php echo $row[5]?></td>
                                                        <td class="col-xs-2"><a href="order-view.php" class="btn btn-primary" onclick="a()">Görüntüle</a></td>
                                                    </tr>

                                                <?php
                                                    }
                                                ?>   
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
</html>