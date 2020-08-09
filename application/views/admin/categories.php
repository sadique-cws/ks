<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <?php require_once("admin_include/link.php");?>
</head>

<body  class="bg-light">
    <?php require_once("admin_include/nav.php");?>
    <?php require_once("admin_include/side.php");?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
              <div class="row">
                   <div class="col-lg-8">
                        <h5>Manage Categories</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="btn-group">
                            <a href="" class="btn btn-info">Export</a>
                            <a href="" class="btn btn-warning">Print</a>
                            <?= anchor_popup('admin/categories/insert/',"Add New",[
                            "class"=>"btn btn-success",
                            'screenx'   =>  '\'+((parseInt(screen.width) - 500)/2)+\'',
                            'screeny'   =>  100,
                            "width"     =>500,
                            "height"    =>480,
                            'status'    => 'yes',
                            ]);?>
                        </div>
                    </div>
              </div>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php 
                    foreach($categories as $c):?>
                    <tr>
                        <td><?= $c->cat_id;?></td>
                        <td><?= $c->cat_title;?></td>
                        <td><?= $c->cat_slug;?></td>
                        <td>
                            <button type="button" class=" btn  btn-sm btn-success" data-toggle="modal" data-target="#image<?= $c->cat_id;?>">Change Image</button>

                            <div class="modal fade" id="image<?= $c->cat_id;?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">Change <?= $c->cat_title;?>'s Image </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <img src="<?= base_url('assets/image/cat/'.$c->cat_image);?>" class="col-6 mx-auto">
                                        </div>
                                        <?= form_open_multipart('admin/category_image_change/'. $c->cat_slug);?>
                                     <div class="row">
                                        <div class="col-lg-12">
                                            <small class="text-muted">Only png with 250X250 to 500x500 px allowed</small>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <input type="file" name="cat_image">
                                        </div>
                                        <div class="mb-3 col-6">
                                             <input type="submit" class="btn btn-success btn-sm btn-block" value="Upload" name="category_image">
                                         </div>
                                     </div>
                                        <?= form_close();?>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary" data-target="#category<?= $c->cat_id;?>" data-toggle="modal" aria-expanded="false">Edit Record</button>

                            <div class="modal fade" id="category<?= $c->cat_id;?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">Edit <?= $c->cat_title;?>'s </div>
                                    <div class="modal-body">
                                        <?= form_open_multipart('admin/edit_category/'. $c->cat_slug);?>
                         
                         <div class="mb-3">
                             <label for="cat_title">Title</label>
                             <input type="text" class="form-control" name="cat_title" id="cat_title" value="<?= $c->cat_title;?>">
                         </div>
                         <div class="mb-3">
                             <label for="cat_description">Description</label>
                             <textarea rows="5" class="form-control" name="cat_description" id="cat_description"><?= $c->cat_description;?></textarea>
                         </div>
                         <div class="mb-3">
                             <input type="submit" class="btn btn-success btn-block">
                         </div>
                     
                     <?= form_close();?>
                                    </div>
                                </div>
                                </div>
                            </div>
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
 