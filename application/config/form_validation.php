<?php
$config = array(
    'registro' => array(
        array(
            'field' => 'correo',
            'label' => 'lang:correo',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'nombre',
            'label' => 'lang:nombre',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:contrasenna',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais_fk',
            'label' => 'lang:user_pais',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'politica',
            'label' => 'lang:politica',
            'rules' => 'required'
        )
    ),

    'contacto' => array(
        array(
            'field' => 'correo',
            'label' => 'lang:correo',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'nombre',
            'label' => 'lang:nombre',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais_fk',
            'label' => 'pais',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'msg',
            'label' => 'msg',
            'rules' => 'required'
        ),
    ),
    'recuperar_contrasenna' => array(
        array(
            'field' => 'correo',
            'label' => 'lang:correo',
            'rules' => 'required|valid_email'
        )
    ),
    'upd_registro' => array(
        array(
            'field' => 'correo',
            'label' => 'lang:correo',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'nombre',
            'label' => 'lang:nombre',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais',
            'label' => 'lang:user_pais',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'password_edit',
            'label' => 'lang:contrasenna',
            'rules' => ''
        ),
        array(
            'field' => 'password_edit_confir',
            'label' => 'lang:repetir_contrasenna',
            'rules' => ''
        )

    ),
    'subscripcion' => array(
        array(
            'field' => 'subscripcion_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        )
    ),
    'login' => array(
        array(
            'field' => 'correo',
            'label' => 'lang:correo',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:contrasenna',
            'rules' => 'required'
        )
    ),
    'precio_oferta' => array(
        array(
            'field' => 'cantidad_dias',
            'label' => 'lang:of_cantidad',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'cantidad',
            'label' => 'lang:of_cantidad',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'id_oferta',
            'label' => 'lang:of_oferta',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:of_fecha',
            'rules' => 'required'
        )
    ),
    'precio_boda' => array(
        array(
            'field' => 'id_oferta',
            'label' => 'lang:of_oferta',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:of_fecha',
            'rules' => 'required'
        )
    ),
    'precio_bar' => array(
        array(
            'field' => 'id_bar',
            'label' => 'lang:br_bar',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:br_dia_reservacion',
            'rules' => 'required'
        ),
        array(
            'field' => 'menu',
            'label' => 'lang:br_menus',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'duracion',
            'label' => 'lang:br_duracion',
            'rules' => 'required|integer'
        )
    ),
    'precio_restaurante' => array(
        array(
            'field' => 'id_restaurante',
            'label' => 'lang:rt_restaurante',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:fecha',
            'rules' => 'required'
        ),
        array(
            'field' => 'horario',
            'label' => 'lang:rt_horario',
            'rules' => 'required|integer'
        )
    ),
    'precio_habitacion' => array(
        array(
            'field' => 'tipo_habitacion',
            'label' => 'lang:al_habitacion',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:fecha',
            'rules' => 'required'
        ),
        array(
            'field' => 'noches',
            'label' => 'lang:al_noches',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'plan',
            'label' => 'lang:al_plan_alojamiento',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'paxs',
            'label' => 'lang:al_pax',
            'rules' => 'required'
        )
    ),
    'precio_habitaciones' => array(
        array(
            'field' => 'tipo_habitacion',
            'label' => 'lang:al_habitacion',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'lang:fecha',
            'rules' => 'required'
        ),
        array(
            'field' => 'noches[]',
            'label' => 'lang:al_noches',
            'rules' => 'required|is_natural_no_zero'
        ),
        array(
            'field' => 'plan[]',
            'label' => 'lang:al_plan_alojamiento',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'paxs[]',
            'label' => 'lang:al_pax',
            'rules' => 'required'
        )
    ),
    'programar_evento' => array(
        array(
            'field' => 'date_in_event',
            'label' => 'lang:ev_inicio',
            'rules' => 'required'
        ),
        array(
            'field' => 'date_out_event',
            'label' => 'lang:ev_fin',
            'rules' => 'required'
        ),
        array(
            'field' => 'tipo_evento',
            'label' => 'lang:ev_tipo',
            'rules' => 'required'
        ),
        array(
            'field' => 'no_participantes',
            'label' => 'lang:ev_no_participantes',
            'rules' => 'required|integer'
        )
    ),
    'precio_evento' => array(
        array(
            'field' => 'date_in_event',
            'label' => 'lang:ev_inicio',
            'rules' => 'required'
        ),
        array(
            'field' => 'date_out_event',
            'label' => 'lang:ev_fin',
            'rules' => 'required'
        ),
        array(
            'field' => 'tipo_evento',
            'label' => 'lang:ev_tipo',
            'rules' => 'required'
        ),
        array(
            'field' => 'no_participantes',
            'label' => 'lang:ev_no_participantes',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'nombre',
            'label' => 'lang:ev_nombre_evento',
            'rules' => 'required'
        ),
        array(
            'field' => 'nombre_completo',
            'label' => 'lang:nombre_completo',
            'rules' => 'required'
        ),
        array(
            'field' => 'telefono',
            'label' => 'lang:telefono',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => 'required|valid_email'
        )
    ),
    'datos_reserva' => array(
        array(
            'field' => 'nombre_titular',
            'label' => 'lang:nombre_apellidos',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais_titular',
            'label' => 'lang:pais_residencia',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'pasaporte_titular',
            'label' => 'lang:pasaporte',
            'rules' => 'required'
        ),
        array(
            'field' => 'email_titular',
            'label' => 'lang:email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'aceptar_terminos',
            'label' => 'lang:texto_aceptar_terminos_condiciones',
            'rules' => 'required'
        )
    ),
    'datos_reserva_regalo' => array(
        array(
            'field' => 'nombre_titular',
            'label' => 'lang:nombre_apellidos',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais_titular',
            'label' => 'lang:pais_residencia',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'pasaporte_titular',
            'label' => 'lang:pasaporte',
            'rules' => 'required'
        ),
        array(
            'field' => 'email_titular',
            'label' => 'lang:email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'aceptar_terminos',
            'label' => 'lang:texto_aceptar_terminos_condiciones',
            'rules' => 'required'
        ),
        array(
            'field' => 'nombre_titular_tarjeta',
            'label' => 'lang:nombre_apellidos',
            'rules' => 'required'
        ),
        array(
            'field' => 'pais_titular_tarjeta',
            'label' => 'lang:pais_residencia',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'pasaporte_titular_tarjeta',
            'label' => 'lang:pasaporte',
            'rules' => 'required'
        ),
        array(
            'field' => 'email_titular_tarjeta',
            'label' => 'lang:email',
            'rules' => 'required|valid_email'
        )
    ),

    'form_home_hotel' => array(
        array(
            'field' => 'tipo_habitacion',
            'label' => 'tipo_habitacion',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'cantidad_habitaciones',
            'label' => 'cantidad_habitaciones',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'noches',
            'label' => 'noches',
            'rules' => 'required|integer'
        ),
        array(
            'field' => 'fecha',
            'label' => 'fecha',
            'rules' => 'required'
        )
    )
);
?>