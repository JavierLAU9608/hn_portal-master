<?php

/* noticia.twig */
class __TwigTemplate_38274e41b97bc174860f2a52caf4591d34b4a6cc0319ed5ea763a56ea8fbcac7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "noticia.twig", 1);
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
        // line 6
        $context["noticia_trans"] = app_traduccion("frontend", "frontend_noticia_idioma", null, "noticia_fk", $this->getAttribute((isset($context["noticia"]) ? $context["noticia"] : null), "id", array()), (isset($context["noticia"]) ? $context["noticia"] : null));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_noticias"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_noticias"), "html", null, true);
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "    <div class=\"container\">
        <div class=\"row\" style=\"padding-top: 200px;\">
            <div class=\"col-sm-12\">
                <img class=\"border left margen_r max_width\" title=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["noticia_trans"]) ? $context["noticia_trans"] : null), "titulo", array()), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, (app_url_admin() . ("/admin/noticia/noticia-" . $this->getAttribute((isset($context["noticia"]) ? $context["noticia"] : null), "imagen", array()))), "html", null, true);
        echo "\"/>

                <p>";
        // line 14
        echo $this->getAttribute((isset($context["noticia_trans"]) ? $context["noticia_trans"] : null), "texto", array());
        echo "</p>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "noticia.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 14,  53 => 12,  48 => 9,  45 => 8,  39 => 4,  33 => 3,  29 => 1,  27 => 6,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "noticia.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/noticia.twig");
    }
}
