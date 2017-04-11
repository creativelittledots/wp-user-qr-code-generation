<?php
	
	namespace Test\Classes;
	
	class UserQr {
		
		private static $instance;
		
		private $qr_length = 8;
		private $qr_key = 'qr_code';
		
		public static function init() {
			
			if( empty( static::$instance ) ) {
				
				static::$instance = new self();
				
			}
			
			return static::$instance;
			
		}
		
		public function __construct() {
			
			add_action( 'user_register', array( $this, 'generateUserQrCode' ) );
			
			add_filter( 'rest_prepare_user', array( $this, 'appendUserQrCode' ), 10, 3 );
			
		}
		
		public function generateUserQrCode( $user_id ) {
			
			$qr = $this->generateQrCode();
			
			global $wpdb;
			
			while( $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key = %s AND meta_value = %s", '_' . $this->qr_key, $qr ) ) ) {
				
				$qr = $this->generateQrCode();
				
			}
			
			update_user_meta( $user_id, '_' . $this->qr_key, $qr );
			
		}
		
		public function generateQrCode() {
			
			return substr( md5( uniqid( mt_rand(), true ) ), 0, $this->qr_length );
			
		}
		
		public function appendUserQrCode($response, $user, $request ) {
			
			$response->data[$this->qr_key] = $user->{'_' . $this->qr_key};
			
			return $response;
			
		}
		
	}