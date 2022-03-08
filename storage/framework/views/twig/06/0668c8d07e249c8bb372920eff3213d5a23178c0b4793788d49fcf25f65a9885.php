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

/* theme::partials/messages */
class __TwigTemplate_76f78e9188567717ecb8ffa850b77e1028e4249f0013d224ca21901b3f4f9dbb extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<!-- Important Messages -->
";
        // line 2
        if (call_user_func_array($this->env->getFunction('message_exists')->getCallable(), ["exists", "important"])) {
            // line 3
            echo "    <div class=\"alert alert-danger\">
        ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('message_pull')->getCallable(), ["pull", "important"]));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 5
                echo "            ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["message"]])]);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 7
            echo "    </div>
";
        }
        // line 9
        echo "
<!-- Success Messages -->
";
        // line 11
        if (call_user_func_array($this->env->getFunction('message_exists')->getCallable(), ["exists", "success"])) {
            // line 12
            echo "    <div class=\"alert alert-success\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('message_pull')->getCallable(), ["pull", "success"]));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 17
                echo "            ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["message"]])]);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "    </div>
";
        }
        // line 21
        echo "
<!-- Informational Messages -->
";
        // line 23
        if (call_user_func_array($this->env->getFunction('message_exists')->getCallable(), ["exists", "info"])) {
            // line 24
            echo "    <div class=\"alert alert-info\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('message_pull')->getCallable(), ["pull", "info"]));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 29
                echo "            ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["message"]])]);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "    </div>
";
        }
        // line 33
        echo "
<!-- Warning Messages -->
";
        // line 35
        if (call_user_func_array($this->env->getFunction('message_exists')->getCallable(), ["exists", "warning"])) {
            // line 36
            echo "    <div class=\"alert alert-warning\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('message_pull')->getCallable(), ["pull", "warning"]));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 41
                echo "            ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["message"]])]);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "    </div>
";
        }
        // line 45
        echo "
<!-- Error Messages -->
";
        // line 47
        if (call_user_func_array($this->env->getFunction('message_exists')->getCallable(), ["exists", "error"])) {
            // line 48
            echo "    <div class=\"alert alert-danger\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        ";
            // line 52
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFunction('message_pull')->getCallable(), ["pull", "error"]));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 53
                echo "            ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [call_user_func_array($this->env->getFunction('trans')->getCallable(), [$context["message"]])]);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "theme::partials/messages";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 55,  165 => 53,  161 => 52,  155 => 48,  153 => 47,  149 => 45,  145 => 43,  136 => 41,  132 => 40,  126 => 36,  124 => 35,  120 => 33,  116 => 31,  107 => 29,  103 => 28,  97 => 24,  95 => 23,  91 => 21,  87 => 19,  78 => 17,  74 => 16,  68 => 12,  66 => 11,  62 => 9,  58 => 7,  49 => 5,  45 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!-- Important Messages -->
{% if message_exists('important') %}
    <div class=\"alert alert-danger\">
        {% for message in message_pull('important') %}
            {{ trans(message)|markdown }}
        {% endfor %}
    </div>
{% endif %}

<!-- Success Messages -->
{% if message_exists('success') %}
    <div class=\"alert alert-success\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        {% for message in message_pull('success') %}
            {{ trans(message)|markdown }}
        {% endfor %}
    </div>
{% endif %}

<!-- Informational Messages -->
{% if message_exists('info') %}
    <div class=\"alert alert-info\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        {% for message in message_pull('info') %}
            {{ trans(message)|markdown }}
        {% endfor %}
    </div>
{% endif %}

<!-- Warning Messages -->
{% if message_exists('warning') %}
    <div class=\"alert alert-warning\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        {% for message in message_pull('warning') %}
            {{ trans(message)|markdown }}
        {% endfor %}
    </div>
{% endif %}

<!-- Error Messages -->
{% if message_exists('error') %}
    <div class=\"alert alert-danger\" data-dismiss=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
            <span>&times;</span>
        </button>
        {% for message in message_pull('error') %}
            {{ trans(message)|markdown }}
        {% endfor %}
    </div>
{% endif %}
", "theme::partials/messages", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/messages.twig");
    }
}
