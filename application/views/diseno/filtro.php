<div class="golden_bg">
  <div id="header_top" class="relative center" > 
    <div id="logo_Nacional"></div>
    <div id="logo_GranCaribe"></div>
  <!--<div class="log_products golden_drk_bg">
      <a id="room" title="Alojamiento" href="#" class="active room linkp"><div></div><span>Alojamiento</span></a>          
      <a id="event" title="Eventos" href="#" class="event_d linkp"><div></div><span>Evento</span></a>
      <a id="restaurant" title="Restaurantes" href="#" class="restaurant_d linkp"><div></div><span>Restaurante</span></a>
      <a id="bar" title="Bares" href="#" class="bar_d linkp"><div></div><span>Bar</span></a>-->
    <div class="log_products golden_drk_bg"> 
       <?php $padd = (!isset($subtitle) || $subtitle == '')?' class="padd_plus"':'class="padd0"';?>  
      <h1 <?php print $padd; ?> ><?php print (isset($title))?$title:'';?></h1>
      <h2><?php print (isset($subtitle))?$subtitle:'';?></h2>
    </div>    
  </div>
</div>  