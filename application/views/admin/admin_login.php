<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <?php require_once("admin_include/link.php");?>
</head>

<body class="bg-light">
    <?php require_once("admin_include/nav.php");?>

    <div class="container mt-5">
        <div class="row"> 
			<div class="col-lg-4 mx-auto">
				<form action="<?= base_url('auth/admin_login');?>" method="post">
                                <div class="mb-3">
								<label for="username">username</label>
                                  <input type="text" id="username" class="form-control" name="username">
                                </div>
                               <div class="mb-3">
                                  <label for="password">Password</label>
                                  <input type="password"  class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                  <input type="submit" name="login" class="btn btn-block btn-danger">
                                </div>
                 </form>
			</div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
