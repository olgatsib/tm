<?php
class Idle_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function setTimeIdle($min) {
		$timeDone = $min;
		$date = date ( "Y-m-j" );
		$this->db->select ( 'time, date' );
		
		$query = $this->db->get_where ( 'idle', array (
				'date' => $date 
		) );
		
		if ($query->num_rows () > 0) {
			$time = $query->row ()->time;
			$min += $time;
			$this->db->set ( 'time', $min );
			$this->db->update ( 'idle' );
		} else {
			$sql = "INSERT INTO idle (date, time) VALUES (Now(), '$min')";
			$this->db->query ( $sql );
		}
	}
}