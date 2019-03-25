<?php

/* default/home.html.twig */
class __TwigTemplate_322c049e87ef106ab095e63131a442c81a8132be0bb69595675a1831ba6128e1 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "default/home.html.twig", 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/home.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/home.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Home";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "
    <div class=\"container mt-4\">
        <div class=\"row justify-content-center mb-4 \">
            <div class=\"col-sm-8\">
                <div class=\"card d-flex \">
                    <div class=\"card-header bg-danger text-white\">
                        <h4>Inicia sesión</h4>
                    </div>
                     
                    <div class=\"card-body border border-dark\">
                        <div class=\"col-12 \">
                          
                            <form action=\"";
        // line 16
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
        echo "\" method=\"post\" class=\"text-center \">
                                <label class=\"sr-only \" for=\"username\">Username:</label>
                                <input type=\"text\" id=\"username\" class=\"form-control mb-3 border border-secondary\" name=\"_username\" value=\"\" placeholder=\"Username\" required autofocus/>
                                <label class=\"sr-only\" for=\"password\">Password:</label>
                                <input class=\"form-control mb-3 border border-secondary \" id=\"password\" name=\"_password\" placeholder=\"Password\" required type=\"password\"/>
                                                <i onclick=\"mostrarContrasena();\" class=\"icon-search-1  pointer \">Mostrar contrasenya</i>
                                                <div>
                              <button class=\"btn btn-md btn-danger mb-2 mt-4 \" type=\"submit\">Iniciar sesion</button>
                              </div>
                            </form>
                             ";
        // line 26
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new Twig_Error_Runtime('Variable "error" does not exist.', 26, $this->source); })())) {
            // line 27
            echo "                      <div class=\"\" >
                                <strong class=\"text-danger\">Usuario o Contraseña incorrecta</strong>
                                </div>
                            ";
        }
        // line 31
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "default/home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 31,  101 => 27,  99 => 26,  86 => 16,  72 => 4,  63 => 3,  45 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}
{% block title %}Home{% endblock %}
{% block body %}

    <div class=\"container mt-4\">
        <div class=\"row justify-content-center mb-4 \">
            <div class=\"col-sm-8\">
                <div class=\"card d-flex \">
                    <div class=\"card-header bg-danger text-white\">
                        <h4>Inicia sesión</h4>
                    </div>
                     
                    <div class=\"card-body border border-dark\">
                        <div class=\"col-12 \">
                          
                            <form action=\"{{ path('login') }}\" method=\"post\" class=\"text-center \">
                                <label class=\"sr-only \" for=\"username\">Username:</label>
                                <input type=\"text\" id=\"username\" class=\"form-control mb-3 border border-secondary\" name=\"_username\" value=\"\" placeholder=\"Username\" required autofocus/>
                                <label class=\"sr-only\" for=\"password\">Password:</label>
                                <input class=\"form-control mb-3 border border-secondary \" id=\"password\" name=\"_password\" placeholder=\"Password\" required type=\"password\"/>
                                                <i onclick=\"mostrarContrasena();\" class=\"icon-search-1  pointer \">Mostrar contrasenya</i>
                                                <div>
                              <button class=\"btn btn-md btn-danger mb-2 mt-4 \" type=\"submit\">Iniciar sesion</button>
                              </div>
                            </form>
                             {% if error %}
                      <div class=\"\" >
                                <strong class=\"text-danger\">Usuario o Contraseña incorrecta</strong>
                                </div>
                            {% endif %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                {% endblock %}
            ", "default/home.html.twig", "/opt/lampp/htdocs/DUAL/Atenea/templates/default/home.html.twig");
    }
}
