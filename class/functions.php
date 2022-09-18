<?
	function toplama(){
		return 2+3;
	}
	
	function session_kontrol(){
		if(!isset($_SESSION["kullanici_id"]) OR $_SESSION["session_kontrol"] != md5($_SESSION["kullanici_id"].$_SESSION["yetki_id"].$_SESSION["domain"]) OR is_null($_SESSION["session_kontrol"])) { 
			//header("Location: giris.php", TRUE, 301); exit;
			$sayfa_url = urlencode($_SERVER['REQUEST_URI']);
			echo "<script type='text/javascript'>window.top.location='/giris.do?sayfa_url=$sayfa_url';</script>"; exit;
		}
		
	}
	
	function yetki_kontrol(){
		if(!in_array($_SESSION["yetki_id"], array(1,2,3))) { 
			echo "Yetki Hatası!"; exit;
		}
		
	}
	
	function fncOtoLogin(){
		if($_REQUEST['key'] != "8793dd869e0de20c8674db2f78a42923"){
			return false;
		}
		
		return true;
	}
	
	function kod_kontrol($row){
		if($_REQUEST["kod"] != $row->KOD AND !fncOtoLogin()) { 
			//header("Location: giris.php", TRUE, 301); exit;
			echo "Kod Hatası!"; exit;
		}
		
	}
	
	
	function fncTalepLink($row){
		//$str = "javascript:fncPopup('/talep/popup_talep.do?route=talep/popup_talep&id=:ID&kod=:KOD','POPUP_TALEP',1100,850);";
		$str = "/talep/talep.do?route=talep/talep_listesi&id=:ID&kod=:KOD";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncTalepLogPopupLink($row){
		$str = "javascript:fncPopup('/talep/popup_talep_log.do?route=talep/popup_talep_log&id=:ID&kod=:KOD','POPUP_TALEP_LOG',1100,850);";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncOzetPopupLink($row){
		$str = "javascript:fncPopup('/talep/popup_ozet.do?route=talep/popup_ozet&id=:ID&kod=:KOD','POPUP_OZET',1100,850);";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncToplantiLink($row){
		$str = "/toplanti/toplanti.do?route=toplanti/toplanti_listesi&id=:ID&kod=:KOD";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncToplantiLogPopupLink($row){
		$str = "javascript:fncPopup('/toplanti/popup_toplanti_log.do?route=toplanti/popup_toplanti_log&id=:ID&kod=:KOD','POPUP_TOPLANTI_LOG',1100,850);";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncToplantiOzetPopupLink($row){
		$str = "javascript:fncPopup('/toplanti/popup_ozet.do?route=toplanti/popup_ozet&id=:ID&kod=:KOD','POPUP_OZET',1100,850);";
		$str = str_replace(':ID', $row->ID, $str);
		$str = str_replace(':KOD', $row->KOD, $str);
		return $str;
	}
	
	function fncUrlTemizle($url){
		$arr = parse_url($url, PHP_URL_PATH);
		return $arr;
	}
	
	function sayfa_kontrol(){
		global $cdbPDO;
		$datetime1 	= new DateTime($_SESSION["menu_tarih"]);
		$datetime2 	= new DateTime(date("Y-m-d H:i:s"));
		$interval 	= $datetime1->diff($datetime2);
		$saat		= $interval->format('%h');
		$dakika		= $interval->format('%i');
		//var_dump2($_SESSION["menu"]);
		if($saat>=1 OR $_REQUEST['menu_yenile']==1){
			if(in_array($_SESSION["yetki_id"],array(1))){
				$sql = "SELECT 
							*
						FROM MENU AS M
							LEFT JOIN KULLANICI_MENU AS KM ON KM.MENU_ID = M.ID
						WHERE M.DURUM = 1
						GROUP BY M.ID ORDER BY M.SIRA ASC
						";
			} else {
				$sql = "SELECT 
							*
						FROM MENU AS M
							LEFT JOIN KULLANICI_MENU AS KM ON KM.MENU_ID = M.ID
						WHERE M.DURUM = 1 AND KM.KULLANICI_ID = '" . $_SESSION["kullanici_id"] . "'
						GROUP BY M.ID ORDER BY KM.SIRA ASC
						";
			}
			
			$_SESSION["menu"] 		= $cdbPDO->rows($sql, array());
			$_SESSION["menu_tarih"]	= date("Y-m-d H:i:s");
			//echo "Menü yenilendi."; saat başı çaşır
		}
		//var_dump2($_SERVER);
		//$adres = explode('/',$_SERVER["PHP_SELF"]);
		$adres = explode('/',$_SERVER["REQUEST_URI"]);
		$url   = $adres[count($adres)-1];
		$sayfa = explode('?',$url);
		$sayfa = $sayfa[0];
		
		foreach($_SESSION["menu"] as $row){
			if($row->LINK == $sayfa) { 
				$BASARILI = TRUE;
				break;
			}
		}
		if(!$BASARILI){
			echo "İzinsiz Giriş!"; die();
		}
	}
	
	function pathNav($url){
		$arr = explode('/', $_SERVER['REQUEST_URI']);
		$str = $arr[count($arr)-1];
		if($url == $str) return "active";
	}
	
	function dateDifference($date_1 , $date_2 , $differenceFormat = '%d Gün %h Saat %i Dakika' ) {
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    $interval = date_diff($datetime1, $datetime2);
	    return $interval->format($differenceFormat);
	}
	
	function fncVarYok($deger){
		if($deger == 1){
			$str = "VAR";
		} else {
			$str = "---";
		}
		return $str;
	}
	
	function var_dump2($str) {
		echo "<pre>";
		var_dump($str);
		echo "</pre>";
		
	}
	
	function dbg(){
	    if ($_SERVER['REMOTE_ADDR']=="127.0.0.1"){
	        return true;
	    }else{
	        return false;
	    }
	}
	
	//ekrana düzgün şekilde ve göster/gizle şeklinde gösterilmesinin sağlanması
	function dbgSQL($sql, $filtre=array() ){
		$random = rand();
  		if(dbg()) {
			if(count($filtre)==0) {
				
				echo "
					<div>
						<img src='../img/sql-icon.png' onclick='$(\"#dbg$random\").toggle();' style='cursor: pointer' width='25' height='25' >
						<div id='dbg$random' style='display: none; font-size: 9px; text-align: left'> 
							<pre>
							". SqlFormatter::format($sql) ."
							</pre>
						</div>
					</div>	
					";
				
			}else{
				
				$sql_echo = $sql;
				foreach($filtre as $key => $value){
					//$sql_echo = str_replace($key, "'".$value."'", $sql_echo);
					$sql_echo = preg_replace('/'.$key.'\b/', "'$value'", $sql_echo);
				}
				echo "
					<div>
						<img src='../img/sql-icon.png' onclick='$(\"#dbg$random\").toggle();' style='cursor: pointer' width='25' height='25' >
						<div id='dbg$random' style='display: none; font-size: 9px; text-align: left'>
							<pre>
							". SqlFormatter::format($sql_echo) ."
							</pre>
						</div>
					</div>	
					";
			}
		}
	}
	
	//ekrana düzgün şekilde ve göster/gizle şeklinde gösterilmesinin sağlanması
	function dbgGoster($arr){
		$random = rand();
  		if(dbg()) {
			if(count($arr)==0) {
				
				echo "
					<div>
						<img src='../img/sql-icon.png' onclick='$(\"#dbg$random\").toggle();' style='cursor: pointer' width='25' height='25' >
						<div id='dbg$random' style='display: none; font-size: 9px; text-align: left'> 
							<pre> $arr </pre>
						</div>
					</div>	
					";
				
			}else{
				
				echo "
					<div>
						<img src='../img/sql-icon.png' onclick='$(\"#dbg$random\").toggle();' style='cursor: pointer' width='25' height='25' >
						<div id='dbg$random' style='display: none; font-size: 9px; text-align: left'>
							<pre>". var_export($arr, true) ."</pre>
						</div>
					</div>	
					";
					
			}
		}
	}
	
	
	
	function kullanici_log_sayfa($DURUM = TRUE){
		global $cdbPDO;
		
		if($DURUM){
			//$_SERVER["REQUEST_URI"]
			$sayfa 			= $_SERVER['REQUEST_URI'];
			$geldigi_sayfa	= $_SERVER['HTTP_REFERER'];
			$filtre	= array();
			
			$sql = "INSERT INTO KULLANICI_LOG_SAYFA SET SAYFA = :SAYFA, 
														GELDIGI_SAYFA = :GELDIGI_SAYFA, 
														SESSION_ID = :SESSION_ID, 
														KULLANICI_LOG_ID = :KULLANICI_LOG_ID";
			$filtre[":SAYFA"] 				= $_SERVER['REQUEST_URI'];
			$filtre[":GELDIGI_SAYFA"] 		= $_SERVER['HTTP_REFERER'];
			$filtre[":SESSION_ID"] 			= session_id();
			$filtre[":KULLANICI_LOG_ID"] 	= $_SESSION['log_id'];
			$rowsCount = $cdbPDO->rowsCount($sql, $filtre);
			
		}
			
	}
	
	function admin_tema() {
		//return "skin-yellow-light";
		return "skin-blue";
		return "skin-yellow-light sidebar-collapse sidebar-mini";
	}
	
	function routeActive($route){
		if(empty($_REQUEST['route'])) return "";
		
		$hedef 	= explode("/", $route);
		$kaynak	= explode("/", $_REQUEST['route']);
		if($hedef[0] == $kaynak[0] AND count($hedef) == 1 ){
			return "active";
		} 
		
		if($hedef[1] == $kaynak[1]){
			return "active";
		}
		
	}
	
	
	
	function indirimOrani($indirimsiz, $indirimli){
		$oran = ($indirimli * 100 / $indirimsiz) - 100;
		if(intval($oran) <= 0) $oran = 0;
		return ($oran) . "%";
	}
	
	function temizUrl($str) {
		$ozelHarfler = array(
			'a' => array('á','à','â','ä','ã'),
			'A' => array('Ã','Ä','Â','À','Á'),
			'e' => array('é','è','ê','ë'),
			'E' => array('Ë','É','È','Ê'),
			'i' => array('í','ì','î','ï','ı'),
			'I' => array('Î','Í','Ì','İ','Ï'),
			'o' => array('ó','ò','ô','ö','õ'),
			'O' => array('Õ','Ö','Ô','Ò','Ó'),
			'u' => array('ú','ù','û','ü'),
			'U' => array('Ú','Û','Ù','Ü'),
			'c' => array('ç'),
			'C' => array('Ç'),
			's' => array('ş'),
			'S' => array('Ş'),
			'n' => array('ñ'),
			'N' => array('Ñ'),
			'y' => array('ÿ'),
			'Y' => array('Ÿ')
		);
 		
		$ozelKarakterler = array ('#', '$', '%', '^', '&', '*', '!', '~', '"', '\'', '=', '?', '/', '[', ']', '(', ')', '|', '<', '>', ';', ':', '\\', ', ');
		$str = str_replace($ozelKarakterler, '', $str);
		$str = str_replace(' ', '_', $str);
		foreach($ozelHarfler as $harf => $ozeller){
			foreach($ozeller as $tektek){
				$str = str_replace($tektek, $harf, $str);
			}
		}
		$str = preg_replace("/[^a-zA-Z0-9\-\.]/", "_", $str);
		$str = strtolower($str);
		return $str;
		
	}
	
	function arrayIndex($rows){
		$rows_yeni = array();
		
		foreach($rows as $key => $row){
			$rows_yeni[$row->ID]	= $row;
		}
		
		return $rows_yeni;
		
	}
	
	function fncSozlesme(){
		global $cdbPDO;
		global $row_site;
		
		$SOZLESME 	= $row_site->KULLANICI_SOZLESMESI;
		$SOZLESME	= str_replace("{NUMBER}", "12345", $SOZLESME);
		$SOZLESME	= str_replace("{DATE}", date("Y-m-d"), $SOZLESME);
		//$SOZLESME	= str_replace("\t", "", $SOZLESME);
		
		return $SOZLESME;
	}
	
	function fncActive($tab = 1, $ilk = 0){
		if($_REQUEST['tab'] == $tab OR $ilk == 1){
			return "active";
		}
	}
	
	function fncSurecActive($surec, $deger){
		if($surec == $deger){
			return "active";
		}
	}
	
	function fncMaliKodBosluk($str){
		$str = str_replace('_', ' ', $str);
		return $str;
		
	}
	
	function fncSayi($sayi){
		$sayi = trim($sayi);
		$sayi = str_replace('.', '', $sayi);
		$sayi = str_replace(',', '.', $sayi);
		return $sayi;
	}
	
	function fncKodKontrol($row = array()){
		if($row->KOD != $_REQUEST['kod'] AND !fncOtoLogin()){
			echo "Kod Hatası!"; die();
		}
	}
	
	function fncSifreUret($uzunluk = 8) {
	   	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    	$sifre = substr( str_shuffle( $chars ), 0, $uzunluk );
    	return $sifre;
	}
	
	function dil($str){
		global $cdbPDO;
		
		$str = trim($str);
		
		if($_COOKIE['dil'] == "TR" OR !isset($_COOKIE['dil'])){
			return $str;
			
		} else if(isset($_SESSION[$_COOKIE['dil']][$str])){
			return $_SESSION[$_COOKIE['dil']][$str];
			
		} else if(!isset($_SESSION[$_COOKIE['dil']][$str])){
			$filtre	= array();
			$sql = "INSERT INTO DIL SET TR = :TR, SAYFA = :SAYFA";
			$filtre[":TR"] 		= $str;
			$filtre[":SAYFA"] 	= $_SERVER['PHP_SELF'];
			$cdbPDO->rowsCount($sql, $filtre);
			
			$str = $_SESSION[$_COOKIE['dil']][$str]	 = "XX " . $str . " XX";
			
			return $str;
			
		} else {
			return $_SESSION[$_COOKIE['dil']][$str];	
			
		}
	}
	
	function dil2($str){
		return $str;
	}
	
	function err(){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
	
	
	
	function is_pdf($file){
		$arr = explode('.', $file);
		if(strtoupper($arr[count($arr)-1]) == "PDF"){
			return true;
		}
		return false;
	}
	
	function fncLink(){
		$str = $_SERVER['REQUEST_URI'];
		return $str;
	}
	
	function fncFormKey(){
		$key = md5(md5(session_id()));
		return $key;
	}
	
	function fncHizmetSurecYaz($row){
		if(is_null($row->ID)){
			return "";
		}
		
		return '&nbsp;<span class="badge badge-warning">'. $row->SUREC. '</span>';
	}
	
	// https://github.com/tazotodua/useful-php-scripts 
	function EXPORT_DATABASE($host,$user,$pass,$name,       $tables=array(), $backup_name=false){
		set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
		$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
		$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
		foreach($target_tables as $table){
			if (empty($table)){ continue; } 
			$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
			$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
			for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
				while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
					if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
						$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
					//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
					if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
				}
			} $content .="\n\n\n";
		}
		$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
		$backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
		ob_get_clean(); 
		header('Content-Type: application/octet-stream');  
		header("Content-Transfer-Encoding: Binary");  
		header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    
		header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
		echo $content; 
		exit;
	}
	
	function IMPORT_TABLES($host,$user,$pass,$dbname, $sql_file_OR_content){
		set_time_limit(3000);
		$SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
		$allLines = explode("\n",$SQL_CONTENT); 
		$mysqli = new mysqli($host, $user, $pass, $dbname); if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();} 
			$zzzzzz = $mysqli->query('SET foreign_key_checks = 0');	        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables); foreach ($target_tables[2] as $table){$mysqli->query('DROP TABLE IF EXISTS '.$table);}         $zzzzzz = $mysqli->query('SET foreign_key_checks = 1');    $mysqli->query("SET NAMES 'utf8'");	
		$templine = '';	// Temporary variable, used to store current query
		foreach ($allLines as $line)	{											// Loop through each line
			if (substr($line, 0, 2) != '--' && $line != '') {$templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
				if (substr(trim($line), -1, 1) == ';') {		// If it has a semicolon at the end, it's the end of the query
					if(!$mysqli->query($templine)){ print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');  }  $templine = ''; // set variable to empty, to start picking up the lines after ";"
				}
			}
		}	return 'Importing finished. Now, Delete the import file.';
	}   //see also export.php 
	
	
	function fncYaziKucult($keyword){
		$low = array('a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','q','w','x');
		$upp = array('A','B','C','Ç','D','E','F','G','Ğ','H','I','İ','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z','Q','W','X');
		$keyword = str_replace( $upp, $low, $keyword );
		$keyword = function_exists( 'mb_strtolower' ) ? mb_strtolower( $keyword ) : $keyword;
		return $keyword;
	}
	
	function fncYaziBuyult($keyword){
		$low = array('a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','q','w','x');
		$upp = array('A','B','C','Ç','D','E','F','G','Ğ','H','I','İ','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z','Q','W','X');
		$keyword = str_replace( $low, $upp, $keyword );
		$keyword = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $keyword ) : $keyword;
		return $keyword;
	}
	
	function mungXML($xml)
	{
	    $obj = SimpleXML_Load_String($xml);
	    if ($obj === FALSE) return $xml;

	    // GET NAMESPACES, IF ANY
	    $nss = $obj->getNamespaces(TRUE);
	    if (empty($nss)) return $xml;

	    // CHANGE ns: INTO ns_
	    $nsm = array_keys($nss);
	    foreach ($nsm as $key)
	    {
	        // A REGULAR EXPRESSION TO MUNG THE XML
	        $rgx
	        = '#'               // REGEX DELIMITER
	        . '('               // GROUP PATTERN 1
	        . '\<'              // LOCATE A LEFT WICKET
	        . '/?'              // MAYBE FOLLOWED BY A SLASH
	        . preg_quote($key)  // THE NAMESPACE
	        . ')'               // END GROUP PATTERN
	        . '('               // GROUP PATTERN 2
	        . ':{1}'            // A COLON (EXACTLY ONE)
	        . ')'               // END GROUP PATTERN
	        . '#'               // REGEX DELIMITER
	        ;
	        // INSERT THE UNDERSCORE INTO THE TAG NAME
	        $rep
	        = '$1'          // BACKREFERENCE TO GROUP 1
	        . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
	        ;
	        // PERFORM THE REPLACEMENT
	        $xml =  preg_replace($rgx, $rep, $xml);
	    }
	    return $xml;
	}
	
	function GUID() {
	    if (function_exists('com_create_guid') === true) {
	        return trim(com_create_guid(), '{}');
	    }
	    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	