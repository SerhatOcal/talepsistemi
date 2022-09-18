<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
	session_kontrol();
	//var_dump2($_SERVER);die();
	$filtre = array();
	$sql = "SELECT ID, TR, ENG FROM DIL WHERE DURUM = 1";
	$rows_dil = $cdbPDO->rows($sql, $filtre);
	
	$_SESSION["ENG"] = array();
	foreach($rows_dil as $key => $row_dil){
		$_SESSION["ENG"][$row_dil->TR]	= $row_dil->ENG;
	}
	die();
?>
