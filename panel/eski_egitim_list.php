<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eski Eğitimler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eski Eğitim Listesi</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Eski Eğitim Filtreleme
			
			</h2>
		</header>
		<div class="card-body">
			<form id="quicksearch" method="post" onsubmit="return eski_egitim_search();">
				<div class="row">
					
					<div class="col-md-3 col-sm-6">
						<label for="">Kategori Seçiniz<br/>
								<select data-plugin-selectTwo class="form-control populate" name="kategori">
									<option value="0">Tümünü Göster</option>
									<?php
										$db->orderBy("edu_cat_name","asc");
										$results = $db->get('eski_education_category');
										foreach ($results as $value) {
											echo "<option value=\"".$value['edu_cat_id']."\">".$value['edu_cat_name']."</option>";
										}
									?>
								</select>
						</label>
					</div>
					<div class="col-md-3 col-sm-6">
						<label for="">
							Eğitim Adı<br>
							<label for="">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-building"></i></span>
									</span>
									<input type="text" name="baslik" class="form-control" placeholder="Eğitim Adı" />
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

			<section class="card card-featured card-featured-primary">
				
				<form name="slideForm" action="eski_egitim_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Eski Eğitim Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Kategori</th>
										<th>Başlık</th>
										<th>Tarihi</th>
										<th style="width: 130px;"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("edu_id","desc");
										$results = $db->get('eski_education_list');
										foreach ($results as $value) {
											$i++;
						
											
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $value['edu_cat_name']; ?> </td>
										<td><?php echo $value['edu_name']; ?> </td>
										<td><?php echo $value['edu_createdate']; ?> </td>
										<td align="right">
											<a data-placement="top" data-toggle="tooltip" title="Eğitim Göster" href="eski_egitim_edit.php?id=<?php echo $value['edu_id']; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
										</td>	
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