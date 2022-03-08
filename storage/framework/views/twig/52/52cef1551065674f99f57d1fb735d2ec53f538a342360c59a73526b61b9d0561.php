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

/* C:\wamp64\www\ocify\vendor\visiosoft\streams-platform\src\View\Command/../../../resources/views/partials/constants.twig */
class __TwigTemplate_b5b2cb38ee801a4aa617ccc2c805fbd32125a04542ba6a9ac8588b2e03fed9f7 extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<script type=\"text/javascript\">

    const APPLICATION_URL = \"";
        // line 3
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url')->getCallable(), []));
        echo "\";
    const APPLICATION_REFERENCE = \"";
        // line 4
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('env')->getCallable(), ["APPLICATION_REFERENCE"]), "html", null, true);
        echo "\";
    const APPLICATION_DOMAIN = \"";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('env')->getCallable(), ["APPLICATION_DOMAIN"]), "html", null, true);
        echo "\";

    const CSRF_TOKEN = \"";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('csrf_token')->getCallable(), ["token"]), "html", null, true);
        echo "\";
    const APP_DEBUG = \"";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('config_get')->getCallable(), ["get", "app.debug"]), "html", null, true);
        echo "\";
    const APP_URL = \"";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('config_get')->getCallable(), ["get", "app.url"]), "html", null, true);
        echo "\";
    const REQUEST_ROOT = \"";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('request_root')->getCallable(), ["root"]), "html", null, true);
        echo "\";
    const REQUEST_ROOT_PATH = \"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, parse_url(call_user_func_array($this->env->getFunction('request_root')->getCallable(), ["root"])), "path", [], "any", false, false, false, 11), "html", null, true);
        echo "\";
    const TIMEZONE = \"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('config_get')->getCallable(), ["get", "app.timezone"]), "html", null, true);
        echo "\";
    const LOCALE = \"";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('config_get')->getCallable(), ["get", "app.locale"]), "html", null, true);
        echo "\";
    
</script>
";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/constants.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  58 => 8,  54 => 7,  49 => 5,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<script type=\"text/javascript\">

    const APPLICATION_URL = \"{{ url()|escape }}\";
    const APPLICATION_REFERENCE = \"{{ env('APPLICATION_REFERENCE') }}\";
    const APPLICATION_DOMAIN = \"{{ env('APPLICATION_DOMAIN') }}\";

    const CSRF_TOKEN = \"{{ csrf_token() }}\";
    const APP_DEBUG = \"{{ config_get('app.debug') }}\";
    const APP_URL = \"{{ config_get('app.url') }}\";
    const REQUEST_ROOT = \"{{ request_root() }}\";
    const REQUEST_ROOT_PATH = \"{{ parse_url(request_root()).path }}\";
    const TIMEZONE = \"{{ config_get('app.timezone') }}\";
    const LOCALE = \"{{ config_get('app.locale') }}\";
    
</script>
", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/constants.twig", "C:\\wamp64\\www\\ocify\\vendor\\visiosoft\\streams-platform\\src\\View\\Command/../../../resources/views/partials/constants.twig");
    }
}
