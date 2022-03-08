<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* module::admin/dashboards/partials/navbar */
class __TwigTemplate_8845768cdbdbcec81086e7eccf0579902b3a689b46b39264da5fcc747d4d448b extends \Anomaly\Streams\Platform\View\Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if ((twig_get_attribute($this->env, $this->source, ($context["dashboards"] ?? null), "count", [], "method", false, false, false, 1) > 1)) {
            // line 2
            echo "    <div class=\"card\">

        <nav class=\"navbar navbar-light\">
            <div class=\"nav navbar-nav\">
                ";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["dashboards"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["dashboard"]) {
                // line 7
                echo "                    <a
                            class=\"nav-item nav-link ";
                // line 8
                echo ((twig_get_attribute($this->env, $this->source, $context["dashboard"], "active", [], "any", false, false, false, 8)) ? ("active") : (""));
                echo "\"
                            href=\"";
                // line 9
                echo call_user_func_array($this->env->getFunction('url')->getCallable(), [("admin/dashboard/view/" . twig_get_attribute($this->env, $this->source, $context["dashboard"], "slug", [], "any", false, false, false, 9))]);
                echo "\">
                        ";
                // line 10
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["dashboard"], "name", [], "any", false, false, false, 10), "html", null, true);
                echo "
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dashboard'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "            </div>
        </nav>

    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "module::admin/dashboards/partials/navbar";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 13,  60 => 10,  56 => 9,  52 => 8,  49 => 7,  45 => 6,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if dashboards.count() > 1 %}
    <div class=\"card\">

        <nav class=\"navbar navbar-light\">
            <div class=\"nav navbar-nav\">
                {% for dashboard in dashboards %}
                    <a
                            class=\"nav-item nav-link {{ dashboard.active ? 'active' }}\"
                            href=\"{{ url('admin/dashboard/view/' ~ dashboard.slug) }}\">
                        {{ dashboard.name }}
                    </a>
                {% endfor %}
            </div>
        </nav>

    </div>
{% endif %}
", "module::admin/dashboards/partials/navbar", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/partials/navbar.twig");
    }
}
