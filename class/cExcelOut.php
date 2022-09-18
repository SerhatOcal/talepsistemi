<?

class ExcelOut {
	
	private static $excel_str;
	
	function __construct() {
		
	}
			/*
			foreach($str as $sira => $deger){
				array_push(self::$excel_str, $deger.";");	
			}	
			*/
	static function ekle($str, $str2 = "", $str3 = ""){
		global $cdb;
		global $SESSION;
		
		if(is_array($str)) {
			if( $SESSION['dil']=="T" ){
				array_push(self::$excel_str, dil($str[0]).";");	
			}else{
				array_push(self::$excel_str, dil($str[1]).";");	
			}
		} else{
			if( $SESSION['dil']=="T"){
				array_push(self::$excel_str, dil($str).";");
			}else{
				array_push(self::$excel_str, dil($str2).";");
			}
		}
		
	}
	
	static function ekle2($str, $str2 = "", $str3 = ""){
		global $cdb;
		global $SESSION;
		
		if(is_array($str)) {
			if( $SESSION['dil']=="T" ){
				array_push(self::$excel_str, $str[0].";");	
			}else{
				array_push(self::$excel_str, $str[1].";");	
			}
		} else{
			if( $SESSION['dil']=="T"){
				array_push(self::$excel_str, $str.";");
			}else{
				array_push(self::$excel_str, $str2.";");
			}
		}
		
	}
	
	static function ekle_satir($str){
		global $cdb;
		global $SESSION;
			
		array_push(self::$excel_str, $str.";");
		
	}
	
	static function basla(){
		self::$excel_str =  array();
	}
	
	static function satir_sonu(){
		array_push(self::$excel_str, "\n");
	}
	
	static function bitir(){		
		$str = "";
		foreach(self::$excel_str as $sira => $deger){
			$str.= $deger;
		}

		return $str;
	}
	
}

 ?>