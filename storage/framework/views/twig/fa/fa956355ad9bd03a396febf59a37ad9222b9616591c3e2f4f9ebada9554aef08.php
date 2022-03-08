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

/* visiosoft.theme.defaultadmin::partials/logo */
class __TwigTemplate_15f7abff358083d3376b2ee0d5d2ce5b3c7fca182a8fbd2964acd6758570d24a extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<div class=\"logo-bar\">
    <div class=\"button-menu logo-bar-table\">
        <div class=\"align-middle text-center logo-bar-cell menu-action\">
            <button href=\"javascript:void(0);\" type=\"button\" class=\"button-menu-mobile\"
                    onclick=\"\$('#sidebar').toggleClass('open'); \$('body').toggleClass('expand');\">
                <i class=\"fa fa-bars\"></i>
            </button>
        </div>
        <div class=\"align-middle text-center logo-bar-cell logo\">
            <a href=\"/admin\" class=\"logo variant-logo\">
                ";
        // line 11
        if (call_user_func_array($this->env->getFunction('setting_value')->getCallable(), ["visiosoft.theme.defaultadmin::panel_icon"])) {
            // line 12
            echo "                    <img src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('file')->getCallable(), [call_user_func_array($this->env->getFunction('setting_value')->getCallable(), ["visiosoft.theme.defaultadmin::panel_icon"])]), "make", [], "any", false, false, false, 12), "url", [], "any", false, false, false, 12), "html", null, true);
            echo "\"
                         alt=\"site icon\">
                ";
        } else {
            // line 15
            echo "                    ";
            echo twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), ["theme::img/panel-icon.svg"]), "data", [], "any", false, false, false, 15);
            echo "
                ";
        }
        // line 17
        echo "            </a>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "visiosoft.theme.defaultadmin::partials/logo";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 17,  58 => 15,  51 => 12,  49 => 11,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"logo-bar\">
    <div class=\"button-menu logo-bar-table\">
        <div class=\"align-middle text-center logo-bar-cell menu-action\">
            <button href=\"javascript:void(0);\" type=\"button\" class=\"button-menu-mobile\"
                    onclick=\"\$('#sidebar').toggleClass('open'); \$('body').toggleClass('expand');\">
                <i class=\"fa fa-bars\"></i>
            </button>
        </div>
        <div class=\"align-middle text-center logo-bar-cell logo\">
            <a href=\"/admin\" class=\"logo variant-logo\">
                {% if setting_value('visiosoft.theme.defaultadmin::panel_icon') %}
                    <img src=\"{{ file(setting_value('visiosoft.theme.defaultadmin::panel_icon')).make.url }}\"
                         alt=\"site icon\">
                {% else %}
                    {{ img('theme::img/panel-icon.svg').data|raw }}
                {% endif %}
            </a>
        </div>
    </div>
</div>", "visiosoft.theme.defaultadmin::partials/logo", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/logo.twig");
    }
}
