<?php

class Mod_seguridad extends CI_Model {

    var $tb = 'frontend.frontend_registrarse';

    function __construct() {
        parent::__construct();
    }

    function insert_usuario($datos) {
        $datos['password'] = md5($datos['password']);
        return $this->db->insert($this->tb, $datos);
    }

    function editar_usuario($datos_usuario) {
        if (isset($datos_usuario['password']))
            $datos_usuario['password'] = md5($datos_usuario['password']);
        return $this->db->update($this->tb, $datos_usuario, array('id' => $datos_usuario['id']));
    }

    function get_usuario($criterio) {
        return $this->db->get_where($this->tb, $criterio)->row_array();
    }

    function autenticar($usuario, $contrasena) {
        $contrasena = md5($contrasena);

        // en modo development entrar con cualquier usuario válido
//        if (ENVIRONMENT == 'development' && $this->input->ip_address() === '127.0.0.1') {
//            $data = $this->db->get_where($this->tb, array('correo' => $usuario))->row_array();
//        } else {
            $data = $this->db->get_where($this->tb, array('correo' => $usuario, 'password' => $contrasena, 'confirm_mail' => 't'))->row_array();
//        }

        if ($data) {
            $this->db->select('*');
            $this->db->from('frontend.frontend_tipo_cliente');
            $this->db->where('frontend.frontend_tipo_cliente.nombre', $data['tipo_cliente_fk']);
            $tipo_cliente = $this->db->get()->row();

            $id_clienteB2b = null;
            if (is_object($tipo_cliente)) {
                $id_clienteB2b = $tipo_cliente->id;
            }
            $data['id_tipo_cliente'] = $id_clienteB2b;
        }

        return $data;
    }

    function cambiar_clave($id_usuario, $nueva_clave) {
        $nueva_clave = md5($nueva_clave);
        $this->db->update($this->tb, array('password' => $nueva_clave), array('id' => $id_usuario));
    }

    function update($info, $condicion) {
        if ($this->db->update('frontend.frontend_registrarse', $info, $condicion))
            return true;
        return false;
    }

    function email_logs($info) {
        $fecha = new DateTime('now');
        $hoy = $fecha->format('Y-m-d');

        $info['fecha_enviado'] = $hoy;
        $this->db->insert('seguridad.seguridad_email_logs', $info);
        return $this->db->insert_id();
    }
    
    public function pasarela_logs($info)
    {
        $fecha = new DateTime('now');
        $hoy = $fecha->format('Y-m-d');

        $info['fecha'] = $hoy;
        $this->db->insert('seguridad.seguridad_pasarela_logs', $info);
        return $this->db->insert_id();
    }
}

?>