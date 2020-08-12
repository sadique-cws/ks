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

 
    


}



?>
