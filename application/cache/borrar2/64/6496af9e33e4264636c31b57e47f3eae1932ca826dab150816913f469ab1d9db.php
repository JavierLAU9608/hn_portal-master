<?php

/* productos/oferta/template_historial.twig */
class __TwigTemplate_0a665fe4dc6cb960059ba079a7491f4e1ad43df2f0c01fa95910ad444db91a57 extends Twig_Template
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
        $context["oferta_traducido"] = app_get_oferta($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_oferta", array()));
        // line 2
        echo "
<div class=\"row\">
\t<div class=\"col-sm-4\">
\t\t";
        // line 5
        echo twig_escape_filter($this->env, trans("serivicio_nombre", array("nombre" => trans("oferta"))), "html", null, true);
        echo "
\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 8
        echo twig_escape_filter($this->env, trans("of_oferta"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "nombre", array()), "html", null, true);
        echo "
\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 11
        echo twig_escape_filter($this->env, trans("of_fecha"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, app_str_date($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "fecha", array())), "html", null, true);
        echo "
\t</div>
</div>

<div class=\"row\">
\t<div class=\"col-sm-4\">
\t\t";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "no_reserva", array()), "html", null, true);
        echo "
\t</div>

\t<div class=\"col-sm-4\">
\t\t";
        // line 21
        if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "estado", array()) == 4)) {
            // line 22
            echo "\t\t\t<a class=\"btn btn-default\" href=\"";
            echo twig_escape_filter($this->env, trans("ruta_voucher_producto", array("producto" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "tipo", array()), "id" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_reserva", array()))), "html", null, true);
            echo "\" >
\t\t\t\t<i class=\"fa fa-file-pdf-o\"></i> ";
            // line 23
            echo twig_escape_filter($this->env, trans("voucher"), "html", null, true);
            echo "
\t\t\t</a>
\t\t\t";
            // line 25
            if (($this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "fecha", array()) > app_now())) {
                // line 26
                echo "\t\t\t\t<a class=\"btn btn-danger\" href=\"";
                echo twig_escape_filter($this->env, trans("ruta_cancelar_producto_pagado", array("producto" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "tipo", array()), "id" => $this->getAttribute((isset($context["datos_adicionales"]) ? $context["datos_adicionales"] : null), "id_reserva", array()))), "html", null, true);
                echo "\" >
\t\t\t\t\t<i class=\"fa fa-trash\"></i>  ";
                // line 27
                echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
                echo "
\t\t\t\t</a>
\t\t\t";
            }
            // line 30
            echo "\t\t";
        }
        // line 31
        echo "\t</div>
\t<div class=\"col-sm-4\">
\t\t";
        // line 33
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
        return "productos/oferta/template_historial.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 33,  86 => 31,  83 => 30,  77 => 27,  72 => 26,  70 => 25,  65 => 23,  60 => 22,  58 => 21,  51 => 17,  40 => 11,  32 => 8,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/oferta/template_historial.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/oferta/template_historial.twig");
    }
}
