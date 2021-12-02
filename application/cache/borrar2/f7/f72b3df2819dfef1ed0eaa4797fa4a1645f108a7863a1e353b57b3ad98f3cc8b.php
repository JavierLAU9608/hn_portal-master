<?php

/* productos/evento/tipo_servicio.twig */
class __TwigTemplate_f2e155d3002410e930ab43bc94a3b9fed5dc673b00fc76f285c14a19cafd58d8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
";
        // line 2
        $context["nombre_trans"] = app_traduccion("evento", "evento_tipos_idioma", null, "tipo_servicio_fk", $this->getAttribute((isset($context["tipo_servicio"]) ? $context["tipo_servicio"] : null), "id", array()), (isset($context["tipo_servicio"]) ? $context["tipo_servicio"] : null));
        // line 7
        echo "
";
        // line 8
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "\t<div class=\"container\">
\t\t<div class=\"row\">
            <h2>";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nombre_trans"]) ? $context["nombre_trans"] : null), "nombre", array()), "html", null, true);
        echo "  </h2>
            ";
        // line 12
        echo $this->getAttribute((isset($context["nombre_trans"]) ? $context["nombre_trans"] : null), "descripcion", array());
        echo "
\t\t</div>
\t</div>

";
    }

    public function getTemplateName()
    {
        return "productos/evento/tipo_servicio.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 12,  38 => 11,  34 => 9,  28 => 8,  25 => 7,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/evento/tipo_servicio.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/evento/tipo_servicio.twig");
    }
}
