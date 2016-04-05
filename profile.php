<?php include 'login-header.php'; ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Profil Bilgileriniz</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <form action="">
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Adınız</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" value="Deniz">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Soyadınız</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" value="Güzel">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>E-Posta Adresiniz</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" value="denizguzel.iu@gmail.com">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Telefon</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" value="5056493091">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Adres</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" value="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque natus in ab, quos.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h3>Doğum Tarihiniz</h3>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker" data-provide="datepicker" placeholder="Gün/Ay/Yıl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <input type="submit" class="btn btn-success btn-send" value="Bilgileri Güncelle" name="">
                                </div>
                                <div class="col-xs-12 col-md-3 col-md-offset-2">
                                    <a href="#" class="btn btn-danger btn-send" data-toggle="modal" data-target="#profile-modal">Hesabımı Sil</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Dikkat!</h3>
                </div>
                <div class="modal-body">
                    <p>Hesabınız <strong>kalıcı</strong> olarak silinecektir. Bu işlem geri döndürülemez. Emin misiniz?</p>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" data-dismiss="modal" value="Evet" name="">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>