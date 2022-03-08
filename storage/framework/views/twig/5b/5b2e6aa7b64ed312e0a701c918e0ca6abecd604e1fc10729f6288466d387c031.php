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

/* theme::partials/modals */
class __TwigTemplate_5e4e33a959747ec64c02fc15c08aa20f0eb0272b1d6145dbfe1efc300af0d79b extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<div class=\"modal fade remote\" id=\"modal-small\">
    <div class=\"modal-dialog modal-sm\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal-large\">
    <div class=\"modal-dialog modal-lg\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal-wide\">
    <div class=\"modal-dialog modal-wide\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal\" id=\"modal-help\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">

            <div class=\"modal-header\">
                <button class=\"close\" data-dismiss=\"modal\">
                    <span>&times;</span>
                </button>
                <h4 class=\"modal-title\">
                    ";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.title"]), "html", null, true);
        echo "
                    <br>
                    <small>";
        // line 52
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.description"]), "html", null, true);
        echo "</small>
                </h4>
            </div>

            <div class=\"modal-body\">

                <ul class=\"nav nav-pills nav-stacked\">

                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/documentation\" class=\"nav-link\" target=\"_blank\">
                            <strong>";
        // line 62
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.documentation_link"]), "html", null, true);
        echo "</strong>
                            <br>
                            <small>";
        // line 64
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.documentation_description"]), "html", null, true);
        echo "</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/slack\" class=\"nav-link\" target=\"_blank\">
                            <strong>";
        // line 69
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.slack_link"]), "html", null, true);
        echo "</strong>
                            <br>
                            <small>";
        // line 71
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.slack_description"]), "html", null, true);
        echo "</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/forum\" class=\"nav-link\" target=\"_blank\">
                            <strong>";
        // line 76
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.forum_link"]), "html", null, true);
        echo "</strong>
                            <br>
                            <small>";
        // line 78
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.forum_description"]), "html", null, true);
        echo "</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/addons\" class=\"nav-link\" target=\"_blank\">
                            <strong>";
        // line 83
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.addons_link"]), "html", null, true);
        echo "</strong>
                            <br>
                            <small>";
        // line 85
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('trans')->getCallable(), ["visiosoft.theme.defaultadmin::help.addons_description"]), "html", null, true);
        echo "</small>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "theme::partials/modals";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 85,  145 => 83,  137 => 78,  132 => 76,  124 => 71,  119 => 69,  111 => 64,  106 => 62,  93 => 52,  88 => 50,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"modal fade remote\" id=\"modal-small\">
    <div class=\"modal-dialog modal-sm\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal-large\">
    <div class=\"modal-dialog modal-lg\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal remote\" id=\"modal-wide\">
    <div class=\"modal-dialog modal-wide\">
        <div class=\"modal-content\">
            <div class=\"modal-loading\">
                <div class=\"active loader large\"></div>
            </div>
        </div>
    </div>
</div>

<div class=\"modal\" id=\"modal-help\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">

            <div class=\"modal-header\">
                <button class=\"close\" data-dismiss=\"modal\">
                    <span>&times;</span>
                </button>
                <h4 class=\"modal-title\">
                    {{ trans('visiosoft.theme.defaultadmin::help.title') }}
                    <br>
                    <small>{{ trans('visiosoft.theme.defaultadmin::help.description') }}</small>
                </h4>
            </div>

            <div class=\"modal-body\">

                <ul class=\"nav nav-pills nav-stacked\">

                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/documentation\" class=\"nav-link\" target=\"_blank\">
                            <strong>{{ trans('visiosoft.theme.defaultadmin::help.documentation_link') }}</strong>
                            <br>
                            <small>{{ trans('visiosoft.theme.defaultadmin::help.documentation_description') }}</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/slack\" class=\"nav-link\" target=\"_blank\">
                            <strong>{{ trans('visiosoft.theme.defaultadmin::help.slack_link') }}</strong>
                            <br>
                            <small>{{ trans('visiosoft.theme.defaultadmin::help.slack_description') }}</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/forum\" class=\"nav-link\" target=\"_blank\">
                            <strong>{{ trans('visiosoft.theme.defaultadmin::help.forum_link') }}</strong>
                            <br>
                            <small>{{ trans('visiosoft.theme.defaultadmin::help.forum_description') }}</small>
                        </a>
                    </li>
                    <li class=\"nav-item\">
                        <a href=\"https://openclassify.com/addons\" class=\"nav-link\" target=\"_blank\">
                            <strong>{{ trans('visiosoft.theme.defaultadmin::help.addons_link') }}</strong>
                            <br>
                            <small>{{ trans('visiosoft.theme.defaultadmin::help.addons_description') }}</small>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>
", "theme::partials/modals", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/visiosoft/defaultadmin-theme/views//partials/modals.twig");
    }
}
