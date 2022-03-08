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

/* C:\wamp64\www\ocify\storage\streams\default/support/parsed/8b2201ad47a106f2e77f6ff8b9c41577.twig */
class __TwigTemplate_d6126c9009624a1c46340142ca7c221ae7d033e0744c77042f184478376b272b extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "#dashboard .columns {
  min-height: 100%;
}

#dashboard .columns .column .placeholder {
  width: 100%;
  margin-bottom: 9px;
  display: inline-block;
  border-radius: 0.17rem;
  border: 2px dashed #55595c;
}

#dashboard .columns .column .widget.dragged {
  opacity: 0.5;
  z-index: 2001;
}

#dashboard .columns .column .widget .handle {
  cursor: move;
}

";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8b2201ad47a106f2e77f6ff8b9c41577.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("#dashboard .columns {
  min-height: 100%;
}

#dashboard .columns .column .placeholder {
  width: 100%;
  margin-bottom: 9px;
  display: inline-block;
  border-radius: 0.17rem;
  border: 2px dashed #55595c;
}

#dashboard .columns .column .widget.dragged {
  opacity: 0.5;
  z-index: 2001;
}

#dashboard .columns .column .widget .handle {
  cursor: move;
}

", "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8b2201ad47a106f2e77f6ff8b9c41577.twig", "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8b2201ad47a106f2e77f6ff8b9c41577.twig");
    }
}
