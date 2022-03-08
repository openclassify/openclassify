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

/* visiosoft.theme.defaultadmin::partials/sidebar */
class __TwigTemplate_85a71ca3e4d0ec317ffa94137d69e807da63b62ba2bbd7b9458ce87bf09a937b extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<aside id=\"sidebar\" class=\"scrollbar ";
        echo ((call_user_func_array($this->env->getFunction('preference_value')->getCallable(), ["visiosoft.theme.defaultadmin::sidebar_hover", call_user_func_array($this->env->getFunction('setting_value')->getCallable(), ["visiosoft.theme.defaultadmin::sidebar_hover"])])) ? ("hover") : (""));
        echo "\">
    <ul>
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 3), "navigation", [], "any", false, false, false, 3));
        foreach ($context['_seq'] as $context["key"] => $context["navigation"]) {
            // line 4
            echo "            <li class=\"";
            echo ((twig_get_attribute($this->env, $this->source, $context["navigation"], "active", [], "any", false, false, false, 4)) ? ("active") : (""));
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "class", [], "any", false, false, false, 4), "html", null, true);
            echo " variant-border\" data-slug=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["navigation"], "slug", [], "any", false, false, false, 4), "html", null, true);
            echo "\">
                <a ";
            // line 5
            echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["navigation"], "attributes", [], "any", false, false, false, 5)]);
            echo " title=\"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "title", [], "any", false, false, false, 5)]), "html", null, true);
            echo "\">
                    <span class=\"icon\">";
            // line 6
            echo twig_get_attribute($this->env, $this->source, $context["navigation"], "icon", [], "method", false, false, false, 6);
            echo "</span>
                    <span class=\"title\">";
            // line 7
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "title", [], "any", false, false, false, 7)]), "html", null, true);
            echo "</span>
                </a>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['navigation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    </ul>
</aside>
";
    }

    public function getTemplateName()
    {
        return "visiosoft.theme.defaultadmin::partials/sidebar";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 11,  66 => 7,  62 => 6,  56 => 5,  47 => 4,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<aside id=\"sidebar\" class=\"scrollbar {{ preference_value('visiosoft.theme.defaultadmin::sidebar_hover', setting_value('visiosoft.theme.defaultadmin::sidebar_hover')) ? 'hover' }}\">
    <ul>
        {% for key, navigation in template.cp.navigation %}
            <li class=\"{{ navigation.active ? 'active' }} {{ navigation.class }} variant-border\" data-slug=\"{{ navigation.slug }}\">
                <a {{ html_attributes(navigation.attributes) }} title=\"{{ trans(navigation.title) }}\">
                    <span class=\"icon\">{{ navigation.icon()|raw }}</span>
                    <span class=\"title\">{{ trans(navigation.title) }}</span>
                </a>
            </li>
        {% endfor %}
    </ul>
</aside>
", "visiosoft.theme.defaultadmin::partials/sidebar", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/sidebar.twig");
    }
}
