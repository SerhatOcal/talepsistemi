<?php

class Tarih {
	private static $degisken;
	private static $tarihBasla;
	private static $tarihBitis;
		
	private function __construct() {
			
	}
	
	private static function tarihKontrol(){ 
		
	}
	
	
	public static function ay($ay){
		$AYLAR = array("","Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		return $AYLAR[$ay];
	}
	
	public static function aygun($tarih){ 
		$gunu 	= date('d', strtotime($tarih));
		$gun 	= date('N', strtotime($tarih));
		$ay 	= date('n', strtotime($tarih));
		$gunler = array("Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");
		$aylar 	= array("","Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		$aygun	= $gunu . " " . $aylar[$ay] ." ". $gunler[$gun-1];
		return $aygun;
	}
	
	public static function yilay($yilay){ 
		$yil	= substr($yilay, 0, 4);
		$ay		= substr($yilay, -2);
		$aylar 	= array("","Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		$aygun	= $yil . " " . $aylar[(int)$ay];
		return $aygun;
	}
	
	public static function haftagun($hafta, $yil){
		$dto = new DateTime();
	  	$dto->setISODate($yil, $hafta);
	  	$ret['week_start'] = $dto->format('Y-m-d');
	  	$dto->modify('+6 days');
	  	$ret['week_end'] = $dto->format('Y-m-d');
	  	return $ret['week_start'] . " " . $ret['week_end'];
	}
	
	public static function dbBugun(){
		$tarih = date('Y-m-d');
		return $tarih;
	}
	
	public static function dbYarin(){
		$tarih = date('Y-m-d', strtotime( "+1 day" ) );
		return $tarih;
	}
	
	public static function dbTarihDun(){
		$tarih = date('Y-m-d', strtotime( "-1 day" ) );
		return $tarih;
	}
	public static function dbTarihOncekiGun(){
		$tarih = date('Y-m-d', strtotime( "-2 day" ) );
		return $tarih;
	}
	
	public static function dbTarih(){
		$tarih = date('Y-m-d H:i:s');
		return $tarih;
	}
	
	public static function treTarih(){
		setlocale(LC_ALL, 'tr_TR.UTF-8');
		date_default_timezone_set('Europe/Istanbul');
		$tarih = date('d-m-Y H:i:s');
		return $tarih;
	}
	
	public static function saliseliTarih(){
		$salise_dizi = explode(" ",microtime()); 
		$salise 	 = substr($salise_dizi[0],2,3); 
		$tarih 		 = date('d.m.Y H:i:s ');
		return "<b>$tarih $salise</b> <br>";
	}
	
	public static function uidSalise(){
		$salise_dizi = explode(" ",microtime()); 
		$salise 	 = substr($salise_dizi[0],2,3);  
		$tarih 		 = date('dmYHis');
		return $tarih.$salise; 
	}
	
	public static function setTarihBasla(){
		self::$tarihBasla = microtime(true);
	}
	
	public static function setTarihBitis(){
		self::$tarihBitis = microtime(true);
	}
	
	public static function getTarihFark(){
		
		if(!isset(self::$tarihBasla)){
			$sonuc = "Başlangıç Süresi yok";
			die();
			
		} else if(!isset(self::$tarihBitis)){
			self::$tarihBitis = microtime(true);	
			
		}	
				
		$fark 	= self::$tarihBitis -  self::$tarihBasla;
		$sonuc 	= number_format($fark,2) . " sn ";
			
		return $sonuc;
	}
	
	public static function dakika2time($dakika){
		$metin = gmdate("H:i:s", $dakika*60);
		return $metin;
	}
	
	public static function dakika2tarih($sure){
		$return_sure = '';
		if ($sure=="0") {
			return "Anlık";
		} else if ($sure > 0){
			if ($sure >= 60){
				$sure_dk_kalan = $sure % 60;
				$sure_saat = $sure/60;
				if ($sure_saat >= 24){
					$sure_gun = $sure_saat / 24;
					$sure_saat_kalan = $sure_saat % 24;
					$return_sure = intval($sure_gun)."gün ".$sure_saat_kalan."sa ";
				}else{
					$return_sure = intval($sure_saat)."sa ".$sure_dk_kalan."dk ";
				}
				
			}else{
				$return_sure = intval($sure)." dk";
			}
		} else if($sure<0) {
			$sure = -1 * $sure;
			if ($sure >= 60){
				$sure_dk_kalan = $sure % 60;
				$sure_saat = $sure/60;
				if ($sure_saat >= 24){
					$sure_gun = $sure_saat / 24;
					$sure_saat_kalan = $sure_saat % 24;
					$return_sure = intval($sure_gun)."gün ".$sure_saat_kalan . "sa";
				}else{
					$return_sure = intval($sure_saat)."sa ".$sure_dk_kalan . "dk";
				}
				
			}else{
				$return_sure = intval($sure)." dk";
			}
			$return_sure = "-" . $return_sure;
			
		}
		
		return $return_sure;
	}

	public static function tarihBugun(){
		$tarih = date('d-m-Y');
		return $tarih;
	}
	
	public static function tarihBuAy(){
		$tarih = date('n');
		return $tarih;
	}
	
}


 ?>