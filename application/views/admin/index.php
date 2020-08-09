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
                    <div class="col-lg-4">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h2 class="lead"><?= $product_count;?></h2>
                                <p class="small">Total Products</p>
                                <a href="<?= base_url('insert/index');?>" class="btn btn-primary">Insert</a>
                                <a href="<?= base_url('admin/products');?>" class="btn btn-success">Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="lead"><?= $area_count;?></h2>
                                <p class="small">Total Area</p>
                                <a href="<?= base_url('insert/index');?>" class="btn btn-primary">Insert</a>
                                <a href="<?= base_url('admin/products');?>" class="btn btn-success">Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="lead"><?= $order_count;?></h2>
                                <p class="small">Total Orders</p>
                                <a href="<?= base_url('insert/index');?>" class="btn btn-primary">Pending</a>
                                <a href="<?= base_url('admin/products');?>" class="btn btn-success">View Statement</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="lead"><?= $cart_count;?></h2>
                                <p class="small">Total Carts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="lead"><?= $user_count;?></h2>
                                <p class="small">Total Users</p>
                                <a href="<?= base_url('insert/index');?>" class="btn btn-primary">Insert</a>
                                <a href="<?= base_url('admin/products');?>" class="btn btn-success">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
