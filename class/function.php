<?
	error_reporting();

	@session_start();
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/dbPDO.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cBasic.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cComboData.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cTableData.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cSubData.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cExcelSayfasi.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cTarih.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cFormat.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cBootstrap.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cKayit.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cSabit.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cGuvenlik.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/asset/PHPExcel/Classes/PHPExcel.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/asset/PHPMailer/class.phpmailer.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cMail.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/cCurl.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/SqlFormatter.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/asset/mpdf60/mpdf.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/functions.php');
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/SimpleImage.php');

	// Db bağlantısı
	$cdbPDO 	= new dbPDO();
	if($_SERVER['SERVER_NAME'] == "talepsistemi.test"){
		define("HOST","localhost");
		define("DB","TALEP_SISTEMI");
		define("USR","root");
		define("PSW","root");
	} else {
		die("Yasak Giriş!");
	}
	
	$dbPDO 			= $cdbPDO->dbBaglan(HOST, DB, USR, PSW); 
	$cMail	 		= new Mail($cdbPDO);
	$cCurl	 		= new Curl($cdbPDO, $cMail);
		
	// Bu sınıflar ekrana basılacak dataların belirlenmesinde kullanılıyor. 
	$cSimpleImage	= new SimpleImage();
	$cCombo 		= new comboData($cdbPDO);
	$cTable 		= new tableData($cdbPDO);
	$cSubData 		= new subData($cdbPDO, $cMail, $cCurl);
	$cGuvenlik 		= new Guvenlik($cdbPDO);
	
	$row_kullanici 	= $cSubData->getSessionKullanici();
	$row_site 		= $cSubData->getSite();
	$rows_menu 		= $cSubData->getMenu();
	$rows_anamenu	= $cSubData->getAnaMenu();
	$rows_linklerim	= $cSubData->getLinklerim();
	
	$cSabit			= new Sabit($row_site);
	$cKayit 		= new dbKayit();
	$cBootstrap		= new Bootstrap($cdbPDO, $cSubData, $cCombo, $cSabit, $row_site, $row_kullanici, $rows_anamenu, $rows_menu, $rows_linklerim);
	
	date_default_timezone_set('Europe/Istanbul');
	
	
	
	