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

/* module::admin/dashboards/partials/columns */
class __TwigTemplate_efb0956ec1fbf17a17ab745577ab1a58166509e5fa1b3807036c01aaf6c11d3a extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<div class=\"row\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dashboard"] ?? null), "widgets", [], "any", false, false, false, 2), "pinned", [], "method", false, false, false, 2));
        foreach ($context['_seq'] as $context["_key"] => $context["widget"]) {
            // line 3
            echo "        <div class=\"col-lg-24\">
            ";
            // line 4
            echo twig_get_attribute($this->env, $this->source, $context["widget"], "output", [], "method", false, false, false, 4);
            echo "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['widget'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</div>


<div class=\"columns row\">
    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_split_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dashboard"] ?? null), "layout", [], "any", false, false, false, 11), "-"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["span"]) {
            // line 12
            echo "        <div class=\"column col-lg-";
            echo twig_escape_filter($this->env, $context["span"], "html", null, true);
            echo "\">

            ";
            // line 14
            $context["column"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dashboard"] ?? null), "widgets", [], "any", false, false, false, 14), "allowed", [], "method", false, false, false, 14), "column", [0 => twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 14), 1 => twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 14)], "method", false, false, false, 14);
            // line 15
            echo "
            ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["column"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["widget"]) {
                // line 17
                echo "                ";
                echo twig_get_attribute($this->env, $this->source, $context["widget"], "output", [], "method", false, false, false, 17);
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['widget'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "
        </div>
    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['span'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "module::admin/dashboards/partials/columns";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 22,  103 => 19,  94 => 17,  90 => 16,  87 => 15,  85 => 14,  79 => 12,  62 => 11,  56 => 7,  47 => 4,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"row\">
    {% for widget in dashboard.widgets.pinned() %}
        <div class=\"col-lg-24\">
            {{ widget.output()|raw }}
        </div>
    {% endfor %}
</div>


<div class=\"columns row\">
    {% for span in dashboard.layout|split('-') %}
        <div class=\"column col-lg-{{ span }}\">

            {% set column = dashboard.widgets.allowed().column(loop.index, loop.last) %}

            {% for widget in column %}
                {{ widget.output()|raw }}
            {% endfor %}

        </div>
    {% endfor %}
</div>
", "module::admin/dashboards/partials/columns", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/dashboards/partials/columns.twig");
    }
}
