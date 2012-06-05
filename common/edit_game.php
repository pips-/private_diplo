<div>
    <h3>&Eacute;dition de : <? echo $game->getName(); ?></h3>
    <form method="POST" action="index.php?op=save_game">
        <input type="hidden" value="<? echo $game->getId(); ?>" name="id" />
        <label>Nom de la partie</label>
        <input type="text" name="name_game" value="<? echo $game->getName(); ?>" />
        <label>Nombre de joueurs (7 max)</label>
        <input type="text" name="nb_players" value="<? echo $game->getMaxPlayers(); ?>" />
        <label>Choix de la puissance</label>
        <select name="puissance">
            <option></option>
        </select>
        <input type="submit" value="Enregistrer" />
        <input type="button" value="Annuler" onclick="javascript:document.location.href='index.php';" />
    </form>
</div>
