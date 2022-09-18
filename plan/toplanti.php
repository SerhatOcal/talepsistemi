<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
	session_kontrol();
	$rows		= $cSubData->getToplantilar($_REQUEST);
?>
<!DOCTYPE html>
<html lang="tr" class="<?=$cBootstrap->getFontBoyut()?>">
<head>
    <meta charset="utf-8">
    <title> <?=$row_site->TITLE?> </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" media="screen, print" href="../smartadmin/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="../smartadmin/css/app.bundle.css">
    <link rel="stylesheet" media="screen, print" href="../smartadmin/css/fa-regular.css">
    <link rel="stylesheet" href="../smartadmin/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" href="../smartadmin/css/formplugins/select2/select2.bundle.css">
    <link rel="stylesheet" href="../smartadmin/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="../smartadmin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../smartadmin/plugin/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" media="screen, print" href="../smartadmin/css/datagrid/datatables/datatables.bundle.css">
    <?$cBootstrap->getTemaCss()?>
</head>
<body class="<?=$cBootstrap->getBody()?>">
    <div class="page-wrapper">
    <div class="page-inner">
    <?=$cBootstrap->getMenu();?>
    <div class="page-content-wrapper">
    <?=$cBootstrap->getHeader();?>
    <main id="js-page-content" role="main" class="page-content">
	  	<ol class="breadcrumb page-breadcrumb breadcrumb-seperator-1">
            <li class="breadcrumb-item"><a href="/"><?=dil("Kontrol Paneli")?></a></li>
            <li class="breadcrumb-item"><a href="/tanimlama/markalar.do?route=tanimlama/markalar"><?=dil("Markalar")?></a></li>
            <li class="breadcrumb-item active"><?=dil("Yapılan Görüşme / Toplantı")?></li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
        </ol>
        
	  	<section class="content">
		    <div class="row">
		    	<div class="col-md-12">
					<div class="panel">
    				<div class="panel-hdr bg-primary-300 text-white">
                        <h2> <?=dil("Yapılan Görüşme / Toplantı")?> </h2>
                        <div class="panel-toolbar">
                            <a href="javascript:void(0)" class="btn btn-light btn-sm btn-icon mr-1 waves-effect waves-themed" title="Araç Ekle" data-toggle="modal" data-target="#modalToplantiEkle"> <i class="far fa-plus"></i> </a>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
							<div class="table-responsive">
						  		<table class="table table-sm table-condensed table-hover datatable">
							  		<thead class="thead-themed fw-500">
								    	<tr class="bg-aqua-gradient">
								          	<td align="center">#</td>
								          	<td> <?=dil("Firma")?> </td>
								          	<td> <?=dil("Konu")?> </td>
								          	<td> <?=dil("Açıklama")?> </td>
								          	<td> <?=dil("Görüşülen Kişi")?> </td>
								          	<td> <?=dil("Görüşülen Kişi Tel")?> </td>
		                                    <td align="center"> <?=dil("Toplantı Tarih")?> </td>
		                                    <td align="center"> <?=dil("Kayıt Tarih")?> </td>
		                                    <td align="center"> <?=dil("Kayıt Eden")?> </td>
								          	<td class="no-sort"> </td>
								        </tr>
								    </thead>
								    <tbody>
								        <?foreach($rows as $key=>$row) {?>
									        <tr>
									          	<td align="center"><?=($key+1)?></td>
									          	<td><?=$row->FIRMA?></td>
									          	<td><?=$row->KONU?></td>
									          	<td><?=$row->ACIKLAMA?></td>
									          	<td><?=$row->GORUSULEN_KISI?></td>
									          	<td><?=$row->GORUSULEN_KISI_TEL?></td>									          	
		                                        <td align="center"><?=FormatTarih::tarih($row->TOPLANTI_TARIH)?></td>
		                                        <td align="center"><?=FormatTarih::tarih($row->TARIH)?></td>
									          	<td align="center"><?=$row->KAYIT_EDEN?></td>
									          	<td style="padding: 0px;" align="center"> 
									          		<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon" onclick="fncToplantiDuzenle(<?=$row->ID?>)" title="Toplanti Düzenle"> <i class="far fa-pencil text-green"></i> </a> 
									          	</td>
									        </tr>
								        <?}?>
							        </tbody>
							  	</table>
						  	</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</section>
		
    </main>    
    </div>
    </div>
    </div>
	
	<div class="modal fade" id="modalToplantiDuzenle" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary-300">
                    <h4 class="modal-title"> <?=dil("Toplanti Düzenle")?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formToplantiDuzenle">
	          			<input type="hidden" name="islem" id="islem" value="toplanti_kaydet">
	          			<input type="hidden" name="id" id="id" value="">
		          		<div class="row">
		          			<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Firma")?></label>
								  	<input type="text" class="form-control" placeholder="" name="firma" id="firma" maxlength="100">
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Konu")?></label>
								  	<input type="text" class="form-control" placeholder="" name="konu" id="konu" maxlength="255">
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Açıklama")?></label>
								  	<textarea class="form-control" name="aciklama" id="aciklama" rows="5"></textarea>
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Görüşülen Kişi")?></label>
								  	<input type="text" class="form-control" placeholder="" name="gorusulen_kisi" id="gorusulen_kisi" maxlength="100">
								</div>
							</div>
							<div class="col-md-6 mb-3">        
						        <div class="form-group">
								    <label class="form-label"><?=dil("Görüşülen Kişi Tel")?></label>
								    <div class="input-group">
								      	<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-phone"></i></span></div>
								      	<input type="text" class="form-control" name="gorusulen_kisi_tel" id="gorusulen_kisi_tel" data-inputmask='"mask": "(999) 999-9999"' data-mask value="">
								    </div>
								</div>
						    </div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
							        <label class="form-label"><?=dil("Toplanti Tarihi")?></label>
							        <div class="input-group date">
							          	<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
							          	<input type="text" class="form-control datepicker2 datepicker-inline" name="toplanti_tarih" value="<?=date("d.m.Y")?>" readonly>
							        </div>
							    </div>
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer">
	            	<button type="button" class="btn btn-primary waves-effect waves-themed" onclick="fncToplantiKaydet()"><?=dil("Kaydet")?></button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalToplantiEkle" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary-300">
                    <h4 class="modal-title"> <?=dil("Toplanti Ekle")?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formToplantiEkle">
	          			<input type="hidden" name="islem" id="islem" value="toplanti_ekle">
	          			<input type="hidden" name="id" id="id" value="">
		          		<div class="row">
		          			<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Firma")?></label>
								  	<input type="text" class="form-control" placeholder="" name="firma" id="firma" maxlength="100">
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Konu")?></label>
								  	<input type="text" class="form-control" placeholder="" name="konu" id="konu" maxlength="255">
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Açıklama")?></label>
								  	<textarea class="form-control" name="aciklama" id="aciklama" rows="5"></textarea>
								</div>
							</div>
							<div class="col-md-12 mb-3">
				            	<div class="form-group">
								  	<label><?=dil("Görüşülen Kişi")?></label>
								  	<input type="text" class="form-control" placeholder="" name="gorusulen_kisi" id="gorusulen_kisi" maxlength="100">
								</div>
							</div>
							<div class="col-md-6 mb-3">        
						        <div class="form-group">
								    <label class="form-label"><?=dil("Görüşülen Kişi Tel")?></label>
								    <div class="input-group">
								      	<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-phone"></i></span></div>
								      	<input type="text" class="form-control" name="gorusulen_kisi_tel" id="gorusulen_kisi_tel" data-inputmask='"mask": "(999) 999-9999"' data-mask value="">
								    </div>
								</div>
						    </div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
							        <label class="form-label"><?=dil("Toplanti Tarihi")?></label>
							        <div class="input-group date">
							          	<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
							          	<input type="text" class="form-control datepicker2 datepicker-inline" name="toplanti_tarih" value="<?=date("d.m.Y")?>" readonly>
							        </div>
							    </div>
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer">
	            	<button type="button" class="btn btn-primary waves-effect waves-themed" onclick="fncToplantiEkle()"><?=dil("Kaydet")?></button>
                </div>
            </div>
        </div>
    </div>
	
	<script src="../smartadmin/js/vendors.bundle.js"></script>
    <script src="../smartadmin/js/app.bundle.js"></script>
    <script src="../smartadmin/js/holder.js"></script>
    <script src="../smartadmin/js/formplugins/select2/select2.bundle.js"></script>
    <script src="../smartadmin/js/dependency/moment/moment.js"></script>
    <script src="../smartadmin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="../smartadmin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="../smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="../smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="../smartadmin/plugin/bootstrap-datepicker.tr.js"></script>
    <script src="../smartadmin/plugin/bootstrap-maxlength.js"></script>
    <script src="../smartadmin/plugin/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../smartadmin/plugin/jquery.lazy-master/jquery.lazy.min.js"></script>
    <script src="../smartadmin/plugin/input-mask/jquery.inputmask.js"></script>
	<script src="../smartadmin/plugin/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../smartadmin/plugin/input-mask/jquery.inputmask.numeric.extensions.js"></script>
	<script src="../smartadmin/plugin/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="../smartadmin/plugin/iCheck/icheck.min.js"></script>
	<script src="../smartadmin/plugin/countdown/jquery.countdown.min.js"></script>
    <script src="../smartadmin/plugin/1.js"></script>
	<script>
		
		$("[data-mask]").inputmask();
		
		$('.datatable').DataTable({
			columnDefs: [{ targets: 'no-sort', orderable: false }],
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
			order: [],
			paging: true,
			pageLength: 50,
			ordering: true
		});
	  	
		function fncToplantiDuzenle(id){
			$.ajax({
				url: '/class/db_kayit.do?',
				type: "POST",
				data: { "islem" : "toplanti_bilgisi", 'id' : id },
				dataType: 'json',
				async: true,
				success: function(jd) {
					if(jd.HATA){
						bootbox.alert(jd.ACIKLAMA, function() {});
					}else{
						//bootbox.alert(jd.ACIKLAMA, function() {});
						$("#modalToplantiDuzenle #id").val( jd.DATA.ID );
						$("#modalToplantiDuzenle #firma").val( jd.DATA.FIRMA );
						$("#modalToplantiDuzenle #konu").val( jd.DATA.KONU );
						$("#modalToplantiDuzenle #aciklama").val( jd.DATA.ACIKLAMA );
						$("#modalToplantiDuzenle #gorusulen_kisi").val( jd.DATA.GORUSULEN_KISI );
						$("#modalToplantiDuzenle #gorusulen_kisi_tel").val( jd.DATA.GORUSULEN_KISI_TEL );
						$("#modalToplantiDuzenle #toplanti_tarih").val( jd.DATA.TOPLANTI_TARIH );
						$("#modalToplantiDuzenle").modal("show");
					}
				}
			});
			
		}
		
		function fncToplantiKaydet(){
			$.ajax({
				url: '/class/db_kayit.do?',
				type: "POST",
				data: $('#formToplantiDuzenle').serialize(),
				dataType: 'json',
				async: true,
				success: function(jd) {
					if(jd.HATA){
						bootbox.alert(jd.ACIKLAMA, function() {});
					}else{
						bootbox.alert(jd.ACIKLAMA, function() {
							//$("#modalToplantiDuzenle").modal("hide");
							location.reload(true);
						});
					}
				}
			});
		}
		
		function fncToplantiEkle(){
			$.ajax({
				url: '/class/db_kayit.do?',
				type: "POST",
				data: $('#formToplantiEkle').serialize(),
				dataType: 'json',
				async: true,
				success: function(jd) {
					if(jd.HATA){
						bootbox.alert(jd.ACIKLAMA, function() {});
					}else{
						bootbox.alert(jd.ACIKLAMA, function() {
							//$("#modalToplantiEkle").modal("hide");
							location.reload();
						});
					}
				}
			});
		}
		
		function fncToplantiSil(id){
			bootbox.confirm("Silmek istediğinizden emin misiniz!", function(result){
				if(result){
					$.ajax({
						url: '/class/db_kayit.do?',
						type: "POST",
						data: { "islem": "model_sil", 'id': id },
						dataType: 'json',
						async: true,
						success: function(jd) {
							if(jd.HATA){
								bootbox.alert(jd.ACIKLAMA, function() {});
							}else{
								bootbox.alert(jd.ACIKLAMA, function() {
									location.reload(true);
								});
							}
						}
					});
				}
			});
			
		}
	</script>
	
</body>
</html>
