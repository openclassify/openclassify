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

/* visiosoft.theme.defaultadmin::partials/menu */
class __TwigTemplate_35a7a3ce162b7f5e842a38d76e5fb32ce62c8a55d005adaf9e2a1835c737a3c3 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        $macros["menu"] = $this->macros["menu"] = $this->loadTemplate("visiosoft.theme.defaultadmin::macros/sections.twig", "visiosoft.theme.defaultadmin::partials/menu", 1)->unwrap();
        // line 2
        echo "<aside id=\"menu\" class=\"scrollbar\">
    <ul>
        ";
        // line 4
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "module", [], "any", false, false, false, 4), "parent", [], "any", false, false, false, 4)) {
            // line 5
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 5), "sections", [], "any", false, false, false, 5), "root", [], "method", false, false, false, 5), "visible", [], "method", false, false, false, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
                // line 6
                echo "                ";
                echo twig_call_macro($macros["menu"], "macro_sections", [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 6), "sections", [], "any", false, false, false, 6), $context["section"]], 6, $context, $this->getSourceContext());
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 8
            echo "
            ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('getSubmenus')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "module", [], "any", false, false, false, 9), "namespace", [], "any", false, false, false, 9)]));
            foreach ($context['_seq'] as $context["_key"] => $context["navigation"]) {
                // line 10
                echo "                <li>
                    <a href=\"";
                // line 11
                echo call_user_func_array($this->env->getFunction('url')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "href", [], "any", false, false, false, 11)]);
                echo "\">
                        ";
                // line 12
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "title", [], "any", false, false, false, 12)]), "html", null, true);
                echo "
                    </a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navigation'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "        ";
        } else {
            // line 17
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('getSections')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "module", [], "any", false, false, false, 17), "parent", [], "any", false, false, false, 17)]));
            foreach ($context['_seq'] as $context["_key"] => $context["navigation"]) {
                // line 18
                echo "                <li>
                    <a href=\"";
                // line 19
                echo call_user_func_array($this->env->getFunction('url')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "href", [], "any", false, false, false, 19)]);
                echo "\">
                        ";
                // line 20
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "title", [], "any", false, false, false, 20)]), "html", null, true);
                echo "
                    </a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navigation'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('getSections')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "module", [], "any", false, false, false, 24), "namespace", [], "any", false, false, false, 24)]));
            foreach ($context['_seq'] as $context["_key"] => $context["navigation"]) {
                // line 25
                echo "                <li>
                    <a href=\"";
                // line 26
                echo call_user_func_array($this->env->getFunction('url')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "href", [], "any", false, false, false, 26)]);
                echo "\">
                        ";
                // line 27
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["navigation"], "title", [], "any", false, false, false, 27)]), "html", null, true);
                echo "
                    </a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navigation'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "        ";
        }
        // line 32
        echo "    </ul>
</aside>";
    }

    public function getTemplateName()
    {
        return "visiosoft.theme.defaultadmin::partials/menu";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 32,  130 => 31,  120 => 27,  116 => 26,  113 => 25,  108 => 24,  98 => 20,  94 => 19,  91 => 18,  86 => 17,  83 => 16,  73 => 12,  69 => 11,  66 => 10,  62 => 9,  59 => 8,  50 => 6,  45 => 5,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% import \"visiosoft.theme.defaultadmin::macros/sections.twig\" as menu %}
<aside id=\"menu\" class=\"scrollbar\">
    <ul>
        {% if not template.module.parent %}
            {% for section in template.cp.sections.root().visible() %}
                {{ menu.sections(template.cp.sections, section) }}
            {% endfor %}

            {% for navigation in getSubmenus(template.module.namespace) %}
                <li>
                    <a href=\"{{ url(navigation.href) }}\">
                        {{ trans(navigation.title) }}
                    </a>
                </li>
            {% endfor %}
        {% else %}
            {% for navigation in getSections(template.module.parent) %}
                <li>
                    <a href=\"{{ url(navigation.href) }}\">
                        {{ trans(navigation.title) }}
                    </a>
                </li>
            {% endfor %}
            {% for navigation in getSections(template.module.namespace) %}
                <li>
                    <a href=\"{{ url(navigation.href) }}\">
                        {{ trans(navigation.title) }}
                    </a>
                </li>
            {% endfor %}
        {% endif %}
    </ul>
</aside>", "visiosoft.theme.defaultadmin::partials/menu", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/menu.twig");
    }
}
