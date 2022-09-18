<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
	session_kontrol();
	$arr_yetki = $cSubData->getYetki();
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . $arr_yetki[$_SESSION['yetki_id']]->INDEX);