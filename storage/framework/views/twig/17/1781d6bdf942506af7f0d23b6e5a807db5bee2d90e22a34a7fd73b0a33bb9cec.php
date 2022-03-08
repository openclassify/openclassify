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

/* C:\wamp64\www\ocify\resources\default\addons/anomaly/dashboard-module/views//admin/widgets/widget.twig */
class __TwigTemplate_ad20fd6c4f28080f32691b32bf1380381ff5396bdb4059bbcbcb960d746b4f0c extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "<div class=\"widget card\" data-id=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "id", [], "any", false, false, false, 1), "html", null, true);
        echo "\">

    <div class=\"";
        // line 3
        echo ((twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "sortable", [], "any", false, false, false, 3)) ? ("handle") : (""));
        echo " card-header\">
        <h5 class=\"card-title\">

            ";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "title", [], "any", false, false, false, 6), "html", null, true);
        echo "

            ";
        // line 8
        if (twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "description", [], "any", false, false, false, 8)) {
            // line 9
            echo "
                <br>

                <small>
                    ";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "description", [], "any", false, false, false, 13), "html", null, true);
            echo "
                </small>
            ";
        }
        // line 16
        echo "        </h5>
    </div>

    <div class=\"card-block\">
        ";
        // line 20
        echo twig_get_attribute($this->env, $this->source, ($context["widget"] ?? null), "content", [], "any", false, false, false, 20);
        echo "
    </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/widgets/widget.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 20,  68 => 16,  62 => 13,  56 => 9,  54 => 8,  49 => 6,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"widget card\" data-id=\"{{ widget.id }}\">

    <div class=\"{{ widget.sortable ? 'handle' }} card-header\">
        <h5 class=\"card-title\">

            {{ widget.title }}

            {% if widget.description %}

                <br>

                <small>
                    {{ widget.description }}
                </small>
            {% endif %}
        </h5>
    </div>

    <div class=\"card-block\">
        {{ widget.content|raw }}
    </div>

</div>
", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/widgets/widget.twig", "C:\\wamp64\\www\\ocify\\resources\\default\\addons/anomaly/dashboard-module/views//admin/widgets/widget.twig");
    }
}
