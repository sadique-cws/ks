   <?php 
if(!empty($user)):
if($user->user_pincode==null):?>

    <div id="modal1" class="modal pincode_modal">
      <div class="modal-content">
          <h4>Please Enter Pin Code</h4>
          <form action="<?= base_url('cart/pincode_update/');?>" method="post">
             <div class="row">
                  <div class="input-field col s12 l10">
                  <i class="material-icons prefix">location_on</i>
                  <input type="text" id="pincode-input" name="pincode" placeholder="enter Pincode">
              </div>
              <div class="input-field col s12 l2">
                  <input type="submit" class="btn green darken-3 w-100 mb-3">
              </div>
             </div>
          </form>
      </div>
  </div>
  <script type="text/javascript">
    
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelector('.pincode_modal');
    var instances = M.Modal.init(elems,{
        'opacity':0.8,
        'inDuration':50,
        'outDuration':50,
    });
    instances.open();
  });

  </script>
<?php endif; endif;?>
  <script type="text/javascript" src="<?= base_url('assets/js/main.js');?>"></script>

  <?php if($this->session->flashdata("msg")):?>
  <?php echo "<script>M.toast({html: '".$this->session->flashdata('msg')."'})</script>"; ?>

  <?php endif; ?>

