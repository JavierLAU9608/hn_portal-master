<?php
/**
Modelo para la gestión de la reservación de un hotel
Desarrollado Alexis José Turruella <alexturruella@gmail.com>
2012 
*/
class Mod_reservacion_bar extends CI_Model
{
	var $tb = 'frontend.frontend_bar_reserva';
	function __construct()
	{
		parent::__construct();
	}
	public function procesar_insert_reserva($reserva_general,$reserva)
	{
				 //Esta es la estructura de la base de datos $contenedor_detalles
				 $contenedor_detalles=array();
				 
				 $contenedor_detalles['bar_fk']=$reserva['options']['id_bar'];
				 $contenedor_detalles['bar_menu_fk']=$reserva['options']['id_menu'];
				 $contenedor_detalles['bar_menu_precio_fk']=$reserva['options']['id_duracion'];
				 $contenedor_detalles['hora_extra']=$reserva['options']['horas_extras'];
				 $contenedor_detalles['fecha']=$reserva['options']['fecha'];
				 $contenedor_detalles['cantidad']=$reserva['options']['cantidad'];
				 $precio_convertido = app_rate_cambio($reserva['price']);
				 $contenedor_detalles['precio_convertido']=$precio_convertido['precio'];
				 $contenedor_detalles['precio']=$reserva['price'];
				 
		 $datos_reserva=array('reserva','detalles');
		 $datos_reserva['reserva']=$reserva_general;
		 $datos_reserva['detalles']=$contenedor_detalles;
		 
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
			$this->db->insert_id();	
				
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
				     $reserva_confirmada['aconfirmar'] = 2;
				     $id_reserva = 'auto_reserva_'.md5(microtime());
				     $reservas_confirmadas[$id_reserva] = $reserva_confirmada;
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
				 $informacion_options = array(
				                                'id_bar'=>$row_detalle['bar_fk'],
												'id_menu'=>$row_detalle['bar_menu_fk'],
												'id_duracion'=>$row_detalle['bar_menu_precio_fk'],
												'horas_extras'=>$row_detalle['hora_extra'],
												'fecha'=>$row_detalle['fecha'],
												'cantidad'=>$row_detalle['cantidad'],
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
				 $reserva['name'] = $row_detalle['bar_fk'];
				 $reserva['options'] = $informacion_options;
			     return $reserva;			 					    
			 
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