<?php
class Display extends CI_Controller {
			
	public function index() {
		
		$day = $this->input->post ('day');
		
		if ($day === "Today") {
			$this->today();
			
		}
		else if ($day === "Week") {
			$this->week();
			
		}
		else if ($day === "Demo") {
			$this->demo();
		}
	}
	public function today() {
		$data ['page'] = 'r';
		$this->load->view ( 'header', $data );
		$this->load->model ( 'display_model' );
		
		$data ['flag'] = 't';
		$this->load->view ( 'display/start', $data );
		$data['row'] = $this->display_model->makeQuery("Today");
		$this->load->view ( 'display/today', $data );
		$this->load->view ( 'display/finish' );
		
	}
	public function week() {
		$data ['page'] = 'r';
		$this->load->view ( 'header', $data );
		$this->load->model ( 'display_model' );
		$this->load->helper('url');
		
		$data ['flag'] = 'w';
		$this->load->view ( 'display/start', $data );
		$data['row'] = $this->display_model->makeQuery("Week");
		$this->load->view ( 'display/week', $data );
		
	}
	
	public function demo() {
		$data ['page'] = 'r';
		$this->load->view ( 'header', $data );
		$this->load->model ( 'display_model' );
		$this->load->helper('url');
		
		$data ['flag'] = 'w';
		$this->load->view ( 'display/start', $data );
		$data['row'] = $this->display_model->makeQuery("Demo");
		$this->load->view ( 'display/demo', $data );
		
	}
	
	public function update_time($post) {
		$post = $this->input->post ();
		
		$this->load->model ( 'display_model' );
		$this->display_model->setTimeSpent ( $post );
		
	}
	public function update() {
		$post = $this->input->post();
		if ($post['day'] == "Week") {
			$this->update_time($post);
			$this->week();
		}
		else if ($post['day'] == "Today") {
			$this->update_time($post);
			$this->today();
		}
	}
	
	public function idle() {
		$min = $this->input->post ('idle');
		$this->load->model ( 'idle_model' );
		$this->idle_model->setTimeIdle ( $min );
		$this->date = date ( "Y-m-j" );
		$this->today();
	}
}
?>