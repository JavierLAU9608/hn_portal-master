<?php

/* administracion/calendario_pagos.twig */
class __TwigTemplate_cc9a13d087866e8befb1c3d929b8cb1f90f139b1a5cbb37b89785ac5297775e2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/calendario_pagos.twig", 1);
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
\t<div class=\"row\" style=\"padding-top: 200px;\">
\t\t<div class=\"col-sm-3\">
\t\t\t";
        // line 7
        echo twig_escape_filter($this->env, menu_vertical(array("items" => (isset($context["items"]) ? $context["items"] : null), "item_activo" => (isset($context["item_activo"]) ? $context["item_activo"] : null))), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-sm-9\">
\t\t\t";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reservas"]) ? $context["reservas"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 11
            echo "\t\t\t\t";
            echo $this->getAttribute($this->getAttribute($context["r"], "options", array()), "template_historial", array());
            echo "

\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t";
            // line 15
            echo twig_escape_filter($this->env, trans("user_pagos_pendientes"), "html", null, true);
            echo "
\t\t\t\t\t</div>

\t\t\t\t\t";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["r"], "options", array()), "calendario", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 19
                echo "\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t";
                // line 20
                echo twig_escape_filter($this->env, app_str_date($this->getAttribute($context["c"], "fecha", array())), "html", null, true);
                echo "

\t\t\t\t\t\t\t";
                // line 22
                if (($this->getAttribute($context["c"], "pago_porciento", array()) == "t")) {
                    // line 23
                    echo "\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["c"], "precio", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                } else {
                    // line 25
                    echo "\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["c"], "precio", array()), "smb"), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                }
                // line 27
                echo "
\t\t\t\t\t\t\t";
                // line 28
                if (($this->getAttribute($context["c"], "estado", array()) == "t")) {
                    // line 29
                    echo "\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, trans("estado_calendario_pagado"), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                } else {
                    // line 31
                    echo "\t\t\t\t\t\t\t\t<a class=\"btn btn-default\" href=\"";
                    echo twig_escape_filter($this->env, base_url(trans("ruta_pagar_calendario", array("producto" => $this->getAttribute($this->getAttribute($context["r"], "options", array()), "tipo", array()), "id" => $this->getAttribute($context["c"], "id", array())))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, trans("pagar"), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t";
                }
                // line 33
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<hr/>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "
\t\t\t\t</div>
\t\t\t";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 39
            echo "\t\t\t\t";
            echo twig_escape_filter($this->env, trans("error_no_se_encontraron_elementos"), "html", null, true);
            echo "
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/calendario_pagos.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 41,  121 => 39,  114 => 36,  106 => 33,  98 => 31,  92 => 29,  90 => 28,  87 => 27,  81 => 25,  75 => 23,  73 => 22,  68 => 20,  65 => 19,  61 => 18,  55 => 15,  47 => 11,  42 => 10,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/calendario_pagos.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/calendario_pagos.twig");
    }
}
