<?php
class Insert extends CI_controller{
 
    
    public function index(){
		if($this->session->userdata('stage2') && $this->session->userdata('stage3')){
			redirect('Insert/product_specification');
		}
		elseif($this->session->userdata('stage2')){
			redirect("insert/product_pincode");
		}
			$this->form_validation->set_rules('title','name','required|trim');
            $this->form_validation->set_rules('category','category','required|trim');
            $this->form_validation->set_rules('price','price','required|trim');
            $this->form_validation->set_rules('discount_price','discount_price','required|trim');
            $this->form_validation->set_rules('description','description','required|trim');
            
        

        //image upload
        $config = array(
            'upload_path' => "./assets/image/products/",
            'allowed_types' => "gif|jpg|jpeg|png|webp",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
            $this->load->library('upload', $config);
            if($this->upload->do_upload('image')){
        
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
                    'image' => $_FILES['image']['name']
                );
                $pro_id = $this->work->insert_get_lastid('products',$fields);
                
				$this->session->set_flashdata("success","products Added Successfully");
				//session for next step
				$this->session->set_userdata('stage2',$pro_id);
				redirect('insert/product_pincode');
               
            }
            else{
                $this->load->view('admin/insert_product');
                $this->session->set_flashdata("danger","Try Again or Check data");
                //redirect('admin/products/');
            }
            }
            else{
                $data['error'] = array('error' => $this->upload->display_errors());
                $data['category'] = $this->work->callingData('categories');
                $this->load->view('admin/insert_product',$data);
            }
    }
    public function product_pincode(){
	//if session not saved go back
        if(!$this->session->userdata('stage2')){
			redirect('Insert/index');
		}

        $data['pincode']  = $this->work->callingData('area');
		
		$this->form_validation->set_rules('pin[]','area','required');

		if($this->form_validation->run()){
			foreach($_POST['pin'] as $pincode_input):
			print_r($pincode_input);
				$fields = array(
					'pincode'=>$pincode_input,
					'product_id'=>$this->session->userdata('stage2')
				);
			$this->db->insert('pincode', $fields);
			endforeach;
			//session set for next step
			$this->session->set_userdata('stage3',$this->session->userdata('stage2'));
			redirect("Insert/product_specification");
		}
		else{
			$this->load->view('admin/insert_pincode_product',$data);
		}
    }
    public function product_specification(){
		//both session check back 2 stages
		if($this->session->userdata('stage2')==null && $this->session->userdata('stage3')==null ){
			redirect('Insert/index');
		}
		elseif($this->session->userdata('stage2')==null){
			redirect("insert/index");
		}
		elseif($this->session->userdata('stage3')==null){
			redirect('insert/product_pincode');
		}

		else{

			$this->form_validation->set_rules('title','title','required');
			$this->form_validation->set_rules('description','description','required');

				if($this->form_validation->run()){
					$fields = array(
						'title'=>$_POST['title'],
						'product_id'=>$this->session->userdata('stage3'),
						'description'=>$_POST['description']
					);
					$this->db->insert('about_product', $fields);
		
				}

		
		}


        $this->load->view('admin/insert_product_details');
    }
    public function clear_session(){
        $this->session->unset_userdata(array('stage1','stage2','stage3'));
        
        redirect('admin/products');
    }
}
?>
