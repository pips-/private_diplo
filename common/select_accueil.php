<?php
if (!file_exists(_GAMES_FILE)){
    $content = "<?xml version='1.0' standalone='yes'?>
                <games>
                </games>";
    file_put_contents(_GAMES_FILE,$content);
}
$games = simplexml_load_file(_GAMES_FILE);
?>
<h3>Cr&eacute;er une nouvelle partie</h3>
<form method="POST" action="index.php?op=save_game">
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
        <th>
            Actions
        </th>
    </tr>
    <?
    $lstDispo = '';
    foreach($games as $game){
        if(count($game->xpath('players/player[login="'.$_SESSION["login"].'"]')) > 0){
            $attr = $game->attributes()
            ?>
            <tr>
                <td>
                    <? echo $game->name; ?>
                </td>
                <td style="text-align:center;">
                    <? echo $game->nb_players."/".$game->max_players; ?>
                </td>
                <td>
                    <?
                    if($game->players[0]->player->login[0] == $_SESSION["login"]){
                    ?>
                    <a href="index.php?op=edit_game&id=<? echo $attr['id']; ?>">
                        &Eacute;diter
                    </a>
                    <?
                    }
                    ?>
                </td>
            </tr>
            <?
        }elseif(intval($game->nb_players) < intval($game->max_players)){
            $lstDispo .= '<tr>
                            <td>
                                '.$game->name.'
                            </td>
                            <td style="text-align:center;">
                                '.$game->nb_players."/".$game->max_players.'
                            </td>
                            <td>
                                
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
        <th>
            Actions
        </th>
    </tr>
    <?
    echo $lstDispo;
    ?>
</table>
