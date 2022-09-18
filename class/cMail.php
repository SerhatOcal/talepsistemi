<?

	class Mail {
		
		private $cdbPDO;
		private $mail;
		
		function __construct($cdbPDO) {
	        $this->cdbPDO 		= $cdbPDO;
	        
		}
		
		public function curlCalistir($input_xml, $islem = ''){
	    	$headers = array('Content-type: text/xml'); 
	    	$adres = 'http://doguscam.com/01simple.php?';
	    	
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        //curl_setopt($ch, CURLOPT_HEADER, 1);
	        curl_setopt($ch, CURLOPT_URL, $adres);
	        $result_xml = curl_exec($ch);
	        curl_close($ch);	        
	    	
		}
		
	    public function Gonder($kime = "", $konu = "", $icerik = "", $kimden = "", $cc = ""){
	    	
	    	if(!is_array($kime)){
	    		$kime = explode(';', str_replace(",",";",$kime));
	    	}
	    	
	    	if(!is_array($cc)){
	    		$cc = explode(';', str_replace(",",";",$cc));
	    	}
	    	
	    	$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'mail.talepsistemi.com';
			$mail->Port = 587;
			$mail->Username = 'talep@talepsistemi.com';
			$mail->Password = '123123';
			$mail->SetLanguage("tr");
			$mail->setFrom($mail->Username, 'TalepSistemi');
			
			if(is_array($kime)){
		    	foreach($kime as $k => $v){
					$mail->AddAddress($v); 		
				}				
			} else {
				$mail->AddAddress($kime); 
			}
			
			if(is_array($cc)){
		    	foreach($cc as $email){
					$mail->addCC($email); 		
				}				
			} else {
				$mail->AddAddress($cc); 
			}
			
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $konu;
			$mail->msgHTML($icerik);
			
			if($mail->send()) {
			    //echo 'Mail gönderildi!';
			    return TRUE;
			} else {
			    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
			    return FALSE;
			}
	    	
	    }
	    
	    public function Calisiyor(){
			echo "Çalışıyor.";
			
		}
	    
	}

	/*
	$cMail->Gonder($kime, $konu, $icerik, $kimden);    
    */
?>