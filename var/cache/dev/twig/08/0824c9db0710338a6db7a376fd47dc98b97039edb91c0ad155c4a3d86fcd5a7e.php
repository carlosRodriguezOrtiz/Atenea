<?php

/* navbar.html.twig */
class __TwigTemplate_f4867694281355504cc7a7ccbd0d61366ee7e078e8991ab615030af5a3d90050 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "navbar.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "navbar.html.twig"));

        // line 1
        echo "<!-- MENU -->
<nav class=\"navbar   sticky-top navbar-expand-xl navbar-dark bg-dark \" role=\"navigation\">

    <a class=\"navbar-brand\" href=\"#\"><img src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\HttpFoundationExtension']->generateAbsoluteUrl($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/logo.png")), "html", null, true);
        echo "\"/></a>
    <h1 class=\"text-white\">ATENEA</h1>
    <button aria-controls=\"navbarsExample06\" aria-expanded=\"false\" aria-label=\"Toggle navigation\" class=\"navbar-toggler\" data-target=\"#navbarsExample06\" data-toggle=\"collapse\" type=\"button\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse  navbar-collapse\" id=\"navbarsExample06\">
        <ul class=\"navbar-nav mr-auto text-center \">
            ";
        // line 11
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 12
            echo "            
                <li class=\"nav-item \">
                    <a class=\"nav-link\" href=\"\">Home
                        <span class=\"sr-only\">(current)</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"\">Peliculas</a>
                </li>
            ";
        }
        // line 22
        echo "        </ul>
        <form action=\"\" class=\"form-inline w-100 my-2 my-md-0 pr-3 form-just\" method=\"post\">
            <div class=\"form-inline mr-2\">
                <div class=\"form-inline tex-white\">
                    ";
        // line 26
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 27
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 27, $this->source); })()), "user", []), "role", []) == "ROLE_ADMIN")) {
                // line 28
                echo "                            <a class=\"btn btn-dark btn-md mr-2\" href=\"\">
                                Usuario :
                                ";
                // line 30
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 30, $this->source); })()), "user", []), "username", []), "html", null, true);
                echo "
                                <span class=\"icon-power\" style=\"color:white;\"></span>
                            </a>
                                <a class=\"btn btn-danger btn-md\" href=\"\">Registro</a>
                            ";
            } else {
                // line 35
                echo "                            <a class=\"btn btn-dark btn-sm mr-2\" href=\"\">
                                Usuario :
                                ";
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 37, $this->source); })()), "user", []), "username", []), "html", null, true);
                echo "
                                <span class=\"icon-power\" style=\"color:white;\"></span>
                            </a>
                        ";
            }
            // line 41
            echo "                    

                    ";
        }
        // line 44
        echo "                </div>
            </form>
        </div>
    </nav>
    <!-- FIN MENU -->
    ";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "navbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 44,  92 => 41,  85 => 37,  81 => 35,  73 => 30,  69 => 28,  66 => 27,  64 => 26,  58 => 22,  46 => 12,  44 => 11,  34 => 4,  29 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!-- MENU -->
<nav class=\"navbar   sticky-top navbar-expand-xl navbar-dark bg-dark \" role=\"navigation\">

    <a class=\"navbar-brand\" href=\"#\"><img src=\"{{ absolute_url(asset ('img/logo.png')) }}\"/></a>
    <h1 class=\"text-white\">ATENEA</h1>
    <button aria-controls=\"navbarsExample06\" aria-expanded=\"false\" aria-label=\"Toggle navigation\" class=\"navbar-toggler\" data-target=\"#navbarsExample06\" data-toggle=\"collapse\" type=\"button\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse  navbar-collapse\" id=\"navbarsExample06\">
        <ul class=\"navbar-nav mr-auto text-center \">
            {% if is_granted('IS_AUTHENTICATED_REMEMBERED') %}
            
                <li class=\"nav-item \">
                    <a class=\"nav-link\" href=\"\">Home
                        <span class=\"sr-only\">(current)</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"\">Peliculas</a>
                </li>
            {% endif %}
        </ul>
        <form action=\"\" class=\"form-inline w-100 my-2 my-md-0 pr-3 form-just\" method=\"post\">
            <div class=\"form-inline mr-2\">
                <div class=\"form-inline tex-white\">
                    {% if is_granted('IS_AUTHENTICATED_REMEMBERED') %}
                        {% if app.user.role == 'ROLE_ADMIN' %}
                            <a class=\"btn btn-dark btn-md mr-2\" href=\"\">
                                Usuario :
                                {{ app.user.username}}
                                <span class=\"icon-power\" style=\"color:white;\"></span>
                            </a>
                                <a class=\"btn btn-danger btn-md\" href=\"\">Registro</a>
                            {% else %}
                            <a class=\"btn btn-dark btn-sm mr-2\" href=\"\">
                                Usuario :
                                {{ app.user.username}}
                                <span class=\"icon-power\" style=\"color:white;\"></span>
                            </a>
                        {% endif %}
                    

                    {% endif %}
                </div>
            </form>
        </div>
    </nav>
    <!-- FIN MENU -->
    ", "navbar.html.twig", "/opt/lampp/htdocs/DUAL/Atenea/templates/navbar.html.twig");
    }
}
