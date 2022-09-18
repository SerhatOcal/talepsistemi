<?

class tableData{
	
	private $cdbPDO;
	private $dbPDO;
	private $rowss;
    private $rows;
    private $sql;
    private $sqls;
    private $sayfa;
    private $excel;
    private $excelDosyaAdi;
    private $post;
    private $filtre;
    private $tumData;
    private $sayfaIlk;
    private $sayfaSon;		
    private $sayfaAdet;	
    private $sayfaUstYazi;	
    private $sayfaAltYazi;	
    private $dataa = 15;
	
	function __construct($cdbPDO) {
        $this->cdbPDO 	= $cdbPDO;
	}
	
	// Sql kodunun ne olduğunun öğrenmesi adına debug için kullanmaya
    public function setTemizle(){
        $this->secim = "";
		$this->tumu = "";
		$this->name = "";
		$this->tumuValue = "";
        $this->tumuName = "";
        $this->clss = "";
        
    }
    
    // setPost("Plaka","34")
    public function setOnePost($post, $val){
        $this->post[$post] = $val;
        return $this;
    }
    
    // setPost($_REQUEST) ile tüm parametreleri alma
    public function setPost($post){
        $this->post = $post;
        return $this;
    }
    
    // çalıştırılacak function u belirleme
    public function setSayfa($sayfa){
        $this->sayfa = $sayfa;
        return $this;
        
    }	
    
    // excelOut alınacak Sutün bilgileri
    public function setExcel($excel){
        $this->excel = $excel;
        return $this;
        
    }	

	// excel Başlıgı
    public function setExcelDosyaAdi($excelDosyaAdi){
        $this->excelDosyaAdi = $excelDosyaAdi;
        return $this;
        
    }
    
    public function setTrim(){
		foreach($_REQUEST as $key => $val){
			$_REQUEST[$key]	= trim($val);
		}
		
	}
    
    // foksiyonu çalıştır
    public function Uygula(){
    	if(!method_exists($this, $this->sayfa)){
			echo "İstenen Tablo fonksiyon bulunamadı. Tablo: " . $this->sayfa;
		}
		
		if(!$_REQUEST['filtre']) return $this;
		
		$this->setTrim();
		$this->{$this->sayfa}();
        return $this;
        
    }
    
    /*
    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="far fa-arrow-alt-to-left"></i></span></a></li>
    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="far fa-arrow-alt-left"></i></span></a></li>
    <li class="page-item active" aria-current="page"><span class="page-link">1<span class="sr-only">(current)</span></span></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="far fa-arrow-alt-right"></i></span></a></li>
    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="far fa-arrow-alt-to-right"></i></span></a></li>
    */
    
    // sayfalama için mutlak
    public function setSayfalama1($sayfa, $sayfaToplam, $sayfaAdet) { 

		//Sayfalama için ekledim.
		if(intval($sayfa)<=0 || intval($sayfaToplam)<($sayfa-1)*$sayfaAdet) $sayfa = 1;
		if(intval($sayfaAdet)<=0) $sayfaAdet = 20;
		$sayfaIlk 	= ($sayfa-1) * $sayfaAdet;
		$sayfaSon 	= $sayfa * $sayfaAdet;
		
		$sayfaSayisi = ceil($sayfaToplam/$sayfaAdet);
		$sayfaAltYazi = "";
		for($i = 1; $i <= $sayfaSayisi; $i++){
			if($i==$sayfa) {
				$sayfaAltYazi .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$i,'')\" aria-label=\"Previous\"> $i </a></li>";
			} else {
				$sayfaAltYazi .= "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$i,'')\" aria-label=\"Previous\"> $i </a></li>";
			}			
			
			if($i%50 == 0) $sayfaAltYazi .= "<br>";
		}
		if($sayfaToplam>0) {
			$sayfaUstYazi = $sayfaToplam . " Sonuç içinde " . ($sayfaIlk+1) . " - " . (($sayfaToplam>$sayfaSon)?$sayfaSon:$sayfaToplam) . " arası sonuçlar"; 
			$sayfaOnceki  = $sayfa - 1;
			$sayfaSonraki = $sayfa + 1; 
			if($sayfa == 1){
				$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',1,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-left\"></i></a></li>" . $sayfaAltYazi;
			} else{
				$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaOnceki,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-to-left\"></i></a></li>" . $sayfaAltYazi;
			}
			if($sayfa == $sayfaSayisi){
				$sayfaAltYazi = $sayfaAltYazi . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSayisi,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-right\"></i></a></li>";
			} else{
				$sayfaAltYazi = $sayfaAltYazi . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSonraki,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-right\"></i></a></li>";
			}
			$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',1,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-to-left\"></i></a></li>" . $sayfaAltYazi;
			$sayfaAltYazi = $sayfaAltYazi . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSayisi,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-to-right\"></i></a></li>";
			
		} else {
			$sayfaUstYazi = "0 Kayıt Bulundu... ";		
			
		}
		
		$this->sayfaUstYazi = $sayfaUstYazi;
		$this->sayfaAltYazi = $sayfaAltYazi;
		$this->sayfaIlk = $sayfaIlk;
		$this->sayfaSon = $sayfaSon;
		$this->sayfaAdet = $sayfaAdet;
		$this->sayfa = $sayfa;
		
		
	}	
		
	public function setSayfalama2($sayfa, $sayfaToplam, $sayfaAdet) { 

		//Sayfalama için ekledim.
		if(intval($sayfa)<=0 || intval($sayfaToplam)<($sayfa-1)*$sayfaAdet) $sayfa = 1;
		if(intval($sayfaAdet)<=0) $sayfaAdet = 20;
		$sayfaIlk 	= ($sayfa-1) * $sayfaAdet;
		$sayfaSon 	= $sayfa * $sayfaAdet;
		
		$sayfaSayisi = ceil($sayfaToplam/$sayfaAdet);
		$sayfaAltYazi = "";
		
		if($sayfaSayisi > 26){
			$bas_i	= $sayfa - 13 + ($sayfa < 13 ? 13 - $bas_i : 0 );
			$bas_i	= $sayfa < 13 ? 1 : $sayfa - 13;
			$bas_ucnokta	= ($bas_i) > 1 ? "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',1,'')\" aria-label=\"Previous\"> ... </a></li>" : "";
			
			$bit_i	= $sayfa + 13 + ($sayfa < 13 ? 13 - $sayfa : 0);
			$bit_i	= $bit_i > $sayfaSayisi ? $sayfaSayisi : $bit_i;
			$bit_ucnokta	= ($bit_i) < $sayfaSayisi ? "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSayisi,'')\" aria-label=\"Previous\"> ... </a></li>" : "";
		} else {
			$bas_i 	= 1;
			$bit_i	= $sayfaSayisi;
		}
			
		for($i = $bas_i; $i <= $bit_i; $i++){
			if($i==$sayfa) {
				$sayfaAltYazi .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$i,'')\" aria-label=\"Previous\"> $i </a></li>";
			} else {
				$sayfaAltYazi .= "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$i,'')\" aria-label=\"Previous\"> $i </a></li>";
			}
		}
		
		if($sayfaToplam>0) {
			$sayfaUstYazi = $sayfaToplam . " Sonuç içinde " . ($sayfaIlk+1) . " - " . (($sayfaToplam>$sayfaSon)?$sayfaSon:$sayfaToplam) . " arası sonuçlar"; 
			$sayfaOnceki  = $sayfa - 1;
			$sayfaSonraki = $sayfa + 1; 
			
			if($sayfa == 1){
				$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',1,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-left\"></i></a></li>" . $sayfaAltYazi;
			} else{
				$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaOnceki,'')\" aria-label=\"Previous\"> <i class=\"far fa-arrow-alt-left\"></i> </a></li>" . $bas_ucnokta . $sayfaAltYazi;
			}
			
			if($sayfa == $sayfaSayisi){
				$sayfaAltYazi = $sayfaAltYazi . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSayisi,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-right\"></i></a></li>";
			} else{
				$sayfaAltYazi = $sayfaAltYazi . $bit_ucnokta . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSonraki,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-right\"></i></a></li>";
			}
			
			$sayfaAltYazi = "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',1,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-to-left\"></i></a></li>" . $sayfaAltYazi;
			$sayfaAltYazi = $sayfaAltYazi . "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:fsubmit('form',$sayfaSayisi,'')\" aria-label=\"Previous\"><i class=\"far fa-arrow-alt-to-right\"></i></a></li>";
			
		} else {
			$sayfaUstYazi = "0 Kayıt Bulundu... ";		
			
		}
		
		$this->sayfaUstYazi = $sayfaUstYazi;
		$this->sayfaAltYazi = $sayfaAltYazi;
		$this->sayfaIlk = $sayfaIlk;
		$this->sayfaSon = $sayfaSon;
		$this->sayfaAdet = $sayfaAdet;
		$this->sayfa = $sayfa;
		
	}
	
	// sayfalama için mutlak
    public function setSayfalama3($sayfa, $sayfaToplam, $sayfaAdet) { 

		//Sayfalama için ekledim.
		if(intval($sayfa)<=0 || intval($sayfaToplam)<($sayfa-1)*$sayfaAdet) $sayfa = 1;
		if(intval($sayfaAdet)<=0) $sayfaAdet = 20;
		$sayfaIlk 	= ($sayfa-1) * $sayfaAdet;
		$sayfaSon 	= $sayfa * $sayfaAdet;
		
		$sayfaSayisi = ceil($sayfaToplam/$sayfaAdet);
		$sayfaAltYazi = "";
		
		if($sayfaSayisi > 26){
			$bas_i	= $sayfa - 13 + ($sayfa < 13 ? 13 - $bas_i : 0 );
			$bas_i	= $sayfa < 13 ? 1 : $sayfa - 13;
			$bas_ucnokta	= ($bas_i) > 1 ? "<li><a href=\"javascript:fsubmit('form',1,'')\"> ... </a></li>" : "";
			
			$bit_i	= $sayfa + 13 + ($sayfa < 13 ? 13 - $sayfa : 0);
			$bit_i	= $bit_i > $sayfaSayisi ? $sayfaSayisi : $bit_i;
			$bit_ucnokta	= ($bit_i) < $sayfaSayisi ? "<li><a href=\"javascript:fsubmit('form',$sayfaSayisi,'')\"> ... </a></li>" : "";
		} else {
			$bas_i 	= 1;
			$bit_i	= $sayfaSayisi;
		}
			
		for($i = $bas_i; $i <= $bit_i; $i++){
			if($i==$sayfa) 
				$sayfaAltYazi .= "<li class=\"active\"><a href=\"javascript:void(0)\">$i</a></li>";	
			else 
				$sayfaAltYazi .= "<li><a href=\"javascript:fsubmit('form',$i,'')\">$i</a></li>";	
			
			//if($i%50 == 0) $sayfaAltYazi .= "<br>";
		}
		if($sayfaToplam>0) {
			$sayfaUstYazi = $sayfaToplam . " Sonuç içinde " . ($sayfaIlk+1) . " - " . (($sayfaToplam>$sayfaSon)?$sayfaSon:$sayfaToplam) . " arası sonuçlar"; 
			$sayfaOnceki  = $sayfa - 1;
			$sayfaSonraki = $sayfa + 1; 
			if($sayfa == 1){
				$sayfaAltYazi = "<li><a href=\"javascript:fsubmit('form',1,'')\"> <i class='glyphicon glyphicon-backward'></i> </a></li>" .  $sayfaAltYazi;	
			} else{
				$sayfaAltYazi = "<li><a href=\"javascript:fsubmit('form',$sayfaOnceki,'')\"> <i class='glyphicon glyphicon-backward'></i> </a></li>" . $bas_ucnokta . $sayfaAltYazi;
			}
			if($sayfa == $sayfaSayisi){
				$sayfaAltYazi = $sayfaAltYazi . "<li><a href=\"javascript:fsubmit('form',$sayfaSayisi,'')\"> <i class='glyphicon glyphicon-forward'></i> </a></li>";
			} else{
				$sayfaAltYazi = $sayfaAltYazi . $bit_ucnokta . "<li><a href=\"javascript:fsubmit('form',$sayfaSonraki,'')\"> <i class='glyphicon glyphicon-forward'></i> </a></li>";
			}			
			$sayfaAltYazi = "<li><a href=\"javascript:fsubmit('form',1,'')\"> <i class='glyphicon glyphicon-fast-backward'></i> </a> </li>" . $sayfaAltYazi;
			$sayfaAltYazi = $sayfaAltYazi . "<li><a href=\"javascript:fsubmit('form',$sayfaSayisi,'')\"> <i class='glyphicon glyphicon-fast-forward'></i> </a></li>";
			
		} else {
			$sayfaUstYazi = "0 Kayıt Bulundu... ";		
			
		}
		
		$this->sayfaUstYazi = $sayfaUstYazi;
		$this->sayfaAltYazi = $sayfaAltYazi;
		$this->sayfaIlk = $sayfaIlk;
		$this->sayfaSon = $sayfaSon;
		$this->sayfaAdet = $sayfaAdet;
		$this->sayfa = $sayfa;
		
	}
	
	public function getSayfaUstYazi() { 
		return $this->sayfaUstYazi;
	}
	
	public function getSayfaAltYazi() { 
		return $this->sayfaAltYazi;
	}
	
	public function getSayfaIlk() { 
		return $this->sayfaIlk;
	}
	
	public function getSayfaSon() { 
		return $this->sayfaSon;
	}
	
	public function getSayfaAdet() { 
		return $this->sayfaAdet;
	}
	
	public function getSayfa() { 
		return $this->sayfa;
	}
        
    // sadece dataların çıplak olarak dönmesini sağlıyor
    public function getTable(){
    	$this->tumData["rowss"] 		= $this->rowss;
    	$this->tumData["rows"] 			= $this->rows;
    	$this->tumData["sayfaIlk"] 		= $this->sayfaIlk;
    	$this->tumData["sayfaSon"] 		= $this->sayfaSon;
    	$this->tumData["sayfaAdet"] 	= $this->sayfaAdet;
    	$this->tumData["sayfaUstYazi"] 	= $this->sayfaUstYazi;
    	$this->tumData["sayfaAltYazi"] 	= $this->sayfaAltYazi;
    	$this->tumData["sql"] 			= $this->cdbPDO->getSQL($this->sql, $this->filtre);
    	$this->tumData["sqls"] 			= $this->cdbPDO->getSQL($this->sqls, $this->filtre);
    	$this->tumData["excel"] 		= $this->excel;
    	$this->tumData["excelDosyaAdi"] = ($this->excelDosyaAdi)?$this->excelDosyaAdi:date("YmdHis");
        return $this->tumData;
    }
    
    // Sql kodunun ne olduğunun öğrenmesi adına debug için kullanmaya
    public function getSql(){
    	return $this->cdbPDO->getSQL($this->sql, $this->filtre);	
    }
	
	// Gönderilen kriterlerin alınması
    public function getPost(){
        return $this->post;
    }
    
    // Sadece dataların alınması
    public function getRows(){
        return $this->rows;
    }
	
}

?>