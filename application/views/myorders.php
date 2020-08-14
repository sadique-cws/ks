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
                                <div class="card-image col s2 l2"> 
                                    <img src="<?= base_url('assets/image/products/'.$item->image);?>" class="w-100"> 
                                </div>
                                <div class="card-stacked col s10 l10">
                                    <div class="mt-n1">
                                        <h6 class=" grey-text text-darken-3 ks-font"><?= $item->name;?></h6>
                                          <?php 
            if($item->attachment):?>
                <?php  if($item->upload_image == null): ?>
                <?= form_open_multipart('user/item_image_upload/');?>
                 <div class="mb-2 ">
                        <small class="ks-font">Attachment</small>
                    </div>
                  <div class="file-field input-field my-0">
                    <div class="chip blue grey-text text-lighten-4">
                        <span><i class="material-icons left mx-1 mt-1">image</i> Upload Photo </span>
                        <input type="hidden" name="orderitem_id" value="<?= $item->orderitem_id;?>">
                        <input type="file" name="orderitem_image" onchange="this.form.submit()">
                    </div>
                </div>
                <?php else: ?>
                    <div class="mb-2 ">
                        <small class="ks-font">Attachment</small>
                    </div>
                    <div class="chip grey lighten-2 mb-0 grey-text text-darken-4">
                        <img src="<?= base_url('assets/image/attachment/'.$item->upload_image);?>" alt="attachment">
                            <a class="grey-text" href="<?= base_url('user/item_image_remove/'.$item->orderitem_id);?>">
                                <i class="close material-icons">close</i>
                            </a>

                    </div>
                <?php endif;?>
            <?= form_close();?>
            <?php endif;?>
                                    </div>
                                </div>
                            </div>
							
                        <?php endif; 
                    endforeach; ?>
                    </div>
                    <div class="card-action white">
                        <div class="row  mb-0">
                        <div class= "col s6 l3">
                         <?php if($o->order_status == 0): ?>
                           <span class=" chip blue white-text">Order Processing</span>
                         <?php elseif($o->order_status == 1): ?>
                                <span class=" chip green white-text">Order Accepted</span>
                        <?php elseif($o->order_status == 2): ?>
                                <span class=" chip orange darken-3 white-text">Order Dispatched</span>
                        <?php elseif($o->order_status == 3): ?>
                                <span class=" chip grey darken-2 white-text">Order Delivered</span>
                        <?php elseif($o->order_status == 4): ?>
                                <span class=" chip red white-text">Order Cancelled</span>
                        <?php endif;?>
                        </div>
                    <div class="col s6 offset-l7 l2">
                        <h6 class="ks-font  left mr-4">Rs. <?= $o->amount; ?>/-</h6>
                         <?php if($o->order_status == 0): ?>
                            <a href="" class="red-text font-weight-bolder left">Cancel</a>
                            <?php endif;?>  
                         </div>
                    </div>
                    </div>
                </div>
			 <div class="clearfix"></div>
						
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
        </div>
        <?php require_once("include/footerlink.php");?>
</body>

</html>
