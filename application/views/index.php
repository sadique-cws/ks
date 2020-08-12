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

               <img src="<?= base_url('assets/img/banner/template.png');?>" class="w-100">

    <div class="container-fluid px-1 px-lg-5 mt-4">
        <div class="row">
            <div class="col s12 text-center">
                <h5 class="grey-text text-darken-2 h3 ks-font heading">Categories</h5>
            </div>
        </div>
        <div class="row">
            <?php foreach($categories as $cat): ?>
            <div class="col l2 s6">
                <div class="card product" style="border:1px solid #ddd!important">
                    <div class="card-image">
                        <img src="<?= base_url('assets/image/cat/'. $cat->cat_image);?>" 
                        style="height: 160px;object-fit: cover;" class="w-100">
                    </div>
                    <div class="card-content pb-1 mb-0 mt-0 pt-2 text-center">
					<a href='<?= base_url('welcome/c/'.$cat->cat_slug);?>' class="stretched-link black-text">
                        <h6 class="ks-font"><?= $cat->cat_title;?></h6>
                    </a>
					</div>
                </div>
            </div>
            <?php endforeach;?>

        </div>
    </div>
    <div class="container-fluid px-lg-5 w-100 mt-3">
        <div class="row mb-0">
        </div>
        
              <?php foreach($categories as $cat): ?>
                    <div class="row">
                    

            <div class="col s12 text-center">
                <h5 class="grey-text text-darken-2 h5 font-style heading"><?= $cat->cat_title;?></h5>
            </div>

                    <?php foreach($products as $pro): ?>
                       <?php if($cat->cat_id == $pro->category):?>
                    <div class="col l3 s6">
                        <div class="card z-depth-0 product" >
                            <div class="card-image">
                                <img src="<?= base_url('assets/image/products/'.$pro->image);?>" class="w-100" style="height: 280px;object-fit: cover;">
                                <?php if($pro->same_day):?>
        						<a class="upper-label white-text red darken-2 ks-font">Same day Delivery</a>
        						<?php endif;?>
                                <?php if($pro->next_day):?>
        						<a class="upper-label white-text red darken-2 ks-font">Next day Delivery</a>
        						<?php endif;?>
                            </div>
                            <div class="card-content pt-3">
                                <a href="<?= base_url('p/'.$pro->slug);?>" class="stretched-link black-text font-weight-bolder">
                                        <h2 class="h6 ks-font text-truncate"><?= $pro->name;?></h2>
                                          <p class="font-style">
                                            <span class="red-text text-darken-3 font-weight-bolder small font-style left">₹. <?= $pro->discount_price ?>/- </span>
        									<?php if($pro->discount_price > 0):?>
        										<span class="green-text text-darken-3 ks-font small right">(<?= round(100-($pro->discount_price/$pro->price)*100);?>% off)</span>

        									<?php endif;?>
                                        </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
                    </div>
            <?php endforeach;?>
        </div>
    </div>
    <?php require_once("include/footerlink.php");?>
</body>

</html>
