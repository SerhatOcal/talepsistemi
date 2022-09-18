<?
/*
* Güvenlik yetki bazlı erişim sağlanması yada sağlanmaması için yaptım. Yetki16 dediğiniz e Yetkisi 16 olan kullanıcılara
*/

class Guvenlik {
	private $cdbPDO;
	private $sayfa;
	
	function __construct($cdbPDO) {
		$this->cdbPDO 	= $cdbPDO;
		$this->Temizle();
		$this->Yetki();
	}
	
	function Temizle(){
		$this->sayfa = $_SERVER['PHP_SELF'];
		
	}
	
	function Yetki(){
		if($_SESSION['yetki_id'] == 1){
			//$this->Yetki1();	
		}
		
	}
	
	function Yetki1() {
		$sayfalar = array();
		$sayfalar[] = '/index_yonetici.php';
		$sayfalar[] = '/index.php';
		
		//sayfa yoksa hata 
		if(!in_array($this->sayfa,$sayfalar)){
			$this->Hata();
		}	
		
	}	
	
	function Hata(){
		echo "<b>Güvenlik Uyarısı:</b> Sayfa erişim hakkınız yok"; 
		die();
		
	}
	
}
