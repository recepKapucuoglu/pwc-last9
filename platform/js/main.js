/*

	Template Name: Exhibit - Conference & Event HTML Template
	Author: Themewinter
	Author URI: https://themeforest.net/user/themewinter
	Description: Exhibit - Conference & Event HTML Template
	Version: 1.0
   =====================
   table of content 
   ====================
   1.   menu toogle
   2.   event counter
   3.   funfact
   4.   isotope grid
   5.   main slider
   6.   speaker popup
   7.   gallery
   8.   video popup
   9.   hero area image animation
   10.  wow animated
   11.  back to top
  
*/


jQuery(function ($) {



   /**-------------------------------------------------
    *Fixed HEader
    *----------------------------------------------------**/
   $(window).on('scroll', function () {

      /**Fixed header**/
      if ($(window).scrollTop() > 250) {
         $('.header').addClass('sticky fade_down_effect');
      } else {
         $('.header').removeClass('sticky fade_down_effect');
      }
   });

   /* ---------------------------------------------
                     Menu Toggle 
   ------------------------------------------------ */

   if ($(window).width() < 991) {
      $(".navbar-nav li a").on("click", function () {
         $(this).parent("li").find(".dropdown-menu").slideToggle();
         $(this).find("i").toggleClass("fa-angle-up fa-angle-down");
      });

   }


   /* ----------------------------------------------------------- */
   /*  Event counter 
   /* -----------------------------------------------------------*/

   if ($('.countdown').length > 0) {
      $(".countdown").jCounter({
         date: '18 December 2019 08:30:00',
         fallback: function () {
            console.log("count finished!")
         }
      });
   }


   /*==========================================================
     funfact 
     ======================================================================*/
   var skl = true;
   $('.ts-funfact').appear();

   $('.ts-funfact').on('appear', function () {
      if (skl) {
         $('.counterUp').each(function () {
            var $this = $(this);
            jQuery({
               Counter: 0
            }).animate({
               Counter: $this.attr('data-counter')
            }, {
               duration: 8000,
               easing: 'swing',
               step: function () {
                  var num = Math.ceil(this.Counter).toString();
                  if (Number(num) > 99999) {
                     while (/(\d+)(\d{3})/.test(num)) {
                        num = num.replace(/(\d+)(\d{3})/, '');
                     }
                  }
                  $this.html(num);
               }
            });
         });
         skl = false;
      }
   });

   /*=====================
    isotop grid
    ========================*/

   if ($('.grid').length > 0) {
      var $portfolioGrid = $('.grid'),
         colWidth = function () {
            var w = $portfolioGrid.width(),
               columnNum = 1,
               columnWidth = 0;
            if (w > 1200) {
               columnNum = 3;
            } else if (w > 900) {
               columnNum = 3;
            } else if (w > 600) {
               columnNum = 2;
            } else if (w > 450) {
               columnNum = 2;
            } else if (w > 385) {
               columnNum = 1;
            }
            columnWidth = Math.floor(w / columnNum);
            $portfolioGrid.find('.grid-item').each(function () {
               var $item = $(this),
                  multiplier_w = $item.attr('class').match(/grid-item-w(\d)/),
                  multiplier_h = $item.attr('class').match(/grid-item-h(\d)/),
                  width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth,
                  height = multiplier_h ? columnWidth * multiplier_h[1] * 0.4 - 12 : columnWidth * 0.3;
               $item.css({
                  width: width,
                  //height: height
               });
            });
            return columnWidth;
         },

         isotope = function () {
            $portfolioGrid.isotope({
               resizable: true,
               itemSelector: '.grid-item',
               masonry: {
                  columnWidth: colWidth(),
                  gutterWidth: 3
               }
            });
         };
      isotope();
      $(window).resize(isotope);
   } // End is_exists



   /*==========================================================
          main slider
  ======================================================================*/
   if ($('.main-slider').length > 0) {
      var bannerSlider = $(".main-slider");
      bannerSlider.owlCarousel({
         items: 1,
         mouseDrag: false,
         loop: false,
         touchDrag: false,
         autoplay:false,
         dots: false,
         autoplayTimeout: 5000,
         animateOut: 'fadeOut',
         autoplayHoverPause: true,
         smartSpeed: 250,

      });
   }

   /*=============================================================
			 speaker popup
	=========================================================================*/

   $('.ts-image-popup').magnificPopup({
      type: 'inline',
      closeOnContentClick: false,
      midClick: true,
	  preloader: false,
      callbacks: {
         beforeOpen: function () {
            this.st.mainClass = this.st.el.attr('data-effect');
         }
      },
      zoom: {
         enabled: true,
         duration: 500, // don't foget to change the duration also in CSS
      },
      mainClass: 'mfp-fade',
   });

   /*=============================================================
   			gallery
   	=========================================================================*/

   $('.ts-popup').magnificPopup({
      type: 'image',
      closeOnContentClick: false,
      midClick: true,
      callbacks: {
         beforeOpen: function () {
            this.st.mainClass = this.st.el.attr('data-effect');
         }
      },
      zoom: {
         enabled: true,
         duration: 500, // don't foget to change the duration also in CSS
      },
      mainClass: 'mfp-fade',
   });

   /*=============================================================
   			video popup
   	=========================================================================*/

   $('.ts-video-popup').magnificPopup({
      type: 'iframe',
      closeOnContentClick: false,
      midClick: true,
      callbacks: {
         beforeOpen: function () {
            this.st.mainClass = this.st.el.attr('data-effect');
         }
      },
      zoom: {
         enabled: true,
         duration: 500, // don't foget to change the duration also in CSS
      },
      mainClass: 'mfp-fade',
   });

   /*=============================================================
   			hero image animation
   	=========================================================================*/
   $('.tile')
      // tile mouse actions
      .on('mouseover', function () {
         $(this).children('.photo').css({
            'transform': 'scale(' + $(this).attr('data-scale') + ')'
         });
      })
      .on('mouseout', function () {
         $(this).children('.photo').css({
            'transform': 'scale(1)'
         });
      })
      .on('mousemove', function (e) {
         $(this).children('.photo').css({
            'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
         });
      })
      // tiles set up
      .each(function () {
         $(this)
            // add a photo container
            .append('<div class="photo"></div>')
            // some text just to show zoom level on current item in this example
            //.append('<div class="txt"><div class="x">'+ $(this).attr('data-scale') +'x</div>ZOOM ON<br>HOVER</div>')
            // set up a background image for each tile based on data-image attribute
            .children('.photo').css({
               'background-image': 'url(' + $(this).attr('data-image') + ')'
            });
      });

   /*==========================================================
   wow animated
    ======================================================================*/
   var wow = new WOW({
      animateClass: 'animated',
      mobile: false
   });
   wow.init();


   /* ----------------------------------------------------------- */
   /*  Back to top
   /* ----------------------------------------------------------- */

   $(window).on('scroll', function () {
      if ($(window).scrollTop() > $(window).height()) {
         $(".BackTo").fadeIn('slow');
      } else {
         $(".BackTo").fadeOut('slow');
      }

   });
   $("body, html").on("click", ".BackTo", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#kayit-formu').offset().top
      }, 800);
   });
   
   
   $("body, html").on("click", ".kayit-formu", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#kayit-formu').offset().top
      }, 800);
   });
   
   $("body, html").on("click", ".workshop", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#workshop').offset().top
      }, 800);
   });
   
   $("body, html").on("click", ".program", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#program').offset().top
      }, 800);
   });
   
   
   
   $("body, html").on("click", ".hakkinda", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#hakkinda').offset().top
      }, 800);
   });
   
   $("body, html").on("click", ".iletisim", function (e) {
      e.preventDefault();
      $('html, body').animate({
         scrollTop: $('#iletisim').offset().top
      }, 800);
   });


   
   // scrollme.init();
   
});

//SocialThinks
function mailKontrol(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

/*
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
// Install input filters.

setInputFilter(document.getElementsByClassName("telefon"), function(value) { return /^-?\d*$/.test(value); });
setInputFilter(document.getElementsByClassName("gsm"), function(value) { return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("tc_no"), function(value) { return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("vergi_no"), function(value) { return /^-?\d*$/.test(value); });
*/
/*  // Install input filters.
setInputFilter(document.getElementById("uintTextBox"), function(value) {
  return /^\d*$/.test(value); });
setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); });
setInputFilter(document.getElementById("intTextBox"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("floatTextBox"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); });
setInputFilter(document.getElementById("currencyTextBox"), function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value); });
setInputFilter(document.getElementById("basicLatinTextBox"), function(value) {
  return /^[a-z]*$/i.test(value); });
setInputFilter(document.getElementById("extendedLatinTextBox"), function(value) {
  return /^[a-z\u00c0-\u024f]*$/i.test(value); });
setInputFilter(document.getElementById("hexTextBox"), function(value) {
  return /^[0-9a-f]*$/i.test(value); });
  */

function form_gonder()
{
	var query = $('#contact-form').serialize();
	var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
	var message = "";
	
	var gsm_check = $('#gsm').val();
	var gsmLength = gsm_check.length;
	var email = $('#email').val();
	// Katılımcı Kontrol
	if($('#adsoyad').val() == ""){ message = message + "* Ad Soyad giriniz.<br/>"; $('#adsoyad').focus(); }
	if($('#unvan').val() == ""){ message = message + "* Unvan giriniz.<br/>"; $('#unvan').focus(); }
	if($('#firma_adi').val() == ""){ message = message + "* Firma adı giriniz.<br/>"; $('#firma_adi').focus(); }
	if($('#gsm').val() == ""){ message = message + "* Cep telefonu numarası giriniz.<br/>"; $('#gsm').focus(); } else if(gsmLength<11){ message = message + "* Cep telefonu numarası eksiksiz giriniz.<br/>"; $('#gsm').focus(); }
	if($('#email').val() == ""){ message = message + "* E-mail adresi giriniz.<br/>"; $('#email').focus(); }else if (!mailKontrol(email)) { message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>"; $('#email').focus(); }
	
	
	
	
	// Workshop Kontrol
	var workshop1 = document.getElementsByName('workshop_1');  
	var workshopSec1 = "";
	for(i = 0; i < workshop1.length; i++) { 
		if(workshop1[i].checked) 
		 workshopSec1 = workshop1[i].value;
	} 
	if(workshopSec1 == ""){ message = message + "* Katılımcı için 09:00 - 09:45 workshop seçimi yapınız.<br/>"; }
	
	var workshop2 = document.getElementsByName('workshop_2');  
	var workshopSec2 = "";
	for(i = 0; i < workshop2.length; i++) { 
		if(workshop2[i].checked) 
		 workshopSec2 = workshop2[i].value;
	} 
	if(workshopSec2 == ""){ message = message + "* Katılımcı için 12:00 - 12:45 workshop seçimi yapınız.<br/>"; }
	
	var workshop3 = document.getElementsByName('workshop_3');  
	var workshopSec3 = "";
	for(i = 0; i < workshop3.length; i++) { 
		if(workshop3[i].checked) 
		 workshopSec3 = workshop3[i].value;
	} 
	if(workshopSec3 == ""){ message = message + "* Katılımcı için 15:45 - 16:30 workshop seçimi yapınız.<br/>"; }
	
	var alumnisValue = document.getElementsByName('alumni');  
	for(i = 0; i < alumnisValue.length; i++) { 
		if(alumnisValue[i].checked) 
			var alumnisValueResult = alumnisValue[i].value;
	} 
	if(alumnisValueResult!=1 && alumnisValueResult!=2){
		message = message + "* Katılımcı için eski PwC çalışan seçeneğini belirtiniz.<br/>";
	}else if(alumnisValueResult==1){
		if($('#alumni_yil').val() == ""){ message = message + "* Katılımcı için PwC'den ayrılma yılını giriniz.<br/>"; $('#alumni_yil').focus(); }
	}
	
	if($('#adet').val() > 1){
		
		var toplam_katilim = $('#adet').val();
		// Katılımcı Döngüsü
		for(katilim_dongu = 2; katilim_dongu <= toplam_katilim; katilim_dongu++) {
			
			var gsm_check = $('#gsm_'+katilim_dongu).val();
			var gsmLength = gsm_check.length;
			var email = $('#email_'+katilim_dongu).val();
			
			// Çoklu Katılımcı Kontrol
			if($('#adsoyad_'+katilim_dongu).val() == ""){ message = message + "* " + katilim_dongu + ". Katılımcı Ad Soyad giriniz.<br/>"; }
			if($('#unvan_'+katilim_dongu).val() == ""){ message = message + "* " + katilim_dongu + ". Katılımcı Unvan giriniz.<br/>"; }
			if($('#firma_adi_'+katilim_dongu).val() == ""){ message = message + "* " + katilim_dongu + ". Firma adı giriniz.<br/>"; }
			if($('#gsm_'+katilim_dongu).val() == ""){ message = message + "* " + katilim_dongu + ". Katılımcı Cep telefonu numarası giriniz.<br/>";  } else if(gsmLength<11){ message = message + "* " + katilim_dongu + ". Katılımcı Cep telefonu numarası eksiksiz giriniz.<br/>";  }
			if($('#email_'+katilim_dongu).val() == ""){ message = message + "* " + katilim_dongu + ". Katılımcı E-mail adresi giriniz.<br/>"; }else if (!mailKontrol(email)) { message = message + "* " + katilim_dongu + ". Katılımcı için geçerli bir E-mail adresi giriniz.<br/>"; }
			
			
			
			// Çoklu Workshop Kontrol
			var workshop1 = document.getElementsByClassName('workshop_1_'+katilim_dongu);  
			var workshopSec1 = "";
			for(i = 0; i < workshop1.length; i++) { 
				if(workshop1[i].checked) 
				 workshopSec1 = workshop1[i].value;
			} 
			if(workshopSec1 == ""){ message = message + "* " + katilim_dongu + ". Katılımcı için 09:00 - 09:45 workshop seçimi yapınız.<br/>"; }
			
			var workshop2 = document.getElementsByClassName('workshop_2_'+katilim_dongu);  
			var workshopSec2 = "";
			for(i = 0; i < workshop2.length; i++) { 
				if(workshop2[i].checked) 
				 workshopSec2 = workshop2[i].value;
			} 
			if(workshopSec2 == ""){ message = message + "* " + katilim_dongu + ". Katılımcı için 12:00 - 12:45 workshop seçimi yapınız.<br/>"; }
			
			var workshop3 = document.getElementsByClassName('workshop_3_'+katilim_dongu);  
			var workshopSec3 = "";
			for(i = 0; i < workshop3.length; i++) { 
				if(workshop3[i].checked) 
				 workshopSec3 = workshop3[i].value;
			} 
			if(workshopSec3 == ""){ message = message + "* " + katilim_dongu + ". Katılımcı için 15:45 - 16:30 workshop seçimi yapınız.<br/>"; }
			
			
			
			var alumnisValue = document.getElementsByClassName('katilimci_alumni_'+katilim_dongu); 
			var alumnisValueResult = "";		
			for(i = 0; i < alumnisValue.length; i++) { 
				if(alumnisValue[i].checked) 
					alumnisValueResult = alumnisValue[i].value;
			} 
			if(alumnisValueResult!=1 && alumnisValueResult!=2){
				message = message + "* " + katilim_dongu + ". Katılımcı için eski PwC çalışan seçeneğini belirtiniz.<br/>";
			}else if(alumnisValueResult==1){
				if($('#katilimci_alumni_yil_'+katilim_dongu).val() == ""){ message = message+ "* " + katilim_dongu + ". Katılımcı için PwC'den ayrılma yılını giriniz.<br/>"; }
			}
			
			
			
			
		}
		
	}
	
	
	
	// Fatura bilgileri kontrol
	var faturaValue = document.getElementsByName('fatura-turu');  
	for(i = 0; i < faturaValue.length; i++) { 
		if(faturaValue[i].checked) 
			var radioValue = faturaValue[i].value;
	} 
	if(radioValue==1){
		var tc_check = $('#tc_no').val();
		var tcLength = tc_check.length;
		if($('#fatura_adsoyad').val() == ""){ message = message + "* Fatura adı giriniz.<br/>"; $('#fatura_adsoyad').focus(); }
		if($('#tc_no').val() == ""){ message = message + "* T.C. kimlik numarası giriniz.<br/>"; $('#tc_no').focus();  } else if(tcLength<11){ message = message + "* T.C. kimlik numarasını eksiksiz giriniz.<br/>"; $('#tc_no').focus(); }
	} else {
		var vergi_check = $('#vergi_no').val();
		var vergiLength = vergi_check.length;
		if($('#firma_unvani').val() == ""){ message = message + "* Fatura firma ünvanı giriniz.<br/>"; $('#firma_unvani').focus(); }
		if($('#vergi_dairesi').val() == ""){ message = message + "* Vergi dairesi giriniz.<br/>"; $('#vergi_dairesi').focus(); }
		if($('#vergi_no').val() == ""){ message = message + "* Vergi numarası giriniz.<br/>"; $('#vergi_no').focus(); } else if(vergiLength<10){ message = message + "* Vergi numarasını eksiksiz giriniz.<br/>"; $('#vergi_no').focus(); }
	}
	if($('#adres').val() == ""){ message = message + "* Fatura adresi giriniz.<br/>"; $('#adres').focus(); }
	
	
	if(message != ""){
		$('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>" + header + message + "</div>");
		$("html, body").animate({ scrollTop: $('#kayit-formu').offset().top }, 800);
	} else {
		
		
		$.ajax({
			type	 : 'POST',
			url		 : 'dosyalar/dahili/form_send.php', 
			data	 : query,
			success	 : function(cevap)
			{  
				$('.formMessage').html(cevap);
				
			}
		}).done(function() {
			$("html, body").animate({ scrollTop: $('#kayit-formu').offset().top }, 800);
			//document.getElementById("contact-form").reset();
		});
	}
	
	
}

function workshop(id)
{
	$.ajax({
		type	 : 'POST',
		url		 : 'dosyalar/dahili/workshop_popup.php?v=2102', 
		data	 : 	'id=' + id,
		 headers: {
     'Cache-Control': 'no-cache, no-store, must-revalidate', 
     'Pragma': 'no-cache', 
     'Expires': '0'
   },
   cache: false,
		success	 : function(cevap)
		{  
			$('#popup_workshop').html(cevap);
			
		}
	});
	
}
function deletePopup()
{
	var contentToRemove = document.querySelectorAll("#popup_workshop"); $(contentToRemove).remove();
}

$(document).ready(function(){
	$('#adet').val(1);
	var alumnisValue = document.getElementsByName('alumnis');  
	for(i = 0; i < alumnisValue.length; i++) { 
		if(alumnisValue[i].checked) 
			var alumnisValueResult = alumnisValue[i].value;
	} 
	if(alumnisValueResult==1){
		$("#ayrilma").css("display","block"); 
	} else {
		$("#ayrilma").css("display","none"); 
	}
	var faturaValue = document.getElementsByName('fatura-turu');  
	for(i = 0; i < faturaValue.length; i++) { 
		if(faturaValue[i].checked) 
			var faturaValueResult = faturaValue[i].value;
	} 
	if(faturaValueResult==1){
		$("#bireysel").css("display","block"); 
		$("#kurumsal").css("display","none"); 
		
	} else {
		$("#bireysel").css("display","none");
		$("#kurumsal").css("display","block"); 
	}
	
	$('[data-toggle="tooltip"]').tooltip();
	
	$('.adetsec').each(function(i){
		$(this).find('.minus').click(function () {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
		$(this).find('.plus').click(function () {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) + 1;
			count = count > 15 ? 15 : count;
			$input.val(count);
			$input.change();
			return false;
		});
	});

	
	$("input.adet").change(function() {
		$('span.plus').addClass('disabled');
		$('span.minus').addClass('disabled');
		var adet = $(this).val();
		var satir = $(' .katilimci_satir').length;
		$('.katilimci_satir:first-child').nextAll().remove();
		
		if(adet>1){

			$.get("dosyalar/dahili/katilimci.php?katilimci=" + adet, function(data){
				$('.katilimci_satirlari').append(data);
			}).done(function() {
				setTimeout(
				  function() 
				  {
					$('span.plus').removeClass('disabled');
					$('span.minus').removeClass('disabled');
				  }, 1000);
				
			});
			
		}
		
	});

});