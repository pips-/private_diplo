<h3>Cr&eacute;er une nouvelle partie</h3>
<form method="POST" action="index.php?op=save_game">
    <label>Nom de la partie</label>
    <input type="text" name="name_game" />
    <label>Nombre de joueurs (7 max)</label>
    <input type="text" name="nb_players" value="7" />
    <label>Choix de la puissance</label>
    <select name="puissance">
<?php
foreach(diplo_puissance::getAll() as $puissance){
    ?>
    <option value="<?php echo $puissance->fields['id']; ?>">
        <?php echo $puissance->fields['name']; ?>
    </option>
    <?php
}
?>
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
    <?php
    foreach(diplo_game::getLstSigned($_SESSION['user']['id']) as $game){
        ?>
        <tr>
            <td style="text-align:center;">
                <?php echo $game->fields['name']; ?>
            </td>
            <td style="text-align:center;">
                <?php echo "/".$game->fields['max_players']; ?>
            </td>
            <td style="text-align:center;">
                <?php
                if($game->fields['id_user'] == $_SESSION['user']['id']){
                ?>
                <a href="index.php?op=edit_game&id=<?php echo $game->fields['id']; ?>">
                    &Eacute;diter
                </a>
                <?php
                }
                ?>
            </td>
        </tr>
        <?php
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
    <?php
    foreach(diplo_game::getLstDipo($_SESSION['user']['id']) as $game){
        ?>
        <tr>
            <td>
                <?php echo $game->fields['name']; ?>
            </td>
            <td style="text-align:center;">
                <?php echo "/".$game->fields['max_players']; ?>
            </td>
            <td>
                <?php
                /*if($game->fields['id_user'] == $_SESSION['user']['id']){
                ?>
                <a href="index.php?op=edit_game&id=<?php echo $game->fields['id']; ?>">
                    &Eacute;diter
                </a>
                <?php
                }*/
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
