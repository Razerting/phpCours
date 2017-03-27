<?php
class IndexController{


	public function indexAction($params){
		
		$user = new User();
		$user->populate(["id"=>31]);
		echo $user->getEmail();

		



		$pseudo = "prof";
		$v = new View();
		$v->assign("pseudo", $pseudo);

	}

	public function welcomeAction($params){
		echo "Welcome";
	}


}