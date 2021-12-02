<?php
/**
Modelo para la gestión de la reservación de un hotel
Desarrollado Alexis José Turruella <alexturruella@gmail.com>
2012 
*/
class Mod_reservacion_restaurante extends CI_Model
{
	var $tb = 'frontend.frontend_restaurante_reserva';
	function __construct()
	{
		parent::__construct();
	}
	public function procesar_insert_reserva($reserva_general,$reserva)
	{
				 //Esta es la estructura de la base de datos $contenedor_detalles
				 $contenedor_detalles=array();
				 
				 $contenedor_detalles['restaurante_fk']=$reserva['options']['id_restaurante'];
				 $contenedor_detalles['fecha']=$reserva['options']['fecha'];
				 $contenedor_detalles['horario_fk']=$reserva['options']['horario'];
				 $precio_convertido = app_rate_cambio($reserva['price']);
				 $contenedor_detalles['precio_convertido']=$precio_convertido['precio'];
				 $contenedor_detalles['precio']=$reserva['price'];
				 
		 $datos_reserva=array('reserva','detalles');
		 $datos_reserva['reserva']=$reserva_general;
		 $datos_reserva['detalles']=$contenedor_detalles;
		 if(sizeof($reserva['options']['menus'])>0)
		 {
			 $menus_comprados=array();
			 foreach($reserva['options']['menus'] as $m)
			 {
				 $menus_comprados[]=array('menu_fk'=>$m['id_menu'],
				                          'cantidad'=>$m['cantidad']											   
				                          );
			 }			 
			 $datos_reserva['menus']=$menus_comprados;
		 }
		 
		 return $this->insert_reserva($datos_reserva);	
	}
	public function insert_reserva($datos_reserva)
	{
		$info_reserva=$datos_reserva['reserva'];
		$this->db->trans_begin();
		$this->db->insert('frontend.frontend_reserva', $info_reserva);		
		$id_reserva = $this->db->insert_id();
		
		    $detalles_reserva=$datos_reserva['detalles'];
		
			$detalles_reserva['reserva_fk']=$id_reserva;
			$this->db->insert($this->tb,$detalles_reserva);
			
			$id_reserva_restaurante = $this->db->insert_id();
			if(sizeof($datos_reserva['menus']) > 0)
			{
				foreach($datos_reserva['menus'] as $m)
				{
					$m['reserva_restaurante_fk'] = $id_reserva_restaurante;
					$this->db->insert('frontend.frontend_restaurante_rmenu',$m);
				}
			}
				
		if ($this->db->trans_status() === FALSE)
        {
         $this->db->trans_rollback();
		 return false;
        }
        else
        {
         $this->db->trans_commit();
		 return $id_reserva;
        }		
	}
	public function get_reservas_confirmadas($id_usuario,$estado = 7)
	{
		$wh = (count($estado)>1)?("(frontend.frontend_reserva.estado_fk=".$estado[0]." OR frontend.frontend_reserva.estado_fk=".$estado[1].")"):("frontend.frontend_reserva.estado_fk=".$estado);
		$sql_reserva="select * from frontend.frontend_reserva where ".$wh." AND frontend.frontend_reserva.titular_tarjeta_fk=$id_usuario";
	    $query = $this->db->query($sql_reserva);
        if ($query->num_rows() > 0)
        {
			$reservas_confirmadas=array();
             foreach ($query->result_array() as $row)
             {				 
				 $reserva_confirmada = $this->get_reserva($row['id']);
				 if($reserva_confirmada != false)
				 {
				     $reserva_confirmada['options']['aconfirmar'] = 2;
				     $reservas_confirmadas[] = $reserva_confirmada;
				 }
			 }
		    return $reservas_confirmadas;
        }
	   return false;
	}
	public function get_reserva($id_reserva)
	{
		$reservas=array();		
		$sql_reserva="select * from frontend.frontend_reserva where frontend.frontend_reserva.id=$id_reserva";
	    $query = $this->db->query($sql_reserva);
        if ($query->num_rows() > 0)
        {
             $row = $query->row();
            
				 $sql_reserva_detalles="SELECT * FROM ".$this->tb." WHERE ".$this->tb.".reserva_fk=".$row->id;
				 $query_detalles = $this->db->query($sql_reserva_detalles);
				 if ($query_detalles->num_rows() > 0)
                 {
				 $row_detalle = $query_detalles->row_array();
				 
				 $menus = array();
				 $sql_menus_reservados="SELECT * FROM frontend.frontend_restaurante_rmenu WHERE frontend.frontend_restaurante_rmenu.reserva_restaurante_fk=".$row_detalle['id'];
				 $query_menus_reservados = $this->db->query($sql_menus_reservados);
				 if ($query_menus_reservados->num_rows() > 0)
                 {
					 $menus_reservados = $query_menus_reservados->result_array();
					 foreach($menus_reservados as $m)
					 {
						 $menus[] = array('id_menu'=>$m['menu_fk'],'cantidad'=>$m['cantidad']);
					 }					  
				 }
				 $informacion_options = array(
				                                'id_restaurante'=>$row_detalle['restaurante_fk'],
												'fecha'=>$row_detalle['fecha'],
												'horario'=>$row_detalle['horario_fk'],
												'menus'=>$menus,												
												'precio_convertido'=>$row_detalle['precio_convertido'],
												'id_reserva'=>$row->id,
												'no_reserva'=>$row->no_reserva,
												'titular_tarjeta_fk'=>$row->titular_tarjeta_fk,
												'persona_reserva_fk'=>$row->persona_reserva_fk,
												'pk_idioma'=>$row->pk_idioma,
												'aconfirmar'=>NULL,
												'id_reserva_padre'=>$row->reserva_padre_fk,
												'fecha_creada'=>$row->fecha_creada,
												'fecha_modificada'=>$row->fecha_modificada,
												'numero_confirmacion'=>$row->numero_confirmacion,
												'estado'=>$row->estado_fk										
				                                );				 
                     
				  if($row->estado_fk==7)
				   $informacion_options['id_reserva_confirmada']=$row->id; 		 					    
			 	 
				 $reserva['qty'] = 1;
				 $reserva['price'] = $row_detalle['precio'];
				 $reserva['name'] = $row_detalle['restaurante_fk'];
				 $reserva['options'] = $informacion_options;
			     return $reserva;
				 }
			return false;
       }
	   return false;
	}
	public function eliminar_reserva_confirmada($id_reserva)
	{
		$this->db->trans_begin();
		$sql_eliminar_reserva_detalles="DELETE FROM ".$this->tb." where ".$this->tb.".reserva_fk=".$id_reserva;
		$this->db->query($sql_eliminar_reserva_detalles);
		
		$sql_eliminar_reserva="DELETE FROM frontend.frontend_reserva where frontend.frontend_reserva.id=".$id_reserva;
		$this->db->query($sql_eliminar_reserva);

		if ($this->db->trans_status() === FALSE)
        {
         $this->db->trans_rollback();
		 return false;
        }
        else
        {
         $this->db->trans_commit();
		 return true;
        }		
	}
}
?>