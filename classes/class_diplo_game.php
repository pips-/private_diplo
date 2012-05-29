<?php
include_once 'classes/class_player.php';
class diplo_game{

    private $id = 1;
    private $name = "";
    private $max_players = 7;
    private $nb_players = 0;
    private $players = array();
    private $date_create = 0;

    public function save(){
        if($this->date_create == 0){
            $this->date_create = time();
        }
    }

    public function addPlayer($login,$puissance){
        if ($this->nb_players < $this->max_players){
            $player = new diplo_player();
            $player->setLogin($login);
            $player->setPuissance($puissance);
            $this->players[] = $player;
            $this->nb_players++;
            $this->save();
        }
    }

    public function setMaxPlayers($max_players){
        $this->max_players = $max_players;
    }
    public function getMaxPlayers(){
        return $this->max_players;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
}
?>
