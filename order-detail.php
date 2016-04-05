<?php include 'login-header.php'; ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">İşlem Geçmişi</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Arıza No #</strong> 3326</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Durum</th>
                                                <th>İşlem Tarihi</th>
                                                <th>Ücret</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-xs-4">Onay Bekliyor</td>
                                                <td class="col-xs-4">06/03/2016 , 13:29</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Onaylandı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:30</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Ekip yollandı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:31</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Telefon alındı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:32</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Teknik ekibe teslim edildi</td>
                                                <td class="col-xs-4">06/03/2016 , 13:33</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>

                                            <tr>
                                                <td class="col-xs-4">Arıza tespit edildi ve fiyat verildi</td>
                                                <td class="col-xs-4">06/03/2016 , 13:34</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 100</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Ücret onaylandı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:35</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Onarım aşamasında</td>
                                                <td class="col-xs-4">06/03/2016 , 13:36</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Onarıldı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:37</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Kargolandı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:38</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-4">Teslimat tamamlandı</td>
                                                <td class="col-xs-4">06/03/2016 , 13:39</td>
                                                <td class="col-xs-4"><i class="fa fa-try"></i> 0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Toplam Ücret:</strong></td>
                                                <td colspan="1"><i class="fa fa-try"></i> 100</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="btn-wrapper">
                        <div class="col-xs-12 col-md-2">
                            <a href="order-view.php" class="btn btn-primary center-block">Geri Dön</a>
                        </div>
                        <div class="col-xs-12 col-md-2 col-md-offset-6 confirm hide">
                            <a href="#" class="btn btn-success center-block" data-toggle="modal" data-target="#confirm-modal">Onaylıyorum</a>
                        </div>
                        <div class="col-xs-12 col-md-2 reject hide">
                            <a href="#" class="btn btn-danger center-block" data-toggle="modal" data-target="#confirm-modal">Onaylamıyorum</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
            </div>
            <div class="modal-body">
                <p>Emin misiniz?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Evet</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>