<?php
class Routing{

	private $uri;
	private $uriExploded;

	private $controller;
	private $controllerName;
	private $action;
	private $actionName;
	private $params;

	public function __construct(){
		$this->setUri($_SERVER["REQUEST_URI"]);
		$this->setController();
		$this->setAction();
		$this->setParams();
		$this->runRoute();
	}


	public function setUri($uri){
		$uri = preg_replace("/".PATH_RELATIVE_PATTERN."/i", "", $uri, 1);
		$this->uri = trim($uri, "/");
		$this->uriExploded = explode("/", $this->uri);
	}

	public function setController(){
		$this->controller = (empty($this->uriExploded[0]))?"Index":ucfirst($this->uriExploded[0]) ;
		$this->controllerName = $this->controller."Controller";
		unset($this->uriExploded[0]);
	}

	public function setAction(){
		$this->action = (empty($this->uriExploded[1]))?"index":$this->uriExploded[1];
		$this->actionName = $this->action."Action";
		unset($this->uriExploded[1]);
	}


	public function setParams(){
		$this->params = array_merge(array_values($this->uriExploded), $_POST);
	}

		
	public function checkRoute(){
		//Est ce que le fichier controller existe
		$pathController = "controllers".DS.$this->controllerName.".class.php";
		
		if( !file_exists($pathController) ){
			Helpers::log("Le controller ".$this->controllerName." n'existe pas");
			return false;
		}
		include $pathController;

		//Est ce que l'instanciation est possible
		if( !class_exists($this->controllerName)){
			echo "error class";
			return false;
		}
		//Est ce que la méthode existe à travers l'objet
		if(!method_exists($this->controllerName, $this->actionName)){
			echo "error method";
			return false;
		}


		return true;
	}

	public function runRoute(){
		if($this->checkRoute()){

			// $this->$controllerName =  IndexContoller
			$controller = new $this->controllerName;
			// $this->actionName  = indexAction;
			$controller->{$this->actionName}($this->params);


		}else{
			$this->page404();
		}
	}

	public function page404(){
		die("Page 404");
	}


}




