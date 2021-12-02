<?php

/* informativas/reserva_cancelada.twig */
class __TwigTemplate_bcb39eada274373a378ca4557f395b62b4cb97f5eb205250642657cc0d3d05fc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "informativas/reserva_cancelada.twig", 1);
        $this->blocks = array(
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"container\">
\t<div class=\"row\" style=\"padding-top: 200px;\">
\t\t<div class=\"col-sm-12\">
\t\t\t<div class=\"alert alert-info\">";
        // line 7
        echo trans("reserva_texto_cancelacion_reserva");
        echo "</div>
\t\t</div>
\t\t<div class=\"col-sm-12\">
\t\t\t<b>";
        // line 10
        echo trans("reserva_politica_cancelacion_aplicada");
        echo "</b><br/>
\t\t\t";
        // line 11
        echo twig_escape_filter($this->env, trans("titular_tarjeta_credito"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["titualar_tarjeta"]) ? $context["titualar_tarjeta"] : null), "html", null, true);
        echo "<br/>
\t\t\t";
        // line 12
        echo twig_escape_filter($this->env, trans("reserva_numero_reserva"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["no_reserva"]) ? $context["no_reserva"] : null), "html", null, true);
        echo "<br/>
\t\t\t";
        // line 13
        echo twig_escape_filter($this->env, trans("reserva_descuento_cancelacion"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["descuento"]) ? $context["descuento"] : null), "html", null, true);
        echo "<br/>
\t\t\t";
        // line 14
        echo twig_escape_filter($this->env, trans("reserva_reintegro_cancelacion"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["reintegro"]) ? $context["reintegro"] : null), "html", null, true);
        echo "<br/>
\t\t\t<br/>
\t\t\t<a class=\"btn btn-default\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, base_url(trans("ruta_historial")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, trans("user_historial"), "html", null, true);
        echo "</a>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "informativas/reserva_cancelada.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 16,  64 => 14,  58 => 13,  52 => 12,  46 => 11,  42 => 10,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "informativas/reserva_cancelada.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/informativas/reserva_cancelada.twig");
    }
}
