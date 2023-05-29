<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dashboard</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.html">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
		</div>
	</header>
	
	<div class="row pt-4 mt-1">
	<?php
	
	// $should_change = shouldChangePassword($_SESSION['useradmin']);
	// $should_change[1] = $should_change[1]->format('d-m-Y H:i:s');
	// if($should_change[0])
	// {
	// 	echo '<div class="col-12 alert alert-danger">Şifrenizi en son ' . $should_change[1] . ' tarihinde güncellediniz, lütfen güvenliğiniz için şifrenizi yenileyin.</div>';
	// }
	?>
		<div class="col-xl-12">
			<section class="card">
				<header class="card-header card-header-transparent">
					<div class="card-actions">
						<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
						<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
					</div>
	
					<h2 class="card-title">Yaklaşan Eğitimler</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped mb-0">
						<thead>
							<tr>
								<th>#</th>
								<th>Tarih</th>
								<th>Eğitim Adı</th>
								<th>Şehir</th>
								<th>Durum</th>
								<th>Doluluk</th>
								<th>Katılımcı Sayısı</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i=0;
								$db->where('durum', 1);
								$db->where('egitim_tarih',$dateToday,'>=');
								$db->orderBy("egitim_tarih","asc");
								$results = $db->get('education_calender_list',array(0,10));
								foreach ($results as $value) {
									$i++;
									
									
									$db->where('edu_cal_id', $value['id']);
									$egitimKatilimSayisi = $db->getValue ('education_order_person_list', "count(id)");
									$egitimKatilimOran = $egitimKatilimSayisi / $value['katilimci_sayisi'] * 100;
									
									if($egitimKatilimOran<11){
										$uyariText = "<span class=\"badge badge-danger\">Kritik Katılım</span>";
									} else if($egitimKatilimOran<100){
										$uyariText = "<span class=\"badge badge-warning\">Yeterli Katılım</span>";
									} else if($egitimKatilimOran==100){
										$uyariText = "<span class=\"badge badge-success\">Kontenjan Doldu</span>";
									} else {
										$uyariText = "<span class=\"badge badge-danger\">Kritik Kontenjan</span>";
										
									}
							?>
							<tr onclick="window.location.href = 'siparis_list.php?id=<?php echo $value['id']; ?>';">
								<td><?php echo $i; ?></td>
								<td><?php echo date2Human($value['egitim_tarih']); ?></td>
								<td><?php echo $value['egitim_adi']; ?></td>
								<td><?php echo $value['sehir_adi']; ?></td>
								<td><?php echo $uyariText; ?></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-0 mt-1 light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="padding-left:10px; width: <?php echo $egitimKatilimOran; ?>%;">
											<?php echo round($egitimKatilimOran,2); ?>%
										</div>
									</div>
								</td>
								<td><?php echo $egitimKatilimSayisi; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-5 mb-3">
			<section class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-xl-12">
							<div class="chart-data-selector" id="salesSelectorWrapper">
								<h2>
									Son 6 Aylık Eğitim Analizi:
									<strong>
										<select class="form-control" id="salesSelector">
											<option value="Rakamsal" selected>Satılan Eğitim (Fiyat)</option>
											<option value="Adetsel" >Satılan Eğitim (Adet)</option>
										</select>
									</strong>
								</h2>
	
								<div id="salesSelectorItems" class="chart-data-selector-items mt-3">
									<!-- Flot: Sales Porto Admin -->
									<div class="chart chart-sm" data-sales-rel="Rakamsal" id="flotDashSales1" class="chart-active" style="height: 203px;"></div>
									<script>
	
										var flotDashSales1Data = [{
											data: [
												["<?php echo $chartRowTutar['ay'][1]; ?>", <?php echo $chartRowTutar[1]; ?>],
												["<?php echo $chartRowTutar['ay'][2]; ?>", <?php echo $chartRowTutar[2]; ?>],
												["<?php echo $chartRowTutar['ay'][3]; ?>", <?php echo $chartRowTutar[3]; ?>],
												["<?php echo $chartRowTutar['ay'][4]; ?>", <?php echo $chartRowTutar[4]; ?>],
												["<?php echo $chartRowTutar['ay'][5]; ?>", <?php echo $chartRowTutar[5]; ?>],
												["<?php echo $chartRowTutar['ay'][6]; ?>", <?php echo $chartRowTutar[6]; ?>]
											],
											color: "#d04a22"
										}];
	
										// See: js/examples/examples.dashboard.js for more settings.
	
									</script>
	
									<!-- Flot: Sales Porto Drupal -->
									<div class="chart chart-sm" data-sales-rel="Adetsel" id="flotDashSales2" class="chart-hidden"></div>
									<script>
	
										var flotDashSales2Data = [{
											data: [
											
												["<?php echo $chartRow['ay'][1]; ?>", <?php echo $chartRow[1]; ?>],
												["<?php echo $chartRow['ay'][2]; ?>", <?php echo $chartRow[2]; ?>],
												["<?php echo $chartRow['ay'][3]; ?>", <?php echo $chartRow[3]; ?>],
												["<?php echo $chartRow['ay'][4]; ?>", <?php echo $chartRow[4]; ?>],
												["<?php echo $chartRow['ay'][5]; ?>", <?php echo $chartRow[5]; ?>],
												["<?php echo $chartRow['ay'][6]; ?>", <?php echo $chartRow[6]; ?>]
											],
											color: "#2baab1"
										}];
	
										// See: js/examples/examples.dashboard.js for more settings.
	
									</script>
	
								</div>
	
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="col-lg-7">
			<div class="row mb-3">
				<div class="col-xl-6">
					<section class="card card-featured-left card-featured-tertiary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-tertiary">
										<i class="fa fa-shopping-cart"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Alınan Eğitim</h4>
										<div class="info">
											<strong class="amount"><?php echo $totalSatinAlma['total']; ?></strong>
											<span class="text-tertiary">(<?php echo $totalSatinAlma['today']; ?> Bugün)</span>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="siparis_list.php">(Tümünü Göster)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
					
				</div>
				<div class="col-xl-6">
					<section class="card card-featured-left card-featured-secondary">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-secondary">
										<i class="fa fa-try"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Toplam Alınan Eğitim</h4>
										<div class="info">
											<strong class="amount"><?php echo number_format($toplam_egitim_tutar,2,".",","); ?> TL</strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="siparis_list.php">(Tümünü Göster)</a>
									</div>
								</div>
								
							</div>
							<hr>
								<br>
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-secondary">
										<i class="fa fa-try"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Toplam Ödenen Eğitim</h4>
										<div class="info">
											<strong class="amount"><?php echo number_format($toplam_egitim_tutar_odenen,2,".",","); ?> TL</strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="siparis_list_odenenler.php">(Tümünü Göster)</a>
									</div>
								</div>
								
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<section class="card card-featured-left card-featured-primary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-primary">
										<i class="fa fa-life-ring"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Toplam Bilgi Talebi</h4>
										<div class="info">
											<strong class="amount"><?php echo $totalBilgi['total']; ?></strong>
											<span class="text-primary">(<?php echo $totalBilgi['today']; ?> Bugün)</span>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="talep_list.php">(Tümünü Göster)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-xl-6">
					<section class="card card-featured-left card-featured-quaternary">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-quaternary">
										<i class="fa fa-graduation-cap"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Eğitimler</h4>
										<div class="info">
											<strong class="amount"><?php echo $egitimSayisi['total']; ?></strong>
											<span class="text-quaternary">(<?php echo $egitimSayisi['aktif']; ?> Aktif Eğitim)</span>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="egitim_list.php">(Tümünü Göster)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row pt-4">
		<div class="col-lg-6">
			
			<section class="card card-transparent">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
						<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
					</div>
	
					<h2 class="card-title">Eğitim Talebi İstatistikleri</h2>
				</header>
				<div class="card-body">
					<section class="card">
						<div class="card-body">
							<div class="small-chart float-right" id="sparklineBarDash"></div>
							<script type="text/javascript">
								var sparklineBarDashData = [5, 16, 24, 17, 10, 28, 12, 8, 21, 17, 20, 12];
							</script>
							<div class="h4 font-weight-bold mb-0"><?php echo $bilgiTalebi['sirket']; ?></div>
							<p class="text-3 text-muted mb-0">Şirketlere Özel Eğitim Talebi</p>
						</div>
					</section>
					<section class="card">
						<div class="card-body">
							<div class="circular-bar circular-bar-xs m-0 mt-1 mr-4 mb-0 float-right">
								<div class="circular-bar-chart" data-percent="<?php echo $aktifEgitimKatilim['oran']; ?>" data-plugin-options='{ "barColor": "#2baab1", "delay": 300, "size": 50, "lineWidth": 4 }'>
									<strong>Average</strong>
									<label><span class="percent"><?php echo $aktifEgitimKatilim['oran']; ?></span>%</label>
								</div>
							</div>
							<div class="h4 font-weight-bold mb-0"><?php echo $aktifEgitimKatilim['toplam_talep']; ?></div>
							<p class="text-3 text-muted mb-0">Aktif Eğitimlerin Katılım Oranı</p>
						</div>
					</section>
					<section class="card">
						<div class="card-body">
							<div class="small-chart float-right" id="sparklineLineDash"></div>
							<script type="text/javascript">
								var sparklineLineDashData = [15, 16, 17, 19, 10, 15, 13, 12, 12, 14, 16, 17];
							</script>
							<div class="h4 font-weight-bold mb-0"><?php echo $bilgiTalebi['egitim']; ?></div>
							<p class="text-3 text-muted mb-0">Eğitim Bilgi Talebi</p>
						</div>
					</section>
				</div>
			</section>

		</div>
		<div class="col-lg-6 mb-4 mb-lg-0">
			
			<div class="timeline">
					<div class="tm-body">
						<div class="tm-title">
							<h5 class="m-0 pt-2 pb-2 text-uppercase"><?php echo $chartRow['ay'][6]; ?></h5>
						</div>
						
						<ol class="tm-items">
							<?php
								$buay = intval(date('m'));
								if($buay<10)
									$buay = "0".$buay;
								$buyil = intval(date('Y'));
								 
								$i=0;
								$animation_delay = 0;
								$buay_baslangic = $buyil."-".$buay."-01";
								$buay_bitis = $buyil."-".$buay."-31";
								$db->where('egitim_tarih',$dateToday,'>=');
								$db->where ('egitim_tarih', $buay_bitis, "<=");
								$resultsCalender = $db->get('education_calender_list');
								foreach ($resultsCalender as $valueCalender) {
									$i++;
										$animation_delay = $animation_delay + 100;
							?>
							<li>
								<div class="tm-info">
									<div class="tm-icon"><i class="fa fa-star"></i></div>
									<time class="tm-datetime" datetime="2017-11-22 19:13">
										<div class="tm-datetime-date"><?php echo date2Human($valueCalender['egitim_tarih']); ?></div>
										<div class="tm-datetime-time"><?php echo substr($valueCalender['baslangic_saat'],0,5); ?></div>
								</time>
								</div>
								<div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="<?php echo $animation_delay; ?>">
									<p>
										<?php echo $valueCalender['egitim_adi']; ?>
									</p>
									<div class="tm-meta">
										<span>
											<i class="fa fa-user"></i> Katılımcı <a target="_blank" href="siparis_list.php?id=<?php echo $valueCalender['id']; ?>"><?php echo $valueCalender['satin_alma']; ?></a>
										</span>
										<span>
											<i class="fa fa-life-ring"></i> Bilgi Talebi <a target="_blank" href="talep_list.php?id=<?php echo $valueCalender['id']; ?>"><?php echo $valueCalender['kayit']; ?></a>
										</span>
										<span>
											<i class="fa fa-map-marker"></i> <?php echo $valueCalender['sehir_adi']; ?>
										</span>
									</div>
								</div>
							</li>
							<?php } ?>
							
						
						</ol>
					
					</div>
				</div>
		</div>
		
	</div>
	
	
	
</section>
<?php include('_footer.php'); ?>