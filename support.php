<?php include 'login-header.php'; ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Destek Talebi</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Destek talepleriniz en kısa süre içerisinde cevaplandırılacaktır.</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-support fa-fw"></i> Talep Geçmişi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Talep No #</th>
                                                <th>Talep Tarihi</th>
                                                <th>Son İşlem Tarihi</th>
                                                <th>Konu</th>
                                                <th>Durum</th>
                                                <th>Talebi Görüntüle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-xs-1">3326</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-3">Telefonum söylenilen tarihte teslim edilmedi.</td>
                                                <td class="col-xs-1"><i class="fa fa-info-circle"></i>İnceleniyor</td>
                                                <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-1">3326</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-3">Telefonum söylenilen tarihte teslim edilmedi.</td>
                                                <td class="col-xs-1"><i class="fa fa-check-circle"></i>Cevaplandırıldı</td>
                                                <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-1">3326</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-3">Telefonum söylenilen tarihte teslim edilmedi.</td>
                                                <td class="col-xs-1"><i class="fa fa-check-circle "></i>Cevaplandırıldı</td>
                                                <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-1">3326</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-3">Telefonum söylenilen tarihte teslim edilmedi.</td>
                                                <td class="col-xs-1"><i class="fa fa-info-circle"></i>İnceleniyor</td>
                                                <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-1">3326</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-1">06/03/2016 , 13:29</td>
                                                <td class="col-xs-3">Telefonum söylenilen tarihte teslim edilmedi.</td>
                                                <td class="col-xs-1"><i class="fa fa-info-circle"></i>İnceleniyor</td>
                                                <td class="col-xs-1"><a href="ticket-view.php" class="btn btn-primary">Görüntüle</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <a href="#" class="btn btn-danger btn-ticket" data-toggle="modal" data-target="#support-modal">Talep Oluştur</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="support-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Talep Oluştur</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Konu">
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <textarea class="form-control" name="" id="" cols="30" rows="5" placeholder="Mesajınız"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" data-dismiss="modal" value="Kaydet" name="">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>