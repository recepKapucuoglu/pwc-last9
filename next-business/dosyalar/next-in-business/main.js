// cfo
const fetchContent = (jsonFile, divID) => {
    fetch(jsonFile)
        .then(response => response.json())
        .then(data => {
            data.forEach(element => {
                let cfo = document.createElement('div');
                cfo.className = 'schedule-listing';
                cfo.innerHTML = `
          <div class="schedule-slot-time">
          <span> ${element.date ?? ''}</span>
          ${element.where ?? ''}
          <span style='font-size:12px; color: #fff;'>${element.type ?? ''}</span>
        </div>
        <div class="schedule-slot-info">
            <div class="schedule-slot-info-content">  
                    <h3 class="schedule-slot-title">${element.title ?? ''}</h3>
                <p>
                    ${element.description ?? ''}
                </p>
            </div>
            <!--Info content end -->
        </div><!-- Slot info end -->
          `;
                document.getElementById(divID).appendChild(cfo);
            });
        })
};

fetchContent('dosyalar/next-in-business/cfo.json', '0945');
fetchContent('dosyalar/next-in-business/data-akademi.json', '1245');
fetchContent('dosyalar/next-in-business/finansal.json', '1630');
fetchContent('dosyalar/next-in-business/vergi.json', '2734');
fetchContent('dosyalar/next-in-business/avukat.json', '3123');


// form 
function next_kayit_form_gonder()
{var query=$('#contact-form').serialize();var header=" Lütfen Bilgilerinizi Eksiksiz Doldurunuz. <br/>";var message="";var gsm_check=$('#gsm').val();var gsmLength=gsm_check.length;var email=$('#email').val();if($('#adsoyad').val()==""){message=message+"* Ad Soyad giriniz.<br/>";$('#adsoyad').focus();}
    if($('#unvan').val()==""){message=message+"* Unvan giriniz.<br/>";$('#unvan').focus();}
    if($('#firma_adi').val()==""){message=message+"* Firma adı giriniz.<br/>";$('#firma_adi').focus();}
    if($('#gsm').val()==""){message=message+"* Cep telefonu numarası giriniz.<br/>";$('#gsm').focus();}else if(gsmLength<11){message=message+"* Cep telefonu numarası eksiksiz giriniz.<br/>";$('#gsm').focus();}
    if($('#email').val()==""){message=message+"* E-mail adresi giriniz.<br/>";$('#email').focus();}else if(!mailKontrol(email)){message=message+"* Lütfen geÃ§erli bir E-mail adresi giriniz.<br/>";$('#email').focus();}
    var checkboxes = document.querySelectorAll('input[name="program[]"]:checked').length;
    if(checkboxes === 0){
        message=message+"* En az bir program seçiniz.<br/>";
    }
    var aydinlatmaMetni = document.querySelectorAll('input[name="aydinlatma"]:checked').length;
    if(aydinlatmaMetni === 0){
        message=message+"* Aydınlatma metnini onaylayınız.<br/>";
    }
    var faturaValue=document.getElementsByName('fatura-turu');for(i=0;i<faturaValue.length;i++){if(faturaValue[i].checked)
    var radioValue=faturaValue[i].value;}
    if(radioValue==1){var tc_check=$('#tc_no').val();var tcLength=tc_check.length;if($('#fatura_adsoyad').val()==""){message=message+"* Fatura adı giriniz.<br/>";$('#fatura_adsoyad').focus();}
        if($('#tc_no').val()==""){message=message+"* T.C. kimlik numarası giriniz.<br/>";$('#tc_no').focus();}else if(tcLength<11){message=message+"* T.C. kimlik numarasını eksiksiz giriniz.<br/>";$('#tc_no').focus();}}else{var vergi_check=$('#vergi_no').val();var vergiLength=vergi_check.length;if($('#firma_unvani').val()==""){message=message+"* Fatura firma ünvanı giriniz.<br/>";$('#firma_unvani').focus();}
        if($('#vergi_dairesi').val()==""){message=message+"* Vergi dairesi giriniz.<br/>";$('#vergi_dairesi').focus();}
        if($('#vergi_no').val()==""){message=message+"* Vergi numarası giriniz.<br/>";$('#vergi_no').focus();}else if(vergiLength<10){message=message+"* Vergi numarasını eksiksiz giriniz.<br/>";$('#vergi_no').focus();}}
    if($('#adres').val()==""){message=message+"* Fatura adresi giriniz.<br/>";$('#adres').focus();}
    if(message!=""){$('.formMessage').html("<div class=\"alert alert-warning\"><strong>Uyarı!</strong>"+header+message+"</div>");$("html, body").animate({scrollTop:$('#kayit-formu').offset().top},800);}else{$.ajax({type:'POST',url:'dosyalar/dahili/send_form.php',data:query,success:function(cevap)
        {$('.formMessage').html(cevap);}}).done(function(){$("html, body").animate({scrollTop:$('#kayit-formu').offset().top},800);});}}


$("#bireyselCheck").click(function () {
    $("#bireysel").show();
    $("#kurumsal").hide();
});

$("#kurumsalCheck").click(function () {
    $("#bireysel").hide();
    $("#kurumsal").show();
});