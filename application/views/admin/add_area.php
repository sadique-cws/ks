<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <?php require_once("admin_include/link.php");?>
</head>

<body  class="bg-light">
    <div class="container mt-2">
        <div class="row">
       <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">
                    <h2 class="h5">Selected Area</h2>

					<?php 
							foreach($area as $a):?>
								<span class="badge bg-success rounded-pill"><?php echo $a->area_name;?><a href="<?= base_url('admin/remove_area/'.$this->uri->segment(3) . '/' . $a->pin_id);?>" class="small text-danger p-0 ml-1">X</a></span>
								<?php endforeach;?>
                    <hr/>
                     <?= form_open_multipart('admin/add_area/'.$this->uri->segment(3));?>
                         
                         
                         <div class="mb-3">
                             <select name="pin[]" class="form-select" multiple>
							 <?php foreach($insert_area as $ia):?>

								<option value="<?= $ia->area_id;?>"><?= $ia->area_name;?></option>	
								<?php  endforeach;?>
							 </select>
                         </div>
                         <div class="mb-3">
                             <input type="submit" class="btn btn-success btn-block">
                         </div>
                         <div class="mb-3">
                             <button type="button" onclick="window.close();window.opener.location.reload(true);" class="btn btn-danger btn-block">Go Back</button>
                         </div>
                     
                     <?= form_close();?>
                 </div>
             </div>
        </div>
    </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body> 

</html>
