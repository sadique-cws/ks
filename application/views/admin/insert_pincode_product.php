<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <?php require_once("admin_include/link.php");?>
</head>

<body class="bg-light">
    <?php require_once("admin_include/nav.php");?>
    <?php require_once("admin_include/side.php");?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-8">
                        <h5>Insert Products</h5>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>

                <?= form_open('insert/product_pincode');?>
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Availablity Details

                            </div>
                            <div class="card-body">
                               <div class="mb-3">
                                   <select id="" name="pin[]" class="form-select" multiple>
                                      <?php foreach($pincode as $pin):?>
                                       <option value="<?= $pin->area_id;?>"><?= $pin->area_pincode;?> (<?= $pin->area_name;?>)</option>
                                       <?php endforeach;?>
                                   </select>
                               </div>
                                <div class="mb-3">
                                    <input type="submit" name="send" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <?= form_close();?>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
