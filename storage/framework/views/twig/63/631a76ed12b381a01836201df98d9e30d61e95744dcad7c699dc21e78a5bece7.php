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

/* C:\wamp64\www\ocify\vendor\visiosoft\streams-platform\src\View\Command/../../../resources/views/partials/favicons.twig */
class __TwigTemplate_e721171622d36eb2dbedc934f8be033a34ee7919c863e9e17665abe122e2f6b5 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 32, 1 => 32], "method", false, false, false, 1), "path", [], "any", false, false, false, 1), "html", null, true);
        echo "\"/>
<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 16, 1 => 16], "method", false, false, false, 2), "path", [], "any", false, false, false, 2), "html", null, true);
        echo "\" sizes=\"16x16\"/>
<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 32, 1 => 32], "method", false, false, false, 3), "path", [], "any", false, false, false, 3), "html", null, true);
        echo "\" sizes=\"32x32\"/>
<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 96, 1 => 96], "method", false, false, false, 4), "path", [], "any", false, false, false, 4), "html", null, true);
        echo "\" sizes=\"96x96\"/>
<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 128, 1 => 128], "method", false, false, false, 5), "path", [], "any", false, false, false, 5), "html", null, true);
        echo "\" sizes=\"128x128\"/>
<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 196, 1 => 196], "method", false, false, false, 6), "path", [], "any", false, false, false, 6), "html", null, true);
        echo "\" sizes=\"196x196\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"57x57\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 57, 1 => 57], "method", false, false, false, 7), "path", [], "any", false, false, false, 7), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"60x60\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 60, 1 => 60], "method", false, false, false, 8), "path", [], "any", false, false, false, 8), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 72, 1 => 72], "method", false, false, false, 9), "path", [], "any", false, false, false, 9), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"76x76\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 76, 1 => 76], "method", false, false, false, 10), "path", [], "any", false, false, false, 10), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 114, 1 => 114], "method", false, false, false, 11), "path", [], "any", false, false, false, 11), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"120x120\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 120, 1 => 120], "method", false, false, false, 12), "path", [], "any", false, false, false, 12), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 144, 1 => 144], "method", false, false, false, 13), "path", [], "any", false, false, false, 13), "html", null, true);
        echo "\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"152x152\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), [($context["source"] ?? null)]), "resize", [0 => 152, 1 => 152], "method", false, false, false, 14), "path", [], "any", false, false, false, 14), "html", null, true);
        echo "\"/>
";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/favicons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 14,  86 => 13,  82 => 12,  78 => 11,  74 => 10,  70 => 9,  66 => 8,  62 => 7,  58 => 6,  54 => 5,  50 => 4,  46 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<link rel=\"icon\" type=\"image/x-icon\" href=\"{{ img(source).resize(32, 32).path }}\"/>
<link rel=\"icon\" type=\"image/png\" href=\"{{ img(source).resize(16, 16).path }}\" sizes=\"16x16\"/>
<link rel=\"icon\" type=\"image/png\" href=\"{{ img(source).resize(32, 32).path }}\" sizes=\"32x32\"/>
<link rel=\"icon\" type=\"image/png\" href=\"{{ img(source).resize(96, 96).path }}\" sizes=\"96x96\"/>
<link rel=\"icon\" type=\"image/png\" href=\"{{ img(source).resize(128, 128).path }}\" sizes=\"128x128\"/>
<link rel=\"icon\" type=\"image/png\" href=\"{{ img(source).resize(196, 196).path }}\" sizes=\"196x196\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"57x57\" href=\"{{ img(source).resize(57, 57).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"60x60\" href=\"{{ img(source).resize(60, 60).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"{{ img(source).resize(72, 72).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"76x76\" href=\"{{ img(source).resize(76, 76).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"{{ img(source).resize(114, 114).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"120x120\" href=\"{{ img(source).resize(120, 120).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"{{ img(source).resize(144, 144).path }}\"/>
<link rel=\"apple-touch-icon-precomposed\" sizes=\"152x152\" href=\"{{ img(source).resize(152, 152).path }}\"/>
", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/favicons.twig", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/favicons.twig");
    }
}
