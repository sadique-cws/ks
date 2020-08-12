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
    
    <div class="container-fluid mt-5">
        <div class="row ">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10">
                        <h5>Manage Products</h5>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn-group">
                            <a href="<?= base_url('insert/index');?>" class="btn btn-success">Add New</a>
                        </div>
                    </div>
                </div>
                <br>
                   <?php 
                    foreach($products as $pro):
                    ?>
                    <div class="card mb-1">
                    <div class="card-body pt-1 pb-1">
                    <div class="row">
                        <div class="col-12 col-lg-1 small">#<?= $pro->id;?></div>
                        <div class="col-12 col-lg-3 small text-truncate font-weight-bold"><?= $pro->name;?></div>
                        <div class="col-12 col-lg-1 small text-truncate"><?= $pro->cat_title;?></div>
                        <div class="col-12 col-lg-1"><a href=""><?= anchor_popup('admin/add_area/'.$pro->id,"<span class='badge bg-success'>Service Area</a>",[
                            'screenx'   =>  '\'+((parseInt(screen.width) - 500)/2)+\'',
                            'screeny'   =>  100,
                            "width"     =>500,
                            "height"    =>480,
                            'status'    => 'yes',
                            ]);?></div>
                        <div class="col-12 col-lg-1">
                            <a href="<?= base_url('admin/product_specification/'.$pro->slug . "/" . $pro->id);?>"><span class="badge bg-warning">Details</span></a>
                            
                        </div>
                        <div class="col-12 col-lg-1">
                            <a href="<?= base_url('admin/p'.$pro->slug);?>"><span class="badge badge-pill bg-primary">View</span></a>
                            
                            <a href="<?= base_url('admin/edit_p'.$pro->slug);?>"><span class="badge badge-pill bg-secondary">edit</span></a>
                        </div>
                       
                        <div class="col-12 col-lg-1 small">₹. <?= $pro->discount_price;?> <span class="text-danger"><del><?= $pro->price;?> </del></span></div>
					
						<div class="col-12 col-lg-1 "><?php  
                                if($pro->status==1):
                                    echo "<a href='".base_url('admin/changeState/'.$pro->slug)."' class='bg-success text-white nav-link badge'>Active</a>";
                                else:
                                    echo "<a href='".base_url('admin/changeState/'.$pro->slug)."' class='bg-danger badge text-white nav-link'>Disabled</a>";
                                endif;
                            ?></div>
                        <div class="col-12 col-lg-1">
                            <a data-toggle="modal" href="#image<?= $pro->id;?>"><span  class="badge bg-danger">Change Image</span></a>

                            <div class="modal fade" id="image<?= $pro->id;?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">Change <?= $pro->name;?>'s Image </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <img src="<?= base_url('assets/image/products/'.$pro->image);?>" class="col-6">
                                        <?php if($pro->image1!=""):?>
                                            <img src="<?= base_url('assets/image/products/'.$pro->image1);?>" class="col-6">
                                        <?php endif;?>
                                        </div>
                                        <?= form_open_multipart('admin/change_product_image/'. $pro->slug);?>
                                     <div class="row">
                                        <div class="col-lg-12">
                                            <small class="text-muted">Only PNG with 320x320px allowed</small>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <input type="file" name="image">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <input type="file" name="image1">
                                        </div>
                                        <div class="mb-3 col-12">
                                             <input type="submit" class="btn btn-success btn-sm btn-block" value="Upload" name="product_image">
                                         </div>
                                     </div>
                                        <?= form_close();?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <?php endforeach;?>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
