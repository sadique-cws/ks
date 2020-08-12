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
                        <h5>Manage Orders</h5>
                    </div>
                  
                </div>
                 <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Ref_Code</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 <?php 
                    foreach($orders as $o):
                 ?>
                    <tr>
                         <td>
                              <?php if($o->order_status == 0): ?>
                            <span class=" badge bg-primary text-white">Order Processing</span>
                    <?php elseif($o->order_status == 1): ?>
                            <span class=" badge bg-success text-white">Order Accepted</span>
                        
                    <?php elseif($o->order_status == 2): ?>
                            <span class=" badge bg-warning text=white">Order Dispatched</span>
                        
                    <?php elseif($o->order_status == 3): ?>
                            <span class=" badge bg-secondary text-white">Order Delivered</span>
                        
                    <?php elseif($o->order_status == 4): ?>
                            <span class=" badge bg-danger text-white">Order Cancelled</span>
                        
                    <?php endif;?>
                        </td>
                        <td><?= $o->order_id;?></td>
                        <td>
                        <?php 
                            
                            if($o->name==""){
                                echo "Guest";
                            }
                            else{
                                echo $o->name;
                            }
                            ;?></td>
                        <td class="col-2">(+91) <?php echo $o->contact;?></td>
                        <td class="col-2"><?= $o->ref_code;?></td>
                        <td class="col-3"><?= date("d-M-Y (h:i:s A)",strtotime($o->ordered_date));?></td>
                        
                        <td class="col-2">
                           
                            <a class="btn btn-sm btn-info" href="<?= base_url('admin/order_view/' . $o->order_id);?>">View Order</a>
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
