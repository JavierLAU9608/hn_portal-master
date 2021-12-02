<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class APP_Cart  extends CI_Cart 
{
    public function __construct()
    {
        parent::__construct();
    }
	public function informacion_carro_compra()
	{
		$importe_carro=array('importe_total'=>0,'importe_no_pagar'=>0,'importe_pagar'=>0,'importe_a_pagar_sin_reservas_editadas'=>0);
		$cart = $this->contents();
				
		foreach($cart as $key=>$p)
		{
			$precio_producto=$p['price'];
			if(isset($p['options']['aconfirmar']) && $p['options']['aconfirmar']==1)
			{
				$importe_carro['importe_no_pagar']+=$precio_producto;
			}
			else
			{
				$importe_carro['importe_pagar']+=$precio_producto;
			}
			$importe_carro['importe_total']+=$precio_producto;
		}
		return $importe_carro;
	}
	public function desglozar_carro_compra()
	{
		$productos_carro=array('aconfirmar'=>array(),'pagar'=>array(),'total_a_confirmar'=>0,'total_a_pagar'=>0,'total'=>0);
		
		$total_productos_a_confirmar=0;
		$total_productos_a_pagar=0;
		$cart = $this->contents();
		
		foreach($cart as $key_producto=>$p)
		{
			if(isset($p['options']['aconfirmar']) && $p['options']['aconfirmar']==1)
			 {
				 $productos_carro['aconfirmar'][$key_producto]=$p;
				 $total_productos_a_confirmar++;
			 }
			 else
			 {
				 $productos_carro['pagar'][$key_producto]=$p;
				 $total_productos_a_pagar++;
			 }			
		}
		$productos_carro['total_a_confirmar']=$total_productos_a_confirmar;
		$productos_carro['total_a_pagar']=$total_productos_a_pagar;
		$productos_carro['total']=$total_productos_a_confirmar+$total_productos_a_pagar;
		return $productos_carro;
	}
	public function todos_a_confirmar()
	{
		$cart = $this->contents();
		$total_producto = 0;
		$total_a_confirmar = 0;
		foreach($cart as $key_producto=>$p)
		{
			if(isset($p['options']['aconfirmar']) && $p['options']['aconfirmar']==1)
			 {
				 
				 $total_a_confirmar++;
			 }
			 $total_producto++;		
		}
		if($total_a_confirmar == $total_producto)
			return true;
		return false;
	}	
	public function borrar_productos_a_confirmar()
	{
		$cart = $this->contents();		
		foreach($cart as $key_producto=>$p)
		{
			if($p['options']['aconfirmar'] == 2)
			{
				$this->remove($p['rowid']);
			}
		}
	}
	public function menor_fecha()
	{
		$cart = $this->contents();
		$fecha_menor = '';
		foreach($cart as $key_producto=>$p)
		{
			if($fecha_menor == '')
			{
				$fecha_menor = $p['options']['fecha'];
			}
			elseif($p['options']['fecha'] < $fecha_menor)
			{
				$fecha_menor = $p['options']['fecha'];
			}
		}
		return $fecha_menor;
	}

	/**
	 * Este método busca en  el carro de compra por el rowid y si no lo encuentra
	 * recorre los productos y lo busca por el id
	 *
	 * @param $id
	 * @return bool
	 */
	function searchProduct($id)
	{
		if (isset($this->_cart_contents[$id]))
		{
			return $this->_cart_contents[$id];
		} else {
			$content = $this->contents();

			foreach ($content as $k => $val) {
				if ($id == $val['id']) {
					return $content[$k];
				}
			}
		}

		return false;
	}

	function cancelar_producto($rowid)
	{
		$rowid = trim($rowid);
		if(isset($this->_cart_contents[$rowid]))
		{
			unset($this->_cart_contents[$rowid]);
			$this->_save_cart();
			return true;
		}
		return false;
	}
}
?>