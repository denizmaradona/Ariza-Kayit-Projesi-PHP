<?php include 'login-header.php'; ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">Arıza Kayıt Detayları</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Durum</th>
                            <th>Telefon Marka</th>
                            <th>Telefon Model</th>
                            <th>Detay</th>
                            <th>Ücret</th>
                            <th>Verilme Tarihi</th>
                            <th>İşlem Geçmişi</th>
                            <th>Kaydı Güncelle</th>
                            <th>Kaydı Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr data-id="3326">
                            <td>Onay Bekliyor</td>
                            <td>Nokia</td>
                            <td>Lumia 920</td>
                            <td>Arıza kaydınız onay aşamasındadır.</td>
                            <td><i class="fa fa-try"></i> 0</td>
                            <td>06/03/2016 , 13:29</td>
                            <td><a href="admin-order-detail.php" class="btn btn-primary">Görüntüle</a></td>
                            <td><a href="admin-order-update.php" class="btn btn-success">Güncelle</a></td>
                            <td><a href="#" class="btn btn-danger btn-delete">Sil</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <a href="admin-dashboard.php" class="btn btn-primary center-block">Geri Dön</a>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
            </div>
            <div class="modal-body">
                <p>Kaydı <b>silmek</b> istediğinize emin misiniz?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete-confirm" href="#">Evet</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>