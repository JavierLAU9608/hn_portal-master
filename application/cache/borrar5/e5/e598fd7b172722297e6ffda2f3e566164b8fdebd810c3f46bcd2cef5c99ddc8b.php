<?php

/* administracion/cuenta-activada.twig */
class __TwigTemplate_6f2d238b557c45f2c5171f0256ad3d468fc3cc7431bf74265f68959e06d651a3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/cuenta-activada.twig", 1);
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
    <div class=\"row\" style=\"padding-top: 200px;\">
        <div class=\"col-sm-12\">
            ";
        // line 7
        echo twig_escape_filter($this->env, trans("user_texto_cuenta_activada"), "html", null, true);
        echo "
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/cuenta-activada.twig";
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
        return new Twig_Source("", "administracion/cuenta-activada.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/cuenta-activada.twig");
    }
}
