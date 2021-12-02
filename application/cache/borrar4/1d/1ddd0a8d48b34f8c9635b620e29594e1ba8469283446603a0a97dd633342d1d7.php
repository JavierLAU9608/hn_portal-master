<?php

/* mensaje.twig */
class __TwigTemplate_6bfd9f1392daef337f45afa86b207f820ce1c3ba69d45ddb453c8f43f74b83e3 extends Twig_Template
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
        echo "<div class=\"modal fade\" id=\"alert_msg\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"alert_msgTitle\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">

            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
                <h4 class=\"modal-title\" id=\"alert_msgTitle\">

                </h4>
            </div>

            <div class=\"modal-body\" id=\"alert_msgBody\">

            </div>

            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 19
        echo twig_escape_filter($this->env, trans("form_aceptar"), "html", null, true);
        echo "</button>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "mensaje.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 19,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "mensaje.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/mensaje.twig");
    }
}
