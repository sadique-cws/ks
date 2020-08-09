<?php 
function create_ref($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function Get_AreaName($pincode=null){
	    $CI = get_instance();
	        $CI->load->model('work');

        if($pincode != null){

            $getArea = $CI->work->callingData('area',array('area_pincode'=>$pincode));

            return $getArea;
        }
        else{
            redirect('welcome/index');
        }
    }
    

?>