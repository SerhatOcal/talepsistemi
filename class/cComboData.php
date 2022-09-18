<?

class comboData extends Basic {
	
	private $cdbPDO;
    private $rows;
    private $sql;
	private $secilen;
	private $tumuValue;
	private $tumuName;
	private $name;
	private $class;
	private $data;
	
	function __construct($cdbPDO) {
        $this->cdbPDO 	= $cdbPDO;
	}
	
	// Sql kodunun ne olduğunun öğrenmesi adına debug için kullanmaya
    private function setTemizle(){
        $this->secim = "";
		$this->tumu = "";
		$this->name = "";
		$this->tumuValue = "";
        $this->tumuName = "";
        $this->clss = "";
        $this->data = "";
        
    }
    
	// sadece dataların çıplak olarak dönmesini sağlıyor
    public function getData(){
        return $this->rows;
    }
    
    // seçilen datanın gösterilmesi
    public function setSecilen($secilen = ""){
    	
    	if(!empty($secilen) OR $secilen == "0") {
    		if(is_array($secilen)){
				$this->secilen = $secilen;
				
			}else if(strrpos($secilen,',')){
				$this->secilen = explode(',', $secilen);
							
			}else {
				$this->secilen = $secilen;	
			}
    		
    	} else {
			$this->secilen = -1;
		}
    	
        return $this;
    }
    
    // name verme için radio, checkbox
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
     // Class bilgisini verme için radio, checkbox
    public function setClass($class){
        $this->class = $class;
        return $this;
    }
    
    // Tümü seçeneği değerlerinin olup olmaması
    public function setTumu($tumuValue = "", $tumuName = ""){
    	
    	if(empty($tumuValue)){
			$this->data .= "<option value='-1'>-- " . "Tümü" . " --</option>";
			
		} else{
			$this->data .= "<option value='$tumuValue'> $tumuName </option>";
			
		}        
        return $this;
        
    }
    
    // Tümü seçeneği değerlerinin boş olması
    public function setTumu2(){
        
        $this->data .= "<option value='-1'> " . "Tümü" . " </option>";
        
        return $this;
        
    }
    
    // Seçiniz seçeneği değerlerinin olup olmaması
    public function setSeciniz($tumuValue = "", $tumuName = ""){
    	
    	if(empty($tumuValue)){
			$this->data .= "<option value='-1'>-- " . "Seçiniz" . " --</option>";
			
		} else{
			$this->data .= "<option value='$tumuValue'> $tumuName </option>";
			
		}        
        return $this;
        
    }

	// <option></option> olarak ekrana basılmasına hazır haline getirilmesi 
    public function getSelect($value, $d, $title = "TITLE"){
        	
        foreach($this->rows as $key=>$row) {
        	if(is_array($this->secilen)){
				if( in_array($row->$value, $this->secilen) )
	        		$this->data .= "<option value=".$row->$value." title='".$row->$title."' selected >".$row->$d."</option>";
	        	else 
	        		$this->data .= "<option value=".$row->$value." title='".$row->$title."' >".$row->$d."</option>";
				
			} else {
				if( ($this->secilen == $row->$value AND isset($this->secilen)) OR in_array($row->$value, $this->secilen) )
	        		$this->data .= "<option value=".$row->$value." title='".$row->$title."' selected >".$row->$d."</option>";
	        	else 
	        		$this->data .= "<option value=".$row->$value." title='".$row->$title."' >".$row->$d."</option>";
			}
        	
        }
        return $this->data;
        
    }
    
    public function getMultiSelect($value, $d, $title = "TITLE"){
        
        foreach($this->rows as $key=>$row){
        	if($arr[$row->YETKI]){
				array_push($arr[$row->YETKI], [$d=>$row->$d, $value=>$row->$value]);
			}else{
				$arr[$row->YETKI] = array([$d=>$row->$d, $value=>$row->$value]);
			}
		}
        
        foreach($arr as $key=>$row) {
        	$this->data .= "<optgroup label='".$key."'>";
        	foreach($row as $k =>$v){
	    		$this->data .= "<option value=".$v[$value]." title='".$v[$title]."' >".$v[$d]."</option>";
			}
			$this->data .= "</optgroup>";
        }
        
        return $this->data;
        
    } 
        
    // <input type="checkbox" name="checkbox" value="1" checked>1
    public function getCheckbox($value, $d){
        
        foreach($this->rows as $key=>$row) {
        	if($this->secilen == $row->$value)
        		$this->data .= "<label> <input type='checkbox' class='".$this->clss."' name='".$this->name."' value=".$row->$value." checked>".$row->$d."</label>";
        	else 
        		$this->data .= "<label> <input type='checkbox' class='".$this->clss."' name='".$this->name."' value=".$row->$value.">".$row->$d."</label>";
        }
        return $this->data;
    }       
    
    // <input type="radio" name="radio" value="1" checked>1 
    public function getRadio($value, $d){
        
        foreach($this->rows as $key=>$row) {
        	if($this->secilen == $row->$value)
        		$this->data .= "<label> <input type='radio' class='".$this->clss."' name='".$this->name."' value=".$row->$value." checked>".$row->$d."</label>";
        	else 
        		$this->data .= "<label> <input type='radio' class='".$this->clss."' name='".$this->name."' value=".$row->$value.">".$row->$d."</label>";
        }
        return $this->data;
    }       
	
	// Sql kodunun ne olduğunun öğrenmesi adına debug için kullanmaya
    public function getSql(){
        return $this->sql;
    }
	
	public function getText($fnc, $id){
		$rows2 = $this->{$fnc}()->rows;
		foreach($rows2 as $key => $row2){
			$rows[$row2->ID]	= $row2->AD;
		}
		
		return $rows[2];
			
	}
	
	public function Kdv(){
		
		$rows[0]->ID  = "0";
		$rows[0]->AD  = "0";
		$rows[1]->ID  = "1";
		$rows[1]->AD  = "1";
		$rows[2]->ID  = "8";
		$rows[2]->AD  = "8";
		$rows[3]->ID  = "18";
		$rows[3]->AD  = "18";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;

		return $this;
		
	}
	
	public function CevapDurum(){
		
		$rows[0]->ID  = "1";
		$rows[0]->AD  = "Cevaplı";
		$rows[1]->ID  = "2";
		$rows[1]->AD  = "Cevapsız";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
	
	
	
	public function FavoriDurum(){
		
		$rows[0]->ID  = "1";
		$rows[0]->AD  = "Favorilerim";
		$rows[1]->ID  = "2";
		$rows[1]->AD  = "Favorilerim Hariç";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
	
	public function Durumlar(){
		
		$rows[1]->ID  = "1";
		$rows[1]->AD  = "Aktif";
		$rows[0]->ID  = "0";
		$rows[0]->AD  = "Pasif";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
	
	
	
	public function Vade(){
		
		$rows[0]->ID  = "120";
		$rows[0]->AD  = "120";
		$rows[1]->ID  = "90";
		$rows[1]->AD  = "90";
		$rows[2]->ID  = "60";
		$rows[2]->AD  = "60";
		$rows[3]->ID  = "30";
		$rows[3]->AD  = "30";
		$rows[4]->ID  = "15";
		$rows[4]->AD  = "15";
		$rows[5]->ID  = "0";
		$rows[5]->AD  = "0";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
		
	public function MusteriTipi(){
		
		$rows[0]->ID  = "B";
		$rows[0]->AD  = "Bireysel (Şahış Şirketi)";
		$rows[1]->ID  = "K";
		$rows[1]->AD  = "Kurumsal (Vergi No)";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}

	public function Sozlesme(){
		
		$rows[1]->ID  = "1";
		$rows[1]->AD  = "Var";
		$rows[0]->ID  = "0";
		$rows[0]->AD  = "Yok";
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
		
	public function Yil(){
		for($i = date("Y"); $i > date("Y")-3; $i--){
			$rows[$i]->ID  = $i;
			$rows[$i]->AD  = $i;
		}
		
		$this->SetTemizle();
		$this->rows = $rows;
		$this->sql = $sql;
		return $this;
	}
	
	public function Ay(){
		for($i = 1; $i <= 12; $i++){
			$rows[$i]->ID  = $i;
			$rows[$i]->AD  = $i;
		}
		
		$this->SetTemizle();
		$this->rows = $rows;
		$this->sql = $sql;
		return $this;
	}	
	
	public function TalepTuru(){
		
		$filtre = array();
		$sql = "SELECT
        			TT.ID,
        			TT.TALEP_TURU AS AD
				FROM TALEP_TURU AS TT
				WHERE TT.DURUM = 1
				ORDER BY 2
                ";		
		$rows = $this->cdbPDO->rows($sql, $filtre);
		
		$this->SetTemizle();
		$this->rows = $rows;
        $this->sql = $sql;
		return $this;
		
	}
	
}
	