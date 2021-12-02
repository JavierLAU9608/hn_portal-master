<?php

/* carro_compra.twig */
class __TwigTemplate_9267d7e432e0f0c3d3aa6f74d3da4d2fa9eebca00018241035b3799efe798e15 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "carro_compra.twig", 1);
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
        <div class=\"col-sm-3 blog-sidebar\">
            <ul class=\"nav sidebar-categories\">
                ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 9
            echo "                    ";
            if (($this->getAttribute($context["item"], "url", array()) != "")) {
                // line 10
                echo "                        <li>
                            ";
                // line 11
                if ($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())) {
                    // line 12
                    echo "                                <a href=\"";
                    echo twig_escape_filter($this->env, base_url($this->getAttribute($context["item"], "url", array())), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "titulo", array()), "html", null, true);
                    echo "</a>
                            ";
                } else {
                    // line 14
                    echo "                                <a href=\"";
                    echo twig_escape_filter($this->env, ((base_url("login-page") . "/") . $this->getAttribute($context["item"], "url", array())), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "titulo", array()), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 16
                echo "                        </li>
                    ";
            }
            // line 18
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "            </ul>
        </div>

        <div class=\"col-sm-9 bg-form\">
            <h1 class=\"text-price\">";
        // line 23
        echo twig_escape_filter($this->env, trans("carro_compra_cantidad_productos", array("cantidad" => (isset($context["total_productos"]) ? $context["total_productos"] : null))), "html", null, true);
        echo "</h1>
            <hr/>
            <div class=\"row \">
                <div class=\"col-sm-12\">
                    ";
        // line 27
        if (((isset($context["total_productos"]) ? $context["total_productos"] : null) > 0)) {
            // line 28
            echo "                        ";
            $context["importe_a_confirmar"] = 0;
            // line 29
            echo "                        ";
            $context["importe_a_pagar"] = 0;
            // line 30
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["lista_productos_carro"]) ? $context["lista_productos_carro"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["producto"]) {
                // line 31
                echo "                            ";
                echo $this->getAttribute($this->getAttribute($context["producto"], "options", array()), "template_car", array());
                echo "
                            ";
                // line 32
                if (($this->getAttribute($this->getAttribute($context["producto"], "options", array()), "aconfirmar", array()) == 1)) {
                    // line 33
                    echo "                                ";
                    $context["importe_a_confirmar"] = ((isset($context["importe_a_confirmar"]) ? $context["importe_a_confirmar"] : null) + $this->getAttribute($context["producto"], "price", array()));
                    // line 34
                    echo "                            ";
                } else {
                    // line 35
                    echo "                                ";
                    $context["importe_a_pagar"] = ((isset($context["importe_a_pagar"]) ? $context["importe_a_pagar"] : null) + $this->getAttribute($context["producto"], "price", array()));
                    // line 36
                    echo "                            ";
                }
                // line 37
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['producto'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "                    ";
        }
        // line 39
        echo "                </div>

                ";
        // line 41
        if (((isset($context["total_productos"]) ? $context["total_productos"] : null) > 0)) {
            // line 42
            echo "                    <div class=\"col-sm-3\">
                        <a class=\"btn btn-default-booking circle buttom roman no_margen\" href=\"";
            // line 43
            echo twig_escape_filter($this->env, trans("ruta_datos_reserva"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("carro_compra_continuar"), "html", null, true);
            echo "</a>
                    </div>
                ";
        }
        // line 46
        echo "
";
        // line 50
        echo "
";
        // line 52
        echo "
";
        // line 55
        echo "
";
        // line 59
        echo "
";
        // line 63
        echo "
                <div class=\"col-sm-3 col-sm-offset-9\">
                    <div class=\"precio_reserva pull-right\">
                        <p class=\"verdana text-price-box text-black\">";
        // line 66
        echo twig_escape_filter($this->env, trans("importe_a_pagar"), "html", null, true);
        echo "</p>

                        <p class=\"verdana yellow_bg text-price-hab text-white\">";
        // line 68
        echo twig_escape_filter($this->env, app_rate_cambio((isset($context["importe_a_pagar"]) ? $context["importe_a_pagar"] : null), "smb"), "html", null, true);
        echo "</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "carro_compra.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 68,  166 => 66,  161 => 63,  158 => 59,  155 => 55,  152 => 52,  149 => 50,  146 => 46,  138 => 43,  135 => 42,  133 => 41,  129 => 39,  126 => 38,  120 => 37,  117 => 36,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 31,  96 => 30,  93 => 29,  90 => 28,  88 => 27,  81 => 23,  75 => 19,  69 => 18,  65 => 16,  57 => 14,  49 => 12,  47 => 11,  44 => 10,  41 => 9,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "carro_compra.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/carro_compra.twig");
    }
}
