<?php 

/**
* 
*/
class Mod_registrarse extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insert($info)
	{
		$this->db->insert('frontend.frontend_registrarse', $info);
		return $this->db->insert_id();
	}
	public function update($info,$condicion)
	{
		if($this->db->update('frontend.frontend_registrarse',$info,$condicion))
		 return true;
		return false;
	}
	public function get_datos_user($id_user)
	{
		$this->db->select('*');
		$this->db->from('frontend.frontend_registrarse');
		$this->db->where('frontend.frontend_registrarse.id',$id_user);
		return $this->db->get()->row_array();
	}
	public function select_texto_registrar()
	{
		$this->db->select('*');
		$this->db->from('frontend.frontend_informacion_cliente');
		$this->db->where('frontend.frontend_informacion_cliente.key =', 'textoregistrar');

		return $this->db->get();
	}
	public function paises()
	{
		$this->db->select('*');
		$this->db->from('public.public_pais');
		$this->db->order_by('public.public_pais.nombre ASC');	
		return $this->db->get()->result_array();
	}
	public function existe_email($email)
	{
		$this->db->select('*');
		$this->db->from('frontend.frontend_registrarse');
		$this->db->where('frontend.frontend_registrarse.correo', $email);
        if($this->db->get()->num_rows()>0)
		 return true;
		return false;
	}
	public function buscar_usuario_por_email($email)
	{
		$this->db->select('*');
		$this->db->from('frontend.frontend_registrarse');
		$this->db->where('frontend.frontend_registrarse.correo', $email);
        return $this->db->get()->row_array();		 
	}
	public function buscar_usuario_por_id($id)
	{
		$this->db->select('*');
		$this->db->from('frontend.frontend_registrarse');
		$this->db->where('frontend.frontend_registrarse.id', $id);
        return $this->db->get()->row();		 
	}
	public function activar_cuenta($email,$clave_md5)
	{
		$sql="UPDATE frontend.frontend_registrarse set confirm_mail = 't' where frontend.frontend_registrarse.correo = '".$email."' AND frontend.frontend_registrarse.password='".$clave_md5."'";
		//$this->db->trans_start();
		if($this->db->query($sql))
		 return true;
		return false;
       //$this->db->trans_complete();
	}
}
?>