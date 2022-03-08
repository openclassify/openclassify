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

/* C:\wamp64\www\ocify\resources\default\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig */
class __TwigTemplate_6abf5d1707f3d21af07d1836b1a82522a199ba7b79aef6fef12c6e07a4d87472 extends \Anomaly\Streams\Platform\View\Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(((twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "layout", [], "any", false, false, false, 1)) ? (twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "layout", [], "any", false, false, false, 1)) : ("theme::layouts/default")), "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "
    ";
        // line 5
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "styles.css", "anomaly.module.dashboard::css/dashboard.css"]);
        echo "
    ";
        // line 6
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "anomaly.module.dashboard::js/dashboard.js"]);
        echo "

    <div id=\"dashboard\">
        <div class=\"container-fluid\">

            ";
        // line 11
        $this->loadTemplate("module::admin/dashboards/partials/navbar", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig", 11)->display($context);
        // line 12
        echo "            ";
        $this->loadTemplate("module::admin/dashboards/partials/columns", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig", 12)->display($context);
        // line 13
        echo "
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 13,  66 => 12,  64 => 11,  56 => 6,  52 => 5,  49 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends template.layout ?: \"theme::layouts/default\" %}

{% block content %}

    {{ asset_add('styles.css', 'anomaly.module.dashboard::css/dashboard.css') }}
    {{ asset_add('scripts.js', 'anomaly.module.dashboard::js/dashboard.js') }}

    <div id=\"dashboard\">
        <div class=\"container-fluid\">

            {% include \"module::admin/dashboards/partials/navbar\" %}
            {% include \"module::admin/dashboards/partials/columns\" %}

        </div>
    </div>

{% endblock %}
", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/dashboard.twig");
    }
}
