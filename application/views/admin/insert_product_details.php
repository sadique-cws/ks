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

                <?= form_open('insert/product_specification');?>
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Products Details

                            </div>
                            <div class="card-body">
                               <div class="mb-3">
                                   <label>title</label>
								   <input type="text" class="form-control" name="title">
                               </div>
                               <div class="mb-3">
                                   <label>Description</label>
								   <textarea rows=5 class="form-control" name="description"></textarea>
                               </div>
                                <div class="mb-3">
                                    <input type="submit" name="send" class="btn btn-success float-right">
                                    <a href="<?= base_url('insert/clear_session/');?>" class="btn btn-danger float-left">Close</a>
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
