	
    /**
     *	This script should be placed right after the body tag for fast execution 
     *	Note: the script is written in pure javascript and does not depend on thirdparty library
     **/
    'use strict';
	
    var classHolder = document.getElementsByTagName("BODY")[0],
        /** 
         * Load from localstorage
         **/
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
        {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
    /** 
     * Load theme options
     **/
    if (themeSettings.themeOptions)
    {
        classHolder.className = themeSettings.themeOptions;
        //console.log("%c✔ Theme settings loaded", "color: #148f32");
    }
    else
    {
        //console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme'))
    {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);
    }
    /** 
     * Save to localstorage 
     **/
    var saveSettings = function()
    {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
        {
            return /^(nav|header|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme'))
        {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        };
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    }
    /** 
     * Reset settings
     **/
    var resetSettings = function()
    {
        localStorage.setItem("themeSettings", "");
    }

        
        
        
	$('.select2').select2();
	
	function fsubmit(form,sayfa,siralama){
		$(form+" #sayfa").val(sayfa);
		$("#"+form).submit();
	}

	function fncFiltrele(){
		$("#form").submit();
	}

	$(".formara").on('keyup', function (e) {
	    if (e.keyCode == 13) {
	        $("form").submit();
	    }
	});
		
	function fncPopup(url, title, w, h) {
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    if (window.focus) {
	        newWindow.focus();
	    }
	}

	function fncAlertKapat(){
		$('.alert-bildiri').fadeOut(700);
	}
		
	function fncLinkSil(obj){
		$.ajax({
			url: '/class/db_kayit.do?',
			type: "POST",
			data: { "islem" : "link_sil", 'id' : $(obj).data("id") },
			dataType: 'json',
			async: true,
			success: function(jd) {
				if(jd.HATA){
					bootbox.alert(jd.ACIKLAMA, function() {});
				}else{
					bootbox.alert(jd.ACIKLAMA, function() {
						$(obj).hide();
					});
				}
				
			}
		});
	}
	
	function fncCookiesMenu(menu){
		$.cookie('menu', ($.cookie('menu') == 1 ? 0 : 1));
	}
	
	function fncDil(dil){
		$.cookie('dil', dil);
		location.reload(true);
	}	

		
	$(".select2").select2();
	bootbox.setLocale('tr');
	$('[data-toggle="popover"]').popover();
	
	$('.maxlength').maxlength({
	    alwaysShow: true,
	    threshold: 10,
	    warningClass: "label label-success",
	    limitReachedClass: "label label-danger"
	});
	
	$(".timepicker").timepicker({
		showInputs: false,
		showMeridian: false
	});
	
	$('.datepicker').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-1y',
	  	endDate: '+1y',
	  	minDate: 0,
	  	language: 'tr',
	  	autoclose: true,
	  	todayHighlight: true,
	  	clearBtn: true,
        orientation: "bottom left",
        weekStart: 1
	  	
	});
	
	$('.datepicker2').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '0d',
	  	endDate: '+1y',
	  	minDate: 0,
	  	language: 'tr',
	  	autoclose: true,
	  	todayHighlight: true,
	  	clearBtn: true,
        orientation: "bottom left",
        weekStart: 1
	  	
	});		
	
	$('.datepicker3').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-3d',
	  	endDate: '+3d',
	  	minDate: 0,
	  	language: 'tr',
	  	autoclose: true,
	  	todayHighlight: true,
	  	clearBtn: true,
        orientation: "bottom left",
        weekStart: 1
	  	
	});	
	
	$('.datepicke4').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-3y',
	  	endDate: '+3y',
	  	minDate: 0,
	  	language: 'tr',
	  	autoclose: true,
	  	todayHighlight: true,
	  	clearBtn: true,
        orientation: "bottom left",
        weekStart: 1
	  	
	});
	
	$('.datepicke5').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-20y',
	  	endDate: '+20y',
	  	minDate: 0,
	  	language: 'tr',
	  	autoclose: true,
	  	todayHighlight: true,
	  	clearBtn: true,
        orientation: "bottom left",
        weekStart: 1
	  	
	});
	
	$('.daterangepicker').daterangepicker({
		timePicker: false,
		timePicker24Hour: true,
		timePickerIncrement: 30, 
		locale: {
	        "format": "DD-MM-YYYY",
	        "separator": " , ",
	        "applyLabel": "Tamam",
	        "cancelLabel": "İptal",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "weekLabel": "W",
	        "daysOfWeek": [
	            "Pa",
	            "Pz",
	            "Sa",
	            "Ça",
	            "Pe",
	            "Cu",
	            "Ct"
	        ],
	        "monthNames": [
	            "Ocak",
	            "Şubat",
	            "Mart",
	            "Nisan",
	            "Mayıs",
	            "Haziran",
	            "Temmuz",
	            "Ağustos",
	            "Eylül",
	            "Ekim",
	            "Kasım",
	            "Aralık"
	        ],
	        "firstDay": 1
	    },
	});
	
	function fncTema(obj){
		$.ajax({
			url: '/class/db_kayit.do?',
			type: "POST",
			data: { "islem" : "hesabim_tema_secimi", 'tema_id': $(obj).data("id") },
			dataType: 'json',
			async: true,
			success: function(jd) {
				if(jd.HATA){
					bootbox.alert(jd.ACIKLAMA, function() {});
				}else{
					location.reload(true);
				}
			}
		});			
	}
	
	String.prototype.turkishToUpper = function(){
		var string = this;
		var letters = { "i": "İ", "ş": "Ş", "ğ": "Ğ", "ü": "Ü", "ö": "Ö", "ç": "Ç", "ı": "I" };
		string = string.replace(/(([iışğüçö]))/g, function(letter){ return letters[letter]; })
		return string.toUpperCase();
	}

	String.prototype.turkishToLower = function(){
		var string = this;
		var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
		string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
		return string.toLowerCase();
	}
	
	String.prototype.plakaToUpper = function(){
		var string = this;
		var letters = { "i": "I", "ş": "S", "ğ": "G", "ü": "U", "ö": "O", "ç": "C", "ı": "I" };
		string = string.replace(/(([iışğüçö]))/g, function(letter){ return letters[letter]; })
		return string.toUpperCase();
	}

	String.prototype.plakaToLower = function(){
		var string = this;
		var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
		string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
		return string.toLowerCase();
	}