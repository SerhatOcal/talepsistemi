<?
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/function.php');	
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <title> <?=$row_site->TITLE?> </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/app.bundle.css">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">        
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="smartadmin/css/miscellaneous/lightgallery/lightgallery.bundle.css">
    </head>
    <body class="mod-bg-1">
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient bg-primary-300">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4 bg-white">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="/" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="<?=$row_site->LOGO?>" alt="<?=$row_site->LOGO?>" style="height: 65px" aria-roledescription="logo">
                                </a>
                            </div>
                            <a href="/giris.do" class="ml-auto btn btn-warning fw-500" style="width: 150px;"> <?=dil2("Giriş")?> </a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                        "<?=dil2("Şifreni mi unuttun")?>"
                                        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                            <?=dil2("Problem yok, sıfırlama maili gönderebilirim!")?>
                                        </small>
                                    </h2>
                                </div>
                                <div class="col-xl-6 ml-auto mr-auto">
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <form id="formSifremiUnuttum" name="formSifremiUnuttum" novalidate="">
                                            <div class="form-group">
                                                <label class="form-label" for="lostaccount"><?=dil2("Kullanıcı Adı")?></label>
                                                <input type="text" id="lostaccount" class="form-control" placeholder="" required>
                                                <div class="invalid-feedback"><?=dil("Girmelisiniz!")?>.</div>
                                                <div class="help-block"><?=dil2("Kullanıcı adı giriniz!")?></div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-md-4 ml-auto text-right">
                                                    <button id="js-login-btn" type="button" class="btn btn-danger"><?=dil2("Sıfırla")?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-block text-center text-white">
                            2020 © <?=FormatYazi::buyult($row_site->BASLIK)?> &nbsp;<a href='<?=$row_site->URL?>' class='text-white opacity-40 fw-500' title='gotbootstrap.com' target='_blank'><?=$row_site->URL?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="smartadmin/js/vendors.bundle.js"></script>
        <script src="smartadmin/js/app.bundle.js"></script>
        <script src="smartadmin/js/miscellaneous/lightgallery/lightgallery.bundle.js"></script>
        <script>
            $("#js-login-btn").click(function(event) {
                var form = $("#formSifremiUnuttum")
                if (form[0].checkValidity() === false) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.addClass('was-validated');
                
                $.ajax({
					url: '/giris_kontrol.do?',
					type: "POST",
					data: $('#formSifremiUnuttum').serialize(),
					dataType: 'json',
					async: true,
					success: function(jd) {
						if(jd.HATA){
							bootbox.alert(jd.ACIKLAMA, function() {
								$("#btnGiris").attr("disabled", false);
								$("#loadGiris").hide();
							});
						}else{
							window.location.href = jd.URL;
						}
					}
				});
            });
        </script>
    </body>
</html>
