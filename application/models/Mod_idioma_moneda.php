<?php 

/**
* 
*/
class Mod_idioma_moneda extends CI_Model
{
	var $idioma;
	function __construct()
	{
		parent::__construct();
		$controller = get_instance();		
		$this->idioma=$controller->session->userdata('langid')?$controller->session->userdata('langid'):1;
	}

	public function select_moneda()
	{
		$this->db->select('*');
		$this->db->from('public.public_moneda');
		$this->db->where('public.public_moneda.activo','t');

		return $this->db->get();
	}
	
	public function select_moneda_base()
	{
		$this->db->select('*');
		$this->db->from('public.public_moneda');
		$this->db->where('public.public_moneda.base','t');

		return $this->db->get()->row_array();
	}
	public function select_moneda_id($id=NULL)
	{
		$this->db->select('*');
		$this->db->from('public.public_moneda');
		if($id==NULL)
		 $this->db->where('public.public_moneda.base','t');
		else
		 $this->db->where('public.public_moneda.id',$id);

		return $this->db->get();
	}

	public function select_idioma()
	{
		$this->db->select('*');
		$this->db->from('public.public_idioma');

		return $this->db->get();
	}
	public function select_idioma_id($id)
	{
		$this->db->select('*');
		$this->db->from('public.public_idioma');
		$this->db->where('public.public_idioma.id',$id);

		return $this->db->get();
	}
	public function select_traduccion($nombreEsquema,$nombreCampo,$nombreTabla,$fk,$id,$default)
	{  
	 if($this->idioma!=1)
	{   
	    $translation="";
		$this->db->select($nombreCampo);
		$this->db->from($nombreEsquema.".".$nombreTabla);
        $this->db->where($nombreEsquema.".".$nombreTabla.".".$fk,$id);
		$this->db->where($nombreEsquema.".".$nombreTabla.".".'idioma_fk',$this->idioma);
		$translation =  $this->db->get()->result_array();
		if(count($translation)>0)
		{
			return $translation[0][$nombreCampo];
		}
	}	
	return $default;		
	}
	public function select_id_url_amigable($esquema,$url,$campo,$tabla,$campot,$tablat,$llavet)
	{
		$tabla = $esquema.'.'.$tabla;
		$origen = $this->db->get($tabla)->result_array();
		foreach($origen as $o)
		{
			if(url_title($o[$campo]) == $url)
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
				if(url_title($t[$campot]) == $url)
				{
					return $t[$llavet];
				}
			}
		}
		return false;
	}
}

?>