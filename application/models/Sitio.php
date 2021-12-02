<?php
class Sitio extends CI_Model
{
	private $info = null;

	function __construct()
	{
		parent::__construct();
	}
	function st_get_idiomas()
	{
	
	    $idioma = app_idioma();
        $idioma_id = $idioma['id'];
   
        $this->db->select('i.id, ii.nombre as nombre_trad, i.nombre');
        $this->db->from('public.public_idioma i');
        $this->db->join('public.public_idioma_idioma ii', 'i.id = ii.idioma_fk AND ii.valor_idioma_fk = i.id'/*  *** .$idioma_id*/, 'LEFT OUTER');
		$this->db->order_by('nombre_trad','ASC');

        $idiomas = $this->db->get()->result_array();
		//$idiomas = $this->db->get_where('',array('ii.idioma_fk'=>$idioma_id))->result_array();
		
		return $idiomas;//$this->db->get('public.public_idioma')->result_array();
	}
	function st_get_idioma($parametro)
	{
			/*
			SELECT 
			  public.public_idioma.id,
			  public.public_idioma.nombre,
			  public.public_idioma.codigo,
			  public.public_idioma_idioma.nombre as nombre_trad
			FROM
			 public.public_idioma
			 LEFT OUTER JOIN public.public_idioma_idioma ON (public.public_idioma_idioma.idioma_fk=public.public_idioma.id)
			  AND (public.public_idioma_idioma.valor_idioma_fk=public.public_idioma.id)
			 WHERE  public.public_idioma.codigo = 'ES'
			
			*/
	
		$idiomax = $this->db->get_where('public.public_idioma',$parametro)->row_array();
	    //print_r($idiomax);exit;
        $id_i = $idiomax['id'];
        
		$idioma_id = (isset($parametro['codigo']))?$parametro['codigo']:'';
   
        $this->db->select('i.id, ii.nombre as nombre_trad, i.nombre, i.codigo');
        $this->db->from('public.public_idioma i');
        $this->db->join('public.public_idioma_idioma ii', 'i.id = ii.idioma_fk AND ii.valor_idioma_fk = i.id', 'LEFT OUTER');
		//$this->db->order_by('nombre_trad','ASC');
		//print_r($parametro);exit;
		
		
		return (isset($parametro['codigo'])) ? $this->db->get_where('',array('i.codigo'=>$idioma_id))->row_array() : $this->db->get_where('',array('i.id'=>$parametro['id']))->row_array();
	
	
		//return $this->db->get_where('public.public_idioma',$parametro)->row_array();
	}
	function st_get_monedas()
	{
		$this->db->order_by('nombre','ASC');
		return $this->db->get_where('public.public_moneda',array('activo'=>'t'))->result_array();
	}
	function st_get_moneda($parametro)
	{
		return $this->db->get_where('public.public_moneda',$parametro)->row_array();
	}
	function st_get_moneda_defecto()
	{
		return $this->db->get_where('public.public_moneda',array('activo'=>'t','base'=>'t'))->row_array();
	}
	function st_get_menu()
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('t.id,t.titulo,t.url,ti.nombre as titulo_trad');
		$this->db->from('frontend.frontend_menu_principal t');
		$this->db->join('frontend.frontend_menu_p_idioma ti', 'ti.menu_principal_fk = t.id AND ti.idioma_fk = '.$idioma_id, 'LEFT OUTER');
		$this->db->where('t.activo', 't');
		$this->db->order_by('orden','ASC');

		$menu = $this->db->get()->result_array();

		return $menu;
	}
	function st_get_menu_footer()
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('fmf.id, fmf.titulo, fmf.url, fmfi.nombre as titulo_trad, fmf.descripcion, fmfi.descripcion as descripcion_trad, fmf.description, fmfi.description as description_trad, fmf.keywords, fmfi.keywords as keywords_trad');
		$this->db->from('frontend.frontend_menu_footer fmf');
		$this->db->join('frontend.frontend_menupie_idioma fmfi', 'fmfi.menu_footer_fk = fmf.id AND fmfi.idioma_fk = '.$idioma_id, 'LEFT OUTER');
		$this->db->order_by('fmf.orden', 'ASC');

		$menu = $this->db->get()->result_array();

		return $menu;
	}
	function st_get_tarjeta_credito($mostrar_sitio = true)
	{
		if($mostrar_sitio)
			return $this->db->get_where('public_tarjeta_de_credito',array('mostrar_sitio'=>'t'))->result_array();
		return $this->db->get('public_tarjeta_de_credito')->result_array();
		
	}
	function st_get_redes_sociales()
	{
		$this->db->order_by('orden','ASC');
		return $this->db->get_where('frontend.frontend_red_social',array('publicar'=>'t'))->result_array();		
	}
	function st_get_slide_show($menu_fk = 4)
	{
        $idioma = app_idioma();
        $idioma_id = $idioma['id'];

        $this->db->select('i.id, i.url_imagen, i.link, i.titulo, i.descripcion, ti.titulo as titulo_trad, ti.descripcion as descripcion_trad');
        $this->db->from('frontend.frontend_slide_show i');
        $this->db->join('frontend.frontend_slide_idioma ti', 'i.id = ti.slide_fk AND ti.idioma_fk = '.$idioma_id, 'LEFT OUTER');
        $this->db->where('i.menu_fk='.$menu_fk);
        $this->db->order_by('i.orden','ASC');

        $result = $this->db->get()->result_array();

        $upload = app_dir_admin().'/admin/slideshow/slide-';
        $respond = array();
        foreach ($result as $item) {
            $path = $upload. $item['url_imagen'];
            if (file_exists($path)) {
                $respond[] = $item;
            }
        }

		return $respond;
	}
	public function st_traduccion($nombreEsquema,$nombreTabla,$nombreCampo,$fk,$id,$default)
	{  
		if($idioma_current = app_existe_idioma_seleccionado())
		{   
			$translation="";
			$nombreCampo_sel = $nombreCampo?$nombreCampo:'*';
			$this->db->select($nombreCampo_sel);
			$this->db->from($nombreEsquema.".".$nombreTabla);
			$this->db->where($nombreEsquema.".".$nombreTabla.".".$fk,$id);
			$this->db->where($nombreEsquema.".".$nombreTabla.".".'idioma_fk',$idioma_current['id']);
			$translation =  $this->db->get()->result_array();
			if(count($translation)>0)
			{
				if(!$nombreCampo == NULL)
					return $translation[0][$nombreCampo];
				else
					return $translation[0];
			}
		}	
		return $default;		
	}
	public function st_id_url_amigable($esquema,$url,$campo,$tabla,$campot,$tablat,$llavet)
	{
		$tabla = $esquema.'.'.$tabla;
		$origen = $this->db->get($tabla)->result_array();
		foreach($origen as $o)
		{
			if(strtolower(url_title($o[$campo])) == strtolower($url))
			{
				return $o['id'];
			}
		}
		if($campot!==NULL)
		{
			$tabla = $esquema.'.'.$tablat;
			$traduccion = $this->db->get($tabla)->result_array();
			foreach($traduccion as $t)
			{
				if(strtolower(url_title($t[$campot])) == strtolower($url))
				{
					return $t[$llavet];
				}
			}
		}
		return false;
	}
	function st_get_informacion_simple($key)
	{
		$info = $this->info;

		if (null === $info) {
			$info = $this->st_get_all_informacion();
			$this->info = $info;
		}

		foreach ($info as $k => $v) {
			if ($v['key'] == $key) {
				return $v;
			}
		}

		return null;
	}
	function st_get_informacion_simple_directa($key)
	{
		$info = $this->info;

		if (null === $info) {
			$info = $this->st_get_all_informacion();
			$this->info = $info;
		}

		foreach ($info as $k => $v) {
			if ($v['key'] == $key) {
				return $v['value'];
			}
		}

		return null;
	}
	function st_get_informacion_multiple($key)
	{
		$info = $this->info;

		if (null === $info) {
			$info = $this->st_get_all_informacion();
			$this->info = $info;
		}

		foreach ($info as $k => $v) {
			if ($v['key'] == $key) {
				return array($v);
			}
		}
	}
	function st_get_paises()
	{
		$idioma = app_idioma();
        $idioma_id = $idioma['id'];
   
        $this->db->select('i.id, ii.nombre as nombre_trad, i.nombre');
        $this->db->from('public.public_pais i');
        $this->db->join('public.public_pais_idioma ii', 'i.id = ii.pais_fk AND ii.idioma_fk = '.$idioma_id, 'LEFT OUTER');
		$this->db->order_by('nombre','ASC');

        $idiomas = $this->db->get()->result_array();
	
		//$this->db->order_by('nombre','ASC');
		return $idiomas;//$this->db->get('public_pais')->result_array();	
	}
	function st_get_pais($id_pais)
	{
		return $this->db->get_where('public.public_pais',array("public.public_pais.id"=>$id_pais))->row_array();	 
	}

	function st_get_all_informacion()
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('t.id, t.key, t.value, t.titulo, ti.nombre as titulo_trad, ti.descripcion as value_trad');
		$this->db->from('frontend.frontend_informacion_cliente t');
		$this->db->join('frontend.frontend_informacion_idioma ti', 'ti.informacion_fk = t.id AND ti.idioma_fk = '.$idioma_id, 'LEFT OUTER');

		return $this->db->get()->result_array();
	}
	
	function actualizar_tarjetas_activas($tarjetas)
    {
		$data = array('value' => $tarjetas);
	
        if ($this->db->update('frontend.frontend_informacion_cliente', $data, array('key' => 'tarjetas_array')))
        {
            return true;
        }
        return false;
    }
}
?>