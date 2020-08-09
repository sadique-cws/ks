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
        <div class="row ">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10">
                        <h5><?= $product[0]->name;?> Details</h5>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Photo</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      
      <table class="table">
          <tr>
              <th>Title</th>
              <td><?= $product[0]->name;?></td>
          </tr>

          <tr>
              <th>category</th>
              <td><?= $product[0]->category;?></td>
          </tr>

          <tr>
              <th>price</th>
              <td><?= $product[0]->price;?></td>
          </tr>

          <tr>
              <th>discount_price</th>
              <td><?= $product[0]->discount_price;?></td>
          </tr>

          <tr>
              <th>slug</th>
              <td><?= $product[0]->slug;?></td>
          </tr>

          <tr>
              <th>description</th>
              <td><?= $product[0]->description;?></td>
          </tr>

          <tr>
              <th>same_day</th>
              <td><?= $product[0]->same_day;?></td>
          </tr>
          <tr>
              <th>next_day</th>
              <td><?= $product[0]->next_day;?></td>
          </tr>
          <tr>
              <th>attachment</th>
              <td><?= $product[0]->attachment;?></td>
          </tr>
          <tr>
              <th>status</th>
              <td><?= $product[0]->status;?></td>
          </tr>
      </table>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <table class="table">

        <?php foreach($about_product as $ap):?>
          <tr>
              <th><?= $ap->title;?></th>
              <td><?= $ap->description;?></td>
          </tr>
<?php endforeach;?>

       
      </table>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      
      <div class="row">

        <div class="col-lg-3">
            <div class="card mt-4">
                    <img src="<?= base_url('assets/image/products/'.$product[0]->image);?>" class="card-img-top">
            </div>
        </div>
      </div>
  </div>
</div>
           </div>
        </div>
    </div>
    <?php require_once("admin_include/footer.php");?>
</body>

</html>
