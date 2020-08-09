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
    <div class="container-fluid px-lg-5 p-1 w-100 mt-3">
        <div class="row">
            <div class="col s12">
                <h5 class="ks-font">My Carts</h5>
            </div>
            <?php 
            if(!empty($orderitem)):?>
            <div class="col l8">

                <?php 
                        foreach($orderitem as $item):
                    ?>
                <div class="col s12 m12">
                    <div class="card horizontal">
                        <div class="card-image" style="width:10%;important">
                            <img src="<?= base_url('assets/image/products/'.$item->image);?>" alt="" class="w-100">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content py-0">
                                <h6><?= $item->name;?></h6>
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
                                    <a href="<?= base_url('cart/minus_qty_cart/'.$item->slug);?>" class="btn red darken-3">-</a>
                                    <p class="btn white black-text text-lighten-2 px-1 font-weight-bold"><?= $item->qty;?></p>
                                    <a href="<?= base_url('cart/add_to_cart/'.$item->slug);?>" class="btn green">+</a>
                                </div>



                                <a href="<?= base_url('cart/remove_from_cart/'.$item->slug);?>" class=" mt-4 right grey-text font-weight-bolder small mt-0">Remove</a>
                            </div>
                        </div>
                    </div>
                    <?php 
if($item->attachment):?>

    <button type="button" class="btn grey darken-2">Attach Photo </button>
<?php endif;?>
 <hr style="border:1px solid #ddd">

                </div>

                <?php endforeach;  ?>

            </div>
            <div class="col l4 s12">
                <ul class="collection">
                    <li class="collection-item text-center "><strong class="ks-font font-weight-bold grey-text text-darken-2">Price Details</strong></li>
                    <li class="collection-item">Total Amount: <span class="right">₹. <?= $total_amount;?>/-</span></li>
                    <?php if($order[0]->coupon!=null):?>
                    
                    <li class="collection-item grey lighten-2">Coupon Discount: (<?= $order[0]->discount;?>%)  <span class="right">₹. <?= $get_coupon_amount;?>/-</span></li>
                    <?php endif;?>
                    <li class="collection-item green lighten-3">Total Saving: <span class="right">₹. <?= $get_total_saving_amount;?>/-</span></li>
                    <li class="collection-item font-weight-bolder">Total Payable Amount: <span class="right">₹. <?=$total_payable_amount;?>/-</span></li>
                </ul>
                <div class="row">
                    <div class="col s7">
                        <a href="<?= base_url('welcome/index');?>" class="btn light-blue w-100">
                            <span class="material-icons left mt-1">shopping_basket</span>
                            More Shopping</a>
                    </div>
                    <div class="col s5"><a href="<?= base_url('cart/checkout/');?>" class="btn orange w-100">Checkout</a></div>
                </div>
    <?php 
                if($order[0]->coupon==null): ?>
                <div class="card  pt-1 pb-0" style="border:1px solid #ddd">
                    <div class="card-content py-2" >
                        <form action="<?= base_url('cart/add_coupon');?>" method="post">
                           <div class="row">
                               <div class="col s8 l9">
                                    <div class="input-field">
                                <input id="coupon" type="text" name="coupon" class="validate" value="">
                                <label for="coupon">Apply Coupon (if any)</label>
                            </div>
                               </div>
                               <div class="col s4 l3">
                            <div class="input-field">
                                <input type="submit" class="btn green darken-3 mt-1" value="Redeem">
                            </div>
                               </div>
                           </div>
                        </form>    
                    </div>
                </div>
                <?php else: ?>
                    <h6 class="green-text text-darken-3">Coupon Applied</h6>
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
                            <h1>Your Cart is Empty</h1>
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
