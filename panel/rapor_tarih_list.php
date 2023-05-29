<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Raporlama ve Kayıtlar</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitim Tarihine Göre</span></li>
			</ol>
		</div>
	</header>
	<!-- hızlı arama -->
	<div class="row">
		<div class="col-md-12">
			<section class="card">
				<form name="slideForm" action="siparis_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Eğitim Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
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
										$results = $db->get('education_calender_list');
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
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</section>
			

<?php include('_footer.php'); ?>	
<script>
function islem_excel()
{
	var query = $('#quicksearch').serialize();

	window.location = 'siparis_excel.php?'+query; 
	
	return false;
}

function islem_detay_excel()
{
	var query = $('#quicksearch').serialize();

	window.location = 'siparis_detay_excel.php?'+query; 
	
	return false;
}
</script>		