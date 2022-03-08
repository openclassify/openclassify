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

/* theme::layouts/default */
class __TwigTemplate_614a726c48b26e5e563c30fd4a20422b5b5cb17aa4762906bf978830b99c5923 extends \Anomaly\Streams\Platform\View\Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'styles' => [$this, 'block_styles'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>

<html lang=\"";
        // line 3
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('config')->getCallable(), ["app.locale"]), "html", null, true);
        echo "\">

<head>
    ";
        // line 6
        $this->loadTemplate("theme::partials/metadata", "theme::layouts/default", 6)->display($context);
        // line 7
        echo "    ";
        $this->displayBlock('styles', $context, $blocks);
        // line 8
        echo "</head>

<body class=\"variant-";
        // line 10
        echo twig_escape_filter($this->env, twig_random($this->env, 8), "html", null, true);
        echo ((twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('locale')->getCallable(), []), "isRtl", [], "method", false, false, false, 10)) ? (" rtl") : (""));
        echo " display--";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('preference_value')->getCallable(), ["visiosoft.theme.defaultadmin::display", "default"]), "html", null, true);
        echo " sidebars--";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('preference_value')->getCallable(), ["visiosoft.theme.defaultadmin::sidebars", "default"]), "html", null, true);
        echo "\"
      data-variants=\"8\">

";
        // line 17
        echo "<section id=\"app\">
    ";
        // line 18
        $this->loadTemplate("visiosoft.theme.defaultadmin::partials/logo", "theme::layouts/default", 18)->display($context);
        // line 19
        echo "    ";
        $this->loadTemplate("visiosoft.theme.defaultadmin::partials/sidebar", "theme::layouts/default", 19)->display($context);
        // line 20
        echo "    ";
        $this->loadTemplate("visiosoft.theme.defaultadmin::partials/menu", "theme::layouts/default", 20)->display($context);
        // line 21
        echo "    <main id=\"main\" style=\"min-height: 1500px;\">
        ";
        // line 22
        $this->loadTemplate("visiosoft.theme.defaultadmin::partials/topbar", "theme::layouts/default", 22)->display($context);
        // line 23
        echo "        ";
        if ((call_user_func_array($this->env->getFunction('trans')->getCallable(), ["module::addon.info"]) != "module::addon.info")) {
            // line 24
            echo "            <div class=\"page-info m-2 small text-white alert rounded\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["module::addon.info"]), "html", null, true);
            echo "</div>
        ";
        }
        // line 26
        echo "
        <div class=\"container-fluid pt-1\">
            ";
        // line 28
        $this->loadTemplate("theme::partials/messages", "theme::layouts/default", 28)->display($context);
        // line 29
        echo "            ";
        $this->loadTemplate("theme::partials/buttons", "theme::layouts/default", 29)->display($context);
        // line 30
        echo "        </div>

        ";
        // line 32
        $this->displayBlock('content', $context, $blocks);
        // line 33
        echo "
    </main>
    ";
        // line 35
        $this->loadTemplate("theme::partials/footer", "theme::layouts/default", 35)->display($context);
        // line 36
        echo "    ";
        $this->loadTemplate("theme::partials/modals", "theme::layouts/default", 36)->display($context);
        // line 37
        echo "</section>
";
        // line 38
        $this->loadTemplate("theme::partials/assets", "theme::layouts/default", 38)->display($context);
        // line 39
        echo "</body>
</html>
";
    }

    // line 7
    public function block_styles($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 32
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "theme::layouts/default";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 32,  129 => 7,  123 => 39,  121 => 38,  118 => 37,  115 => 36,  113 => 35,  109 => 33,  107 => 32,  103 => 30,  100 => 29,  98 => 28,  94 => 26,  88 => 24,  85 => 23,  83 => 22,  80 => 21,  77 => 20,  74 => 19,  72 => 18,  69 => 17,  58 => 10,  54 => 8,  51 => 7,  49 => 6,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>

<html lang=\"{{ config('app.locale') }}\">

<head>
    {% include \"theme::partials/metadata\" %}
    {% block styles %}{% endblock %}
</head>

<body class=\"variant-{{ random(8) }}{{ locale().isRtl() ? ' rtl' }} display--{{ preference_value('visiosoft.theme.defaultadmin::display', 'default') }} sidebars--{{ preference_value('visiosoft.theme.defaultadmin::sidebars', 'default') }}\"
      data-variants=\"8\">

{# {% include \"theme::partials/push\" %} #}
{# {% include \"theme::partials/brand\" %} #}
{# {% include \"theme::partials/navbar\" %} #}
{# {% include \"theme::partials/header\" %} #}
<section id=\"app\">
    {% include \"visiosoft.theme.defaultadmin::partials/logo\" %}
    {% include \"visiosoft.theme.defaultadmin::partials/sidebar\" %}
    {% include \"visiosoft.theme.defaultadmin::partials/menu\" %}
    <main id=\"main\" style=\"min-height: 1500px;\">
        {% include \"visiosoft.theme.defaultadmin::partials/topbar\" %}
        {% if trans('module::addon.info') != 'module::addon.info' %}
            <div class=\"page-info m-2 small text-white alert rounded\">{{ trans('module::addon.info') }}</div>
        {% endif %}

        <div class=\"container-fluid pt-1\">
            {% include \"theme::partials/messages\" %}
            {% include \"theme::partials/buttons\" %}
        </div>

        {% block content %}{% endblock %}

    </main>
    {% include \"theme::partials/footer\" %}
    {% include \"theme::partials/modals\" %}
</section>
{% include \"theme::partials/assets\" %}
</body>
</html>
", "theme::layouts/default", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//layouts/default.twig");
    }
}
