<?php
include_once 'classes/class_player.php';
class diplo_game extends diplo{
	const TABLE_NAME = 'diplo_game';

	function __construct() {
		parent::diplo(self::TABLE_NAME,'id');
	}

    public function addPlayer($id_player,$puissance){
        $lk = new diplo_player_game();
        if(!$lk->open($this->fields['id'],$id_player)){
            $lk->fields['id_game'] = $this->fields['id'];
            $lk->fields['id_player'] = $id_player;
            $lk->fields['id_puissance'] = $puissance;
            $lk->save();
        }
    }

    public static function getLstDipo($id_user){
        $lst = array();
        global $db;
        $sel = "SELECT      DISTINCT g.*
                FROM        ".self::TABLE_NAME." g
                WHERE       g.id NOT IN (SELECT DISTINCT lk.id_game
                                        FROM    ".diplo_player_game::TABLE_NAME." lk
                                        WHERE   lk.id_player = $id_user)
                ORDER BY    g.name";
        $res = $db->query($sel);
        $lst = array();
		while ($r = $res->fetchArray()){
            $game = new diplo_game();
            $game->openFromResultSet($r);
            $lst[] = $game;
        }
        return $lst;
    }

    public static function getLstSigned($id_user){
        $lst = array();
        global $db;
        $sel = "SELECT      DISTINCT g.*
                FROM        ".self::TABLE_NAME." g
                INNER JOIN  ".diplo_player_game::TABLE_NAME." lk
                ON          g.id = lk.id_game
                WHERE       lk.id_player = $id_user
                ORDER BY    g.name";
        $res = $db->query($sel);
        $lst = array();
		while ($r = $res->fetchArray()){
            $game = new diplo_game();
            $game->openFromResultSet($r);
            $lst[] = $game;
        }
        return $lst;
    }

    public function getPlayers(){
        $lst = array();

        return $lst;
    }
}
?>
