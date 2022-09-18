<?
error_reporting(1);

class dbKayit {
	private $cdbPDO;
	private $cMail;
	private $cSms;
	private $cSubData;
	private $cCurl;
	private $cSabit;
	private $rSite;
	private $cEntegrasyon;
	private $cSimpleImage;
	
	function __construct() {
		global $cdbPDO, $cMail, $cSms, $cSubData, $cCurl, $cSabit, $row_site, $cEntegrasyon, $cSimpleImage;
		$this->cdbPDO 		= $cdbPDO;
		$this->cMail 		= $cMail;
		$this->cSms 		= $cSms;
		$this->cSubData 	= $cSubData;
		$this->cCurl 		= $cCurl;
		$this->cSabit 		= $cSabit;
		$this->rSite 		= $row_site;
		$this->cEntegrasyon	= $cEntegrasyon;
		$this->cSimpleImage	= $cSimpleImage;
		
	}
	
	// $this->fncIslemLog($ID, $this->cdbPDO->getSQL($sql, $filtre), $row, __FUNCTION__, "TABLE", "SAYFA");
	function fncIslemLog ($ID, $KAYIT_SQL, $ROW, $ISLEM, $TABLO, $SAYFA){
		//$SORGU 	= mysql_escape_string($KAYIT_SQL);
		$SORGU 	= trim(preg_replace('/\s\s+/', ' ', $KAYIT_SQL));
		$ROW_JSON = json_encode($ROW);
		
		$filtre = array();
		$sql = "INSERT INTO ISLEM_LOG SET 	TALEP_ID	= :TALEP_ID, 
											SAYFA		= :SAYFA, 
											TABLO		= :TABLO, 
											ISLEM		= :ISLEM, 
											KULLANICI	= :KULLANICI, 
											SORGU		= :SORGU, 	
											ROW			= :ROW_JSON
											";
		$filtre[":TALEP_ID"] 	= $ID;
		$filtre[":SAYFA"] 		= $SAYFA;
		$filtre[":TABLO"] 		= $TABLO;
		$filtre[":ISLEM"] 		= $ISLEM;
		$filtre[":KULLANICI"] 	= $_SESSION['kullanici'];
		$filtre[":SORGU"] 		= $SORGU;
		$filtre[":ROW_JSON"] 	= $ROW_JSON;
		$this->cdbPDO->rowsCount($sql, $filtre);
		
	}
	
}

?>