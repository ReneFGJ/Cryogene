<?php
class securitys extends CI_model {
	function save($nome, $user, $id) {
		$newdata = array('name' => $nome, 'user' => $user, 'id' => $id);
		$this->session->set_userdata($newdata);
	}
	function security()
		{
			$arr = $this->session->userdata();
		}
}
?>