</div>
</section>

<!-- Vendor -->
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="vendor/popper/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script src="vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script type='text/javascript' src='vendor/jquery-maskedinput/jquery.maskMoney.js'></script>
<script src="vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="vendor/common/common.js"></script>
<script src="vendor/nanoscroller/nanoscroller.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="vendor/jquery-ui/jquery-ui.js"></script>
<script src="vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="vendor/jquery-appear/jquery-appear.js"></script>
<script src="vendor/select2/js/select2.js"></script>
<script src="vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="vendor/flot/jquery.flot.js"></script>
<script src="vendor/flot.tooltip/flot.tooltip.js"></script>
<script src="vendor/flot/jquery.flot.pie.js"></script>
<script src="vendor/flot/jquery.flot.categories.js"></script>
<script src="vendor/flot/jquery.flot.resize.js"></script>
<script src="vendor/jquery-sparkline/jquery-sparkline.js"></script>
<script src="vendor/raphael/raphael.js"></script>
<script src="vendor/ckeditor/ckeditor.js"></script>
<script src="vendor/morris/morris.js"></script>
<script src="vendor/gauge/gauge.js"></script>
<script src="vendor/snap.svg/snap.svg.js"></script>
<script src="vendor/liquid-meter/liquid.meter.js"></script>
<script src="vendor/jqvmap/jquery.vmap.js"></script>
<script src="vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script src="vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
<script src="vendor/ios7-switch/ios7-switch.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Theme Custom -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<!-- Examples -->
<script src="js/examples/examples.dashboard.js"></script>
<script>



	$('.ajax-popup-link').magnificPopup({
		type: 'ajax'
	});
	showLoader = function () {
		$('.loaderWrapper').fadeIn()
	}
	hideLoader = function () {
		$('.loaderWrapper').fadeOut()
	}
	$(".amount_mask").maskMoney({ thousands: '', decimal: '.', allowZero: true, suffix: ' TL' });

	function egitim_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'egitim_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function eski_egitim_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'eski_egitim_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function icerik_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'icerik_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function blog_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'blog_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function talep_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'talep_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function uye_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'uye_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function siparis_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'siparis_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function form_bulten() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'bulten_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function form_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'form_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function bayi_search() {
		var query = $('#quicksearch').serialize();
		showLoader();
		$.ajax({
			type: 'POST',
			url: 'bayi_talep_arama.php',
			data: query,
			success: function (cevap) {
				$('#islemList').html(cevap);
			}
		}).done(function () {
			hideLoader();
		});
		return false;
	}
	function createSEOLink(link) {
		var trMap = {
			'çÇ': 'c',
			'ğĞ': 'g',
			'şŞ': 's',
			'üÜ': 'u',
			'ıİ': 'i',
			'öÖ': 'o'
		};

		for (var key in trMap) {
			link = link.replace(new RegExp('[' + key + ']', 'g'), trMap[key]);
		}
		return link.replace(/[^-a-zA-Z0-9\s]+/ig, '')
			.replace(/\s/gi, "-")
			.replace(/[-]+/gi, "-")
			.toLowerCase();
	}
	function url_generator() {
		var url_adres = $('#url_generator').val();
		var new_url_adres = createSEOLink(url_adres);
		$('#seo_url').val(new_url_adres);
	}

	$(".url_change").change(function () {

		var dataEgitim = $('#egitim').select2('data');
		const str = dataEgitim[0].id;
		const regex = /type_id=(\d+)/;
		const match = str.match(regex);
		console.log(match);
		if (match) { //type_id varsa
			console.log("type id var = " + match[1]);

			type_id = match[1];
			if (match[1] === '3') { //type_id=3 ise / elearning eğitimi ise
				$('.gizleelearning').hide();
				$('input[name="egitim_tarih"]').attr('required', false);
				$('input[name="baslangic_saat"]').attr('required', false);
				$('input[name="bitis_saat"]').attr('required', false);

				//unique seourl oluşturma
				var today = new Date();
				var day = today.getDate().toString().padStart(2, '0');
				var month = (today.getMonth() + 1).toString().padStart(2, '0');
				var year = today.getFullYear().toString();
				var currentDate = day + '.' + month + '.' + year;
				var hour = Math.floor(Math.random() * 24).toString().padStart(2, '0');
				var minute = Math.floor(Math.random() * 60).toString().padStart(2, '0');
				var time = hour + ':' + minute;
				//unique için mixleyelim
				var url_adres = dataEgitim[0].text + '-' + currentDate + '-' + time;
				var new_url_adres = createSEOLink(url_adres);
				$('#seo_url').val(new_url_adres);

			}

		} else { //diğer eğitimler ise / type_id null ise 
			type_id = null;
			$('.gizleelearning').show();
			$('input[name="egitim_tarih"]').attr('required', true);
			$('input[name="baslangic_saat"]').attr('required', true);
			$('input[name="bitis_saat"]').attr('required', true);

			//unique seourl oluşturalım
			var url_adres = dataEgitim[0].text + '-' + $("input[name='egitim_tarih']").val() + '-' + $("input[name='baslangic_saat']").val();
			var new_url_adres = createSEOLink(url_adres);
			$('#seo_url').val(new_url_adres);
		}
	});


</script>
</body>

</html>