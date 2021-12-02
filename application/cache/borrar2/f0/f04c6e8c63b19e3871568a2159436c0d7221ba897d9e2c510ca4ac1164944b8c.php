<?php

/* administracion/registro.twig */
class __TwigTemplate_51066f416711b68bcaafd9a16ca4c6f46c4d0ec420f92afa6582dd5ee41f5245 extends Twig_Template
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
<div class=\"modal fade\" id=\"registerform\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"registerformLabel\">
\t<div class=\"modal-dialog\" role=\"document\">
\t\t<div class=\"modal-content\">
\t\t\t";
        // line 5
        echo form_open("#", array("id" => "form_registro", "class" => "form-horizontal"));
        echo "
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
\t\t\t\t\t<span aria-hidden=\"true\">&times;</span>
\t\t\t\t</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"registerformLabel\">";
        // line 10
        echo twig_escape_filter($this->env, trans("registrarse_en"), "html", null, true);
        echo "
\t\t\t\t\t- ";
        // line 11
        echo twig_escape_filter($this->env, trans("hotel_nacional_cuba"), "html", null, true);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<div id=\"registro_msg\"></div>
\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"register_correo\" class=\"col-sm-2 control-label\">";
        // line 16
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"email\" required=\"required\" name=\"correo\" class=\"form-control correo\" id=\"register_correo\" placeholder=\"";
        // line 18
        echo twig_escape_filter($this->env, trans("correo"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"register_nombre\" class=\"col-sm-2 control-label\">";
        // line 23
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"text\" required=\"required\" name=\"nombre\" class=\"form-control\" id=\"register_nombre\" placeholder=\"";
        // line 25
        echo twig_escape_filter($this->env, trans("nombre_completo"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"register_password\" class=\"col-sm-2 control-label\">";
        // line 30
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"password\" required=\"required\" name=\"password\" class=\"form-control\" id=\"register_password\" placeholder=\"";
        // line 32
        echo twig_escape_filter($this->env, trans("contrasenna"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"passport\" class=\"col-sm-2 control-label\">";
        // line 37
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<input type=\"text\" required=\"required\" name=\"passport\" class=\"form-control\" id=\"passport\" placeholder=\"";
        // line 39
        echo twig_escape_filter($this->env, trans("pasaporte"), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<label for=\"pais_fk\" class=\"col-sm-2 control-label\">";
        // line 44
        echo twig_escape_filter($this->env, trans("user_pais"), "html", null, true);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t<select name=\"pais_fk\" id=\"pais_fk\" class=\"form-control\" required=\"required\">
\t\t\t\t\t\t\t<option value=\"\">";
        // line 47
        echo twig_escape_filter($this->env, trans("seleccione_pais"), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "countries", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 49
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
        // line 51
        echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<div class=\"col-sm-offset-2 col-sm-10\">
\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t<input required=\"required\" type=\"checkbox\" name=\"politica\"> ";
        // line 59
        echo trans("texto_aceptar_terminos_condiciones");
        echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t<div class=\"col-sm-offset-2 col-sm-10\">
\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"subscribirme\"> ";
        // line 69
        echo trans("subscripcion_deseo_subscribirme");
        echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
\t\t\t\t<input type=\"submit\" class=\"btn btn-default\" value=\"";
        // line 78
        echo twig_escape_filter($this->env, trans("Registrarme"), "html", null, true);
        echo "\"/>
\t\t\t</div>
\t\t\t</form>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "administracion/registro.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 78,  145 => 69,  132 => 59,  122 => 51,  111 => 49,  107 => 48,  103 => 47,  97 => 44,  89 => 39,  84 => 37,  76 => 32,  71 => 30,  63 => 25,  58 => 23,  50 => 18,  45 => 16,  37 => 11,  33 => 10,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "administracion/registro.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/administracion/registro.twig");
    }
}
