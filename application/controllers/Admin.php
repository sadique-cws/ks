<?php 
class Admin extends CI_controller{
    
        public $data = [];

	public function __construct(){
		parent::__construct();

		$this->data['product_count'] = $this->work->countData('products');
		$this->data['area_count'] = $this->work->countData('area');
		$this->data['order_count'] = $this->work->countData('orders',array("ordered"=>true));
		$this->data['cart_count'] = $this->work->countData('orders',array("ordered"=>false));
		$this->data['user_count'] = $this->work->countData('users');
		$log = $this->session->userdata( 'admin' );
        if ( !$this->session->userdata( 'admin' ) ) {
            redirect( 'auth/admin_login' );
        }
	}	

    
    public function index(){
        
        $this->load->view('admin/index',$this->data);
    }
	public function changeState($slug=null){
		
		
		if($slug!==null){
		
			$pro = $this->work->callingData('products',array('slug'=>$slug));

			if($pro->status=='0'){
				$status = '1';
			}
			elseif($pro->status=='1'){
				$status = '0';
			}
		
			$fields = array(
				'status'=>$status
			);
			$this->work->update('products',$fields,array("slug"=>$slug));
		}
			redirect('admin/products');
		
	}

	private function check_area($product_id,$area_id){
		$area = $this->work->callingData('pincode',array("product_id"=>$product_id,"pincode"=>$area_id));

		if(!empty($area)){
			return true;
		}
		else{
			return false;
		}
	}

    public function remove_area($pro_id=null,$id=null){
        if($pro_id!=null and $id != null){
            if($this->work->deleteData('pincode',array('product_id'=>$pro_id,'pin_id'=>$id))){
                redirect('admin/add_area/'.$pro_id);
            }
        }
        else{
            redirect('admin/index');
        }
    }

	public function add_area($pro_id=null){
		$this->data['area'] = $this->work->callingQuery("select * from pincode JOIN area ON pincode.pincode = area.area_id where product_id='".$pro_id."'");
		$this->data['insert_area'] = $this->work->callingQuery("select * from area");
							
		if($pro_id == null){
			redirect('admin/products');
		}

		$this->form_validation->set_rules('pin[]','area','required');

		if($this->form_validation->run()){
			foreach($_POST['pin'] as $pincode_input):
			
			if($this->check_area($pro_id,$pincode_input)==false){
			
				$fields = array(
					'pincode'=>$pincode_input,
					'product_id'=>$pro_id
				);
			$this->db->insert('pincode', $fields);
			redirect('admin/add_area/'.$pro_id);
			}
			endforeach;

		
	}
	$this->load->view('admin/add_area',$this->data);
	}

    public function edit_product($slug=null){
        if($slug==null):
            redirect('admin/index');
        endif;
        $this->form_validation->set_rules('title','name','required|trim');
            $this->form_validation->set_rules('category','category','required|trim');
            $this->form_validation->set_rules('price','price','required|trim');
            $this->form_validation->set_rules('discount_price','discount_price','required|trim');
            $this->form_validation->set_rules('description','description','required|trim');
            

            if($this->form_validation->run()){
                $fields = array(
                    'name' => $_POST['title'],
                    'category' => $_POST['category'],
                    'price' => $_POST['price'],
                    'discount_price' => $_POST['discount_price'],
                    'description' => $_POST['description'],
                    'slug' => slugify($_POST['title']),
                    'same_day' =>$this->input->post('sdd')?: 0,
                    'next_day' =>$this->input->post('ndd',0)?: 0,
                    'featured_product' =>$this->input->post('featured',0)?: 0,
                );
                $pro_id = $this->work->update('products',$fields,array('slug'=>$slug));
                
                $this->session->set_flashdata("success","products update Successfully");
                //session for next step
                redirect('admin/products');
               
            }
            else{
                $data['category'] = $this->work->callingData('categories');
                $data['product'] = $this->work->callingQuery("SELECT * FROM products JOIN categories ON products.category = categories.cat_id where products.slug = '$slug'");

                $this->load->view('admin/product_edit',$data);
                $this->session->set_flashdata("danger","Try Again or Check data");
                //redirect('admin/products/');
            }
           
    }

    private function upload_image($filename,$folder="products"){
         $config = array(
            'upload_path' => "./assets/image/".$folder."/",
            'allowed_types' => "gif|jpg|jpeg|png",
            'overwrite' => TRUE,
            'max_size' => "2048000", 
            'max_height' => "768",
            'max_width' => "1024"
        );

    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload($filename)) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    return false;
    } else {
    $data = array('upload_data' => $this->upload->data());
    return true;
    }
}

    public function change_product_image($slug=null){
          if ($this->input->post('product_image')){
            if(isset($_FILES['image']) && $_FILES['image']['name'] !=""){
                $this->upload_image('image');
                $fields = array(
                    'image' => $_FILES['image']['name']
                );
                $this->work->update('products',$fields,array('slug'=>$slug));
               
            }
            if(isset($_FILES['image1']) && $_FILES['image1']['name'] !=""){
                 $this->upload_image('image1');
                    $fields = array(
                    'image1' => $_FILES['image1']['name']
                );
                $this->work->update('products',$fields,array('slug'=>$slug));
               
            }

             $this->session->set_flashdata("success","products updated Successfully");
            redirect('admin/products');
          }
    }
    public function product_specification($slug=null,$pro_id=null){
        //both session check back 2 stages
        if($slug==null):
            redirect('admin/index');
        endif;

            $this->form_validation->set_rules('title','title','required');
            $this->form_validation->set_rules('description','description','required');

                if($this->form_validation->run()){
                    $fields = array(
                        'title'=>$_POST['title'],
                        'product_id'=>$pro_id,
                        'description'=>$_POST['description']
                    );
                    $this->db->insert('about_product', $fields);
                    redirect('admin/product_specification'. '/' . $slug . '/' .$pro_id);
                }
                else{
                    $data['about_product'] = $this->work->callingQuery(" select * from about_product where product_id='$pro_id'");
                    $this->load->view('admin/edit_product_details',$data);
                }
    }

    public function delete_product_specification($slug=null,$pro_id=null,$id=null){
        if($id==null && $pro_id==null && $slug==null):
            redirect('admin/products');
        else:
            $this->work->deleteData('about_product',array('product_id'=>$pro_id,'about_id'=>$id));
            redirect('admin/product_specification'. '/' . $slug . '/' .$pro_id);
        endif;
            


    }

    public function products($action=null){
        //calling products
        
            $data['products'] = $this->work->callingQuery('SELECT * FROM products JOIN categories ON products.category = categories.cat_id');
            $this->load->view('admin/products',$data);
        
       }
    public function product($slug=null){
        //calling products
        
            $data['product'] = $this->work->callingQuery("SELECT * FROM products JOIN categories ON products.category = categories.cat_id WHERE products.slug='$slug'");

            $data['about_product'] = $this->work->callingQuery("SELECT * FROM about_product WHERE product_id='".$data['product'][0]->id."'");


            $this->load->view('admin/view_product',$data);
        
       }
    public function orders($action=null){
        $data['orders'] = $this->work->callingQuery('SELECT * FROM orders JOIN users 
                                                                ON orders.user_id = users.user_id 
                                                                JOIN coupon 
                                                                on orders.coupon = coupon.coupon_id
        WHERE orders.ordered=true');
        $this->load->view('admin/orders',$data);           
    }
    public function order_view($order_id=null){
        $data['order'] = $this->work->callingQuery("SELECT * FROM orders JOIN users 
                                                                ON orders.user_id = users.user_id 
                                                                JOIN coupon 
                                                                on orders.coupon = coupon.coupon_id  
                                                                JOIN payment 
                                                                ON orders.order_id = payment.order_id WHERE orders.ordered=true AND orders.order_id='$order_id'");

        $user_id = $data['order'][0]->user_id;      
        $data['orderitem'] = $this->work->callingQuery("SELECT * FROM orderitem JOIN products ON orderitem.product_id=products.id WHERE order_id='$order_id' AND user='$user_id' AND ordered=true");
        
        $data['payment'] = $this->work->callingQuery("SELECT * FROM payment WHERE order_id='$order_id' AND user_id='$user_id'");
        $this->load->view('admin/order_view',$data);           
    }
    public function bulk_enquiry(){
        $data['enquiry'] = $this->work->callingQuery('SELECT * FROM bulk_enquiry JOIN products ON bulk_enquiry.product_id = products.id');
        $this->load->view('admin/bulk_enquiry',$data);

    }


    public function changeOrderStatus($order_id){
        if(isset($_POST['changestate'])){
            $status_id = $this->input->post('status');


            $this->work->update('orders',array('order_status'=>$status_id),array("order_id"=>$order_id));

            redirect('admin/order_view/'.$order_id);
        }
    }
    public function coupons($action=null){
        //calling products
        if($action==null):
        
            $data['coupons'] = $this->work->callingQuery('SELECT * FROM coupon');
            $this->load->view('admin/coupons',$data);
        
        //inserting products
        elseif($action=="insert"):
            $this->form_validation->set_rules('code','code','required');
            $this->form_validation->set_rules('amount','amount','required');
           
        
        //image upload
       
            if($this->form_validation->run()){
                $fields = array(
                    'code' => $_POST['code'],
                    'discount' => $_POST['amount'],
                );
                
                if($this->work->insertData('coupon',$fields)){
                    $this->session->set_flashdata("success","coupon Added Successfully");
                    redirect('admin/coupons/insert');
                }
            }
            else{
                $this->load->view('admin/insert_coupon');
                $this->session->set_flashdata("danger","Try Again or Check data");
                //redirect('admin/products/');
            }
                
            
        //exception
        else:
            redirect('admin/products');
        endif;
    }
    public function offers($action=null){
        //calling products
        if($action==null):
        
            $data['offers'] = $this->work->callingQuery('SELECT * FROM offers');
            $this->load->view('admin/offers',$data);
        
        //inserting products
        elseif($action=="insert"):
            $this->form_validation->set_rules('title','title','required');
            $this->form_validation->set_rules('date','date','required');
           
        
        //image upload
       
            if($this->form_validation->run()){
                $fields = array(
                    'title' => $_POST['title'],
                    'date' => $_POST['date'],
                );
                
                if($this->work->insertData('offers',$fields)){
                    $this->session->set_flashdata("success","Offer Added Successfully");
                    redirect('admin/offers');
                }
            }
            else{
                $this->session->set_flashdata("danger","Try Again or Check data");
                redirect('admin/offers');
            }
        else:
            redirect('admin/offers');
        endif;
    }


    public function delete_offer($id=null){
        if($id!=null):
            if($this->work->deleteData('offers',array("id"=>$id))):
                $this->session->set_flashdata("success","Delete offer Successfully");
                redirect('admin/offers');
            endif;
        else:
            redirect('admin/offers');
        endif;
    }
    public function categories($action=null){
        //calling categories
        if($action==null):
        
            $data['categories'] = $this->work->callingData('categories');
            $this->load->view('admin/categories',$data);
        
        //inserting categories
        elseif($action=="insert"):
            $this->form_validation->set_rules('cat_title','name','required');
            
            
         $config = array(
            'upload_path' => "./assets/image/cat/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
            $this->load->library('upload', $config);
         
        if($this->upload->do_upload('cat_image')){
            if($this->form_validation->run()){
                $fields = array(
                    'cat_title' => $_POST['cat_title'],
                    'cat_description' => $_POST['cat_description'],
                    'cat_slug' => slugify($_POST['cat_title']),
                    'cat_image' => $_FILES['cat_image']['name']
                );
                
                if($this->work->insertData('categories',$fields)){
                    $this->session->set_flashdata("success","products Added Successfully");
                    
                    redirect('admin/categories/insert');
                }
            }
            else{
                $this->load->view('admin/insert_category');
                $this->session->set_flashdata("danger","Try Again or Check data");
                //redirect('admin/products/');
            }
        }
        else{
            $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/insert_category.php',$error);
        }
        //exception
        
        else:
            redirect('admin/categories');
        endif;
        
    }

    public function category_image_change($slug=null){


        if ($this->input->post('category_image')){

             $getCategory = $this->work->callingData('categories',array('cat_slug'=>$slug));
            
            if(isset($_FILES['cat_image']) && $_FILES['cat_image']['name'] !=""){
                unlink('./assets/image/cat/'.$getCategory->cat_image);
                $this->upload_image('cat_image','cat');
                $fields = array(
                    'cat_image' => $_FILES['cat_image']['name']
                );
                $this->work->update('categories',$fields,array('cat_slug'=>$slug));
                $this->session->set_flashdata("success","products updated Successfully");
                redirect('admin/categories');
            }
          }

       
        
    }

    public function edit_category($cat_slug=null){
        //calling categories
       $this->form_validation->set_rules('cat_title','name','required');
            
            
        
            if($this->form_validation->run()){
                $fields = array(
                    'cat_title' => $_POST['cat_title'],
                    'cat_description' => $_POST['cat_description'],
                    'cat_slug' => slugify($_POST['cat_title']),
                );
                
                if($this->work->update('categories',$fields,array('cat_slug'=>$cat_slug))){
                    $this->session->set_flashdata("success","category update Successfully");
                    
                    redirect('admin/categories/');
                }
            }
            else{
                $this->session->set_flashdata("danger","Try Again or Check data");
                $this->load->view('admin/categories');
            }
    }
    public function brands(){
        $this->load->view('admin/brand');
    }
    
}
