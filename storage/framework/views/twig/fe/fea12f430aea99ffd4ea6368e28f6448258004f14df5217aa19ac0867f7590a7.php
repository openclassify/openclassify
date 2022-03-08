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

/* theme::partials/buttons */
class __TwigTemplate_3dabbdde0be9633f6e462bb538858f57571005677615b370f344dee4e871a0ec extends \Anomaly\Streams\Platform\View\Twig\Template
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
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 1), "buttons", [], "any", false, false, false, 1), "isEmpty", [], "method", false, false, false, 1)) {
            // line 2
            echo "    <div id=\"buttons\">
        ";
            // line 3
            echo call_user_func_array($this->env->getFunction('buttons')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 3), "buttons", [], "any", false, false, false, 3)]);
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "theme::partials/buttons";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if not template.cp.buttons.isEmpty() %}
    <div id=\"buttons\">
        {{ buttons(template.cp.buttons) }}
    </div>
{% endif %}
", "theme::partials/buttons", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/buttons.twig");
    }
}
