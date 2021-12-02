<?php

/* informativas/pago_pasarela.twig */
class __TwigTemplate_5c3deb27a5ffa39e8f6a199c3516f24979a2584a3d276f8ae3985a5f2a83db0f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "informativas/pago_pasarela.twig", 1);
        $this->blocks = array(
            'pixel' => array($this, 'block_pixel'),
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
    public function block_pixel($context, array $blocks = array())
    {
        // line 4
        echo "    <!-- Event facebook -->
    <script>
        fbq('track', 'Purchase', {
            'value': ";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["amount"]) ? $context["amount"] : null), "html", null, true);
        echo ",
            'currency': '";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["currency"]) ? $context["currency"] : null), "html", null, true);
        echo "'
        });
    </script>
    <!-- end Event facebook -->

    <!-- Event snippet for Ventas conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-861553772/eNrjCNiqmpgBEOyI6ZoD',
            'value': ";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["amount"]) ? $context["amount"] : null), "html", null, true);
        echo ",
            'currency': '";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["currency"]) ? $context["currency"] : null), "html", null, true);
        echo "',
            'transaction_id': '";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["transaction"]) ? $context["transaction"] : null), "html", null, true);
        echo "' });
    </script>
    <!-- End Event snippet for Ventas conversion page -->
";
    }

    // line 24
    public function block_content($context, array $blocks = array())
    {
        // line 25
        echo "    <div class=\"container\">
        <div class=\"row\" style=\"padding-top: 200px;\">
            <div class=\"col-sm-12\">
                <div class=\"alert alert-info\">";
        // line 28
        echo trans("reserva_texto_pago_pasarela_aceptado");
        echo "</div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "informativas/pago_pasarela.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 28,  72 => 25,  69 => 24,  61 => 19,  57 => 18,  53 => 17,  41 => 8,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "informativas/pago_pasarela.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/informativas/pago_pasarela.twig");
    }
}
