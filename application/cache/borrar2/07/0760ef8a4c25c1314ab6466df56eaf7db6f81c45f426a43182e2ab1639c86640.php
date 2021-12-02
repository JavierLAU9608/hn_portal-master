<?php

/* productos/alojamiento/template_historial.twig */
class __TwigTemplate_d6d72708102a77afe4c4dd8b43fa765f8ccf30bd8c98fb9a38520164b08d2314 extends Twig_Template
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
        echo "<div class=\"row\">
\t<div class=\"col-sm-4\">
\t\t";
        // line 3
        echo twig_escape_filter($this->env, trans("serivicio_nombre", array("nombre" => trans("alojamiento"))), "html", null, true);
        echo "
\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 6
        echo twig_escape_filter($this->env, trans("al_cantidad_habitaciones"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "habitaciones", array())), "html", null, true);
        echo "
\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 9
        echo twig_escape_filter($this->env, trans("rt_dia_reservacion"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, app_str_date($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "fecha", array())), "html", null, true);
        echo "
\t</div>
</div>

<div class=\"row\">
\t<div class=\"col-sm-4\">
\t\t";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "no_reserva", array()), "html", null, true);
        echo "
\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 18
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "estado", array()) == 4)) {
            // line 19
            echo "\t\t\t<a class=\"btn btn-default\" href=\"";
            echo twig_escape_filter($this->env, trans("ruta_voucher_producto", array("producto" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "tipo", array()), "id" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_reserva", array()))), "html", null, true);
            echo "\" >
\t\t\t\t<i class=\"fa fa-file-pdf-o\"></i> ";
            // line 20
            echo twig_escape_filter($this->env, trans("voucher"), "html", null, true);
            echo "
\t\t\t</a>

\t\t\t";
            // line 23
            if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "fecha", array()) > app_now())) {
                // line 24
                echo "\t\t\t\t<a class=\"btn btn-danger\" href=\"";
                echo twig_escape_filter($this->env, trans("ruta_cancelar_producto_pagado", array("producto" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "tipo", array()), "id" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_reserva", array()))), "html", null, true);
                echo "\" >
\t\t\t\t\t<i class=\"fa fa-trash\"></i>  ";
                // line 25
                echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
                echo "
\t\t\t\t</a>
\t\t\t";
            }
            // line 28
            echo "\t\t";
        }
        // line 29
        echo "\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 31
        echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "price", array()), "smb"), "html", null, true);
        echo "
\t</div>
</div>

<hr/>";
    }

    public function getTemplateName()
    {
        return "productos/alojamiento/template_historial.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 31,  83 => 29,  80 => 28,  74 => 25,  69 => 24,  67 => 23,  61 => 20,  56 => 19,  54 => 18,  48 => 15,  37 => 9,  29 => 6,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/alojamiento/template_historial.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/alojamiento/template_historial.twig");
    }
}
