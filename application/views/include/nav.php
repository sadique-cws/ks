
<nav class="nav-extended">
    <div class="nav-wrapper red darken-4">
        <div class="container w-100 px-2">

            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="<?= base_url('welcome/index');?>" class="brand-logo px-2 py-1 py-lg-0 px-lg-0 p-lg-0">
                <img src="<?= base_url('assets/kslogo.png');?>" alt="" class="w-100">
            </a>

            <ul class="right hide-on-med-and-down">
                <?php if($this->session->userdata('user')): ?>

                <li>
                    <a class='dropdown-trigger btn red darken-4' href='#' data-target='dropdown1'>
                        <span class="left"><?php 
                            if($user->name!=""){
                                echo $user->name;
                            }
                        else{
                                echo "Guest";
                        }
                        ?></span>

                        <span class="material-icons">arrow_drop_down</span>
                    </a>

                    <!-- Dropdown Structure -->
                    <ul id='dropdown1' class='dropdown-content' style="width: 300px !important">
                        <li><a href="<?= base_url('cart/index');?>" class="black-text ">My Cart</a></li>
                        <li><a href="<?= base_url('user/index');?>" class="black-text ">My Order</a></li>
                        <li><a href="<?= base_url('user/profile');?>" class="black-text ">Account Setting</a></li>
                        <li><a href="<?= base_url('auth/logout');?>" class="white-text red darken-3">Logout</a></li>
                    </ul>
                </li>

                <?php else: ?>
                <li><a href="<?= base_url('auth/login');?>">Login</a></li>
                <li><a href="<?= base_url('auth/signup');?>">Register</a></li>
                <?php endif; ?>
                <li>
                    <a href="<?= base_url('cart/index');?>" class="btn red darken-4">
                        <span class="material-icons left mr-2">shopping_cart</span> Cart 
						<sup class="white-text cart-counter"><?= $cart_count;?></sup>
                    </a>
                </li>
            </ul>

            <ul class="right hide-on-med-and-up">
                <li>
                    <a href="<?= base_url('cart/index');?>" class="btn red darken-4">
                        <span class="material-icons left mr-2">shopping_cart</span> 
						<sup class="white-text cart-counter"><?= $cart_count;?></sup>
                    </a>
                </li>
            </ul>
        </div>
    </div>
	<div class="nav-content red darken-3">
      <ul class="tabs tabs-transparent">
	  <?php foreach($categories as $cat): ?>
            <li class="tab">
			<a href="<?= base_url('welcome/c/'.$cat->cat_slug);?>" class="text-white text-capitalize ks-font"><?= $cat->cat_title;?>
			</a>
			</li>
            <?php endforeach;?>
        
      </ul>
    </div>
</nav>
<ul id="slide-out" class="sidenav ">
    
    <li><a href="<?= base_url('welcome/index');?>" class="waves-effect">Home</a></li>
    <li><a class="subheader">Categories</a></li>
    
    <?php foreach($categories as $cat): ?>
            <li>
			<a href="<?= base_url('welcome/c/'.$cat->cat_slug);?>"><?= $cat->cat_title;?>
			</a>
			</li>
    <?php endforeach;?>
            
    <li>
        <div class="divider"></div>
    </li>
    <?php if(!$this->session->userdata('user')): ?>

    <li><a href="<?= base_url('auth/signup');?>">Register</a></li>
    <li><a class="waves-effect" href="<?= base_url('auth/login');?>">Login</a></li>
    <?php else: ?>
        <li><a href="<?= base_url('cart/index');?>">My Cart</a></li>
        <li><a class="waves-effect" href="<?= base_url('user/index');?>">My Order</a></li>
        <li><a class="waves-effect" href="<?= base_url('user/profile');?>">My Account</a></li>
        <li><a class="waves-effect" href="<?= base_url('auth/logout');?>">Logout</a></li>
    <?php endif; ?>
</ul>
