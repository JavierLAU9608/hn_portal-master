<?php

/* productos/oferta/reserva_02.twig */
class __TwigTemplate_c828b7969c235184c83b7a50f6eaf5ddbc3fdb1b1a2f4e2541edf44c9363196a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "productos/oferta/reserva_02.twig", 1);
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
        // line 3
        $context["oferta_traducido"] = app_traduccion("oferta", "oferta_idioma", null, "oferta_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "id", array()), (isset($context["oferta"]) ? $context["oferta"] : null));
        // line 4
        $context["oferta_tipo_traducido"] = app_traduccion("oferta", "oferta_tipo_idioma", null, "tipo_fk", $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo_fk", array()), $this->getAttribute((isset($context["oferta"]) ? $context["oferta"] : null), "tipo", array()));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_ofertas"), "html", null, true);
    }

    // line 7
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_ofertas"), "html", null, true);
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "<div class=\"container\">
    <div class=\"row bg-form padding-bottom-20\" style=\"padding-top: 200px\">
        <div class=\"col-sm-12\">
            ";
        // line 13
        if (($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "aconfirmar", array()) == 1)) {
            // line 14
            echo "                ";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "
            ";
        }
        // line 16
        echo "            
            <h4 class=\"text-price-hab\">";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_tipo_traducido"]) ? $context["oferta_tipo_traducido"] : null), "nombre", array()), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["oferta_traducido"]) ? $context["oferta_traducido"] : null), "nombre", array()), "html", null, true);
        echo "</h4>

            <br/><br/>
            ";
        // line 20
        echo twig_escape_filter($this->env, trans("of_fecha"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, app_str_date($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "fecha", array())), "html", null, true);
        echo "<br/>

            ";
        // line 22
        if (((isset($context["is_boda"]) ? $context["is_boda"] : null) == false)) {
            // line 23
            echo "                ";
            echo twig_escape_filter($this->env, trans("of_cantidad"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "cantidad", array()), "html", null, true);
            echo "<br/>
                ";
            // line 24
            echo twig_escape_filter($this->env, trans("of_cantidad_dias"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "cantidad_dias", array()), "html", null, true);
            echo "<br/>
            ";
        } else {
            // line 26
            echo "                <br><br>
            ";
        }
        // line 28
        echo "

            ";
        // line 30
        if ($this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "detalles", array())) {
            // line 31
            echo "                ";
            echo twig_escape_filter($this->env, trans("of_solicitud_adicional"), "html", null, true);
            echo ": <br/>
                ";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "options", array()), "detalles", array()), "html", null, true);
            echo "<br/>
            ";
        }
        // line 34
        echo "            
            <span class=\"text-price-hab\">";
        // line 35
        echo twig_escape_filter($this->env, trans("pagar"), "html", null, true);
        echo ":</span> <span class=\"text-price-hab text-white\">";
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "price", array()), "smb"), "html", null, true);
        echo "</span><br/><br/>

           
            <a class=\"btn btn-default circle\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra_editar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array())))), "html", null, true);
        echo "\">
                ";
        // line 39
        echo twig_escape_filter($this->env, trans("anterior"), "html", null, true);
        echo "
            </a>
            <a class=\"btn btn-default circle\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra_cancelar", array("rowid" => $this->getAttribute((isset($context["producto"]) ? $context["producto"] : null), "rowid", array())))), "html", null, true);
        echo "\">
                ";
        // line 42
        echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
        echo "
            </a>
            <a class=\"btn btn-default circle\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, base_url(trans("ruta_carro_compra")), "html", null, true);
        echo "\">
                ";
        // line 45
        echo twig_escape_filter($this->env, trans("ver_carrito"), "html", null, true);
        echo "
            </a>           
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "productos/oferta/reserva_02.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 45,  146 => 44,  141 => 42,  137 => 41,  132 => 39,  128 => 38,  120 => 35,  117 => 34,  112 => 32,  107 => 31,  105 => 30,  101 => 28,  97 => 26,  90 => 24,  83 => 23,  81 => 22,  74 => 20,  66 => 17,  63 => 16,  57 => 14,  55 => 13,  50 => 10,  47 => 9,  41 => 7,  35 => 6,  31 => 1,  29 => 4,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/oferta/reserva_02.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/oferta/reserva_02.twig");
    }
}
