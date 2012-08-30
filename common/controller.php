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
            if($game->fields['id_user'] == $_SESSION['user']['id'])
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
            $diplo_game->fields['name'] = trim($_POST['name_game']);
            $diplo_game->fields['max_players'] = $_POST['nb_players'];
            $diplo_game->fields['id_user'] = $_SESSION['user']['id'];
            $diplo_game->save();

            $diplo_game->addPlayer($_SESSION['user']['id'],$_POST['puissance']);
        }
        redirect('index.php');
        break;
}
?>
