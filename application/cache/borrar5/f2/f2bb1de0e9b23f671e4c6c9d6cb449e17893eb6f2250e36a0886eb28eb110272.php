<?php

/* productos/restaurante/restaurante.twig */
class __TwigTemplate_e4dfc94f29c16ff8f1269ba81b54eaea1020e9c4a2e80faefa80809a793daad9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
";
        // line 2
        $context["restaurante_trans"] = app_traduccion("restaurante", "restaurante_idioma_rest", null, "restaurante_fk", $this->getAttribute((isset($context["restaurante"]) ? $context["restaurante"] : null), "id", array()), (isset($context["restaurante"]) ? $context["restaurante"] : null));
        // line 3
        $context["titulo"] = trans("rt_restaurante_nombre", array("nombre" => $this->getAttribute((isset($context["restaurante_trans"]) ? $context["restaurante_trans"] : null), "nombre", array())));
        // line 4
        $context["tipo"] = app_traduccion("restaurante", "restaurante_tipo_idioma", "nombre", "tipo_fk", $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : null), "id", array()), $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : null), "nombre", array()));
        // line 5
        $context["subtitle"] = ((((isset($context["view"]) ? $context["view"] : null) == "open")) ? (((trans("rt_restaurante") . " ") . (isset($context["tipo"]) ? $context["tipo"] : null))) : (trans("rt_restaurante_menu")));
        // line 6
        $context["texto_presentacion"] = $this->getAttribute((isset($context["restaurante_trans"]) ? $context["restaurante_trans"] : null), "descripcion", array());
        // line 7
        echo "
";
        // line 8
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "\t<div class=\"container\">
        <div class=\"row margin-bottom-40\">
            <div class=\"col-md-12 col-sm-12 content-center margin-bottom-30\">
                <h2 class=\"uppercase text-price\">";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["titulo"]) ? $context["titulo"] : null), "html", null, true);
        echo "</h2>
            </div>
            <!-- BEGIN CONTENT -->
            <div class=\"col-md-12 col-sm-12\"
                <div class=\"content-page\">
                    <div class=\"row margin-bottom-40\">
                        ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["menus"]) ? $context["menus"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 19
            echo "                            ";
            $context["menu_trans"] = app_traduccion("restaurante", "restaurante_menu_idioma", "nombre", "menu_fk", $this->getAttribute($context["menu"], "id", array()), $this->getAttribute($context["menu"], "nombre", array()));
            // line 20
            echo "                            ";
            $context["recomended"] = ((($this->getAttribute($context["menu"], "recomendado", array()) == "t")) ? (true) : (false));
            // line 21
            echo "                            <!-- Pricing -->
                            <div class=\"col-md-4\">
                                <div class=\"pricing hover-effect\">
                                    <div class=\"pricing-head\">
                                        <h3>
                                            ";
            // line 26
            echo twig_escape_filter($this->env, (isset($context["menu_trans"]) ? $context["menu_trans"] : null), "html", null, true);
            echo "
                                            ";
            // line 27
            if ((isset($context["recomended"]) ? $context["recomended"] : null)) {
                // line 28
                echo "                                                <img src=\"";
                echo twig_escape_filter($this->env, base_url("web/img/recomendado.png"), "html", null, true);
                echo "\"/>
                                            ";
            }
            // line 30
            echo "                                        </h3>
                                        <h4>
                                            ";
            // line 32
            if ($this->getAttribute($context["menu"], "precio", array())) {
                // line 33
                echo "                                                ";
                echo twig_escape_filter($this->env, trans("rt_precio_por_pax"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "precio", array()), "html", null, true);
                echo " <br/>
                                            ";
            }
            // line 35
            echo "                                        </h4>
                                    </div>


                                    <ul class=\"pricing-content list-unstyled\">
                                        ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu"], "platos", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                // line 41
                echo "                                            <li>
                                                <i class=\"fa fa-tags\"></i>
                                                ";
                // line 43
                if ((twig_length_filter($this->env, $context["p"]) > 0)) {
                    // line 44
                    echo "                                                    ";
                    $context["tipo_plato_traduccion"] = app_traduccion("restaurante", "restaurante_tipop_idioma", "nombre", "tipo_plato_fk", $this->getAttribute($this->getAttribute($context["p"], 0, array(), "array"), "id_tipo_plato", array(), "array"), $this->getAttribute($this->getAttribute($context["p"], 0, array(), "array"), "nombre_tipo_plato", array(), "array"));
                    // line 45
                    echo "                                                    <b>";
                    echo twig_escape_filter($this->env, (isset($context["tipo_plato_traduccion"]) ? $context["tipo_plato_traduccion"] : null), "html", null, true);
                    echo ": </b>

                                                    ";
                    // line 47
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["p"]);
                    foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
                        // line 48
                        echo "                                                        ";
                        $context["plato_traduccion"] = app_traduccion("restaurante", "restaurante_plato_idioma", "nombre", "plato_fk", $this->getAttribute($context["o"], "id_plato", array()), $this->getAttribute($context["o"], "nombre_plato", array()));
                        // line 49
                        echo "                                                        ";
                        echo twig_escape_filter($this->env, (isset($context["plato_traduccion"]) ? $context["plato_traduccion"] : null), "html", null, true);
                        echo ",
                                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 51
                    echo "
                                                ";
                } else {
                    // line 53
                    echo "                                                    ";
                    echo twig_escape_filter($this->env, $context["p"], "html", null, true);
                    echo "
                                                ";
                }
                // line 55
                echo "                                            </li>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "                                    </ul>
                                    ";
            // line 59
            echo "                                        ";
            // line 60
            echo "                                            ";
            // line 61
            echo "                                                ";
            // line 62
            echo "                                            ";
            // line 63
            echo "                                        ";
            // line 64
            echo "                                    ";
            // line 65
            echo "                                </div>
                            </div>
                            <!--//End Pricing -->

                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "


                    </div>
                </div>
            </div>
        </div>

\t</div>

";
    }

    public function getTemplateName()
    {
        return "productos/restaurante/restaurante.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 70,  173 => 65,  171 => 64,  169 => 63,  167 => 62,  165 => 61,  163 => 60,  161 => 59,  158 => 57,  151 => 55,  145 => 53,  141 => 51,  132 => 49,  129 => 48,  125 => 47,  119 => 45,  116 => 44,  114 => 43,  110 => 41,  106 => 40,  99 => 35,  91 => 33,  89 => 32,  85 => 30,  79 => 28,  77 => 27,  73 => 26,  66 => 21,  63 => 20,  60 => 19,  56 => 18,  47 => 12,  42 => 9,  36 => 8,  33 => 7,  31 => 6,  29 => 5,  27 => 4,  25 => 3,  23 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/restaurante/restaurante.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/restaurante/restaurante.twig");
    }
}
