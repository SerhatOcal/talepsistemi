<?

class Curl {
	
	private $cdbPDO;
	private $cMail;
	
	function __construct($cdbPDO, $cMail) {
		$this->cdbPDO 	= $cdbPDO;
		$this->cMail	= $cMail;
	}
	
	public function Cek($url, $postFields, $islem = '') {
		
		if(empty($url) OR is_null($url)) return "";
		
		$post = http_build_query($postFields, '=', '&');
	    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    
	    $result = $result;
	    
	    if($result->kod != 1){
			//$this->cMail->Gonder('hata@talepsistemi.com', "GIDEN:" . $islem, $post);
		}
			
		return $result;
		
	}
	
	public function jsonCek($url, $postFields, $islem = '') {
		
		if(empty($url) OR is_null($url)) return "";
		
		$post = http_build_query($postFields, '=', '&');
	    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    
	    $result = json_decode($result);
	    
	    if($result->kod != 1){
			//$this->cMail->Gonder('hata@talepsistemi.com', "GIDEN:" . $islem, $post);
		}
			
		return $result;
		
	}
	
	public function xmlCek($url, $postFields, $islem = '') {
		
		if(empty($url) OR is_null($url)) return "";
		
		$post = http_build_query($postFields, '=', '&');
	    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSLVERSION, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $result = curl_exec($ch);
	    curl_close($ch);
		
		return $result;
		
	}
	
	public function resimCek($url, $postFields, $islem = '') {
		
		if(empty($url) OR is_null($url)) return "";
		
		$post = http_build_query($postFields, '=', '&');
	    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    
	    if($result->kod != 1){
			//$this->cMail->Gonder('hata@talepsistemi.com', "GIDEN:" . $islem, $post);
		}
			
		return $result;
		
	}
	
	public function Calistir($url, $input_xml, $islem = ""){   	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 			0);
		//curl_setopt($ch, CURLOPT_HTTPAUTH, 			CURLAUTH_BASIC);
		//curl_setopt($ch, CURLOPT_USERPWD, 			"user" . ":" . "123456");
		curl_setopt($ch, CURLOPT_URL, 				$url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 	60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 			60);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	true);
		curl_setopt($ch, CURLOPT_POST, 				1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 		$input_xml);
		curl_setopt($ch, CURLOPT_VERBOSE, 			TRUE); 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, 		array("Content-Type: text/xml; charset=utf-8", "Content-length: " . strlen($input_xml)));
	    $result_xml = curl_exec($ch);
	    $err = curl_error($ch);
	    curl_close($ch);
	    
	    return $result_xml;
	    
	}
	
}
