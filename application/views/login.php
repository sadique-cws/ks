<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumar Studio</title>
    <?php include_once("include/headerlink.php");?>
</head>

<body class="  teal lighten-2">
    <?php include_once('include/nav.php');?>
    <div class="container-fluid mt-5 px-1 px-lg-5">
        <div class="row">
            <div class="col s12 l4 offset-l4">
                <div class="card z-depth-1" style="border:1px solid #eee;">
                    <div class="card-content">
                       <h1 class="ks-font h2">Welcome Back</h1>
                            <p class="small font-style">Login with your email/Mobile and password </p>
                        <form action="<?= base_url('auth/login');?>" method="post">
                            <div class="row">
                            <div class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">person</i>
                                  <input type="text" id="contact" name="contact">
                                  <label for="contact">Contact</label>
                                </div>
                               <div class="input-field col s12">
                                  <i class="material-icons prefix">lock</i>
                                  <input type="password" id="password" name="password">
                                  <label for="password">Password</label>
                                </div>
                                <div class="input-field col s12">
                                  <input type="submit" name="login" class="btn red darken-3 w-100">
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <a href="" class="red-text text-darken-3">Forget Password?</a>
                    </div>
                </div>
            </div>
    </div>
    </div>
     <?php require_once("include/footerlink.php");?>
</body>

</html>
