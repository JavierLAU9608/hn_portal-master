<?php

/* informativas/contacto.twig */
class __TwigTemplate_7b9d668cff29e97217955ec6b520e46cf06caffb7113bc5cc8bebb1b317d2c53 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "informativas/contacto.twig", 1);
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
                <div class=\"alert alert-info\">";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["info"]) ? $context["info"] : null), "html", null, true);
        echo "</div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "informativas/contacto.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "informativas/contacto.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/informativas/contacto.twig");
    }
}
