<?php
if (!file_exists('data/games.xml')){
    $content = "<?xml version='1.0' standalone='yes'?>
                <games>
                </games>";
    file_put_contents('data/games.xml',$content);
}
$games = simplexml_load_file('data/games.xml');
if (isset($_POST['name_game']) && trim($_POST['name_game']) != ''){
    include_once 'classes/class_diplo_game.php';
    $diplo_game = new diplo_game();
    $diplo_game->setName(trim($_POST['name_game']));
    $diplo_game->setMaxPlayers($_POST['nb_players']);
    $diplo_game->addPlayer($_SESSION["login"],""); //$_POST['puissance']
    $games[] = $diplo_game;
    print_r($diplo_game);
}
?>
<h3>Cr&eacute;er une nouvelle partie</h3>
<form method="POST" action="index.php">
    <label>Nom de la partie</label>
    <input type="text" name="name_game" />
    <label>Nombre de joueurs (7 max)</label>
    <input type="text" name="nb_players" value="7" />
    <label>Choix de la puissance</label>
    <select name="puissance">
        <option></option>
    </select>
    <input type="submit" value="Cr&eacute;er" />
</form>
<h3>Continuer une partie</h3>
<h3>Rejoindre une partie</h3>
