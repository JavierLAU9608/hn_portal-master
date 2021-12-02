<?php

/* productos/alojamiento/reserva_02.twig */
class __TwigTemplate_6dab89b40faf48bdee4d484649998b558f57c82ebc06468875dad53fd69e4c55 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "productos/alojamiento/reserva_02.twig", 1);
        $this->blocks = array(
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_alojamiento"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_alojamiento"), "html", null, true);
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "<div class=\"container bg-form\">
    <div id=\"center_area\"  style=\"padding-top: 200px;\" class=\"content\">
        <div id=\"form_reserva_evento\" class=\"form border_drk\">
            ";
        // line 10
        if (($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "aconfirmar", array()) == 1)) {
            // line 11
            echo "                <span class=\"black right\"><b>";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "</b></span>
            ";
        }
        // line 13
        echo "
            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <h2>";
        // line 16
        echo twig_escape_filter($this->env, trans("alojamiento"), "html", null, true);
        echo "</h2>
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <label class=\"verdana detail\"><b>";
        // line 22
        echo twig_escape_filter($this->env, trans("al_cantidad_habitaciones"), "html", null, true);
        echo ":</b></label>
                    <label class=\"verdana detail\">
                        ";
        // line 24
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "habitaciones", array())), "html", null, true);
        echo "
                    </label>
                </div>
            </div>

            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "habitaciones", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
            // line 30
            echo "            <div class=\"row\">
                <div class=\"col-sm-6\">
                    ";
            // line 32
            $context["tipo_habitacion"] = app_get_tipo_habitacion($this->getAttribute($context["h"], "tipo_habitacion", array()));
            // line 33
            echo "                    ";
            $context["tipo_habitacion_nombre"] = app_traduccion("hotel", "hotel_tipo_hab_idioma", "nombre", "tipo_habitacion_fk", $this->getAttribute((isset($context["tipo_habitacion"]) ? $context["tipo_habitacion"] : null), "id", array()), $this->getAttribute((isset($context["tipo_habitacion"]) ? $context["tipo_habitacion"] : null), "nombre_habitacion", array()));
            // line 34
            echo "             
                    <label><b>";
            // line 35
            echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 36
            echo twig_escape_filter($this->env, (isset($context["tipo_habitacion_nombre"]) ? $context["tipo_habitacion_nombre"] : null), "html", null, true);
            echo "</label><br/>
                </div>
                <div class=\"col-sm-6\">
                    <label><b>";
            // line 39
            echo twig_escape_filter($this->env, trans("al_fecha_entrada"), "html", null, true);
            echo ":</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 40
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["h"], "fecha", array()), "Y-m-d"), "html", null, true);
            echo "</label><br/>
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-6\">
                    <label><b>";
            // line 46
            echo twig_escape_filter($this->env, trans("al_hora_entrada"), "html", null, true);
            echo ":</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["h"], "hora", array()), "html", null, true);
            echo "</label><br/>
                </div>
                <div class=\"col-sm-6\">
                    ";
            // line 50
            $context["plan_alimentacion"] = app_get_plan_alimentacion($this->getAttribute($context["h"], "plan", array()));
            // line 51
            echo "                    ";
            $context["plan_nombre"] = app_traduccion("hotel", "hotel_plan_idioma", null, "plan_fk", $this->getAttribute((isset($context["plan_alimentacion"]) ? $context["plan_alimentacion"] : null), "id", array()), $this->getAttribute((isset($context["plan_alimentacion"]) ? $context["plan_alimentacion"] : null), "nombre_plan", array()));
            // line 52
            echo "
                    <label><b>";
            // line 53
            echo twig_escape_filter($this->env, trans("al_plan_alojamiento"), "html", null, true);
            echo ":</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 54
            echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["plan_nombre"]) ? $context["plan_nombre"] : null), "nombre", array()) . " (") . $this->getAttribute((isset($context["plan_nombre"]) ? $context["plan_nombre"] : null), "descripcion", array())) . ")"), "html", null, true);
            echo "</label><br/>
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-6\">
                    <label><b>";
            // line 60
            echo twig_escape_filter($this->env, trans("al_pax"), "html", null, true);
            echo ":</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 61
            echo twig_escape_filter($this->env, app_get_pax_opc((isset($context["nuevos_paxs"]) ? $context["nuevos_paxs"] : null), $this->getAttribute($context["h"], "paxs", array())), "html", null, true);
            echo "</label><br/>
                </div>
                <div class=\"col-sm-6\">
                    <label><b>";
            // line 64
            echo twig_escape_filter($this->env, trans("al_cantidad_noches"), "html", null, true);
            echo ":</b></label><br/>
                    <label class=\"verdana detail\">";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["h"], "noches", array()), "html", null, true);
            echo "</label><br/>
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-6\">
                    ";
            // line 71
            if (($this->getAttribute($context["h"], "paquete_luna_miel", array()) > 0)) {
                // line 72
                echo "                    ";
                $context["paquete_luna_miel"] = app_get_paquete_luna_miel($this->getAttribute($context["h"], "paquete_luna_miel", array()));
                // line 73
                echo "                    ";
                $context["paquete_luna_miel_nombre"] = app_traduccion("hotel", "hotel_pack_idioma", "nombre", "pack_fk", $this->getAttribute((isset($context["paquete_luna_miel"]) ? $context["paquete_luna_miel"] : null), "id", array()), $this->getAttribute((isset($context["paquete_luna_miel"]) ? $context["paquete_luna_miel"] : null), "nombre", array()));
                // line 74
                echo "
                        <label><b>";
                // line 75
                echo twig_escape_filter($this->env, trans("al_paquete_luna_miel"), "html", null, true);
                echo "</b>:</label><br/>
                        <label class=\"verdana detail\">";
                // line 76
                echo twig_escape_filter($this->env, (isset($context["paquete_luna_miel_nombre"]) ? $context["paquete_luna_miel_nombre"] : null), "html", null, true);
                echo "</label><br/>
                
                    ";
            }
            // line 79
            echo "                </div>
                <div class=\"col-sm-6\">
                    ";
            // line 81
            if ((($this->getAttribute($context["h"], "ninno_adicional", array()) != "f") && (($this->getAttribute($context["h"], "ninno_adicional", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["h"], "ninno_adicional", array()))) : ("")))) {
                // line 82
                echo "                    <label class=\"verdana detail\"><b>";
                echo twig_escape_filter($this->env, trans("al_ninno_adicional"), "html", null, true);
                echo "</b></label><br/>
                    ";
            }
            // line 84
            echo "                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <hr/>
                </div>
            </div>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['h'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        echo "

            ";
        // line 95
        if (($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "detalles", array()) != "")) {
            // line 96
            echo "                <div class=\"row\">
                    <div class=\"col-sm-12\">
                        <label>";
            // line 98
            echo twig_escape_filter($this->env, trans("detalles_adicionales"), "html", null, true);
            echo "</label>
                        <br/>
                        ";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "detalles", array()), "html", null, true);
            echo "
                    </div>

                    <div class=\"col-sm-12\">
                        <hr/>
                    </div>
                </div>
            ";
        }
        // line 108
        echo "     
        <div class=\"precio_reserva\">
            <p class=\"verdana text-price-box text-black\">";
        // line 110
        echo twig_escape_filter($this->env, trans("pagar"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "price", array()), "smb"), "html", null, true);
        echo "</p>

            <a class=\"btn btn-default circle buttom roman\" href=\"";
        // line 112
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra_editar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array())))), "html", null, true);
        echo "\"  title=\"";
        echo twig_escape_filter($this->env, trans("anterior"), "html", null, true);
        echo "\">
                ";
        // line 113
        echo twig_escape_filter($this->env, trans("anterior"), "html", null, true);
        echo "
            </a>
            <a class=\"btn btn-default circle buttom roman\"  title=\"";
        // line 115
        echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
        echo "\" href=\"";
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra_cancelar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array())))), "html", null, true);
        echo "\">
                ";
        // line 116
        echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
        echo "
            </a>
            <a class=\"btn btn-default circle buttom roman\" href=\"";
        // line 118
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra")), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, trans("ver_carrito"), "html", null, true);
        echo "\">
                ";
        // line 119
        echo twig_escape_filter($this->env, trans("ver_carrito"), "html", null, true);
        echo "
            </a>
        </div>
        <br class=\"clean\" /><br/>
    </div>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "productos/alojamiento/reserva_02.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  313 => 119,  307 => 118,  302 => 116,  296 => 115,  291 => 113,  285 => 112,  278 => 110,  274 => 108,  263 => 100,  258 => 98,  254 => 96,  252 => 95,  248 => 93,  226 => 84,  220 => 82,  218 => 81,  214 => 79,  208 => 76,  204 => 75,  201 => 74,  198 => 73,  195 => 72,  193 => 71,  184 => 65,  180 => 64,  174 => 61,  170 => 60,  161 => 54,  157 => 53,  154 => 52,  151 => 51,  149 => 50,  143 => 47,  139 => 46,  130 => 40,  126 => 39,  120 => 36,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  102 => 30,  85 => 29,  77 => 24,  72 => 22,  63 => 16,  58 => 13,  52 => 11,  50 => 10,  45 => 7,  42 => 6,  36 => 4,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/alojamiento/reserva_02.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/alojamiento/reserva_02.twig");
    }
}
