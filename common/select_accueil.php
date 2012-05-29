<?php
if (!file_exists(_GAMES_FILE)){
    $content = "<?xml version='1.0' standalone='yes'?>
                <games>
                </games>";
    file_put_contents(_GAMES_FILE,$content);
}
$games = simplexml_load_file(_GAMES_FILE);
if (isset($_POST['name_game']) && trim($_POST['name_game']) != ''){
    $diplo_game = new diplo_game();
    $diplo_game->setName(trim($_POST['name_game']));
    $diplo_game->setMaxPlayers($_POST['nb_players']);
    $diplo_game->addPlayer($_SESSION["login"],""); //$_POST['puissance']
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
<table cellspacing="0" cellpadding="0" style="width:50%;">
    <tr>
        <th>
            Nom
        </th>
        <th>
            Nb joueurs
        </th>
    </tr>
    <?
    $lstDispo = '';
    foreach($games as $game){
        if(count($game->xpath('players/player[login="'.$_SESSION["login"].'"]')) > 0){
            ?>
            <tr>
                <td>
                    <? echo $game->name; ?>
                </td>
                <td style="text-align:center;">
                    <? echo $game->nb_players."/".$game->max_players; ?>
                </td>
            </tr>
            <?
        }elseif($game->nb_players < $game->max_players){
            $lstDispo .= '<tr>
                            <td>
                                '.$game->name.'
                            </td>
                            <td style="text-align:center;">
                                '.$game->nb_players."/".$game->max_players.'
                            </td>
                        </tr>';
        }
    }
    ?>
</table>
<h3>Rejoindre une partie</h3>
<table cellspacing="0" cellpadding="0" style="width:50%;">
    <tr>
        <th>
            Nom
        </th>
        <th>
            Nb joueurs
        </th>
    </tr>
    <?
    echo $lstDispo;
    ?>
</table>
