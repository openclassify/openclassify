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

/* visiosoft.theme.defaultadmin::partials/topbar */
class __TwigTemplate_ac0cffe4bb1d9950b854cd76370d0a226677b3e0931684be058f227cc2a0795d extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<div class=\"container-fluid mx-0 px-0\">
    <div class=\"row mx-0 px-0\">
        <div class=\"col-xs-24 mx-0 px-0\">
            ";
        // line 4
        $context["name"] = ((twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "first_name", [], "any", false, false, false, 4) . " ") . twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "last_name", [], "any", false, false, false, 4));
        // line 5
        echo "            ";
        if ((twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "first_name", [], "any", false, false, false, 5) && twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "last_name", [], "any", false, false, false, 5))) {
            // line 6
            echo "                ";
            $context["name"] = twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "username", [], "any", false, false, false, 6);
            // line 7
            echo "            ";
        }
        // line 8
        echo "            <div class=\"top-bar\">
                <div class=\"topbar-breadcrumb\">";
        // line 9
        echo call_user_func_array($this->env->getFunction('breadcrumb')->getCallable(), []);
        echo "</div>
                <div class=\"topbar-useraction\">
                    <ul class=\"nav navbar-nav\">
                        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["template"] ?? null), "cp", [], "any", false, false, false, 12), "shortcuts", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["shortcut"]) {
            // line 13
            echo "                            <li class=\"nav-item shortcut ";
            echo "\">
                                <a ";
            // line 14
            echo call_user_func_array($this->env->getFunction('html_attributes')->getCallable(), ["attributes", twig_get_attribute($this->env, $this->source, $context["shortcut"], "attributes", [], "any", false, false, false, 14)]);
            echo " ";
            echo ">
                                    ";
            // line 16
            echo "                                    ";
            echo call_user_func_array($this->env->getFunction('icon')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["shortcut"], "icon", [], "any", false, false, false, 16)]);
            echo "
                                </a>
                                ";
            // line 19
            echo "                                ";
            // line 20
            echo "                                ";
            // line 21
            echo "                                ";
            // line 22
            echo "                                ";
            // line 23
            echo "                                ";
            // line 24
            echo "                                ";
            // line 25
            echo "                                ";
            // line 26
            echo "                                ";
            // line 27
            echo "                                ";
            // line 28
            echo "                                ";
            // line 29
            echo "                                ";
            // line 30
            echo "                                ";
            // line 31
            echo "                                ";
            // line 32
            echo "                            </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['shortcut'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "                        ";
        echo call_user_func_array($this->env->getFunction('addBlock')->getCallable(), ["admin/topbar"]);
        echo "
                        <li class=\"nav-item dropdown floatright\">

                            <a href=\"javascript:void(0);\" data-toggle=\"dropdown\">
                                <button class=\"btn user-action-dropdown dropdown-toggle none-border\">
                                    ";
        // line 39
        echo ($context["name"] ?? null);
        echo "
                                </button>
                            </a>
                            <img src=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('user')->getCallable(), []), "gravatar", [], "any", false, false, false, 42), "path", [], "any", false, false, false, 42), "html", null, true);
        echo "\" width=\"47\" class=\"rounded-circle\">
                            <ul class=\"dropdown-menu-right dropdown-menu\">
                                <li class=\"dropdown-item\">
                                    <a href=\"/\" target=\"_blank\">
                                        <i class=\"fa fa-external-link\"></i>
                                        ";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["theme::control_panel.view_site"]), "html", null, true);
        echo "
                                    </a>
                                </li>
                                <li class=\"dropdown-item\">
                                    <a href=\"/admin/logout\">
                                        <i class=\"fa fa-power-off\"></i>
                                        ";
        // line 53
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["theme::control_panel.logout"]), "html", null, true);
        echo "
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "visiosoft.theme.defaultadmin::partials/topbar";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 53,  137 => 47,  129 => 42,  123 => 39,  114 => 34,  107 => 32,  105 => 31,  103 => 30,  101 => 29,  99 => 28,  97 => 27,  95 => 26,  93 => 25,  91 => 24,  89 => 23,  87 => 22,  85 => 21,  83 => 20,  81 => 19,  75 => 16,  70 => 14,  66 => 13,  62 => 12,  56 => 9,  53 => 8,  50 => 7,  47 => 6,  44 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container-fluid mx-0 px-0\">
    <div class=\"row mx-0 px-0\">
        <div class=\"col-xs-24 mx-0 px-0\">
            {% set name = user().first_name ~' '~ user().last_name %}
            {% if (user().first_name and user().last_name) %}
                {% set name = user().username %}
            {% endif %}
            <div class=\"top-bar\">
                <div class=\"topbar-breadcrumb\">{{ breadcrumb() }}</div>
                <div class=\"topbar-useraction\">
                    <ul class=\"nav navbar-nav\">
                        {% for shortcut in template.cp.shortcuts %}
                            <li class=\"nav-item shortcut {# dropdown #}\">
                                <a {{ html_attributes(shortcut.attributes) }} {# data-toggle=\"dropdown\" #}>
                                    {# <span class=\"tag tag-danger\">{{ icon(shortcut.icon) }} 2</span> #}
                                    {{ icon(shortcut.icon) }}
                                </a>
                                {# <ul class=\"dropdown-menu-right dropdown-menu\"> #}
                                {# <li class=\"dropdown-item\"> #}
                                {# <a href=\"/\" target=\"_blank\"> #}
                                {# <i class=\"fa fa-external-link\"></i> #}
                                {# {{ trans('theme::control_panel.view_site') }} #}
                                {# </a> #}
                                {# </li> #}
                                {# <li class=\"dropdown-item\"> #}
                                {# <a href=\"/admin/logout\"> #}
                                {# <i class=\"fa fa-power-off\"></i> #}
                                {# {{ trans('theme::control_panel.logout') }} #}
                                {# </a> #}
                                {# </li> #}
                                {# </ul> #}
                            </li>
                        {% endfor %}
                        {{ addBlock('admin/topbar')|raw }}
                        <li class=\"nav-item dropdown floatright\">

                            <a href=\"javascript:void(0);\" data-toggle=\"dropdown\">
                                <button class=\"btn user-action-dropdown dropdown-toggle none-border\">
                                    {{ name|raw }}
                                </button>
                            </a>
                            <img src=\"{{ user().gravatar.path }}\" width=\"47\" class=\"rounded-circle\">
                            <ul class=\"dropdown-menu-right dropdown-menu\">
                                <li class=\"dropdown-item\">
                                    <a href=\"/\" target=\"_blank\">
                                        <i class=\"fa fa-external-link\"></i>
                                        {{ trans('theme::control_panel.view_site') }}
                                    </a>
                                </li>
                                <li class=\"dropdown-item\">
                                    <a href=\"/admin/logout\">
                                        <i class=\"fa fa-power-off\"></i>
                                        {{ trans('theme::control_panel.logout') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>", "visiosoft.theme.defaultadmin::partials/topbar", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/topbar.twig");
    }
}
