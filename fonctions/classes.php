<?php
class Trow{
	// variables
	var $tableau; 
	var $entete;
	var $modif;
	
	public function __construct($rep_tableau,$rep_entete,$admin){
	// $rep_tableau = tableau contenant les éléments récupéré d'une requete -> MYSQL
	// $rep_entete = tableau contenant le nom des colonnes à afficher -> MYSQL
	// $admin = permet de savoir si l'utilisateur est un admin ou pas -> BOOL
	
		$this->modif = $admin;
		$i=0;
		$k=0;
		
		if(mysql_num_rows($rep_tableau) != 0){
			while($temp = mysql_fetch_array($rep_tableau)){
				for($j=0;$j<mysql_num_fields($rep_tableau);$j++){
					$this->tableau[$i][$j] = $temp[$j];
				}
				$i++;
			}
		}
		
		if(mysql_num_fields($rep_entete) != 0){
			while($tmp = mysql_fetch_array($rep_entete)){
				$this->entete[$k] = $tmp[0];
				$k++;
			}
		}
	}
	
	public function debut_table(){
	// balise début de tableau
	
		echo "<table>";
	}
	
	public function fin_table(){
	// balise fin de tableau
	
		echo "</table>";
	}
	
	public function afficher_contenu(){
	// affiche le contenu du tableau $tab avec les entete contenu dans $head
	
		echo "<thead>";
			echo "<tr>";
				for($i=0;$i<count($this->entete);$i++){
					echo "<th>";
						echo $this->entete[$i];
					echo "</th>";
				}
			echo "</tr>";
		echo "</thead>";
		
		echo "<tbody>";
		for($i=0;$i<count($this->tableau);$i++){
			echo "<tr>";
			for($j=0;$j<count($this->entete);$j++){
				echo "<th>";
					echo "<span>".$this->tableau[$i][$j]."</span>";
				echo "</th>";
			}
			echo "</tr>";
		}
		echo "</tbody>";
	}
	
	public function js_admin(){
	// inclus le code js permettant la modification des champs des vues
	
		if($this->modif){
			echo "<script src='js/click_cells.js'></script>";
		}
	}
}

class Connexion{
	// variables
	var $db;
	var $query;
	
	public function __construct(){
	// constructeur
	
		try{
			$this->db = new PDO('mysql:host=localhost;dbname=projet_tut', $user, $pass);
		} catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
	
	public function getDB(){
	// getter $db
	
		return $this->db;
	}
	
	public function getEnseignant($id){
	// Requête : récupère toute les informations de l'enseignant $id
		
		$sql = "SELECT nom, prenom, idService, HTD, HTP, HCM, nomFiliere, idFiliere, nombreGr, libelle, semestre ";
		$sql .= "FROM service, enseignement, filiere, enseignant ";
		$sql .= "WHERE service.idEnseignement = enseignement.idEnseignement ";
		$sql .= "AND service.idFiliere = filiere.idFiliere ";
		$sql .= "AND service.idEnseignant = enseignant.idEnseignant ";
		$sql .= "AND idEnseignant = '".$id."';";
		
		return $sql;
	}
	
	public function getEnseignants(){
	// Requête : renvoi tous les enseignants
	
		$sql = "SELECT * FROM enseignant;";
		
		return $sql;
	}
	
	public function getEnseignements(){
	// Requête : renvoi tous les enseignements
	
		$sql = "SELECT * FROM enseignement;";
		
		return $sql;
	}
	
	public function getEnseignement($id){
	// Requête : renvoi l'enseignement $id
		
		$sql = "SELECT * FROM enseignement ";
		$sql .= "WHERE idEnseignement = '".$id."'";
		
		return $sql;
	}
	
	public function getFilieres(){
	// Requête : renvoi toutes les filières
	
		$sql = "SELECT * FROM filiere";
		
		return $sql;
	}
	
	public function 
}
?>