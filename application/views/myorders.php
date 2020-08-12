<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumar Studio</title>
    <?php include_once("include/headerlink.php");?>
</head>

<body>
    <?php include_once('include/nav.php');?>
        <div class="container px-lg-5 px-0 mt-3">
            <div class="row">
                <div class="col s12">
                    <h5 class="ks-font">My Orders</h5> </div>
					<?php 
                    if(!empty($order)):?>
                <div class="col l12 s12">
                    <?php 
                foreach($order as $o):
                    ?>
                       <div class="card product grey lighten-4">
                           <div class="card-content py-2 ">
						    <h2 class="small grey-text text-darken-2 mb-3 left mt-2"><span class="font-weight-bolder">Order No:</span> <?= $o->ref_code; ?></h2>
						    <h2 class="small grey-text text-darken-2 mb-3 right mt-2"><span class="font-weight-bolder">Date: </span><?= date("l d-M-Y",strtotime($o->ordered_date)); ?></h2>
							<div class="clearfix"></div>
                       <?php 
                        foreach($orderitem as $item):
                               
                               if($o->order_id == $item->order_id):
                    ?>
                            <div class="row">
                                <div class="card-image col s2 l1"> 
                                    <img src="<?= base_url('assets/image/products/'.$item->image);?>" class="w-100"> 
                                </div>
                                <div class="card-stacked col s10 l11">
                                    <div class="mt-n1">
                                        <h6 class=" grey-text text-darken-3 ks-font"><?= $item->name;?></h6>
                                    </div>
                                </div>
                            </div>
							
                        <?php endif; 
                    endforeach; ?>

                    <?php if($o->order_status == 0): ?>
						<div class="mt-3 left">
							<span class=" chip blue white-text">Order Processing</span>
						</div>

                    <?php elseif($o->order_status == 1): ?>
                        <div class="mt-3 left">
                            <span class=" chip green white-text">Order Accepted</span>
                        </div>
                    <?php elseif($o->order_status == 2): ?>
                          <div class="mt-3 left">
                            <span class=" chip orange darken-3 white-text">Order Dispatched</span>
                        </div>
                    <?php elseif($o->order_status == 3): ?>
                          <div class="mt-3 left">
                            <span class=" chip grey darken-2 white-text">Order Delivered</span>
                        </div>
                    <?php elseif($o->order_status == 4): ?>
                          <div class="mt-3 left">
                            <span class=" chip red white-text">Order Cancelled</span>
                        </div>
                    <?php endif;?>
						<div class="mt-3 right">
								<h6 class="grey-text text-darken-2 font-weight-bold left mr-4 h4">Rs. <?= $o->amount; ?>/-</h6>

                             <?php if($o->order_status == 0): ?>
                                <a href="" class="red-text font-weight-bolder left">Cancel</a>
							<?php endif;?>	
							 </div>
							 <div class="clearfix"></div>
						</div>
                       </div>
                            <?php endforeach;  ?>

							
            <?php else:?>
                <div class="col s12">
                    <div class="card text-center">
                        <div class="card-content ks-font">
                            <h1 class="h2">Order Not Available</h1>
                            <a href="<?= base_url('welcome/index');?>" class="btn green darken-2 ">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            </div>
        </div>
        <?php require_once("include/footerlink.php");?>
</body>

</html>
