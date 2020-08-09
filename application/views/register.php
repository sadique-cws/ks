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
            <div class="col s12 l6 offset-l3">
                <div class="card">
                    <div class="card-content">
                       <h6>Signup Now</h6>
                        <form action="<?= base_url('auth/register');?>" method="post">
                            <div class="row">
                            <div class="col s12">
                              <div class="row">
                                <div class="input-field col s12 l12">
                                  <i class="material-icons prefix">person</i>
                                  <input type="text" id="name" name="name">
                                  <label for="name">Full Name</label>
                                </div>
                               
                                <div class="input-field col s12">
                                 <p class="left font-weight-bold s12 l2">Gender</p>
                                 
                                  <p class="col s6 l2 ml-5 mt-0">
                                    <label>
                                      <input name="gender" value="M" class="with-gap" type="radio" checked />
                                      <span>Male</span>
                                    </label>
                                  </p>
                                  <p class="s6 l2 col mt-0">
                                    <label>
                                      <input name="gender" value="F" class="with-gap" type="radio" />
                                      <span>Female</span>
                                    </label>
                                  </p>
                                </div>
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">location_on</i>
                                  <input type="text" id="city" name="city">
                                  <label for="city">City</label>
                                </div>
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">lock</i>
                                  <input type="password" id="password" name="password">
                                  <label for="password">Password</label>
                                </div>
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">lock</i>
                                  <input type="password" id="confirm_password" name="confirm_password">
                                  <label for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="input-field col s12">
                                  <input type="submit" class="btn red darken-3 w-100">
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <?php require_once("include/footerlink.php");?>
</body>

</html>
