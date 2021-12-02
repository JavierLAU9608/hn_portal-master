<?php

/* error_404.twig */
class __TwigTemplate_9e8b4ba16ce93ccd9bff5554e6b95ece1c8e18b27056dfad3a690ebb1291cf38 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "error_404.twig", 1);
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
        echo "    <div class=\"container\">
        <div class=\"row\" style=\"padding-top: 200px;\">
            <div class=\"col-sm-12\">
                <h1>";
        // line 7
        echo twig_escape_filter($this->env, trans("error_404_encabezado"), "html", null, true);
        echo "</h1>
                <p>";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
        echo "</p>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "error_404.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 8,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "error_404.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/error_404.twig");
    }
}
