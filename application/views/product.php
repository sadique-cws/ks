<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumar Studio</title>
    <?php require_once("include/headerlink.php");?>
</head>

<body>
    <?php include_once('include/nav.php');?>

    <div class="containerfluid px-lg-5 px-1 w-100 mt-5">
        <div class="row">

            <div class="col s12 l4">

                 <div class="carousel carousel-slider">
    <a class="carousel-item" href="#one!"><img class="w-100" src="<?= base_url('assets/image/products/'.$product->image);?>"></a>

    <?php if($product->image1 != ""):?>
    <a class="carousel-item" href="#two!"><img class="w-100" src="<?= base_url('assets/image/products/'.$product->image1);?>"></a>

    <?php endif; ?>


  </div>
                
				
            </div>
            <div class="col s12 l8">
                <h1 class="ks-font grey-text text-capitalize text-darken-3 h2 pb-0 mt-3 mt-lg-0"><?= $product->name;?></h1>
                <p class="ks-font mt-0 grey-text text-darken-1"><?= $product->description;?></p>
				 <?php if($product->same_day):?>
						<span class="badge new red darken-2" data-badge-caption="Same day Delivery"></span>
						<?php endif;?>
                        <?php if($product->next_day):?>
						<span class="badge new red darken-2" data-badge-caption="Next day Delivery"></span>
						<?php endif;?>
                <p class="font-style h5 mb-3">
                    <span class="red-text text-darken-3">₹. <span class="font-weight-bolder"><?= $product->discount_price;?>/-</span> </span>
                    <span class="grey-text small"><del>₹. <?= $product->price;?>/-</del></span>
                </p>
				<?php if($product->discount_price > 0):?>
                <span class="new badge left green ml-0" data-badge-caption="Saving"><?= round(100-($product->discount_price/$product->price)*100);?>%</span>
				<?php endif;?>
                <div class="clearfix"></div>
                <div class="row mb-0 mt-2">
                    <div class="col s12">
                       <?php 
                        if(!empty($user)):
                            if($user->user_pincode==null):?>
                        <form action="<?= base_url('cart/pincode_check/'. $product->slug);?>" method="post">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">location_on</i>
                                <input type="text" id="pincode-input" class="autocomplete" name="pincode">
                                <label for="pincode-input">Enter Pin Code</label>
                            </div>
                        </form>
                        <?php else:
                            if($pincode_check):
                        ?>
                            <p class="small green-text text-darken-3 font-weight-bold"> Deliver at <?= Get_AreaName($user->user_pincode)->area_name;?> (<?= $user->user_pincode; ?>)  
                            <a href="<?= base_url('cart/empty_pincode/'.$product->slug);?>" class="font-weight-bolder">Change</a></p>
                                <a href="<?= base_url('cart/add_to_cart/'.$product->slug);?>" class="btn red darken-1 text-white waves-effect waves-light">Add to Cart</a>
                        
                        <?php else: ?>
                            <p class="small red-text">Sorry This product unavailable  <?= $user->user_pincode;?>
                             <a href="<?= base_url('cart/empty_pincode/'.$product->slug);?>" class="font-weight-bolder">Change</a></p>
                            
                        
                        <?php 
                                endif; 
                            endif; 
                        ?>
                          <a href="#about" class="btn grey waves-effect waves-light">Know More</a>
                       
                        <?php else:?>
                            <a href="<?= base_url('cart/add_to_cart/'.$product->slug);?>" class="btn red darken-1 text-white waves-effect waves-light">Add to Cart</a>
                            <a href="#about" class="btn grey waves-effect waves-light">Know More</a>
                        <?php endif;?>
                    </div>
                </div>

         
            <div class="col s12 mt-3 mx-0 pt-0 px-0">
                <a class="orange white-text px-2 py-1 modal-trigger" href="#modal2">Bulk Enquiry</a>
                       <div id="modal2" class="modal Bulk" style="width: 30%!important">
    <div class="modal-content">
        <div class="card">
                    <div class="p-2" >Bulk Enquiry</div>
                    <div class="card-content p-2 m-0">
                      <?= form_open('welcome/CreateEnquiry/'.$product->slug);?>
                             <div class="row mb-0">
                            <div class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input type="text" id="name" name="name">
                                  <input type="hidden" name="product_id" value="<?= $product->id;?>">
                                  <label for="name">Name</label>
                                </div>
                               <div class="input-field col s12">
                                  <input type="text" id="contact" name="contact">
                                  <label for="contact">Contact</label>
                                </div>
                                <div class="input-field col s12">
                                  <input type="submit" name="login" value="Callback Request" class="btn red darken-3 w-100">
                                </div>
                              </div>
                            </div>
                          </div>
                       <?= form_close();?>
                    </div>
                </div>
    </div>
  </div>
                <div class="card grey lighten-3">
                    <div class="card-content py-3 grey-text text-darken-2">
                        <b class="mt-0 pt-0">Offers:</b>
                         
                      <?php foreach($offers as $of):?>
                          <p class="green-text text-darken-3 small"><?= $of->title;?></p>
                      <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="col s12 mt-n2 mx-0 px-0">
                <div class="card grey lighten-3">
                    <div class="card-content py-1 grey-text text-darken-2">
                        <ul  class="text-capitalize small">
                            <li>Free delivery in Purnea (Urban)</li>
                            <li>Cancellation Allow before Order Processing</li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    <div class="container-fluid px-lg-5 px-1 w-100 mt-3">
        <div class="row mb-0">
            <div class="col s12">
                <h6 class="text-uppercase ks-font grey-text text-darken-3 redheading">Similer Products</h6>
            </div>
        </div>
        <div class="row">
            <?php foreach($products as $pro):?>
            <div class="col l2 s6">
                <div class="card z-depth-1 product">
                    <div class="card-image">
                        <img src="<?= base_url('assets/image/products/'.$pro->image);?>"style="height: 180px;object-fit: cover;" class="w-100">
                          <?php if($pro->same_day):?>
						<a class="upper-label white-text red darken-2">Same day Delivery</a>
						<?php endif;?>
                        <?php if($pro->next_day):?>
						<a class="upper-label white-text red darken-2">Next day Delivery</a>
						<?php endif;?>
                    </div>
                    <div class="card-content pt-3">
                        <a href="<?= base_url('p/'.$pro->slug);?>" class="stretched-link black-text font-weight-bolder">
                                <h2 class="h6 ks-font text-truncate"><?= $pro->name;?></h2>
                                <p class="font-style">
                                    <span class="red-text text-darken-3">₹. <?= $pro->discount_price;?>/- </span> 
									<?php if($pro->discount_price > 0):?>
                                    <span class="green-text text-darken-3 font-weight-bold small right"> (<?= round(100-($pro->discount_price/$pro->price)*100);?>% OFF)</span>
									<?php endif;?>
                                </p>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    
    <div class="container-fluid px-lg-5 px-1 w-100 mt-3" id="about">
        <div class="row mb-0">
            <div class="col s12">
                <h6 class="text-uppercase ks-font grey-text text-darken-3 redheading">Product Details</h6>
            </div>
        </div>
        <div class="row">
           <div class="col s12">
               <div class="card grey lighten-3">
                   <div class="card-content">
				   <?php if(!empty($abouts)):?>
				   <?php foreach($abouts as $about):?>
                        <div class="row mb-0">
                            <div class="col s2 l1 font-weight-bolder"><?= $about->title;?> </div>
                            <div class="col s1 l1">:</div>
                            <div class="col s9 l10"><?= $about->description;?></div>
                        </div>
                     
                   <?php 
				   endforeach; 
				   else:
						echo "<h6 class='text-muted ks-font'> Product Details not Available</h6>";
				   
				   endif; ?>
                       </div>
               </div>
           </div>
           <div class="col s12">
               <div class="card grey lighten-3">
                   <div class="card-content">
                       <h3 class="h6 ks-font font-weight-bold mb-0">DISCLAIMER:</h3>
                       <ul class="ks-font mt-0 text-grey text-darken-1">
							<li>> Delivered product might vary slightly from the image shown.</li>
						    <li>> The date of delivery is provisional as it is shipped through third party courier partners. </li>
							<li>> We try to get the gift delivered close to the provided date. However, your gift may be delivered prior or after the selected date of delivery. </li>
							<li>> Delivery may not be possible on Sundays and National Holidays. </li>
							<li>> For Rural deliveries, custom charges might be levied which are payable by the recipient. </li>
                       </ul>
                   </div>
               </div>
           </div>
        </div>
    </div>
    
    <?php require_once("include/footerlink.php");?>
</body>

</html>
