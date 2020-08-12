<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <?php require_once("admin_include/link.php");?>
</head>

<body class="bg-light">
    <?php require_once("admin_include/nav.php");?>
    <?php require_once("admin_include/side.php");?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Manage Enquiry</h5>
                    </div>
                    
                </div>
                <table class="table table-striped table-sm mt-2">
                  <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Product</th>
                        <th>Status</th>
                    </tr>
                  </thead>

                    <?php 
                    foreach($enquiry as $e):
                    ?>

                    <tr>
                        <td><?= $e->id;?></td>
                        <td><?= $e->enquiry_name;?></td>
                        <td>Rs.<?= $e->enquiry_contact;?></td>
                        <td><?= $e->name; ?></td>
                        <td>
                            
                        </td>
                    </tr>


                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
