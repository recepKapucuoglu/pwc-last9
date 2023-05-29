<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Üyeler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Üye Listesi</span></li>
			</ol>
		</div>
	</header>
	<!-- hızlı arama -->
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Üye Filtreleme
			
			</h2>
		</header>
		<div class="card-body">
			<form id="quicksearch" method="post" onsubmit="return uye_search();">
				<input type="hidden" name="talepTipi" value="1"> 
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<label for="">
							Kayıt Tarih Aralığı<br>
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
					<div class="col-md-3 col-sm-6">
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
									<input type="text" name="email" class="form-control" placeholder="E-mail" />
								</div>
							</label>
						</label>
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="">&nbsp;<br>
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-search"></i> Sonuçları Listele</button><br/><br/>
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
				<form name="slideForm" action="uye_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Üye Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Kayıt Tarih</th>
										<th>Ad Soyad</th>
										<th>Unvan</th>
										<th>E-mail</th>
										<th>Telefon</th>
										<th>Şirket Adı</th>
									</tr>
								</thead>
								<tbody>
									<?php
										
										$db->orderBy("id","desc");
										$results = $db->get('web_user',array(0,500));
										foreach ($results as $value) {
											$i++;
									?>
									<tr onclick="window.location.href = 'uye_detay.php?id=<?php echo $value['id']; ?>';"> 
										<td><?php echo $i; ?></td>
										<td><?php echo date2Human($value['created_date']); ?></td>
										<td><?php echo $value['fullname']; ?></td>
										<td><?php echo $value['title']; ?></td>
										<td><?php echo $value['email']; ?></td>
										<td><?php echo $value['phone']; ?></td>
										<td><?php echo $value['company']; ?></td>
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
