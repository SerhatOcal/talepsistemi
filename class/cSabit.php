<?

	class Sabit {		
		
		function __construct($row_site) {
	       $this->rSite = $row_site;
	        
		}
		
		public function siteBaslik(){
			$str = "Talep Sistemi";
			return $str;
		}
	    
	    public function imgPathFolder($str){
			return $_SERVER['DOCUMENT_ROOT'] . "/img/" . $this->rSite->IMG_PATH ."/". $str . "/";
		}
		
	    public function imgPathFile($str){
			return $_SERVER['DOCUMENT_ROOT'] . "/img/" . $this->rSite->IMG_PATH ."/". $str;
		}		
	    
		public function imgPath($str){
			return "/img/" . $this->rSite->IMG_PATH ."/". $str;
		}
	    
	}

?>