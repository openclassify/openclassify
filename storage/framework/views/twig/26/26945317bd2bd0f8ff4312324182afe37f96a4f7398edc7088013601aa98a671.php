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

/* theme::partials/footer */
class __TwigTemplate_5b6e9e2d383e3b83f4acbbc0840702f38c9997d2d91d7b8c0e7d645207b5ba58 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<section id=\"footer\">

    <ul class=\"meta\">
        <li class=\"copyright\">
            &copy; ";
        // line 5
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('setting_value')->getCallable(), ["visiosoft.theme.defaultadmin::footer_copyright_org_name"]), "html", null, true);
        echo "
        </li>
        <li class=\"footprint\">
            ";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('request_time')->getCallable(), []), "html", null, true);
        echo " <span>|</span> ";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('memory_usage')->getCallable(), []), "html", null, true);
        echo "
        </li>
    </ul>

    <ul class=\"extra\">
        <li class=\"language\">
            <select class=\"custom-select\" onchange=\"window.location = '?_locale=' + this.value;\">
                ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter(call_user_func_array($this->env->getFunction('config')->getCallable(), ["streams::locales.supported"])));
        foreach ($context['_seq'] as $context["_key"] => $context["iso"]) {
            // line 16
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["iso"], "html", null, true);
            echo "\" ";
            echo (((call_user_func_array($this->env->getFunction('config')->getCallable(), ["app.locale"]) == $context["iso"])) ? ("selected") : (""));
            echo ">
                        ";
            // line 17
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), [(("streams::locale." . $context["iso"]) . ".name")]), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, $context["iso"], "html", null, true);
            echo ")
                    </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['iso'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "            </select>
        </li>
";
        // line 27
        echo "    </ul>

</section>
";
    }

    public function getTemplateName()
    {
        return "theme::partials/footer";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 27,  85 => 20,  74 => 17,  67 => 16,  63 => 15,  51 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<section id=\"footer\">

    <ul class=\"meta\">
        <li class=\"copyright\">
            &copy; {{ 'now'|date('Y') }} {{ setting_value('visiosoft.theme.defaultadmin::footer_copyright_org_name') }}
        </li>
        <li class=\"footprint\">
            {{ request_time() }} <span>|</span> {{ memory_usage() }}
        </li>
    </ul>

    <ul class=\"extra\">
        <li class=\"language\">
            <select class=\"custom-select\" onchange=\"window.location = '?_locale=' + this.value;\">
                {% for iso in config('streams::locales.supported')|keys %}
                    <option value=\"{{ iso }}\" {{ config('app.locale') == iso ? 'selected' }}>
                        {{ trans('streams::locale.' ~ iso ~ '.name') }} ({{ iso }})
                    </option>
                {% endfor %}
            </select>
        </li>
{#        <li class=\"help\">#}
{#            <a class=\"btn btn-danger\" href=\"#\" data-toggle=\"modal\" data-target=\"#modal-help\">#}
{#                {{ icon('question-circle') }} {{ trans('visiosoft.theme.defaultadmin::control_panel.help') }}#}
{#            </a>#}
{#        </li>#}
    </ul>

</section>
", "theme::partials/footer", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/footer.twig");
    }
}
