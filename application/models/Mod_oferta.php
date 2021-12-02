<?php
class Mod_oferta extends CI_Model
{	
	var $tb = 'oferta.oferta_producto';
	function __construct()
	{
		parent::__construct();
	}
	function get_ofertas($criterio,$items_pagina = NULL,$inicio = NULL)
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('t.id, t.nombre, t.descripcion, t.precio, t.imagen, t.pagina_inicio, t.disponible,
		 t.maximo_reservar, t.codigo, t.release, t.tipo_fk, t.keywords, ti.nombre as nombre_trad, ti.descripcion as descripcion_trad');
		$this->db->from('oferta.oferta_producto t');

		$this->db->where(' (t.fecha_inicio <= \''.app_now().'\') AND (t.fecha_fin >= \''.app_now().'\' OR t.fecha_fin IS NULL)',NULL,false);

		$this->db->join('oferta.oferta_idioma ti', 't.id = ti.oferta_fk AND ti.idioma_fk = '.$idioma_id, 'LEFT OUTER');

		$this->db->order_by('t.fecha_inicio','DESC');
		$this->db->order_by('t.precio','DESC');

		foreach ($criterio as $k => $v) {
			$this->db->where('t.'.$k, $v);
		}
		$this->db->limit($items_pagina, $inicio);

		$ofertas = $this->db->get()->result_array();

		$descuento_cliente = app_descuento_tipo_cliente('oferta');
		if($descuento_cliente)
		{
			foreach($ofertas as &$o)
			{
				$o['precio'] = app_aplicar_descuento($o['precio'],$descuento_cliente);
			}
		}
		return $ofertas;
	}
	function get_total_ofertas($criterio = array())
	{
		$this->db->where(' (fecha_inicio <= \''.app_now().'\') AND (fecha_fin >= \''.app_now().'\' OR fecha_fin IS NULL)',NULL,false);
		
		$resultado = $this->db->get_where($this->tb,$criterio)->result_array();
		
		return sizeof($resultado);
	}
	function get_tipos_ofertas()
	{
		$this->db->order_by('orden','ASC');
		return $this->db->get('oferta.oferta_tipo')->result_array();
	}
	function get_tipos_oferta($criterio)
	{
		return $this->db->get_where('oferta.oferta_tipo',$criterio)->row_array();
	}
	function get_oferta($criterio)
	{
		$datos_oferta = $this->db->get_where($this->tb,$criterio)->row_array();
		if($dias_disponibles = $this->_get_dias_disponibles($datos_oferta['id']))
		{
			$datos_oferta['dias_disponibles'] = $dias_disponibles;			
		}
		$datos_oferta['tipo'] = $this->get_tipos_oferta(array('id'=>$datos_oferta['tipo_fk']));

		$datos_oferta['paros'] = $this->get_paros($datos_oferta['id']);

		return $datos_oferta;
	}

	function get_paros($oferta_id)
    {
        $this->db->select('fecha_inicio, fecha_fin');
        $this->db->where('oferta_fk', $oferta_id);
        $this->db->where('no_disponible', 't');

        $resp = $this->db->get('oferta.oferta_paro_precio')->result_array();

        $paros = [];
        foreach ($resp as $item) {
            $paros[] = [$item['fecha_inicio'], $item['fecha_fin']];
        }

        return $paros;
    }

	function _get_dias_disponibles($id_oferta)
	{
		return $this->db->get_where('oferta.oferta_salida',array('oferta_fk'=>$id_oferta))->result_array();
	}
	function get_precio_oferta($id_oferta,$fecha)
	{
		//$this->db->where(' \''.$fecha.'\' BETWEEN fecha_inicio AND fecha_fin ',NULL,false);
		$this->db->where(' (fecha_inicio <= \''.$fecha.'\') AND (fecha_fin >= \''.$fecha.'\' OR fecha_fin IS NULL)',NULL,false);
		$precio = $this->db->get_where($this->tb,array('id'=>$id_oferta))->row_array();

		// ahora el precio original lo modifica la tabla oferta_paro_precio
		$precio_nuevo = $this->get_nuevo_precio($id_oferta, $fecha);

		if ($precio_nuevo !== false) {
            $precio['precio'] = $precio_nuevo;
        }

		return $precio;
	}
	function get_nuevo_precio($id_oferta,$fecha)
    {
        $this->db->select('no_disponible, precio');
        $this->db->where('oferta_fk', $id_oferta);
        $this->db->where(' (fecha_inicio <= \''.$fecha.'\') AND (fecha_fin >= \''.$fecha.'\')',NULL,false);

        $resp = $this->db->get('oferta.oferta_paro_precio')->row_array();

        if ($resp) {
            if ($resp['no_disponible'] == 't') {
                return 0;
            }

            return $resp['precio'];
        }

        return false;
    }
	public function voucher($producto)
	{
		$datos_oferta = $this->get_oferta(array('id'=>$producto['options']['id_oferta']));
		$nombre_oferta = app_traduccion('oferta','oferta_idioma','nombre','oferta_fk',$datos_oferta['id'],$datos_oferta['nombre']);
		$lineas = array();
			$lineas[] = $datos_oferta['codigo'].' - '.$nombre_oferta;
			$lineas[] = trans('of_fecha').': '.$producto['options']['fecha'];
			$lineas[] = trans('of_cantidad').': '.$producto['options']['cantidad'];
			$lineas[] = trans('of_cantidad_dias').': '.$producto['options']['cantidad_dias'];

		return $lineas;
	}
}
?>