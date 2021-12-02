<?php
/**
Modelo para la gestión de la reservación de un hotel
Desarrollado Alexis José Turruella <alexturruella@gmail.com>
2012 
*/
class Mod_reservacion_evento extends CI_Model
{
	var $tb = 'evento.evento_evento';
	function __construct()
	{
		parent::__construct();
	}
	public function procesar_insert_reserva($reserva_general,$reserva)
	{
				 //Esta es la estructura de la base de datos $contenedor_detalles
				 $contenedor_detalles=array();
				 
				 $contenedor_detalles['fecha_inicio']=$reserva['options']['fecha'];
				 $contenedor_detalles['fecha_fin']=$reserva['options']['fecha_fin'];
				 $contenedor_detalles['cantidad_personas']=$reserva['options']['no_participantes'];
				 $contenedor_detalles['nombre_evento']=$reserva['options']['nombre'];
				 $contenedor_detalles['tipo_evento_fk']=$reserva['options']['tipo_evento'];
				 $contenedor_detalles['texto_presentacion']=$reserva['options']['presentacion'];
				 $contenedor_detalles['texto_descripcion']=$reserva['options']['descripcion'];
				 $contenedor_detalles['nombre_responsable']=$reserva['options']['nombre_completo'];
				 $contenedor_detalles['cargo_responsable']=$reserva['options']['cargo'];
				 $contenedor_detalles['pais_responsable_fk']=$reserva['options']['pais'];
				 $contenedor_detalles['ciudad_responsable']=$reserva['options']['ciudad'];
				 $contenedor_detalles['telefono_responsable']=$reserva['options']['telefono'];
				 $contenedor_detalles['email_responsable']=$reserva['options']['email'];
				 $contenedor_detalles['sitio_web']=$reserva['options']['sitio_web'];
				 $contenedor_detalles['nombre_empresa_agencia']=$reserva['options']['nombre_empresa'];
				 $contenedor_detalles['direccion_responsable']=' ';				 
				 
				 $precio_convertido = app_rate_cambio($reserva['price']);
				 $contenedor_detalles['precio_convertido']=$precio_convertido['precio'];
				 $contenedor_detalles['precio']=$reserva['price'];
				 
		 $datos_reserva=array('reserva','detalles');
		 $datos_reserva['reserva']=$reserva_general;
		 $datos_reserva['detalles']=$contenedor_detalles;
		 if(sizeof($reserva['options']['dias_ev'])>0)
		 {
			 $servicios_comprados=array();
			 $dias_evento=array();
			 foreach($reserva['options']['dias_ev'] as $keyday=>$d)
			 {
				 $dias_evento[] = array('numero_dia'=>$keyday,'descripcion'=>'Dia'.$keyday,'evento_fk'=>NULL);
				 foreach($d as $id_tipo_servicio=>$tipo_servicio)
				 {
					 foreach($tipo_servicio as $id_servicio=>$servicio)
					 {
						 $servicios_comprados[$keyday][]=array( 'dia_evento_fk'    =>NULL,
				                          	  					'servicio_fk'      =>$id_servicio,
											            		'cantidad'         =>$servicio['cant_serv'],
																'detalle_adicional'=>$servicio['detalle_adicional']									   
				                          					  );
					 }				 		
				 }
			 }
			 $datos_reserva['dias']=$dias_evento;			 
			 $datos_reserva['servicios']=$servicios_comprados;
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
			$id_evento = $this->db->insert_id();
			
			foreach($datos_reserva['dias'] as $d)
			{
				$d['evento_fk'] = $id_evento;
				$this->db->insert('evento.evento_dia',$d);
				$id_dia = $this->db->insert_id();
				
				$servicios_reservados_para_el_dia = $datos_reserva['servicios'][$d['numero_dia']];

				foreach($servicios_reservados_para_el_dia as $s)
				{
					$s['dia_evento_fk'] = $id_dia;
					$this->db->insert('evento.evento_servicio_dia',$s);
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
				 if($reserva_confirmada !== false)
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
				 
				 $dias_evento =  $this->db->get_where('evento.evento_dia',array('evento_fk'=>$row_detalle['id']))->result_array();
				 $programacion_por_dia = array();
				 foreach($dias_evento as $d)
				 {
					$this->db->join('evento.evento_servicio','evento.evento_servicio.id = servicio_fk');
					$servicios_bd =  $this->db->get_where('evento.evento_servicio_dia',array('dia_evento_fk'=>$d['id']))->result_array();
					foreach($servicios_bd as $s)
					{
						$programacion_por_dia[$d['numero_dia']][$s['tipo_servicio_fk']][$s['id']] = array("nomb_serv"=>$s['nombre'],"tipo_serv_nomb"=>'',"cant_serv"=>$s['cantidad'],'detalle_adicional'=>$s['detalle_adicional'],"precio"=>$s['precio']);
					}
				 }
				 
				 $informacion_options = array(
				                                'fecha'=>$row_detalle['fecha_inicio'],
												'fecha_fin'=>$row_detalle['fecha_fin'],
												'no_participantes'=>$row_detalle['cantidad_personas'],												
												'nombre'=>$row_detalle['nombre_evento'],
												'tipo_evento'=>$row_detalle['tipo_evento_fk'],
												'presentacion'=>$row_detalle['texto_presentacion'],
												'descripcion'=>$row_detalle['texto_descripcion'],
												'nombre_completo'=>$row_detalle['nombre_responsable'],
												'cargo'=>$row_detalle['cargo_responsable'],
												'pais'=>$row_detalle['pais_responsable_fk'],
												'ciudad'=>$row_detalle['ciudad_responsable'],
												'telefono'=>$row_detalle['telefono_responsable'],
												'email'=>$row_detalle['email_responsable'],
												'sitio_web'=>$row_detalle['sitio_web'],
												'nombre_empresa'=>$row_detalle['nombre_empresa_agencia'],
												'dias_ev'=>$programacion_por_dia,
												'precio_convertido'=>$row_detalle['precio_convertido'],												
												'id_reserva'=>$row->id,
												'no_reserva'=>$row->no_reserva,
												'titular_tarjeta_fk'=>$row->titular_tarjeta_fk,
												'persona_reserva_fk'=>$row->persona_reserva_fk,
												'pk_idioma'=>$row->pk_idioma,
												'aconfirmar'=>NULL,
												'id_reserva_padre'=>$row->reserva_padre_fk,
												'tipo_producto'=>'evento',
												'fecha_creada'=>$row->fecha_creada,
												'fecha_modificada'=>$row->fecha_modificada,
												'numero_confirmacion'=>$row->numero_confirmacion,
												'estado'=>$row->estado_fk										
				                                );				 
                     
				  if($row->estado_fk==7)
				   $informacion_options['id_reserva_confirmada']=$row->id; 		 					    
			 	 
				 $reserva['qty'] = 1;
				 $reserva['price'] = $row_detalle['precio'];
				 $reserva['name'] = $row_detalle['nombre_evento'];
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