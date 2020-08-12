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
    <div class="container px-lg-5 p-0 w-100 mt-3">
       
        <div class="row">
		<div class="col l2 s12">
           
		</div>
       <?php if(!empty($products)):?>
		<div class="col l112 s12">
			<div class="row">
            <?php foreach($products as $pro):?>
            <div class="col l3 s12">
                <div class="card z-depth-1 product" >
                    <div class="card-image">
                        <img src="<?= base_url('assets/image/products/'.$pro->image);?>" class="w-100" style="height: 280px;object-fit: cover;">
                        <?php if($pro->same_day):?>
						<a class="upper-label white-text red darken-2">Same day Delivery</a>
						<?php endif;?>
                        <?php if($pro->next_day):?>
						<a class="upper-label white-text red darken-2">Next day Delivery</a>
						<?php endif;?>
                    </div>
                    <div class="card-content pt-3">
                        <a href="<?= base_url('p/'.$pro->slug);?>" class="stretched-link black-text font-weight-bolder">
                                <h2 class="h6 text-capitalize text-truncate ks-font"><?= $pro->name;?></h2>
                                  <p class="font-style">
                                    <span class="red-text text-darken-3 font-weight-bolder ">₹. <?= $pro->discount_price ?>/- </span>
                                    <span class="grey-text small"><del>₹. <?= $pro->price;?>/-</del></span>
									<?php if($pro->discount_price > 0):?>
										<span class="green-text text-darken-3 font-weight-bold small right">(<?= round(100-($pro->discount_price/$pro->price)*100);?>% saved)</span>
									<?php endif;?>
                                </p>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
		</div>
		<?php else: ?>
		    <div class="col s12">
                <div class="card text-center">
                    <div class="card-content">
                        <i class="material-icons red-text">cancel</i>
                        <h2 class="h5 ks-font">Not Found</h2>
                        <p>Please Try with another Category</p>
                    </div>
                </div>
		</div>
        <?php endif;?>
		</div>
    </div>	
    <?php require_once("include/footerlink.php");?>
</body>

</html>
