<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public $data = [];

    function __construct() { 
         parent::__construct(); 
                    $this->session->set_userdata('redirect_back', $this->agent->referrer());  

            $log = $this->session->userdata("user");
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
    
    
	public function index(){
        
         $this->data['products'] = $this->work->callingData('products',array('status'=>1));
		$this->load->view('index',$this->data);
	}
	//category filter 
	public function c($slug=null){
		
		if($slug==null){
			redirect('welcome/index');
		}
        
         $this->data['products'] = $this->work->callingquery("select * from products JOIN categories ON products.category = categories.cat_id 
		 WHERE categories.cat_slug='$slug' AND products.status=1");
		$this->load->view('filter',$this->data);
	}
	public function product($slug=null){
        
        
        $this->data['product'] = $this->work->callingData('products',array("slug"=>$slug,'status'=>1));
        $this->data['products'] = $this->work->callingData('products',array("slug<>"=>$slug,'status'=>1));
		if(!empty($this->data['product'])){
		$product_id = $this->data['product']->id;
        $this->data['abouts'] = $this->work->callingQuery(" select * from about_product where product_id='$product_id'");
        $this->data['offers'] = $this->work->callingQuery(" select * from offers");
        //checking pin code automaticalling
        
		}
		if(!empty($this->data['user'])):

        if($this->data['user']->user_pincode!=null){
			 
			 $pincode = $this->data['user']->user_pincode;
			 $pin = $this->work->callingQuery("select * from pincode JOIN area ON pincode.pincode = area.area_id where pincode.product_id='$product_id' AND area.area_pincode='$pincode'");
                
                if(!empty($pin)){
                    $this->data['pincode_check'] = true;
                }
                else{
                    $this->data['pincode_check'] = false;
                }
        }
        
    endif;
         
		 if(!empty($this->data['product'])){
			$this->load->view('product',$this->data);
		}
		else{
		$this->data['heading'] = "404 Page Not Found";
		$this->data['message'] = "URL may incorrect please Try again";
		$this->load->view('errors/html/error_404',$this->data);
		}
	}
	public function contact(){
		$this->load->view('contact');
	}

	public function CreateEnquiry($slug=null){
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('contact','contact','required|exact_length[10]');


        if($this->form_validation->run()){
            $data = [
                'enquiry_name' => $_POST['name'],
                'enquiry_contact' => $_POST['contact'],
                'product_id' => $_POST['product_id']
            ];
            $this->msg91->send($_POST['enquiry_contact'],"Hi ". $_POST['enquiry_name'] . " Thank you, we received your inquiry for bulk customized gift We well call back soon \n Regards \n Kumar Studio Gifts");
        	 $this->session->set_flashdata("msg","Thank you, we will call back soon");
            $this->work->insertData('bulk_enquiry',$data);     
        }
        else{
        	 $this->session->set_flashdata("msg",form_error('name') ." | " .form_error('contact'));
        }
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
