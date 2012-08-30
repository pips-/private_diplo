<?php
class diplo{
	public $db = null;
	protected $classname = "";
	protected $tablename = "";
	public $fields = array();
	protected $idfields = array();
	public $new = true;

	public function diplo(){
		$this->db = new sqlite3(_DATABASE);
		$this->classname = get_class($this) ;
        $this->tablename = func_get_arg(0);
		$this->fields = array();
		$this->idfields = array();
		$this->new = true;

		$numargs = func_num_args();
        if ($numargs > 0){
            if ($numargs == 1) {
                $this->idfields[0] = 'id';
                $this->fields['id'] = null;
            }
            else {
                for ($i = 1; $i < $numargs; $i++) {
                    if (!is_null(func_get_arg($i))) {
                        $this->idfields[$i-1] = func_get_arg($i);
                        $this->fields[$this->idfields[$i-1]] = null;
                    }
                }
            }
        }
	}

	public function open(){
		$return = false;
		$numargs = func_num_args();
        for ($i = 0; $i < $numargs; $i++) $id[$i] = func_get_arg($i);

        if ($numargs > 0 and $id[0]) {
            $sql = "SELECT * FROM `{$this->tablename}` WHERE `{$this->idfields[0]}` = '$id[0]'";
            for ($i = 1; $i < $numargs; $i++) $sql = $sql." AND `{$this->idfields[$i]}` = '$id[$i]'";

			$res = $this->db->query($sql);
			if ($r = $res->fetchArray()){
				$this->fields = $r;
				$return = true;
				$this->new = false;
			}
        }
		return $return;
	}

	public function save(){

		if ($this->new){
            $datas = array();
            if (count($this->idfields) > 1){
                foreach($this->fields as $key => $val){
                    $datas[$key] = " '$val' ";
                }
            }else{
                foreach($this->fields as $key => $val){
                    if (!in_array($key,$this->idfields))
                        $datas[$key] = " '$val' ";
                }
            }
			$sql = "INSERT INTO ".$this->tablename." (".implode(',',array_keys($datas)).") VALUES (".implode(',',$datas).")";
		}else{
            $datas = array();
            foreach($this->fields as $key => $val){
                if (!in_array($key,$this->idfields))
                    $datas[$key] = " '$val' ";
            }
			$ids = array();
			foreach($this->idfields as $id)
				$ids[] = "$id = ".$this->fields[$id];
			$sql = "UPDATE ".$this->tablename." ".implode(',',$datas)." WHERE ".implode(" AND ",$ids);
		}
		$res = $this->db->query($sql);
        if ($this->new){
            $this->fields[$this->idfields[0]] = $this->db->lastInsertRowID();
            $this->new = false;
        }
	}

	public function openFromResultSet($fields){
		$this->fields = $fields ;
        $this->new = false;
	}
}
?>
