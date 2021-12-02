<!-- Header BEGIN -->
<div class="header header-mobi-ext">
	<div class="container">
		<div class="row">
			<!-- Logo BEGIN -->
			<div class="col-md-3 col-sm-3 padding-top-10">
				<div class="row">
					<div class="col-md-12">
						<span class="text-white text-uppercase"><?php echo lang('precio_desde') ?>:</span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-border-bottom" style="width: auto !important;">
						<span class="text-black text-price"><?php echo $default_room['precio'] ?></span><span class="text-white text-price text-uppercase"> / <?php echo lang('noche') ?></span>
					</div>
				</div>
			</div>
			<!-- Logo END -->
			<a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
			<!-- Navigation BEGIN -->
			<div class="col-md-9 pull-right">
				<div class="row">
					<div class="col-md-10">

					</div>
					<div class="col-md-2 padding-top-20">
						<?php $nombre_alojamiento = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$default_room['tipo']['id'],$default_room['tipo']['nombre_habitacion']); ?>
						<a class="btn circle btn-default-booking" href="<?php echo trans('ruta_reservar_alojamiento_habitacion',array('nombre'=>url_title($nombre_alojamiento),'id'=>$default_room['tipo_habitacion_fk'])) ?>"><?php echo lang('reservar') ?></a>
					</div>
				</div>
			</div>
			<!-- Navigation END -->
		</div>
	</div>
</div>
<!-- Header END -->