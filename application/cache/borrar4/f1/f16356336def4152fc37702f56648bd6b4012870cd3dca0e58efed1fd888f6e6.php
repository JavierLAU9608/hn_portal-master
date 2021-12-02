<?php

/* base.twig */
class __TwigTemplate_22255d66a3f72070dbd18ae916282c74240f92207d6eab164feeeaf159111ed1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'barra_reserva' => array($this, 'block_barra_reserva'),
            'slide_show' => array($this, 'block_slide_show'),
            'content' => array($this, 'block_content'),
            'slider_js' => array($this, 'block_slider_js'),
            'js_homepage' => array($this, 'block_js_homepage'),
            'script' => array($this, 'block_script'),
            'pixel' => array($this, 'block_pixel'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if IE 8]> <html lang=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array()), "html", null, true);
        echo "\" class=\"ie8 no-js\"> <![endif]-->
<!--[if IE 9]> <html lang=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array()), "html", null, true);
        echo "\" class=\"ie9 no-js\"> <![endif]-->
<!--[if !IE]><!-->
<html lang=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())), "html", null, true);
        echo "\">
<!--<![endif]-->

<head>
    <meta charset=\"utf-8\">

    <title>";
        // line 11
        echo twig_escape_filter($this->env, trans("seo_title_home"), "html", null, true);
        echo "</title>
    <meta name=\"keywords\" content=\"";
        // line 12
        $this->displayBlock('keywords', $context, $blocks);
        echo "\" />
    <meta name=\"description\" content=\"";
        // line 13
        $this->displayBlock('description', $context, $blocks);
        echo "\"/>
    <meta name=\"robots\" content=\"index,follow\" />
    <meta name=\"google-site-verification\" content=\"1snByTYon0YxaAsI3JujmNmRWqQUxaijr3434sm-ygM\" />

    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">

    ";
        // line 21
        echo "    <meta property=\"og:title\" content=\"";
        echo twig_escape_filter($this->env, trans("seo_facebook_title"), "html", null, true);
        echo "\">
    <meta property=\"og:type\" content=\"";
        // line 22
        echo twig_escape_filter($this->env, trans("seo_facebook_type"), "html", null, true);
        echo "\">
    <meta property=\"og:url\" content=\"";
        // line 23
        echo twig_escape_filter($this->env, trans("seo_facebook_url"), "html", null, true);
        echo "\">
    <meta property=\"og:description\" content=\"";
        // line 24
        echo twig_escape_filter($this->env, trans("seo_facebook_description"), "html", null, true);
        echo "\">
    <meta property=\"og:image\" content=\"";
        // line 25
        echo twig_escape_filter($this->env, trans("seo_facebook_image"), "html", null, true);
        echo "\">

    ";
        // line 28
        echo "    <meta property=\"twitter:card\" content=\"";
        echo twig_escape_filter($this->env, trans("seo_twitter_card"), "html", null, true);
        echo "\">
    <meta property=\"twitter:creator\" content=\"";
        // line 29
        echo twig_escape_filter($this->env, trans("seo_twitter_creator"), "html", null, true);
        echo "\">
    <meta property=\"twitter:title\" content=\"";
        // line 30
        echo twig_escape_filter($this->env, trans("seo_twitter_title"), "html", null, true);
        echo "\">
    <meta property=\"twitter:description\" content=\"";
        // line 31
        echo twig_escape_filter($this->env, trans("seo_twitter_description"), "html", null, true);
        echo "\">
    <meta property=\"twitter:image:src\" content=\"";
        // line 32
        echo twig_escape_filter($this->env, trans("seo_twitter_image"), "html", null, true);
        echo "\">

    <base href=\"";
        // line 34
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\"/>

    <link rel=\"shortcut icon\" href=\"favicon.png\">

    <link href=\"web/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"web/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"web/css/revol-slider.css\" rel=\"stylesheet\">
    <link href=\"web/css/jquery.fancybox.css\" rel=\"stylesheet\">

    <link href=\"web/css/components.css\" rel=\"stylesheet\">
    <link href=\"web/css/style.css\" rel=\"stylesheet\">
    <link href=\"web/css/red.css\" rel=\"stylesheet\" id=\"style-color\">
    <link href=\"web/css/custom.css\" rel=\"stylesheet\">
    <link href=\"web/css/style-responsive.css\" rel=\"stylesheet\">
\t
\t";
        // line 49
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 50
            echo "    <!-- Global site tag (gtag.js) - Google Analytics -->
\t<script async src=\"https://www.googletagmanager.com/gtag/js?id=AW-861553772\"></script>
\t<script>
\t  window.dataLayer = window.dataLayer || [];
\t  function gtag(){dataLayer.push(arguments);}
\t  gtag('js', new Date());

      gtag('config', 'AW-861553772');
      gtag('config', 'UA-90944409-1');
\t</script>
\t";
        }
        // line 61
        echo "
    ";
        // line 62
        $this->displayBlock('stylesheet', $context, $blocks);
        // line 63
        echo "</head>

<body class=\"menu-always-on-top-header\">
    <div class=\"headerTop header-mobi-ext\">
        <div class=\"container\">
            <div class=\"row\">
                <!-- Logo BEGIN -->
                <div class=\"col-md-2 col-sm-2\">
                    <a class=\"site-logo\" href=\"";
        // line 71
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\"><img src=\"web/img/logo/logo.png\" alt=\"Hotel Nacional de Cuba\" class=\"hidden-xs hidden-sm\" ></a>
                </div>
                <!-- Logo END -->
                <a href=\"javascript:void(0);\" class=\"mobi-togglerTop\"><i class=\"fa fa-bars\"></i></a>
                <!-- Navigation BEGIN -->
                <div class=\"col-md-10 col-xs-12 pull-right padding-top-20\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">

                            <div class=\"btn-group\" style=\"float: right; position: relative\">
                                <button data-toggle=\"dropdown\" type=\"button\" class=\"btn btn-language btn-lg dropdown-toggle\" aria-expanded=\"false\">
                                    <i class=\"fa fa-globe\"></i> <span class=\"hidden-xs\">";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "nombre", array()), "html", null, true);
        echo "</span>
                                </button>
                                <ul role=\"menu\" class=\"dropdown-menu pull-right\">
                                    ";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "all_langs", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 86
            echo "                                        <li>
                                            <a href=\"javascript:Nacional.cambiar_idioma(";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute($context["i"], "id", array()), "html", null, true);
            echo ");\">
                                                ";
            // line 88
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["i"], "nombre_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["i"], "nombre_trad", array())))) ? ($this->getAttribute($context["i"], "nombre_trad", array())) : ($this->getAttribute($context["i"], "nombre", array()))), "html", null, true);
            echo "
                                            </a>
                                        </li>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "                                </ul>
                            </div>

                            <div class=\"hidden-xs\" style=\"position: relative;float: right; height: 34px; width: 1px; background-color: #ccc;\"></div>

                            <div class=\"btn-group\" style=\"float: right; position: relative\">
                                <button data-toggle=\"dropdown\" type=\"button\" class=\"btn btn-language btn-lg dropdown-toggle\" aria-expanded=\"false\">
                                    <i class=\"fa fa-money\"></i> <span class=\"hidden-xs\">";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_currency", array()), "nombre", array()), "html", null, true);
        echo "</span>
                                </button>
                                <ul role=\"menu\" class=\"dropdown-menu pull-right\">
                                    ";
        // line 102
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "all_currency", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 103
            echo "                                        <li>
                                            <a href=\"javascript:Nacional.cambiar_moneda(";
            // line 104
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "id", array()), "html", null, true);
            echo ");\">
                                                ";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute($context["m"], "nombre", array()), "html", null, true);
            echo "
                                            </a>
                                        </li>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "                                </ul>
                            </div>

                            <div class=\"hidden-xs\" style=\"position: relative;float: right; height: 34px; width: 1px; background-color: #ccc;\"></div>

                            <div class=\"btn-group\" style=\"float: right; position: relative\">
                                <button class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#contactform\">
                                    <i class=\"fa fa-phone hidden-md hidden-desktop\"></i>
                                    <span class=\"hidden-xs\">";
        // line 117
        echo twig_escape_filter($this->env, trans("contacto_us_home"), "html", null, true);
        echo "</span>
                                </button>

                                ";
        // line 120
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()) == null)) {
            // line 121
            echo "                                <button class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#loginform\">
                                    <i class=\"fa fa-user hidden-md hidden-desktop\"></i>
                                    <span class=\"hidden-xs\">";
            // line 123
            echo twig_escape_filter($this->env, trans("autenticar"), "html", null, true);
            echo "</span>
                                </button>
                                <button class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#registerform\">
                                    <i class=\"fa fa-user-plus hidden-md hidden-desktop\"></i>
                                    <span class=\"hidden-xs\">";
            // line 127
            echo twig_escape_filter($this->env, trans("registrarse"), "html", null, true);
            echo "</span>
                                </button>

                                ";
        } else {
            // line 131
            echo "                                <button data-toggle=\"dropdown\" type=\"button\" class=\"btn btn-language btn-lg dropdown-toggle\" aria-expanded=\"false\">
                                    <i class=\"glyphicon glyphicon-user\"></i> ";
            // line 132
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "nombre", array()), "html", null, true);
            echo "
                                </button>
                                    <ul role=\"menu\" class=\"dropdown-menu pull-right\">
                                    <li><a href=\"";
            // line 135
            echo twig_escape_filter($this->env, base_url(trans("ruta_mi_cuenta")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("user_perfil"), "html", null, true);
            echo "</a></li>
                                    <li><a href=\"";
            // line 136
            echo twig_escape_filter($this->env, base_url("salir"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, trans("cerrar_session"), "html", null, true);
            echo "</a></li>
                                </ul>
                                ";
        }
        // line 139
        echo "                            </div>

                            <div class=\"cart-content\">
                                <a class=\"btn btn-default circle\" href=\"";
        // line 142
        echo twig_escape_filter($this->env, base_url("carro-compra"), "html", null, true);
        echo "\">
                                    <span class=\"glyphicon glyphicon-shopping-cart\"></span>
                                    <span>";
        // line 144
        echo twig_escape_filter($this->env, trans("carro_compra"), "html", null, true);
        echo "</span>
                                    ";
        // line 145
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "total_carro_compra", array()) > 0)) {
            // line 146
            echo "                                        <span class=\"badge badge-success\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "total_carro_compra", array()), "html", null, true);
            echo "</span>
                                    ";
        }
        // line 148
        echo "                                </a>
                            </div>

                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-9\">
                            <ul class=\"header-navigation\">
                                ";
        // line 157
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "main_menu", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 158
            echo "                                    <li>
                                        <a href=\"";
            // line 159
            echo twig_escape_filter($this->env, (base_url() . twig_trim_filter($this->getAttribute($context["m"], "url", array()))), "html", null, true);
            echo "\">
                                            ";
            // line 160
            echo twig_escape_filter($this->env, ((($this->getAttribute($context["m"], "titulo_trad", array(), "any", true, true) &&  !(null === $this->getAttribute($context["m"], "titulo_trad", array())))) ? ($this->getAttribute($context["m"], "titulo_trad", array())) : ($this->getAttribute($context["m"], "titulo", array()))), "html", null, true);
            echo "
                                        </a>
                                    </li>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        echo "                            </ul>
                        </div>
                        <div class=\"col-md-3 col-xs-12 content-center\">
                            <ul class=\"header-social content-center\">
                                ";
        // line 168
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "social_nets", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 169
            echo "                                    <li>
                                        <a style=\"background: url('";
            // line 170
            echo twig_escape_filter($this->env, ((app_url_admin() . "/admin/redes/") . $this->getAttribute($context["r"], "icono_top", array())), "html", null, true);
            echo "')\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["r"], "url", array()), "html", null, true);
            echo "\" class=\"social-icon social-icon-color circle\" target=\"_blank\"></a>
                                    </li>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 173
        echo "                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Navigation END -->
            </div>

            <div class=\"row\" style=\"padding: 0 0 0 0;\">
                <div class=\"col-xs-12\">
                    <span class=\"pull-right sitio-oficial\">";
        // line 183
        echo twig_escape_filter($this->env, trans("official_site"), "html", null, true);
        echo "</span>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 189
        $this->displayBlock('barra_reserva', $context, $blocks);
        // line 191
        echo "
    ";
        // line 192
        $this->displayBlock('slide_show', $context, $blocks);
        // line 194
        echo "

    ";
        // line 196
        $this->displayBlock('content', $context, $blocks);
        // line 198
        echo "

    <!-- Testimonials block BEGIN -->
    <div class=\"testimonials-block content content-center margin-bottom-60\" id=\"contact\">
        <div class=\"container\">
            <h2>";
        // line 203
        echo twig_escape_filter($this->env, trans("localizacioncontacto"), "html", null, true);
        echo "</h2>
        </div>
    </div>
    <div class=\"testimonials-block-map padding-top-30\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-3 bg-white padding-bottom-40\">
                    <div itemscope itemtype=\"schema.org/LocalBusiness\">
                        <h3 itemprop=\"name\">";
        // line 211
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "site_name", array()), "html", null, true);
        echo "</h3>
                        ";
        // line 212
        echo twig_escape_filter($this->env, trans("categoria"), "html", null, true);
        echo ": <span itemprop=\"additionalType\" style=\"display: none\">5 star</span><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><br>
                        ";
        // line 213
        echo twig_escape_filter($this->env, trans("telefono"), "html", null, true);
        echo ": <span itemprop=\"telephone\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "telefono", array()), "value", array()), "html", null, true);
        echo "</span><br>
                        ";
        // line 214
        echo twig_escape_filter($this->env, trans("fax"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "faxhotel", array()), "value", array()), "html", null, true);
        echo "<br>
                        <span itemprop=\"image\" style=\"display: none;\">http://localhost/H-Nacional/portal/web/img/logo/logo.png</span>

                        <div itemprop=\"address\">
                            <h5 class=\"text-uppercase\">";
        // line 218
        echo twig_escape_filter($this->env, trans("direccion"), "html", null, true);
        echo ":</h5>
                            ";
        // line 219
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "direccion", array()), "value", array()), "html", null, true);
        echo "
                        </div>

                        <span itemprop=\"priceRange\" style=\"display: none;\">128 \$ - 2000 \$</span>
                    </div>


                    <h6>Check - in:   16:00</h6>

                    <h6>Check - out: 12:00</h6>
                    <br>
                    ";
        // line 230
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 231
            echo "                    <div id=\"TA_certificateOfExcellence582\" class=\"TA_certificateOfExcellence\">
                        <ul id=\"rFUoBCeM2Hn\" class=\"TA_links gblDdwxHD\">
                            <li id=\"4Xtj983tzpC\" class=\"cNGG9sn\">
                                <a target=\"_blank\"
                                                                    href=\"https://www.tripadvisor.com/Hotel_Review-g147271-d148066-Reviews-Hotel_Nacional_de_Cuba-Havana_Ciudad_de_la_Habana_Province_Cuba.html\"><img
                                            src=\"https://www.tripadvisor.com/img/cdsi/img2/awards/CoE2017_WidgetAsset-14348-2.png\"
                                            alt=\"TripAdvisor\" class=\"widCOEImg\" id=\"CDSWIDCOELOGO\"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <script async src=\"https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=582&amp;locationId=148066&amp;lang=en_US&amp;year=2018&amp;display_version=2\"></script>
                    ";
        }
        // line 244
        echo "                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials block END -->

    <!-- BEGIN PRE-FOOTER -->
    <div class=\"pre-footer\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-3\">
                    ";
        // line 255
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 256
            echo "
                    ";
            // line 257
            if ((twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())) == "EN")) {
                // line 258
                echo "                    <div id=\"TA_cdsscrollingravenarrow511\" class=\"TA_cdsscrollingravenarrow\">
                        <ul id=\"d2wMiW8dzFf\" class=\"TA_links rZlLmE\">
                            <li id=\"dVrP7Bp\" class=\"YbqAlbTxV\">
                                <a target=\"_blank\" href=\"https://www.tripadvisor.com/\"><img src=\"https://static.tacdn.com/img2/t4b/Stacked_TA_logo.png\" alt=\"TripAdvisor\" class=\"widEXCIMG\" id=\"CDSWIDEXCLOGO\" /></a>
                            </li>
                        </ul>
                    </div>
                    <script src=\"https://www.jscache.com/wejs?wtype=cdsscrollingravenarrow&amp;uniq=511&amp;locationId=148066&amp;lang=en_US&amp;border=true&amp;display_version=2\"></script>
                    ";
            }
            // line 267
            echo "
                    ";
            // line 268
            if ((twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "current_lang", array()), "codigo", array())) == "ES")) {
                // line 269
                echo "                    <div id=\"TA_cdsscrollingravenarrow397\" class=\"TA_cdsscrollingravenarrow\">
                        <ul id=\"wJKWi3\" class=\"TA_links WKK8cHSmExMq\">
                            <li id=\"SaPrNkTmMSUB\" class=\"XsPMVT\">
                                <a target=\"_blank\" href=\"https://www.tripadvisor.es/\">
                                    <img src=\"https://static.tacdn.com/img2/t4b/Stacked_TA_logo.png\" alt=\"TripAdvisor\" class=\"widEXCIMG\" id=\"CDSWIDEXCLOGO\" /></a>
                            </li>
                        </ul>
                    </div>
                    <script src=\"https://www.jscache.com/wejs?wtype=cdsscrollingravenarrow&amp;uniq=397&amp;locationId=148066&amp;lang=es&amp;border=true&amp;display_version=2\"></script>
                    ";
            }
            // line 279
            echo "
                    ";
        }
        // line 281
        echo "                </div>
                <div class=\"col-md-3 text-center padding-top-10\">
                    ";
        // line 283
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "social_nets", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 284
            echo "                        <a style=\"background: url('";
            echo twig_escape_filter($this->env, (app_url_admin() . ("/admin/redes/" . $this->getAttribute($context["r"], "icono_footer", array()))), "html", null, true);
            echo "') no-repeat;\"
                           class=\"social-icon social-icon-color circle\" target=\"_blank\" title=\"";
            // line 285
            echo twig_escape_filter($this->env, $this->getAttribute($context["r"], "descripcion", array()), "html", null, true);
            echo "\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["r"], "url", array()), "html", null, true);
            echo "\">
                        </a>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 288
        echo "                </div>
                <div class=\"col-md-3\">
                    ";
        // line 290
        $context["tarjetas"] = app_tarjetas_creditos();
        // line 291
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tarjetas"]) ? $context["tarjetas"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 292
            echo "                        <img src=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "url_admin", array()) . "/admin/tarjetas/") . $this->getAttribute($context["t"], "url_icon", array())), "html", null, true);
            echo "\"/>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 294
        echo "                </div>
                <div class=\"col-md-3\">
                    <img src=\"";
        // line 296
        echo twig_escape_filter($this->env, base_url("web/img/secured.png"), "html", null, true);
        echo "\" />
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            ";
        // line 299
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 300
            echo "                                <script type=\"text/javascript\">
                                //<![CDATA[
                                  var tlJsHost = ((window.location.protocol == \"https:\") ? \"https://secure.trust-provider.com/\" : \"http://www.trustlogo.com/\");
                                  document.write(unescape(\"%3Cscript src='\" + tlJsHost + \"trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E\"));
                                //]]>
                               </script>
                                                                <script language=\"JavaScript\" type=\"text/javascript\">
                                  TrustLogo(\"https://www.positivessl.com/images/seals/positivessl_trust_seal_lg_222x54.png\", \"POSDV\", \"none\");
                                </script>

                            ";
        }
        // line 311
        echo "                        </div>
                        <div class=\"col-md-6 padding-top-10\">
                            ";
        // line 313
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 314
            echo "                            <!-- GeoTrust QuickSSL [tm] Smart  Icon tag. Do not edit. -->
                            <script language=\"javascript\" type=\"text/javascript\" src=\"//smarticon.geotrust.com/si.js\"></script>
                            <!-- end  GeoTrust Smart Icon tag -->
                            ";
        }
        // line 318
        echo "                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <!-- END PRE-FOOTER -->
    <!-- BEGIN FOOTER -->
    <div class=\"footer\">
        <div class=\"container\">
            <div class=\"row\">
                <!-- BEGIN COPYRIGHT -->
                <div class=\"col-md-8 col-sm-8 pull-right\">
                    ";
        // line 333
        $context["menu_footer"] = app_menu_footer();
        // line 334
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["menu_footer"]) ? $context["menu_footer"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 335
            echo "                        ";
            $context["titulo"] = ((($this->getAttribute($context["m"], "titulo_trad", array()) != null)) ? ($this->getAttribute($context["m"], "titulo_trad", array())) : ($this->getAttribute($context["m"], "titulo", array())));
            // line 336
            echo "                        ";
            $context["url"] = $this->getAttribute($context["m"], "url", array());
            // line 337
            echo "                        ";
            if (((isset($context["url"]) ? $context["url"] : null) == null)) {
                // line 338
                echo "                            ";
                $context["url"] = app_parse(trans("ruta_informacion"), array("titulo" => url_title((isset($context["titulo"]) ? $context["titulo"] : null))));
                // line 339
                echo "                        ";
            }
            // line 340
            echo "                    |
                    <a href=\"";
            // line 341
            echo twig_escape_filter($this->env, base_url((isset($context["url"]) ? $context["url"] : null)), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["titulo"]) ? $context["titulo"] : null), "html", null, true);
            echo "</a>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 343
        echo "
                    | <a target=\"_blank\" href=\"https://hotelnacionaldecubablog.wordpress.com/blog/\">Blog</a>
                </div>
                <!-- END COPYRIGHT -->
                <!-- BEGIN SOCIAL ICONS -->
                <div class=\"col-md-4 col-sm-4\">
                    <div class=\"copyright\">";
        // line 349
        echo twig_escape_filter($this->env, trans("derechos"), "html", null, true);
        echo "</div>
                </div>
                <!-- END SOCIAL ICONS -->
            </div>
        </div>
    </div>
    <!-- END FOOTER -->
    <a href=\"#promo-block\" class=\"go2top scroll\"><i class=\"fa fa-arrow-up\"></i></a>

    ";
        // line 358
        $this->loadTemplate("administracion/login.twig", "base.twig", 358)->display($context);
        // line 359
        echo "    ";
        $this->loadTemplate("administracion/registro.twig", "base.twig", 359)->display($context);
        // line 360
        echo "    ";
        $this->loadTemplate("administracion/contacto.twig", "base.twig", 360)->display($context);
        // line 361
        echo "
    ";
        // line 362
        $this->loadTemplate("mensaje.twig", "base.twig", 362)->display($context);
        // line 363
        echo "

    <!--[if lt IE 9]>
    <script src=\"web/js/respond.min.js\"></script>
    <![endif]-->

    <script src=\"web/js/jquery.min.js\" type=\"text/javascript\"></script>
    <script src=\"web/js/jquery-migrate.min.js\" type=\"text/javascript\"></script>
    <script src=\"web/js/bootstrap.min.js\" type=\"text/javascript\"></script>

    ";
        // line 373
        $this->displayBlock('slider_js', $context, $blocks);
        // line 375
        echo "

    <script src=\"web/js/jquery.fancybox.pack.js\" type=\"text/javascript\"></script><!-- pop up -->
    <script src=\"web/js/jquery.scrollTo.min.js\"></script>
    <script src=\"web/js/jquery.blockui.min.js\"></script>

    ";
        // line 381
        $this->displayBlock('js_homepage', $context, $blocks);
        // line 383
        echo "
    <script src=\"web/js/layout.js\" type=\"text/javascript\"></script>
    <script src=\"web/js/nacional.js\" type=\"text/javascript\"></script>
    <script>
        \$(document).ready(function() {
            Layout.init();
            Nacional.init({
                alert_title: '";
        // line 390
        echo twig_escape_filter($this->env, trans("form_title"), "html", null, true);
        echo "'
            });
        });
    </script>
    <!-- Global js END -->

    ";
        // line 396
        $this->displayBlock('script', $context, $blocks);
        // line 398
        echo "
    ";
        // line 399
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "production")) {
            // line 400
            echo "
";
            // line 415
            echo "
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '598423823687322');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height=\"1\" width=\"1\"
             src=\"https://www.facebook.com/tr?id=598423823687322&ev=PageView
\t&noscript=1\"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Twitter universal website tag code -->
    <script>
        !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
        },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
            a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
        // Insert Twitter Pixel ID and Standard Event data below
        twq('init','nx60c');
        twq('track','PageView');
    </script>
    <!-- End Twitter universal website tag code -->

    <!-- Start of structured data -->
    <script type=\"application/ld+json\">
        {
            \"@context\": \"http://schema.org\",
            \"@type\": \"Hotel\",
            \"name\": \"Hotel Nacional de Cuba\",
            \"description\": \"Hotel Nacional de Cuba. Reserva online alojamiento, cabaret parisien shows, ofertas restaurants, salones para eventos y convenciones en La Habana, Cuba\",
            \"address\": {
                \"@type\": \"PostalAddress\",
                \"addressCountry\": \"CU\",
                \"addressLocality\": \"Vedado, Plaza de la Revolución\",
                \"addressRegion\": \"La Habana\",
                \"streetAddress\": \" Esquina 21 y O.\"
            },
            \"telephone\": \"+53 7 836 3564\",
            \"photo\": \"https://www.hotelnacional-decuba.com/panel/web/uploads/admin/slideshow/slide-298e79a402aa57b3c8f8c7e8a6491a4e.jpg \",
            \"starRating\": {
                \"@type\": \"Rating\",
                \"ratingValue\": \"5\"
            },
            \"priceRange\": \"\$234.00 - \$862.00\"
        }
    </script>
        <!-- End of Structured Data  -->
    ";
        }
        // line 472
        echo "
    ";
        // line 473
        $this->displayBlock('pixel', $context, $blocks);
        // line 474
        echo "
    ";
        // line 476
        echo "    ";
        if (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "env", array()) == "development")) {
            // line 477
            echo "        ";
            $this->loadTemplate("@myprofiler/bar/bar.twig", "base.twig", 477)->display($context);
            // line 478
            echo "    ";
        }
        // line 479
        echo "</body>
</html>";
    }

    // line 12
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_keywords_home"), "html", null, true);
    }

    // line 13
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, trans("seo_description_home"), "html", null, true);
    }

    // line 62
    public function block_stylesheet($context, array $blocks = array())
    {
    }

    // line 189
    public function block_barra_reserva($context, array $blocks = array())
    {
        // line 190
        echo "    ";
    }

    // line 192
    public function block_slide_show($context, array $blocks = array())
    {
        // line 193
        echo "    ";
    }

    // line 196
    public function block_content($context, array $blocks = array())
    {
        // line 197
        echo "    ";
    }

    // line 373
    public function block_slider_js($context, array $blocks = array())
    {
        // line 374
        echo "    ";
    }

    // line 381
    public function block_js_homepage($context, array $blocks = array())
    {
        // line 382
        echo "    ";
    }

    // line 396
    public function block_script($context, array $blocks = array())
    {
        // line 397
        echo "    ";
    }

    // line 473
    public function block_pixel($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  894 => 473,  890 => 397,  887 => 396,  883 => 382,  880 => 381,  876 => 374,  873 => 373,  869 => 197,  866 => 196,  862 => 193,  859 => 192,  855 => 190,  852 => 189,  847 => 62,  841 => 13,  835 => 12,  830 => 479,  827 => 478,  824 => 477,  821 => 476,  818 => 474,  816 => 473,  813 => 472,  754 => 415,  751 => 400,  749 => 399,  746 => 398,  744 => 396,  735 => 390,  726 => 383,  724 => 381,  716 => 375,  714 => 373,  702 => 363,  700 => 362,  697 => 361,  694 => 360,  691 => 359,  689 => 358,  677 => 349,  669 => 343,  659 => 341,  656 => 340,  653 => 339,  650 => 338,  647 => 337,  644 => 336,  641 => 335,  636 => 334,  634 => 333,  617 => 318,  611 => 314,  609 => 313,  605 => 311,  592 => 300,  590 => 299,  584 => 296,  580 => 294,  571 => 292,  566 => 291,  564 => 290,  560 => 288,  549 => 285,  544 => 284,  540 => 283,  536 => 281,  532 => 279,  520 => 269,  518 => 268,  515 => 267,  504 => 258,  502 => 257,  499 => 256,  497 => 255,  484 => 244,  469 => 231,  467 => 230,  453 => 219,  449 => 218,  440 => 214,  434 => 213,  430 => 212,  426 => 211,  415 => 203,  408 => 198,  406 => 196,  402 => 194,  400 => 192,  397 => 191,  395 => 189,  386 => 183,  374 => 173,  363 => 170,  360 => 169,  356 => 168,  350 => 164,  340 => 160,  336 => 159,  333 => 158,  329 => 157,  318 => 148,  312 => 146,  310 => 145,  306 => 144,  301 => 142,  296 => 139,  288 => 136,  282 => 135,  276 => 132,  273 => 131,  266 => 127,  259 => 123,  255 => 121,  253 => 120,  247 => 117,  237 => 109,  227 => 105,  223 => 104,  220 => 103,  216 => 102,  210 => 99,  201 => 92,  191 => 88,  187 => 87,  184 => 86,  180 => 85,  174 => 82,  160 => 71,  150 => 63,  148 => 62,  145 => 61,  132 => 50,  130 => 49,  112 => 34,  107 => 32,  103 => 31,  99 => 30,  95 => 29,  90 => 28,  85 => 25,  81 => 24,  77 => 23,  73 => 22,  68 => 21,  58 => 13,  54 => 12,  50 => 11,  41 => 5,  36 => 3,  32 => 2,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base.twig", "/usr/local/virtual/user_hn_ftp/data/portal/application/views/base.twig");
    }
}
