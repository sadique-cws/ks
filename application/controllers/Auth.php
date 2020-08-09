<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public $data = [];
    
     function __construct() { 
         parent::__construct(); 
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
    
    public function login(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('contact', 'contact', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['fixed'] = true;
            $this->load->view("login",$this->data);
        }
        else{
            $data = array(
                'contact' => $this->input->post('contact'),
                'password' => $this->input->post('password'),
            );
            
            if($this->work->check_data("users",$data)){
                $this->session->set_userdata("user",$this->input->post("contact"));
               $this->session->set_flashdata("msg","Login Successfully");
                if( $this->session->userdata('redirect_back') ) {
                        $redirect_url = $this->session->userdata('redirect_back');  
                        $this->session->unset_userdata('redirect_back');
                       redirect($redirect_url);
}
                else{
                   redirect("welcome/index");
                }
                
            }
            else{
                // error msg 
                $this->session->set_flashdata("msg","Incorrect Contact or Password");
                redirect("auth/login");

            }
        }
    }
    public function admin_login(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['fixed'] = true;
            $this->load->view("admin/admin_login",$this->data);
        }
        else{
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            );
            
            if($this->work->check_data("admin",$data)){
                $this->session->set_userdata("admin",$this->input->post("username"));
					 redirect("admin/index");
             }
            else{
                // error msg 
                redirect("auth/admin_login");

            }
        }
    }
    public function logout(){
        $this->session->unset_userdata("user");
        redirect("welcome/index");
    }
    public function admin_logout(){
        $this->session->unset_userdata("admin");
        redirect("welcome/index");
    }
    
    public function signup(){
            
        
        
        $this->form_validation->set_rules('contact', 'contact', 'required|exact_length[10]|numeric|is_unique[users.contact]',
		array('is_unique' => 'This mobile no already exist. please login'));

        if ($this->form_validation->run() == true) {
			$to = $this->input->post('contact');
			$otp = create_ref(6);
			$message = "Yours OTP is $otp. Please Don't Share your OTP. Thank You";

		

            if($this->msg91->send($to, $message) == TRUE)  {
					$this->session->set_flashdata('msg', ' Hooray! Message Sent');
					$this->session->set_userdata('signup_otp',$otp);
					$this->session->set_userdata('signup_no',$to);
					redirect('auth/verify');
				}
				 else{

					$this->session->set_flashdata('msg', 'Oops! Message  not sent.');
					redirect('auth/signup');

				}

        }
        else{            
				$this->load->view("signup",$this->data);


            }
        }
  
    public function verify(){
            
        
        
        $this->form_validation->set_rules('otp', 'otp', 'required|exact_length[6]');

        if ($this->form_validation->run() == true) {
			echo $otp = $this->input->post('otp');
			
			
            if($_SESSION['signup_otp'] == $otp)  {
					$this->session->unset_userdata('signup_otp');
					redirect('auth/register');
				}
				 else{

					$this->session->set_flashdata('msg', 'Oops! invalid/Expired otp.');
					redirect('auth/verify');

				}

        }
        else{            
				$this->load->view("verify",$this->data);


            }
        }
  
    public function register(){
          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['fixed'] = true;
            
            $this->load->view("register",$this->data);
        }
        else{
            $data = array(
                'name' => $this->input->post('name'),
                'password' => $this->input->post('password'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->session->userdata('signup_no'),
                'city' => $this->input->post('city'),
            );
            
            if($this->work->insertData("users",$data)){
                $this->session->set_userdata("user",$this->session->userdata("signup_no"));
				$this->session->unset_userdata("signup_no");
                redirect("welcome/index");
				$this->session->set_flashdata("msg","<div class='alert alert-success'>Login successfully</div>");            
			}
            else{
                // error msg 
				$this->session->set_flashdata("msg","<div class='alert alert-danger'>yTry Again</div>");            
			}
        }
    }
}
?>
