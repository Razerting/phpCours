<?php
class User extends BaseSql{

	protected $id;
	protected $email;
	protected $pwd;
	protected $firstname;
	protected $lastname;
	protected $permission;
	protected $status;


	public function __construct($id=-1, $email=null, $pwd=null, $firstname=null, $lastname=null, $permission=0, $status=0){

		parent::__construct();

		$this->setId($id);
		$this->setEmail($email);
		$this->setPwd($pwd);
		$this->setFirstname($firstname);
		$this->setLastname($lastname);
		$this->setPermission($permission);
		$this->setStatus($status);

	}

	public function setId ($id){
		$this->id = $id;
	}
	public function setEmail ($email){
		$this->email = trim($email);
	}
	public function setPwd ($pwd){
		$this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
	}
	public function setFirstname ($firstname){
		$this->firstname = trim($firstname);
	}
	public function setLastname ($lastname){
		$this->lastname = trim($lastname);
	}
	public function setStatus ($status){
		$this->status = $status;
	}
	public function setPermission ($permission){
		$this->permission = $permission;
	}



}