<?php

/* administracion/perfil.twig */
class __TwigTemplate_fae74d289fbf9ecdf69518a40a35a7c15de160e727df7a3bee63bd5c3e81efff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/perfil.twig", 1);
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
        // line 8
        echo twig_escape_filter($this->env, menu_vertical(array("items" => (isset($context["items"]) ? $context["items"] : null), "item_activo" => (isset($context["item_activo"]) ? $context["item_activo"] : null))), "html", null, true);
        echo "
            <div class=\"clean_space\"></div>
        </div>

        <div class=\"col-sm-9\">
            <ul class=\"nav nav-tabs\">
                <li class=\"";
        // line 14
        echo (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "isPost", array())) ? ("") : ("active"));
        echo "\">
                    <a href=\"#tab_info\" data-toggle=\"tab\">";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["titulo_activo"]) ? $context["titulo_activo"] : null), "html", null, true);
        echo "</a>
                </li>
                <li class=\"";
        // line 17
        echo (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "isPost", array())) ? ("active") : (""));
        echo "\">
                    <a href=\"#tab_edit\" data-toggle=\"tab\">";
        // line 18
        echo twig_escape_filter($this->env, trans("user_datos_editar"), "html", null, true);
        echo "</a>
                </li>
            </ul>

            <div class=\"tab-content\">
                <div id=\"tab_info\" class=\"tab-pane ";
        // line 23
        echo (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "isPost", array())) ? ("") : ("active"));
        echo "\">

                    <div class=\"form-horizontal\">
                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\">";
        // line 27
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <input readonly class=\"form-control\" type=\"text\" name=\"nombre\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "nombre", array()), "html", null, true);
        echo "\"/>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\">";
        // line 34
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <input readonly class=\"form-control\" type=\"email\" name=\"correo\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "correo", array()), "html", null, true);
        echo "\"/>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\">";
        // line 41
        echo twig_escape_filter($this->env, trans("user_pais"), "html", null, true);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <select required=\"required\" class=\"form-control\" name=\"pais\">
                                    <option value=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "id", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pais", array()), "nombre", array()), "html", null, true);
        echo "</option>
                                </select>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\">";
        // line 50
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <input readonly class=\"form-control\" type=\"text\" name=\"pasaporte\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pasaporte", array()), "html", null, true);
        echo "\"/>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <span class=\"col-sm-2\">";
        // line 57
        echo twig_escape_filter($this->env, trans("al_tipo_cliente"), "html", null, true);
        echo "</span>
                            <div class=\"col-sm-10\">
                                <b>";
        // line 59
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "disponible", array(), "array"), 0, array(), "array"), "nombre", array(), "array")) ? ((" " . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "disponible", array(), "array"), 0, array(), "array"), "nombre", array(), "array"))) : ("")), "html", null, true);
        echo "</b>
                            </div>
                        </div>

                        <div class=\"row\">
                            ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "disponible", array(), "array"), "cupos", array(), "array"));
        foreach ($context['_seq'] as $context["_key"] => $context["hc"]) {
            // line 65
            echo "                            <div class=\"col-xs-12 col-md-6\">
                                <div class=\"well\">
                                    <div>
                                        ";
            // line 68
            echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "nombre_habitacion", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 71
            echo twig_escape_filter($this->env, trans("al_plan_alojamiento"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "nombre_plan", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 74
            echo twig_escape_filter($this->env, trans("al_desde"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "fecha_cupo_inicio", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 77
            echo twig_escape_filter($this->env, trans("al_hasta"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "fecha_cupo_fin", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 80
            echo twig_escape_filter($this->env, trans("al_cupos_diario"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "cupos_dias", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 83
            echo twig_escape_filter($this->env, trans("al_cupos"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "cupos", array()), "html", null, true);
            echo "
                                    </div>
                                    <div>
                                        ";
            // line 86
            echo twig_escape_filter($this->env, trans("al_descuento"), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hc"], "descuento", array()), "html", null, true);
            echo "%
                                    </div>
                                </div>

                            </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "                        </div>
                    </div>
                </div>

                <div id=\"tab_edit\" class=\"tab-pane ";
        // line 96
        echo (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "isPost", array())) ? ("active") : (""));
        echo "\">

                    ";
        // line 98
        echo form_open("", array("name" => "form_edicion_registro", "class" => "form-horizontal"));
        echo "
                    <div class=\"form_msg  verdana\">";
        // line 99
        echo twig_escape_filter($this->env, (isset($context["flash_error"]) ? $context["flash_error"] : null), "html", null, true);
        echo "</div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 102
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <input required=\"required\" class=\"form-control\" type=\"text\" name=\"nombre\" value=\"";
        // line 104
        echo set_value("nombre", $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "nombre", array()));
        echo "\"/>
                            <span class=\"help-block\">";
        // line 105
        echo form_error("nombre");
        echo "</span>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 110
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <input required=\"required\" class=\"form-control\" type=\"email\" name=\"correo\" value=\"";
        // line 112
        echo set_value("correo", $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "correo", array()));
        echo "\"/>
                            <span class=\"help-block\">";
        // line 113
        echo form_error("correo");
        echo "</span>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 118
        echo twig_escape_filter($this->env, trans("user_pais"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <select required=\"required\" class=\"form-control\" name=\"pais\">
                                ";
        // line 121
        $context["paises"] = app_paises();
        // line 122
        echo "                                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["paises"]) ? $context["paises"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 123
            echo "                                    ";
            $context["selected"] = ((($this->getAttribute($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pais", array()), "id", array()) == $this->getAttribute($context["p"], "id", array()))) ? ("selected=\"selected\"") : (""));
            // line 124
            echo "                                    <option ";
            echo twig_escape_filter($this->env, (isset($context["selected"]) ? $context["selected"] : null), "html", null, true);
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "nombre", array()), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "                            </select>
                            <span class=\"help-block\">";
        // line 127
        echo form_error("pais");
        echo "</span>
                        </div>
                    </div>

                    ";
        // line 131
        $context["pasaporte"] = ((($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pasaporte", array()) == 0)) ? ("") : ($this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pasaporte", array())));
        // line 132
        echo "
                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 134
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <input class=\"form-control\" type=\"text\" name=\"pasaporte\" value=\"";
        // line 136
        echo set_value("pasaporte", $this->getAttribute((isset($context["user_registrado"]) ? $context["user_registrado"] : null), "pasaporte", array()));
        echo "\"/>
                            <span class=\"help-block\">";
        // line 137
        echo form_error("pasaporte");
        echo "</span>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 142
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <input class=\"form-control\" type=\"password\" name=\"password_edit\" value=\"";
        // line 144
        echo set_value("password_edit");
        echo "\"/>
                            <span class=\"help-block\">";
        // line 145
        echo form_error("password_edit");
        echo "</span>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 150
        echo twig_escape_filter($this->env, trans("repetir_contrasenna"), "html", null, true);
        echo "</label>
                        <div class=\"col-sm-10\">
                            <input class=\"form-control\" type=\"password\" name=\"password_edit_confir\" value=\"";
        // line 152
        echo set_value("password_edit_confir");
        echo "\"/>
                            <span class=\"help-block\">";
        // line 153
        echo form_error("password_edit_confir");
        echo "</span>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-sm-offset-2 col-sm-10\">
                            <input type=\"submit\" class=\"btn btn-default buttom roman\" value=\"";
        // line 159
        echo twig_escape_filter($this->env, trans("guardar"), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/perfil.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  366 => 159,  357 => 153,  353 => 152,  348 => 150,  340 => 145,  336 => 144,  331 => 142,  323 => 137,  319 => 136,  314 => 134,  310 => 132,  308 => 131,  301 => 127,  298 => 126,  285 => 124,  282 => 123,  277 => 122,  275 => 121,  269 => 118,  261 => 113,  257 => 112,  252 => 110,  244 => 105,  240 => 104,  235 => 102,  229 => 99,  225 => 98,  220 => 96,  214 => 92,  200 => 86,  192 => 83,  184 => 80,  176 => 77,  168 => 74,  160 => 71,  152 => 68,  147 => 65,  143 => 64,  135 => 59,  130 => 57,  122 => 52,  117 => 50,  106 => 44,  100 => 41,  92 => 36,  87 => 34,  79 => 29,  74 => 27,  67 => 23,  59 => 18,  55 => 17,  50 => 15,  46 => 14,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/perfil.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/perfil.twig");
    }
}
