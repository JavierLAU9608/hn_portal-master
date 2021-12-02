<?php

/* productos/oferta/template_car.twig */
class __TwigTemplate_eea055ddbedcec7e6f293ddfedc03c5329fdfab4473011fa0d5541852f48c73b extends Twig_Template
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
";
        // line 3
        $context["oferta_traducido"] = app_get_oferta($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_oferta", array()));
        // line 4
        $context["oferta_tipo_traducido"] = app_traduccion("oferta", "oferta_tipo_idioma", null, "tipo_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo_fk", array()), $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo", array()));
        // line 5
        echo "
<div>
    <div class=\"row\">
        <div class=\"col-sm-12\">
            <div class=\"row\">
                <div class=\"col-sm-4\">";
        // line 10
        echo twig_escape_filter($this->env, trans("serivicio_nombre", array("nombre" => trans("oferta"))), "html", null, true);
        echo "</div>
                <div class=\"col-sm-4\">";
        // line 11
        echo twig_escape_filter($this->env, trans("fecha_solicitud"), "html", null, true);
        echo ":<br/>";
        echo twig_escape_filter($this->env, app_str_date(app_now()), "html", null, true);
        echo "</div>
                <div class=\"col-sm-4\">
                    ";
        // line 13
        echo twig_escape_filter($this->env, trans("carro_estado_reserva"), "html", null, true);
        echo ":<br/>
                    ";
        // line 14
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "aconfirmar", array()) == 1)) {
            // line 15
            echo "                        ";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "
                    ";
        } else {
            // line 17
            echo "                        ";
            echo twig_escape_filter($this->env, trans("reserva_estado_confirmada"), "html", null, true);
            echo "
                    ";
        }
        // line 19
        echo "                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <p class=\"verdana text-price-box\">";
        // line 24
        echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
        echo "</p>
                    <span></span>
                    <p class=\"verdana yellow_lite text-price-box text-white\">";
        // line 26
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "price", array()), "smb"), "html", null, true);
        echo "</p>
                </div>
            </div>
        </div>

";
        // line 32
        echo "
        <div class=\"col-sm-12\" id=\"hidden-";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "id", array()), "html", null, true);
        echo "\" style=\"display: none\">
            <div class=\"left\">
                <p class=\"verdana\"><b>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_tipo_traducido"]) ? $context["oferta_tipo_traducido"] : null), "nombre", array()), "html", null, true);
        echo "</b></p>
                <p class=\"verdana\">";
        // line 36
        echo twig_escape_filter($this->env, trans("of_oferta"), "html", null, true);
        echo ": <b>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "nombre", array()), "html", null, true);
        echo "</b></p>
                <p class=\"verdana\">";
        // line 37
        echo twig_escape_filter($this->env, trans("of_fecha"), "html", null, true);
        echo ": <b>";
        echo twig_escape_filter($this->env, app_str_date($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "fecha", array())), "html", null, true);
        echo "</b></p>

                ";
        // line 39
        if (((($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array(), "any", false, true), "is_boda", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array(), "any", false, true), "is_boda", array()), false)) : (false)) == false)) {
            // line 40
            echo "                    <p class=\"verdana\">";
            echo twig_escape_filter($this->env, trans("of_cantidad"), "html", null, true);
            echo ": <b>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "cantidad", array()), "html", null, true);
            echo "</b></p>
                    <p class=\"verdana\">";
            // line 41
            echo twig_escape_filter($this->env, trans("of_cantidad_dias"), "html", null, true);
            echo ": <b>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "cantidad_dias", array()), "html", null, true);
            echo "</b></p>
                ";
        }
        // line 43
        echo "
            </div>

            <div class=\"verdana\">
                ";
        // line 47
        if ($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "detalles", array())) {
            // line 48
            echo "                    ";
            echo twig_escape_filter($this->env, trans("of_solicitud_adicional"), "html", null, true);
            echo "<br/>
                    ";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "detalles", array()), "html", null, true);
            echo "
                ";
        }
        // line 51
        echo "            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-sm-12\">
            <a id=\"tog-";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "id", array()), "html", null, true);
        echo "\" class=\"toggle btn btn-default circle\" data-pick=\"";
        echo twig_escape_filter($this->env, trans("recoger"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, trans("otros_detalles"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, trans("otros_detalles"), "html", null, true);
        echo "</a>

            ";
        // line 59
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "aconfirmar", array()) == 2)) {
            // line 60
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, base_url(("con_reservacion/cancelar_producto_confirmado_car/" . $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\" class=\"btn btn-danger\">";
            echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
            echo "</a>
            ";
        } else {
            // line 62
            echo "                <a class=\"btn btn-default circle\" href=\"";
            echo twig_escape_filter($this->env, trans("ruta_carro_compra_cancelar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
            echo "</a>
                <a class=\"btn btn-default circle\" href=\"";
            // line 63
            echo twig_escape_filter($this->env, trans("ruta_carro_compra_editar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array()))), "html", null, true);
            echo "\" >";
            echo twig_escape_filter($this->env, trans("editar"), "html", null, true);
            echo "</a>
            ";
        }
        // line 65
        echo "        </div>
    </div>
    <hr/>
</div>";
    }

    public function getTemplateName()
    {
        return "productos/oferta/template_car.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 65,  179 => 63,  172 => 62,  164 => 60,  162 => 59,  151 => 57,  143 => 51,  138 => 49,  133 => 48,  131 => 47,  125 => 43,  118 => 41,  111 => 40,  109 => 39,  102 => 37,  96 => 36,  92 => 35,  87 => 33,  84 => 32,  76 => 26,  71 => 24,  64 => 19,  58 => 17,  52 => 15,  50 => 14,  46 => 13,  39 => 11,  35 => 10,  28 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/oferta/template_car.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/oferta/template_car.twig");
    }
}
