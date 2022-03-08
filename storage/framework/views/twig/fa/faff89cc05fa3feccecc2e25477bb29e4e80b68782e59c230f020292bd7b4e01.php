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

/* visiosoft.theme.defaultadmin::macros/sections.twig */
class __TwigTemplate_1923a60b5ba1db8b5c06b6afab3d60a5dc412a2b71da6627881bb5969bbcf440 extends \Anomaly\Streams\Platform\View\Twig\Template
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
    }

    // line 1
    public function macro_sections($__sections__ = null, $__section__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "sections" => $__sections__,
            "section" => $__section__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 2
            echo "
    ";
            // line 3
            $macros["self"] = $this;
            // line 4
            echo "
    <li class=\"";
            // line 5
            echo ((twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "highlighted", [], "any", false, false, false, 5)) ? ("highlighted") : (""));
            echo " ";
            echo ((twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "active", [], "any", false, false, false, 5)) ? ("active") : (""));
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "class", [], "any", false, false, false, 5), "html", null, true);
            echo "\">

        <a ";
            // line 7
            echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "attributes", [], "any", false, false, false, 7)]);
            echo ">
            ";
            // line 8
            echo ((twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "icon", [], "any", false, false, false, 8)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "icon", [], "any", false, false, false, 8)])) : (""));
            echo "
            ";
            // line 9
            echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "title", [], "any", false, false, false, 9)]);
            echo "

            ";
            // line 11
            if (twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "label", [], "any", false, false, false, 11)) {
                // line 12
                echo "                <span class=\"tag tag-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "context", [], "any", false, false, false, 12), "html", null, true);
                echo "\">
                    ";
                // line 13
                echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "label", [], "any", false, false, false, 13)]);
                echo "
                </span>
            ";
            }
            // line 16
            echo "        </a>

        ";
            // line 18
            if (twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "highlighted", [], "any", false, false, false, 18)) {
                // line 19
                echo "            <ul>
                ";
                // line 20
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["sections"] ?? null), "children", [0 => twig_get_attribute($this->env, $this->source, ($context["section"] ?? null), "slug", [], "any", false, false, false, 20)], "method", false, false, false, 20), "visible", [], "method", false, false, false, 20));
                foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                    // line 21
                    echo "                    ";
                    echo twig_call_macro($macros["self"], "macro_sections", [($context["sections"] ?? null), $context["child"]], 21, $context, $this->getSourceContext());
                    echo "
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "            </ul>
        ";
            }
            // line 25
            echo "    </li>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "visiosoft.theme.defaultadmin::macros/sections.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 25,  118 => 23,  109 => 21,  105 => 20,  102 => 19,  100 => 18,  96 => 16,  90 => 13,  85 => 12,  83 => 11,  78 => 9,  74 => 8,  70 => 7,  61 => 5,  58 => 4,  56 => 3,  53 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% macro sections(sections, section) %}

    {% import _self as self %}

    <li class=\"{{ section.highlighted ? 'highlighted' }} {{ section.active ? 'active' }} {{ section.class }}\">

        <a {{ html_attributes(section.attributes) }}>
            {{ section.icon ? icon(section.icon)|raw }}
            {{ trans(section.title)|raw }}

            {% if section.label %}
                <span class=\"tag tag-{{ section.context }}\">
                    {{ trans(section.label)|raw }}
                </span>
            {% endif %}
        </a>

        {% if section.highlighted %}
            <ul>
                {% for child in sections.children(section.slug).visible() %}
                    {{ self.sections(sections, child) }}
                {% endfor %}
            </ul>
        {% endif %}
    </li>
{% endmacro %}
", "visiosoft.theme.defaultadmin::macros/sections.twig", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//macros/sections.twig");
    }
}
