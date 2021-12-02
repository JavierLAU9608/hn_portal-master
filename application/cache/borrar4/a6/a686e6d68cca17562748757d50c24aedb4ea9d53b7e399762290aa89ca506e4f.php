<?php

/* informativas/pago_pasarela_denegado.twig */
class __TwigTemplate_9669ecd5b295ed08f2b7f3ba020b1debe34a91b2bf8181588881d7935668c81f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "informativas/pago_pasarela_denegado.twig", 1);
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
            <div class=\"alert alert-danger\">
                ";
        // line 8
        echo trans("reserva_texto_pago_pasarela_denegado", array("email" => "jcomercial@gcnacio.gca.tur.cu", "link" => base_url("carro-compra")));
        echo "
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "informativas/pago_pasarela_denegado.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "informativas/pago_pasarela_denegado.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/informativas/pago_pasarela_denegado.twig");
    }
}
