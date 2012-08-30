<?php
define('_DATABASE', 'data/displo');

define('_USER_FILE', 'data/users.xml');
define('_GAMES_FILE', 'data/games.xml');
define('_PUISSANCE_FILE', 'data/puissances.xml');

if($db = new sqlite3(_DATABASE)){
	include_once 'classes/class_diplo.php';
	include_once 'classes/class_diplo_game.php';
	include_once 'classes/class_puissance.php';
	include_once 'classes/class_player.php';
	include_once 'classes/class_player_game.php';
	require_once 'includes/helpers.php';
}else
	die("error");

?>
