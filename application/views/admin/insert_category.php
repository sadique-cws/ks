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
                    <h2 class="h5">Insert Category Here</h2>
                    <hr/>
                     <?= form_open_multipart('admin/categories/insert');?>
                         
                         <div class="mb-3">
                             <label for="cat_title">Title</label>
                             <input type="text" class="form-control" name="cat_title" id="cat_title">
                         </div>
                         <div class="mb-3">
                             <label for="cat_description">Description</label>
                             <textarea rows="5" class="form-control" name="cat_description" id="cat_description">
                             </textarea>
                         </div>
                         <div class="mb-3">
                             <input type="file" name="cat_image">
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
 