<?php include('dosyalar/dahili/header-dashboard.php');?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay favorilerim-sayfasi">
						<div class="sectionbaslik">Favorilerim</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="listeler">
									<?php for($i=0;$i<10;$i++){ ?>
									<?php include('dosyalar/dahili/egitimkutu-tip2.php');?>
									<?php } ?>
								</div>
							</div>
						</div>
						
					</section>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>