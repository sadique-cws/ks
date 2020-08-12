<?php
require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");

class Cart extends CI_controller {
    function __construct() {

        parent::__construct();

        $this->session->set_userdata( 'redirect_back', $this->agent->referrer() );

        $log = $this->session->userdata( 'user' );
        if ( !$this->session->userdata( 'user' ) ) {
            $this->session->set_flashdata( 'msg', 'Login First' );
            redirect( 'auth/login' );
        }

        if ( $log ) {
            $this->data['user'] = $this->work->callingData( 'users', ['contact'=>$log] );
            $this->user_id = $this->data['user']->user_id;
            $this->data['cart_count'] = $this->work->countData( 'orderitem', array( 'ordered'=>false, 'user'=>$this->user_id ) );
        } else {
            $this->data['cart_count'] = 0;
        }
        $user_id = $this->user_id;
        $this->data['order'] = $this->work->callingQuery( "SELECT * from orders LEFT JOIN coupon ON orders.coupon = coupon.coupon_id
        where orders.user_id='$user_id'  AND orders.ordered=false" );
        $this->data['orderitem'] = $this->work->callingQuery( " 
                                                select * from orderitem JOIN products ON 
                                                orderitem.product_id = products.id where 
                                                user = '$user_id' and
                                                ordered = false" );
		$this->data['categories'] = $this->work->callingData('categories');

		if(!empty($this->data['order'])){
		
        $this->data['total_amount'] = $this->get_total_amount( $this->data['orderitem'] );
        $this->data['total_discount_amount'] = $this->get_total_discounted_amount( $this->data['orderitem'], $this->data['order']);
        $this->data['get_total_saving_amount'] = $this->get_total_saving_amount( $this->data['orderitem'], $this->data['order'] );
        $this->data['get_coupon_amount'] = $this->get_coupon_amount( $this->data['order'][0]->discount, $this->data['total_discount_amount'] );
        $this->data['total_payable_amount'] = $this->get_total_amount( $this->data['orderitem']) - $this->data['get_total_saving_amount'];
		
		}
    }

    public function PaytmGateway( $order_id ) {
        $amount = $this->data['total_payable_amount'];
        $contact = $this->data['user']->contact;
        $email = $this->data['user']->email;
        $orderid = $this->data['order'][0]->order_id;
        $this->StartPayment( $order_id, $amount, $this->user_id, $contact, $email, $orderid );
    }

   

    public function PaytmResponse() {
        $paytmChecksum = '';
        $paramList = array();
        $isValidChecksum = 'FALSE';

        $paramList = $_POST;

        $paytmChecksum = isset( $_POST['CHECKSUMHASH'] ) ? $_POST['CHECKSUMHASH'] : '';
        //Sent by Paytm pg

        $isValidChecksum = verifychecksum_e( $paramList, PAYTM_MERCHANT_KEY, $paytmChecksum );
        //will return TRUE or FALSE string.

        if ( $isValidChecksum == 'TRUE' ) {
            if ( $_POST['STATUS'] == 'TXN_SUCCESS' ) {

                //success data db update
                //update order table

                $order = $this->work->update( 'orders', array(
                    'ordered'=>true,
                    'ref_code'=>create_ref(),
                    'ordered_date'=>date( 'Y-m-d H:i:s' )
                ),
                array(
                    'user_id'=>$this->user_id,
                    'ordered'=>false )
                );

                foreach ( $this->data['orderitem'] as $oi ) {
                    $this->work->update( 'orderitem', array( 'ordered'=>true ), array( 'user'=>$this->user_id ) );
                }

                $pay = $this->work->insertData( 'payment', array(
                    'txn_id'=>$paramList['TXNID'],
                    'order_id'=>$paramList['MERC_UNQ_REF'],
                    'user_id'=>$this->user_id,
                    'amount'=>$paramList['TXNAMOUNT'],
                    'type'=>$paramList['PAYMENTMODE'],
                    'status'=>$paramList['STATUS'],
                    'payment_type'=>$paramList['PAYMENTMODE'],
                    'bank_txnid'=>$paramList['BANKTXNID'],
                    'txn_date'=>$paramList['TXNDATE'] )
                );

                $this->session->set_flashdata( 'msg', 'Payment Done successfully' );
                redirect( 'user/index' );

            } else {
                /// failed
                $this->session->set_flashdata( 'msg', 'Payment fail try again' );
                redirect( 'cart/index' );
            }
        } else {
            //////////////suspicious
            $this->session->set_flashdata( 'msg', 'something wrong try again' );
            redirect( 'cart/index' );

        }
    }

    public function empty_pincode( $slug = null ) {
		$order_query = $this->work->update( 'users', array( 'user_pincode'=>null ), array( 'user_id'=>$this->user_id ) );
            $this->redirect_next( 'p'.$slug );
    }

    private function redirect_next( $page = null ) {
        if ( $this->session->userdata( 'redirect_back' ) ) {
            $redirect_url = $this->session->userdata( 'redirect_back' );

            $this->session->unset_userdata( 'redirect_back' );
            redirect( $redirect_url );
        } else {
            redirect( $page );
        }

    }

    public function pincode_update() {
        $this->form_validation->set_rules( 'pincode', 'pincode', 'required|numeric|exact_length[6]' );

        if ( $this->form_validation->run() ) {
            $pincode = $_POST['pincode'];
            $order_query = $this->work->update( 'users', array( 'user_pincode'=>$pincode ), array( 'user_id'=>$this->user_id ) );
          
        } else {
            $this->session->set_flashdata( 'msg', 'Please enter Valid pincode' );
          }
		   $this->redirect_next( 'welcome/index' );
        
    }

    public function pincode_check( $slug = null ) {

        if ( $slug == null ) {
            $this->session->set_flashdata( 'msg', 'Something went Wrong' );
            redirect( 'welcome/index' );
        }
        $this->form_validation->set_rules( 'pincode', 'pincode', 'required' );

        if ( $this->form_validation->run() ) {
            $pincode = $_POST['pincode'];

            $pro = $this->work->callingData( 'products', array( 'slug'=>$slug ) );
			$product_id =$pro->id;
            $pin = $this->work->callingQuery("select * from pincode JOIN area ON pincode.pincode = area.area_id where pincode.product_id='$product_id' AND area.area_pincode='$pincode'");
			
            if ( !empty( $pin ) ) {
			print_r($pin);
                $order_query = $this->work->update( 'users', array( 'user_pincode'=>$pincode ), array( 'user_id'=>$this->user_id ) );
                $this->session->set_flashdata( 'msg', 'We Delivery this product at your Area' );
               

            } else {
                $this->session->set_flashdata( 'msg', 'sorry this product is not available in your area' );
               
            }
			 redirect( 'p'.$slug );
            #todo: check pin code

        }

    }

    public function add_to_cart( $slug = null ) {
        $product = $this->work->callingData( 'products', array( 'slug'=>$slug ) );

        if ( empty( $product ) ) {
            $this->session->set_flashdata( 'msg', 'Something error try again' );
            redirect( 'welcome/index' );
        }

        $order = $this->work->callingData( 'orders', array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
        $order_id  = $order->order_id;

        if ( empty( $order ) ) {
            $order = $this->work->insert_get_lastid( 'orders', array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
            $order_id = $order;
        }

        $orderItemCheck = $this->work->callingData( 'orderitem', array( 'user'=>$this->user_id, 'ordered'=>false, 'product_id'=>$product->id ) );

        if ( empty( $orderItemCheck ) ) {
            $order_item = $this->work->insertData( 'orderitem', array(
                'user'=>$this->user_id,
                'order_id'=>$order_id,
                'product_id'=>$product->id,
                'ordered'=>false ) );
            } else {
                $qty = $orderItemCheck->qty += 1;
                $order_item = $this->work->update( 'orderitem', array(
                    'qty' =>$qty,
                ),
                array(
                    'orderitem_id'=>$orderItemCheck->orderitem_id
                ) );
            }

            $this->session->set_flashdata( 'msg', 'Product added Successfully' );
           redirect( 'Cart/index' );
        }

    public function remove_from_cart( $slug = null ) {
        $user_id = $this->user_id;
        $orderitem = $this->work->callingQuery( " 
                                            select * from products JOIN orderitem ON 
                                            products.id=orderitem.product_id where 
                                            user = '$user_id' and
                                            ordered = false and
                                            products.slug = '$slug'" );
        $delete_query = $this->work->deleteData( 'orderitem', array( 'orderitem_id'=>$orderitem[0]->orderitem_id ) );

        if ( $delete_query ) {
            $this->session->set_flashdata( 'msg', 'item deleted sucessfully' );
        } else {
            $this->session->set_flashdata( 'msg', 'Something error try again' );
        }
        redirect( 'Cart/index' );
    }

    public function minus_qty_cart( $slug = null ) {
        $user_id = $this->user_id;
        $orderitem = $this->work->callingQuery( " 
                                            select * from products JOIN orderitem ON 
                                            products.id=orderitem.product_id where 
                                            user = '$user_id' and
                                            ordered = false and
                                            products.slug = '$slug'" );

        $update_query = $this->work->update( 'orderitem', array( 'qty'=>$orderitem[0]->qty -= 1 ), array( 'orderitem_id'=>$orderitem[0]->orderitem_id ) );

        if ( $orderitem[0]->qty > 0 ) {
            if ( $update_query ) {
                $this->session->set_flashdata( 'msg', 'item updated sucessfully' );
            } else {
                $this->session->set_flashdata( 'msg', 'Something error try again' );
            }
        } else {
            $this->remove_from_cart( $slug );
        }
        redirect( 'Cart/index' );
    }

    private function get_total_amount( $order_item ) {
        $total = 0;
        foreach ( $order_item as $o ) {
            $total += ( $o->price * $o->qty );
        }
        return $total;
    }

    private function get_total_discounted_amount( $order_item, $order ) {
        $total = 0;
        if ( !empty( $order ) ):
        foreach ( $order_item as $o ) {
            if ( $o->discount_price > 0 ) {
                $total += ( $o->discount_price * $o->qty );
            }
        }
        //if ( $order[0]->coupon != null ) {
          //  $total -= $order['0']->discount/100*($total);
        //}
        endif;
        return $total;
    }

	private function get_coupon_amount($discount,$total){
			return ($discount*$total)/100;
	}
	
    private function get_total_saving_amount( $order_item, $order ) {
        $total = 0;
        if ( !empty( $order ) ):

        foreach ( $order_item as $o ) {
            if ( $o->discount_price > 0 ) {
                $total += ($o->price - $o->discount_price) * $o->qty;
            }
        }
        if ( $order[0]->coupon != null ) {
            $total += $this->get_coupon_amount($order[0]->discount,$this->get_total_discounted_amount($order_item,$order));
        }
        return $total;
        endif;
    }

    public function index() {
    $this->load->view( 'cart', $this->data );
    }

    public function check_coupon( $code ) {
        $coupon = $this->work->check_data( 'coupon', array( 'code'=>$code, 'status'=>'1' ) );
        return $coupon;
    }

    public function get_coupon( $coupon ) {
        if ( $this->check_coupon( $coupon ) ) {
            $data = $this->work->callingQuery( "select * from coupon where code='$coupon' AND status='1'" );
            return $data;
        } else {
            return 0;
        }

    }

    public function add_coupon() {
        $this->form_validation->set_rules( 'coupon', 'coupon', 'required' );
        if ( $this->form_validation->run() ) {
            $code = $this->input->post( 'coupon' );

            $coupon_query = $this->get_coupon( $code );

            if ( $coupon_query == 0 ) {
                $this->session->set_flashdata( 'msg', 'Invalid Coupon/ Expired coupon' );
                redirect( 'cart/index' );

            } else {
                $order_query = $this->work->update( 'orders', array( 'coupon'=>$coupon_query[0]->coupon_id ), array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
                redirect( 'cart/index' );

            }
        } else {
            $this->session->set_flashdata( 'msg', 'Please Enter Coupon Code' );
            redirect( 'cart/index' );

        }

    }


    public function remove_coupon() {
         $order_query = $this->work->update( 'orders', array( 'coupon'=>null ), array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
            redirect( 'cart/index' );

    }

    public function checkout() {

     
        if ( empty( $this->data['order'] ) ) {
            $this->session->set_flashdata( 'msg', 'Not have any active order' );

            redirect( 'welcome/index' );
        } else {

            if ( empty( $this->data['orderitem'] ) ) {
                $this->session->set_flashdata( 'msg', 'Your Cart is Empty' );

                redirect( 'welcome/index' );
            }
        }

        $this->form_validation->set_error_delimiters( "<span class='helper-text red-text'>", '</span>' );
        $this->form_validation->set_rules( 'street', 'street', 'required' );
        $this->form_validation->set_rules( 'city', 'city', 'required' );
        $this->form_validation->set_rules( 'pincode', 'pincode', 'required' );

        if ( isset( $_POST['save_address'] ) ) {
            $address_id = $_POST['save_address'];
            $order_query = $this->work->update( 'orders', array( 'address_id'=>$address_id ), array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
            $this->session->set_flashdata( 'msg', 'Address Saved on your order' );
            redirect( 'cart/PaytmGateway/'.create_ref(6));

        } else {
            if ( $this->form_validation->run() ) {
                $data = [
                    'name'=>$_POST['name'],
                    'alternative_contact'=>$_POST['alt_contact'],
                    'street'=>$_POST['street'],
                    'user_id'=>$this->user_id,
                    'city'=>$_POST['city'],
                    'pin'=>$_POST['pincode']
                ];

                $address_id = $this->work->insert_get_lastid( 'address', $data );
                $order_query = $this->work->update( 'orders', array( 'address_id'=>$address_id ), array( 'user_id'=>$this->user_id, 'ordered'=>false ) );
                $this->session->set_flashdata( 'msg', 'Address Saved on your order' );

                redirect( 'cart/PaytmGateway/'.create_ref(6));

            } else {
                $this->data['address'] = $this->work->callingQuery("SELECT * FROM address WHERE user_id='" . $this->user_id."'");
                $this->load->view( 'checkout', $this->data );
            }
        }

    }

	 public function StartPayment( $orderId, $amount, $user_id, $contact, $email, $id ) {
        $paramList['MID'] = PAYTM_MERCHANT_MID;
        $paramList['ORDER_ID'] = $orderId;
        $paramList['CUST_ID'] = $user_id;
        /// according to your logic
        $paramList['INDUSTRY_TYPE_ID'] = 'RETIAL';
        $paramList['CHANNEL_ID'] = 'WEB';
        $paramList['TXN_AMOUNT'] = $amount;
        $paramList['WEBSITE'] = PAYTM_MERCHANT_WEBSITE;

        $paramList['CALLBACK_URL'] = base_url( '/cart/PaytmResponse' );
        $paramList['MSISDN'] = $contact;
        //Mobile number of customer
        $paramList['EMAIL'] = $email;
        $paramList['VERIFIED_BY'] = 'EMAIL';
        //
        $paramList['IS_USER_VERIFIED'] = 'YES';
        //
        $paramList['MERC_UNQ_REF'] = $id;
        //  print_r( $paramList );
        $checkSum = getChecksumFromArray( $paramList, PAYTM_MERCHANT_KEY );

        ?>
    <!--submit form to payment gateway OR in api environment you can pass this form data-->
    <form id='myForm' action='<?php echo PAYTM_TXN_URL ?>' method='post'>
        <?php
        foreach ( $paramList as $a => $b ) {
            echo '<input type="hidden" name="'.htmlentities( $a ).'" value="'.htmlentities( $b ).'">';
        }
        ?>
            <input placeholder='' type='hidden' name='CHECKSUMHASH' value="<?php echo $checkSum ?>"> </form>
    <script type='text/javascript'>
        document.getElementById('myForm').submit();
    </script>
    <?php
    }
}
