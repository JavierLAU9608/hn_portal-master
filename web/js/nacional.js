// cookies
jQuery.cookie = function (key, value, options) {
    if (arguments.length > 1 && (value === null || typeof value !== "object")) {
        options = jQuery.extend({}, options);
        if (value === null) {
            options.expires = -1;
        }
        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }
        return (document.cookie = [encodeURIComponent(key), '=', options.raw ? String(value) : encodeURIComponent(String(value)), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
    }
    options = value || {};
    var result, decode = options.raw ? function (s) {
        return s;
    } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
//end cookie

var Nacional = function () {
    var conf = {
       alert_title: ''
    };

    var _init_components = function () {
        $('.fancybox').fancybox();

        window.alert = function (message, title, buttonText) {
            title = (title == undefined) ? conf.alert_title : title;

            $('#alert_msgTitle').html(title);
            $('#alert_msgBody').html(message);
            $('#alert_msg').modal('show');
        };

        $('#form_registro').submit(function (e) {
            e.preventDefault();
            $('.form_msg').remove();

            $.ajax({
                'url': 'registro',
                'data': $("#form_registro").serialize(),
                'type': 'POST',
                'beforeSend': function () {
                    _startLoading($('#form_registro'));
                },
                'success': function (data) {
                    $('<div class="form_msg alert alert-danger">' + data + '</div>').insertBefore('#registro_msg');

                    _stopLoading($('#form_registro'));
                }
            });

        });

        $('.toggle').click(function (e) {
            e.preventDefault();
            var id_link = $(this).attr("id");
            var arr = id_link.split('-');
            var hidden = 'hidden-' + arr[1];
            var flag = false;
            if (arr[0] == 'togcut') {
                var cutten = 'cut-' + arr[1];
                flag = true;
            }

            var txt_ver = $(this).attr("title");
            var txt_recoger = $(this).attr("data-pick");

            if ($(this).hasClass("pickup")) {
                $(this).removeClass("pickup");
                $(this).addClass("toggle");
                $('#' + id_link + ' span').text(txt_ver);
                $('#' + id_link + ' span.fl').text('');
                $('#' + hidden).hide('slow');
                if (flag) {
                    $('#' + cutten).show('slow');
                }
            }
            else {
                $(this).removeClass("toggle");
                $(this).addClass("pickup");
                $('#' + id_link + ' span').text(txt_recoger);
                $('#' + id_link + ' span.fl').text('');
                if (flag) {
                    $('#' + cutten).hide('slow');
                }
                $('#' + hidden).show('slide');
            }
        });

        $('#form_login').submit(function (e) {
            e.preventDefault();
            $('.form_msg').remove();

            $.ajax({
                'url': 'login',
                'data': $("#form_login").serialize(),
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function () {
                    _startLoading($('#form_login'));
                },
                'success': function (data) {
                    if (data.ok == 't') {
                        var usuario = $('#login_correo').val();
                        usuario = usuario.replace("@", "___");
                        if (document.getElementById('remember_pass').checked) {
                            var clave = $('#login_password').val();
                            $.cookie(usuario, clave, {expires: 360});
                        }
                        else {
                            if ($.cookie(usuario)) {
                                $.cookie(usuario, null);
                            }
                        }
                        window.location = data.url;
                    }
                    else {
                        $('<div class="form_msg alert alert-danger">' + data.msg + '</div>').insertBefore('#login_msg');
                    }

                    _stopLoading($('#form_login'));
                }
            });
        });

        $(".solo_numeros").keypress(function (e) {
            if ((e.which < 48 || e.which > 57) && (e.which != 0 && e.which != 8))
                e.preventDefault();
        });

        $(".numeros_letras").keypress(function (e) {
            if ((e.which < 48 || e.which > 57) && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122) && (e.which != 0 && e.which != 8 && e.which != 32 && e.which != 44 && e.which != 45 && e.which != 46 && e.which != 225 && e.which != 233 && e.which != 237 && e.which != 243 && e.which != 250 )) {
                e.preventDefault();
            }
        });

        $(".correo").keypress(function (e) {
            if ((e.which < 48 || e.which > 57) && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122) && (e.which != 0 && e.which != 8 && e.which != 64 && e.which != 46 && e.which != 95 )) {
                e.preventDefault();
            }
        });
    };

    /*
     * Muestra el div que indica que se está realizando una operación
     */
    var _startLoading = function (obj) {

        var html = '<div class="loading-message "><div class="block-spinner-bar">' +
            '<div class="bounce1"></div>' +
            '<div class="bounce2"></div>' +
            '<div class="bounce3"></div>' +
            '</div></div>';

        var conf = {
            message: html,
            css: {
                border: '0',
                padding: '0',
                backgroundColor: 'none'
            },
            overlayCSS: {
                backgroundColr: '#555',
                opacity: 0.6,
                cursor: 'wait'
            }
        };

        if (typeof obj == 'undefined') {
            $.blockUI(conf);
        } else {
            obj.block(conf);
        }

    };

    /*
     * Elimina el div que indica que se está realizando una operación
     */
    var _stopLoading = function (obj) {
        if (typeof obj == 'undefined') {
            $.unblockUI();
        } else {
            obj.unblock({});
        }
    };

    var _cambiar_idioma = function (id) {
        $.ajax({
            url: 'con_sitio/cambiar_idioma/' + id, cache: false, success: function (msg) {
                if (msg == 1) location.reload();
            }
        });
    };

    var _cambiar_moneda = function (id) {
        $.ajax({
            url: 'con_sitio/cambiar_moneda/' + id, cache: false, success: function (msg) {
                if (msg == 1) location.reload();
            }
        });
    };

    var _convertDate = function (date) {
        var fecha;
        try {
            // mozilla
            fecha = date.toLocaleFormat("%Y/%m/%d");
        } catch (e) {
            // chrome & ?..
            var m = date.getMonth() + 1; // chrome devuelve el mes mal (decrementado en 1, porque??)
            m = m < 10 ? '0' + m : m; // 2 dígitos
            var d = date.getDate();
            d = d < 10 ? '0' + d : d; // 2 dígitos
            fecha = date.getFullYear() + '/' + m + '/' + d;
        }

        return fecha;
    };

    /**
     * Actualiza la disponibilidad de las habitaciones
     */
    var _update_dispo = function () {
        var tipo_habitacion = $('#nombre_habitacion').val();
        var fecha = $("#date_in_room").val();

        if (fecha != '') {
            $.ajax({
                'url': 'con_alojamiento/get_dispo',
                'data': {'tipo_habitacion': tipo_habitacion, 'fecha': fecha},
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function () {
                    _startLoading($('.header'));
                },
                'success': function (data) {

                    if (data.ok == 't') {
                        var t_noches = $('#booking_noches');
                        var t_i;
                        t_noches.empty();
                        for (t_i = data.noches_min; t_i <= data.noches_max; t_i++) {
                            t_noches.append('<option value="' + t_i + '">' + t_i + '</option>');
                        }
                        t_noches.val(data.noches_min);

                        t_noches = $('#no_habitacion');
                        t_noches.empty();
                        for (t_i = 1; t_i <= data.habitaciones; t_i++) {
                            t_noches.append('<option value="' + t_i + '">' + t_i + '</option>');
                        }

                    } else if (data.ok == 'f') {
                        //toggle_booking(data.msg, true);
                    }

                    _stopLoading($('.header'));
                }
            });
        }

    };

    var _update_paros = function (date) {
        var tipo_habitacion = $('#nombre_habitacion').val();

        if (typeof (date) != 'undefined') {
            var fecha = _convertDate(date);
        } else {
            fecha = config.dateOptions.startDate;
        }

        $.ajax({
            'url': 'con_alojamiento/get_paros',
            'data': {'tipo_habitacion': tipo_habitacion, 'fecha': fecha},
            'dataType': 'json',
            'type': 'POST',
            'beforeSend': function () {
                _startLoading($('.header'));
            },
            'success': function (data) {

                if (data.ok == 't') {
                    config.closedDates = data.paros;
                    datePickerHome.val('');
                    datePickerHome.datepicker("setDate", null);

                    datePickerHome.datepicker("update");
                }

                _stopLoading($('.header'));
            }
        });
    };

    var config = {
        closedDates: []
    };

    // configuración por defecto de los date-picker
    var dateOptions = {
        language: 'en',
        format: 'yyyy-mm-dd',
        autoclose: true,
        beforeShowDay: function (date) {
            var fecha = _convertDate(date);

            for (i = 0; i < config.closedDates.length; i++) {
                var fechaMin = config.closedDates[i][0];
                var fechaMax = config.closedDates[i][1];

                if (fecha >= fechaMin && fecha <= fechaMax) {
                    return false;
                }
            }

            //console.log(fecha + '-> true');
            return true;
        }
    };

    var datePickerHome = $("#date_in_room");

    return {
        init: function (config) {
            $.extend(conf, config);
            _init_components();
        },

        cambiar_idioma: function (id) {
            _cambiar_idioma(id);
        },

        cambiar_moneda: function (id) {
            _cambiar_moneda(id);
        },
        stopLoading: function (obj) {
            _stopLoading(obj);
        },
        startLoading: function (obj) {
            _startLoading(obj);
        },
        initHomePage: function (conf) {
            $(".header-navigation").onePageNav({
                currentClass: "current",
                scrollThreshold: 0
            });

            $(window).load(function () {
                if (Layout.isMobileDevice() === false) {
                    $("#message-block").parallax("50%", 0.4);
                    $("#facts-block").parallax("50%", 0.4);
                }
            });

            jQuery.extend(dateOptions, conf.dateOptions);
            jQuery.extend(config, conf);

            datePickerHome.datepicker(dateOptions)
                .on('changeDate', function (ev) {
                    _update_dispo();
                }).on('changeMonth', function (obj) {
                    _update_paros(obj.date);
                }
            );

            $('#nombre_habitacion').change(function () {
                $('#default_room_precio').html($(this).find('option:selected').attr('data-precio'));
                $('#date_in_room, #booking_noches, #no_habitacion').html('');
                _update_paros();
            });

            $('a.change-img-evento').click(function () {
                //$('#img_main_evento').hide().attr('src', $(this).attr('data-source')).fadeIn();
                var div = $('#img_evento_container');
                _startLoading(div);
                var img = $('#img_main_evento').attr('src', $(this).attr('data-source')).on('load', function () {
                    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                        console.log('broken image!');
                    } else {
                        //$("#something").append(img);
                    }
                    _stopLoading(div);
                });
            });
        },
        convertDate: function (date) {
            return _convertDate(date)
        }
    }
}();
