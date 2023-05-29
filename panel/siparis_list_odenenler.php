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
				<li><span>Katılımcı Listesine Göre</span></li>
			</ol>
		</div>
	</header>
	<!-- hızlı arama -->
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Talep Filtreleme
			
			</h2>
		</header>
		<div class="card-body">
			<form id="quicksearch" method="post" onsubmit="return siparis_search();">
				<input type="hidden" name="ozel_id" value="<?php echo $_GET['id']; ?>"> 
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<label for="">
							Tarih Aralığı<br>
							<label for="" class="w50">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-calendar"></i></span>
									</span>
									<input type="text" name="tarih_bas" data-plugin-datepicker class="form-control"/>
								</div>
							</label>
							<label for="" class="w50">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-calendar"></i></span>
									</span>
									<input type="text" name="tarih_son" data-plugin-datepicker class="form-control"/>
								</div>
							</label>
						</label>
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="">Eğitim Seçiniz<br/>
								<select data-plugin-selectTwo  class="form-control"  data-placeholder="Eğitim Seçiniz" id="egitim" name="edu_id">
									<option value=""></option> 
									<option value="0">Tümünü Göster</option>
									<?php
										$db->orderBy("baslik","asc");
										$results = $db->get('education');
										foreach ($results as $value) {
											echo "<option ".$selected." value=\"".$value['id']."\">".$value['baslik']."</option>";
										}
									?>
								</select>
						</label>
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="">
							Şirket Adı<br>
							<label for="">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-building"></i></span>
									</span>
									<input type="text" name="sirket" class="form-control" placeholder="Şirket Adı" />
								</div>
							</label>
						</label>
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="">
							Ad Soyad<br>
							<label for="">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-user"></i></span>
									</span>
									<input type="text" name="adsoyad" class="form-control" placeholder="Ad Soyad" />
								</div>
							</label>
						</label>
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="">
							E-mail<br>
							<label for="">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-envelope"></i></span>
									</span>
									<input type="text" name="email" class="form-control" placeholder="Email" />
								</div>
							</label>
						</label>
					</div>
					
					<div class="col-md-1 col-sm-6">
						<label for="">&nbsp;<br>
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-search"></i> Listele</button><br/><br/>
						</label>
					</div>
				</div>
			</form>
		</div>
	</section>
	<br/>
	<div class="row">
		<div class="col-md-12">
			<section class="card">
				<form name="slideForm" action="siparis_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a data-placement="top" data-toggle="tooltip" title="Listeyi Excel'e Aktar" onclick="islem_excel();" href="javascript:void();" class="fa fa-file-excel-o"></a>
						<a data-placement="top" data-toggle="tooltip" title="Detaylı Listeyi Excel'e Aktar" onclick="islem_detay_excel();" href="javascript:void();" class="fa fa-file-excel-o"></a>
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Katılımcı Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Tarih</th>
										<th>Eğitim Adı</th>
										<th>Eğitim Tarihi</th>
										<th>Fatura Adı</th>
										<th>Ad Soyad</th>
										<th>Email</th>
										<th>Telefon</th>
                                        <th>Odenen Tutar</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										if(intval($_GET['id'])<>"")
											$db->where("edu_cal_id", intval($_GET['id']));
                                            $db->where('odenen_tutar','null','!=');
                                            $db->where('odenen_tutar','','!=');
                                            $db->orderBy("id","desc");
										$results = $db->get('education_order_person_list',array(0,2000));
										foreach ($results as $value) {
											$i++;
									?>
									<tr onclick="window.location.href = 'siparis_detay.php?id=<?php echo $value['order_id']; ?>';"> 
										<td><?php echo $i; ?></td>
										<td><?php echo date2Human($value['kayit_tarihi']); ?></td>
										<td><?php echo $value['egitim_adi']; ?></td>
										<td><span class="badge badge-warning"><?php echo date2Human($value['egitim_tarih']); ?></span></td>
										<td><?php echo $value['fatura_adi']; ?></td>
										<td><?php echo $value['adsoyad']; ?></td>
										<td><?php echo $value['email']; ?></td>
										<td><?php echo $value['telefon']; ?></td>
                                        <td><?php echo $value['odenen_tutar']; ?></td>
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