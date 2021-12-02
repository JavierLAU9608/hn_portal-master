<?php

/* productos/alojamiento/template_car.twig */
class __TwigTemplate_b461e30a1092d128fcbb7501b703105b9a9e05578bbb714b044a181930947758 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["datos_adicionales"] = $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array());
        // line 2
        echo "
<div>
    <div class=\"row\">
        <div class=\"col-sm-12\">
            <div class=\"row\">
                <div class=\"col-sm-4\">";
        // line 7
        echo twig_escape_filter($this->env, trans("serivicio_nombre", array("nombre" => trans("alojamiento"))), "html", null, true);
        echo "</div>
                <div class=\"col-sm-4\">";
        // line 8
        echo twig_escape_filter($this->env, trans("fecha_solicitud"), "html", null, true);
        echo ":<br/>";
        echo twig_escape_filter($this->env, app_str_date(app_now()), "html", null, true);
        echo "</div>
                <div class=\"col-sm-4\">
                    ";
        // line 10
        echo twig_escape_filter($this->env, trans("carro_estado_reserva"), "html", null, true);
        echo ":<br/>
                    ";
        // line 11
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "aconfirmar", array()) == 1)) {
            // line 12
            echo "                        ";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "
                    ";
        } else {
            // line 14
            echo "                        ";
            echo twig_escape_filter($this->env, trans("reserva_estado_confirmada"), "html", null, true);
            echo "
                    ";
        }
        // line 16
        echo "                </div>
            </div>
        </div>

        <div class=\"col-sm-12\">

            <div class=\"precio_reserva right\">
                <p class=\"verdana text-price-box\">";
        // line 23
        echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
        echo "</p>
                <p class=\"verdana yellow_lite text-price-box text-white\">";
        // line 24
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "price", array()), "smb"), "html", null, true);
        echo "</p>
            </div>

            <div id=\"hidden-";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "id", array()), "html", null, true);
        echo "\" class=\"verdana\" style=\"display: none\">
                ";
        // line 28
        echo twig_escape_filter($this->env, trans("al_habitaciones"), "html", null, true);
        echo " <br/>

                <div class=\"left\">
                    <p class=\"verdana\">";
        // line 31
        echo twig_escape_filter($this->env, trans("al_cantidad_habitaciones"), "html", null, true);
        echo ":<b>";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "habitaciones", array())), "html", null, true);
        echo "</b></p>
                </div>

                ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "habitaciones", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
            // line 35
            echo "                    ";
            $context["tipo_habitacion"] = app_get_tipo_habitacion($this->getAttribute($context["h"], "tipo_habitacion", array()));
            // line 36
            echo "                    ";
            $context["tipo_habitacion_nombre"] = app_traduccion("hotel", "hotel_tipo_hab_idioma", "nombre", "tipo_habitacion_fk", $this->getAttribute((isset($context["tipo_habitacion"]) ? $context["tipo_habitacion"] : null), "id", array()), $this->getAttribute((isset($context["tipo_habitacion"]) ? $context["tipo_habitacion"] : null), "nombre_habitacion", array()));
            // line 37
            echo "                    ";
            $context["plan_alimentacion"] = app_get_plan_alimentacion($this->getAttribute($context["h"], "plan", array()));
            // line 38
            echo "                    ";
            $context["plan_nombre"] = app_traduccion("hotel", "hotel_plan_idioma", "nombre", "plan_fk", $this->getAttribute((isset($context["plan_alimentacion"]) ? $context["plan_alimentacion"] : null), "id", array()), $this->getAttribute((isset($context["plan_alimentacion"]) ? $context["plan_alimentacion"] : null), "nombre_plan", array()));
            // line 39
            echo "                    ";
            $context["nuevos_paxs"] = app_convert_paxs(app_get_pax_habitacion($this->getAttribute((isset($context["tipo_habitacion"]) ? $context["tipo_habitacion"] : null), "id", array()), $this->getAttribute((isset($context["plan_alimentacion"]) ? $context["plan_alimentacion"] : null), "id", array()), $this->getAttribute($context["h"], "fecha", array())));
            // line 40
            echo "

                    ";
            // line 42
            echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, (isset($context["tipo_habitacion_nombre"]) ? $context["tipo_habitacion_nombre"] : null), "html", null, true);
            echo " <br/>
                    ";
            // line 43
            echo twig_escape_filter($this->env, trans("al_fecha_entrada"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, app_str_date($this->getAttribute($context["h"], "fecha", array())), "html", null, true);
            echo " <br/>
                    ";
            // line 44
            echo twig_escape_filter($this->env, trans("al_noches"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["h"], "noches", array()), "html", null, true);
            echo "<br/>

                    ";
            // line 46
            if ((($this->getAttribute($context["h"], "paquete_luna_miel", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["h"], "paquete_luna_miel", array()))) : (""))) {
                // line 47
                echo "                        ";
                $context["paquete_luna_miel"] = app_get_paquete_luna_miel($this->getAttribute($context["h"], "paquete_luna_miel", array()));
                // line 48
                echo "                        ";
                $context["paquete_luna_miel_nombre"] = app_traduccion("hotel", "hotel_pack_idioma", "nombre", "pack_fk", $this->getAttribute((isset($context["paquete_luna_miel"]) ? $context["paquete_luna_miel"] : null), "id", array()), $this->getAttribute((isset($context["paquete_luna_miel"]) ? $context["paquete_luna_miel"] : null), "nombre", array()));
                // line 49
                echo "
                        ";
                // line 50
                echo twig_escape_filter($this->env, trans("al_paquete_luna_miel"), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, (isset($context["paquete_luna_miel_nombre"]) ? $context["paquete_luna_miel_nombre"] : null), "html", null, true);
                echo "<br/>
                    ";
            }
            // line 52
            echo "
                    ";
            // line 53
            echo twig_escape_filter($this->env, trans("al_plan_alojamiento"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, (isset($context["plan_nombre"]) ? $context["plan_nombre"] : null), "html", null, true);
            echo "<br/>
                    ";
            // line 54
            echo twig_escape_filter($this->env, trans("al_pax"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, app_get_pax_opc((isset($context["nuevos_paxs"]) ? $context["nuevos_paxs"] : null), $this->getAttribute($context["h"], "paxs", array())), "html", null, true);
            echo "<br/>
                    ";
            // line 55
            echo twig_escape_filter($this->env, trans("al_hora_entrada"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["h"], "hora", array()), "html", null, true);
            echo "<br/>

                    ";
            // line 57
            if ((($this->getAttribute($context["h"], "ninno_adicional", array()) != "f") && (($this->getAttribute($context["h"], "ninno_adicional", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["h"], "ninno_adicional", array()))) : ("")))) {
                // line 58
                echo "                        ";
                echo twig_escape_filter($this->env, trans("al_ninno_adicional"), "html", null, true);
                echo "
                    ";
            }
            // line 60
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['h'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "
                ";
        // line 62
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "detalles", array()) != "")) {
            // line 63
            echo "                    ";
            echo twig_escape_filter($this->env, trans("detalles_adicionales"), "html", null, true);
            echo ":<br/>
                    <p class=\"verdana\">";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "detalles", array()), "html", null, true);
            echo "</p>
                ";
        }
        // line 66
        echo "            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-sm-12\">
            <a id=\"tog-";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "id", array()), "html", null, true);
        echo "\" class=\"toggle btn btn-default circle\" data-pick=\"";
        echo twig_escape_filter($this->env, trans("recoger"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, trans("otros_detalles"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, trans("otros_detalles"), "html", null, true);
        echo "</a>
            ";
        // line 73
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "aconfirmar", array()) == 2)) {
            // line 74
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, base_url(("con_reservacion/cancelar_producto_confirmado_car/" . $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\" class=\"btn btn-default buttom roman right\">";
            echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
            echo "</a>
            ";
        } else {
            // line 76
            echo "                <a class=\"btn btn-default circle buttom roman right\" href=\"";
            echo twig_escape_filter($this->env, trans("ruta_carro_compra_cancelar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\" >";
            echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
            echo "</a>
                <a class=\"btn btn-default circle buttom roman right margen_r\" href=\"";
            // line 77
            echo twig_escape_filter($this->env, trans("ruta_carro_compra_editar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("editar"), "html", null, true);
            echo "</a>
            ";
        }
        // line 79
        echo "        </div>

        <div class=\"col-sm-12\">
            <hr/>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "productos/alojamiento/template_car.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 79,  240 => 77,  233 => 76,  225 => 74,  223 => 73,  213 => 72,  205 => 66,  200 => 64,  195 => 63,  193 => 62,  190 => 61,  184 => 60,  178 => 58,  176 => 57,  169 => 55,  163 => 54,  157 => 53,  154 => 52,  147 => 50,  144 => 49,  141 => 48,  138 => 47,  136 => 46,  129 => 44,  123 => 43,  117 => 42,  113 => 40,  110 => 39,  107 => 38,  104 => 37,  101 => 36,  98 => 35,  94 => 34,  86 => 31,  80 => 28,  76 => 27,  70 => 24,  66 => 23,  57 => 16,  51 => 14,  45 => 12,  43 => 11,  39 => 10,  32 => 8,  28 => 7,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/alojamiento/template_car.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/alojamiento/template_car.twig");
    }
}
