<?php
class View{

	private $view;
	private $template;
	private $data=[];


	public function __construct($view="index", $template="frontend"){

		$this->setView($view);
		$this->setTemplate($template);

	}

	public function setView($view){
			if(file_exists("views/".$view.".view.php")){
				$this->view = $view;
			}else{
				//Log

				die("La vue n'existe pas");
			}
	}

	public function setTemplate($template){
			if(file_exists("views/".$template.".temp.php")){
				$this->template = $template;
			}else{
				//Log

				die("Le template n'existe pas");
			}
		
	}

	public function assign($key, $value){
		$this->data[$key]=$value;
	}

	public function __destruct(){
		extract($this->data);

		include "views/".$this->template.".temp.php";

	}

}





