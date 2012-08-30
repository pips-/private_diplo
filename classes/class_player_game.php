<?php
class diplo_player_game extends diplo{
	const TABLE_NAME = 'diplo_player_game';

	function __construct() {
		parent::diplo(self::TABLE_NAME,'id_game','id_player');
	}
}
?>