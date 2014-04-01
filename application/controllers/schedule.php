<?php
class Schedule extends CI_Controller {
	public function index() {
		$data ['page'] = 's';
		$this->load->view ( 'header', $data );
		$this->load->view ( 'schedule_view' );
	}
}
?>