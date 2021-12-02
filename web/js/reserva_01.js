var Reserva01 = function () {

    var max_habitacion_reserva;

    var _init_components = function () {
        datePickerReserva01.datepicker(dateOptions)
            .on('changeMonth', function (obj) {
                update_datepicker(obj.date);
            }
        );

        $('._tipo_hab').each(function (i, e) {
            precio($(this));
        });

        $('.plan').change(function () {
            var tipo_habitacion = $('#tipo_hab_principal').val();
            var fecha = $("#fecha_principal").val();

            var capa_form_parent = $(this).parent().parent().parent();
            var paxs = capa_form_parent.find('select.cantidad_paxs').val();
            var noches = capa_form_parent.find('select.noches').val();
            var plan = capa_form_parent.find('select.plan').val();
            var token = $("input[name='token']").val();

            $.ajax({
                'url': 'con_alojamiento/get_paxs',
                'data': {
                    'tipo_habitacion': tipo_habitacion,
                    'fecha': fecha,
                    'plan': plan,
                    'paxs': paxs,
                    'token': token
                },
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function () {
                    //$('.loader_reserva').show();
                    Nacional.startLoading(capa_form_parent);
                },
                'success': function (data) {
                    if (data.ok == 't') {
                        var obj = capa_form_parent.find('select:.cantidad_paxs');
                        obj.empty();
                        for (var t_i = 0; t_i < data.n_paxs.length; t_i++) {
                            //var vopc = data.n_paxs[t_i]['opc'];
                            obj.append('<option value="' + data.n_paxs[t_i]['val'] + '">' + data.n_paxs[t_i]['opc'] + '</option>');
                        }
                        obj.val(data.paxs);

                        precio(capa_form_parent.find('select:.cantidad_paxs'));
                    }

                    Nacional.stopLoading(capa_form_parent);
                }
            });

        });

        $('#fecha_principal').change(function () {
            var tipo_habitacion = $('#tipo_hab_principal').val();
            var fecha = $("#fecha_principal").val();
            var cantidad_habitaciones = $('#cantidad_habitaciones').val();
            $(".selector_fecha").val(fecha);
            var token = $("input[name='token']").val();

            $.ajax({
                'url': 'con_alojamiento/get_dispo',
                'data': {
                    'tipo_habitacion': tipo_habitacion,
                    'fecha': fecha,
                    'cant_habitaciones': cantidad_habitaciones,
                    'token': token
                },
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function () {
                    Nacional.startLoading();
                },
                'success': function (data) {
                    if (data.ok == 't') {
                        var t_hab = $('#cantidad_habitaciones');
                        var temp = t_hab.val();
                        max_habitacion_reserva = data.habitaciones;

                        if (temp > data.habitaciones) {
                            t_hab.val(data.habitaciones);
                            t_hab.keyup();
                        } else {
                            t_hab.val(temp);
                        }

                        var t_noches = $('.noches');
                        t_noches.each(function (i, e) {
                            var temp = $(this).val();
                            $(this).empty();
                            for (var t_i = data.noches_min; t_i <= data.noches_max; t_i++) {
                                $(this).append('<option value="' + t_i + '">' + t_i + '</option>');
                            }
                            if (temp > data.noches_max) {
                                $(this).val(data.noches_max);
                                $(this).change();
                            } else {
                                $(this).val(temp);
                            }
                        });

                        if (data.info != null) {
                            $('#dispo_info').attr('title', data.info);
                            $('#dispo_info').removeClass('hidden');
                        } else {
                            $('#dispo_info').addClass('hidden');
                        }

                        total();

                    } else if (data.ok == 'f') {
                        alert(data.msg);
                    }

                    Nacional.stopLoading();
                }
            });
        });

        $(".selector_fecha").datepicker(
            {
                dateFormat: "yy-mm-dd",
                startDate: '{{ hotel.fecha_minima }}',
                endDate: '{{ hotel.fecha_maxima }}',
                beforeShowDay: nonWorkingDates,
                onChangeMonthYear: function (year, month, inst) {
                    var fecha = year + '-' + month + '-01';
                    update_datepicker("{{ trans('seleccione_dia') }}", fecha);
                }
            },
            $.datepicker.regional["{{ app.current_lang.codigo }}"]
        );


        $('.tipo_habitacion').change(function () {

            var capa_form_parent = $(this).parent().parent().parent();
            var cantidad_paxs = capa_form_parent.find('select.cantidad_paxs');
            var sel_cantidad_paxs = cantidad_paxs.val();
            var capa_ninno_adicional = capa_form_parent.find('div.capa_ninno_adicional');
            var ninno_adicional = capa_form_parent.find('input.ninno_adicional');
            ninno_adicional.removeAttr('checked');
            var tipo_habitacion = $(this).val();
            if (capacidades_maximas[tipo_habitacion].ninno_adicional == 't') {
                capa_ninno_adicional.css('visibility', 'visible');
            }
            else
                capa_ninno_adicional.css('visibility', 'hidden');

            cantidad_paxs.empty();
            var limites = capacidades_maximas[tipo_habitacion];
            for (var i = 1; i <= limites.max_pax; i++)
                cantidad_paxs.append('<option value="' + i + '">' + i + '</option>');
            cantidad_paxs.val(sel_cantidad_paxs);

        });
        $(".paquete_luna_miel").change(function () {
            var capa_exterior = $(this).parent();
            var img_detalle_luna_miel = capa_exterior.find('img.detalle_pql');

            if ($(this).val() > 0) {
                img_detalle_luna_miel.css('display', '');
            }
            else
                img_detalle_luna_miel.css('display', 'none');
        });
        $(".detalle_pql").click(function () {
            var capa_exterior = $(this).parent().parent();
            var paquete_luna_miel = capa_exterior.find('select.paquete_luna_miel');
            var id_paquete_luna_miel = paquete_luna_miel.val();
            var token = $("input[name='token']").val();
            if (id_paquete_luna_miel) {
                $.ajax({
                    'url': 'con_alojamiento/paquete_luna_miel',
                    'data': {'id_paquete': id_paquete_luna_miel, 'token': token},
                    'dataType': 'json',
                    'type': 'POST',
                    'beforeSend': function () {
                        Nacional.startLoading(capa_exterior);
                    },
                    'success': function (data) {
                        if (data.ok == 't') {
                            alert(data.nombre + '\n\n' + data.descripcion);
                        }
                        else if (data.ok == 'f') {

                        }

                        Nacional.stopLoading(capa_exterior);
                    }
                });
            }
        });

        $(".input_cal").change(function () {
            prepare();
            precio($(this));
        });
        $(".cantidad_habitaciones").keyup(function () {

            if ($(this).val() > max_habitacion_reserva) {
                alert(config.msgCantHab + max_habitacion_reserva);
                $(this).val(max_habitacion_reserva);
            }

            var cant_selected = $(this).val();
            if (cant_selected > 0) {
                var cant_habitacion = $('.formulario_alojamiento').length;
                var cant_for = cant_selected - cant_habitacion;
                if (cant_for > 0) {
                    var precio_habitacion_0 = $('.formulario_alojamiento:eq(0) .precio_habitacion').val();
                    var tipo_habitacion_0 = $('#tipo_hab_principal').val();
                    var selector_fecha_0 = $('#fecha_principal').val();
                    var hora_0 = $('.formulario_alojamiento:eq(0) .hora').val();
                    var noches_0 = $('.formulario_alojamiento:eq(0) .noches').val();
                    var plan_0 = $('.formulario_alojamiento:eq(0) .plan').val();
                    var cantidad_paxs_0 = $('.formulario_alojamiento:eq(0) .cantidad_paxs').val();
                    var ninno_adicional_0 = $('.formulario_alojamiento:eq(0) .ninno_adicional').val();
                    var paquete_luna_miel_0 = $('.formulario_alojamiento:eq(0) .paquete_luna_miel').val();

                    for (var i = 0; i < cant_for; i++) {
                        $('.formulario_alojamiento:eq(0)').clone(true).insertAfter(".formulario_alojamiento:last");
                        $('.formulario_alojamiento:last .numero_habitacion').html('<font>' + config.msgHabitacion + ' #' + (i + cant_habitacion + 1) + '</font>');
                        $('.formulario_alojamiento:last .precio_habitacion').val(precio_habitacion_0);
                        $('.formulario_alojamiento:last .tipo_habitacion').val(tipo_habitacion_0);
                        $('.formulario_alojamiento:last .hora').val(hora_0);
                        $('.formulario_alojamiento:last .noches').val(noches_0);
                        $('.formulario_alojamiento:last .plan').val(plan_0);
                        $('.formulario_alojamiento:last .cantidad_paxs').val(cantidad_paxs_0);
                        $('.formulario_alojamiento:last .ninno_adicional').attr('name', 'ninno_adicional_' + (i + 1));
                        $('.formulario_alojamiento:last .ninno_adicional').val(ninno_adicional_0);
                        $('.formulario_alojamiento:last .paquete_luna_miel').val(paquete_luna_miel_0);

                    }
                }
                else {
                    for (var i = 0; i > cant_for; i--) {
                        $('.formulario_alojamiento:last').remove();
                    }
                }
            }

            prepare();

            total();
        });
    };

    function nonWorkingDates(date) {

        var day = date.getDay();

        for (i = 0; i < closedDates.length; i++) {
            var fechamin = new Date(closedDates[i][0]);
            var fechamax = new Date(closedDates[i][1]);

            if (compara_fecha_menor(fechamax, date) == true && compara_fecha_mayor(fechamin, date) == true)
                return [false, 'paro_venta'];
        }
        return [true];
    }

    function compara_fecha_menor(datefecha, menor) {
        if (datefecha.toString() == menor.toString())
            return true;
        if (menor.getFullYear() < datefecha.getFullYear())
            return true;
        if (menor.getFullYear() > datefecha.getFullYear())
            return false;
        if (menor.getMonth() < datefecha.getMonth())
            return true;
        if (menor.getMonth() > datefecha.getMonth())
            return false;
        if (menor.getDate() < datefecha.getDate())
            return true;
        return false;
    }

    function compara_fecha_mayor(datefecha, mayor) {
        if (datefecha.toString() == mayor.toString())
            return true;
        if (mayor.getFullYear() > datefecha.getFullYear())
            return true;
        if (mayor.getFullYear() > datefecha.getFullYear())
            return false;
        if (mayor.getMonth() > datefecha.getMonth())
            return true;
        if (mayor.getMonth() < datefecha.getMonth())
            return false;
        if (mayor.getDate() > datefecha.getDate())
            return true;
        return false;
    }

    function prepare() {
        $('._tipo_hab').each(function (i, e) {
            $(e).val($('#tipo_hab_principal').val());
        });
        $('._fecha_hab').each(function (i, e) {
            $(e).val($('#fecha_principal').val());
        });
    }

    function precio(elemento) {
        var capa_form_parent = elemento.parent().parent().parent();

        var fecha = $('#fecha_principal').val();

        var paxs = capa_form_parent.find('select.cantidad_paxs').val();
        if (paxs != '' && fecha !== '') {
            var tipo_habitacion = $('#tipo_hab_principal').val();
            var noches = capa_form_parent.find('select.noches').val();
            var plan = capa_form_parent.find('select.plan').val();
            var ninno_adicional = capa_form_parent.find('input.ninno_adicional').attr("checked") ? true : '';
            var paquete_luna_miel = capa_form_parent.find('select.paquete_luna_miel').val();
            var fondo = $('<div class="box-modal-bg"/>');
            var token = $("input[name='token']").val();
            $.ajax({
                'url': 'con_alojamiento/calcular',
                'data': {
                    'tipo_habitacion': tipo_habitacion,
                    'fecha': fecha,
                    'noches': noches,
                    'plan': plan,
                    'paxs': paxs,
                    'ninno_adicional': ninno_adicional,
                    'paquete_luna_miel': paquete_luna_miel,
                    'token': token
                },
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function () {
                    Nacional.startLoading(capa_form_parent);
                },
                'success': function (data) {
                    if (data.ok == 't') {
                        capa_form_parent.find('span.precio_habitacion_text').html(data.precio_convertido + ' ' + data.smb_moneda);
                        capa_form_parent.find('input.precio_habitacion').val(data.precio_convertido);
                        $('.precio_reservacion').html(data.precio);
                    }
                    else if (data.ok == 'f') {
                        capa_form_parent.find('input.precio_habitacion').val(0);
                        capa_form_parent.find('span.precio_habitacion_text').html('');
                        //alert(data.msg);
                    }
                    total();
                    Nacional.stopLoading(capa_form_parent);
                }
            });
        }
    }

    function total() {
        new_price = 0;
        $('.precio_reservacion').html('');
        var simb = '';
        $('.precio_habitacion').each(function (index, term) {
            new_price += parseFloat($(this).val());
        });
        if (new_price > 0)
            $('.precio_reservacion').html(new_price + ' ' + '{{ SIMBOLO_MONEDA }}');
    }

    function validar() {
        if ($('.precio_reservacion').html() !== '')
            return true;
        alert(config.msgReservaInco);
        return false;
    }

    function hab_capacidad(id, max_pax, ninno_adicional) {
        this.id = id;
        this.max_pax = max_pax;
        this.ninno_adicional = ninno_adicional;
    }

    function update_datepicker(fecha) {
        var tipo_habitacion = $('#tipo_hab_principal').val();
        var token = $("input[name='token']").val();
        $.ajax({
            'url': 'con_alojamiento/get_paros',
            'data': {'tipo_habitacion': tipo_habitacion, 'fecha': fecha, 'token': token},
            'dataType': 'json',
            'type': 'POST',
            'beforeSend': function () {


            },
            'success': function (data) {

                if (data.ok == 't') {
                    closedDates = data.paros;
                    $("#fecha_principal").datepicker("refresh");
                }


            },
            'error': function () {

            }
        });
    }

    var config = {
        closedDates: []
    };

    // configuración por defecto de los date-picker
    var dateOptions = {
        language: 'en',
        format: 'yyyy-mm-dd',
        autoclose: true,
        beforeShowDay: function (date) {
            var fecha = Nacional.convertDate(date);

            for (i = 0; i < config.closedDates.length; i++) {
                var fechaMin = config.closedDates[i][0];
                var fechaMax = config.closedDates[i][1];

                if (fecha >= fechaMin && fecha <= fechaMax) {
                    return false;
                }
            }

            return true;
        }
    };

    var datePickerReserva01 = $(".selector_fecha");
    var capacidades_maximas = new Array();

    return {
        init: function (conf) {
            jQuery.extend(dateOptions, conf.dateOptions);
            jQuery.extend(config, conf);

            max_habitacion_reserva = config.max_habitacion_reserva;

            _init_components();

            prepare();
        }
    }
}();
