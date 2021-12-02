<?php

/* administracion/recuperar_contrasenna.twig */
class __TwigTemplate_c36d1e800943c5aff1c3403bffdb90a70e157e1e4bcdfcfb84ba3b6bd614ebd7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "administracion/recuperar_contrasenna.twig", 1);
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
\t\t<div class=\"col-sm-4 hidden-xs\"></div>
\t\t<div class=\"col-sm-4\">
\t\t\t";
        // line 8
        echo form_open("", array("class" => "form-horizontal"));
        echo "

\t\t\t<div class=\"form-group\">
\t\t\t\t<label for=\"login_correo\" class=\"col-sm-2 control-label\">";
        // line 11
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"email\" required=\"required\" name=\"correo\" class=\"form-control\" placeholder=\"";
        // line 13
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "\">
\t\t\t\t\t<span class=\"help-block\">";
        // line 14
        echo (isset($context["flash_error"]) ? $context["flash_error"] : null);
        echo "</span>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t\t<input class=\"btn btn-default buttom roman\" type=\"submit\" name=\"btn_continuar\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, trans("continuar"), "html", null, true);
        echo "\">
\t\t\t</form>
\t\t</div> 
\t\t<div class=\"col-sm-4 hidden-xs\"></div>\t\t
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "administracion/recuperar_contrasenna.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 18,  52 => 14,  48 => 13,  43 => 11,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/recuperar_contrasenna.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/recuperar_contrasenna.twig");
    }
}
