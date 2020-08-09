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
    <div class="container-fluid mt-3 px-lg-5 px-1">
        <div class="row">
            <div class="col s12 l6 offset-l3">
                <div class="card z-depth-1" style="border:1px solid #eee;">
                    <div class="card-content">
                       <h1 class="ks-font h5">My Profile</h1>
                        <table>
							<tr>
								<th>Name</th>
								<td><?= $user->name;?></td>
							</tr>
							<tr>
								<th>Contact</th>
								<td><?= $user->contact;?></td>
							</tr>
							
							<tr>
								<th>Gender</th>
								<td><?= $user->gender;?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?= $user->email;?></td>
							</tr>
							<tr>
								<th>City</th>
								<td><?= $user->city;?></td>
							</tr>
							<tr>
								<th>Pincode</th>
								<td><?= $user->user_pincode;?></td>
							</tr>
						</table>
						<div class="row mt-3">
							<div class="col s6">
								<a href="" class="btn w-100 green darken-3">Change Password</a>
							</div>
							<div class="col s6">
								<a href="" class="btn w-100 orange darken-3">Edit Profile</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
    </div>
    </div>
     <?php require_once("include/footerlink.php");?>
</body>

</html>
