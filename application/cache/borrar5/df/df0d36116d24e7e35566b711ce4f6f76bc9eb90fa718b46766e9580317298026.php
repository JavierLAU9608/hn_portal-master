<?php

/* productos/oferta/oferta.twig */
class __TwigTemplate_9e6836ae6836d7a0a92ddc60b2cce1a745f99ca55955d1e336e4ca08b729c87a extends Twig_Template
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
        $context["oferta_traducido"] = app_traduccion("oferta", "oferta_idioma", null, "oferta_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "id", array()), (isset($context["oferta"]) ? $context["oferta"] : null));
        // line 3
        $context["oferta_tipo_traducido"] = app_traduccion("oferta", "oferta_tipo_idioma", null, "tipo_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo_fk", array()), $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo", array()));
        // line 4
        echo "
";
        // line 5
        $this->displayBlock('content', $context, $blocks);
        // line 15
        echo "
";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-sm-12\">
            <h4>";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "nombre", array()), "html", null, true);
        echo "</h4>
            <p>";
        // line 10
        echo $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "descripcion", array());
        echo "</p>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "productos/oferta/oferta.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 10,  45 => 9,  40 => 6,  37 => 5,  32 => 15,  30 => 5,  27 => 4,  25 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/oferta/oferta.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/oferta/oferta.twig");
    }
}
