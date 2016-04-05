<?php include 'login-header.php'; ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">
                    Admin Paneli <small>Genel Bakış</small>
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
                                        <div>Arıza Kayıtları</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin-all-orders.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Tümünü Gör</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
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
                                        <div>Destek Talepleri</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin-all-tickets.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Tümünü Gör</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-edit fa-fw"></i> Arıza Kayıtları</h3>
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
                                    <tr data-id="3326">
                                        <td class="col-xs-2">3326</td>
                                        <td class="col-xs-2">06/03/2016 , 13:29</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">4s</td>
                                        <td class="col-xs-2">Ücret onaylanmadı ve onarım iptal edildi</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
                                    <tr data-id="3325">
                                        <td class="col-xs-2">3325</td>
                                        <td class="col-xs-2">06/03/2016 , 13:20</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">5s</td>
                                        <td class="col-xs-2">Onay Bekliyor</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
                                    <tr data-id="3324">
                                        <td class="col-xs-2">3324</td>
                                        <td class="col-xs-2">06/03/2016 , 13:03</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">6</td>
                                        <td class="col-xs-2">Onay Bekliyor</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
                                    <tr data-id="3326">
                                        <td class="col-xs-2">3326</td>
                                        <td class="col-xs-2">06/03/2016 , 13:29</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">4s</td>
                                        <td class="col-xs-2">Ücret onaylanmadı ve onarım iptal edildi</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
                                    <tr data-id="3325">
                                        <td class="col-xs-2">3325</td>
                                        <td class="col-xs-2">06/03/2016 , 13:20</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">5s</td>
                                        <td class="col-xs-2">Onay Bekliyor</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
                                    <tr data-id="3324">
                                        <td class="col-xs-2">3324</td>
                                        <td class="col-xs-2">06/03/2016 , 13:03</td>
                                        <td class="col-xs-2">iPhone</td>
                                        <td class="col-xs-2">6</td>
                                        <td class="col-xs-2">Onay Bekliyor</td>
                                        <td class="col-xs-2"><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                                    </tr>
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