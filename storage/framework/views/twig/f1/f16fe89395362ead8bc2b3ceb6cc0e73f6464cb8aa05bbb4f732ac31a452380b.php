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

/* theme::partials/assets */
class __TwigTemplate_cb5d27b96eb38ccc09c6178cbdd11a7584677ca6aabbe4b4e91ceb699b0a40dc extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<style type=\"text/css\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('asset_inlines')->getCallable(), ["inlines", "styles.css"]));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 3
            echo "    ";
            echo $context["style"];
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 5
        echo "</style>

";
        // line 7
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "includes", [], "any", false, false, false, 7), "render", [0 => "cp_scripts"], "method", false, false, false, 7);
        echo "

<script type=\"text/javascript\">
    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('asset_inlines')->getCallable(), ["inlines", "scripts.js"]));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 11
            echo "    ";
            echo $context["script"];
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "</script>";
    }

    public function getTemplateName()
    {
        return "theme::partials/assets";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 13,  67 => 11,  63 => 10,  57 => 7,  53 => 5,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<style type=\"text/css\">
    {% for style in asset_inlines(\"styles.css\") %}
    {{ style|raw }}
    {% endfor %}
</style>

{{ template.includes.render('cp_scripts')|raw }}

<script type=\"text/javascript\">
    {% for script in asset_inlines(\"scripts.js\") %}
    {{ script|raw }}
    {% endfor %}
</script>", "theme::partials/assets", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/assets.twig");
    }
}
