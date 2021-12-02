<?php

/* productos/oferta/reserva_01.twig */
class __TwigTemplate_b0603bc423614ec218ae9f9a8abdde3d158112000ab1fb323f05798f4f0d8b44 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "productos/oferta/reserva_01.twig", 1);
        $this->blocks = array(
            'stylesheet' => array($this, 'block_stylesheet'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["oferta_traducido"] = app_traduccion("oferta", "oferta_idioma", null, "oferta_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "id", array()), (isset($context["oferta"]) ? $context["oferta"] : null));
        // line 4
        $context["oferta_tipo_traducido"] = app_traduccion("oferta", "oferta_tipo_idioma", null, "tipo_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo_fk", array()), $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo", array()));
        // line 5
        $context["oferta_traducido_description"] = (($this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "description", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "description", array()), $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "descripcion", array()))) : ($this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "descripcion", array())));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 8
        echo "    <link href=\"web/css/jquery-bootstrap-datepicker.css\" rel=\"stylesheet\">
";
    }

    // line 11
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_ofertas"), "html", null, true);
    }

    // line 12
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_ofertas"), "html", null, true);
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "<div class=\"container bg-form padding-bottom-20\">
    <div  id=\"capa_reserva_oferta\" class=\"row content\" style=\"padding-top: 200px\">
        <div class=\"col-sm-12\">
            ";
        // line 18
        echo form_open(base_url("con_oferta/crear_reserva"), array("id" => "form_reserva_oferta", "class" => "form-vertical", "onSubmit" => "return validar()"));
        echo "
            <input type=\"hidden\" name=\"id_oferta\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "id", array()), "html", null, true);
        echo "\"/>

            ";
        // line 21
        if (((isset($context["boda"]) ? $context["boda"] : null) == true)) {
            // line 22
            echo "            <input type=\"hidden\" name=\"is_boda\" value=\"1\"/>
            ";
        }
        // line 24
        echo "
            ";
        // line 25
        if (($this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "confirmacion_online", array()) == "f")) {
            // line 26
            echo "                ";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "
                <input type=\"hidden\" name=\"aconfirmar\" value=\"1\"/>
            ";
        }
        // line 29
        echo "
            ";
        // line 30
        if ((isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null)) {
            // line 31
            echo "                <input  type=\"hidden\" name=\"key_car_reserva\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null), "html", null, true);
            echo "\"/>
            ";
        }
        // line 33
        echo "


            <div class=\"row margin-right-0\">
                <h2>";
        // line 37
        echo twig_escape_filter($this->env, trans("oferta"), "html", null, true);
        echo "</h2>
                <div class=\"col-sm-12 margin-top-20 margin-bottom-30\">
                    <h4 class=\"text-center\">";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_tipo_traducido"]) ? $context["oferta_tipo_traducido"] : null), "nombre", array()), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "nombre", array()), "html", null, true);
        echo "</h4>

                    <div class=\"text-center\" style=\"margin-top: 10px;\">
                        ";
        // line 42
        echo (isset($context["oferta_traducido_description"]) ? $context["oferta_traducido_description"] : null);
        echo "
                    </div>
                </div>

                <div id=\"oferta_msg_error\" class=\"col-sm-12\">
                </div>

                <div class=\"col-sm-4\">
                    <div class=\"form-group\">
                        <label class=\"control-label\">";
        // line 51
        echo twig_escape_filter($this->env, trans("of_fecha"), "html", null, true);
        echo "</label>
                        <input type=\"text\" class=\"input_cal fecha form-control\" id=\"fecha\" name=\"fecha\" required=\"required\" autocomplete=\"off\"/>
                    </div>
                </div>

                ";
        // line 56
        if (((isset($context["boda"]) ? $context["boda"] : null) == false)) {
            // line 57
            echo "                <div class=\"col-sm-4\">
                    <div class=\"form-group\">
                        <label class=\"control-label\">";
            // line 59
            echo twig_escape_filter($this->env, trans("of_cantidad"), "html", null, true);
            echo "</label>
                        <select name=\"cantidad\" id=\"cantidad\" class=\"input_cal form-control\" required=\"required\" >
                            ";
            // line 61
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "maximo_reservar", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 62
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                        </select>
                    </div>
                </div>

                <div class=\"col-sm-4\">
                    <div class=\"form-group\">
                        <label class=\"control-label\">";
            // line 70
            echo twig_escape_filter($this->env, trans("of_cantidad_dias"), "html", null, true);
            echo "</label>
                        <select name=\"cantidad_dias\" id=\"cantidad_dias\" class=\"input_cal form-control\" required=\"required\" >
                            ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["cant_dias"]) ? $context["cant_dias"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 73
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            echo "                        </select>
                    </div>
                </div>
                ";
        }
        // line 79
        echo "
                <div class=\"col-sm-12\">
                    <div class=\"form-group\">
                        <label class=\"control-label\">";
        // line 82
        echo twig_escape_filter($this->env, trans("of_solicitud_adicional"), "html", null, true);
        echo "</label>
                        <textarea rows=\"5\" id=\"detalles_oferta\" class=\"form-control\" name=\"detalles\"></textarea>
                    </div>
                </div>
            </div>

            <div class=\"precio_reserva row margin-left-0 margin-right-0\">
                <div class=\"col-sm-12\">
                    <p class=\"verdana text-price\">";
        // line 90
        echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
        echo "
                        <span class=\"precio_reservacion text-price text-white\">
                    ";
        // line 92
        if ((isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null)) {
            // line 93
            echo "                        ";
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "price", array()), "smb"), "html", null, true);
            echo "
                    ";
        }
        // line 95
        echo "                </span>
                    </p>

                    <input class=\"btn btn-default circle buttom roman\" type=\"submit\" name=\"btn_continuar\" value=\"";
        // line 98
        echo twig_escape_filter($this->env, trans("continuar"), "html", null, true);
        echo "\">
                    <input class=\"btn btn-default circle buttom roman\" type=\"submit\" name=\"btn_cancelar\" value=\"";
        // line 99
        echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
        echo "\">
                </div>
            </div>

            ";
        // line 103
        if ((isset($context["flash_error"]) ? $context["flash_error"] : null)) {
            // line 104
            echo "            <div class=\"alert alert-danger\">
                ";
            // line 105
            echo twig_escape_filter($this->env, (isset($context["flash_error"]) ? $context["flash_error"] : null), "html", null, true);
            echo "
            </div>
            ";
        }
        // line 108
        echo "            </form>
        </div>
    </div>
</div>
";
    }

    // line 114
    public function block_script($context, array $blocks = array())
    {
        // line 115
        echo "    <script src=\"web/assets/jquery-ui/jquery.ui.datepicker-min.js\"></script>
    <script src=\"web/assets/jquery-ui/jquery.ui.core-min.js\"></script>
    <script src=\"web/assets/jquery-ui/i18n/jquery.ui.datepicker-";
        // line 117
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
        echo ".js\"></script>

    <script language=\"javascript\" type=\"application/javascript\">
        var closedDates = ";
        // line 120
        echo twig_jsonencode_filter($this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "paros", array()));
        echo ";

        var _convertDate = function (date) {
            var fecha;
            try {
                // mozilla
                fecha = date.toLocaleFormat(\"%Y-%m-%d\");
            } catch (e) {
                // chrome & ?..
                var m = date.getMonth() + 1; // chrome devuelve el mes mal (decrementado en 1, porque??)
                m = m < 10 ? '0' + m : m; // 2 dígitos
                var d = date.getDate();
                d = d < 10 ? '0' + d : d; // 2 dígitos
                fecha = date.getFullYear() + '-' + m + '-' + d;
            }

            return fecha;
        };

        \$(\"#fecha\").datepicker({\"dateFormat\":\"yy-mm-dd\",minDate:'";
        // line 139
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "fecha_rinicio", array()), "html", null, true);
        echo "',
            maxDate:'";
        // line 140
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "fecha_rfin", array()), "html", null, true);
        echo "'

            ";
        // line 142
        if ($this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "dias_disponibles", array())) {
            // line 143
            echo "            ,  beforeShowDay: function (_day) {
                var day = _day.getDay();

                if (";
            // line 146
            echo twig_escape_filter($this->env, (isset($context["cadena_if"]) ? $context["cadena_if"] : null), "html", null, true);
            echo ") {
                    var fecha = _convertDate(_day);

                    for (i = 0; i < closedDates.length; i++) {
                        var fechaMin = closedDates[i][0];
                        var fechaMax = closedDates[i][1];

                        if (fecha >= fechaMin && fecha <= fechaMax) {
                            return [false, \"\"];
                        }
                    }

                    return [true, \"\"];
                } else {
                    return [false, \"\"];
                }
            }
            ";
        } else {
            // line 164
            echo "            ,  beforeShowDay: function (_day) {

                var fecha = _convertDate(_day);

                for (i = 0; i < closedDates.length; i++) {
                    var fechaMin = closedDates[i][0];
                    var fechaMax = closedDates[i][1];

                    if (fecha >= fechaMin && fecha <= fechaMax) {
                        return [false, \"\"];
                    }
                }
                return [true, \"\"];
            }
            ";
        }
        // line 179
        echo "        }, \$.datepicker.regional['EN']);

        \$(\".input_cal\").change(function() {
            \$.ajax({
                'url':  'con_oferta/calcular',
                'data': \$(\"#form_reserva_oferta\").serialize(),
                'dataType': 'json',
                'type': 'POST',
                'beforeSend': function(){
                    \$('#oferta_msg_error').html('') ;
                    Nacional.startLoading(\$('#capa_reserva_oferta'));
                },
                'success': function(data) {
                    if(data.ok == 't')
                    {
                        \$('.precio_reservacion').html(data.precio);
                    }
                    else
                    {
                        \$('.precio_reservacion').html('');
                        \$('#oferta_msg_error').html('<div class=\"form_msg alert alert-danger\">'+data.msg+'</div>') ;
                    }
                    Nacional.stopLoading(\$('#capa_reserva_oferta'));
                }
            });
        });

        function validar()
        {
            var offerta = \$('#oferta_msg_error');
            offerta.html('') ;

            if(\$('.precio_reservacion').html()!=='')
                return true;

            offerta.html('<div class=\"form_msg alert alert-danger\">";
        // line 214
        echo twig_escape_filter($this->env, trans("al_error_reserva_incorrecta"), "html", null, true);
        echo "</div>') ;
            return false;
        }

        ";
        // line 218
        if ((isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null)) {
            // line 219
            echo "        \$('#cantidad').val('";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "cantidad", array()), "html", null, true);
            echo "');
        \$('#cantidad_dias').val('";
            // line 220
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "cantidad_dias", array()), "html", null, true);
            echo "');
        \$('#fecha').val('";
            // line 221
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "fecha", array()), "html", null, true);
            echo "');
        \$('#detalles_oferta').val('";
            // line 222
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "detalles", array()), "html", null, true);
            echo "');
        ";
        }
        // line 224
        echo "
    </script>
";
    }

    public function getTemplateName()
    {
        return "productos/oferta/reserva_01.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  421 => 224,  416 => 222,  412 => 221,  408 => 220,  403 => 219,  401 => 218,  394 => 214,  357 => 179,  340 => 164,  319 => 146,  314 => 143,  312 => 142,  307 => 140,  303 => 139,  281 => 120,  275 => 117,  271 => 115,  268 => 114,  260 => 108,  254 => 105,  251 => 104,  249 => 103,  242 => 99,  238 => 98,  233 => 95,  227 => 93,  225 => 92,  220 => 90,  209 => 82,  204 => 79,  198 => 75,  187 => 73,  183 => 72,  178 => 70,  170 => 64,  159 => 62,  155 => 61,  150 => 59,  146 => 57,  144 => 56,  136 => 51,  124 => 42,  116 => 39,  111 => 37,  105 => 33,  99 => 31,  97 => 30,  94 => 29,  87 => 26,  85 => 25,  82 => 24,  78 => 22,  76 => 21,  71 => 19,  67 => 18,  62 => 15,  59 => 14,  53 => 12,  47 => 11,  42 => 8,  39 => 7,  35 => 1,  33 => 5,  31 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/oferta/reserva_01.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/oferta/reserva_01.twig");
    }
}
