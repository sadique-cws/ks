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
                   <div class="col-lg-10">
                        <h5>Manage offers</h5>
                    </div>
                    <div class="col-lg-2">
                           <a class="btn btn-success" data-toggle="modal" href="#newoffer">New Offer</a>
                           <div class="modal fade" id="newoffer">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">Insert Offers</div>
                                       <div class="modal-body">
                                           <?= form_open_multipart('admin/offers/insert');?>
                         
                         <div class="mb-3">
                             <label for="title">Title</label>
                             <input type="text" class="form-control" name="title" id="title">
                         </div>
                         <div class="mb-3">
                             <label for="date">Date</label>
                             <input type="date" class="form-control" name="date" id="date">
                         </div>
                         <div class="mb-3">
                             <input type="submit" class="btn btn-success btn-block">
                         </div>
                     
                     <?= form_close();?>
                                       </div>
                                   </div>   
                               </div>
                        </div>
                    </div>
              </div>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php 
                    foreach($offers as $o):?>
                    <tr>
                        <td><?= $o->id;?></td>
                        <td><?= $o->title;?></td>
                        <td><?= $o->date;?>
                            
                <?php 
                        $date = date("d-m-y",strtotime($o->date));
                        $now = date("d-m-y");
                        if( $date < $now){
                            echo "<span class='badge bg-danger text-white'>Expired</span>";
                        }
                            ?>
                        </td>
                        <td><?= $o->status;?></td>
                         <td>
                            <a href="<?= base_url('admin/delete_offer/'.$o->id);?>" class="btn-danger btn btn-sm">Delete</a>
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
 