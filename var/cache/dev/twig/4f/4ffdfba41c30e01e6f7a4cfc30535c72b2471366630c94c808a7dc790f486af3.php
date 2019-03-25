<?php

/* user/login.html.twig */
class __TwigTemplate_a05447a3fa7cbcd8b0893c618ab955c1a83645301c188a21de5e5891c7b8b205 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "user/login.html.twig", 1);
        $this->blocks = [
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "user/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "user/login.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "    <div class=\"container mt-4\">
        <div class=\"row justify-content-center mb-4 \">
            <div class=\"col-sm-8\">
                <div class=\"card d-flex \">
                    <div class=\"card-header bg-danger text-white\">
                        <h4>Inicia sesión</h4>
                    </div>
                     
                    <div class=\"card-body border border-dark\">
                        <div class=\"col-12 \">
                          
                            <form action=\"";
        // line 14
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
        // line 24
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new Twig_Error_Runtime('Variable "error" does not exist.', 24, $this->source); })())) {
            // line 25
            echo "                      <div class=\"\" >
                                <strong class=\"text-danger\">Usuario o Contraseña incorrecta</strong>
                                </div>
                            ";
        }
        // line 29
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
        return "user/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 29,  81 => 25,  79 => 24,  66 => 14,  53 => 3,  44 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}
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
{% endblock %}", "user/login.html.twig", "/opt/lampp/htdocs/DUAL/Atenea/templates/user/login.html.twig");
    }
}
