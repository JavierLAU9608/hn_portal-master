<?php
class Archivos_reporte
{	
	var $ruta_reporte;
	var $archivos = array();
	public function __construct($params = array())
	{
		$this->ruta_reporte = $params['ruta'];
		$this->controlador =& get_instance();
		$this->controlador->load->helper('directory');
		$data = $this->controlador->load->helper('file');		
		$this->archivos = directory_map($this->ruta_reporte);	
	}
	function get_archivos()
	{
		$imagenes = array();
		foreach($this->archivos as $archivo)
		{
			if($archivo !== 'descripcion.txt')
			$imagenes[]=array('nombre'=>$archivo,'mime'=>$this->get_data_archivo($archivo),'info'=>$this->get_info_archivo($archivo));			
		}
		return $imagenes;
	}
	function get_data_archivo($name_archivo)
	{			
		return get_mime_by_extension($this->ruta_reporte.''.$name_archivo);	
	}
	function get_info_archivo($name_archivo)
	{
		return get_file_info($this->ruta_reporte.''.$name_archivo);
	}
	function get_img_base64($name_archivo)
	{
		$data_archivo = $this->get_data_archivo($name_archivo);
		$contenido = base64_encode(file_get_contents($this->ruta_reporte.''.$name_archivo));
		return '<img src="data:'.$data_archivo.';base64,'.$contenido.'"/>';
	}
	function get_thumbnail($id_archivo)
	{
		
	}
	function get_zip_archivos($nombre_zip = 'reporte')
	{
		$this->controlador->load->library('zip');
		
		$archivos_del_reporte = $this->get_archivos();
		foreach($archivos_del_reporte as $add)
		{
			$path = $this->ruta_reporte.$add['nombre'];
			$this->controlador->zip->read_file($path);
		}		
		$this->controlador->zip->download($nombre_zip.'.zip'); 
	}
	function download_archivo($archivo)
	{
		
	}
}
?>