<?php

/* datos_reserva.twig */
class __TwigTemplate_46a59166c65479ba250e28bf44e8ec6feb04488e6b594049ba870f80a04882c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "datos_reserva.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
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
";
        // line 5
        echo form_open(base_url("con_reservacion/confirmar_pagar"), array("id" => "form_detalles_reserva"));
        echo "
    <div class=\"row\" style=\"padding-top: 200px;\">
        <div class=\"col-sm-12\">
            ";
        // line 8
        echo trans("al_texto_intro_reserva");
        echo "
            <a target=\"_blank\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url("informacion/Reservar-y-pagar"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, trans("al_texto_intro_reserva_link"), "html", null, true);
        echo "</a>
        </div>

        <div class=\"col-sm-12\">
            ";
        // line 13
        if ((isset($context["existen_productos_no_confirmar"]) ? $context["existen_productos_no_confirmar"] : null)) {
            // line 14
            echo "                ";
            echo twig_escape_filter($this->env, trans("reservaciones"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "
                ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["formas_pago"]) ? $context["formas_pago"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["forma_pago"]) {
                // line 16
                echo "                    <input type=\"hidden\" name=\"forma_pago\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["forma_pago"], "id", array()), "html", null, true);
                echo "\"/>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forma_pago'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "            ";
        } else {
            // line 19
            echo "                ";
            if (((array_key_exists("formas_pago", $context)) ? (_twig_default_filter((isset($context["formas_pago"]) ? $context["formas_pago"] : null), false)) : (false))) {
                // line 20
                echo "                    ";
                echo twig_escape_filter($this->env, trans("reserva_forma_pago"), "html", null, true);
                echo "
                    <ol style=\"list-style-type:none\">
                        ";
                // line 22
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["formas_pago"]) ? $context["formas_pago"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["forma_pago"]) {
                    // line 23
                    echo "                            <li>
                                <label>
                                    <input ";
                    // line 25
                    echo ((($this->getAttribute($context["forma_pago"], "predeterminado", array()) == "t")) ? ("checked=\"checked\"") : (""));
                    echo " type=\"radio\" name=\"forma_pago\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["forma_pago"], "id", array()), "html", null, true);
                    echo "\" />
                                    ";
                    // line 26
                    echo twig_escape_filter($this->env, $this->getAttribute($context["forma_pago"], "descripcion", array()), "html", null, true);
                    echo "
                                </label>
                            </li>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forma_pago'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 30
                echo "
                    </ol>
                ";
            }
            // line 33
            echo "            ";
        }
        // line 34
        echo "        </div>

        <div class=\"col-sm-12\">
        ";
        // line 37
        if ((isset($context["flash_error"]) ? $context["flash_error"] : null)) {
            // line 38
            echo "            <div class=\"alert alert-danger\">
                ";
            // line 39
            echo (isset($context["flash_error"]) ? $context["flash_error"] : null);
            echo "
            </div>
        ";
        }
        // line 42
        echo "        </div>


        <div class=\"col-sm-12\">
            ";
        // line 46
        echo twig_escape_filter($this->env, trans("al_cards"), "html", null, true);
        echo "

            ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tarjetas"]) ? $context["tarjetas"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tarj"]) {
            if (($context["tarj"] != 11)) {
                // line 49
                echo "                <label class=\"radio-inline\">
                    <div class=\"radio\">
                        <span class=\"\">
                            <input required=\"required\" type=\"radio\" value=\"";
                // line 52
                echo twig_escape_filter($this->env, $context["tarj"], "html", null, true);
                echo "\" name=\"optionsRadios\">
                        </span>
                    </div>
                    <img height='50' src=\"web/img/tarjetas/";
                // line 55
                echo twig_escape_filter($this->env, $context["tarj"], "html", null, true);
                echo ".jpg\"/>
                </label>
            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarj'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "        </div>

        <div class=\"col-sm-12\">
        <br/>
            <input name=\"titular_diferente\" id=\"titular_diferente\" type=\"checkbox\" ";
        // line 62
        echo (((isset($context["marcado_regalo"]) ? $context["marcado_regalo"] : null)) ? ("checked=\"checked\"") : (""));
        echo " value=\"1\"/>
            <label for=\"titular_diferente\">";
        // line 63
        echo twig_escape_filter($this->env, trans("titular_diferente"), "html", null, true);
        echo "</label>
        </div>


        <div class=\"col-sm-6\" id=\"titular_reserva\">
            <h3>";
        // line 68
        echo twig_escape_filter($this->env, trans("titular_reserva"), "html", null, true);
        echo "</h3>

            <label for=\"nombre_titular\">";
        // line 70
        echo twig_escape_filter($this->env, trans("nombre_apellidos"), "html", null, true);
        echo " *</label><br/>
            <input required=\"required\" type=\"text\" value=\"";
        // line 71
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre_titular", array())) ? ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre_titular", array())) : ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre", array()))), "html", null, true);
        echo "\" name=\"nombre_titular\" class=\"numeros_letras form-control\"/>

            <br/>
            <label for=\"pais_titular\">";
        // line 74
        echo twig_escape_filter($this->env, trans("pais_residencia"), "html", null, true);
        echo " *</label><br/>
            <select class=\"form-control\" required=\"required\" name=\"pais_titular\">
                <option value=\"\">";
        // line 76
        echo twig_escape_filter($this->env, trans("seleccione_pais"), "html", null, true);
        echo "</option>
                ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["paises"]) ? $context["paises"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 78
            echo "                    <option ";
            echo ((($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pais_fk", array()) == $this->getAttribute($context["p"], "id", array()))) ? ("selected=\"selected\"") : (""));
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["p"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["p"], "nombre_trad", array())))) ? ($this->getAttribute($context["p"], "nombre_trad", array())) : ($this->getAttribute($context["p"], "nombre", array()))), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "            </select>

            <br/>
            <label for=\"pasaporte_titular\">";
        // line 83
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo " *</label><br/>
            <input required=\"required\" type=\"text\" value=\"";
        // line 84
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pasaporte_titular", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pasaporte_titular", array())))) ? ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pasaporte_titular", array())) : ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pasaporte", array()))), "html", null, true);
        echo "\" name=\"pasaporte_titular\" class=\"numeros_letras form-control\"/>

            <br/>
            <label for=\"email_titular\">";
        // line 87
        echo twig_escape_filter($this->env, trans("email"), "html", null, true);
        echo " *</label><br/>
            <input required=\"required\" type=\"email\" value=\"";
        // line 88
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "email_titular", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "email_titular", array())))) ? ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "email_titular", array())) : ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "correo", array()))), "html", null, true);
        echo "\" name=\"email_titular\" class=\"correo form-control\"/>

            <br/>
            <label for=\"telefono_titular\">";
        // line 91
        echo twig_escape_filter($this->env, trans("telefono"), "html", null, true);
        echo "</label><br/>
            <input type=\"text\" value=\"";
        // line 92
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "telefono_titular", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "telefono_titular", array())))) ? ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "telefono_titular", array())) : ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "telefono_titular", array()))), "html", null, true);
        echo "\" name=\"telefono_titular\" class=\"solo_numeros form-control\"/>
        </div>

        <div class=\"col-sm-6\" id=\"titular_tarjeta\" style=\"display: none\">
            <h3>";
        // line 96
        echo twig_escape_filter($this->env, trans("titular_tarjeta_credito"), "html", null, true);
        echo "</h3>

            <label for=\"nombre_titular_tarjeta\">";
        // line 98
        echo twig_escape_filter($this->env, trans("nombre_apellidos"), "html", null, true);
        echo " *</label><br/>
            <input type=\"text\" value=\"";
        // line 99
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre_titular", array())) ? ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre_titular", array())) : ($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre", array()))), "html", null, true);
        echo "\" name=\"nombre_titular_tarjeta\" class=\"form-control numeros_letras\"/>

            <br/>
            <label for=\"pais_titular_tarjeta\">";
        // line 102
        echo twig_escape_filter($this->env, trans("pais_residencia"), "html", null, true);
        echo " *</label><br/>
            <select class=\"form-control\" name=\"pais_titular_tarjeta\">
                <option value=\"\">";
        // line 104
        echo twig_escape_filter($this->env, trans("seleccione_pais"), "html", null, true);
        echo "</option>
                ";
        // line 105
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["paises"]) ? $context["paises"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 106
            echo "                    <option ";
            echo ((($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pais_titular_tarjeta", array()) == $this->getAttribute($context["p"], "id", array()))) ? ("selected=\"selected\"") : (""));
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["p"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["p"], "nombre_trad", array())))) ? ($this->getAttribute($context["p"], "nombre_trad", array())) : ($this->getAttribute($context["p"], "nombre", array()))), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 108
        echo "            </select>

            <br/>
            <label for=\"pasaporte_titular_tarjeta\">";
        // line 111
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo " *</label><br/>
            <input type=\"text\" value=\"";
        // line 112
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "pasaporte_titular_tarjeta", array()), "html", null, true);
        echo "\" name=\"pasaporte_titular_tarjeta\" class=\"numeros_letras form-control\"/>

            <br/>
            <label for=\"email_titular_tarjeta\">";
        // line 115
        echo twig_escape_filter($this->env, trans("email"), "html", null, true);
        echo " *</label><br/>
            <input type=\"email\" value=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "email_titular_tarjeta", array()), "html", null, true);
        echo "\" name=\"email_titular_tarjeta\" class=\"correo form-control\"/>

            <br/>
            <label for=\"telefono_titular_tarjeta\">";
        // line 119
        echo twig_escape_filter($this->env, trans("telefono"), "html", null, true);
        echo "</label><br/>
            <input type=\"text\" value=\"";
        // line 120
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "telefono_titular_tarjeta", array()), "html", null, true);
        echo "\" name=\"telefono_titular\" class=\"solo_numeros form-control\"/>

            <br/> * ";
        // line 122
        echo twig_escape_filter($this->env, trans("requerido"), "html", null, true);
        echo "
        </div>

        <div class=\"col-sm-12\">
        <br/>
            <a href=\"";
        // line 127
        echo twig_escape_filter($this->env, base_url("noticias/garantizamos-la-seguridad-de-sus-pagos/15"), "html", null, true);
        echo "\" target=\"_blank\">";
        echo trans("texto_garantizamos_seguridad");
        echo "</a>

            <br/>
            <input required=\"required\" type=\"checkbox\" name=\"aceptar_terminos\" id=\"aceptar_terminos\" value=\"1\" style=\"margin-right:20px;\"/>
            <label id=\"texto_aceptar_terminos\" for=\"aceptar_terminos\">
                ";
        // line 132
        echo trans("texto_aceptar_terminos_condiciones");
        echo "
            </label>

            <br/>
            <input type=\"submit\" name=\"btn_confirmar_y_pagar\" value=\"";
        // line 136
        echo twig_escape_filter($this->env, trans("continuar"), "html", null, true);
        echo "\" class=\"btn btn-default roman\" />
        </div>
    </div>
    </form>
</div>
";
    }

    // line 143
    public function block_script($context, array $blocks = array())
    {
        // line 144
        echo "    <script language=\"javascript\" type=\"application/javascript\">
        \$(\"#titular_diferente\").click(function(){
            \$(\"#titular_tarjeta\").toggle();
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "datos_reserva.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  381 => 144,  378 => 143,  368 => 136,  361 => 132,  351 => 127,  343 => 122,  338 => 120,  334 => 119,  328 => 116,  324 => 115,  318 => 112,  314 => 111,  309 => 108,  296 => 106,  292 => 105,  288 => 104,  283 => 102,  277 => 99,  273 => 98,  268 => 96,  261 => 92,  257 => 91,  251 => 88,  247 => 87,  241 => 84,  237 => 83,  232 => 80,  219 => 78,  215 => 77,  211 => 76,  206 => 74,  200 => 71,  196 => 70,  191 => 68,  183 => 63,  179 => 62,  173 => 58,  163 => 55,  157 => 52,  152 => 49,  147 => 48,  142 => 46,  136 => 42,  130 => 39,  127 => 38,  125 => 37,  120 => 34,  117 => 33,  112 => 30,  102 => 26,  96 => 25,  92 => 23,  88 => 22,  82 => 20,  79 => 19,  76 => 18,  67 => 16,  63 => 15,  56 => 14,  54 => 13,  45 => 9,  41 => 8,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "datos_reserva.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/datos_reserva.twig");
    }
}
