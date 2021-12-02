<?php

/* home.twig */
class __TwigTemplate_14397cbf0a6d6f3fed73556a3c6b7bef78c1e9a783b986cad2a198f5196ab376 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "home.twig", 1);
        $this->blocks = array(
            'slider_js' => array($this, 'block_slider_js'),
            'js_homepage' => array($this, 'block_js_homepage'),
            'pixel' => array($this, 'block_pixel'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'barra_reserva' => array($this, 'block_barra_reserva'),
            'slide_show' => array($this, 'block_slide_show'),
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
    public function block_slider_js($context, array $blocks = array())
    {
        // line 4
        echo "    <!-- BEGIN RevolutionSlider -->
    <script src=\"web/js/jquery.themepunch.revolution.min.js\" type=\"text/javascript\"></script>
    <script src=\"web/js/jquery.themepunch.tools.min.js\" type=\"text/javascript\"></script>
    <script src=\"web/js/revo-ini.js\" type=\"text/javascript\"></script>
    <!-- END RevolutionSlider -->
";
    }

    // line 11
    public function block_js_homepage($context, array $blocks = array())
    {
        // line 12
        echo "    <script src=\"web/js/jquery.easing.js\"></script>
    <script src=\"web/js/jquery.parallax.js\"></script>
    <script src=\"web/js/jquery.nav.js\"></script>
    <script src=\"web/assets/jquery_lazyload-2.x/lazyload.min.js\" type=\"text/javascript\"></script>
";
    }

    // line 18
    public function block_pixel($context, array $blocks = array())
    {
        // line 19
        echo "    <meta name=\"msvalidate.01\" content=\"7B5B67DF1BBDED5D81554335C6B7B366\" />
";
    }

    // line 22
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 23
        echo "    ";
        // line 24
        echo "
    <link href=\"web/assets/bootstrap-datepicker/css/datepicker.css\" rel=\"stylesheet\">
    <link href=\"web/assets/bootstrap-datepicker/css/datepicker3.css\" rel=\"stylesheet\">
";
    }

    // line 29
    public function block_barra_reserva($context, array $blocks = array())
    {
        // line 30
        echo "    <!-- Header BEGIN -->
    <div class=\"header header-mobi-ext\">
        <div class=\"container\">
            <div class=\"row\">
                <!-- Logo BEGIN -->
                <div class=\"col-md-3 col-sm-3 col-xs-6 padding-top-10\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"text-white text-uppercase\">";
        // line 38
        echo twig_escape_filter($this->env, trans("precio_desde"), "html", null, true);
        echo ":</span>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12 text-border-bottom\" style=\"width: auto !important;\">
                            <span id=\"default_room_precio\" class=\"text-black text-price\">";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_room"]) ? $context["default_room"] : null), "precio", array()), "html", null, true);
        echo "</span>
                            <span class=\"text-white text-price text-uppercase\"> / ";
        // line 44
        echo twig_escape_filter($this->env, trans("noche"), "html", null, true);
        echo "</span>
                        </div>
                    </div>
                </div>
                <!-- Logo END -->
                <a href=\"javascript:void(0);\" class=\"mobi-toggler\"><i class=\"fa fa-search\"></i></a>
                <!-- Navigation BEGIN -->
                <div class=\"col-md-9 pull-right header-navigation\">

                        ";
        // line 53
        echo form_open("reserva-alojamiento", array("class" => "form-inline"));
        echo "
                        <div class=\"form-group\">
                            <label for=\"nombre_habitacion\" class=\"hidden-xs label-white\">";
        // line 55
        echo twig_escape_filter($this->env, trans("al_habitacion"), "html", null, true);
        echo "</label>
                            <div class=\"input-icon\">
                                <i class=\"fa fa-bed\"></i>
                                <select required=\"required\" id=\"nombre_habitacion\" name=\"tipo_habitacion\" class=\"form-control input-small\">
                                        ";
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_alojamientos"]) ? $context["lista_alojamientos"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["al"]) {
            // line 60
            echo "                                            <option data-precio=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "precio", array()), "html", null, true);
            echo "\" ";
            echo ((($this->getAttribute((isset($context["default_room"]) ? $context["default_room"] : null), "tipo_habitacion_fk", array()) == $this->getAttribute($context["al"], "tipo_habitacion_fk", array()))) ? ("selected=\"selected\"") : (""));
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "tipo_habitacion_fk", array()), "html", null, true);
            echo "\">
                                                ";
            // line 61
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["al"], "nombre_trad_", array(), "any", true, true) &&  !(null === $this->getAttribute($context["al"], "nombre_trad_", array())))) ? ($this->getAttribute($context["al"], "nombre_trad_", array())) : ($this->getAttribute($this->getAttribute($context["al"], "tipo", array()), "nombre_habitacion", array()))), "html", null, true);
            echo "
                                            </option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['al'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "                                    </select>
                                </div>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"date_in_room\" class=\"hidden-xs label-white\">";
        // line 69
        echo twig_escape_filter($this->env, trans("al_fecha_entrada"), "html", null, true);
        echo "</label>
                            <div class=\"input-icon\" id=\"datepicker_container\">
                                <i class=\"fa fa-calendar\"></i>
                                <input required=\"required\" autocomplete=\"off\" id=\"date_in_room\" type=\"text\" name=\"fecha\" class=\"form-control input-small\">
                                </div>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"booking_noches\" class=\"hidden-xs label-white\">";
        // line 77
        echo twig_escape_filter($this->env, trans("al_noches"), "html", null, true);
        echo "</label>
                            <div class=\"input-icon\">
                                <i class=\"fa fa-moon-o\"></i>
                                <select required=\"required\" id=\"booking_noches\" name=\"noches\" class=\"form-control\">
                                    <option value=\"1\">1</option>
                                </select>
                                </div>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"no_habitacion\" class=\"hidden-xs label-white\">";
        // line 87
        echo twig_escape_filter($this->env, trans("al_cantidad_habitaciones_abreviado"), "html", null, true);
        echo "</label>
                            <div class=\"input-icon\">
                                <i class=\"fa fa-home\"></i>
                                <select required=\"required\" id=\"no_habitacion\" name=\"cantidad_habitaciones\" class=\"form-control\">
                                    <option value=\"1\">1</option>
                                </select>
                                </div>
                            </div>


                            <input class=\"btn circle btn-default-booking margin-top-20\" type=\"submit\" value=\"";
        // line 97
        echo twig_escape_filter($this->env, trans("reservar"), "html", null, true);
        echo "\">


                        <img src=\"web/img/free-wifi.png\" alt=\"Free Wifi\" title=\"Free Wifi\" class=\"img-responsive\" style=\"position: relative; float: right;\" />
                        </form>



                    </div>
                </div>
                <!-- Navigation END -->
            </div>
        </div>
    </div>
    <!-- Header END -->
";
    }

    // line 114
    public function block_slide_show($context, array $blocks = array())
    {
        // line 115
        echo "    <!-- Promo block BEGIN -->
    <div class=\"promo-block\" id=\"promo-block\">
        <div class=\"tp-banner-container\">
            <div class=\"tp-banner\" >
                <ul>
                    ";
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["slide_show"]) ? $context["slide_show"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["ss"]) {
            // line 121
            echo "                        <li data-transition=\"fade\" data-slotamount=\"5\" data-masterspeed=\"700\" data-delay=\"9400\" class=\"slider-item-1\">
                            <img src=\"";
            // line 122
            echo twig_escape_filter($this->env, ((app_url_admin() . "/admin/slideshow/slide-") . $this->getAttribute($context["ss"], "url_imagen", array())), "html", null, true);
            echo "\" data-bgfit=\"cover\" data-bgposition=\"center center\" data-bgrepeat=\"no-repeat\" class=\"fade\">
                            <div class=\"caption lft start\"
                                 data-y=\"top\"
                                 data-voffset=\"110\"
                                 data-x=\"right\"
                                 data-hoffset=\"0\"
                                 data-speed=\"600\"
                                 data-start=\"500\"
                                 data-easing=\"easeOutBack\"><img src=\"web/img/world-travel-award.png\" alt=\"\">
                            </div>

                            ";
            // line 133
            if ((twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())) == "es")) {
                // line 134
                echo "                                <div class=\"caption lft start\"
                                     data-y=\"top\"
                                     data-voffset=\"100\"
                                     data-x=\"left\"
                                     data-hoffset=\"0\"
                                     data-speed=\"600\"
                                     data-start=\"500\"
                                     data-easing=\"easeOutBack\"><img src=\"web/img/logo/exe_es.png\" alt=\"\">
                                </div>
                            ";
            } else {
                // line 144
                echo "                                <div class=\"caption lft start\"
                                     data-y=\"top\"
                                     data-voffset=\"100\"
                                     data-x=\"left\"
                                     data-hoffset=\"0\"
                                     data-speed=\"600\"
                                     data-start=\"500\"
                                     data-easing=\"easeOutBack\"><img src=\"web/img/logo/exe_en.png\" alt=\"\">
                                </div>
                            ";
            }
            // line 154
            echo "

                            <div class=\"tp-caption large_text fade ";
            // line 156
            echo (($this->getAttribute($context["loop"], "firts", array())) ? ("customin customout start") : (""));
            echo "\"
                                 data-x=\"left\"
                                 data-hoffset=\"0\"
                                 data-y=\"bottom\"
                                 data-voffset=\"-20\"
                                 data-customin=\"x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;\"
                                 data-customout=\"x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;\"
                                 data-speed=\"1000\"
                                 data-start=\"500\"
                                 data-easing=\"Back.easeInOut\"
                                 data-endspeed=\"300\">

                                <div class=\"promo-like-text\">
                                    <h2>
                                        ";
            // line 170
            if ((($this->getAttribute($context["ss"], "link", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["ss"], "link", array()), false)) : (false))) {
                // line 171
                echo "                                            <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ss"], "link", array()), "html", null, true);
                echo "\">";
                echo ((($this->getAttribute($context["ss"], "titulo_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["ss"], "titulo_trad", array())))) ? ($this->getAttribute($context["ss"], "titulo_trad", array())) : ($this->getAttribute($context["ss"], "titulo", array())));
                echo "</a>
                                        ";
            } else {
                // line 173
                echo "                                            ";
                echo ((($this->getAttribute($context["ss"], "titulo_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["ss"], "titulo_trad", array())))) ? ($this->getAttribute($context["ss"], "titulo_trad", array())) : ($this->getAttribute($context["ss"], "titulo", array())));
                echo "
                                        ";
            }
            // line 175
            echo "                                    </h2>
                                    <p>
                                        ";
            // line 177
            if ((($this->getAttribute($context["ss"], "link", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["ss"], "link", array()), false)) : (false))) {
                // line 178
                echo "                                            <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ss"], "link", array()), "html", null, true);
                echo "\">";
                echo ((($this->getAttribute($context["ss"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["ss"], "descripcion_trad", array())))) ? ($this->getAttribute($context["ss"], "descripcion_trad", array())) : ($this->getAttribute($context["ss"], "descripcion", array())));
                echo "</a>
                                        ";
            } else {
                // line 180
                echo "                                            ";
                echo ((($this->getAttribute($context["ss"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["ss"], "descripcion_trad", array())))) ? ($this->getAttribute($context["ss"], "descripcion_trad", array())) : ($this->getAttribute($context["ss"], "descripcion", array())));
                echo "
                                        ";
            }
            // line 182
            echo "                                    </p>
                                </div>
                            </div>
                        </li>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ss'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 187
        echo "                </ul>
            </div>
        </div>
    </div>
    <!-- Promo block END -->
";
    }

    // line 194
    public function block_content($context, array $blocks = array())
    {
        // line 195
        echo "    <!-- About block BEGIN -->
    <div class=\"about-block content content-center\" id=\"about\">
        <div class=\"container\">
            <h1>";
        // line 198
        echo twig_escape_filter($this->env, trans("hotel_nacional_cuba"), "html", null, true);
        echo "</h1>

            <div class=\"padding-bottom-40 text-content\" style=\"font-size: 16px;\">
                ";
        // line 201
        echo ((($this->getAttribute((isset($context["texto_presentacion"]) ? $context["texto_presentacion"] : null), "value_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["texto_presentacion"]) ? $context["texto_presentacion"] : null), "value_trad", array())))) ? ($this->getAttribute((isset($context["texto_presentacion"]) ? $context["texto_presentacion"] : null), "value_trad", array())) : ($this->getAttribute((isset($context["texto_presentacion"]) ? $context["texto_presentacion"] : null), "value", array())));
        echo "
            </div>

            <h2>";
        // line 204
        echo twig_escape_filter($this->env, trans("alojamiento"), "html", null, true);
        echo "</h2>
            ";
        // line 205
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_alojamientos"]) ? $context["lista_alojamientos"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["al"]) {
            if (($this->getAttribute($context["al"], "precio_numerico", array()) > 0)) {
                // line 206
                echo "                <div class=\"row border-hab margin-bottom-30\">
                    <div class=\"col-md-6 padding-left-0\">
                        <a class=\"fancybox\" href=\"";
                // line 208
                echo twig_escape_filter($this->env, ((app_url_admin() . "/hoteles/habitaciones/zoom-") . $this->getAttribute($context["al"], "imagen", array())), "html", null, true);
                echo "\">
                            <img src=\"web/img/hab-thumb.jpg\" data-src=\"";
                // line 209
                echo twig_escape_filter($this->env, ((app_url_admin() . "/hoteles/habitaciones/hab-thumb-") . $this->getAttribute($context["al"], "imagen", array())), "html", null, true);
                echo "\" class=\"img-responsive lazyload\"/>
                        </a>
                        ";
                // line 211
                if ($this->getAttribute($context["al"], "precio_oferta", array())) {
                    // line 212
                    echo "                        <div class=\"sticker sticker-sale-";
                    echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
                    echo "\"></div>
                        ";
                }
                // line 214
                echo "                    </div>
                    <div class=\"col-md-6 text-left\">
                        <div style=\"border-top: #D19F00 solid 10px; width: 70px;\"></div>
                        ";
                // line 217
                $context["nombre_alojamiento"] = ((($this->getAttribute($context["al"], "nombre_trad_", array(), "any", true, true) &&  !(null === $this->getAttribute($context["al"], "nombre_trad_", array())))) ? ($this->getAttribute($context["al"], "nombre_trad_", array())) : ($this->getAttribute($this->getAttribute($context["al"], "tipo", array()), "nombre_habitacion", array())));
                // line 218
                echo "                        ";
                $context["descripcio_alojamiento"] = app_traduccion("hotel", "hotel_habitacion_hotel_idioma", "nombre", "habitacion_hotel_fk", $this->getAttribute($context["al"], "id_ocupacion", array()), $this->getAttribute($context["al"], "presentacion", array()));
                // line 219
                echo "                        <h3 class=\"padding-top-20\">";
                echo twig_escape_filter($this->env, (isset($context["nombre_alojamiento"]) ? $context["nombre_alojamiento"] : null), "html", null, true);
                echo "</h3>

                        <div class=\"row\">
                            <div class=\"col-md-12\">
                                ";
                // line 223
                echo (isset($context["descripcio_alojamiento"]) ? $context["descripcio_alojamiento"] : null);
                echo "
                            </div>
                        </div>
                        <div class=\"row columns-2-text-simple padding-top-20 padding-bottom-20\" style=\"\">
                            <div class=\"col-md-12\">
                                <ul>
                                    <li> ";
                // line 229
                echo twig_escape_filter($this->env, trans("al_cant_personas"), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "cantidad_pax", array()), "html", null, true);
                echo "</li>
                                    <li>";
                // line 230
                echo twig_escape_filter($this->env, trans("al_cant_camas"), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "cantidad_camas", array()), "html", null, true);
                echo "</li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"row padding-left-15\">
                            <div class=\"";
                // line 235
                echo (($this->getAttribute($context["al"], "precio_oferta", array())) ? ("col-md-5") : ("col-md-3"));
                echo " col-xs-6 text-border-bottom\">
                                <span class=\"text-black text-price-hab\">
                                    ";
                // line 237
                echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "precio", array()), "html", null, true);
                echo "
                                    ";
                // line 238
                if ($this->getAttribute($context["al"], "precio_oferta", array())) {
                    // line 239
                    echo "                                        <s style=\"color: #CCCCCC; font-size: 20px;\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "precio_original", array()), "html", null, true);
                    echo "</s>
                                    ";
                }
                // line 241
                echo "
                                </span>
                            </div>
                            <div class=\"";
                // line 244
                echo (($this->getAttribute($context["al"], "precio_oferta", array())) ? ("col-md-1") : ("col-md-3"));
                echo " margin-top-20 line-hab-booking hidden-xs hidden-sm\"></div>
                            <div class=\"col-md-3 col-xs-6 text-center\">
                                <a class=\"btn circle btn-default-booking-hab\"
                                   href=\"";
                // line 247
                echo twig_escape_filter($this->env, trans("ruta_reservar_alojamiento_habitacion", array("nombre" => url_title((isset($context["nombre_alojamiento"]) ? $context["nombre_alojamiento"] : null)), "id" => $this->getAttribute($context["al"], "tipo_habitacion_fk", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, trans("reservar"), "html", null, true);
                echo "</a>
                            </div>
                            <div class=\"col-md-3 margin-top-20 line-hab-booking hidden-xs\"></div>
                        </div>
                    </div>
                </div>

                ";
                // line 255
                echo "                <div itemscope itemtype=\"schema.org/Product\" style=\"display: none\">
                    <span itemprop=\"name\">";
                // line 256
                echo twig_escape_filter($this->env, (isset($context["nombre_alojamiento"]) ? $context["nombre_alojamiento"] : null), "html", null, true);
                echo "</span>
                    <span itemprop=\"image\">";
                // line 257
                echo twig_escape_filter($this->env, ((app_url_admin() . "/hoteles/habitaciones/zoom-") . $this->getAttribute($context["al"], "imagen", array())), "html", null, true);
                echo "</span>
                    <span itemprop=\"priceRange\">";
                // line 258
                echo twig_escape_filter($this->env, $this->getAttribute($context["al"], "precio", array()), "html", null, true);
                echo "</span>
                </div>
            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['al'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 261
        echo "        </div>
    </div>
    <!-- About block END -->


    <!-- Message block BEGIN -->
    <div class=\"message-block content content-center valign-center margin-top-20 padding-top-60\" id=\"message-block\">
        <h2>";
        // line 268
        echo twig_escape_filter($this->env, trans("of_parisiem"), "html", null, true);
        echo "</h2>

        <div class=\"container margin-top-160\">
            <div class=\"row\">
                ";
        // line 272
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_parisiem"]) ? $context["lista_parisiem"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
            // line 273
            echo "                    ";
            $context["o_t_descripcion"] = ((($this->getAttribute($context["o"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "descripcion_trad", array())))) ? ($this->getAttribute($context["o"], "descripcion_trad", array())) : ($this->getAttribute($context["o"], "descripcion", array())));
            // line 274
            echo "                    ";
            $context["o_t_nombre"] = ((($this->getAttribute($context["o"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "nombre_trad", array())))) ? ($this->getAttribute($context["o"], "nombre_trad", array())) : ($this->getAttribute($context["o"], "nombre", array())));
            // line 275
            echo "
                    <div class=\"col-md-4 col-xs-12 col-sm-12 message-block-box padding-top-10 text-left\">
                        <h4 style=\"min-height: 44px\">
                            <a class=\"fancybox fancybox.ajax\" href=\"";
            // line 278
            echo twig_escape_filter($this->env, trans("ruta_oferta", array("nombre" => url_title((isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null)), "id" => $this->getAttribute($context["o"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</a>
                        </h4>
                        <div class=\"row\" style=\"min-height: 66px\">
                            <div class=\"col-md-12 col-xs-12 col-sm-12\">
                                ";
            // line 283
            echo "                                <p>";
            echo word_limiter(app_strip_etiquetas((isset($context["o_t_descripcion"]) ? $context["o_t_descripcion"] : null)), 15);
            echo "</p>
                            </div>
                        </div>
                        <div class=\"row padding-left-15 padding-right-0 padding-bottom-xs\">
                            <div class=\"col-md-4 col-xs-6 text-border-bottom padding-top-10\">
                                <span class=\"text-black text-price-box\">";
            // line 288
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                            </div>
                            <div class=\"col-md-4 col-xs-6  text-center\">
                                <a class=\"btn circle btn-default-booking-box\" href=\"";
            // line 291
            echo twig_escape_filter($this->env, base_url(trans("ruta_reservar_oferta", array("id_oferta" => $this->getAttribute($context["o"], "id", array())))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("of_reservar"), "html", null, true);
            echo "</a>
                            </div>
                            <div class=\"col-md-4 margin-top-20 line-hab-booking hidden-xs\"></div>
                        </div>
                    </div>

                    ";
            // line 298
            echo "                    <div itemscope itemtype=\"schema.org/Product\" style=\"display: none\">
                        <span itemprop=\"name\">";
            // line 299
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</span>
                        <span itemprop=\"image\">";
            // line 300
            echo twig_escape_filter($this->env, ((app_url_admin() . "/oferta/oferta-") . $this->getAttribute($context["o"], "imagen", array())), "html", null, true);
            echo "</span>
                        <span itemprop=\"priceRange\">";
            // line 301
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 304
        echo "            </div>
        </div>

    </div>
    <!-- Message block END -->

    <!-- Team block BEGIN -->
    <div class=\"team-block content content-center margin-bottom-40\" id=\"team\">
        <div class=\"container\">
            <h2>";
        // line 313
        echo twig_escape_filter($this->env, trans("buena_vista"), "html", null, true);
        echo "</h2>

            <div class=\"row margin-bottom-10 margin-top-20\">
                <div class=\"col-md-12\">
                    <img data-src=\"web/img/concierto.jpg\" alt=\"\" class=\"img-responsive lazyload\"/>
                </div>
            </div>
            <div class=\"row\">
                ";
        // line 321
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_buena_vista"]) ? $context["lista_buena_vista"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
            // line 322
            echo "                    ";
            $context["o_t_descripcion"] = ((($this->getAttribute($context["o"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "descripcion_trad", array())))) ? ($this->getAttribute($context["o"], "descripcion_trad", array())) : ($this->getAttribute($context["o"], "descripcion", array())));
            // line 323
            echo "                    ";
            $context["o_t_nombre"] = ((($this->getAttribute($context["o"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "nombre_trad", array())))) ? ($this->getAttribute($context["o"], "nombre_trad", array())) : ($this->getAttribute($context["o"], "nombre", array())));
            // line 324
            echo "                    <div class=\"col-md-6 col-xs-12 padding-top-20 text-left bv-box\" style=\"\">
                        <h4>
                            <a class=\"fancybox fancybox.ajax\" href=\"";
            // line 326
            echo twig_escape_filter($this->env, trans("ruta_oferta", array("nombre" => url_title((isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null)), "id" => $this->getAttribute($context["o"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</a>
                        </h4>
                        <div class=\"row\" style=\"min-height: 95px\">
                            <div class=\"col-md-12\">
                                ";
            // line 331
            echo "                                <p>";
            echo word_limiter(app_strip_etiquetas((isset($context["o_t_descripcion"]) ? $context["o_t_descripcion"] : null)), 15);
            echo "</p>
                            </div>
                        </div>
                        <div class=\"row padding-left-15 padding-right-0\">
                            <div class=\"col-md-3 col-xs-6 text-border-bottom padding-top-10\">
                                <span class=\"text-black text-price-box\">";
            // line 336
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                            </div>
                            <div class=\"col-md-4 col-xs-6 text-center\">
                                <a class=\"btn circle btn-default-booking-box\" href=\"";
            // line 339
            echo twig_escape_filter($this->env, base_url(trans("ruta_reservar_oferta", array("id_oferta" => $this->getAttribute($context["o"], "id", array())))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("of_reservar"), "html", null, true);
            echo "</a>
                            </div>
                            <div class=\"col-md-5 margin-top-20 line-hab-booking hidden-xs\"></div>
                        </div>
                    </div>

                    ";
            // line 346
            echo "                    <div itemscope itemtype=\"schema.org/Product\" style=\"display: none\">
                        <span itemprop=\"name\">";
            // line 347
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</span>
                        <span itemprop=\"image\">";
            // line 348
            echo twig_escape_filter($this->env, ((app_url_admin() . "/oferta/oferta-") . $this->getAttribute($context["o"], "imagen", array())), "html", null, true);
            echo "</span>
                        <span itemprop=\"priceRange\">";
            // line 349
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 352
        echo "            </div>


        </div>
    </div>
    <!-- Team block END -->

    <!-- Facts block BEGIN -->
    <div class=\"facts-block content content-center padding-bottom-40\" id=\"benefits\">
        <h2>";
        // line 361
        echo twig_escape_filter($this->env, trans("of_ofertas_especiales"), "html", null, true);
        echo "</h2>

        <div class=\"container\">
            <div class=\"row\">
                ";
        // line 365
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_ofertas_especiales"]) ? $context["lista_ofertas_especiales"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
            // line 366
            echo "                    ";
            $context["o_t_descripcion"] = ((($this->getAttribute($context["o"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "descripcion_trad", array())))) ? ($this->getAttribute($context["o"], "descripcion_trad", array())) : ($this->getAttribute($context["o"], "descripcion", array())));
            // line 367
            echo "                    ";
            $context["o_t_nombre"] = ((($this->getAttribute($context["o"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "nombre_trad", array())))) ? ($this->getAttribute($context["o"], "nombre_trad", array())) : ($this->getAttribute($context["o"], "nombre", array())));
            // line 368
            echo "                    <div class=\"col-md-4 col-sm-4 col-xs-12 padding-bottom-20\">
                        <h4>
                            <a class=\"fancybox fancybox.ajax\" href=\"";
            // line 370
            echo twig_escape_filter($this->env, trans("ruta_oferta", array("nombre" => url_title((isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null)), "id" => $this->getAttribute($context["o"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</a>
                        </h4>
                        ";
            // line 373
            echo "                        <p>
                            ";
            // line 374
            echo word_limiter(app_strip_etiquetas((isset($context["o_t_descripcion"]) ? $context["o_t_descripcion"] : null)), 15);
            echo "
                        </p>
                        <span class=\"text-white text-price-box\">";
            // line 376
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                        <a class=\"btn circle btn-default-booking-box\" href=\"";
            // line 377
            echo twig_escape_filter($this->env, base_url(trans("ruta_reservar_oferta", array("id_oferta" => $this->getAttribute($context["o"], "id", array())))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("of_reservar"), "html", null, true);
            echo "</a>
                    </div>

                    ";
            // line 381
            echo "                    <div itemscope itemtype=\"schema.org/Product\" style=\"display: none\">
                        <span itemprop=\"name\">";
            // line 382
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</span>
                        <span itemprop=\"image\">";
            // line 383
            echo twig_escape_filter($this->env, ((app_url_admin() . "/oferta/oferta-") . $this->getAttribute($context["o"], "imagen", array())), "html", null, true);
            echo "</span>
                        <span itemprop=\"priceRange\">";
            // line 384
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 387
        echo "            </div>
        </div>
    </div>
    <!-- Facts block END -->

    <!-- Portfolio block BEGIN -->
    <div class=\"portfolio-block content content-center margin-bottom-60\" id=\"portfolio\">
        <div class=\"container\">
            <h2 class=\"margin-bottom-10\">";
        // line 395
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "titulo_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "titulo_trad", array())))) ? ($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "titulo_trad", array())) : ($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "titulo", array()))), "html", null, true);
        echo "</h2>

            <div class=\"padding-bottom-40 text-content\">";
        // line 397
        echo ((($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "value_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "value_trad", array())))) ? ($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "value_trad", array())) : ($this->getAttribute((isset($context["texto_evento"]) ? $context["texto_evento"] : null), "value", array())));
        echo "</div>
            <div class=\"row margin-top-20\" style=\"border-top: 1px solid #cccccc\">
                <div class=\"col-md-3 text-left padding-top-20 hidden-xs\">
                    <h3>";
        // line 400
        echo twig_escape_filter($this->env, trans("ev_facilidades"), "html", null, true);
        echo "</h3>
                    ";
        // line 401
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["evento_tipos"]) ? $context["evento_tipos"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo_evento"]) {
            // line 402
            echo "                        ";
            $context["nombre_trans"] = app_traduccion("evento", "evento_tipos_idioma", null, "tipo_servicio_fk", $this->getAttribute($context["tipo_evento"], "id", array()), $context["tipo_evento"]);
            // line 403
            echo "                        ";
            if (($this->getAttribute($context["tipo_evento"], "archivo", array()) != "")) {
                // line 404
                echo "                            <a target=\"_blank\" class=\"btn btn-lg dark\" href=\"";
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "url_admin", array()) . "/eventos/") . $this->getAttribute($context["tipo_evento"], "archivo", array())), "html", null, true);
                echo "\" >
                                <i class=\"fa fa-file-pdf-o\"></i>
                            </a>
                            <a class=\"btn btn-lg dark fancybox fancybox.ajax\" href=\"";
                // line 407
                echo twig_escape_filter($this->env, base_url(trans("ruta_servicio_tipo", array("id" => $this->getAttribute($context["tipo_evento"], "id", array())))), "html", null, true);
                echo "\" >
                                ";
                // line 408
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nombre_trans"]) ? $context["nombre_trans"] : null), "nombre", array()), "html", null, true);
                echo "
                            </a>
                            <br/>
                        ";
            } else {
                // line 412
                echo "                            <a class=\"btn btn-lg dark fancybox fancybox.ajax\" href=\"";
                echo twig_escape_filter($this->env, base_url(trans("ruta_servicio_tipo", array("id" => $this->getAttribute($context["tipo_evento"], "id", array())))), "html", null, true);
                echo "\" >
                                ";
                // line 413
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nombre_trans"]) ? $context["nombre_trans"] : null), "nombre", array()), "html", null, true);
                echo "
                            </a> <br/>
                        ";
            }
            // line 416
            echo "
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo_evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 418
        echo "                </div>
                <div class=\"col-md-6 text-left padding-top-20\">
                    ";
        // line 420
        echo ((($this->getAttribute((isset($context["textoeventocontacto"]) ? $context["textoeventocontacto"] : null), "value_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["textoeventocontacto"]) ? $context["textoeventocontacto"] : null), "value_trad", array())))) ? ($this->getAttribute((isset($context["textoeventocontacto"]) ? $context["textoeventocontacto"] : null), "value_trad", array())) : ($this->getAttribute((isset($context["textoeventocontacto"]) ? $context["textoeventocontacto"] : null), "value", array())));
        echo "
                </div>
                <div class=\"col-md-3\"></div>
            </div>
            <div class=\"row margin-top-20 hidden-xs\">
                <div class=\"col-md-3 padding-left-0\">
                    <div class=\"row\">
                        ";
        // line 427
        $context["img_main"] = (app_url_admin() . "/eventos/evento-hotel.jpg");
        // line 428
        echo "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["evento_imagenes"]) ? $context["evento_imagenes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
            // line 429
            echo "                            ";
            if (($this->getAttribute($context["img"], "principal", array()) == "t")) {
                // line 430
                echo "                                ";
                $context["img_main"] = ((app_url_admin() . "/hoteles/78/images/zoom-") . $this->getAttribute($context["img"], "url", array()));
                // line 431
                echo "                            ";
            }
            // line 432
            echo "                            <div class=\"col-xs-4 padding-right-5 margin-bottom-5\">
                                <a class=\"change-img-evento\" data-source=\"";
            // line 433
            echo twig_escape_filter($this->env, ((app_url_admin() . "/hoteles/78/images/zoom-") . $this->getAttribute($context["img"], "url", array())), "html", null, true);
            echo "\">
                                    <img data-src=\"";
            // line 434
            echo twig_escape_filter($this->env, ((app_url_admin() . "/hoteles/78/images/ev-thumb-") . $this->getAttribute($context["img"], "url", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["img"], "descripcion", array()), "html", null, true);
            echo "\" class=\"lazyload\"/>
                                </a>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 438
        echo "                    </div>
                </div>
                <div class=\"col-md-9\" id=\"img_evento_container\">
                    ";
        // line 441
        if (((isset($context["img_main"]) ? $context["img_main"] : null) != "")) {
            // line 442
            echo "                        <img id=\"img_main_evento\" data-src=\"";
            echo twig_escape_filter($this->env, (isset($context["img_main"]) ? $context["img_main"] : null), "html", null, true);
            echo "\" class=\"img-responsive lazyload\"/>
                    ";
        }
        // line 444
        echo "                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio block END -->


";
        // line 455
        echo "
";
        // line 486
        echo "
";
        // line 495
        echo "

";
        // line 500
        echo "

    <!-- Restaurante BEGIN -->
    <div class=\"prices-block content content-center\" id=\"prices\">
        <div class=\"container\">
            <h2 class=\"margin-bottom-20\">
                ";
        // line 506
        echo ((($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "titulo_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "titulo_trad", array())))) ? ($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "titulo_trad", array())) : ($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "titulo", array())));
        echo "
            </h2>

            <div class=\"padding-bottom-40 text-content\">
                ";
        // line 510
        echo ((($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "value_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "value_trad", array())))) ? ($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "value_trad", array())) : ($this->getAttribute((isset($context["textopresentacion_restaurante"]) ? $context["textopresentacion_restaurante"] : null), "value", array())));
        echo "
            </div>
            <div class=\"row\">
                <div class=\"col-md-3 text-center\" >
                    <h3 class=\"uppercase margin-bottom-20\">";
        // line 514
        echo twig_escape_filter($this->env, trans("of_ofertas_especiales"), "html", null, true);
        echo "</h3>

                    <div class=\"row\">
                        ";
        // line 517
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_ofertas_restaurantes"]) ? $context["lista_ofertas_restaurantes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
            // line 518
            echo "                            ";
            $context["o_t_descripcion"] = ((($this->getAttribute($context["o"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "descripcion_trad", array())))) ? ($this->getAttribute($context["o"], "descripcion_trad", array())) : ($this->getAttribute($context["o"], "descripcion", array())));
            // line 519
            echo "                            ";
            $context["o_t_nombre"] = ((($this->getAttribute($context["o"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["o"], "nombre_trad", array())))) ? ($this->getAttribute($context["o"], "nombre_trad", array())) : ($this->getAttribute($context["o"], "nombre", array())));
            // line 520
            echo "
                            <div class=\"col-md-12 margin-bottom-60\">
                                <h4><a class=\"fancybox fancybox.ajax\" href=\"";
            // line 522
            echo twig_escape_filter($this->env, trans("ruta_oferta", array("nombre" => url_title((isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null)), "id" => $this->getAttribute($context["o"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</a></h4>
                                ";
            // line 524
            echo "                                <p>";
            echo word_limiter(app_strip_etiquetas((isset($context["o_t_descripcion"]) ? $context["o_t_descripcion"] : null)), 15);
            echo "</p>
                                <span class=\"text-price-hab\" style=\"border-bottom: #d19f00 solid 10px;\">";
            // line 525
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>

                                <a class=\"btn circle btn-default-booking-box\" href=\"";
            // line 527
            echo twig_escape_filter($this->env, base_url(trans("ruta_reservar_oferta", array("id_oferta" => $this->getAttribute($context["o"], "id", array())))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("of_reservar"), "html", null, true);
            echo "</a>

                            </div>

                            ";
            // line 532
            echo "                            <div itemscope itemtype=\"schema.org/Product\" style=\"display: none\">
                                <span itemprop=\"name\">";
            // line 533
            echo twig_escape_filter($this->env, (isset($context["o_t_nombre"]) ? $context["o_t_nombre"] : null), "html", null, true);
            echo "</span>
                                <span itemprop=\"image\">";
            // line 534
            echo twig_escape_filter($this->env, ((app_url_admin() . "/oferta/oferta-") . $this->getAttribute($context["o"], "imagen", array())), "html", null, true);
            echo "</span>
                                <span itemprop=\"priceRange\">";
            // line 535
            echo twig_escape_filter($this->env, app_rate_cambio($this->getAttribute($context["o"], "precio", array()), "smb"), "html", null, true);
            echo "</span>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 538
        echo "                    </div>
                </div>


                <div class=\"col-md-9 text-left padding-left-20 hidden-xs\" style=\"border-left: 1px solid #cccccc;\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            ";
        // line 545
        echo ((($this->getAttribute((isset($context["textocontacto_restaurante"]) ? $context["textocontacto_restaurante"] : null), "value_trad", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["textocontacto_restaurante"]) ? $context["textocontacto_restaurante"] : null), "value_trad", array())))) ? ($this->getAttribute((isset($context["textocontacto_restaurante"]) ? $context["textocontacto_restaurante"] : null), "value_trad", array())) : ($this->getAttribute((isset($context["textocontacto_restaurante"]) ? $context["textocontacto_restaurante"] : null), "value", array())));
        echo "
                        </div>
                    </div>

                    ";
        // line 549
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lista_restaurantes"]) ? $context["lista_restaurantes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 550
            echo "                        ";
            $context["nombre_restaurante"] = ((($this->getAttribute($context["r"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["r"], "nombre_trad", array())))) ? ($this->getAttribute($context["r"], "nombre_trad", array())) : ($this->getAttribute($context["r"], "nombre", array())));
            // line 551
            echo "                        ";
            $context["desc_restaurante"] = ((($this->getAttribute($context["r"], "descripcion_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["r"], "descripcion_trad", array())))) ? ($this->getAttribute($context["r"], "descripcion_trad", array())) : ($this->getAttribute($context["r"], "descripcion", array())));
            // line 552
            echo "                        ";
            $context["slug_restaurante"] = $this->getAttribute($context["r"], "slug", array());
            // line 553
            echo "                        ";
            $context["url_restaurante"] = app_parse(trans("ruta_restaurante"), array("slug" => (isset($context["slug_restaurante"]) ? $context["slug_restaurante"] : null)));
            // line 554
            echo "
                        <div class=\"row r-box margin-top-20 bg-white\">
                            <div class=\"col-md-5 padding-left-0 \">
                                <a class=\"fancybox\" href=\"";
            // line 557
            echo twig_escape_filter($this->env, ((app_url_admin() . "/restaurante/zoom-") . $this->getAttribute($context["r"], "imagen", array())), "html", null, true);
            echo "\">
                                    <img data-src=\"";
            // line 558
            echo twig_escape_filter($this->env, ((app_url_admin() . "/restaurante/rest-thumb-") . $this->getAttribute($context["r"], "imagen", array())), "html", null, true);
            echo "\" class=\"img-responsive lazyload\"/>
                                </a>

                            </div>
                            <div class=\"col-md-7 padding-top-20 padding-bottom-20\">
                                <h3>";
            // line 563
            echo twig_escape_filter($this->env, (isset($context["nombre_restaurante"]) ? $context["nombre_restaurante"] : null), "html", null, true);
            echo "</h3>

                                <p>";
            // line 565
            echo word_limiter(app_strip_etiquetas((isset($context["desc_restaurante"]) ? $context["desc_restaurante"] : null)), 30);
            echo "</p>
                                <a href=\"";
            // line 566
            echo twig_escape_filter($this->env, base_url(trans("ruta_restaurante-menus", array("slug" => $this->getAttribute($context["r"], "slug", array())))), "html", null, true);
            echo "\" class=\"btn circle btn-default-booking-hab uppercase fancybox fancybox.ajax\">
                                    ";
            // line 567
            echo twig_escape_filter($this->env, trans("rt_ver_menu"), "html", null, true);
            echo "
                                </a>
                            </div>

                            ";
            // line 572
            echo "                            <div itemscope itemtype=\"schema.org/Restaurant\" style=\"display: none\">
                                <span itemprop=\"name\">";
            // line 573
            echo twig_escape_filter($this->env, (isset($context["nombre_restaurante"]) ? $context["nombre_restaurante"] : null), "html", null, true);
            echo "</span>
                                <span itemprop=\"image\">";
            // line 574
            echo twig_escape_filter($this->env, ((app_url_admin() . "/restaurante/rest-thumb-") . $this->getAttribute($context["r"], "imagen", array())), "html", null, true);
            echo "</span>
                                <span itemprop=\"address\">";
            // line 575
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "direccion", array()), "value", array()), "html", null, true);
            echo "</span>
                                <span itemprop=\"servesCuisine\">";
            // line 576
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["r"], "tipo_comida_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["r"], "tipo_comida_trad", array())))) ? ($this->getAttribute($context["r"], "tipo_comida_trad", array())) : ($this->getAttribute($context["r"], "tipo_comida", array()))), "html", null, true);
            echo "</span>
                                <span itemprop=\"telephone\">";
            // line 577
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "telefono", array()), "value", array()), "html", null, true);
            echo "</span>
                                <span itemprop=\"priceRange\">";
            // line 578
            echo twig_escape_filter($this->env, (($this->getAttribute($context["r"], "precio", array()) . " - ") . $this->getAttribute($context["r"], "precio_mayor", array())), "html", null, true);
            echo "</span>
                            </div>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 582
        echo "                </div>
            </div>
        </div>
    </div>
    <!-- Prices block END -->
";
    }

    // line 589
    public function block_script($context, array $blocks = array())
    {
        // line 590
        echo "    <script src=\"web/assets/bootstrap-datepicker/js/bootstrap-datepicker-homepage.js\"></script>

    ";
        // line 592
        if ((twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())) != "en")) {
            // line 593
            echo "        <script src=\"web/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
            echo ".js\"></script>
    ";
        }
        // line 595
        echo "
    <script>

        \$(document).ready(function () {
            ";
        // line 599
        $context["paros_t"] = (($this->getAttribute((isset($context["room_info"]) ? $context["room_info"] : null), "paros", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["room_info"]) ? $context["room_info"] : null), "paros", array()), false)) : (false));
        // line 600
        echo "            var config = {closedDates: ";
        echo (((isset($context["paros_t"]) ? $context["paros_t"] : null)) ? ((isset($context["paros_t"]) ? $context["paros_t"] : null)) : ("[]"));
        echo "};
            
            config.dateOptions = {
                language: '";
        // line 603
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
        echo "',
                startDate: '";
        // line 604
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["room_info"]) ? $context["room_info"] : null), "min_active_day", array()), "html", null, true);
        echo "',
                endDate: '";
        // line 605
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["room_info"]) ? $context["room_info"] : null), "fechaMax", array()), "html", null, true);
        echo "'
            };

            Nacional.initHomePage(config);
            \$(\"img.lazyload\").lazyload();
        });
    </script>

";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1165 => 605,  1161 => 604,  1157 => 603,  1150 => 600,  1148 => 599,  1142 => 595,  1136 => 593,  1134 => 592,  1130 => 590,  1127 => 589,  1118 => 582,  1108 => 578,  1104 => 577,  1100 => 576,  1096 => 575,  1092 => 574,  1088 => 573,  1085 => 572,  1078 => 567,  1074 => 566,  1070 => 565,  1065 => 563,  1057 => 558,  1053 => 557,  1048 => 554,  1045 => 553,  1042 => 552,  1039 => 551,  1036 => 550,  1032 => 549,  1025 => 545,  1016 => 538,  1007 => 535,  1003 => 534,  999 => 533,  996 => 532,  987 => 527,  982 => 525,  977 => 524,  971 => 522,  967 => 520,  964 => 519,  961 => 518,  957 => 517,  951 => 514,  944 => 510,  937 => 506,  929 => 500,  925 => 495,  922 => 486,  919 => 455,  910 => 444,  904 => 442,  902 => 441,  897 => 438,  885 => 434,  881 => 433,  878 => 432,  875 => 431,  872 => 430,  869 => 429,  864 => 428,  862 => 427,  852 => 420,  848 => 418,  841 => 416,  835 => 413,  830 => 412,  823 => 408,  819 => 407,  812 => 404,  809 => 403,  806 => 402,  802 => 401,  798 => 400,  792 => 397,  787 => 395,  777 => 387,  768 => 384,  764 => 383,  760 => 382,  757 => 381,  749 => 377,  745 => 376,  740 => 374,  737 => 373,  730 => 370,  726 => 368,  723 => 367,  720 => 366,  716 => 365,  709 => 361,  698 => 352,  689 => 349,  685 => 348,  681 => 347,  678 => 346,  667 => 339,  661 => 336,  652 => 331,  643 => 326,  639 => 324,  636 => 323,  633 => 322,  629 => 321,  618 => 313,  607 => 304,  598 => 301,  594 => 300,  590 => 299,  587 => 298,  576 => 291,  570 => 288,  561 => 283,  552 => 278,  547 => 275,  544 => 274,  541 => 273,  537 => 272,  530 => 268,  521 => 261,  511 => 258,  507 => 257,  503 => 256,  500 => 255,  488 => 247,  482 => 244,  477 => 241,  471 => 239,  469 => 238,  465 => 237,  460 => 235,  450 => 230,  444 => 229,  435 => 223,  427 => 219,  424 => 218,  422 => 217,  417 => 214,  411 => 212,  409 => 211,  404 => 209,  400 => 208,  396 => 206,  391 => 205,  387 => 204,  381 => 201,  375 => 198,  370 => 195,  367 => 194,  358 => 187,  340 => 182,  334 => 180,  326 => 178,  324 => 177,  320 => 175,  314 => 173,  306 => 171,  304 => 170,  287 => 156,  283 => 154,  271 => 144,  259 => 134,  257 => 133,  243 => 122,  240 => 121,  223 => 120,  216 => 115,  213 => 114,  193 => 97,  180 => 87,  167 => 77,  156 => 69,  149 => 64,  140 => 61,  131 => 60,  127 => 59,  120 => 55,  115 => 53,  103 => 44,  99 => 43,  91 => 38,  81 => 30,  78 => 29,  71 => 24,  69 => 23,  66 => 22,  61 => 19,  58 => 18,  50 => 12,  47 => 11,  38 => 4,  35 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/home.twig");
    }
}
