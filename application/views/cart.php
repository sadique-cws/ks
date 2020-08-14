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
    <div class="container-fluid px-lg-5 px-0 mt-3">
        <div class="row">
            <div class="col s12">
                <h5 class="ks-font">My Carts</h5>
            </div>
            <?php 
            if(!empty($orderitem)):?>
            <div class="col l9">

                <?php 
                        foreach($orderitem as $item):
                    ?>
                <div class="col s12 m12">
                    <div class="card horizontal mb-0">
                        <div class="card-image" style="width:10%;important">
                            <img src="<?= base_url('assets/image/products/'.$item->image);?>" alt="" class="w-100">
                        </div>
                        <div class="card-stacked mb-0 mt-n3">
                            <div class="card-content py-0">
                                <h6 class="small ks-font"><?= $item->name;?></h6>
                                <p class="font-style">
                                    <span class="red-text text-darken-3 font-weight-bolder ">₹. <?= $item->discount_price * $item->qty;?>/- </span>
                                    <span class="grey-text small"><del>₹. <?= $item->price * $item->qty;?>/-</del></span>
								<?php if($item->discount_price > 0):?>
                                    <span class="green-text text-darken-3 font-weight-bold small">(<?= round(100-($item->discount_price/$item->price)*100);?>% Saved)</span>
                                <?php endif;?>
								</p>

                            </div>


                            <div class="card-action py-0" style="border:0">
                                <div class="mb-0 left">
                                    <a href="<?= base_url('cart/minus_qty_cart/'.$item->slug);?>" class="btn red darken-3"><span class="h3">-</span></a>
                                    <p class="btn white black-text text-lighten-2 px-1 font-weight-bold"><?= $item->qty;?></p>
                                    <a href="<?= base_url('cart/add_to_cart/'.$item->slug);?>" class="btn green"><span class="h3">+</span></a>
                                </div>



                                <a href="<?= base_url('cart/remove_from_cart/'.$item->slug);?>" class=" mt-4 right grey-text font-weight-bolder small mt-0">Remove</a>
                            </div>
                        </div>
                    </div>
                    <?php 
if($item->attachment):?>
    <?php  if($item->upload_image == null): ?>
    <?= form_open_multipart('user/item_image_upload/');?>
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
 <hr style="border:1px solid #ddd">

                </div>

                <?php endforeach;  ?>
                <a href="<?= base_url('welcome/index');?>" class="btn red ks-font darken-2 ">Continue Shopping</a>
            </div>
            <div class="col l3 s12">
                <ul class="collection">
                    <li class="collection-item font-style text-center "><strong class="ks-font font-weight-bold grey-text text-darken-2">Price Details</strong></li>
                    <li class="collection-item font-style">Total Amount: <span class="right">₹. <?= $total_amount;?>/-</span></li>
                    <?php if($order[0]->coupon!=null):?>
                    
                    <li class="collection-item grey font-style lighten-2">Coupon Discount: (<?= $order[0]->discount;?>%)  <span class="right">₹. <?= $get_coupon_amount;?>/-</span></li>
                    <?php endif;?>
                    <li class="collection-item green font-style lighten-2">Total Saving: <span class="right">₹. <?= $get_total_saving_amount;?>/-</span></li>
                    <li class="collection-item font-style font-weight-bolder">Net Payable Amount: <span class="right">₹. <?=$total_payable_amount;?>/-</span></li>
                </ul>
                <div class="row">
                   
                    <div class="col s5 l12"><a href="<?= base_url('cart/checkout/');?>" class="btn ks-font green darken-3 small w-100 mt-2 waves-effect waves-green">Order Now</a></div>
                     
                </div>
    <?php 
                if($order[0]->coupon==null): ?>
                <div class="card  pt-1 pb-0" style="border:1px solid #ddd">
                    <div class="card-content py-1" >
                        <?= form_open('cart/add_coupon');?>
                           <div class="row">
                               <div class="col s12">
                                    <div class="input-field my-0">
                                <input id="coupon" type="text" name="coupon" class="validate" value="" placeholder="Apply Coupon">
                            </div>
                               </div>
                               <div class="col s12">
                            <div class="input-field  my-0">
                                <input type="submit" class="btn red darken-3 w-100" value="Redeem">
                            </div>
                               </div>
                           </div>
                        <?= form_close();?>   
                    </div>
                </div>
                <?php else: ?>
                    <h6 class="mb-2 ks-font">Coupon Applied</h6>
                    <div class="chip green text-white">
                    <?= $order[0]->code;?>
                    <a href="<?= base_url('cart/remove_coupon');?>" class="text-white"><i class="close material-icons">close</i></a>
                  </div>
                <?php endif; ?>
            </div>
            <?php else:?>
                <div class="col s12">
                    <div class="card text-center">
                        <div class="card-content ks-font">
                            <h1 class="h3 ks-font">Your Cart is Empty</h1>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php require_once("include/footerlink.php");?>
</body>

</html>
