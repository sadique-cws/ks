<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumar Studio</title>
    <?php include_once("include/headerlink.php");?>
</head>

<body class="green lighten-2">
    <?php include_once('include/nav.php');?>
    <div class="container-fluid mt-5 px-1 px-lg-5">
        <div class="row">
            <div class="col s12 l4 offset-l4">
                <div class="card">
                    <div class="card-content">
                       <h6>Signup</h6>
                        <?= form_open('auth/forget_verify');?>
                            <div class="row">
                            <div class="col s12">
                              <div class="row">
                            <div class="input-field col s12">
                                  <i class="material-icons prefix">local_phone</i>
                                  <input type="tel" id="otp" name="otp" placeholder="OTP" autofocus>
								  <?php if(form_error('otp')):?>
									<span class="helper-text" data-error="wrong"><?= form_error('otp');?></span>
								  <?php else: ?>
									<span class="helper-text" data-error="wrong" data-success="right">enter a valid OTP no</span>
								  <?php endif;?>
                                  
                                </div>
                                <div class="input-field col s12">
                                  <input type="submit" class="btn red darken-3 w-100" value="Verify">
                                </div>
                              </div>
                            </div>
                          </div>
                        <?= form_close();?>
                        <a href="<?= base_url('auth/login');?>" class="red-text text-darken-3">Already have an Account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <?php require_once("include/footerlink.php");?>
</body>

</html>
