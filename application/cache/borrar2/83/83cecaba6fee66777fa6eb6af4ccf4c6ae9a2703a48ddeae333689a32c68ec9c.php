<?php

/* administracion/historial_reservas_pagadas.twig */
class __TwigTemplate_da6f363fa193f73d46e4f6fa9dbb0671304e860597ee90711a7454ac24e7c7a8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/historial_reservas_pagadas.twig", 1);
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
        <div class=\"col-sm-3\">
            ";
        // line 7
        echo twig_escape_filter($this->env, menu_vertical(array("items" => (isset($context["items"]) ? $context["items"] : null), "item_activo" => (isset($context["item_activo"]) ? $context["item_activo"] : null))), "html", null, true);
        echo "
        </div>
        <div class=\"col-sm-9\">
            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reservas"]) ? $context["reservas"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 11
            echo "                ";
            echo $this->getAttribute($this->getAttribute($context["r"], "options", array()), "template_historial", array());
            echo "
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 13
            echo "                ";
            echo twig_escape_filter($this->env, trans("error_no_se_encontraron_elementos"), "html", null, true);
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/historial_reservas_pagadas.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 15,  55 => 13,  47 => 11,  42 => 10,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/historial_reservas_pagadas.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/historial_reservas_pagadas.twig");
    }
}
