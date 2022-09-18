<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
			
	if(isset($_REQUEST["islem"])) {
		$sonuc 	= array();
		$islem 	= $_REQUEST["islem"];
		
	} else { 
		$sonuc["HATA"] 		= TRUE;
		$sonuc["ACIKLAMA"] 	= "Giriş Yasak.".$_REQUEST["islem"];
		echo json_encode($sonuc); die();
		
	}
	
	if(!in_array($islem, array('kullanici_ekle'))) {
		if(!$_SESSION['kullanici_id']){
			$sonuc["HATA"] 		= TRUE;
			$sonuc["ACIKLAMA"] 	= "Üye olmalısınız!";
			echo json_encode($sonuc); die();
		}
	}
	
	if(!method_exists($cKayit, $islem)) {
		$sonuc["HATA"] 		= TRUE;
		$sonuc["ACIKLAMA"] 	= "Fonksiyon bulunamadı.";
		echo json_encode($sonuc); die();
	}
	
	$sonuc = $cKayit->{$islem}();
	
	echo json_encode($sonuc); die();
	
?>