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
                        <h5>Edit Details</h5>
                    </div>
                  
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <?= form_open();?>
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Products Details </div>
                            <div class="card-body">
                               <div class="mb-3">
                                   <label>title</label>
								   <input type="text" class="form-control" name="title">
                               </div>
                               <div class="mb-3">
                                   <label>Description</label>
								   <textarea rows=5 class="form-control" name="description"></textarea>
                               </div>
                                <div class="mb-3">
                                    <input type="submit" name="send" class="btn btn-block btn-success">
                                </div>
                            </div>
                        </div>
                        <?= form_close();?>
                    </div>
                    <div class="col-lg-8">
                        <?php if(!empty($about_product)):?>
                        <table class="table table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>

                            <?php foreach($about_product as $ap):?>
                                <tr>
                                    <td><?= $ap->about_id;?></td>
                                    <td><?= $ap->title;?></td>
                                    <td><?= $ap->description;?></td>
                                    <td><a href="<?= base_url('admin/delete_product_specification/'. $this->uri->segment(3) . '/' . $ap->product_id . '/' . $ap->about_id) ;?>" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                        <?php else: ?>
                                <div class="card text-center text-muted">
                                    <div class="card-body">
                                        <h2 class="h6">Create first Product Details</h2>
                                    </div>
                                </div>

                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>