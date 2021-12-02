<?php

/* home_pagina_footer_ajax.twig */
class __TwigTemplate_fb6497186bc43b25b119964f29febd2c17ea3c149dd4d582a8f0891cd7bc4d0c extends Twig_Template
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
        $context["pie_traduccion"] = app_traduccion("frontend", "frontend_menupie_idioma", null, "menu_footer_fk", $this->getAttribute((isset($context["pagina_footer"]) ? $context["pagina_footer"] : null), "id", array()), (isset($context["pagina_footer"]) ? $context["pagina_footer"] : null));
        // line 3
        echo "
";
        // line 4
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-sm-12\">
                <h1>";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pie_traduccion"]) ? $context["pie_traduccion"] : null), "nombre", array()), "html", null, true);
        echo "</h1>
                <hr/>
            </div>
            <div class=\"col-sm-12\">
                ";
        // line 12
        echo $this->getAttribute((isset($context["pie_traduccion"]) ? $context["pie_traduccion"] : null), "descripcion", array());
        echo "
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "home_pagina_footer_ajax.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 12,  39 => 8,  34 => 5,  28 => 4,  25 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home_pagina_footer_ajax.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/home_pagina_footer_ajax.twig");
    }
}
