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

/* C:\wamp64\www\ocify\vendor\visiosoft\streams-platform\src\View\Command/../../../resources/views/partials/breadcrumb.twig */
class __TwigTemplate_0e50bbba7493628412861e85e28c44b174188a579a001914ef0ce0e3d0c738ce extends \Anomaly\Streams\Platform\View\Twig\Template
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
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "breadcrumbs", [], "any", false, false, false, 1), "count", [], "method", false, false, false, 1)) {
            // line 2
            echo "    <ol class=\"breadcrumb\">
        ";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "breadcrumbs", [], "any", false, false, false, 3));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["breadcrumb"] => $context["url"]) {
                // line 4
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 4)) {
                    // line 5
                    echo "                <li class=\"breadcrumb-item active\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["breadcrumb"]]), "html", null, true);
                    echo "</li>
            ";
                } else {
                    // line 7
                    echo "                <li class=\"breadcrumb-item\"><a href=\"";
                    echo twig_escape_filter($this->env, $context["url"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["breadcrumb"]]), "html", null, true);
                    echo "</a></li>
            ";
                }
                // line 9
                echo "        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['breadcrumb'], $context['url'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "    </ol>
";
        }
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/breadcrumb.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 10,  76 => 9,  68 => 7,  62 => 5,  59 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if template.breadcrumbs.count() %}
    <ol class=\"breadcrumb\">
        {% for breadcrumb, url in template.breadcrumbs %}
            {% if loop.last %}
                <li class=\"breadcrumb-item active\">{{ trans(breadcrumb) }}</li>
            {% else %}
                <li class=\"breadcrumb-item\"><a href=\"{{ url }}\">{{ trans(breadcrumb) }}</a></li>
            {% endif %}
        {% endfor %}
    </ol>
{% endif %}
", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/breadcrumb.twig", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/breadcrumb.twig");
    }
}
