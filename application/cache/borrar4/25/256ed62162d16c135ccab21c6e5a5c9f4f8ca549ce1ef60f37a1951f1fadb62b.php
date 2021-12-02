<?php

/* administracion/page_login.twig */
class __TwigTemplate_b467f9ff9090fb5858c06c2cb295e47d3133913fadd5099cafa1e2f3b5d61679 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/page_login.twig", 1);
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
    <div style=\"padding-top: 200px;\">
        <div class=\"row\">
            <div class=\"col-sm-6 col-sm-offset-2\" id=\"center_area\">
                ";
        // line 8
        echo form_open("", array("class" => "form-horizontal"));
        echo "
                <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">";
        // line 10
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
                    <div class=\"col-sm-10\">
                        <input class=\"form-control\" type=\"email\" autofocus=\"autofocus\" type=\"text\" name=\"correo\" placeholder=\"";
        // line 12
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "\" value=\"";
        echo set_value("correo");
        echo "\">
                        <span class=\"help-block\">";
        // line 13
        echo form_error("correo");
        echo "</span>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">";
        // line 18
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "</label>
                    <div class=\"col-sm-10\">
                        <input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"";
        // line 20
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "\" value=\"\">
                        <span class=\"help-block\">";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
        echo "</span>
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <div class=\"checkbox\">
                            <label>
                                <input type=\"checkbox\" ";
        // line 29
        echo ((_twig_default_filter(set_value("remember_pass"), false)) ? ("checked=\"checked\"") : (""));
        echo " name=\"remember_pass\"/> ";
        echo twig_escape_filter($this->env, trans("entrar_recordar_contrasenna"), "html", null, true);
        echo "
                            </label>
                        </div>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <button type=\"submit\" class=\"btn btn-default\">";
        // line 36
        echo twig_escape_filter($this->env, trans("entrar_iniciar_session"), "html", null, true);
        echo "</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/page_login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 36,  81 => 29,  70 => 21,  66 => 20,  61 => 18,  53 => 13,  47 => 12,  42 => 10,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/page_login.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/page_login.twig");
    }
}
