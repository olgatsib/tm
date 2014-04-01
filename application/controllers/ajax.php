<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
  	public function modify() {
  		
    	print_r($_POST);
   }
}
?>