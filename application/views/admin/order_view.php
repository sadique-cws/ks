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
        <div class="row ">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-captialize"><?= $order[0]->ref_code;?> Order Details</h5>

                        <table class="table table-sm table-striped table-bordered">
                          <tr>
                            <th>Name</th>
                            <td><?= $order[0]->name;?></td>
                          </tr>
                          <tr>
                            <th>Ref Code</th>
                            <td><?= $order[0]->ref_code;?></td>
                          </tr>
                          <tr>
                            <th>User</th>
                            <td><?= $order[0]->contact;?></td>
                          </tr>
                          <tr>
                            <th>Cart Date</th>
                            <td><?= $order[0]->start_date;?></td>
                          </tr>
                          <tr>
                            <th>Ordered Date</th>
                            <td><?= $order[0]->ordered_date;?></td>
                          </tr>
                          <tr>
                            <th>Coupon</th>
                            <td><?= $order[0]->code;?> (<?= $order[0]->discount;?>%)</td>
                          </tr>

                          <tr>
                            <th>Status 

                   <?php if($order[0]->order_status == 0): ?>
                            <span class=" badge bg-primary text-white">Order Processing</span>
                    <?php elseif($order[0]->order_status == 1): ?>
                            <span class=" badge bg-success text-white">Order Accepted</span>
                        
                    <?php elseif($order[0]->order_status == 2): ?>
                            <span class=" badge bg-warning text=white">Order Dispatched</span>
                        
                    <?php elseif($order[0]->order_status == 3): ?>
                            <span class=" badge bg-secondary text-white">Order Delivered</span>
                        
                    <?php elseif($order[0]->order_status == 4): ?>
                            <span class=" badge bg-danger text-white">Order Cancelled</span>
                        
                    <?php endif;?>
                            <td>
                             

                              <form action="<?= base_url('admin/changeOrderStatus/'.$order[0]->order_id);?>" class="d-flex" method="post">
                                <select class="form-select" name="status">
                                  <option value="0">Processing</option>
                                  <option value="1">Accepted</option>
                                  <option value="2">Dispatched</option>
                                  <option value="3">Delivered</option>
                                  <option value="4">Cancelled</option>
                                </select>

                                <input class="btn btn-success" type="submit" value="Change Status" name="changestate" />
                              </form>
                            </td>
                          </tr>
                        </table>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Orders Details</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Payment Details</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Attachment</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      
    <?php  foreach($orderitem as $item): ?>
        <div class="card my-2">
          <div class="card-body">
             <div class="row">
                  <div class="col-3 col-lg-1"> 
                      <img src="<?= base_url('assets/image/products/'.$item->image);?>" class="w-100"> 
                  </div>
                  <div class="col-9 col-lg-11">
                      <div class="mt-n1">
                          <h6 class="text-captialize"><?= $item->name;?></h6>
                          <p class="small text-muted my-0">Id: <?= $item->id;?></p>
                          <p class="small text-muted my-0">Current Price: Rs. <?= $item->discount_price;?>/-</p>
                      </div>
                  </div>
            </div>
          </div>
        </div>
              
    <?php  endforeach; ?>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <table class="table">
        <tr>
          <th>Pay Id</th>
          <td><?= $order[0]->id;?></td>
        </tr>
        <tr>
          <th>Pay Amount</th>
          <td><?= $order[0]->amount;?></td>
        </tr>
        <tr>
          <th>Pay Type</th>
          <td><?= $order[0]->type;?></td>
        </tr>
        <tr>
          <th>Pay Status</th>
          <td><?= $order[0]->status;?></td>
        </tr>
        <tr>
          <th>Payment By</th>
          <td><?= $order[0]->payment_type;?></td>
        </tr>
        <tr>
          <th>Bank txnid</th>
          <td><?= $order[0]->bank_txnid;?></td>
        </tr>
        <tr>
          <th>transaction Date/time</th>
          <td><?= $order[0]->txn_date;?></td>
        </tr>
      </table>

  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      
      <div class="row">

       <?php  foreach($orderitem as $item): 

       if($item->upload_image != ''):
       ?>
        <div class="col-lg-3">
            <div class="card my-2">
               <img src="<?= base_url('assets/image/products/'.$item->upload_image);?>" class="w-100">
              <div class="card-body">
                 <h6 class="text-captialize"><?= $item->name;?></h6>       
              </div>
            </div>
        </div>
              
    <?php endif; endforeach; ?>
      </div>
  </div>
</div>
           </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
