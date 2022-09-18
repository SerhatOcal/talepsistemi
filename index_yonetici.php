<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
	session_kontrol();
?>
<!DOCTYPE html>
<html lang="tr" data-lang="tr" class="<?=$cBootstrap->getFontBoyut()?>">
<head>
    <meta charset="utf-8">
    <title> <?=$row_site->TITLE?> <?=dil("Kontrol Paneli")?> </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" media="screen, print" href="/smartadmin/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/smartadmin/css/app.bundle.css">
    <link rel="stylesheet" href="/smartadmin/css/fa-regular.css">
    <link rel="stylesheet" href="/smartadmin/css/fa-solid.css">
    <link rel="stylesheet" href="/smartadmin/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" href="/smartadmin/css/formplugins/select2/select2.bundle.css">
    <link rel="stylesheet" href="/smartadmin/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="/smartadmin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/smartadmin/plugin/timepicker/bootstrap-timepicker.min.css">
    <?$cBootstrap->getTemaCss()?>
</head>
<body class="<?=$cBootstrap->getBody()?>">
    <div class="page-wrapper">
    <div class="page-inner">
    <?=$cBootstrap->getMenu();?>
    <div class="page-content-wrapper">                    
    <?=$cBootstrap->getHeader();?>
    <main id="js-page-content" role="main" class="page-content">
    
        <div class="subheader">
            <h1 class="subheader-title">
             	<?=dil("Kontrol Paneli")?>
             	<small><?=$row_site->BASLIK?> <?=dil("Yönetim Platformu")?></small>
            </h1>
        </div>
       
        <div class="row">
        	<div class="col-md-12">
        		<div class="row">
        			<div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/talep/talep_takip.do?route=talep/talep_takip&q=Yeni Talep" class="text-white"> <?=(int)$rows_surec[1]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Yeni Talep Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/talep/talep_takip.do?route=talep/talep_takip&q=Onay Bekleyen" class="text-white"> <?=(int)$rows_surec[2]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Onay Bekleyen Talep Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/talep/talep_takip.do?route=talep/talep_takip&q=Açık Talep" class="text-white"> <?=(int)$rows_surec[3]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Açık Talep Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/talep/talep_takip.do?route=talep/talep_takip&q=Kontrol Bekleyen" class="text-white"> <?=(int)$rows_surec[5]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Kontrol Bekleyen")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/talep/talep_listesi.do?route=talep/talep_listesi&surec_id=10&filtre=1" class="text-white"> <?=(int)$rows_surec[10]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Kapalı Talep")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-lock-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>			        
		        </div>
		        
		        <div class="row">
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/toplanti/toplanti_takip.do?route=toplanti/toplanti_takip&q=Hazırlanıyor" class="text-white"> <?=(int)$rows_toplanti_surec[1]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Toplantı Hazırlanıyor Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/toplanti/toplanti_takip.do?route=toplanti/toplanti_takip&q=Toplantı Bekliyor" class="text-white"> <?=(int)$rows_toplanti_surec[3]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Bekleyen Toplantı Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/toplanti/toplanti_takip.do?route=toplanti/toplanti_takip&q=Yapılıyor" class="text-white"> <?=(int)$rows_toplanti_surec[4]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Toplantı Yapılıyor Sayısı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/toplanti/toplanti_takip.do?route=toplanti/toplanti_takip&q=Kontrol Ediliyor" class="text-white"> <?=(int)$rows_toplanti_surec[5]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Toplantı Kontrol Bekleyen")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-keyboard position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>
			        <div class="col-sm-3 col-xl-3">
			            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
			                <div class="">
			                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
			                        <a href="/toplanti/toplanti_listesi.do?route=toplanti/toplanti_listesi&surec_id=10&filtre=1" class="text-white"> <?=(int)$rows_toplanti_surec[10]->TOPLAM?> </a>
			                        <small class="m-0 l-h-n"><?=dil("Kapalı Toplantı")?></small>
			                    </h3>
			                </div>
			                <i class="fal fa-lock-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1 p-3" style="font-size:5rem"></i>
			            </div>
			        </div>			        
		        </div>
			</div>
			<div class="col-md-3">
				<div class="row">
					
				</div>
			</div>
        </div>
        
    </main> 
    <?=$cBootstrap->getFooter()?>
    </div>
    </div>
    </div>
            
    <script src="/smartadmin/js/vendors.bundle.js"></script>
    <script src="/smartadmin/js/app.bundle.js"></script>
    <script src="/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/smartadmin/js/dependency/moment/moment.js"></script>
    <script src="/smartadmin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>    
    <script src="/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/smartadmin/plugin/bootstrap-datepicker.tr.js"></script>
    <script src="/smartadmin/plugin/bootstrap-maxlength.js"></script>
    <script src="/smartadmin/plugin/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/smartadmin/plugin/jquery.lazy-master/jquery.lazy.min.js"></script>
    <script src="/smartadmin/plugin/input-mask/jquery.inputmask.js"></script>
	<script src="/smartadmin/plugin/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="/smartadmin/plugin/input-mask/jquery.inputmask.numeric.extensions.js"></script>
	<script src="/smartadmin/plugin/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="/smartadmin/plugin/countdown/jquery.countdown.min.js"></script>
    <script src="/smartadmin/js/i18n/i18n.js"></script>
    <script src="/smartadmin/plugin/1.js"></script>
    <script type="text/javascript">
        $('#js-page-content').smartPanel();
    </script>
        
</body>
</html>
