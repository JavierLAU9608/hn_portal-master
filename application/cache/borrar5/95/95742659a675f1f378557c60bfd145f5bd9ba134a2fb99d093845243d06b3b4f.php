<?php

/* informativas/productos_a_confirmar.twig */
class __TwigTemplate_802b838bef55c1b4f05d1b540a8a562666cbfefdbd47501d5398182476929a95 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "informativas/productos_a_confirmar.twig", 1);
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
            <div class=\"alert alert-info\">";
        // line 7
        echo trans("reserva_texto_productos_a_confirmar");
        echo "</div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "informativas/productos_a_confirmar.twig";
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
        return new Twig_Source("", "informativas/productos_a_confirmar.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/informativas/productos_a_confirmar.twig");
    }
}
