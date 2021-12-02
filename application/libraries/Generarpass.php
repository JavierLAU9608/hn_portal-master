<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Generarpass {

    public function generar_pass($pass_length=null)
    {
		if($pass_length==NULL)
		{
		 $this->c =& get_instance();
		 $cantidad=$this->c->app_config('lenght_pass');
		}
		else
		 $cantidad=$pass_length;
		 
		$contrasena="";
		$posible="0123456789abcdefghijklmnpqrstuwxyz";
		$i=0;
		while($i<$cantidad)
		{
			$char=substr($posible,mt_rand(0,strlen($posible)-1),1);
			
			if(!strstr($contrasena,$char))
			{
				$contrasena.=$char;
				$i++;
			}
		}
		return $contrasena;
    }
}
?>