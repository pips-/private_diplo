<?php
$extensions = get_loaded_extensions();
if (in_array("sqlite3",$extensions) && in_array("pdo_sqlite",$extensions)){

    if(!file_exists('data')){
        mkdir('data');
    }

    if(!file_exists("data/displo")){
        require_once 'includes/global.php';
        global $db;

        $sql = array();
        // players
        $sql[] = "CREATE TABLE IF NOT EXISTS ".diplo_player::TABLE_NAME."(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    login VARCHAR(32) NOT NULL,
                    password VARCHAR(48) NOT NULL,
                    email VARCHAR(255),
                    nom VARCHAR(255),
                    prenom VARCHAR(255),
                    access INT(2) DEFAULT '1')";
        $sql[] = "INSERT INTO ".diplo_player::TABLE_NAME." (login, password, email, nom, prenom, access)
                        VALUES ('admin', '".hashPasswd('admin')."', 'admin', 'admin', 'admin@admin.fr', '99')";

        // puissances
        $sql[] = "CREATE TABLE IF NOT EXISTS ".diplo_puissance::TABLE_NAME."(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name VARCHAR(255) NOT NULL,
                    color VARCHAR(6) NOT NULL)";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('France', '0000FF')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Royaume-Uni', 'AFAFAF')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Allemagne', '333333')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Autriche', 'FF0000')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Russie', 'D7AA0D')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Italie', '00FF00')";
        $sql[] = "INSERT INTO ".diplo_puissance::TABLE_NAME." (name, color)
                        VALUES ('Turquie', '4EEBFD')";

        // parties
        $sql[] = "CREATE TABLE IF NOT EXISTS ".diplo_game::TABLE_NAME."(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name VARCHAR(255) NOT NULL,
                    max_players INT(6) NOT NULL,
                    id_user INTERGER NOT NULL,
                    date_create datetime)";
        $sql[] = "CREATE TABLE IF NOT EXISTS ".diplo_player_game::TABLE_NAME."(
                    id_game INTEGER NOT NULL,
                    id_player INTEGER NOT NULL,
                    id_puissance INTEGER NOT NULL,
                    PRIMARY KEY (id_game, id_player))";
        foreach ($sql as $s){
            $db->query($s);
        }
    }
    require_once 'includes/global.php';
    redirect("index.php");
}else
	echo "php_pdo_sqlite.dll et/ou php_sqlite.dll ne sont pas activés !"
?>
