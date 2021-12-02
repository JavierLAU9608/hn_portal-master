<?php

/* administracion/login.twig */
class __TwigTemplate_e4d557fd794fcfe29d1741b2fde2ef9aa44774bd40b01ef5c12d9cb2e6a3bb37 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- Modal -->
<div class=\"modal fade\" id=\"loginform\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"loginformLabel\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
            ";
        // line 5
        echo form_open("#", array("id" => "form_login", "class" => "form-horizontal"));
        echo "
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
                <h4 class=\"modal-title\" id=\"loginformLabel\">";
        // line 10
        echo twig_escape_filter($this->env, trans("entrar_iniciar_session"), "html", null, true);
        echo "
                    - ";
        // line 11
        echo twig_escape_filter($this->env, trans("hotel_nacional_cuba"), "html", null, true);
        echo "</h4>
            </div>

            <div class=\"modal-body\">
                <div id=\"login_msg\"></div>
                <div class=\"form-group\">
                    <label for=\"login_correo\" class=\"col-sm-2 control-label\">";
        // line 17
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
                    <div class=\"col-sm-10\">
                        <input type=\"email\" required=\"required\" name=\"correo\" class=\"form-control correo\" id=\"login_correo\" placeholder=\"";
        // line 19
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "\">
                    </div>
                </div>

                <div class=\"form-group\">
                    <label for=\"login_password\" class=\"col-sm-2 control-label\">";
        // line 24
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "</label>
                    <div class=\"col-sm-10\">
                        <input type=\"password\" required=\"required\" name=\"password\" class=\"form-control\" id=\"login_password\" placeholder=\"";
        // line 26
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "\">
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <div class=\"checkbox\">
                            <label>
                                <input type=\"checkbox\" name=\"remember_pass\" id=\"remember_pass\"> ";
        // line 34
        echo twig_escape_filter($this->env, trans("entrar_recordar_contrasenna"), "html", null, true);
        echo "
                            </label>
                        </div>
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <a href=\"";
        // line 42
        echo twig_escape_filter($this->env, trans("ruta_recuperar_contrasenna"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, trans("entrar_olvidaste_contrasenna"), "html", null, true);
        echo "</a>
                        <br/>

                        <span class=\"black\">";
        // line 45
        echo twig_escape_filter($this->env, trans("entrar_pregunta_no_tienes_cuenta"), "html", null, true);
        echo "</span>
                        <br/>
                        <a id=\"register_yellow\" class=\"verdana\">";
        // line 47
        echo twig_escape_filter($this->env, trans("registrarse_gratis"), "html", null, true);
        echo "</a>
                    </div>
                </div>
            </div>

            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                <input type=\"submit\" class=\"btn btn-default\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, trans("entrar_iniciar_session"), "html", null, true);
        echo "\"/>
            </div>
            </form>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "administracion/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 54,  99 => 47,  94 => 45,  86 => 42,  75 => 34,  64 => 26,  59 => 24,  51 => 19,  46 => 17,  37 => 11,  33 => 10,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/login.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/login.twig");
    }
}
