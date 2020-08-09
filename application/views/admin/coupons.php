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
                        <h5>Manage Coupons</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="btn-group">
                            <a href="" class="btn btn-info">Export</a>
                            <a href="" class="btn btn-warning">Print</a>
                           <?= anchor_popup('admin/coupons/insert/',"Add New",[
                            "class"=>"btn btn-success",
                            'screenx'   =>  '\'+((parseInt(screen.width) - 500)/2)+\'',
                            'screeny'   =>  100,
                            "width"     =>500,
                            "height"    =>480,
                            'status'    => 'yes',
                            ]);?>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-sm mt-2">
                  <thead>
                        <tr>
                        <th>Id</th>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                  </thead>

                    <?php 
                    foreach($coupons as $coupon):
                    ?>

                    <tr>
                        <td><?= $coupon->coupon_id;?></td>
                        <td><?= $coupon->code;?></td>
                        <td>Rs.<?= $coupon->discount;?></td>
                        <td><?php 
                                if($coupon->status==1):
                                    echo "<span class='text-success'>Active</span>";
                                else:
                                    echo "<span class='text-danger'>Disabled</span>";
                                endif;
                            ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <a href="" class="dropdown-item">Edit</a>
                                    <a href="" class="dropdown-item">Delete</a>
                                    <a href="" class="dropdown-item">View</a>
                                </ul>
                            </div>
                        </td>
                    </tr>


                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
