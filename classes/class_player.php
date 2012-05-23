<?php
class diplo_player{
    private $login = 7;
    private $puissance = null;

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
}
?>
