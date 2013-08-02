<?php

class User extends BaseModel {
	public function findByEmailAndPassword($email, $password) {
		$s = $this->db->prepare('SELECT * FROM `' . $this->tableName . '` WHERE `email` = ? AND `password` = ?');
		$s->bind_param('ss', $email, $password);

		$s->execute();
		$s->store_result();

		if($s->num_rows == 0) {
			return null;
		} elseif($s->num_rows > 1) {
			exit('More then one user found');
		}

		return $s->fetch;
	}
}