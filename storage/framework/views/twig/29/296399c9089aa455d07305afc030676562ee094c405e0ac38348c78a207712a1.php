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

/* theme::partials/metadata */
class __TwigTemplate_8ba103afb0305d92da61092112264e101f87023e58a1aed96b5f6f2ebe736c5c extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<!-- Meta -->
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0\">

<title>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::control_panel.title"]), "html", null, true);
        echo "
    &#8250; ";
        // line 8
        echo call_user_func_array($this->env->getFunction('trans')->getCallable(), [twig_last($this->env, twig_get_array_keys_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "breadcrumbs", [], "any", false, false, false, 8), "all", [], "method", false, false, false, 8)))]);
        echo "</title>

";
        // line 11
        echo call_user_func_array($this->env->getFunction('favicons')->getCallable(), ["visiosoft.theme.defaultadmin::img/favicon.png"]);
        echo "

";
        // line 13
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.css", "visiosoft.theme.defaultadmin::css/fonts.css", [0 => "parse"]]);
        echo "
";
        // line 14
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.css", "visiosoft.theme.defaultadmin::css/bootstrap.css"]);
        echo "
";
        // line 15
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.css", "visiosoft.theme.defaultadmin::css/select2.css"]);
        echo "
";
        // line 16
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.css", "visiosoft.theme.base::css/intlTelInput.css"]);
        echo "


";
        // line 19
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "build.css", "visiosoft.theme.defaultadmin::css/theme.css", [0 => "required", 1 => "as:t4t5/sweetalert.css", 2 => "as:jshjohnson/Choices.css", 3 => "as:rstacruz/nprogress.css"]]);
        // line 28
        echo "

";
        // line 30
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.defaultadmin::js/vendor/*"]);
        echo "
";
        // line 31
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.defaultadmin::js/theme/polyfills.js"]);
        echo "
";
        // line 32
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.defaultadmin::js/libraries/tether.min.js"]);
        echo "

";
        // line 34
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.defaultadmin::js/libraries/*", [0 => "required", 1 => "as:t4t5/sweetalert.js", 2 => "as:RubaXa/Sortable.js", 3 => "as:jshjohnson/Choices.js", 4 => "as:rstacruz/nprogress.js", 5 => "as:js-cookie/js-cookie.js", 6 => "as:ccampbell/mousetrap.js"]]);
        // line 46
        echo "

";
        // line 49
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/ajax.js"]);
        echo "
";
        // line 50
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/confirm.js"]);
        echo "
";
        // line 51
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/initialize.js"]);
        echo "
";
        // line 52
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/keyboard.js"]);
        echo "
";
        // line 53
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/modal.js"]);
        echo "
";
        // line 54
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/prompt.js"]);
        echo "
";
        // line 55
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/push.js"]);
        echo "
";
        // line 56
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/search.js"]);
        echo "
";
        // line 57
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/select2.js"]);
        echo "
";
        // line 58
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "scripts.js", "visiosoft.theme.defaultadmin::js/theme/alert.js"]);
        echo "
";
        // line 59
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.base::js/jquery.maskedinput.js"]);
        echo "
";
        // line 60
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.base::js/intlTelInput.min.js"]);
        echo "
";
        // line 61
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.base::js/utils.js"]);
        echo "
";
        // line 62
        echo call_user_func_array($this->env->getFunction('asset_add')->getCallable(), ["add", "theme.js", "visiosoft.theme.base::js/phonefield.js"]);
        echo "
";
        // line 63
        echo call_user_func_array($this->env->getFunction('asset_script')->getCallable(), ["script", "visiosoft.theme.defaultadmin::js/visiosoft.js"]);
        echo "
<style type=\"text/css\">
    ";
        // line 65
        echo call_user_func_array($this->env->getFunction('asset_inline')->getCallable(), ["inline", "theme.css"]);
        echo "
    ";
        // line 66
        echo call_user_func_array($this->env->getFunction('asset_inline')->getCallable(), ["inline", "build.css"]);
        echo "
    ";
        // line 67
        if (call_user_func_array($this->env->getFunction('setting_value')->getCallable(), ["visiosoft.theme.defaultadmin::dark_mode"])) {
            // line 68
            echo "    /*Dark mode is active*/
    ";
            // line 69
            echo call_user_func_array($this->env->getFunction('asset_inline')->getCallable(), ["inline", "visiosoft.theme.defaultadmin::css/dark_mode.css"]);
            echo "
    ";
        }
        // line 71
        echo "</style>

";
        // line 73
        if (twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('locale')->getCallable(), []), "isRtl", [], "method", false, false, false, 73)) {
            // line 74
            echo "    <style type=\"text/css\">
        ";
            // line 75
            echo call_user_func_array($this->env->getFunction('asset_inline')->getCallable(), ["inline", "visiosoft.theme.defaultadmin::css/bootstrap.rtl.css"]);
            echo "
        ";
            // line 76
            echo call_user_func_array($this->env->getFunction('asset_inline')->getCallable(), ["inline", "visiosoft.theme.defaultadmin::css/rtl.css"]);
            echo "
    </style>
";
        }
        // line 79
        echo "
";
        // line 80
        echo call_user_func_array($this->env->getFunction('constants')->getCallable(), []);
        echo "

";
        // line 82
        echo call_user_func_array($this->env->getFunction('asset_script')->getCallable(), ["script", "theme.js"]);
        echo "
";
        // line 83
        echo call_user_func_array($this->env->getFunction('asset_script')->getCallable(), ["script", "visiosoft.js"]);
    }

    public function getTemplateName()
    {
        return "theme::partials/metadata";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 83,  208 => 82,  203 => 80,  200 => 79,  194 => 76,  190 => 75,  187 => 74,  185 => 73,  181 => 71,  176 => 69,  173 => 68,  171 => 67,  167 => 66,  163 => 65,  158 => 63,  154 => 62,  150 => 61,  146 => 60,  142 => 59,  138 => 58,  134 => 57,  130 => 56,  126 => 55,  122 => 54,  118 => 53,  114 => 52,  110 => 51,  106 => 50,  102 => 49,  98 => 46,  96 => 34,  91 => 32,  87 => 31,  83 => 30,  79 => 28,  77 => 19,  71 => 16,  67 => 15,  63 => 14,  59 => 13,  54 => 11,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!-- Meta -->
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0\">

<title>{{ trans('visiosoft.theme.defaultadmin::control_panel.title') }}
    &#8250; {{ trans(template.breadcrumbs.all()|keys|last)|raw }}</title>

{# Favicons #}
{{ favicons(\"visiosoft.theme.defaultadmin::img/favicon.png\") }}

{{ asset_add(\"theme.css\", \"visiosoft.theme.defaultadmin::css/fonts.css\", [\"parse\"]) }}
{{ asset_add(\"theme.css\", \"visiosoft.theme.defaultadmin::css/bootstrap.css\") }}
{{ asset_add(\"theme.css\", \"visiosoft.theme.defaultadmin::css/select2.css\") }}
{{ asset_add(\"theme.css\", \"visiosoft.theme.base::css/intlTelInput.css\") }}


{{ asset_add(
    \"build.css\",
    \"visiosoft.theme.defaultadmin::css/theme.css\",
    [
        \"required\",
        \"as:t4t5/sweetalert.css\",
        \"as:jshjohnson/Choices.css\",
        \"as:rstacruz/nprogress.css\",
    ]
) }}

{{ asset_add(\"theme.js\", \"visiosoft.theme.defaultadmin::js/vendor/*\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.defaultadmin::js/theme/polyfills.js\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.defaultadmin::js/libraries/tether.min.js\") }}

{{ asset_add(
    \"theme.js\",
    \"visiosoft.theme.defaultadmin::js/libraries/*\",
    [
        \"required\",
        \"as:t4t5/sweetalert.js\",
        \"as:RubaXa/Sortable.js\",
        \"as:jshjohnson/Choices.js\",
        \"as:rstacruz/nprogress.js\",
        \"as:js-cookie/js-cookie.js\",
        \"as:ccampbell/mousetrap.js\",
    ]
) }}

{# Need to figure out globing to scripts.js - ends up with a /* file #}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/ajax.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/confirm.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/initialize.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/keyboard.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/modal.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/prompt.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/push.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/search.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/select2.js\") }}
{{ asset_add(\"scripts.js\", \"visiosoft.theme.defaultadmin::js/theme/alert.js\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.base::js/jquery.maskedinput.js\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.base::js/intlTelInput.min.js\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.base::js/utils.js\") }}
{{ asset_add(\"theme.js\", \"visiosoft.theme.base::js/phonefield.js\") }}
{{ asset_script('visiosoft.theme.defaultadmin::js/visiosoft.js') }}
<style type=\"text/css\">
    {{ asset_inline(\"theme.css\") }}
    {{ asset_inline(\"build.css\") }}
    {% if setting_value('visiosoft.theme.defaultadmin::dark_mode') %}
    /*Dark mode is active*/
    {{ asset_inline(\"visiosoft.theme.defaultadmin::css/dark_mode.css\") }}
    {% endif %}
</style>

{% if locale().isRtl() %}
    <style type=\"text/css\">
        {{ asset_inline(\"visiosoft.theme.defaultadmin::css/bootstrap.rtl.css\") }}
        {{ asset_inline(\"visiosoft.theme.defaultadmin::css/rtl.css\") }}
    </style>
{% endif %}

{{ constants() }}

{{ asset_script(\"theme.js\") }}
{{ asset_script(\"visiosoft.js\") }}", "theme::partials/metadata", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/metadata.twig");
    }
}
