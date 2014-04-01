<?php
class Editor extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index() {
		$data ['page'] = 'e';
		$this->load->view ( 'header', $data );
		$this->load->view ( 'editor_view' );
	}
	public function new_entry() {
		$post = $this->input->post ();
		$this->load->model ( 'editor_model' );
		$this->editor_model->add_entry ( $post );
		$this->index ();
	}
	public function modify() {
		
		$post = $this->input->post();
		$this->load->model ('editor_model');
		$this->editor_model->modify_entry( $post );
		
	}
	
	public function delete() {
		$post = $this->input->post();
		$this->load->model ('editor_model');
		$this->editor_model->delete_entry( $post );
	}
}
?>