<?php include 'login-header.php'; ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">Kayıt Güncelleme</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <form action="">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">
                                            <select name="" class="form-control phones selectpicker" data-container="body">
                                                <option value="">Marka Seçiniz</option>
                                                <option value="iphone">iPhone</option>
                                                <option value="samsung">Samsung</option>
                                                <option value="asus" value="">Asus</option>
                                                <option value="lg" value="">LG</option>
                                                <option value="nokia" value="">Nokia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="info-content">
                                        <div class="form-group">
                                            <select name="" class="form-control models iphone active selectpicker" data-container="body">
                                                <option value="">iPhone 4</option>
                                                <option value="">iPhone 4s</option>
                                                <option value="">iPhone 5</option>
                                                <option value="">iPhone 5s</option>
                                                <option value="">iPhone 6</option>
                                            </select>
                                            <select name="" class="form-control models samsung selectpicker" data-container="body">
                                                <option value="">Galaxy S2</option>
                                                <option value="">Galaxy S3</option>
                                                <option value="">Galaxy S4</option>
                                                <option value="">Galaxy S5</option>
                                                <option value="">Galaxy S6</option>
                                            </select>
                                            <select name="" class="form-control models asus selectpicker" data-container="body">
                                                <option value="">Zenfone 1</option>
                                                <option value="">Zenfone 1</option>
                                                <option value="">Zenfone 1</option>
                                                <option value="">Zenfone 1</option>
                                                <option value="">Zenfone 1</option>
                                            </select>
                                            <select name="" class="form-control models lg selectpicker" data-container="body">
                                                <option value="">G3</option>
                                                <option value="">G3</option>
                                                <option value="">G3</option>
                                                <option value="">G3</option>
                                                <option value="">G3</option>
                                            </select>
                                            <select name="" class="form-control models nokia selectpicker" data-container="body">
                                                <option value="">Lumia 920</option>
                                                <option value="">Lumia 920</option>
                                                <option value="">Lumia 920</option>
                                                <option value="">Lumia 920</option>
                                                <option value="">Lumia 920</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="info-content">
                                        <div class="form-group">
                                            <textarea name="" cols="30" rows="5" class="form-control" placeholder="Açıklamanız"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <a href="order-view.php" class="btn btn-primary btn-send">Geri Dön</a>
                                </div>
                                <div class="col-xs-4 col-xs-offset-4">
                                    <input type="submit" class="btn btn-success btn-send" value="Güncelle" name="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>