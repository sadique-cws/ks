<?php 

class User extends CI_controller{
        public $data = [];

    
    function __construct() {
         parent::__construct(); 
            $this->session->set_userdata('redirect_back', $this->agent->referrer());  
            $log = $this->session->userdata("user");
         if(!$this->session->userdata("user")){
               $this->session->set_flashdata("msg","Login First");
               redirect("auth/login");
            }
        
         if($log){
             $this->data['user'] = $this->work->callingData("users",["contact"=>$log]);   
            $this->user_id = $this->data['user']->user_id;
            $this->data['cart_count'] = $this->work->countData("orderitem",array("ordered"=>false,"user"=>$this->user_id));
         }
            else{
                $this->data['cart_count'] = 0;
            }
			$this->data['categories'] = $this->work->callingData('categories');

      } 

	public function profile()
	{
	$this->load->view('profile',$this->data);
	}    
    public function index(){
         $user_id = $this->user_id;
        $this->data['order'] = $this->work->callingQuery("SELECT * from orders JOIN payment ON orders.order_id = payment.order_id where orders.user_id='$user_id'  AND orders.ordered='1' ORDER BY orders.ordered_date DESC");
        $this->data['orderitem'] = $this->work->callingQuery(" 
                                                select * from orderitem JOIN products ON 
                                                orderitem.product_id = products.id 
                                                where user = '$user_id' and ordered ='1'");
        
        $this->load->view('myorders',$this->data);
    }

     private function upload_image($filename,$folder="products"){
         $config = array(
            'upload_path' => "./assets/image/".$folder."/",
            'allowed_types' => "gif|jpg|jpeg|png",
            'overwrite' => FALSE,
            'max_size' => "2048000", 
        );

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors());
        return false;
        } else {
        $data = array('upload_data' => $this->upload->data());
        return $data;
        }
    }

    public function item_image_upload(){
        if(isset($_FILES['orderitem_image']) && $_FILES['orderitem_image']['name'] !=""){
            $data = $this->upload_image('orderitem_image',"attachment");
            $fields = array(
                'upload_image' => $data['upload_data']['file_name']
            );
            $this->work->update('orderitem',$fields,array('orderitem_id'=>$this->input->post('orderitem_id')));
        }
         $this->session->set_flashdata("msg","Image Uploaded Successfully");
         if( $this->session->userdata('redirect_back') ) {
                        $redirect_url = $this->session->userdata('redirect_back');  
                        $this->session->unset_userdata('redirect_back');
                       redirect($redirect_url);
}
                else{
                   redirect("welcome/index");
                }
    }



    public function item_image_remove($orderitem_id){
         $user_id = $this->user_id;

        $get_orderitem = $this->work->callingQuery("SELECT * from orderitem WHERE orderitem_id='$orderitem_id' AND user='$user_id'");

        $fields = array(
            'upload_image' => null
        );
        $this->work->update('orderitem',$fields,array('orderitem_id'=>$get_orderitem[0]->orderitem_id));
        unlink('./assets/image/attachment/'.$get_orderitem[0]->upload_image);
        $this->session->set_flashdata("msg","Image Removed Successfully");
         if( $this->session->userdata('redirect_back') ) {
                        $redirect_url = $this->session->userdata('redirect_back');  
                        $this->session->unset_userdata('redirect_back');
                       redirect($redirect_url);
            }
             else{
                   redirect("welcome/index");
            }
    }


}
?>
