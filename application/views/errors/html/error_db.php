<!DOCTYPE html>
<html lang="en">
<head>
<title><?php (ENVIRONMENT != 'production') ? print("Database Error") : print("Hotel Nacional de Cuba") ;?> </title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
<link rel="stylesheet" href="css/style_general.css"  type="text/css" />
</head>
<body>
	<?php if(ENVIRONMENT != 'production'){ ?>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
	<?php } else { ?>
	<div style="position: relative; margin: 0px auto; background-color: #000; width: 100%; height:168px">
		<div id="logo_Nacional" style="left: 0px !important;"></div>
	</div>
	<div style="position: relative; margin: 0px auto;  width: 100%; height:168px; border: 1px solid #000;">
		<div style="margin: 40px; font-size:24px;">El portal web se encuentra temporalmente fuera de servicio, disculpe las molestias ocasionadas.</div>
	</div>
	<?php } ?>
	
</body>
</html>
<?php
   //require_once(APPPATH . '/libraries/Send_mail.php');
   //$mail = new Send_Mail();

   //$mail->_send_email('Nacional', 'noreply@hotelnacional.cu', 'roll3lg@gmail.com', $heading, $message);

   //$mail->_send_email('Nacional', 'noreply@hotelnacional.cu', 'posicionamientoweb@bidaiondo.com', $heading, $message);

?>
