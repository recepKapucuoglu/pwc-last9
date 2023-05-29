$(document).ready(function () {
    $(window).on('load', function () {
        afterLoad();
    });
});
window.growl = function (text, type, title) {
    type = typeof (type) !== 'undefined' ? type : 'success';
    title = typeof (title) !== 'undefined' ? title : 'Tebrikler';
    switch (type) {
        case 'success':
            $.growl.notice({
                title: title,
                message: text
            });
            break;
        case 'error':
            $.growl.error({
                title: title,
                message: text
            });
            break;
        case 'static':
            $.growl.error({
                title: title,
                message: text,
                static: true
            });
            break;
        case 'warning':
            $.growl.warning({
                title: title,
                message: text
            });
            break;
        case 'default':
            $.growl({
                title: title,
                message: text
            });
            break;
    }
    return this;
};
function afterLoad() {
    var lastScrollTop = 0;
    $(window).on("load resize scroll", function () {

        var windowScroll = $(window).scrollTop();
        /*
        if ($(window).width() < 960) {
            if (windowScroll > 202) {
                $("header").addClass("active");
                //$(".leftFixed").addClass("fix");
                $('.ustmenu').slideUp();
            } else {
                $("header").removeClass("active");
                // $(".leftFixed").removeClass("fix");
                $('.acilir_ust').slideUp();
                $('.ustmenu').slideDown();
            }

        }*/
        /*
        if (windowScroll > 202) {
            $("header").addClass("active");
            //$(".leftFixed").addClass("fix");
            $('.ustmenu').slideUp();
        } else {
            $("header").removeClass("active");
            // $(".leftFixed").removeClass("fix");
            $('.acilir_ust').slideUp();
            $('.ustmenu').slideDown();
        }*/
        /*
        if (windowScroll + $(window).height() >= $('.footerBottom').offset().top) {
            $(".leftFixed").addClass("bot");
        }else{
            $(".leftFixed").removeClass("bot");
        }*/
    });



    if (his($("#calendar"))) {
        $("#calendar .fc-h-event").each(function () {
            var title = $(this).find('.fc-title').html();
            $(this).addClass('hint--small hint--top hint--rounded').attr('aria-label', title);
        });
        $('.fc-right, .fc-left, .fc-more').click(function () {
            $("#calendar .fc-h-event").each(function () {
                var title = $(this).find('.fc-title').html();
                $(this).addClass('hint--small hint--top hint--rounded').attr('aria-label', title);
            });
        });
    }

    if (his($(".slaytyap"))) {
        $(".slaytyap").each(function () {
            var slaytyap = $(this),
                sliderLen = slaytyap.find(".slayt").length,
                sliderDuration = 60000,
                nav = slaytyap.data('nav'),
                dots = slaytyap.data('dots'),
                trans = slaytyap.data('trans'),
                xs = slaytyap.attr('data-xs'),
                sm = slaytyap.attr('data-sm'),
                md = slaytyap.attr('data-md'),
                lg = slaytyap.attr('data-lg');

            if (lg == null) { var lg = '1'; }
            if (md == null) { var md = lg; }
            if (sm == null) { var sm = md; }
            if (xs == null) { var xs = sm; }

            slaytyap.addClass("owl-carousel owl-theme");
            slaytyap.owlCarousel({
                margin: 20,
                nav: nav,
                navText: ['<div class="sol-ok"><i class="fas fa-chevron-left"></i></div>', '<div class="sag-ok"><i class="fas fa-chevron-right"></i></div>'],
                touchDrag: true,
                navSpeed: 800,
                mouseDrag: true,
                transitionStyle: trans,
                loop: true,
                dots: dots,
                autoplayTimeout: sliderDuration,
                autoplay: true,
                responsive: {
                    0: {
                        items: xs,
                    },
                    768: {
                        items: sm,
                    },
                    992: {
                        items: md,
                    },
                    1200: {
                        items: lg,
                    }
                }
            });
        });
    }

    if (his($("#slaytlar"))) {
        var div = $('#slaytlar');
        var slaytlar = div.find('.slaytalani');
        var sonslayt = slaytlar.find(".manset").length;
        var sonslayta = sonslayt - 1;
        var gerisayim = 6000;
        slaytlar.addClass("owl-carousel owl-theme");
        slaytlar.owlCarousel({
            items: 1,
            slideBy: 1,
            margin: 0,
            nav: true,
            navText: ['', ''],
            touchDrag: true,
            navSpeed: 800,
            mouseDrag: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop: true,
            dots: true,
            autoplayTimeout: 9000,
            autoplay: true,
            responsive: {
                650: {
                    items: 1,
                    slideBy: 1,
                    touchDrag: true
                }
            },

        });
        slaytlar.on('changed.owl.carousel', function (event) {
            //console.log(event.item.index);
            var sayi = event.item.index;
            if (sayi == sonslayta) {
                setTimeout(function () {
                    slaytlar.trigger('to.owl.carousel', 0);
                }, gerisayim);
            }
            var yenisayi = sayi + 1;
            $('#slaytlar .mansetbuton').removeClass('active');
            $('#slaytlar .mansetbuton:nth-child(' + yenisayi + ')').addClass('active');
        })
        $('#slaytlar .mansetbuton a').click(function (event) {
            event.preventDefault();
            var hash = $(this).closest('.mansetbuton').index();
            slaytlar.trigger('to.owl.carousel', [hash, 500]);
        });
    }

    if (his($(".tablar"))) {
        /* Tab */
        $(".tablar .tabicerikler .tabicerik").hide().removeClass("aktif");
        $(".tablar .tabicerikler .tabicerik:first-child").slideDown("slow").addClass("aktif");
        $(".tablar .tablinkler .tablink:first-child").addClass("aktif");

        $(".tablar .tablinkler .tablink").click(function () {
            var tabdiv = $(this).closest(".tablar");
            var tablink = $(this);
            var tablinkdeger = $(this).attr("data-tab");
            tabdiv.find(".tablink").removeClass("aktif");
            tablink.addClass("aktif");

            var tabic = tabdiv.find("[data-tabic=" + tablinkdeger + "]");
            tabdiv.find(".tabicerik").removeClass("aktif").hide();
            tabic.addClass("aktif").slideDown();
        });
        $(".tablinkgit").click(function () {
            var tablinkdeger = $(this).attr("data-tab");
            $(".tabicerik").removeClass("aktif").hide();
            $("[data-tabic=" + tablinkdeger + "]").addClass("aktif").slideDown();
            $(".tablink").removeClass("aktif");
            $("[data-tab=" + tablinkdeger + "]").addClass("aktif");
        });
        /* * Tab */
    }

    $('.saydir').each(function (i) {
        $(this).waypoint({
            offset: '100%',
            triggerOnce: true,
            handler: function () {
                var el = $(this);
                var duration = 2100;
                var to = el.attr('data-to');
                var timeout = 200;
                $({ property: 0 }).animate({ property: to }, {
                    duration: duration,
                    easing: 'linear',
                    step: function () {
                        el.text(Math.floor(this.property));
                    },
                    complete: function () {
                        el.text(this.property);
                    }
                });
            }
        });
    });

    $("nav.nav ul li").has("ul").addClass('.');

    $('.aramaac,.arama_kapat,.aramaactext').click(function () {
        $('.arama_popup').slideToggle();
    });



    $("a.kaydir").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            var deger = $(hash).offset().top - 0;
            $('html, body').animate({
                scrollTop: deger
            }, 800, function () {
                //window.location.hash = hash;
            });
        }
    });

    $('#mobil-menu').hcOffcanvasNav({
        maxWidth: false,
        labelClose: '<img src="https://www.socialthinks.com/website/pwc/dosyalar/images/logo-pwc-2.png" alt="PWC Logo">',
        labelBack: 'GERİ',
        customToggle: '.mobil_menuac',

    });
    $('#dashboard-mobil-menu').hcOffcanvasNav({
        maxWidth: false,
        labelClose: '<img src="https://www.socialthinks.com/website/pwc/dosyalar/images/logo-pwc-2.png" alt="PWC Logo">',
        labelBack: 'GERİ',
        customToggle: '.dashboard_menuac',

    });

    if ($(window).width() > 959) {
        if (his($(".video-sayfasi"))) {
            $('.video-sayfasi').css('height', $(window).height());
            $('.video-sayfasi .tablar,.video-sayfasi .videokutusu').css('height', $('.video-sayfasi').height());

            $(window).resize(function () {
                $('.video-sayfasi').css('height', $(window).height());
            });
        }
    }

    if (his($(".scrollbar-rail"))) {
        $('.scrollbar-rail').each(function () {
            $(this).scrollbar();
        });
    }

    if (his($(".sepetform"))) {
        var html = $('.sepetform .katilimci_satirlari').html();
        $(".sepetform input.adet").change(function () {
            var adet = $(this).val();
            var satir = $('.sepetform .katilimci_satir').length;
            $('.sepetform .katilimci_satir:first-child').nextAll().remove();
            for (i = 1; i < adet; i++) {
                var sayac = i + 1;
                var katilimciRow = "<tr class='katilimci_satir'><td style='padding:0px'><span class='removeTr'>Katılımcı Çıkart</span><table><tr style='border:0px'><td colspan='2' style='padding: 0px 20px 0px;'><h4 style='color: #d3202e;'><b>" + sayac + ". Katılımcı</b></h4></td></tr><tr><td><div class='label-div3'><label>Ad Soyad*</label><input type='text' name='katilimci_adsoyad[]' /> <br/><label>Firma Adı*</label><input type='text' name='katilimci_firma[]'/></div></td><td><div class='label-div3'><label>Unvan *</label><input type='text' name='katilimci_unvan[]' /><br/><label>Firma Telefon *</label><input type='tel' name='katilimci_firma_telefon[]' /></div></td><td><div class='label-div3'><label>Telefon*</label><input type='tel' name='katilimci_telefon[]'  /><br/><label>E-Posta *</label><input type='email' name='katilimci_email[]'  /></div></td></tr></table></td></tr>";
                $('.sepetform .katilimci_satirlari').append(katilimciRow);
            }

        });
        $('input[type=radio][name=odemeyontemi]').change(function () {
            $('.radiotab').removeClass('aktif');
            $(this).closest('.radiotab').addClass('aktif');
            $('.radiotab .icerik').slideUp();
            $(this).closest('.radiotab').find('.icerik').slideDown();
        });
    }

    $(document).on('click', '.removeTr', function () {
        $(this).parent().parent('tr').remove();
        var edu_cal_id = $('#edu_cal_id').val();
        var sayac = $('.katilimci_satir').length;
        $('.adet').val(sayac);
        $.get("dosyalar/dahili/sepet_fiyat.php?katilimci=" + sayac + "&edu_cal_id=" + edu_cal_id, function (data) {
            $('.sepettoplam').html(data);
        });
    });
    $(document).on('click', '.addTr', function () {
        var sayac = 1 + $('.katilimci_satir').length;
        var edu_cal_id = $('#edu_cal_id').val();
        $('.adet').val(sayac);
        var katilimciRow = "<tr class='katilimci_satir'><td style='padding:0px'><span class='removeTr'>Katılımcı Çıkart</span><table><tr style='border:0px'><td colspan='2' style='padding: 0px 20px 0px;'><h4 style='color: #d3202e;'><b>" + sayac + ". Katılımcı</b></h4></td></tr><tr><td><div class='label-div3'><label>Ad Soyad*</label><input type='text' name='katilimci_adsoyad[]' /> <br/><label>Firma Adı*</label><input type='text' name='katilimci_firma[]'/></div></td><td><div class='label-div3'><label>Unvan *</label><input type='text' name='katilimci_unvan[]' /><br/><label>Firma Telefon *</label><input type='tel' name='katilimci_firma_telefon[]' /></div></td><td><div class='label-div3'><label>Telefon*</label><input type='tel' name='katilimci_telefon[]'  /><br/><label>E-Posta *</label><input type='email' name='katilimci_email[]'  /></div></td></tr></table></td></tr>";
        $('.sepetform .katilimci_satirlari').append(katilimciRow);
        $.get("dosyalar/dahili/sepet_fiyat.php?katilimci=" + sayac + "&edu_cal_id=" + edu_cal_id, function (data) {
            $('.sepettoplam').html(data);
        });
    });

    if (his($(".select2add"))) {
        $('.select2add').each(function () {
            $(this).select2({
                placeholder: $(this).data('placeholder'),
                allowClear: true
            });
        });
    }

    if (his($(".schema-faq"))) {
        $('.schema-faq-question').click(function () {
            $(this).parent().toggleClass('aktif');
            $(this).parent().find('.schema-faq-answer').slideToggle();
        });
    }

    $('.resimac, .slaytresimac').magnificPopup({
        type: 'image',
        mainClass: 'mfp-fade',
    });

    $('.zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
            verticalFit: true,
            titleSrc: function (item) {
                return item.el.attr('title');
            }
        },
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            opener: function (element) {
                return element.find('img');
            }
        },
        verticalFit: true,

    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        verticalFit: true,
    });

    $('.simple-ajax-popup-align-top').magnificPopup({
        type: 'ajax',
        alignTop: false,
        overflowY: 'scroll',
        verticalFit: true,
    });

    $('input[type="tel"]').mask('0(000) 000-0000');
    $('#kartno').mask('0000 0000 0000 0000');
    $('#kkyil, #kkay, .adetsec .adet').mask('00');
    $('#cvv').mask('000');

    $('.etiketac').click(function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        $('.etiketkutular .karekutular').css('display', 'none');
        var hedef = $('.etiketkutular .karekutular' + id);
        hedef.append('<div class="yukleniyor"><i class="fas fa-spinner fa-spin"></i></div>');
        $('.etiketkutular .karekutular' + id).css('display', 'flex');
        setTimeout(function () {
            hedef.find('.yukleniyor').remove();
        }, 1000);
    });

    $('.adetsec').each(function (i) {
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
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });

    $("input.adet").change(function () {
        var adet = $(this).val();
        var edu_cal_id = $('#edu_cal_id').val();
        if (adet > 0) {
            $.get("dosyalar/dahili/sepet_fiyat.php?katilimci=" + adet + "&edu_cal_id=" + edu_cal_id, function (data) {
                $('.sepettoplam').html(data);
            });
        }
    });

    $("input[name='fatura-turu']").on('change', function (event) {

        var radioValue = $(this).val();
        if (radioValue == 1) {
            $("#bireysel").css("display", "block");
            $("#kurumsal").css("display", "none");

        } else {
            $("#bireysel").css("display", "none");
            $("#kurumsal").css("display", "block");
        }
    });

}

//SocialThinks
window.addEventListener('load', function (event) {
    const egitimProgramlari = document.getElementById('egitimProgramlari');
    const altmenu = document.getElementById('altmenu');
    const altmenuTitle = document.getElementsByClassName('main-altmenu__title');
    const subList = document.getElementsByClassName('sub-list');
    const childAltmenu = document.getElementById('childAltmenu');

    egitimProgramlari.addEventListener('click', function () {
        if (altmenu.style.display == 'block') {
            altmenu.style.display = 'none'
        } else {
            altmenu.style.display = 'block'
        }
    })

    altmenu.addEventListener('mouseleave', function () {
        altmenu.style.display = 'none'
    })

    for (let i = 0; i < altmenuTitle.length; i++) {
        altmenuTitle[i].addEventListener('click', function () {
            if (altmenuTitle[i].nextElementSibling.classList.contains('d-block')) {
                altmenuTitle[i].nextElementSibling.classList.remove('d-block')
                altmenuTitle[i].nextElementSibling.classList.add('d-none')
            } else {
                altmenuTitle[i].nextElementSibling.classList.add('d-block')
                altmenuTitle[i].nextElementSibling.classList.remove('d-none')
            }
        });
    };

    for (let i = 0; i < subList.length; i++) {
        subList[i].addEventListener('click', function () {
            if (childAltmenu.style.display == 'block') {
                childAltmenu.style.display = 'none'
            } else {
                childAltmenu.style.display = 'block'
            }

        });
    };

});

//SocialThinks
window.addEventListener('load', function (event) {
    const educationType = document.getElementById('educationType');
    const educationTypeContainer = document.getElementById('educationTypeContainer');

    const education = document.getElementById('education');

    const educationLevel = document.getElementById('educationLevel');
    const educationLevelContainer = document.getElementById('educationLevelContainer');

    educationType.addEventListener('click', function (event) {
        if (educationTypeContainer.style.display == "flex" && education.style.display == "block") {
            educationTypeContainer.style.display = "none";
            education.style.display = "none";
        } else {
            educationTypeContainer.style.display = "flex";
            education.style.display = "block";
            educationLevelContainer.style.display = "none";
        }
    })

    educationLevel.addEventListener('click', function (event) {
        if (educationLevelContainer.style.display == "none" && education.style.display == "none") {
            educationLevelContainer.style.display = "flex";
            education.style.display = "block";
        } else if (educationLevelContainer.style.display == "flex" && education.style.display == "block") {
            education.style.display = "none";
            educationLevelContainer.style.display = "none";
        } else if (educationTypeContainer.style.display == "flex" && education.style.display == "block") {
            educationTypeContainer.style.display = "none";
            educationLevelContainer.style.display = "flex";
        }
    })
});

//SocialThinks
function mailKontrol(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
/*
function validateEmail(inputText)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.value.match(mailformat)){ return true; } else { return false; }
}*/

//Eğitim arama işlemleri
//OrderBy
$("body").on('change', '#orderby', function () {
    $('.listeler').append('<div class="yukleniyor"><i class="fas fa-spinner fa-spin"></i></div>');
    var query = $('#education_list_form').serialize();
    var checkboxVal = $("input[type='checkbox']").serialize();
    if (checkboxVal === "") checkboxVal = "egitimCheck[]=";
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/getEducation.php',
        data: query + '&id=' + $(this).find('option:selected').val() + '&' + checkboxVal,
        success: function (data) {

            $('.listeler').html(data);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: 200 }, 800);
        $('.listeler').find('.yukleniyor').remove();
    });
});

// Kelime Arama
$("#education_list_form").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    $('.listeler').append('<div class="yukleniyor"><i class="fas fa-spinner fa-spin"></i></div>');
    var query = $('#education_list_form').serialize();
    var checkboxVal = $("input[type='checkbox']").serialize();
    if (checkboxVal === "") checkboxVal = "egitimCheck[]=";
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/getEducation.php',
        data: query + '&id=' + $("#orderby").find('option:selected').val() + '&' + checkboxVal,
        success: function (data) {

            $('.listeler').html(data);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: 200 }, 800);
        $('.listeler').find('.yukleniyor').remove();
    });
});

// Checkbox Kategori
$('.edu-checkbox').change(function () {
    $('.listeler').append('<div class="yukleniyor"><i class="fas fa-spinner fa-spin"></i></div>');
    var query = $('#education_list_form').serialize();
    var checkboxVal = $("input[type='checkbox']").serialize();
    if (checkboxVal === "") checkboxVal = "egitimCheck[]=";
    var listType = $("input[type='hidden']").val();

    if (listType != 2) {

        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/getEducation.php',
            data: query + '&id=' + $("#orderby").find('option:selected').val() + '&' + checkboxVal,
            success: function (data) {

                $('.listeler').html(data);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: 200 }, 800);
            $('.listeler').find('.yukleniyor').remove();
        });
    }
});


// Sayfalama

function education_more(id, closedEdu) {
    $('.listeler').append('<div class="yukleniyor"><i class="fas fa-spinner fa-spin"></i></div>');
    var query = $('#education_list_form').serialize();
    var checkboxVal = $("input[type='checkbox']").serialize();
    if (checkboxVal === "") checkboxVal = "egitimCheck[]=";
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/getEducation.php',
        data: query + '&id=' + $("#orderby").find('option:selected').val() + '&' + checkboxVal + '&more=' + id + '&closed=' + closedEdu,
        success: function (data) {

            $('.listeler').html(data);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: 200 }, 800);
        $('.listeler').find('.yukleniyor').remove();
    });
}
function education_more_page(id, closedEdu) {
    var query = $('#education_list_form_edu').serialize();
    var checkboxVal = $("input[type='checkbox']").serialize();
    if (checkboxVal === "") checkboxVal = "egitimCheck[]=";
    var id = id + 1;
    var qs = 'page=' + id + '&' + query + '&id=' + $("#orderbyEdu").find('option:selected').val() + '&' + checkboxVal + '&closed=' + closedEdu;
    window.location = 'https://www.okul.pwc.com.tr/egitimlerimiz?' + qs;
}

$("body").on('change', '#orderbyEdu', function () {
    education_more_page(0, 0);
});
$("#education_list_form_edu").submit(function (e) {
    e.preventDefault();
    education_more_page(0, 0);
});
$('.edu-checkbox-edu').change(function () {
    education_more_page(0, 0);
});

function education_more_cate(id, closedEdu) {
    var query = $('#education_list_form_cate').serialize();
    var categories = $('#categories').val();
    var id = id + 1;
    var qs = 'page=' + id + '&' + query + '&id=' + $("#orderbyCate").find('option:selected').val() + '&closed=' + closedEdu;
    window.location = categories + '?' + qs;
}
$("body").on('change', '#orderbyCate', function () {
    education_more_cate(0, 0);
});
$("#education_list_form_cate").submit(function (e) {
    e.preventDefault();
    education_more_page(0, 0);
});

// Bilgi Formu Gönder
function bilgi_form_gonder() {
    var query = $('#bilgi_form').serialize();

    var tel_check = $('#telefon').val();
    var email = $('#email').val();
    var telLength = tel_check.length;
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#adsoyad').val() == "") {
        message = message + "* Ad Soyad giriniz.<br/>";
        $('#adsoyad').focus();
    }
    if ($('#telefon').val() == "") {
        message = message + "* Telefon numarası giriniz.<br/>";
        $('#telefon').focus();
    } else if (telLength < 12) {
        message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
        $('#telefon').focus();
    }
    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    if ($('#sirketadi').val() == "") {
        message = message + "* Şirket adı giriniz.<br/>";
        $('#sirketadi').focus();
    }

    if ($('#edu_id').val() == "") {

        if ($('#kisi_sayisi').val() == "") {
            message = message + "* Kişi sayısı giriniz.<br/>";
            $('#kisi_sayisi').focus();
        }
        if ($('#lokasyon').val() == "") {
            message = message + "* Lokasyon giriniz.<br/>";
            $('#lokasyon').focus();
        }
        if ($('#egitim_konu').val() == "") {
            message = message + "* Eğitim verilecek konuyu giriniz.<br/>";
            $('#egitim_konu').focus();
        }
    }

    if (message != "") {
        $('.bilgiFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#bilgiFormu').offset().top }, 800);
    } else {

        $('.bilgial').addClass('disabled');
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/bilgi_form_send.php',
            data: query,
            success: function (cevap) {
                $('.bilgiFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('#bilgiFormu').offset().top }, 800);
            document.getElementById("bilgi_form").reset();
            $('.bilgial').removeClass('disabled');
        });
    }
}
function sign_send_step1() {
    var query = $('#sign_form_step1').serialize();

    var tel_check = $('#telefon').val();
    var telLength = tel_check.length;
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#adsoyad').val() == "") {
        message = message + "* Ad Soyad giriniz.<br/>";
        $('#adsoyad').focus();
    }

    if ($('#telefon').val() == "") {
        message = message + "* Telefon numarası giriniz.<br/>";
        $('#telefon').focus();
    } else if (telLength < 12) {
        message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
        $('#telefon').focus();
    }

    if (message != "") {
        $('.signFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/sign_send_step1.php',
            data: query,
            success: function (cevap) {
                $('.signFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);

        });
    }
}


// Login
function login_send() {
    var query = $('#login_form').serialize();
    var email = $('#email_login').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";
    if ($('#email_login').val() == "") {
        message = message + "* E-mail adresi ya da Telefon numarası giriniz.<br/>";
        $('#email_login').focus();
        //bir değer girilmişse

    } else if ($('#email_login').val().indexOf('@') == -1) {//girilen değer @ içermiyorsa (telefonsa)
        var regex = /^0\(\d{3}\)\s\d{3}-\d{4}$/;
        var myString = $('#email_login').val();
        if (regex.test(myString)) { //ve 0(537) 957-1870 tipindeyse

        }
        else if ($('#email_login').val().startsWith("05")) {         //05 ile yazılmışmı
            if ($('#email_login').val().length != 11) {// telefon numarası 11 haneli değil mi?    
                message = message + "* Geçerli bir telefon numarası giriniz.<br/>";
                message = message * "* Telefon numaranızı 0 ile başlayarak şekilde yazınız.(05*********)"
                $('#email_login').focus();
            }
        }
        else if (/^5\d{9}$/.test($('#email_login').val())) { // girilen değer 10 haneli ve 5 ile başlıyorsa
            message = message + "* Telefon numaranızı 0 ile başlayarak şekilde yazınız.(05*********)<br/>";
            $('#email_login').focus();
        }
        else {
            message = message + "* Geçerli bir telefon numarası giriniz.(05*********)<br/>";
            $('#email_login').focus();
        }
    }
    else if (!mailKontrol(email)) {
        message = message + "* Geçerli bir E-mail adresi giriniz.<br/>";
        $('#email_login').focus();
    }
    if ($('#password').val() == "") {
        message = message + "* Şifrenizi giriniz.<br/>";
        $('#password').focus();
    }

    if (message != "") {
        $('.loginFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.loginFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/login_send.php',
            data: query,
            success: function (cevap) {
                $('.loginFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.loginFormList').offset().top - 400 }, 800);
        });
    }
}

// Doğrulama Send
function dogrulama_send() {

    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/dogrulama_send.php',
        data: '',
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });

}

// Doğrulama Send
function tek_kullanimlik_dogrulama() {
    var query = $('#tek_dogrulama').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/tek_dogrulama.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}
function verify_user_otp_mail() {
    var query = $('#verify_user_otp_mail').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/verify_user_otp_mail.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}
//sayfa yüklendiğinde // telefon güncelle ekranını gizledik.
$(document).ready(function () {
    $('#login_phone_update_screen').hide();
});
//tıklandıgında açtık
function verify_user_otp_hide_form() {
    $("#verify_user_otp").hide();
    $("#login_phone_update_screen").show();
}
//güncelleme butonuna tıklandıgında 
function login_phone_update_screen() {
    var query = $('#login_phone_update_screen').serialize();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";

    var tel_check = $('#telefon').val();
    var telLength = tel_check.length;
    var message = "";
    if ($('#telefon').val() == "") {
        message = message + "* Telefon numarası giriniz.<br/>";
        $('#telefon').focus();
    } else if (telLength < 15) {
        message = message + "* Telefon numaranızı eksiksiz giriniz.<br/>";
        $('#telefon').focus();
    }
    if (message != "") {
        $('.bildirim').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.bildirim   ').offset().top - 400 }, 800);
    }
    else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/login_phone_update_screen.php',
            data: query,
            success: function (cevap) {
                $('.bildirim').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

        });
    }
}

function verify_user_otp() {
    var query = $('#verify_user_otp').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/verify_user_otp.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}
function verify_user_otp_uye_ol() {
    var query = $('#verify_user_otp').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/verify_user_otp.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}
function verify_user_otp_resend() {
    var query = $('#verify_user_otp').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/verify_user_otp_resend.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}

function verify_user_otp_resend_mail() {
    var query = $('#verify_user_otp').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/verify_user_otp_resend_mail.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}


function without_resend() {
    var query = $('#verify_user_otp').serialize();
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/without_resend.php',
        data: query,
        success: function (cevap) {
            $('.bildirim').html(cevap);
        }
    }).done(function () {
        $("html, body").animate({ scrollTop: $('.bildirim').offset().top - 400 }, 800);

    });
}

// Şifremi unuttum
function password_reset_send() {
    var query = $('#password_form').serialize();

    var emailTelefon = $('#email').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#email').val() == "") {
        message = message + "* E-mail adresi ya da Telefon numarası giriniz.<br/>";
        $('#email').focus();
        //bir değer girilmişse

    } else if ($('#email').val().indexOf('@') == -1) {//girilen değer @ içermiyorsa (telefonsa)
        var regex = /^0\(\d{3}\)\s\d{3}-\d{4}$/;
        var myString = $('#email').val();
        if (regex.test(myString)) { //ve 0(537) 957-1870 tipindeyse

        }
        else if ($('#email').val().startsWith("05")) {         //05 ile yazılmışmı
            if ($('#email').val().length != 11) {// telefon numarası 11 haneli değil mi?    
                message = message + "* Geçerli bir telefon numarası giriniz.<br/>";
                message = message * "* Telefon numaranızı 0 ile başlayarak şekilde yazınız.(05*********)"

                $('#email').focus();
            }
        }
        else if (/^5\d{9}$/.test($('#email').val())) { // girilen değer 10 haneli ve 5 ile başlıyorsa
            message = message + "* Telefon numaranızı 0 ile başlayarak şekilde yazınız.(05*********)<br/>";
            $('#email').focus();
        }
        else {
            message = message + "* Geçerli bir telefon numarası giriniz.(05*********)<br/>";
            $('#email').focus();
        }
    }
    else if (!mailKontrol(emailTelefon)) {
        message = message + "* Geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    // var tel_check = $('#telefon').val();
    // var telLength = tel_check.length;
    // var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    // var message = "";

    // if ($('#telefon').val() == "") {
    //     message = message + "* Telefon numarası giriniz.<br/>";
    //     $('#telefon').focus();
    // } else if (telLength < 12) {
    //     message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
    //     $('#telefon').focus();
    // }




    if (message != "") {
        $('.passwordFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.passwordFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/password_reset_send.php',
            data: query,
            success: function (cevap) {
                $('.passwordFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.passwordFormList').offset().top - 400 }, 800);

        });
    }
}


// Şifremi güncelle
function password_change_send() {
    var query = $('#password_form').serialize();

    var email = $('#email').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";


    if ($('#sifre').val() == "") {
        message = message + "* Şifrenizi giriniz.<br/>";
        $('#sifre').focus();
    }
    if ($('#sifre2').val() == "") {
        message = message + "* Şifrenizi tekrar giriniz.<br/>";
        $('#sifre2').focus();
    }



    if (message != "") {
        $('.passwordFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.passwordFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/password_change_send.php',
            data: query,
            success: function (cevap) {
                $('.passwordFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.passwordFormList').offset().top - 400 }, 800);

        });
    }
}
// Sign
function sign_send_step2() {
    var query = $('#sign_form_step2').serialize();

    // var tel_check = $('#telefon').val();
    var email = $('#email').val();
    // var telLength = tel_check.length;
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    // if ($('#adsoyad').val() == "") {
    //     message = message + "* Ad Soyad giriniz.<br/>";
    //     $('#adsoyad').focus();
    // }
    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    if ($('#unvan').val() == "") {
        message = message + "* Unvanınızı giriniz.<br/>";
        $('#unvan').focus();
    }
    // if ($('#telefon').val() == "") {
    //     message = message + "* Telefon numarası giriniz.<br/>";
    //     $('#telefon').focus();
    // } else if (telLength < 12) {
    //     message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
    //     $('#telefon').focus();
    // }
    if ($('#firma').val() == "") {
        message = message + "*  Okul veya Firma bilginizi giriniz.<br/>";
        $('#firma').focus();
    }
    if ($('#sifre').val() == "") {
        message = message + "* Şifrenizi giriniz.<br/>";
        $('#sifre').focus();
    }
    if ($('#sifre2').val() == "") {
        message = message + "* Şifrenizi tekrar giriniz.<br/>";
        $('#sifre2').focus();
    }
    if (!$('#sozlesme').is(':checked')) {
        message = message + "* Üyelik sözleşmesini onaylayınız.<br/>";
        $('#sozlesme').focus();
    }
    if (!$('#aydinlatma').is(':checked')) {
        message = message + "* Aydınlatma metnini onaylayınız.<br/>";
        $('#aydinlatma').focus();
    }



    if (message != "") {
        $('.signFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/sign_send_step2.php',
            data: query,
            success: function (cevap) {
                $('.signFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);

        });
    }
}

// Sign
function sign_send() {
    var query = $('#sign_form').serialize();

    var tel_check = $('#telefon').val();
    var email = $('#email').val();
    var telLength = tel_check.length;
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#adsoyad').val() == "") {
        message = message + "* Ad Soyad giriniz.<br/>";
        $('#adsoyad').focus();
    }
    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    if ($('#unvan').val() == "") {
        message = message + "* Unvanınızı giriniz.<br/>";
        $('#unvan').focus();
    }
    if ($('#telefon').val() == "") {
        message = message + "* Telefon numarası giriniz.<br/>";
        $('#telefon').focus();
    } else if (telLength < 12) {
        message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
        $('#telefon').focus();
    }
    if ($('#firma').val() == "") {
        message = message + "*  Okul veya Firma bilginizi giriniz.<br/>";
        $('#firma').focus();
    }
    if ($('#sifre').val() == "") {
        message = message + "* Şifrenizi giriniz.<br/>";
        $('#sifre').focus();
    }
    if ($('#sifre2').val() == "") {
        message = message + "* Şifrenizi tekrar giriniz.<br/>";
        $('#sifre2').focus();
    }
    if (!$('#sozlesme').is(':checked')) {
        message = message + "* Üyelik sözleşmesini onaylayınız.<br/>";
        $('#sozlesme').focus();
    }
    if (!$('#aydinlatma').is(':checked')) {
        message = message + "* Aydınlatma metnini onaylayınız.<br/>";
        $('#aydinlatma').focus();
    }



    if (message != "") {
        $('.signFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/sign_send.php',
            data: query,
            success: function (cevap) {
                $('.signFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.signFormList').offset().top - 400 }, 800);

        });
    }
}

// Sign
function without_send() {
    var query = $('#without_form').serialize();

    var email = $('#without_email').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";


    if ($('#without_email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#without_email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#without_email').focus();
    }

    if (!$('#aydinlatma_without').is(':checked')) {
        message = message + "* Aydınlatma metnini onaylayınız.<br/>";
        $('#aydinlatma_without').focus();
    }



    if (message != "") {
        $('.withoutFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.withoutFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/without_send.php',
            data: query,
            success: function (cevap) {
                $('.withoutFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.withoutFormList').offset().top - 400 }, 800);

        });
    }
}


// Sign
function profil_send() {
    var query = $('#profil_form').serialize();

    var tel_check = $('#telefon').val();
    var email = $('#email').val();
    var telLength = tel_check.length;
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#adsoyad').val() == "") {
        message = message + "* Adsoyad giriniz.<br/>";
        $('#adsoyad').focus();
    }
    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    if ($('#telefon').val() == "") {
        message = message + "* Telefon numarası giriniz.<br/>";
        $('#telefon').focus();
    } else if (telLength < 12) {
        message = message + "* Lütfen telefon numaranızı eksiksiz giriniz.<br/>";
        $('#telefon').focus();
    }
    if ($('#mevcutsifre').val() != "") {



        if ($('#sifre').val() == "") {
            message = message + "* Yeni Şifrenizi giriniz.<br/>";
            $('#sifre').focus();
        }
        if ($('#sifre2').val() == "") {
            message = message + "* Yeni Şifrenizi tekrar giriniz.<br/>";
            $('#sifre2').focus();
        }
    }






    if (message != "") {
        $('.profilFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.profilFormList').offset().top - 400 }, 800);
    } else {
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/profil_send.php',
            data: query,
            success: function (cevap) {
                $('.profilFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.profilFormList').offset().top - 400 }, 800);

        });
    }
}

//like

$(".favori").click(function () {
    var params = 'id=' + $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/education_like_unlike.php',
        data: params,
        dataType: 'json',
        success: function (cevap) {
            if (cevap.status == 'ok') {
                growl(cevap.msg);
                $('#' + cevap.id).addClass("aktif");
            }
            else {
                growl(cevap.msg, 'error', 'Hata !');
            }
        }
    });

});

$(".favorireset").click(function () {
    var params = 'id=' + $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/education_unlike.php',
        data: params,
        dataType: 'json',
        success: function (cevap) {
            if (cevap.status == 'ok') {
                window.location.href = "https://www.okul.pwc.com.tr/dashboard-favorilerim.php";

            }
            else {
                growl(cevap.msg, 'error', 'Hata !');
            }
        }
    });

});

jQuery(document).ready(function ($) {
    // Get current path and find target link
    var path = window.location.pathname.split("/").pop();



    var target = $('nav a[href="' + path + '"]');
    // Add active class to target link
    target.addClass('aktif');
});

// İletişim Formu Gönder
function iletisim_form_gonder() {
    var query = $('#iletisim_form').serialize();

    var email = $('#email').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    if ($('#adsoyad').val() == "") {
        message = message + "* Ad Soyad giriniz.<br/>";
        $('#adsoyad').focus();
    }

    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }
    if ($('#mesaj').val() == "") {
        message = message + "* Mesajınızı giriniz.<br/>";
        $('#mesaj').focus();
    }


    if (message != "") {
        $('.iletisimFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('.iletisimFormList').offset().top - 150 }, 800);
    } else {

        $('.bilgial').addClass('disabled');
        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/iletisim_form_send.php',
            data: query,
            success: function (cevap) {
                $('.iletisimFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('.iletisimFormList').offset().top - 150 }, 800);
            document.getElementById("iletisim_form").reset();
            $('.bilgial').addClass('disabled');
        });
    }
}

// Bülten Formu Gönder
function bulten_form_gonder() {
    var query = $('#bulten_form').serialize();

    var email = $('#email').val();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";


    if ($('#email').val() == "") {
        message = message + "* E-mail adresi giriniz.<br/>";
        $('#email').focus();
    } else if (!mailKontrol(email)) {
        message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>";
        $('#email').focus();
    }

    if (message != "") {
        $('.bultenFormList').html("<div class=\"alert alert-danger\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#ebulten').offset().top - 150 }, 800);
    } else {

        $.ajax({
            type: 'POST',
            url: 'dosyalar/dahili/bulten_form_send.php',
            data: query,
            success: function (cevap) {
                $('.bultenFormList').html(cevap);
            }
        }).done(function () {
            $("html, body").animate({ scrollTop: $('#bilgiFormu').offset().top - 150 }, 800);
            document.getElementById("bilgi_form").reset();
        });
    }
}

function form_gonder() {
    var query = $('#contact-form').serialize();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";

    /*var gsm_check = $('#gsm').val();
    var email = $('#email').val();
    var gsmLength = gsm_check.length;
    // Katılımcı Kontrol
    if($('#adsoyad').val() == ""){ message = message + "* Ad Soyad giriniz.<br/>"; $('#adsoyad').focus(); }
    if($('#gsm').val() == ""){ message = message + "* Cep telefonu numarası giriniz.<br/>"; $('#gsm').focus(); } else if(gsmLength<11){ message = message + "* Cep telefonu numarası eksiksiz giriniz.<br/>"; $('#gsm').focus(); }
    if($('#email').val() == ""){ message = message + "* E-mail adresi giriniz.<br/>"; $('#email').focus(); }else if (!mailKontrol(email)) { message = message + "* Lütfen geçerli bir E-mail adresi giriniz.<br/>"; $('#email').focus(); }
    */




    /*
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
    */


    // Fatura bilgileri kontrol
    var faturaValue = document.getElementsByName('fatura-turu');
    for (i = 0; i < faturaValue.length; i++) {
        if (faturaValue[i].checked)
            var radioValue = faturaValue[i].value;
    }
    if (radioValue == 1) {
        var tc_check = $('#tc_no').val();
        var tcLength = tc_check.length;
        if ($('#fatura_adsoyad').val() == "") { message = message + "* Fatura adı giriniz.<br/>"; $('#fatura_adsoyad').focus(); }
        if ($('#tc_no').val() == "") { message = message + "* T.C. kimlik numarası giriniz.<br/>"; $('#tc_no').focus(); } else if (tcLength < 11) { message = message + "* T.C. kimlik numarasını eksiksiz giriniz.<br/>"; $('#tc_no').focus(); }
    } else {
        var vergi_check = $('#vergi_no').val();
        var vergiLength = vergi_check.length;
        if ($('#firma_unvani').val() == "") { message = message + "* Fatura firma ünvanı giriniz.<br/>"; $('#firma_unvani').focus(); }
        if ($('#vergi_dairesi').val() == "") { message = message + "* Vergi dairesi giriniz.<br/>"; $('#vergi_dairesi').focus(); }
        if ($('#vergi_no').val() == "") { message = message + "* Vergi numarası giriniz.<br/>"; $('#vergi_no').focus(); } else if (vergiLength < 10) { message = message + "* Vergi numarasını eksiksiz giriniz.<br/>"; $('#vergi_no').focus(); }
    }
    if ($('#adres').val() == "") { message = message + "* Fatura adresi giriniz.<br/>"; $('#adres').focus(); }


    if (message != "") {
        $('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#contact-form').offset().top - 250 }, 800);
    } else {
        $("#contact-form").submit();
        /*
        $('.satinal').addClass('disabled');
        $.ajax({
            type	 : 'POST',
            url		 : 'dosyalar/dahili/form_send.php',
            data	 : query,
            success	 : function(cevap)
            {
                $('.formMessage').html(cevap);


            }
        }).done(function() {
            $("html, body").animate({ scrollTop: $('#contact-form').offset().top - 150 }, 800);
            document.getElementById("contact-form").reset();
            $('.satinal').removeClass('disabled');
        });*/
    }


}



function katilimcilar_gonder() {
    var query = $('#contact-form').serialize();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";
    if ($('#katilimci_adsoyad').val() == "") { message = message + "* Ad soyad boş bırakılamaz.<br/>"; $('#katilimci_adsoyad').focus(); }
    if ($('#katilimci_unvan').val() == "") { message = message + "* Ünvan boş bırakılamaz.<br/>"; $('#katilimci_unvan').focus(); }
    if ($('#katilimci_telefon').val() == "") { message = message + "* Telefon numarası boş bırakılamaz.<br/>"; $('#katilimci_telefon').focus(); }
    if ($('#katilimci_email').val() == "") { message = message + "* Mail adresi boş bırakılamaz.<br/>"; $('#katilimci_email').focus(); }
    if (message != "") {
        $('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#contact-form').offset().top - 250 }, 800);
    } else {
        $("#contact-form").submit();

    }


}




function odeme_gonder() {
    var query = $('#contact-form').serialize();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";




    // Fatura bilgileri kontrol
    var faturaValue = document.getElementsByName('fatura-turu');
    for (i = 0; i < faturaValue.length; i++) {
        if (faturaValue[i].checked)
            var radioValue = faturaValue[i].value;
    }
    if (radioValue == 1) {
        var tc_check = $('#tc_no').val();
        var tcLength = tc_check.length;
        if ($('#fatura_adsoyad').val() == "") { message = message + "* Fatura adı giriniz.<br/>"; $('#fatura_adsoyad').focus(); }
        if ($('#tc_no').val() == "") { message = message + "* T.C. kimlik numarası giriniz.<br/>"; $('#tc_no').focus(); } else if (tcLength < 11) { message = message + "* T.C. kimlik numarasını eksiksiz giriniz.<br/>"; $('#tc_no').focus(); }
    } else {
        var vergi_check = $('#vergi_no').val();
        var vergiLength = vergi_check.length;
        if ($('#firma_unvani').val() == "") { message = message + "* Fatura firma ünvanı giriniz.<br/>"; $('#firma_unvani').focus(); }
        if ($('#vergi_dairesi').val() == "") { message = message + "* Vergi dairesi giriniz.<br/>"; $('#vergi_dairesi').focus(); }
        if ($('#vergi_no').val() == "") { message = message + "* Vergi numarası giriniz.<br/>"; $('#vergi_no').focus(); } else if (vergiLength < 10) { message = message + "* Vergi numarasını eksiksiz giriniz.<br/>"; $('#vergi_no').focus(); }
    }
    if ($('#adres').val() == "") { message = message + "* Fatura adresi giriniz.<br/>"; $('#adres').focus(); }


    if (message != "") {
        $('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#contact-form').offset().top - 250 }, 800);
    } else {
        $("#contact-form").submit();

    }

}


function ozet_gonder() {
    var query = $('#contact-form').serialize();
    var header = " Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";
    var message = "";



    if (!$('#check1').is(':checked')) {
        message = message + "* Ön bilgilendirme formunu onaylayınız.<br/>";
        $('#check1').focus();
    }
    if (!$('#check2').is(':checked')) {
        message = message + "* Mesafeli hizmet sözleşmesini onaylayınız.<br/>";
        $('#check2').focus();
    }


    if (message != "") {
        $('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>" + header + message + "</div>");
        $("html, body").animate({ scrollTop: $('#contact-form').offset().top - 250 }, 800);
    } else {
        $("#contact-form").submit();

    }

}
