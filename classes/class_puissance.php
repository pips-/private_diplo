<?php
class diplo_puissance extends diplo{
	const TABLE_NAME = 'diplo_puissance';

	function __construct() {
		parent::diplo(self::TABLE_NAME,'id');
	}

    public static function getAll(){
        $sel = "SELECT      *
                FROM        ".self::TABLE_NAME."
                ORDER BY    name";
        global $db;
        $res = $db->query($sel);
        $lst = array();
		while ($r = $res->fetchArray()){
            $puiss = new diplo_puissance();
            $puiss->openFromResultSet($r);
            $lst[] = $puiss;
        }
        return $lst;
    }
}
?>
