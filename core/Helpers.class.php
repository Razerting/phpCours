<?php
class Helpers{
	

	//Vérification en amont de l'existance d'un fichier et dossier de log
	public static function createLogExist(){
		if (is_dir('log')){
			if (file_exists('log/log.txt')){
				return true;
				}else {
				$g = fopen("log/log.txt", "x+");
			}
			}else {
				mkdir("log");
				$f = fopen("log/log.txt", "x+");
			}
		}
	//Ecriture au sein de ce fichier le contenu de $msg avec la date et l'heure
	public static function log($msg){
		self::createLogExist();

		$fichier = fopen('log/log.txt', 'r+');
		fputs($fichier, $msg);
	}

	//Coder la fonction mais ne l'appelez pas, on passera par un cron
	//limite de taille : 5mo
	public static function purgeLog(){
		$fichier = fopen('log/log.txt', 'w');
}

 }