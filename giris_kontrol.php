<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');

	if(empty($_POST)){
		$sonuc = array();
		$sonuc["HATA"] 			= TRUE;
		$sonuc["ACIKLAMA"] 		= "Hata!";
		echo json_encode($sonuc); die();
	}
	
	if(!isset($_REQUEST['kullanici']) OR !isset($_REQUEST['sifre'])){
		$sonuc = array();
		$sonuc["HATA"] 			= TRUE;
		$sonuc["ACIKLAMA"] 		= "Kullanıcı Bilgileri Eksik!";
		echo json_encode($sonuc); die();
	}
	
	if(!empty($_REQUEST["kullanici"]) AND strlen($_REQUEST["kod"]) > 30){
		$filtre = array();
		$sql = "SELECT 
					K.ID,
					K.KULLANICI,
					K.SIFRE
				FROM KULLANICI AS K
				WHERE K.KULLANICI = :KULLANICI AND K.KOD = :KOD";
		$filtre[":KULLANICI"]	= $_REQUEST["kullanici"];
		$filtre[":KOD"]			= $_REQUEST["kod"];
		$row = $cdbPDO->row($sql, $filtre);
		
		if($row->ID > 0){
			$_REQUEST['kullanici'] 	= $row->KULLANICI;
			$_REQUEST['sifre'] 		= $row->SIFRE;
			$_POST					= $_REQUEST;
			$_REQUEST["oto_login"] 	= 1;
		}
	}
	
	@session_start();
	$kullanici		= $_REQUEST["kullanici"];
	$sifre	 		= $_REQUEST["sifre"];
	$session_id		= session_id();
	session_regenerate_id(true);
	$ip				= $_SERVER['REMOTE_ADDR'];
	
	$filtre = array();
	$sql = "INSERT INTO KULLANICI_LOG SET KULLANICI = :KULLANICI, SIFRE = :SIFRE, SESSION_ID = :SESSION_ID, IP = :IP, DURUM = :DURUM";
	$filtre[":KULLANICI"]	= $kullanici;
	$filtre[":SIFRE"]		= $sifre;
	$filtre[":SESSION_ID"]	= $session_id;
	$filtre[":IP"]			= $ip;
	$filtre[":DURUM"]		= ($_REQUEST["oto_login"] == 1) ? 2 : 0;
	$log_id = $cdbPDO->lastInsertId($sql, $filtre);
	
	if ($log_id > 0) { 
		$filtre = array();
		$sql = "SELECT 
					K.*,
					Y.HIZMET_NOKTASI
				FROM KULLANICI AS K
					LEFT JOIN YETKI AS Y ON Y.ID = K.YETKI_ID
				WHERE K.DURUM = 1 AND (K.KULLANICI = :KULLANICI OR K.KULLANICI = :KULLANICI2) AND (K.SIFRE = :SIFRE OR K.SIFRE2 = :SIFRE)";
		$filtre[":KULLANICI"]	= $kullanici;
		$filtre[":KULLANICI2"]	= mb_strtoupper($kullanici);
		$filtre[":SIFRE"]		= $sifre;
		$row = $cdbPDO->row($sql, $filtre);
		
		if($row->ID > 0 ){
			$_SESSION["kullanici_id"] 		= $row->ID;
			$_SESSION["kullanici"] 			= $row->KULLANICI;
			$_SESSION["sifre"] 				= md5($row->SIFRE);
			$_SESSION["kullanici_adsoyad"]	= $row->AD . " " . $row->SOYAD;
			$_SESSION["yetki_id"]			= $row->YETKI_ID;
			$_SESSION["servis_id"]			= $row->SERVIS_ID;
			$_SESSION["filo_id"]			= $row->FILO_ID;
			$_SESSION["grup_id"]			= $row->GRUP_ID;
			$_SESSION["hizmet_noktasi"]		= $row->HIZMET_NOKTASI;
			$_SESSION["domain"]				= $_SERVER['SERVER_NAME'];
			$_SESSION["session_kontrol"]	= md5($_SESSION["kullanici_id"].$_SESSION["yetki_id"].$_SESSION["domain"]);
			$_SESSION["menu_tarih"]			= date("Y-m-d H:i:s");
			$_SESSION["session_tarih"]		= date("Y-m-d H:i:s");
			
			$filtre = array();
			$sql = "UPDATE KULLANICI SET GTARIH = NOW() WHERE ID = :ID";
			$filtre[":ID"]		= $_SESSION["kullanici_id"];
			$cdbPDO->rowsCount($sql, $filtre);
		
			$filtre = array();
			$sql = "SELECT ID, TR, ENG FROM DIL WHERE DURUM = 1";
			$rows_dil = $cdbPDO->rows($sql, $filtre);
			
			foreach($rows_dil as $key => $row_dil){
				$_SESSION["ENG"][$row_dil->TR]	= $row_dil->ENG;
			}
			
			$sonuc["HATA"] 		= FALSE;
			$sonuc["ACIKLAMA"] 	= "Giriş Yapıldı.";
			
			if($_REQUEST["oto_login"] == 1 AND $_REQUEST['sayfa_url']){
				$sonuc["URL"] 		= $_REQUEST['sayfa_url'];
				//var_dump2(urldecode($_REQUEST["sayfa_url"]));die();
				?><script>location.href = '<?=urldecode($_REQUEST["sayfa_url"])?>';</script><?
				die();
			} else if($_REQUEST["oto_login"] == 1){
				$sonuc["URL"] 		= "/index.do";
				?><script>location.href = '/index.do';</script><?
				die();
			} else if($_REQUEST['sayfa_url']){
				$sonuc["URL"] 		= $_REQUEST['sayfa_url'];
			} else {
				$sonuc["URL"] 		= "/index.do";
			}
			
			echo json_encode($sonuc);
			
		} else {
			$sonuc["HATA"] 		= TRUE;
			$sonuc["ACIKLAMA"] 	= "Kullanıcı Bilgileri Hatalı!";
			echo json_encode($sonuc);
			
		}
		
		$filtre = array();
		$sql = "UPDATE KULLANICI_LOG SET DURUM = :DURUM WHERE ID = :ID";
		$filtre[":DURUM"]	= ($sonuc["HATA"]) ? 0 : 1;;
		$filtre[":ID"]		= $log_id;
		$cdbPDO->rowsCount($sql, $filtre);
		
		
		$_SESSION['log_id'] = $log_id;
	
	} else {
		$sonuc["HATA"] 		= TRUE;
		$sonuc["ACIKLAMA"] 	= "DB erişim yok!";
		echo json_encode($sonuc);
		
	}
?>