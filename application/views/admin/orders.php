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
                        <h5>Manage Products</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="btn-group">
                            <a href="" class="btn btn-info">Export</a>
                            <a href="" class="btn btn-warning">Print</a>
                            <a href="<?= base_url('admin/products/insert/');?>" class="btn btn-success">Add New</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-sm mt-2">
                  <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>RefCode</th>
                        <th>Order Date</th>
                        <th>Ordered</th>
                        <th>Coupon</th>
                        <th></th>
                    </tr>
                  </thead>

                    <?php 
                    foreach($orders as $o):
                    ?>

                    <tr>
                        <td><?= $o->order_id;?></td>
                        <td><?php 
                            
                            if($o->name==""){
                                echo "Guest";
                            }
                            else{
                                echo $o->name;
                            }
                            ;?></td>
                        <td><?= $o->ref_code;?></td>
                        <td><?= date("D d-M-Y h:i:s A",strtotime($o->ordered_date));?></td>
                        <td><?php 
                            if($o->ordered==1){
                                    echo "<span class='badge bg-success'>ordered</span>";
                            }
                            else{
                                    echo "<span class='badge bg-danger'>Pending</span>";
                            }
                            ?></td>
                        <td><strong class="text-info"><?= $o->code;?></strong></td>
                        
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
