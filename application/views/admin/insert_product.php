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
                        <h5>Insert Products</h5>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>

                <?= form_open_multipart('insert/index');?>
                <div class="row">
                   <div class="col-lg-6 mx-auto">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">Basic Details</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" value="<?= set_value('title'); ?>" class="form-control">
                                    <?php echo form_error('title'); ?>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-select ">
                                        <option value="">Select Category</option>
                                        <?php 
                        foreach($category as $cat):
                        if(set_value('category')!=""):
                        ?>
                                        <?php 
                        echo "<option>".set_value('category') . "</option>"; 
                        endif; ?>
                                        <option value="<?= $cat->cat_id;?>"><?= $cat->cat_title;?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <?php echo form_error('category'); ?>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="price">Price</label>
                                    <input type="text" id="price" name="price" class="form-control" value="<?php echo set_value('price'); ?>">
                                    <?php echo form_error('price'); ?>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="text" id="discount_price" name="discount_price" class="form-control" value="<?php echo set_value('discount_price'); ?>">
                                    <?php echo form_error('discount_price'); ?>
                                </div>
                                    
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>

					<div class="row mb-3">
						<div class="col-4">
							<div class="form-check">
							  <input class="form-check-input" name="ndd" type="checkbox" value="1" id="ndd">
							  <label class="form-check-label" for="ndd">Next Day</label>
							</div>
						</div>
						<div class="col-4">
							<div class="form-check">
							  <input class="form-check-input" name="featured" type="checkbox" value="1" id="featured">
							  <label class="form-check-label" for="featured">Featured </label>
							</div>
						</div>
						<div class="col-4">
							<div class="form-check">
							  <input class="form-check-input" name="sdd" type="checkbox" value="1" id="sdd">
							  <label class="form-check-label" for="sdd">Same Day </label>
							</div>
						</div>
					</div>

                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image">
                        <?php
                    if($error['error'] != ""){ 
                            echo $error['error'];
                    }  
                    ?>
                    </div>
                           <div class="mb-3">
                    <input type="submit" name="send" class="btn btn-success btn-block">
                </div>
                            </div>
                        </div>
                    </div>
</div>
                </div>


                


                <?= form_close();?>
            </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
