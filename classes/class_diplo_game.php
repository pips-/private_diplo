<?php
include_once 'classes/class_player.php';
class diplo_game{

    private $id = null;
    private $name = "";
    private $max_players = 7;
    private $nb_players = 0;
    private $players = array();
    private $date_create = 0;

    public function open($id){
        // TODO : gérer l'ouverture
        $games = simplexml_load_file(_GAMES_FILE);
        $game = $games->xpath('game[@id='.$id.']');
        if (count($game) > 0){
            $this->name = $game[0]->name;
            $this->max_players = $game[0]->max_players;
            $this->nb_players = $game[0]->nb_players;
            $this->players = $game[0]->players;
            $this->date_create = $game[0]->date_create;
            $this->id = $id;
        }
    }

    public function save(){
        if($this->date_create == 0){
            $this->date_create = time();
        }
        
        if( $this->id > 0){
            // TODO : faire l'édition
            $games = new SimpleXMLElement(_GAMES_FILE,null,true);
            $game = $games->xpath('game[@id='.$this->id.']');
            $game[0]->name[0] = $this->name;
            $game[0]->max_players[0] = $this->max_players;
            $game[0]->nb_players[0] = $this->nb_players;
            //$game[0]->players[0] = $this->players;
            $game[0]->date_create[0] = $this->date_create;
	        echo $games->asXML(_GAMES_FILE);
        }else{
            $games = simplexml_load_file(_GAMES_FILE);
            if(count($games) == 0)
                $this->id = 1;
            else{
                $attr = $games->game[count($games)-1]->attributes();
                $this->id = $attr['id']+1;
            }
            $game = $games->addChild('game');
            $game->addAttribute('id', $this->id);
            $game->addChild('name', $this->name);
            $game->addChild('max_players', $this->max_players);
            $game->addChild('nb_players', $this->nb_players);
            $players = $game->addChild('players');
            foreach($this->players as $pl){
                $player = $players->addChild('player');
                $player->addChild('login',$pl->getLogin());
                $player->addChild('puissance',$pl->getPuissance());
            }
            $game->addChild('date_create', $this->date_create);
            $games->saveXML(_GAMES_FILE);
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

    public function getPlayers(){
        return $this->players;
    }
    public function getId(){
        return $this->id;
    }
}
?>
