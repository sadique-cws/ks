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
        <div class="container-fluid px-lg-5 px-1 mt-3">
            <div class="row">
                <div class="col s12">
                    <h5 class="ks-font">My Orders</h5> </div>
					<?php if(!empty($order)):?>
                <div class="col l12 s12">
                    <?php 
                foreach($order as $o):
                    ?>
                       <div class="card product grey lighten-4">
                           <div class="card-content">
						    <h2 class="small grey-text text-darken-2 mb-3 left"><span class="font-weight-bolder">Order No:</span> <?= $o->ref_code; ?></h2>
						    <h2 class="small grey-text text-darken-2 mb-3 right"><span class="font-weight-bolder">Date: </span><?= date("l d-M-Y",strtotime($o->ordered_date)); ?></h2>
							<div class="clearfix"></div>
                       <?php 
                        foreach($orderitem as $item):
                               
                               if($o->order_id == $item->order_id):
                    ?>
                            <div class="card  grey lighten-4 horizontal mb-0">
                                <div class="row">
                                <div class="card-image col s4 l2"> <img src="<?= base_url('assets/image/products/'.$item->image);?>" alt="" class="w-100"> </div>
                                <div class="card-stacked col s8 l10">
                                    <div class="card-content py-0">
                                        <h6 class=" grey-text text-darken-3 text-truncate"><?= $item->name;?></h6>
                                    </div>
                                </div>
                                </div>
                            </div>
							
                        <?php endif; endforeach; ?>
						<div class="mt-3 left">
							<p class="green-text text-darken-3">Delivered</p>
						</div>
						<div class="mt-3 right">
								<p class="grey-text text-darken-2 font-weight-bold left mr-4">Rs. <?= $o->amount; ?></p>
								<a href="" class="red-text font-weight-bolder left">Cancel</a>
								
							 </div>
							 <div class="clearfix"></div>
						</div>
                       </div>
                            <?php endforeach; ?>

							
            <?php else:?>
                <div class="col s12">
                    <div class="card text-center">
                        <div class="card-content ks-font">
                            <h1>Order Not Available</h1>
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
