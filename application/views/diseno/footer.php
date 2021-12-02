<!-- Testimonials block BEGIN -->
<div class="testimonials-block content content-center margin-bottom-60" id="contact">
	<div class="container">
		<h2><?php echo lang('localizacioncontacto') ?></h2>
	</div>
</div>
<div class="testimonials-block-map padding-top-30">
	<div class="container">
		<div class="row">
			<div class="col-md-3 bg-white padding-bottom-40">

				<h3><?php print app_nombre_sistema(); ?></h3>

				<?php echo lang('tipo'); ?>: <?php echo lang('hoteles'); ?><br>

				<?php echo lang('categoria'); ?>: <?php echo lang('5estrellas'); ?><br>

				<h5 class="text-uppercase"><?php echo lang('contacto'); ?></h5>

				<?php echo lang('telefono'); ?>: <?php echo $telefono['value'] ?><br>

				<?php echo lang('fax'); ?>:<?php echo $faxhotel['value'] ?><br>

				<h5 class="text-uppercase"><?php echo lang('direccion'); ?>:</h5>

				<?php echo $direccion['value'] ?><br><br>

				<h6>Check - in:   16:00</h6>

				<h6>Check - out: 12:00</h6>

			</div>
		</div>
	</div>
</div>
<!-- Testimonials block END -->

<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				foreach($redes_sociales as $r)
				{ ?>
					<a style="background: url('<?php echo app_url_admin().('/admin/redes/'.$r['icono_footer']) ?>') no-repeat;" class="social-icon social-icon-color circle" target="_blank" title="<?php echo $r['descripcion'] ?>" href="<?php echo $r['url'] ?>">
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="container">
		<div class="row">
			<!-- BEGIN COPYRIGHT -->
			<div class="col-md-9 col-sm-9 pull-right">
				<?php
				$menu_footer = app_menu_footer();
				foreach($menu_footer as $m)
				{
					$titulo = $m['titulo_trad'] != null ? $m['titulo_trad'] : $m['titulo'];
					$url = $m['url'];
					if($m['url'])
						$url = $m['url'];
					else
						$url = app_parse(trans('ruta_informacion'),array('titulo'=>url_title($titulo)));
					?>
					|
					<a href="<?php echo base_url($url) ?>"><?php echo $titulo ?></a>
				<?php } ?>
			</div>
			<!-- END COPYRIGHT -->
			<!-- BEGIN SOCIAL ICONS -->
			<div class="col-md-3 col-sm-3">
				<div class="copyright"><?php echo lang('derechos') ?></div>
			</div>
			<!-- END SOCIAL ICONS -->
		</div>
	</div>
</div>
<!-- END FOOTER -->
<a href="#promo-block" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>


<?php echo $form_login; echo $form_registro; ?>


<!--[if lt IE 9]>
<script src="web/assets/global/plugins/respond.min.js"></script>
<![endif]-->
<!-- Load JavaScripts at the bottom, because it will reduce page load time -->
<!-- Core plugins BEGIN (For ALL pages) -->
<script src="web/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="web/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="web/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Core plugins END (For ALL pages) -->
<!-- BEGIN RevolutionSlider -->
<script src="web/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="web/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="web/assets/frontend/onepage/scripts/revo-ini.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->
<!-- Core plugins BEGIN (required only for current page) -->
<script src="web/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="web/assets/global/plugins/jquery.easing.js"></script>
<script src="web/assets/global/plugins/jquery.parallax.js"></script>
<script src="web/assets/global/plugins/jquery.scrollTo.min.js"></script>
<script src="web/assets/frontend/onepage/scripts/jquery.nav.js"></script>
<!-- Core plugins END (required only for current page) -->
<!-- Global js BEGIN -->
<script src="web/assets/frontend/onepage/scripts/layout.js" type="text/javascript"></script>

<script src="javascript/js_general.min.js" type="text/javascript"></script>
<script>

	$(document).ready(function() {
		Layout.init();
	});
</script>
<!-- Global js END -->

<script language="javascript">
	jQuery(function($){

		window.alert = function (message, title, buttonText) {

			buttonText = (buttonText == undefined) ? "Aceptar" : buttonText;
			title = (title == undefined) ? "Alerta" : title;

			var div = $('<div>');
			div.html(message);
			div.attr('title', title);
			div.dialog({
				dialogClass: "fixed",
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				position: ['center','center'],
				zIndex: 100000,
				buttons: [{
					text: buttonText,
					click: function () {
						$(this).dialog("close");
						div.remove();
					}
				}]
			});

			$(window).resize(function(){
				div.dialog( 'option', 'position', 'center' );
			});
			$(window).scroll(function(){
				div.dialog( 'option', 'position', 'center' );
			});
		}
	});
</script>


<?php if (defined('ENVIRONMENT') && ENVIRONMENT == 'production') { ?>
	<script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-90944409-1', 'auto');
		ga('send', 'pageview');

	</script>

	<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 861553772;
		var google_custom_params = window.google_tag_params;
		var google_remarketing_only = true;
		/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
		<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/861553772/?guid=ON&amp;script=0"/>
		</div>
	</noscript>

	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window,document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '598423823687322');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1"
			 src="https://www.facebook.com/tr?id=598423823687322&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
<?php } ?>