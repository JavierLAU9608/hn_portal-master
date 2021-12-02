<?php

/* productos/alojamiento/reserva_01.twig */
class __TwigTemplate_525ac0e38212e8a9d3f683b36dff643f1d1a3c25962edb959001f1c6b8710730 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "productos/alojamiento/reserva_01.twig", 1);
        $this->blocks = array(
            'stylesheet' => array($this, 'block_stylesheet'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
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
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        // line 5
        echo "\t<link href=\"web/css/jquery-bootstrap-datepicker.css\" rel=\"stylesheet\">
";
    }

    // line 8
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_alojamiento"), "html", null, true);
    }

    // line 9
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_alojamiento"), "html", null, true);
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        // line 12
        echo "<div class=\"container bg-form padding-bottom-20\">
\t<div id=\"center_area\" style=\"padding-top: 200px;\" class=\"content\">
\t\t<div class=\"form border_drk\">
\t\t\t";
        // line 15
        echo form_open(base_url("con_alojamiento/crear_reserva"), array("class" => "form_filter form form-vertical", "id" => "form_reserva_alojamiento", "onSubmit" => "return validar()"));
        echo "

\t\t\t<input type=\"hidden\" name=\"id_hotel\" value=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "id", array()), "html", null, true);
        echo "\"/>
\t\t\t";
        // line 18
        if (($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "confirmacion_online", array()) == "f")) {
            // line 19
            echo "\t\t\t\t<span class=\"black right\"><b>";
            echo twig_escape_filter($this->env, trans("reserva_a_confirmar"), "html", null, true);
            echo "</span>
\t\t\t\t<input type=\"hidden\" name=\"aconfirmar\" value=\"1\"/>
\t\t\t";
        }
        // line 22
        echo "
\t\t\t";
        // line 23
        if (((array_key_exists("key_car_reserva", $context)) ? (_twig_default_filter((isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null))) : (""))) {
            // line 24
            echo "\t\t\t\t<input  type=\"hidden\" name=\"key_car_reserva\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["key_car_reserva"]) ? $context["key_car_reserva"] : null), "html", null, true);
            echo "\"/>
\t\t\t";
        }
        // line 26
        echo "
\t\t\t";
        // line 27
        $context["pre_habitaciones_reserva"] = $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "habitaciones", array());
        // line 28
        echo "\t\t\t";
        $context["tota_habitaciones"] = twig_length_filter($this->env, (isset($context["pre_habitaciones_reserva"]) ? $context["pre_habitaciones_reserva"] : null));
        // line 29
        echo "
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<h2>";
        // line 32
        echo twig_escape_filter($this->env, trans("alojamiento"), "html", null, true);
        echo "</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-12 \">
\t\t\t\t\t<ul class=\"columns-text-simple\">
\t\t\t\t\t\t";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["facilidades"]) ? $context["facilidades"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["facilidad"]) {
            // line 37
            echo "\t\t\t\t\t\t\t<li>";
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["facilidad"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["facilidad"], "nombre_trad", array())))) ? ($this->getAttribute($context["facilidad"], "nombre_trad", array())) : ($this->getAttribute($context["facilidad"], "nombre", array()))), "html", null, true);
            echo "</li>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['facilidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<br class=\"clean\" /><br/>

\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t<label>";
        // line 47
        echo twig_escape_filter($this->env, trans("al_fecha_entrada"), "html", null, true);
        echo "</label><br/>
\t\t\t\t\t<input id=\"fecha_principal\" type=\"text\" readonly name=\"fecha\" class=\"selector_fecha input_cal form-control\" style=\"cursor: pointer !important;\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pre_habitacion"]) ? $context["pre_habitacion"] : null), "fecha", array()), "html", null, true);
        echo "\"/>
\t\t\t\t</div>

\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t<label>";
        // line 52
        echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
        echo "</label><br/>
\t\t\t\t\t<select id=\"tipo_hab_principal\" name=\"tipo_habitacion\" class=\"tipo_habitacion input_cal form-control\">
\t\t\t\t\t\t";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "habitaciones_reserva", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
            // line 55
            echo "\t\t\t\t\t\t\t";
            $context["nombre_habitacion"] = app_traduccion("hotel", "hotel_tipo_hab_idioma", "nombre", "tipo_habitacion_fk", $this->getAttribute($context["h"], "tipo_habitacion_fk", array()), $this->getAttribute($context["h"], "nombre_habitacion", array()));
            // line 56
            echo "\t\t\t\t\t\t\t";
            if (($this->getAttribute((isset($context["pre_habitacion"]) ? $context["pre_habitacion"] : null), "tipo_habitacion", array()) == $this->getAttribute($context["h"], "tipo_habitacion_fk", array()))) {
                // line 57
                echo "\t\t\t\t\t\t\t\t<option selected=\"selected\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["h"], "tipo_habitacion_fk", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["nombre_habitacion"]) ? $context["nombre_habitacion"] : null), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            // line 59
            echo "\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['h'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>

\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t<label>";
        // line 64
        echo twig_escape_filter($this->env, trans("al_cantidad_habitaciones"), "html", null, true);
        echo "</label><br/>
\t\t\t\t\t<input autocomplete=\"off\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["tota_habitaciones"]) ? $context["tota_habitaciones"] : null), "html", null, true);
        echo "\" type=\"text\" id=\"cantidad_habitaciones\" class=\"cantidad_habitaciones solo_numeros form-control\"/>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t";
        // line 69
        $context["numero_habitacion"] = 0;
        // line 70
        echo "\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pre_habitaciones_reserva"]) ? $context["pre_habitaciones_reserva"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pre_habitacion"]) {
            // line 71
            echo "
\t\t\t<div class=\"formulario_alojamiento border_drk_1\" style=\"position:relative;\">

\t\t\t\t<input type=\"hidden\" class=\"precio_habitacion\" name=\"precio_habitacion[]\" value=\"";
            // line 74
            echo twig_escape_filter($this->env, $this->getAttribute($context["pre_habitacion"], "precio", array()), "html", null, true);
            echo "\"/>

\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-12 margin-bottom-10\">
\t\t\t\t\t\t<hr/>
\t\t\t\t\t\t<div class=\"numero_habitacion text-price-box\">";
            // line 79
            $context["numero_habitacion"] = ((isset($context["numero_habitacion"]) ? $context["numero_habitacion"] : null) + 1);
            // line 80
            echo "\t\t\t\t\t\t\t";
            echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
            echo " #";
            echo twig_escape_filter($this->env, (isset($context["numero_habitacion"]) ? $context["numero_habitacion"] : null), "html", null, true);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"col-sm-4\">

\t\t\t\t\t\t<label>";
            // line 86
            echo twig_escape_filter($this->env, trans("al_hora_entrada"), "html", null, true);
            echo "</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t";
            // line 89
            echo "\t\t\t\t\t\t<select name=\"hora[]\" class=\"hora form-control\">
\t\t\t\t\t\t\t";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["horas"]) ? $context["horas"] : null));
            foreach ($context['_seq'] as $context["k"] => $context["hora"]) {
                // line 91
                echo "\t\t\t\t\t\t\t\t<option ";
                echo ((($context["hora"] == (isset($context["hora_selected"]) ? $context["hora_selected"] : null))) ? ("selected=\"selected\"") : (""));
                echo ">";
                echo twig_escape_filter($this->env, $context["hora"], "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['k'], $context['hora'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t<label>";
            // line 97
            echo twig_escape_filter($this->env, trans("al_plan_alojamiento"), "html", null, true);
            echo "</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<select name=\"plan[]\" class=\"plan form-control\">
\t\t\t\t\t\t\t";
            // line 100
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "plan_alojamiento", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                // line 101
                echo "\t\t\t\t\t\t\t\t";
                $context["plan"] = app_traduccion("hotel", "hotel_plan_idioma", null, "plan_fk", $this->getAttribute($context["p"], "plan_fk", array()), $context["p"]);
                // line 102
                echo "\t\t\t\t\t\t\t\t";
                $context["nombre_plan"] = (((($this->getAttribute((isset($context["plan"]) ? $context["plan"] : null), "nombre_plan", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["plan"]) ? $context["plan"] : null), "nombre_plan", array()))) : (""))) ? ($this->getAttribute((isset($context["plan"]) ? $context["plan"] : null), "nombre_plan", array())) : ($this->getAttribute((isset($context["plan"]) ? $context["plan"] : null), "nombre", array())));
                // line 103
                echo "\t\t\t\t\t\t\t\t";
                $context["descrip_plan"] = ((" (" . $this->getAttribute((isset($context["plan"]) ? $context["plan"] : null), "descripcion", array())) . ")");
                // line 104
                echo "
\t\t\t\t\t\t\t\t<option ";
                // line 105
                echo ((($this->getAttribute($context["pre_habitacion"], "plan", array()) == $this->getAttribute($context["p"], "plan_fk", array()))) ? ("selected=\"selected\"") : (null));
                echo " value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "plan_fk", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, ((isset($context["nombre_plan"]) ? $context["nombre_plan"] : null) . (isset($context["descrip_plan"]) ? $context["descrip_plan"] : null)), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 107
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t<label>";
            // line 111
            echo twig_escape_filter($this->env, trans("al_pax"), "html", null, true);
            echo "</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<select name=\"paxs[]\" class=\"cantidad_paxs input_cal form-control\">
\t\t\t\t\t\t\t";
            // line 114
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "nuevos_paxs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["n_pax"]) {
                // line 115
                echo "\t\t\t\t\t\t\t\t<option ";
                echo ((($this->getAttribute($context["pre_habitacion"], "paxs", array()) == $this->getAttribute($context["n_pax"], "val", array()))) ? ("selected=\"selected\"") : (null));
                echo " value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["n_pax"], "val", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["n_pax"], "opc", array()), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['n_pax'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-4 margin-top-15\">
\t\t\t\t\t\t<label>";
            // line 120
            echo twig_escape_filter($this->env, trans("al_noches"), "html", null, true);
            echo "</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<select name=\"noches[]\" class=\"input_cal noches form-control\">
\t\t\t\t\t\t\t";
            // line 123
            $context["minimo_noche"] = (($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "minimo_de_noches", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "minimo_de_noches", array()), 1)) : (1));
            // line 124
            echo "\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range((isset($context["minimo_noche"]) ? $context["minimo_noche"] : null), (isset($context["cant_max_noches"]) ? $context["cant_max_noches"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 125
                echo "\t\t\t\t\t\t\t<option ";
                echo ((($this->getAttribute($context["pre_habitacion"], "noches", array()) == $context["i"])) ? ("selected=\"selected\"") : (null));
                echo " value=\"";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"col-sm-4 margin-top-15 hidden\">
\t\t\t\t\t\t<label>";
            // line 131
            echo twig_escape_filter($this->env, trans("al_paquete_luna_miel"), "html", null, true);
            echo "
\t\t\t\t\t\t\t<a class=\"detalle_pql\" style=\"color: #FFFFFF; display: none\" href=\"javascript:\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-search\"></i> ";
            // line 133
            echo twig_escape_filter($this->env, trans("al_ver_detalles_paquete_luna_miel"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 135
            echo "
\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<select name=\"paquete_luna_miel[]\" class=\"paquete_luna_miel input_cal form-control\">
\t\t\t\t\t\t\t<option value=\"\">";
            // line 141
            echo twig_escape_filter($this->env, trans("seleccione"), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t";
            // line 142
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "paquetes_luna_miel", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["plm"]) {
                // line 143
                echo "\t\t\t\t\t\t\t\t";
                $context["nombre_paquete"] = $this->getAttribute($context["plm"], "nombre", array());
                // line 144
                echo "\t\t\t\t\t\t\t\t<option ";
                echo ((($this->getAttribute($context["pre_habitacion"], "paquete_luna_miel", array()) == $this->getAttribute($context["plm"], "id", array()))) ? ("selected=\"selected\"") : (null));
                echo " value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["plm"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["nombre_paquete"]) ? $context["nombre_paquete"] : null), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plm'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 146
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t</div>

";
            // line 150
            echo "
\t\t\t\t\t";
            // line 151
            $context["b2b"] = (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "id_tipo_cliente", array())) ? (true) : (false));
            // line 152
            echo "\t\t\t\t\t";
            if (((isset($context["b2b"]) ? $context["b2b"] : null) == true)) {
                // line 153
                echo "\t\t\t\t\t\t<div class=\"col-sm-4 margin-top-15\">
\t\t\t\t\t\t\t<label>";
                // line 154
                echo twig_escape_filter($this->env, trans("responsable_hab_nombre"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<br/>
\t\t\t\t\t\t\t<input required=\"required\" name=\"responsable_nombre[]\" autocomplete=\"off\" value=\"";
                // line 157
                echo twig_escape_filter($this->env, (($this->getAttribute($context["pre_habitacion"], "responsable_nombre", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["pre_habitacion"], "responsable_nombre", array()), "")) : ("")), "html", null, true);
                echo "\" type=\"text\" class=\"form-control\"/>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-sm-4 margin-top-15\">
\t\t\t\t\t\t\t<label>";
                // line 161
                echo twig_escape_filter($this->env, trans("responsable_hab_pasaporte"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<br/>
\t\t\t\t\t\t\t<input required=\"required\" name=\"responsable_pasaporte[]\" autocomplete=\"off\" value=\"";
                // line 164
                echo twig_escape_filter($this->env, (($this->getAttribute($context["pre_habitacion"], "responsable_pasaporte", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["pre_habitacion"], "responsable_pasaporte", array()), "")) : ("")), "html", null, true);
                echo "\" type=\"text\" class=\"form-control\"/>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
            }
            // line 167
            echo "
\t\t\t\t\t";
            // line 168
            $context["acepta_ninno_adicional"] = app_info_hab($this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "habitaciones_reserva", array()), $this->getAttribute($context["pre_habitacion"], "tipo_habitacion", array()), "ninno_adicional");
            // line 169
            echo "
\t\t\t\t\t<div class=\"col-sm-4 capa_ninno_adicional hidden\" ";
            // line 170
            echo (((((isset($context["acepta_ninno_adicional"]) ? $context["acepta_ninno_adicional"] : null) == "f") || ((isset($context["acepta_ninno_adicional"]) ? $context["acepta_ninno_adicional"] : null) == null))) ? ("style=\"visibility:hidden") : (null));
            echo ">
\t\t\t\t\t\t<label>";
            // line 171
            echo twig_escape_filter($this->env, trans("al_ninno_adicional"), "html", null, true);
            echo "</label>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<input ";
            // line 173
            echo ((($this->getAttribute($context["pre_habitacion"], "ninno_adicional", array()) != null)) ? ("checked") : (null));
            echo " type=\"checkbox\" name=\"ninno_adicional_";
            echo twig_escape_filter($this->env, ((isset($context["numero_habitacion"]) ? $context["numero_habitacion"] : null) - 1), "html", null, true);
            echo "\" class=\"ninno_adicional input_cal form-control\"/>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row padding-top-10\">
\t\t\t\t\t<div class=\"col-sm-12\">
                        ";
            // line 180
            echo "\t\t\t\t\t\t<label class=\"text-price-box text-black\">";
            echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
            echo ":
                            <s class=\"precio_original\">";
            // line 181
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["pre_habitacion"], "precio_original", array()) != $this->getAttribute($context["pre_habitacion"], "precio", array()))) ? ($this->getAttribute($context["pre_habitacion"], "precio_original", array())) : ("")), "html", null, true);
            echo "</s>
\t\t\t\t\t\t\t<span class=\"precio_habitacion_text text-price-box text-white\">";
            // line 182
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["pre_habitacion"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
\t\t\t\t\t\t</label>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pre_habitacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        echo "
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t<hr/>
\t\t\t\t</div>

\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t<label>";
        // line 195
        echo twig_escape_filter($this->env, trans("detalles_adicionales"), "html", null, true);
        echo "</label><br/>
\t\t\t\t\t<textarea name=\"detalles\" rows=\"5\" class=\"form-control\">";
        // line 196
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "options", array()), "detalles", array()), "html", null, true);
        echo "</textarea>
\t\t\t\t</div>

\t\t\t\t<br class=\"clean\"/>
\t\t\t\t";
        // line 200
        echo twig_escape_filter($this->env, (isset($context["flash_error"]) ? $context["flash_error"] : null), "html", null, true);
        echo "
\t\t\t\t<br class=\"clean\"/>
\t\t\t</div>

\t\t\t<div class=\"row padding-top-30\">
\t\t\t\t<div class=\"col-sm-12 precio_reserva\">
\t\t\t\t\t<p class=\"verdana text-price-hab text-black\">";
        // line 206
        echo twig_escape_filter($this->env, trans("precio"), "html", null, true);
        echo "</p>
\t\t\t\t\t<span></span>
\t\t\t\t\t<p class=\"verdana yellow_bg precio_reservacion text-price-hab text-white\">";
        // line 208
        echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute((isset($context["reserva"]) ? $context["reserva"] : null), "price", array()), "smb"), "html", null, true);
        echo "</p>
\t\t\t\t\t<input class=\"buttom roman btn btn-default circle\" type=\"submit\" name=\"btn_continuar\" value=\"";
        // line 209
        echo twig_escape_filter($this->env, trans("continuar"), "html", null, true);
        echo "\">
\t\t\t\t\t<input class=\"buttom roman btn btn-default circle\" type=\"submit\" name=\"btn_cancelar\" value=\"";
        // line 210
        echo twig_escape_filter($this->env, trans("cancelar"), "html", null, true);
        echo "\">
\t\t\t\t</div>
\t\t\t</div>

\t\t\t</form>
\t\t</div>
\t</div>
</div>
";
    }

    // line 220
    public function block_script($context, array $blocks = array())
    {
        // line 221
        echo "\t<script src=\"web/assets/jquery-ui/jquery.ui.datepicker-min.js\"></script>
\t<script src=\"web/assets/jquery-ui/jquery.ui.core-min.js\"></script>
\t<script src=\"web/assets/jquery-ui/i18n/jquery.ui.datepicker-";
        // line 223
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
        echo ".js\"></script>

\t<script language=\"javascript\" type=\"application/javascript\">
\t\tvar max_habitacion_reserva = ";
        // line 226
        echo twig_escape_filter($this->env, (isset($context["max_habitacion_reserva"]) ? $context["max_habitacion_reserva"] : null), "html", null, true);
        echo ";

\t\tfunction nonWorkingDates(date){

\t\t\tvar day = date.getDay();

\t\t\tfor (i = 0; i < closedDates.length; i++) {
\t\t\t\tvar fechamin = new Date(closedDates[i][0]);
\t\t\t\tvar fechamax = new Date(closedDates[i][1]);

\t\t\t\tif(compara_fecha_menor(fechamax,date)==true && compara_fecha_mayor(fechamin,date)==true)
\t\t\t\t\treturn [false,'paro_venta'];
\t\t\t}
\t\t\treturn [true];
\t\t}
\t\tfunction compara_fecha_menor(datefecha,menor)
\t\t{
\t\t\tif(datefecha.toString()==menor.toString())
\t\t\t\treturn true;
\t\t\tif(menor.getFullYear()<datefecha.getFullYear())
\t\t\t\treturn true;
\t\t\tif(menor.getFullYear()>datefecha.getFullYear())
\t\t\t\treturn false;
\t\t\tif(menor.getMonth()<datefecha.getMonth())
\t\t\t\treturn true;
\t\t\tif(menor.getMonth()>datefecha.getMonth())
\t\t\t\treturn false;
\t\t\tif(menor.getDate()<datefecha.getDate())
\t\t\t\treturn true;
\t\t\treturn false;
\t\t}
\t\tfunction compara_fecha_mayor(datefecha,mayor)
\t\t{
\t\t\tif(datefecha.toString()==mayor.toString())
\t\t\t\treturn true;
\t\t\tif(mayor.getFullYear()>datefecha.getFullYear())
\t\t\t\treturn true;
\t\t\tif(mayor.getFullYear()>datefecha.getFullYear())
\t\t\t\treturn false;
\t\t\tif(mayor.getMonth()>datefecha.getMonth())
\t\t\t\treturn true;
\t\t\tif(mayor.getMonth()<datefecha.getMonth())
\t\t\t\treturn false;
\t\t\tif(mayor.getDate()>datefecha.getDate())
\t\t\t\treturn true;
\t\t\treturn false;
\t\t}

\t\t\$('.plan').change(function(){
\t\t\tvar tipo_habitacion = \$('#tipo_hab_principal').val();
\t\t\tvar fecha = \$(\"#fecha_principal\").val();

\t\t\tvar capa_form_parent = \$(this).parent().parent().parent();
\t\t\tvar paxs = capa_form_parent.find('select.cantidad_paxs').val();
\t\t\tvar noches = capa_form_parent.find('select.noches').val();
\t\t\tvar plan = capa_form_parent.find('select.plan').val();
\t\t\tvar token = \$(\"input[name='token']\").val();

\t\t\t\$.ajax({
\t\t\t\t'url':  'con_alojamiento/get_paxs',
\t\t\t\t'data':{'tipo_habitacion' : tipo_habitacion, 'fecha' : fecha, 'plan': plan, 'paxs' : paxs, 'token': token},
\t\t\t\t'dataType': 'json',
\t\t\t\t'type': 'POST',
\t\t\t\t'beforeSend': function(){
\t\t\t\t\t//\$('.loader_reserva').show();
\t\t\t\t\tNacional.startLoading(capa_form_parent);
\t\t\t\t},
\t\t\t\t'success': function(data) {
\t\t\t\t\tif(data.ok == 't')
\t\t\t\t\t{
\t\t\t\t\t\tvar obj = capa_form_parent.find('select:.cantidad_paxs');
\t\t\t\t\t\tobj.empty();
\t\t\t\t\t\tfor (var t_i = 0; t_i < data.n_paxs.length; t_i++) {
\t\t\t\t\t\t\t//var vopc = data.n_paxs[t_i]['opc'];
\t\t\t\t\t\t\tobj.append('<option value=\"'+data.n_paxs[t_i]['val']+'\">'+data.n_paxs[t_i]['opc']+'</option>');
\t\t\t\t\t\t}
\t\t\t\t\t\tobj.val(data.paxs);

\t\t\t\t\t\tprecio(capa_form_parent.find('select:.cantidad_paxs'));
\t\t\t\t\t}

\t\t\t\t\tNacional.stopLoading(capa_form_parent);
\t\t\t\t}
\t\t\t});

\t\t});

\t\t\$('#fecha_principal').change(function(){
\t\t\tvar tipo_habitacion = \$('#tipo_hab_principal').val();
\t\t\tvar fecha = \$(\"#fecha_principal\").val();
\t\t\tvar cantidad_habitaciones = \$('#cantidad_habitaciones').val();
\t\t\t\$(\".selector_fecha\").val(fecha);
\t\t\tvar token = \$(\"input[name='token']\").val();

\t\t\t\$.ajax({
\t\t\t\t'url':  'con_alojamiento/get_dispo',
\t\t\t\t'data':{'tipo_habitacion':tipo_habitacion, 'fecha':fecha, 'cant_habitaciones': cantidad_habitaciones, 'token': token},
\t\t\t\t'dataType': 'json',
\t\t\t\t'type': 'POST',
\t\t\t\t'beforeSend': function(){
\t\t\t\t\tNacional.startLoading();
\t\t\t\t},
\t\t\t\t'success': function(data) {
\t\t\t\t\tif(data.ok == 't')
\t\t\t\t\t{
\t\t\t\t\t\tvar t_hab = \$('#cantidad_habitaciones');
\t\t\t\t\t\tvar temp = t_hab.val();
\t\t\t\t\t\tmax_habitacion_reserva = data.habitaciones;

\t\t\t\t\t\tif (temp > data.habitaciones) {
\t\t\t\t\t\t\tt_hab.val(data.habitaciones);
\t\t\t\t\t\t\tt_hab.keyup();
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tt_hab.val(temp);
\t\t\t\t\t\t}

\t\t\t\t\t\tvar t_noches =  \$('.noches');
\t\t\t\t\t\tt_noches.each(function (i, e) {
\t\t\t\t\t\t\tvar temp = \$(this).val();
\t\t\t\t\t\t\t\$(this).empty();
\t\t\t\t\t\t\tfor (var t_i = data.noches_min; t_i <= data.noches_max; t_i++) {
\t\t\t\t\t\t\t\t\$(this).append('<option value=\"'+t_i+'\">'+t_i+'</option>');
\t\t\t\t\t\t\t}
\t\t\t\t\t\t\tif (temp > data.noches_max) {
\t\t\t\t\t\t\t\t\$(this).val(data.noches_max);
\t\t\t\t\t\t\t\t\$(this).change();
\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\$(this).val(temp);
\t\t\t\t\t\t\t}
\t\t\t\t\t\t});

\t\t\t\t\t\tif (data.info != null) {
\t\t\t\t\t\t\t\$('#dispo_info').attr('title', data.info);
\t\t\t\t\t\t\t\$('#dispo_info').removeClass('hidden');
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\$('#dispo_info').addClass('hidden');
\t\t\t\t\t\t}

\t\t\t\t\t\ttotal();

\t\t\t\t\t} else if(data.ok == 'f') {
\t\t\t\t\t\talert(data.msg);
\t\t\t\t\t}

\t\t\t\t\tNacional.stopLoading();
\t\t\t\t}
\t\t\t});
\t\t});

\t\t\$(\".selector_fecha\").datepicker(
\t\t\t\t{
\t\t\t\t\t\"dateFormat\": \"yy-mm-dd\",
\t\t\t\t\tminDate: '";
        // line 378
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "fecha_minima", array()), "html", null, true);
        echo "',
\t\t\t\t\tmaxDate: '";
        // line 379
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["hotel"]) ? $context["hotel"] : null), "fecha_maxima", array()), "html", null, true);
        echo "',
\t\t\t\t\tbeforeShowDay: nonWorkingDates,
\t\t\t\t\tonChangeMonthYear: function (year, month, inst) {
\t\t\t\t\t\tvar fecha = year + '-' + month + '-01';
\t\t\t\t\t\tupdate_datepicker(\"";
        // line 383
        echo twig_escape_filter($this->env, trans("seleccione_dia"), "html", null, true);
        echo "\", fecha);
\t\t\t\t\t}
\t\t\t\t},
\t\t\t\t\$.datepicker.regional[\"";
        // line 386
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array()), "html", null, true);
        echo "\"]
\t\t);

\t\tfunction update_datepicker(msg, fecha) {
\t\t\tvar tipo_habitacion = \$('#tipo_hab_principal').val();
\t\t\tvar token = \$(\"input[name='token']\").val();
\t\t\t\$.ajax({
\t\t\t\t'url':  'con_alojamiento/get_paros',
\t\t\t\t'data':{'tipo_habitacion':tipo_habitacion, 'fecha':fecha, 'token':token},
\t\t\t\t'dataType': 'json',
\t\t\t\t'type': 'POST',
\t\t\t\t'beforeSend': function(){


\t\t\t\t},
\t\t\t\t'success': function(data) {

\t\t\t\t\tif(data.ok == 't')
\t\t\t\t\t{
\t\t\t\t\t\tclosedDates = data.paros;
\t\t\t\t\t\t\$(\"#fecha_principal\").datepicker(\"refresh\");
\t\t\t\t\t}


\t\t\t\t},
\t\t\t\t'error' : function() {

\t\t\t\t}
\t\t\t});
\t\t}

\t\t\$('.tipo_habitacion').change(function(){

\t\t\tvar capa_form_parent = \$(this).parent().parent().parent();
\t\t\tvar cantidad_paxs = capa_form_parent.find('select.cantidad_paxs');
\t\t\tvar sel_cantidad_paxs = cantidad_paxs.val();
\t\t\tvar capa_ninno_adicional = capa_form_parent.find('div.capa_ninno_adicional');
\t\t\tvar ninno_adicional = capa_form_parent.find('input.ninno_adicional');
\t\t\tninno_adicional.removeAttr('checked');
\t\t\tvar tipo_habitacion = \$(this).val();
\t\t\tif(capacidades_maximas[tipo_habitacion].ninno_adicional == 't')
\t\t\t{
\t\t\t\tcapa_ninno_adicional.css('visibility','visible');
\t\t\t}
\t\t\telse
\t\t\t\tcapa_ninno_adicional.css('visibility','hidden');

\t\t\tcantidad_paxs.empty();
\t\t\tvar limites = capacidades_maximas[tipo_habitacion];
\t\t\tfor (var i = 1; i <= limites.max_pax; i++)
\t\t\t\tcantidad_paxs.append('<option value=\"'+i+'\">'+i+'</option>');
\t\t\tcantidad_paxs.val(sel_cantidad_paxs);

\t\t});
\t\t\$(\".paquete_luna_miel\").change(function(){
\t\t\tvar capa_exterior = \$(this).parent();
\t\t\tvar img_detalle_luna_miel = capa_exterior.find('.detalle_pql');

\t\t\tif(\$(this).val()>0)
\t\t\t{
\t\t\t\timg_detalle_luna_miel.css('display','');
\t\t\t}
\t\t\telse
\t\t\t\timg_detalle_luna_miel.css('display','none');
\t\t});
\t\t\$(\".detalle_pql\").click(function(){
\t\t\tvar capa_exterior = \$(this).parent().parent();
\t\t\tvar paquete_luna_miel = capa_exterior.find('select.paquete_luna_miel');
\t\t\tvar id_paquete_luna_miel = paquete_luna_miel.val();
\t\t\tvar token = \$(\"input[name='token']\").val();
\t\t\tif(id_paquete_luna_miel)
\t\t\t{
\t\t\t\t\$.ajax({
\t\t\t\t\t'url':  'con_alojamiento/paquete_luna_miel',
\t\t\t\t\t'data':{'id_paquete':id_paquete_luna_miel, 'token': token},
\t\t\t\t\t'dataType': 'json',
\t\t\t\t\t'type': 'POST',
\t\t\t\t\t'beforeSend': function(){
\t\t\t\t\t\tNacional.startLoading(capa_exterior);
\t\t\t\t\t},
\t\t\t\t\t'success': function(data) {
\t\t\t\t\t\tif(data.ok == 't')
\t\t\t\t\t\t{
\t\t\t\t\t\t\talert(data.nombre+'\\n\\n'+data.descripcion);
\t\t\t\t\t\t}
\t\t\t\t\t\telse if(data.ok == 'f')
\t\t\t\t\t\t{

\t\t\t\t\t\t}

\t\t\t\t\t\tNacional.stopLoading(capa_exterior);
\t\t\t\t\t}
\t\t\t\t});
\t\t\t}
\t\t});

\t\t\$(\".input_cal\").change(function() {
\t\t\tprepare();
\t\t\tprecio(\$(this));
\t\t});
\t\t\$(\".cantidad_habitaciones\").keyup(function() {

\t\t\tif (\$(this).val() > max_habitacion_reserva) {
\t\t\t\talert('";
        // line 489
        echo twig_escape_filter($this->env, trans("al_error_cantidad_habitaciones"), "html", null, true);
        echo "' + max_habitacion_reserva);
\t\t\t\t\$(this).val(max_habitacion_reserva);
\t\t\t}

\t\t\tvar cant_selected = \$(this).val();
\t\t\tif ( cant_selected > 0 )
\t\t\t{
\t\t\t\tvar cant_habitacion = \$('.formulario_alojamiento').length;
\t\t\t\tvar cant_for = cant_selected - cant_habitacion;
\t\t\t\tif ( cant_for > 0 )
\t\t\t\t{
\t\t\t\t\tvar precio_habitacion_0=\$('.formulario_alojamiento:eq(0) .precio_habitacion').val();
\t\t\t\t\tvar tipo_habitacion_0=\$('#tipo_hab_principal').val();
\t\t\t\t\tvar selector_fecha_0=\$('#fecha_principal').val();
\t\t\t\t\tvar hora_0=\$('.formulario_alojamiento:eq(0) .hora').val();
\t\t\t\t\tvar noches_0=\$('.formulario_alojamiento:eq(0) .noches').val();
\t\t\t\t\tvar plan_0=\$('.formulario_alojamiento:eq(0) .plan').val();
\t\t\t\t\tvar cantidad_paxs_0=\$('.formulario_alojamiento:eq(0) .cantidad_paxs').val();
\t\t\t\t\tvar ninno_adicional_0=\$('.formulario_alojamiento:eq(0) .ninno_adicional').val();
\t\t\t\t\tvar paquete_luna_miel_0=\$('.formulario_alojamiento:eq(0) .paquete_luna_miel').val();

\t\t\t\t\tfor (var i = 0; i < cant_for; i++)
\t\t\t\t\t{
\t\t\t\t\t\t\$('.formulario_alojamiento:eq(0)').clone(true).insertAfter(\".formulario_alojamiento:last\");
\t\t\t\t\t\t\$('.formulario_alojamiento:last .numero_habitacion').html('<font>";
        // line 513
        echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
        echo " #' + (i + cant_habitacion + 1)  + '</font>');
\t\t\t\t\t\t\$('.formulario_alojamiento:last .precio_habitacion').val(precio_habitacion_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .tipo_habitacion').val(tipo_habitacion_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .hora').val(hora_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .noches').val(noches_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .plan').val(plan_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .cantidad_paxs').val(cantidad_paxs_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .ninno_adicional').attr('name','ninno_adicional_'+(i+1));
\t\t\t\t\t\t\$('.formulario_alojamiento:last .ninno_adicional').val(ninno_adicional_0);
\t\t\t\t\t\t\$('.formulario_alojamiento:last .paquete_luna_miel').val(paquete_luna_miel_0);

\t\t\t\t\t}
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tfor (var i = 0; i > cant_for; i--) {
\t\t\t\t\t\t\$('.formulario_alojamiento:last').remove();
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\tprepare();

\t\t\ttotal();
\t\t});
\t\tfunction prepare()
\t\t{
\t\t\t\$('._tipo_hab').each(function (i, e) {
\t\t\t\t\$(e).val(\$('#tipo_hab_principal').val());
\t\t\t});
\t\t\t\$('._fecha_hab').each(function (i, e) {
\t\t\t\t\$(e).val(\$('#fecha_principal').val());
\t\t\t});
\t\t}
\t\tfunction precio(elemento)
\t\t{
\t\t\tvar capa_form_parent = elemento.parent().parent().parent();

\t\t\tvar fecha = \$('#fecha_principal').val();

\t\t\tvar paxs = capa_form_parent.find('select.cantidad_paxs').val();
\t\t\tif(paxs !='' && fecha !=='')
\t\t\t{
\t\t\t\tvar tipo_habitacion = \$('#tipo_hab_principal').val();
\t\t\t\tvar noches = capa_form_parent.find('select.noches').val();
\t\t\t\tvar plan = capa_form_parent.find('select.plan').val();
\t\t\t\tvar ninno_adicional = capa_form_parent.find('input.ninno_adicional').attr(\"checked\")?true:'';
\t\t\t\tvar paquete_luna_miel = capa_form_parent.find('select.paquete_luna_miel').val();
\t\t\t\tvar fondo = \$('<div class=\"box-modal-bg\"/>');
\t\t\t\tvar token = \$(\"input[name='token']\").val();
\t\t\t\t\$.ajax({
\t\t\t\t\t'url':  'con_alojamiento/calcular',
\t\t\t\t\t'data':{'tipo_habitacion':tipo_habitacion,
\t\t\t\t\t\t'fecha':fecha,
\t\t\t\t\t\t'noches':noches,
\t\t\t\t\t\t'plan':plan,
\t\t\t\t\t\t'paxs':paxs,
\t\t\t\t\t\t'ninno_adicional':ninno_adicional,
\t\t\t\t\t\t'paquete_luna_miel':paquete_luna_miel,
\t\t\t\t\t\t'token': token
\t\t\t\t\t},
\t\t\t\t\t'dataType': 'json',
\t\t\t\t\t'type': 'POST',
\t\t\t\t\t'beforeSend': function(){
\t\t\t\t\t\tNacional.startLoading(capa_form_parent);
\t\t\t\t\t},
\t\t\t\t\t'success': function(data) {
\t\t\t\t\t\tif(data.ok == 't')
\t\t\t\t\t\t{
\t\t\t\t\t\t\tcapa_form_parent.find('span.precio_habitacion_text').html(data.precio_convertido+' '+data.smb_moneda);
\t\t\t\t\t\t\tcapa_form_parent.find('input.precio_habitacion').val(data.precio_convertido);

\t\t\t\t\t\t\t\$('.precio_reservacion').html(data.precio);
                            if (data.precio != data.precio_original) {
                                capa_form_parent.find('.precio_original').html(data.precio_original);
                            } else {
                                capa_form_parent.find('.precio_original').html('');
                            }
\t\t\t\t\t\t}
\t\t\t\t\t\telse if(data.ok == 'f')
\t\t\t\t\t\t{
\t\t\t\t\t\t\tcapa_form_parent.find('input.precio_habitacion').val(0);
\t\t\t\t\t\t\tcapa_form_parent.find('span.precio_habitacion_text').html('');
\t\t\t\t\t\t\t//alert(data.msg);
\t\t\t\t\t\t}
\t\t\t\t\t\ttotal();
\t\t\t\t\t\tNacional.stopLoading(capa_form_parent);
\t\t\t\t\t}
\t\t\t\t});
\t\t\t}
\t\t}
\t\tfunction total()
\t\t{
\t\t\tnew_price = 0;
\t\t\t\$('.precio_reservacion').html('');
\t\t\tvar simb='';
\t\t\t\$('.precio_habitacion').each(function(index, term) {
\t\t\t\tnew_price += parseFloat(\$(this).val());
\t\t\t});
\t\t\tif(new_price > 0)
\t\t\t\t\$('.precio_reservacion').html(new_price+' '+'";
        // line 613
        echo twig_escape_filter($this->env, (isset($context["SIMBOLO_MONEDA"]) ? $context["SIMBOLO_MONEDA"] : null), "html", null, true);
        echo "');
\t\t}
\t\tfunction validar()
\t\t{
\t\t\tif(\$('.precio_reservacion').html()!=='')
\t\t\t\treturn true;
\t\t\talert('";
        // line 619
        echo twig_escape_filter($this->env, trans("al_error_reserva_incorrecta"), "html", null, true);
        echo "');
\t\t\treturn false;
\t\t}
\t\tfunction hab_capacidad(id,max_pax,ninno_adicional)
\t\t{
\t\t\tthis.id=id;
\t\t\tthis.max_pax=max_pax;
\t\t\tthis.ninno_adicional=ninno_adicional;
\t\t}
\t\tvar capacidades_maximas = new Array();
\t\t";
        // line 629
        echo (isset($context["js"]) ? $context["js"] : null);
        echo "

\t\t";
        // line 631
        echo (isset($context["closedDates"]) ? $context["closedDates"] : null);
        echo "

\t\tprepare();

\t\t\$('._tipo_hab').each(function (i, e) {
\t\t\tprecio(\$(this));
\t\t});
\t</script>
";
    }

    public function getTemplateName()
    {
        return "productos/alojamiento/reserva_01.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  988 => 631,  983 => 629,  970 => 619,  961 => 613,  858 => 513,  831 => 489,  725 => 386,  719 => 383,  712 => 379,  708 => 378,  553 => 226,  547 => 223,  543 => 221,  540 => 220,  527 => 210,  523 => 209,  519 => 208,  514 => 206,  505 => 200,  498 => 196,  494 => 195,  485 => 188,  473 => 182,  469 => 181,  464 => 180,  453 => 173,  448 => 171,  444 => 170,  441 => 169,  439 => 168,  436 => 167,  430 => 164,  424 => 161,  417 => 157,  411 => 154,  408 => 153,  405 => 152,  403 => 151,  400 => 150,  395 => 146,  382 => 144,  379 => 143,  375 => 142,  371 => 141,  363 => 135,  359 => 133,  354 => 131,  348 => 127,  335 => 125,  330 => 124,  328 => 123,  322 => 120,  317 => 117,  304 => 115,  300 => 114,  294 => 111,  288 => 107,  276 => 105,  273 => 104,  270 => 103,  267 => 102,  264 => 101,  260 => 100,  254 => 97,  248 => 93,  237 => 91,  233 => 90,  230 => 89,  225 => 86,  213 => 80,  211 => 79,  203 => 74,  198 => 71,  193 => 70,  191 => 69,  184 => 65,  180 => 64,  174 => 60,  168 => 59,  160 => 57,  157 => 56,  154 => 55,  150 => 54,  145 => 52,  138 => 48,  134 => 47,  124 => 39,  115 => 37,  111 => 36,  104 => 32,  99 => 29,  96 => 28,  94 => 27,  91 => 26,  85 => 24,  83 => 23,  80 => 22,  73 => 19,  71 => 18,  67 => 17,  62 => 15,  57 => 12,  54 => 11,  48 => 9,  42 => 8,  37 => 5,  35 => 4,  32 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "productos/alojamiento/reserva_01.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/productos/alojamiento/reserva_01.twig");
    }
}
