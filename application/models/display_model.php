<?php
class Display_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function makeQuery($day) {
		
		
		//$day = $this->input->post ( 'day' );
		if ($day === 'Today') {
			
			$data['row'] = $this->getToday();
			//$this->load->view ( 'display/today', $data );
			//$this->load->view ( 'display/finish' );
			return $data['row'];
		}
		else if ($day === "Week") {
			
			$data['row'] = $this->getWeek();
			//$this->load->view ( 'display/week', $data );
			return $data['row'];
		}
		else if ($day === "Demo") {
			$data['row'] = $this->getDemo();
			return $data['row'];
		}
	}
	public function getToday() {
		$this->db->select ( 'id, time_start, 
				time_finish, subject, time_spent, type' );
		$query = $this->db->get_where ( 'schedule', array (
				'date' => date ( "Y-m-j" )
		) );
		return $query->result_array ();
	}
	public function getWeek() {
		$this->db->select ( 'id, date, time_start,
				time_finish, subject, time_spent, type' );
		$this->db->from('ci_schedule');
		$this->db->where("`date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 7 DAY)", NULL, FALSE);
		$this->db->order_by("date", "asc");
		$query = $this->db->get();
		return $query->result_array ();
	}
	public function getDemo() {
		$this->db->select ( 'id, date, time_start,
				time_finish, subject, time_spent, type' );
		$this->db->from('ci_schedule');
		$this->db->order_by("date", "asc");
		$query = $this->db->get();
		return $query->result_array ();
	}
	public function setTimeSpent($post) {
		$timeDone = $post ['time'];
		$id = $post ['id'];
		$this->db->select ( 'type, time_spent' );
		$query = $this->db->get_where ( 'ci_schedule', array (
				'id' => $id 
		) );
		if ($query != null) {
			$type = $query->row ()->type;
			$time = $query->row ()->time_spent;
			$this->db->where ( 'id', $id );
			if ($type == 0) { // study
				$timeNew = $time + $timeDone;
				$this->db->set ( 'time_spent', $timeNew );
			} else { // other
				$this->db->set ( 'time_spent', $timeDone );
			}
			$this->db->update ( 'ci_schedule' );
		}
	}
}
?>