<?
class FormatTarih {
	
	function __construct() {
		
	}
	
	/* 
	** Databaseden gelen tarih formatını Gün-Ay-Yıl olarak değiştirilmesi. DateTime olarak gelirse Gün-Ay-Yıl Sa:Dk:Sn olarak gösterir.
	*/
	static function db2treay($tarih){
		$aylar = array("","Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		
		if($tarih=='0000-00-00') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih 	= $bol[0];
			
			$dizi 	= explode('-',$tarih); 
			$ay		= (int)$dizi[1];
			$ay_text= $aylar[$ay];
			$tarih 	= $ay_text." ".$dizi[0];
			return $tarih;
		} else {
			$dizi 	= explode('-',$tarih); 
			$ay		= (int)$dizi[1];
			$ay_text= $aylar[$ay];
			$tarih 	= $ay_text." ".$dizi[0];
			return $tarih;
		}
	}
	
	static function db2tre($tarih){
		if($tarih=='0000-00-00') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih 	= $bol[0];
			
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
			return $tarih." ".$bol[1];
		} else {
			list($yil, $ay, $gun) 	= explode('-',$tarih);
			$ay 	= (strlen($ay)==1)?"0$ay":$ay;
			$gun 	= (strlen($gun)==1)?"0$gun":$gun;
			$tarih 	= $gun."-".$ay."-".$yil; 
			return $tarih;
		}
	}
	
	static function db2tredk($tarih){
		if($tarih=='0000-00-00') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih 	= $bol[0];
			$saat	= explode(':',$bol[1]);
			
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
			return $tarih." ".$saat[0].":".$saat[1];
		} else {
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0]; 
			return $tarih;
		}
	}
	
	static function tarih($tarih){
		if($tarih=='0000-00-00') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih 	= $bol[0];
			$saat	= explode(':',$bol[1]);
			
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2].".".$dizi[1].".".$dizi[0];
			return $tarih." ".$saat[0].":".$saat[1];
		} else {
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2].".".$dizi[1].".".$dizi[0]; 
			return $tarih;
		}
	}
	
	static function sayi2saat($sayi){
		if($sayi == "") {
			return '';
		} else if(is_null($sayi)) {
			return "00:00";
		} else if($sayi < 10) {
			return "0" . $sayi . ":00";
		} else {
			return $sayi . ":00";
		}
	}
	
	static function tre2db($tarih){
		if($tarih=='00-00-0000') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih = $bol[0];
			
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
			return $tarih." ".$bol[1];
		} else {
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
			return $tarih;
		}
	}
	
	static function db2nokta($tarih){
		if($tarih=='0000-00-00') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih 	= $bol[0];
			$saat	= explode(':',$bol[1]);
			
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2].".".$dizi[1].".".$dizi[0];
			return $tarih." ".$saat[0].":".$saat[1];
		} else {
			$dizi 	= explode('-',$tarih); 
			$tarih 	= $dizi[2].".".$dizi[1].".".$dizi[0]; 
			return $tarih;
		}
	}
	
	static function nokta2db($tarih){
		if($tarih=='00.00.0000') {
			return '';
		} else if($tarih=='') {
			return '';
		} else if(strlen($tarih)>10) {
			$bol 	= explode(' ',$tarih); 
			$tarih = $bol[0];
			
			$dizi 	= explode('.',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
			return $tarih." ".$bol[1];
		} else {
			$dizi 	= explode('.',$tarih); 
			$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0]; 
			return $tarih;
		}		
		
	}
	
	static function db2bolu($tarih){ 
		$dizi 	= explode('-',$tarih);    
		$tarih 	= $dizi[2]."/".$dizi[1]."/".$dizi[0]; 
		return $tarih;
	}
	
	static function bolu2db($tarih){
		$dizi 	= explode('/',$tarih); 
		$tarih 	= $dizi[2]."-".$dizi[1]."-".$dizi[0];
		return $tarih;
	}
	
	static function haftaGunu($sira){ 
		$gunler = array("Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
		return $gunler[$sira-1];
	}
	
	static function Gun($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		$date = str_replace(".","-",$date);
		$date = str_replace("/",".",$date);
		list($yil, $ay, $gun ) = explode('-', $date); 
		if(strlen($yil)==2) list($yil, $gun) = array($gun, $yil);
		return $gun;
	}
	static function Ay($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		$date = str_replace(".","-",$date);
		$date = str_replace("/",".",$date);
		list($yil, $ay, $gun ) = explode('-', $date); 
		if(strlen($yil)==2) list($yil, $gun) = array($gun, $yil);
		return $ay;
	}
	static function Yil($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		$date = str_replace(".","-",$date);
		$date = str_replace("/",".",$date);
		list($yil, $ay, $gun ) = explode('-', $date); 
		if(strlen($yil)==2) list($yil, $gun) = array($gun, $yil);
		return $yil;
	}
	
	static function Saat($tarih){		
		list($date, $time ) = explode(' ', $tarih); 
		list($saat, $dakika, $saniye ) = explode(':', $time); 
		return $saat;
	}
	static function Dakika($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		list($saat, $dakika, $saniye ) = explode(':', $time); 
		return $dakika;
	}
	static function Saniye($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		list($saat, $dakika, $saniye ) = explode(':', $time); 
		return $saniye;
	}
	
	static function Date($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		
		return $date;
	}
	
	static function Time($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		
		return $time;
	}
	
	static function Hi($tarih){
		list($date, $time ) = explode(' ', $tarih); 
		list($saat, $dakika, $saniye ) = explode(':', $time); 
		return $saat .":". $dakika;
	}
	
}

class FormatSayi {
	function __construct() {
		
	}
	
	static function virgul2($sayi){
		$sayi = trim($sayi);
		if($sayi=='0.00') return '';
		if($sayi==0) return '';
		$say = number_format("$sayi", 2, ',', '');
		$say = str_replace('.',',',$say);
		return $say;
	}
	
	static function db2virgul($sayi){
		$sayi = trim($sayi);
		//virgul2 ile aynı
		if($sayi=='0.00') return '';
		if($sayi==0) return '';
		$say = str_replace('.',',',$sayi);
		return $say;
	}
	
	static function virgul2db($sayi){
		$sayi = trim($sayi);
		if($sayi=='0,00') return '';
		if($sayi==0) return '';
		$say = str_replace('.','',$sayi);
		$say = str_replace(',','.',$sayi);
		return $say;
	}
	
	static function nokta2($sayi){
		$sayi = trim($sayi);
		if(empty($sayi)) return '';
		if($sayi=='0.00') return '0.00';
		if($sayi==0) return '0.00';
		$say = number_format("$sayi", 2, '.', '');
		//$say = str_replace('.',',',$say);
		return $say;
	}
	
	static function nokta2ondalik($sayi){
		$sayi = trim($sayi);
		if(empty($sayi)) return '';
		if($sayi=='0.00') return '0.00';
		if($sayi==0) return '0.00';
		$say = number_format("$sayi", 2, '.', ',');
		//$say = str_replace('.',',',$say);
		return $say;
	}
	
	static function db2tr($sayi){
		$sayi = trim($sayi);
		if(empty($sayi)) return '';
		if($sayi=='0.00') return '0,00';
		if($sayi==0) return '0,00';
		$say = number_format("$sayi", 2, ',', '.');
		return $say;
	}
	
	static function tamsayi($sayi){
		$sayi = trim($sayi);
		if($sayi=='0.00') return '0';
		if($sayi==0) return '0';
		$say = number_format("$sayi", 0, '.', '');
		return $say;
	}
	
	static function tamsayi2ondalikli($sayi){
		if($sayi=='0.00') return '0';
		if($sayi==0) return '0';
		$say = number_format("$sayi", 0, '.', ',');
		return $say;
	}
	
	static function iskontoluTutar($tutar, $iskonto){
		if((int)$iskonto < 0) $iskonto = 0;
		$sonuc = $tutar * (1 - $iskonto / 100);
		return $sonuc;
	}
	
	static function iskontoOran($tutar, $iskontolu){
		if((int)$iskontolu < 0) $iskontolu = 0;
		$sonuc =  ($tutar - $iskontolu) / $tutar * 100;
		$say = number_format("$sonuc", 2, '.', ',');
		return $say;
	}
	
	static function yuzdeTutar($tutar, $yuzde){
		if((int)$yuzde < 0) $yuzde = 0;
		$sonuc = $tutar * $yuzde / 100;
		return $sonuc;
	}
	
	static function yuzdeOran($tutar, $yuzdeli){
		if((int)$yuzde < 0) $yuzde = 0;
		$sonuc = $yuzdeli * 100 / $tutar;
		$say = number_format("$sonuc", 2, '.', ',');
		return $say;
	}
	
	static function sayi($sayi, $ondalik = 2){
		$sayi = trim($sayi);
		if(is_null($sayi) OR empty($sayi)) return '';
		if($sayi=='0.00') return '0';
		if($sayi==0) return '0';
		$say = number_format("$sayi", $ondalik, ',', '.');
		return $say;
	}
	
	static function sayi2db($sayi){
		$sayi = trim($sayi);
		$sayi = str_replace('.', '', $sayi);
		$sayi = str_replace(',', '.', $sayi);
		return $sayi;
	}
	
}

class FormatTel {
	function __construct() {
		
	}
	
	static function telBosluk($tel){
		if(strlen(trim($tel))==10){
			$tel = "0" . substr($tel,0,3) ." ". substr($tel,3,3) ." ". substr($tel,6,2) ." ". substr($tel,8,2);
		}else if(strlen(trim($tel))==11){
			$tel = substr($tel,0,1) . substr($tel,1,3) ." ". substr($tel,4,3) ." ". substr($tel,7,2) ." ". substr($tel,9,2);
		}else {
			
		}
		return $tel;
	}
	
	static function telTre($tel){
		if(strlen(trim($tel))==10){
			$tel = "0" . substr($tel,0,3) ."-". substr($tel,3,3) ."-". substr($tel,6,2) ."-". substr($tel,8,2);
		}else if(strlen(trim($tel))==11){
			$tel = substr($tel,0,1) . substr($tel,1,3) ."-". substr($tel,4,3) ."-". substr($tel,7,2) ."-". substr($tel,9,2);
		}else {
			
		}
		return $tel;
	}
	
	static function formatli($tel){
		$tel = trim(str_replace(' ', '', $tel));
		
		if(strlen(trim($tel))==10){
			$tel = "(" . substr($tel,0,3) .") ". substr($tel,3,3) ."-". substr($tel,6,2) ." ". substr($tel,8,2);
		}else if(strlen(trim($tel))==11){
			$tel = "(" . substr($tel,1,3) .") ". substr($tel,4,3) ."-". substr($tel,7,2) . substr($tel,9,2);
		}else {
			
		}
		return $tel;
	}
	
	static function smsTemizle($tel){
		$tel = trim(str_replace(' ', '', $tel));
		$tel = trim(str_replace('(', '', $tel));
		$tel = trim(str_replace(')', '', $tel));
		$tel = trim(str_replace('-', '', $tel));
		$tel = "90" . $tel;
		
		return $tel;
	}
	
}

class FormatYazi {
	function __construct() {
		
	}
	
	static function kisalt($yazi, $uzunluk = 35){
		if(strlen($yazi)+3 > $uzunluk) {
			$yazi = mb_substr($yazi,0,$uzunluk,'UTF-8');
			$yazi.= "..";
		}
		return $yazi;
	}
	
	static function satir($yazi, $uzunluk = 60){
		$yeni = "";
		for($i = 0; $i < 5; $i++){
			$satir = mb_substr($yazi,$i*$uzunluk,$uzunluk,'UTF-8');
			if(strlen($satir) > 0){
				$yeni.= mb_substr($yazi,$i*$uzunluk,$uzunluk,'UTF-8') . "<br>";	
			}
		}
		
		return $yeni;
	}
	
	static function bosluk($yazi, $say = 11){
		if(strlen($yazi) <= 0) {
			
			$yazi.= str_repeat(".", $say);
		}
		return $yazi;
	}
	
	static function UTF82ISO($yazi){
		$yazi = @iconv("utf-8", "ISO-8859-9//TRANSLIT", $yazi);
		return $yazi;
	}
	
	static function HTML2ISO($yazi){
		//$chars_utf = Array("Ã‡","Ã–",	"Å?",	"Ä?",	"Ãœ",	"Ã¼",	"ÄŸ",	"ÅŸ",	"Ã§",	"Ã¶",	"Ä°",	"Ä±");
        //$chars_trk = Array("Ç",	"Ö",	"Ş",	"Ğ",	"Ü",	"ü",	"ğ",	"ş",	"ç",	"ö",	"İ",	"ı");
            
		$yazi = str_replace('Ã&#8225;',	'Ç', $yazi);
		$yazi = str_replace('Ã&#167;',	'ç', $yazi);
		$yazi = str_replace('Ã&#8211;',	'Ö', $yazi);
		$yazi = str_replace('Ã&#182;',	'ö', $yazi);
		$yazi = str_replace('Å&#63;',	'Ş', $yazi);
		$yazi = str_replace('Å&#376;',	'ş', $yazi);
		$yazi = str_replace('Ä&#63;',	'Ğ', $yazi);
		$yazi = str_replace('Ã&#376;',	'ğ', $yazi);
		$yazi = str_replace('Ã&#339;',	'Ü', $yazi);
		$yazi = str_replace('Ã&#188;',	'ü', $yazi);		
		$yazi = str_replace('Ä&#176;',	'İ', $yazi);
		$yazi = str_replace('Ä&#177;',	'ı', $yazi);
		return $yazi;
	}
	
	static function buyult($yazi){            
		$yazi = str_replace('ç',	'Ç', $yazi);
		$yazi = str_replace('ö',	'Ö', $yazi);
		$yazi = str_replace('ş',	'Ş', $yazi);
		$yazi = str_replace('ğ',	'Ğ', $yazi);
		$yazi = str_replace('ü',	'Ü', $yazi);
		$yazi = str_replace('i',	'İ', $yazi);
		$yazi = str_replace('ı',	'I', $yazi);
		$yazi = strtoupper(trim($yazi));
		return $yazi;
	}
	
	function UTF8(&$input){
		if (is_string($input)) {
	   		$input = mb_convert_encoding($input, 'ISO-8859-9', 'UTF-8');
	   		
	  	} else if (is_array($input)) {
	   		foreach ($input as &$value) {
	    		$this->UTF8($value);
   			}
			unset($value);
			
	  	} else if (is_object($input)) {
	   		$vars = array_keys(get_object_vars($input));
	   		foreach ($vars as $var) {
	    		$this->UTF8($input->$var);
	   		}
	   		
	  	}
	  	return $input;
	  	
	}
	
	function ISO8859(&$input){
		if (is_string($input)) {
	   		$input = mb_convert_encoding($input, 'UTF-8', 'ISO-8859-9');
	   		
	  	} else if (is_array($input)) {
	   		foreach ($input as &$value) {
	    		$this->ISO8859($value);
   			}
			unset($value);
			
	  	} else if (is_object($input)) {
	   		$vars = array_keys(get_object_vars($input));
	   		foreach ($vars as $var) {
	    		$this->ISO8859($input->$var);
	   		}
	   		
	  	}
	  	return $input;
	  	
	}
	
	function ISO88592($input){
		if (is_string($input)) {
	   		$input = mb_convert_encoding($input, 'UTF-8', 'ISO-8859-9');
	   		
	  	} else if (is_array($input)) {
	   		foreach ($input as $value) {
	    		$this->ISO8859($value);
   			}
			unset($value);
			
	  	} else if (is_object($input)) {
	   		$vars = array_keys(get_object_vars($input));
	   		foreach ($vars as $var) {
	    		$this->ISO8859($input->$var);
	   		}
	   		
	  	}
	  	return $input;
	  	
	}
	
	static function Xml($input){
		return "<pre>" . htmlentities($input) . "<pre>";
	}
	
	static function xmlTemizle($str){
		$str = str_replace("<![CDATA[", "", $str);
		$str = str_replace("]]>", "", $str);
		return $str;
	}
	
	function array2str($arr, $join = ','){
		if(count($arr) > 0){
			$str = implode($join, $arr);	
		} else if (strlen($arr) > 0 AND is_string($arr)){
			$str = $arr;
		} else {
			$str = "";
		}
		
		return $str;
	}
	
}
 ?>