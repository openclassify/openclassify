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

/* C:\wamp64\www\ocify\vendor\visiosoft\streams-platform\src\View\Command/../../../resources/views/buttons/buttons.twig */
class __TwigTemplate_e12a595c7f96df22d8ba63713b3b7022e3da37245068203c367ecba0e52022f8 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["buttons"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["button"]) {
            // line 2
            echo "
    ";
            // line 4
            echo "    ";
            if ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["button"], "dropdown", [], "any", false, false, false, 4)) &&  !twig_get_attribute($this->env, $this->source, $context["button"], "parent", [], "any", false, false, false, 4))) {
                // line 5
                echo "
        ";
                // line 7
                echo "        <";
                ((twig_get_attribute($this->env, $this->source, $context["button"], "tag", [], "any", false, false, false, 7)) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "tag", [], "any", false, false, false, 7), "html", null, true))) : (print ("a")));
                echo " class=\"btn btn-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "size", [], "any", false, false, false, 7), "html", null, true);
                echo " btn-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 7), "html", null, true);
                echo " ";
                echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 7)) ? ("disabled") : (""));
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "class", [], "any", false, false, false, 7), "html", null, true);
                echo "\" ";
                echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 7)) ? ("disabled") : (""));
                echo " ";
                echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["button"], "attributes", [], "any", false, false, false, 7)]);
                echo ">
            ";
                // line 8
                echo ((twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 8)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 8)])) : (""));
                echo "
            ";
                // line 9
                echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "text", [], "any", false, false, false, 9)]);
                echo "
        </";
                // line 10
                ((twig_get_attribute($this->env, $this->source, $context["button"], "tag", [], "any", false, false, false, 10)) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "tag", [], "any", false, false, false, 10), "html", null, true))) : (print ("a")));
                echo ">

    ";
            }
            // line 13
            echo "
    ";
            // line 15
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, $context["button"], "dropdown", [], "any", false, false, false, 15)) {
                // line 16
                echo "        <div class=\"btn-group ";
                echo ((twig_get_attribute($this->env, $this->source, $context["button"], "dropup", [], "any", false, false, false, 16)) ? ("dropup") : (""));
                echo "\">

            ";
                // line 18
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["button"], "attributes", [], "any", false, false, false, 18), "href", [], "any", false, false, false, 18)) {
                    // line 19
                    echo "                <a class=\"btn btn-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "size", [], "any", false, false, false, 19), "html", null, true);
                    echo " btn-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 19), "html", null, true);
                    echo " ";
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 19)) ? ("disabled") : (""));
                    echo " ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "class", [], "any", false, false, false, 19), "html", null, true);
                    echo "\" ";
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 19)) ? ("disabled") : (""));
                    echo " ";
                    echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["button"], "attributes", [], "any", false, false, false, 19)]);
                    echo ">
                    ";
                    // line 20
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 20)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 20)])) : (""));
                    echo "
                    ";
                    // line 21
                    echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "text", [], "any", false, false, false, 21)]);
                    echo "
                </a>

                <a class=\"dropdown-toggle-split btn btn-";
                    // line 24
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "size", [], "any", false, false, false, 24), "html", null, true);
                    echo " btn-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 24), "html", null, true);
                    echo " ";
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 24)) ? ("disabled") : (""));
                    echo "\"
                   data-toggle=\"dropdown\" ";
                    // line 25
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 25)) ? ("disabled") : (""));
                    echo ">
                    ";
                    // line 26
                    echo call_user_func_array($this->env->getFunction('icon')->getCallable(), ["fa fa-caret-down"]);
                    echo "
                </a>
            ";
                } else {
                    // line 29
                    echo "                <a class=\"dropdown-toggle btn btn-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "size", [], "any", false, false, false, 29), "html", null, true);
                    echo " btn-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 29), "html", null, true);
                    echo " ";
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 29)) ? ("disabled") : (""));
                    echo " ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "class", [], "any", false, false, false, 29), "html", null, true);
                    echo "\" ";
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "disabled", [], "any", false, false, false, 29)) ? ("disabled") : (""));
                    echo "
                   data-toggle=\"dropdown\" ";
                    // line 30
                    echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["button"], "attributes", [], "any", false, false, false, 30)]);
                    echo ">
                    ";
                    // line 31
                    echo ((twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 31)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "icon", [], "any", false, false, false, 31)])) : (""));
                    echo "
                    ";
                    // line 32
                    echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["button"], "text", [], "any", false, false, false, 32)]);
                    echo "
                </a>
            ";
                }
                // line 35
                echo "
            ";
                // line 37
                echo "            <ul class=\"dropdown-menu dropdown-menu-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["button"], "position", [], "any", false, false, false, 37), "html", null, true);
                echo "\">
                ";
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["button"], "dropdown", [], "any", false, false, false, 38));
                foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["button"], "enabled", [], "any", false, false, false, 38) || (twig_get_attribute($this->env, $this->source, $context["button"], "enabled", [], "any", false, false, false, 38) == null))) {
                        // line 39
                        echo "                    ";
                        if (twig_get_attribute($this->env, $this->source, $context["link"], "text", [], "any", false, false, false, 39)) {
                            // line 40
                            echo "                        <li>

                            ";
                            // line 43
                            echo "                            ";
                            if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["link"], "attributes", [], "any", false, false, false, 43), "name", [], "any", false, false, false, 43)) {
                                // line 44
                                echo "                                <a class=\"dropdown-item\" ";
                                echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["link"], "attributes", [], "any", false, false, false, 44)]);
                                echo ">
                                    ";
                                // line 45
                                echo ((twig_get_attribute($this->env, $this->source, $context["link"], "icon", [], "any", false, false, false, 45)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["link"], "icon", [], "any", false, false, false, 45)])) : (""));
                                echo "
                                    ";
                                // line 46
                                echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["link"], "text", [], "any", false, false, false, 46)]);
                                echo "
                                </a>
                            ";
                            }
                            // line 49
                            echo "
                            ";
                            // line 51
                            echo "                            ";
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["link"], "attributes", [], "any", false, false, false, 51), "name", [], "any", false, false, false, 51)) {
                                // line 52
                                echo "                                <button class=\"dropdown-item\" ";
                                echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["link"], "attributes", [], "any", false, false, false, 52)]);
                                echo ">
                                    ";
                                // line 53
                                echo ((twig_get_attribute($this->env, $this->source, $context["link"], "icon", [], "any", false, false, false, 53)) ? (call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["link"], "icon", [], "any", false, false, false, 53)])) : (""));
                                echo "
                                    ";
                                // line 54
                                echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["link"], "text", [], "any", false, false, false, 54)]);
                                echo "
                                </button>
                            ";
                            }
                            // line 57
                            echo "
                        </li>
                    ";
                        } else {
                            // line 60
                            echo "                        <li class=\"dropdown-divider\">
                            <hr>
                        </li>
                    ";
                        }
                        // line 64
                        echo "                ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "            </ul>
        </div>
    ";
            }
            // line 68
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['button'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/buttons/buttons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 68,  242 => 65,  235 => 64,  229 => 60,  224 => 57,  218 => 54,  214 => 53,  209 => 52,  206 => 51,  203 => 49,  197 => 46,  193 => 45,  188 => 44,  185 => 43,  181 => 40,  178 => 39,  173 => 38,  168 => 37,  165 => 35,  159 => 32,  155 => 31,  151 => 30,  138 => 29,  132 => 26,  128 => 25,  120 => 24,  114 => 21,  110 => 20,  95 => 19,  93 => 18,  87 => 16,  84 => 15,  81 => 13,  75 => 10,  71 => 9,  67 => 8,  50 => 7,  47 => 5,  44 => 4,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% for button in buttons %}

    {# Render normal buttons. #}
    {% if button.dropdown is empty and not button.parent %}

        {# Render normal buttons as an anchor #}
        <{{ button.tag ?: 'a' }} class=\"btn btn-{{ button.size }} btn-{{ button.type }} {{ button.disabled ? 'disabled' }} {{ button.class }}\" {{ button.disabled ? 'disabled' }} {{ html_attributes(button.attributes) }}>
            {{ button.icon ? icon(button.icon)|raw }}
            {{ trans(button.text)|raw }}
        </{{ button.tag ?: 'a' }}>

    {% endif %}

    {# Render dropdown type buttons. #}
    {% if button.dropdown %}
        <div class=\"btn-group {{ button.dropup ? 'dropup' }}\">

            {% if button.attributes.href %}
                <a class=\"btn btn-{{ button.size }} btn-{{ button.type }} {{ button.disabled ? 'disabled' }} {{ button.class }}\" {{ button.disabled ? 'disabled' }} {{ html_attributes(button.attributes) }}>
                    {{ button.icon ? icon(button.icon)|raw }}
                    {{ trans(button.text)|raw }}
                </a>

                <a class=\"dropdown-toggle-split btn btn-{{ button.size }} btn-{{ button.type }} {{ button.disabled ? 'disabled' }}\"
                   data-toggle=\"dropdown\" {{ button.disabled ? 'disabled' }}>
                    {{ icon('fa fa-caret-down') }}
                </a>
            {% else %}
                <a class=\"dropdown-toggle btn btn-{{ button.size }} btn-{{ button.type }} {{ button.disabled ? 'disabled' }} {{ button.class }}\" {{ button.disabled ? 'disabled' }}
                   data-toggle=\"dropdown\" {{ html_attributes(button.attributes) }}>
                    {{ button.icon ? icon(button.icon)|raw }}
                    {{ trans(button.text)|raw }}
                </a>
            {% endif %}

            {# Render the actual dropdown links #}
            <ul class=\"dropdown-menu dropdown-menu-{{ button.position }}\">
                {% for link in button.dropdown if button.enabled or button.enabled == null %}
                    {% if link.text %}
                        <li>

                            {# Render normal buttons as an anchor #}
                            {% if not link.attributes.name %}
                                <a class=\"dropdown-item\" {{ html_attributes(link.attributes) }}>
                                    {{ link.icon ? icon(link.icon)|raw }}
                                    {{ trans(link.text)|raw }}
                                </a>
                            {% endif %}

                            {# Render normal buttons as a button #}
                            {% if link.attributes.name %}
                                <button class=\"dropdown-item\" {{ html_attributes(link.attributes) }}>
                                    {{ link.icon ? icon(link.icon)|raw }}
                                    {{ trans(link.text)|raw }}
                                </button>
                            {% endif %}

                        </li>
                    {% else %}
                        <li class=\"dropdown-divider\">
                            <hr>
                        </li>
                    {% endif %}
                {% endfor %}
            </ul>
        </div>
    {% endif %}

{% endfor %}
", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/buttons/buttons.twig", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/buttons/buttons.twig");
    }
}
