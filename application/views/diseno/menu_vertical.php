<div class="blog-sidebar">
	<ul class="nav sidebar-categories">
		<?php
		foreach($items as $key=>$item)
		{
			if($item['url']!=='')
			{

				if($key == $item_activo) {
					print '<li class="active">';
					print '<a title="' . $item['titulo'] . '">';
					print $item['titulo'];
					print '</a>';
				}
				else {
					print '<li>';
					print '<a title="' . $item['titulo'] . '" href="' . $item['url'] . '">';
					print $item['titulo'];
					print '</a>';
				}
				print '</li>';
			}
		}
		?>
	</ul>
</div>
