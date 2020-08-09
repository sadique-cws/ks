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
    <?php include_once('include/nav.php');
    
    ?>
        <div class="container-fluid px-lg-5 px-1 mt-3">
            <div class="row">
                <div class="col s12 ">
                    <h5 class="ks-font">Checkout</h5>
                    <p class="small">Select Save Address or Fill address Details</p>
                </div>
                <div class="col s12 l8">
                    <?php 
                if(!empty($address)):?>
                        <form action="<?= base_url('cart/checkout');?>" method="post">
                            <div class="row">
                                <?php
                    foreach($address as $ad):?>
                                    <div class="col s12">
                                        <div class="card grey lighten-3">
                                            <div class="card-content">
                                                <p>
                                                    <label>
                                                        <input name="save_address" type="radio" value="<?= $ad->address_id;?>" /> <span><?= $ad->name;?> - <?= $ad->street . ", " . $ad->city;?>, </span> <span>(<?= $ad->alternative_contact;?>)</span> </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                            </div>
                            <input type="submit" class="btn right orange darken-3 mt-n3" value="Proceed to pay"> </form>
                        <div class="clearfix"></div>
                        <hr>
                        <?php endif;?>
                            <div class="card mt-5 grey lighten-4">
                                <div class="card-content">
                                    <h6>Fill address details for checkout</h6>
                                    <form action="<?= base_url('cart/checkout/');?>" method="post">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="row">
                                                    <div class="input-field col s12 l6"> <i class="material-icons prefix">person</i>
                                                        <input type="text" id="name" name="name">
                                                        <label for="name">Full Name <small>(Optional)</small></label>
                                                        <?= form_error('name');?>
                                                    </div>
                                                    <div class="input-field col s12 l6"> <i class="material-icons prefix">phone</i>
                                                        <input type="text" id="alt_contact" name="alt_contact">
                                                        <label for="alt_contact">Alternative contact <small>(Optional)</small></label>
                                                        <?= form_error('alt_contact');?>
                                                    </div>
                                                    <div class="input-field col s12 l6"> <i class="material-icons prefix">location_on</i>
                                                        <input type="text" id="Street" name="street">
                                                        <label for="Street">Street/Village/Area/Colony</label>
                                                        <?= form_error('street');?>
                                                    </div>
                                                    <div class="input-field col s12 l6"> <i class="material-icons prefix">location_city</i>
                                                        <input type="text" id="city" name="city">
                                                        <label for="city">City</label>
                                                        <?= form_error('city');?>
                                                    </div>
                                                    <div class="input-field col s12"> <i class="material-icons prefix">lock</i>
                                                        <input type="text" id="pincode" name="pincode">
                                                        <label for="pincode">Pincode</label>
                                                        <?= form_error('pincode');?>
                                                    </div>
                                                    <div class="input-field col s12"> <a href="" class="btn grey darken-3 left">Cancel</a>
                                                        <input type="submit" class="btn red darken-3 right" value="Save Address & Pay"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                </div>
                <div class="col s12 l4">
                    <div class="card">
                        <div class="card-content p-0 m-0">
                            <h6 class="px-3 py-2">Your Carts</h6>
                            <ul class="collection">
                                <?php foreach($orderitem as $item): ?>
                                    <li class="collection-item">
                                        <?= $item->name;?> <span class="right small">(<?= $item->discount_price;?> X <?= $item->qty;?>)</span></li>
                                    <?php endforeach;  ?>
                                        <li class="collection-item red-text text-darken-3">
                                            <h5>Total Amount <span class="right">₹. <?= $total_payable_amount;?></span></h5> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("include/footerlink.php");?>
</body>

</html>
