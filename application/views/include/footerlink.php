 <footer class="page-footer grey darken-4">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">About Us</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Our Products</h5>
                <ul>
                      <?php foreach($categories as $cat): ?>

                  <li><a class="grey-text text-lighten-3 font-style small" href="#!"><?= $cat->cat_title;?></a></li>
                <?php endforeach;?>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © <?= date("Y");?> Copyright Text
            <a class="grey-text font-style text-lighten-4 right" href="https://www.codewithsadiq.com" target="_blank">Developed By CWS</a>
            </div>
          </div>
        </footer>
           <?php 
if(!empty($user)):
if($user->user_pincode==null):?>

    <div id="modal1" class="modal pincode_modal mt-5" style="min-width:35%">
      <div class="modal-content pb-0">
          <h4 class="h6">Please Enter Pin Code</h4>
          <?= form_open('cart/pincode_update/');?>
             <div class="row">
                  <div class="input-field col s12 l9">
                  <i class="material-icons prefix">location_on</i>
                  <input type="text" id="pincode-input" name="pincode" placeholder="enter Pincode">
              </div>
              <div class="input-field col s12 l3">
                  <input type="submit" class="btn green darken-3 w-100 mb-3" value="Go">
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

