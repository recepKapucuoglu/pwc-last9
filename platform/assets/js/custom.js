$(document).ready(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red'
	});
	
	$("input[name='fatura-turu']").on('ifChecked', function(event){
	  
		var radioValue = $(this).val();
		if(radioValue==1){
			$("#bireysel").css("display","block"); 
			$("#kurumsal").css("display","none"); 
			
		} else {
			$("#bireysel").css("display","none");
			$("#kurumsal").css("display","block"); 
		}
	});
	
	$("input[name='alumni']").on('ifChecked', function(event){
	  
		var radioValue = $(this).val();
		if(radioValue==1){
			$("#ayrilma").css("display","block"); 
		} else {
			$("#ayrilma").css("display","none"); 
		}
	});
	
	if($('#adet').val() > 1){
		var toplam_katilim = $('#adet').val();
		// Katılımcı Döngüsü
		for(katilim_dongu = 2; katilim_dongu <= toplam_katilim; katilim_dongu++) {
			$("input[name='katilimci_alumni["+katilim_dongu+"]']").on('ifChecked', function(event){
				var element_id = $(this).attr('id');
				var ix = element_id.substring(element_id.length - 1)
				var radioValue = $(this).val();
				if(radioValue==1){
					$("#ayrilma_"+ix).css("display","block"); 
					
				} else {
					$("#ayrilma_"+ix).css("display","none"); 
				}
				
			});
			
		}
	}
});