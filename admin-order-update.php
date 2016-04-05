<?php include 'login-header.php'; ?>

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">Kayıt Güncelleme</h1>
                </div>
            </div>
            <div class="row">
                <form action="">
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Son Durum</label>
                            <select name="" class="form-control selectpicker" data-container="body">
                                <option value="">Seçiniz</option>
                                <option value="">Onay Bekliyor</option>
                                <option value="">Onaylandı</option>
                                <option value="">Onaylanmadı</option>
                                <option value="">Ekip yollandı</option>
                                <option value="">Telefon alındı</option>
                                <option value="">Teknik ekibe teslim edildi</option>
                                <option value="">Arıza tespit edildi ve fiyat verildi</option>
                                <option value="">Ücret onaylandı</option>
                                <option value="">Ücret onaylanmadı ve onarım iptal edildi</option>
                                <option value="">Onarım aşamasında</option>
                                <option value="">Onarıldı</option>
                                <option value="">Kargolandı</option>
                                <option value="">Teslimat tamamlandı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Arıza Detayı</label>
                            <input type="text" class="form-control" placeholder="Detay">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Arıza Ücreti</label>
                            <input type="text" class="form-control" placeholder="Ücret">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <input type="submit" class="btn btn-success btn-send" value="Güncelle" name="">
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <a href="admin-all-orders.php" class="btn btn-danger btn-send">İptal</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>