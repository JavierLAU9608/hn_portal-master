<?php

/* home_pagina_footer.twig */
class __TwigTemplate_671ab0f204f102deb9e0a02a15a39ed578562dcc467d54ec763457299a9e150b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "home_pagina_footer.twig", 1);
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
        // line 3
        $context["pie_traduccion"] = app_traduccion("frontend", "frontend_menupie_idioma", null, "menu_footer_fk", $this->getAttribute((isset($context["pagina_footer"]) ? $context["pagina_footer"] : null), "id", array()), (isset($context["pagina_footer"]) ? $context["pagina_footer"] : null));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pie_traduccion"]) ? $context["pie_traduccion"] : null), "description", array()), "html", null, true);
    }

    // line 6
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pie_traduccion"]) ? $context["pie_traduccion"] : null), "keywords", array()), "html", null, true);
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "    <div class=\"container\">
        <div class=\"row\" style=\"padding-top: 200px;\">
            <div class=\"col-sm-3 blog-sidebar\">
                ";
        // line 12
        echo twig_escape_filter($this->env, menu_vertical(array("items" => (isset($context["items"]) ? $context["items"] : null), "item_activo" => (isset($context["item_activo"]) ? $context["item_activo"] : null))), "html", null, true);
        echo "
            </div>
            <div class=\"col-sm-9\">
                ";
        // line 15
        echo $this->getAttribute((isset($context["pie_traduccion"]) ? $context["pie_traduccion"] : null), "descripcion", array());
        echo "
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "home_pagina_footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 15,  53 => 12,  48 => 9,  45 => 8,  39 => 6,  33 => 5,  29 => 1,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home_pagina_footer.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/home_pagina_footer.twig");
    }
}
