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

/* C:\wamp64\www\ocify\resources\default\addons/anomaly/xml_feed_widget-extension/views//content.twig */
class __TwigTemplate_f34e7e2cb2d5fb22587dbfbcf7c58b7c63cc98e7123808b0ebd59151999e2756 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "data", [], "any", false, false, false, 1), "items", [], "any", false, false, false, 1))) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "data", [], "any", false, false, false, 2), "items", [], "any", false, false, false, 2));
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
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 3
                echo "
        <div class=\"media\">

            <div class=\"media-left\">
                <i class=\"fa fa-calendar fa-lg text-faded\"></i>
            </div>

            <div class=\"media-body\">

                <h3 class=\"media-heading\">
                    <a href=\"";
                // line 13
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "get_permalink", [], "method", false, false, false, 13), "html", null, true);
                echo "\" target=\"_blank\">
                        ";
                // line 14
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "get_title", [], "method", false, false, false, 14), "html", null, true);
                echo "
                    </a>

                    <br>

                    <small class=\"text-muted\">
                        ";
                // line 20
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "get_date", [], "method", false, false, false, 20), "F j, Y"), "html", null, true);
                echo "
                    </small>
                </h3>

                ";
                // line 24
                echo twig_escape_filter($this->env, twig_striptags(twig_get_attribute($this->env, $this->source, $context["item"], "get_description", [], "method", false, false, false, 24)), "html", null, true);
                echo "

            </div>

        </div>

        ";
                // line 30
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 30)) {
                    // line 31
                    echo "            <hr>
        ";
                }
                // line 33
                echo "
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } elseif (is_array(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 35
($context["widget"] ?? null), "data", [], "any", false, false, false, 35), "items", [], "any", false, false, false, 35))) {
            // line 36
            echo "    <p>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["anomaly.extension.xml_feed_widget::message.empty"]), "html", null, true);
            echo "</p>
";
        } else {
            // line 38
            echo "    <p>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["anomaly.extension.xml_feed_widget::message.error"]), "html", null, true);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/xml_feed_widget-extension/views//content.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 38,  121 => 36,  119 => 35,  104 => 33,  100 => 31,  98 => 30,  89 => 24,  82 => 20,  73 => 14,  69 => 13,  57 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if widget.data.items is not empty %}
    {% for item in widget.data.items %}

        <div class=\"media\">

            <div class=\"media-left\">
                <i class=\"fa fa-calendar fa-lg text-faded\"></i>
            </div>

            <div class=\"media-body\">

                <h3 class=\"media-heading\">
                    <a href=\"{{ item.get_permalink() }}\" target=\"_blank\">
                        {{ item.get_title() }}
                    </a>

                    <br>

                    <small class=\"text-muted\">
                        {{ item.get_date()|date('F j, Y') }}
                    </small>
                </h3>

                {{ item.get_description()|striptags }}

            </div>

        </div>

        {% if not loop.last %}
            <hr>
        {% endif %}

    {% endfor %}
{% elseif is_array(widget.data.items) %}
    <p>{{ trans('anomaly.extension.xml_feed_widget::message.empty') }}</p>
{% else %}
    <p>{{ trans('anomaly.extension.xml_feed_widget::message.error') }}</p>
{% endif %}
", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/xml_feed_widget-extension/views//content.twig", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/xml_feed_widget-extension/views//content.twig");
    }
}
