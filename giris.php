<?
	@session_start();
	@session_unset();
	@session_destroy();
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <title> Yönetim Paneli</title>
        <meta name="description" content="Giriş Ekranı">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/app.bundle.css">
        <link rel="apple-touch-icon" sizes="180x180" href="">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">        
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" href="/smartadmin/css/themes/cust-theme-12.css"/>
		<link rel="stylesheet" href="/smartadmin/plugin/1.css"/>	
    </head>
    <body class="mod-bg-1">
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="flex-1 px-4" style="background: url(smartadmin/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    	<div class="d-flex align-items-center container p-0 mt-3 border-bottom">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="/" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="" alt="" style="height: 65px" aria-roledescription="logo">
                                </a>
                            </div>                            
                            <a href="sifremi_unuttum.do" class="btn bg-warning fw-500 ml-auto"> <?=dil2("Şifremi Unuttum")?> </a>
                        </div>
                        <div class="container py-3 py-lg-5 my-lg-2 px-3 px-sm-0">
                            <div class="row">
                                <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white">
                                        <br>
                                        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                        </small>
                                        <br>
                                    </h2>
                                    <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                        <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                           	<?=dil2("Bizi takip edebilirsiniz")?>
                                        </div>
                                        <div class="d-flex flex-row opacity-70">
                                            <a href="/" class="mr-2 fs-xxl text-white"> <i class="fab fa-facebook-square"></i> </a>
                                            <a href="/" class="mr-2 fs-xxl text-white"> <i class="fab fa-twitter-square"></i> </a>
                                            <a href="/" class="mr-2 fs-xxl text-white"> <i class="fab fa-linkedin"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 ml-auto">
                                    <div class="card p-3 rounded-plus bg-faded">
                                        <form id="girisForm" novalidate="" action="">
                                        	<input type="hidden" name="sayfa_url" value="<?=$_REQUEST['sayfa_url']?>">
                                        	<div class="form-group text-center">
	  											<img src="/img/user_vatar512.png" width="150px" height="150px">
                                        	</div>
                                            <div class="form-group text-center">
                                            	<div class="input-group bg-white shadow-inset-2">
                                                    <div class="input-group-prepend"><span class="input-group-text bg-transparent border-right-0"><i class="fal fa-user"></i></span></div>
                                                    <input type="text" id="kullanici" name="kullanici" class="form-control form-control-md border-left-0 bg-transparent pl-0" placeholder="<?=dil2("Kullanıcı Adı")?>" value="<?=$_COOKIE['0205kullanici']?>" required>
                                                	<div class="invalid-feedback"><?=dil2("Kullanıcı adı giriniz!")?></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="input-group bg-white shadow-inset-2">	
                                                	<div class="input-group-prepend" onclick="fncSifreGoster()"><span class="input-group-text bg-transparent border-right-0"><i class="fal fa-key"></i></span></div>
	                                                <input type="password" id="sifre" name="sifre" class="form-control form-control-md border-left-0 bg-transparent pl-0" placeholder="<?=dil2("Şifre")?>" required>
	                                                <div class="invalid-feedback"><?=dil2("Kullanıcı şifrenizi giriniz!")?></div>
	                                            </div>
                                            </div>
                                            <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="hatirla">
                                                    <label class="custom-control-label" for="hatirla"><?=dil2("Hatırla")?></label>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-12  text-center">
                                                	<i id="loadGiris" class="spinner-grow" style="display: none;"></i>
                                                    <button id="btnGiris" type="button" class="btn bg-warning btn-block fw-500"> <?=dil2("Giriş")?> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                                2020 © &nbsp;<a href='' class='text-white opacity-40 fw-500' title='' target='_blank'></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="smartadmin/js/vendors.bundle.js"></script>
        <script src="smartadmin/js/app.bundle.js"></script>
        <script src="smartadmin/js/miscellaneous/lightgallery/lightgallery.bundle.js"></script>
        <script>
            $("#btnGiris").click(function(event) {
                var form = $("#girisForm");
				
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.addClass('was-validated');
                    return false;
                }
                
                if($("#btnGiris").prop("disabled")) return true;
	  		
				$("#btnGiris").attr("disabled", true);	
				$("#loadGiris").show();	
				$.ajax({
					url: '/giris_kontrol.do?',
					type: "POST",
					data: $('#girisForm').serialize(),
					dataType: 'json',
					async: true,
					success: function(res) {
						if(res.HATA){
							bootbox.alert(res.ACIKLAMA, function() {
								$("#btnGiris").attr("disabled", false);
								$("#loadGiris").hide();
							});
						}else{
							window.location.href = res.URL;
						}
					}
				});
            });
            
            function fncSifreGoster(){
				$("#sifre").attr("type", ($("#sifre").attr("type") == 'text') ? 'password' : 'text');
			}
        
			
			$('#sifre, #kullanici, #hatirla').keypress(function(e) {
                console.log(e.which);false;
		  		if (e.which == '13') {
			     	$("#btnGiris").trigger("click");
			   	}
			});
        </script>
    </body>
</html>
