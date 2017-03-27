<?php
class BaseSql{

	private $db;
	private $table;	
	private $columns = [];

	//Connexion à la bdd
	public function __construct(){
		try{
			$this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT,DB_USER,DB_PWD);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}
		
		//Récupérer le nom de la table dynamiquement
		$this->table = strtolower(get_class($this));
		//Récupérer le nom des colonnes de la table dynamiquement
		$varObject = get_class_vars($this->table);
		$varParent = get_class_vars(get_parent_class($this));
		$this->columns = array_diff_key($varObject, $varParent);
	}

	//INSERT Or UPDATE en BDD
	public function save(){
		if($this->id == -1){

			unset($this->columns["id"]);
			$sqlCol = null;
			$sqlKey = null;

			foreach ($this->columns as $columns => $value) {
				$data[$columns] = $this->$columns;
				$sqlCol .= ",".$columns;
				$sqlKey .= ",:".$columns;
			}
			$sqlCol = trim($sqlCol, ",");
			$sqlKey = trim($sqlKey, ",");
				
			$query = $this->db->prepare(
				"INSERT INTO ".$this->table." (".$sqlCol.") VALUES (".$sqlKey.");");
			$query->execute($data);

		}else{
			foreach ($this->columns as $columns => $value) {
				$data[$columns] = $this->$columns;
				$sqlQuery[] = $columns."=:".$columns;
			}
			$query = $this->db->prepare(
				"UPDATE ".$this->table." SET ".implode(",", $sqlQuery)." WHERE id=:id;");
			$query->execute($data);
		}
	}


	public function populate($array){
		
	foreach ($this->columns as $columns => $value) {
		$data[$columns] = $this->$columns;
		$sqlCol .= ",".$columns;
		$sqlKey .= ",:".$columns;
	}	

	$request = "SELECT * FROM " . $this->table . " ";
    foreach ($array as $item => $value) {
        $request .= $item.'='.$value . ' AND';
    }

    $request = substr($request, 0, -4);

    $response = $this->db->query($request);

    $response->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_class($this));

    $data = $response->fetch();

    return $data;

		//a ma condition et alimente l'objet
	}

}








