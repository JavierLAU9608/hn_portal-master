<?php

/* administracion/contacto.twig */
class __TwigTemplate_5909e04c7e9302e96a07ac373f4e7245be64e53c98b78560c2a8389c46fcf412 extends Twig_Template
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
<div class=\"modal fade\" id=\"contactform\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"contactformLabel\">
\t<div class=\"modal-dialog\" role=\"document\">
\t\t<div class=\"modal-content\">
\t\t\t";
        // line 5
        echo form_open("contact-email", array("id" => "form_contact", "class" => "form-horizontal"));
        echo "
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
\t\t\t\t\t<span aria-hidden=\"true\">&times;</span>
\t\t\t\t</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"contactformLabel\">";
        // line 10
        echo twig_escape_filter($this->env, trans("contacto_us_home"), "html", null, true);
        echo "
\t\t\t\t\t- ";
        // line 11
        echo twig_escape_filter($this->env, trans("hotel_nacional_cuba"), "html", null, true);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<div id=\"contact_msg\"></div>
\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"contact_correo\" class=\"col-sm-2 control-label\">";
        // line 16
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"email\" required=\"required\" name=\"correo\" class=\"form-control correo\" id=\"contact_correo\" placeholder=\"";
        // line 18
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"contact_nombre\" class=\"col-sm-2 control-label\">";
        // line 23
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"text\" required=\"required\" name=\"nombre\" class=\"form-control\" id=\"contact_nombre\" placeholder=\"";
        // line 25
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"pais_fk\" class=\"col-sm-2 control-label\">";
        // line 30
        echo twig_escape_filter($this->env, trans("user_pais"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<select name=\"pais_fk\" id=\"pais_fk\" class=\"form-control\" required=\"required\">
\t\t\t\t\t\t\t<option value=\"\">";
        // line 33
        echo twig_escape_filter($this->env, trans("seleccione_pais"), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "countries", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 35
            echo "\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["p"], "nombre_trad", array()) != null)) ? ($this->getAttribute($context["p"], "nombre_trad", array())) : ($this->getAttribute($context["p"], "nombre", array()))), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"contact_msg\" class=\"col-sm-2 control-label\">";
        // line 42
        echo twig_escape_filter($this->env, trans("mensaje"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<textarea class=\"form-control\" name=\"msg\" id=\"contact_msg\" cols=\"30\" rows=\"10\" required=\"required\"></textarea>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>

\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
\t\t\t\t<input type=\"submit\" class=\"btn btn-default\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, trans("enviar_msg"), "html", null, true);
        echo "\"/>
\t\t\t</div>
\t\t\t</form>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "administracion/contacto.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 52,  103 => 42,  96 => 37,  85 => 35,  81 => 34,  77 => 33,  71 => 30,  63 => 25,  58 => 23,  50 => 18,  45 => 16,  37 => 11,  33 => 10,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/contacto.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/contacto.twig");
    }
}
