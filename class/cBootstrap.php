<?

	class Bootstrap{
		private $cdbPDO;
		private $cSubData;
		private $cCombo;
		private $rSite;
		private $rKullanici;
		private $rAnaMenu;
		private $rMenu;
		private $rLink;
		
		function __construct($cdbPDO = "", $cSubData = "", $cCombo = "", $cSabit = "", $row_site = "", $row_kullanici = "", $rows_anamenu = "", $rows_menu = "", $rows_linklerim = ""){
			$this->cdbPDO 			= $cdbPDO;
			$this->cdbPDO 			= $cdbPDO;
			$this->cSubData 		= $cSubData;
			$this->cCombo			= $cCombo;
			$this->cSabit			= $cSabit;
			$this->rSite 			= $row_site;
			$this->rKullanici		= $row_kullanici;
			$this->rAnaMenu			= $rows_anamenu;
			$this->rMenu 			= $rows_menu;
			$this->rLink 			= $rows_linklerim;
		}
		
		public function getHeader(){
			if($_SESSION['kullanici_id'] > 0) {
				$rows_mesaj_okunmamis 						= $this->cSubData->getMesajGelenOkunmamis();
				$rows_bildirim								= $this->cSubData->getIhaleOkunmamisMesaj($_REQUEST);
				$_SESSION['count_okunmamis_ihale_mesaj'] 	= count($rows_bildirim);
				$_SESSION['rows_okunmamis_ihale_mesaj']		= $rows_bildirim;//echo json_encode($_SESSION['rows_okunmamis_ihale_mesaj']);die();
				$rows_mesaj 								= $this->cSubData->getMesajGelen();
				//$rows_basvuru 								= $this->cSubData->getBasvurular();
				
				?>
				<header class="page-header" role="banner">
	                
	                <div class="page-logo">
	                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
	                        <img src="../smartadmin/img/logo.png" alt="logo">
	                        <span class="page-logo-text mr-1"> <?=$this->rSite->BASLIK?> </span>
	                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
	                        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
	                    </a>
	                </div>
	                
	                <div class="hidden-md-down dropdown-icon-menu position-relative">
	                    <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Yönlendirme"> <i class="ni ni-menu"></i> </a>
	                    <ul>
	                        <li> <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation"> <i class="ni ni-minify-nav"></i> </a> </li>
	                        <li> <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation"> <i class="ni ni-lock-nav"></i> </a> </li>
	                    </ul>
	                </div>
	                <div class="hidden-lg-up">
	                    <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on"> <i class="ni ni-menu"></i> </a>
	                </div>
	                <div class="search">
	                    <form name="formSearch" id="formSearch" class="app-forms hidden-xs-down" role="search" action="/talep/talep_listesi.do?route=talep/talep_listesi&filtre=1" autocomplete="off">
	                    	<div class="input-group" style="width: 250px">
	                    		<input type="hidden" name="route" value="talep/talep_listesi"/>
	                    		<input type="hidden" name="filtre" value="1"/>
	                    		<input type="text" name="arama_q" id="arama_q" placeholder="Talep Başlık, Talep No ..." class="form-control border-right-0" tabindex="1" >
	                    		<div class="input-group-append"><span class="input-group-text btn bg-transparent"><i class="fal fa-search" onclick="$('#formSearch').submit()"></i></span></div>
	                    		<a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on"><i class="fal fa-times"></i> </a>
	                    	</div>
	                    </form>
	                </div>
	                <div class="ml-auto d-flex">
	                    <div class="hidden-sm-up">
	                        <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search"> <i class="fal fa-search"></i> </a>
	                    </div>
	                    
	                    <a href="/" class="header-icon border-white" title="Talep Açma"> <i class="fal fa-plus-circle"></i> </a>
	                    <a href="/" class="header-icon border-white" title="Toplantı Açma"> <i class="fal fa-calendar-plus"></i> </a>
	                    <div>
	                        <a href="#" class="header-icon" data-toggle="dropdown">
	                            <i class="fal fa-envelope"></i>
	                            <span class="badge badge-icon"><?=count($rows_mesaj_okunmamis)?></span>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
	                            <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
	                                <h4 class="m-0 text-center color-white">
	                                    <?=count($rows_mesaj_okunmamis)?> <?=dil("Okunmamış")?>
	                                    <small class="mb-0 opacity-80"><?=dil("Mesaj Kutusu")?></small>
	                                </h4>
	                            </div>
	                            <div class="tab-content tab-notification">
	                                <div class="tab-pane active" id="tab-messages" role="tabpanel">
	                                    <div class="custom-scroll h-100">
	                                        <ul class="notification">
	                                        	<?foreach($rows_mesaj_okunmamis as $key => $row_mesaj_okunmamis) {?>
	                                            <li class="unread">
	                                                <a href="<?=$row_mesaj_okunmamis->LINK?>" class="d-flex align-items-center">
	                                                    <span class="status mr-2">
	                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('<?=$row_mesaj_okunmamis->KIMDEN_RESIM_URL?>')"></span>
	                                                    </span>
	                                                    <span class="d-flex flex-column flex-1 ml-1">
	                                                        <span class="name"><?=$row_mesaj_okunmamis->KIMDEN?> <!-- <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span>--> </span>
	                                                        <span class="msg-a fs-sm"><?=$row_mesaj_okunmamis->BASLIK?> </span>
	                                                        <!-- <span class="msg-b fs-xs">...</span> -->
	                                                        <span class="fs-nano text-muted mt-1"><?=$row_mesaj_okunmamis->GECEN_SURE?></span>
	                                                    </span>
	                                                </a>
	                                            </li>
	                                            <?}?>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="py-2 px-3 bg-faded d-block rounded-bottom text-center border-faded border-bottom-0 border-right-0 border-left-0">
	                                <a href="/mesaj/gelen_kutusu.do" class="fs-xs fw-500 ml-auto"><?=dil("Tüm Mesajlar")?></a>
	                            </div>
	                        </div>
	                    </div>
	                    <div>
	                        <a href="#" class="header-icon" data-toggle="dropdown">
	                            <i class="fal fa-bell"></i>
	                            <span class="badge badge-icon"><?=count($rows_bildirim)?></span>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
	                            <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
	                                <h4 class="m-0 text-center color-white">
	                                    <?=count($rows_bildirim)?> <?=dil("Okunmamış")?>
	                                    <small class="mb-0 opacity-80"><?=dil("Bildirim Kutusu")?></small>
	                                </h4>
	                            </div>
	                            <div class="tab-content tab-notification">
	                                <div class="tab-pane active" id="tab-messages" role="tabpanel">
	                                    <div class="custom-scroll h-100">
	                                        <ul class="notification">
	                                        	<?foreach($rows_bildirim as $key => $row_bildirim) {?>
	                                        	<li class="unread">
                                                    <div class="d-flex align-items-center show-child-on-hover">
                                                        <span class="d-flex flex-column flex-1">
                                                            <span class="name d-flex align-items-center"><?=$row_bildirim->KIMDEN?> <!-- <span class="badge badge-success fw-n ml-1">UPDATE</span> --> </span>
                                                            <span class="msg-a fs-sm"> <?=$row_bildirim->MESAJ?> </span>
	                                                    	<span class="fs-nano text-muted mt-1"><?=$row_bildirim->GECEN_SURE?></span>
                                                        </span>
                                                        <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        	<a href="#" class="text-muted mr-1" title="<?=dil("Dosya")?>"><i class="fal fa-file"></i></a>
                                                            <a href="#" class="text-muted" title="<?=dil("Sil")?>"><i class="fal fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?}?>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="py-2 px-3 bg-faded d-block rounded-bottom text-center border-faded border-bottom-0 border-right-0 border-left-0">
	                                <a href="/mesaj/gelen_bildirimler.do" class="fs-xs fw-500 ml-auto"><?=dil("Tüm Bildirimler")?></a>
	                            </div>
	                        </div>
	                    </div>
	                   
	                    <div>
	                        <a href="#" data-toggle="dropdown" class="header-icon d-flex align-items-center justify-content-center ml-2">
	                            <img src="../img/100x100.png" class="profile-image rounded-circle" alt="Kulllanıcı">
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
	                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
	                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
	                                    <span class="mr-2">
	                                        <img src="../img/100x100.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
	                                    </span>
	                                    <div class="info-card-text">
	                                        <div class="fs-lg text-truncate text-truncate-lg"><?=$this->rKullanici->ADSOYAD?></div>
	                                        <span class="text-truncate text-truncate-md opacity-80"><?=$this->rKullanici->YETKI?></span>
	                                        <span class="d-inline-block text-truncate text-truncate-sm"><?=$this->rKullanici->KULLANICI?></span>
	                                        <span class="d-inline-block text-truncate text-truncate-sm"><?=$this->rKullanici->ASISTAN_HIZMETI?></span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="dropdown-divider m-0"></div>
	                            <a href="/kullanici/hesabim.do" class="dropdown-item">
	                                <span data-i18n="drpdwn.settings"><?=dil2("Kullanıcı Ayarları")?></span>
	                            </a>
	                            <div class="dropdown-divider m-0"></div>
	                            <a href="#" class="dropdown-item" data-action="app-fullscreen">
	                                <span data-i18n="drpdwn.fullscreen"><?=dil2("Tam Ekran")?></span>
	                                <i class="float-right text-muted fw-n">F11</i>
	                            </a>
	                            <div class="dropdown-divider m-0"></div>
	                            <a class="dropdown-item fw-500 pt-3 pb-3" href="/giris.do">
	                                <span> Çıkış </span>
	                            </a>
	                        </div>
	                    </div>
	                </div>
	            </header>
				<?
			}
			
		}
		
		public function getMenu(){
			//var_dump2($this->rKullanici->RESIM_URL);
			if($_SESSION['kullanici_id'] > 0) {
				$rows_mesaj_okunmamis 						= $this->cSubData->getMesajGelenOkunmamis();
				$rows_okunmamis_ihale_mesaj					= $this->cSubData->getIhaleOkunmamisMesaj($_REQUEST);
				$_SESSION['count_okunmamis_ihale_mesaj'] 	= count($rows_okunmamis_ihale_mesaj);
				$_SESSION['rows_okunmamis_ihale_mesaj']		= $rows_okunmamis_ihale_mesaj;//echo json_encode($_SESSION['rows_okunmamis_ihale_mesaj']);die();
				$rows_mesaj 								= $this->cSubData->getMesajGelen();
				//$rows_basvuru 								= $this->cSubData->getBasvurular();
				?>
				
				<aside class="page-sidebar">
                    <div class="page-logo" style="height: 100px;">
                        <a href="/" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
			        		<img src="../img/kullanici.jpg" alt="logo" aria-roledescription="logo" style="height: 80px;">
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        </a>
                    </div>
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter Menü" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card">
                            <img src="<?=$this->cSabit->imgPath($this->rKullanici->RESIM_URL)?>" class="profile-image rounded-circle" alt="">
                            <div class="info-card-text">
                                <a href="/kullanici/hesabim.do" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block"><?=$this->rKullanici->ADSOYAD?></span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm"><?=$this->rKullanici->SERVIS?></span>
                                <span class="d-inline-block text-truncate text-truncate-sm"><?=$this->rKullanici->YETKI?></span>
                            </div>
                            <img src="../smartadmin/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                           <?foreach($this->rAnaMenu as $key => $row_anamenu){?>
						        <?if(count($this->rMenu[$row_anamenu->ROUTE]) > 0){?>
						        <li class="<?=routeActive($row_anamenu->ROUTE)?>">
						          	<a href="#" class="waves-effect waves-themed">
							            <i class="<?=$row_anamenu->CLASS?> <?=$this->getTextColor()?>"></i>
							            <span class="nav-link-text" data-i18n="nav.application_intel"> <?=dil($row_anamenu->ANAMENU)?> </span>
						          	</a>
						          	<ul>
						          	<?foreach($this->rMenu[$row_anamenu->ROUTE] as $key2 => $row){?>
										<li class="<?=routeActive($row->ROUTE)?>" title="<?=$row->TITLE?>"><a href="<?=$row->LINK?>" data-filter-tags="<?=$row->FILTRE?>" style="padding-left: 30px;"><i class="fal"></i> <?=dil($row->MENU)?> </a></li>
						          	<?}?>	
						          	</ul>
						        </li>
					        	<?}?>
					        <?}?>
					        <li>
						      	<a href="#" data-filter-tags="">
							        <i class="fal fa-link <?=$this->getTextColor()?>"></i>
							        <span class="nav-link-text"> <?=dil("Linklerim")?> </span>
						      	</a>
						      	<ul>
						      	<?foreach($this->rLink as $key => $row){?>
							        <li><a href="<?=$row->LINK?>" target="_blank" data-filter-tags="" style="padding-left: 30px;"> <?=$row->LINK_ADI?> </a> 
							        <!-- <a href="javascript:void(0)" data-id="<?=$row->ID?>" onclick="fncLinkSil(this)" class="pull-right" style="padding-right: 5px;"> <i class="fal fa-trash text-red"></i> </a> --> </li>
						      	<?}?>	
						      	</ul>
						    </li>
						    <li>
						    	<a href="#" title="Pages" data-filter-tags="tema" class=" waves-effect waves-themed">
                                    <i class="fal fa-plus-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.pages"><?=dil("Tema Seçimi")?></span>
                                </a>
                                <div class="settings-panel">
						    	<div class="expanded theme-colors pl-5 pr-3">
	                                <ul class="m-0">
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-0" data-id="0" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wisteria (base css)"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-1" data-id="1" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tapestry"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-2" data-id="2" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Atlantis"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-3" data-id="3" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Indigo"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-4" data-id="4" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dodger Blue"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-5" data-id="5" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tradewind"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-6" data-id="6" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cranberry"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-7" data-id="7" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Oslo Gray"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-8" data-id="8" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chetwode Blue"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-9" data-id="9" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Apricot"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-10" data-id="10" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Blue Smoke"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-11" data-id="11" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Green Smoke"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-12" data-id="12" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wild Blue Yonder"></a></li>
	                                    <li><a href="javascript:void(0)" onclick="fncTema(this)" id="myapp-13" data-id="13" data-action="theme-update" data-toggle="tooltip" data-placement="top" title="" data-original-title="Emerald"></a></li>
	                                </ul>
	                            </div>
	                            </div>
						    </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                </aside>
                
		  	<?}
		  	
		}
		
		public function getHeaderPopup(){
			
			/*
			<header class="page-header" role="banner">
				<a href="/index.do" class="logo">
			  		<span class="logo-mini"><b><?=$this->rSite->BASLIK?></b></span>
				</a>
            </header>
            */
            
		}
		
		public function getFooter(){			
			?>
			<footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700"> <?=$this->rSite->ALTYAZI?> </span>&nbsp;
                </div>
                <div class="float-right hidden-xs"> <span class="js-get-date"></span> | <b>Version</b> 2.0.0 </div>
            </footer>
		  	<?
		}
		
		public function getTemaCss(){
			if($this->rKullanici->TEMA_ID > 0){
				?>
				<link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png"/>
				<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.ico"/>
				<link id="mytheme" rel="stylesheet" href="../smartadmin/css/themes/cust-theme-<?=$this->rKullanici->TEMA_ID?>.css"/>
				<link rel="stylesheet" href="../smartadmin/plugin/1.css"/>
				<?
			}
		}
		
		public function getFontBoyut(){
			return $this->rKullanici->FONT_BOYUT_CLASS;
		}
		
		public function getBody(){
			return "mod-bg-1 nav-function-fixed";
		}
		
		public function getTema(){
			if(is_null($this->rKullanici->ID)){
				return "hold-transition fixed skin-yellow sidebar-collapse sidebar-collapse";
			} else {
				return "hold-transition fixed " . $this->rKullanici->TEMA . ($_COOKIE['menu']=="0" ? " sidebar-collapse" : ""); // sidebar-collapse sidebar-mini skin-green fixed layout-boxed control-sidebar-open	
			}			
		}
		
		public function getTextColor(){
			return "text-white";
			return $this->rKullanici->TEXT_COLOR;
			
		}
		
		public function getTemaArkaPlan(){
			return $this->rKullanici->ARKA_PLAN;
			
		}
		
	}
	
?>