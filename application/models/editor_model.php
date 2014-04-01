<?php
class Editor_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function add_entry($post) {
		$dateFrom = $post ['date'];
		$subject = $post ['subject'];
		
		$hStart = $post ['hourStart'];
		$mStart = $post ['minStart'];
		$timeStart = $hStart . ":" . $mStart;
		
		$hFinish = $post ['hourFinish'];
		$mFinish = $post ['minFinish'];
		$timeFinish = $hFinish . ":" . $mFinish;
		
		$typeString = $post ['type'];
		if (strcmp ( $typeString, "Study" ) == 0)
			$type = 0;
		else
			$type = 1;
		
		$timestamp = strtotime ( $dateFrom );
		$date = date ( "Y-m-d", $timestamp );
		
		$till = $post ['tillDate'];
		
		if (strcmp ( $till, "" ) == 0) { // enter for one day only
			
			$sql = "INSERT INTO ci_schedule (date, subject, time_start, time_finish, type, time_spent)
				VALUES ('$date', '$subject', '$timeStart', '$timeFinish', '$type', '0')";
			
			$this->db->query ( $sql );
		} else {
			$d = strtotime ( $dateFrom );
			$dateTill = strtotime ( $till );
			while ( $d <= $dateTill ) {
				
				$date = date ( "Y-m-d", $d );
				
				$sql = "INSERT INTO ci_schedule (date, subject, time_start, time_finish, type, time_spent) 
					VALUES ('$date', '$subject', '$timeStart', '$timeFinish', '$type', '0')";
				
				$this->db->query ( $sql );
				
				$dateFrom = date ( 'j-m-Y', strtotime ( '+1 week', $d ) );
				$d = strtotime ( $dateFrom );
			}
		}
		if (count ( $post ) > 7) {
			// mysqli_query($con, "SELECT * FROM schedule ORDER BY date ASC");
			$sql = "ALTER TABLE ci_schedule DROP id";
			$this->db->query ( $sql );
			$sql = "ALTER TABLE ci_schedule ADD id INT AUTO_INCREMENT primary key first";
			$this->db->query ( $sql );
		}
	}
	public function modify_entry($post) {
		
		$id = $post['id'];
				
		if ($post['start'] != "") {
			$this->db->where('id', $id);
			$this->db->set('time_start', $post['start']);
			$this->db->update('ci_schedule');	
		}
		if ($post['finish'] != "") {
			$this->db->where('id', $id);
			$this->db->set('time_finish', $post['finish']);
			$this->db->update('ci_schedule');
		}
		if ($post['course'] != "") {
			$this->db->where('id', $id);
			$this->db->set('subject', $post['course']);
			$this->db->update('ci_schedule');
		}	
	}
	public function delete_entry($post) {
	
		$id = $post['id'];
		$this->db->delete('ci_schedule', array('id' => $id));
	}
}
?>