<?php
class diplo_player extends diplo{
	const TABLE_NAME = 'diplo_player';

	function __construct() {
		parent::diplo(self::TABLE_NAME,'id');
	}

    public function setLogin($login){
        $this->login = $login;
    }
    public function getLogin(){
        return $this->login;
    }

    public function setPuissance($puissance){
        $this->puissance = $puissance;
    }
    public function getPuissance(){
        return $this->puissance;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getNom(){
        return $this->nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function getPrenom(){
        return $this->prenom;
    }

    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
}
?>
