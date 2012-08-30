<div>
    <h3>&Eacute;dition de : <? echo $game->fields['name']; ?></h3>
    <form method="POST" action="index.php?op=save_game">
        <input type="hidden" value="<? echo $game->fields['id']; ?>" name="id" />
        <label>Nom de la partie</label>
        <input type="text" name="name_game" value="<? echo $game->fields['name']; ?>" />
        <label>Nombre de joueurs (7 max)</label>
        <input type="text" name="nb_players" value="<? echo $game->fields['max_players']; ?>" />
        <label>Choix de la puissance</label>
        <select name="puissance">
            <option></option>
        </select>
        <input type="submit" value="Enregistrer" />
        <input type="button" value="Annuler" onclick="javascript:document.location.href='index.php';" />
    </form>
</div>
