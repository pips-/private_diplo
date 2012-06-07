<?php
$op = (isset($_GET['op']))?$_GET['op']:'';
switch($op){
    default:
        include "common/select_accueil.php";
        break;
    case 'edit_game':
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $id = $_GET['id'];
            $game = new diplo_game();
            $game->open($id);
            $players = $game->getPlayers();
            if($players[0]->player->login[0] == $_SESSION["login"])
                include "common/edit_game.php";
            else
                redirect('index.php');
        }else
            redirect('index.php');
        break;
    case 'save_game':
        if (isset($_POST['name_game']) && trim($_POST['name_game']) != ''){
            $diplo_game = new diplo_game();
            if(isset($_POST['id']) && $_POST['id'] != '' && $_POST['id'] > 0){
                $diplo_game->open($_POST['id']);
            }
            $diplo_game->setName(trim($_POST['name_game']));
            $diplo_game->setMaxPlayers($_POST['nb_players']);
            $addIt = true;
            foreach($diplo_game->getPlayers() as $player){
                if($player->player->login[0] == $_SESSION["login"]){
                    $addIt = false;
                    break;
                }
            }
            if($addIt)
                $diplo_game->addPlayer($_SESSION["login"],$_POST['puissance']);
            else
                $diplo_game->save();
        }
        redirect('index.php');
        break;
}
?>
