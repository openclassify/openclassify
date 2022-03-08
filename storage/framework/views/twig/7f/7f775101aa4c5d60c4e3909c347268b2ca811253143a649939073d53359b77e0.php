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

/* C:\wamp64\www\ocify\storage\streams\default/support/parsed/8d97feb171916a9b4b75d22f6a3de8e4.twig */
class __TwigTemplate_a67f8b37576c67dd9bad34a70361afb626ef867234601803a0da956f3f6dca2e extends \Anomaly\Streams\Platform\View\Twig\Template
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
        echo "@charset \"UTF-8\";
@font-face {
  font-family: \"Glyphicons Regular\";
  src: url('";
        // line 4
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.eot"]);
        echo "');
  src: url('";
        // line 5
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.eot"]);
        echo "?#iefix') format(\"embedded-opentype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.woff2"]);
        echo "') format(\"woff2\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.woff"]);
        echo "') format(\"woff\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.ttf"]);
        echo "') format(\"truetype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-regular.svg"]);
        echo "#glyphiconsregular') format(\"svg\");
}
@font-face {
  font-family: \"Glyphicons Filetypes\";
  src: url('";
        // line 9
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.eot"]);
        echo "');
  src: url('";
        // line 10
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.eot"]);
        echo "?#iefix') format(\"embedded-opentype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.woff2"]);
        echo "') format(\"woff2\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.woff"]);
        echo "') format(\"woff\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.ttf"]);
        echo "') format(\"truetype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/glyphicons/glyphicons-filetypes-regular.svg"]);
        echo "#glyphicons_filetypesregular') format(\"svg\");
}
.filetypes {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: \"Glyphicons Filetypes\";
  font-style: normal;
  font-weight: normal;
  vertical-align: top;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.filetypes.x05 {
  font-size: 12px;
}

.filetypes.x2 {
  font-size: 48px;
}

.filetypes.x3 {
  font-size: 72px;
}

.filetypes.x4 {
  font-size: 96px;
}

.filetypes.x5 {
  font-size: 120px;
}

.filetypes.light:before {
  color: #f2f2f2;
}

.filetypes.drop:before {
  text-shadow: -1px 1px 3px rgba(0, 0, 0, 0.3);
}

.filetypes.flip {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  -webkit-filter: FlipH;
          filter: FlipH;
  -ms-filter: \"FlipH\";
}

.filetypes.flipv {
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  -webkit-filter: FlipV;
          filter: FlipV;
  -ms-filter: \"FlipV\";
}

.filetypes.rotate90 {
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.filetypes.rotate180 {
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.filetypes.rotate270 {
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.filetypes-txt:before {
  content: \"\\E001\";
}

.filetypes-doc:before {
  content: \"\\E002\";
}

.filetypes-rtf:before {
  content: \"\\E003\";
}

.filetypes-log:before {
  content: \"\\E004\";
}

.filetypes-tex:before {
  content: \"\\E005\";
}

.filetypes-msg:before {
  content: \"\\E006\";
}

.filetypes-text:before {
  content: \"\\E007\";
}

.filetypes-wpd:before {
  content: \"\\E008\";
}

.filetypes-wps:before {
  content: \"\\E009\";
}

.filetypes-docx:before {
  content: \"\\E010\";
}

.filetypes-page:before {
  content: \"\\E011\";
}

.filetypes-csv:before {
  content: \"\\E012\";
}

.filetypes-dat:before {
  content: \"\\E013\";
}

.filetypes-tar:before {
  content: \"\\E014\";
}

.filetypes-xml:before {
  content: \"\\E015\";
}

.filetypes-vcf:before {
  content: \"\\E016\";
}

.filetypes-pps:before {
  content: \"\\E017\";
}

.filetypes-key:before {
  content: \"\\E018\";
}

.filetypes-ppt:before {
  content: \"\\E019\";
}

.filetypes-pptx:before {
  content: \"\\E020\";
}

.filetypes-sdf:before {
  content: \"\\E021\";
}

.filetypes-gbr:before {
  content: \"\\E022\";
}

.filetypes-ged:before {
  content: \"\\E023\";
}

.filetypes-mp3:before {
  content: \"\\E024\";
}

.filetypes-m4a:before {
  content: \"\\E025\";
}

.filetypes-waw:before {
  content: \"\\E026\";
}

.filetypes-wma:before {
  content: \"\\E027\";
}

.filetypes-mpa:before {
  content: \"\\E028\";
}

.filetypes-iff:before {
  content: \"\\E029\";
}

.filetypes-aif:before {
  content: \"\\E030\";
}

.filetypes-ra:before {
  content: \"\\E031\";
}

.filetypes-mid:before {
  content: \"\\E032\";
}

.filetypes-m3v:before {
  content: \"\\E033\";
}

.filetypes-e-3gp:before {
  content: \"\\E034\";
}

.filetypes-swf:before {
  content: \"\\E035\";
}

.filetypes-avi:before {
  content: \"\\E036\";
}

.filetypes-asx:before {
  content: \"\\E037\";
}

.filetypes-mp4:before {
  content: \"\\E038\";
}

.filetypes-e-3g2:before {
  content: \"\\E039\";
}

.filetypes-mpg:before {
  content: \"\\E040\";
}

.filetypes-asf:before {
  content: \"\\E041\";
}

.filetypes-vob:before {
  content: \"\\E042\";
}

.filetypes-wmv:before {
  content: \"\\E043\";
}

.filetypes-mov:before {
  content: \"\\E044\";
}

.filetypes-srt:before {
  content: \"\\E045\";
}

.filetypes-m4v:before {
  content: \"\\E046\";
}

.filetypes-flv:before {
  content: \"\\E047\";
}

.filetypes-rm:before {
  content: \"\\E048\";
}

.filetypes-png:before {
  content: \"\\E049\";
}

.filetypes-psd:before {
  content: \"\\E050\";
}

.filetypes-psp:before {
  content: \"\\E051\";
}

.filetypes-jpg:before {
  content: \"\\E052\";
}

.filetypes-tif:before {
  content: \"\\E053\";
}

.filetypes-tiff:before {
  content: \"\\E054\";
}

.filetypes-gif:before {
  content: \"\\E055\";
}

.filetypes-bmp:before {
  content: \"\\E056\";
}

.filetypes-tga:before {
  content: \"\\E057\";
}

.filetypes-thm:before {
  content: \"\\E058\";
}

.filetypes-yuv:before {
  content: \"\\E059\";
}

.filetypes-dds:before {
  content: \"\\E060\";
}

.filetypes-ai:before {
  content: \"\\E061\";
}

.filetypes-eps:before {
  content: \"\\E062\";
}

.filetypes-ps:before {
  content: \"\\E063\";
}

.filetypes-svg:before {
  content: \"\\E064\";
}

.filetypes-pdf:before {
  content: \"\\E065\";
}

.filetypes-pct:before {
  content: \"\\E066\";
}

.filetypes-indd:before {
  content: \"\\E067\";
}

.filetypes-xlr:before {
  content: \"\\E068\";
}

.filetypes-xls:before {
  content: \"\\E069\";
}

.filetypes-xlsx:before {
  content: \"\\E070\";
}

.filetypes-db:before {
  content: \"\\E071\";
}

.filetypes-dbf:before {
  content: \"\\E072\";
}

.filetypes-mdb:before {
  content: \"\\E073\";
}

.filetypes-pdb:before {
  content: \"\\E074\";
}

.filetypes-sql:before {
  content: \"\\E075\";
}

.filetypes-aacd:before {
  content: \"\\E076\";
}

.filetypes-app:before {
  content: \"\\E077\";
}

.filetypes-exe:before {
  content: \"\\E078\";
}

.filetypes-com:before {
  content: \"\\E079\";
}

.filetypes-bat:before {
  content: \"\\E080\";
}

.filetypes-apk:before {
  content: \"\\E081\";
}

.filetypes-jar:before {
  content: \"\\E082\";
}

.filetypes-hsf:before {
  content: \"\\E083\";
}

.filetypes-pif:before {
  content: \"\\E084\";
}

.filetypes-vb:before {
  content: \"\\E085\";
}

.filetypes-cgi:before {
  content: \"\\E086\";
}

.filetypes-css:before {
  content: \"\\E087\";
}

.filetypes-js:before {
  content: \"\\E088\";
}

.filetypes-php:before {
  content: \"\\E089\";
}

.filetypes-xhtml:before {
  content: \"\\E090\";
}

.filetypes-htm:before {
  content: \"\\E091\";
}

.filetypes-html:before {
  content: \"\\E092\";
}

.filetypes-asp:before {
  content: \"\\E093\";
}

.filetypes-cer:before {
  content: \"\\E094\";
}

.filetypes-jsp:before {
  content: \"\\E095\";
}

.filetypes-cfm:before {
  content: \"\\E096\";
}

.filetypes-aspx:before {
  content: \"\\E097\";
}

.filetypes-rss:before {
  content: \"\\E098\";
}

.filetypes-csr:before {
  content: \"\\E099\";
}

.filetypes-less:before {
  content: \"<\";
}

.filetypes-otf:before {
  content: \"\\E101\";
}

.filetypes-ttf:before {
  content: \"\\E102\";
}

.filetypes-font:before {
  content: \"\\E103\";
}

.filetypes-fnt:before {
  content: \"\\E104\";
}

.filetypes-eot:before {
  content: \"\\E105\";
}

.filetypes-woff:before {
  content: \"\\E106\";
}

.filetypes-zip:before {
  content: \"\\E107\";
}

.filetypes-zipx:before {
  content: \"\\E108\";
}

.filetypes-rar:before {
  content: \"\\E109\";
}

.filetypes-targ:before {
  content: \"\\E110\";
}

.filetypes-sitx:before {
  content: \"\\E111\";
}

.filetypes-deb:before {
  content: \"\\E112\";
}

.filetypes-e-7z:before {
  content: \"\\E113\";
}

.filetypes-pkg:before {
  content: \"\\E114\";
}

.filetypes-rpm:before {
  content: \"\\E115\";
}

.filetypes-cbr:before {
  content: \"\\E116\";
}

.filetypes-gz:before {
  content: \"\\E117\";
}

.filetypes-dmg:before {
  content: \"\\E118\";
}

.filetypes-cue:before {
  content: \"\\E119\";
}

.filetypes-bin:before {
  content: \"\\E120\";
}

.filetypes-iso:before {
  content: \"\\E121\";
}

.filetypes-hdf:before {
  content: \"\\E122\";
}

.filetypes-vcd:before {
  content: \"\\E123\";
}

.filetypes-bak:before {
  content: \"\\E124\";
}

.filetypes-tmp:before {
  content: \"\\E125\";
}

.filetypes-ics:before {
  content: \"\\E126\";
}

.filetypes-msi:before {
  content: \"\\E127\";
}

.filetypes-cfg:before {
  content: \"\\E128\";
}

.filetypes-ini:before {
  content: \"\\E129\";
}

.filetypes-prf:before {
  content: \"\\E130\";
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
  }
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

@-webkit-keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}
@keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(-200deg);
            transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(0);
            transform: rotate(0);
    opacity: 1;
  }
}
.rotateIn {
  -webkit-animation-name: rotateIn;
  animation-name: rotateIn;
}

@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
            transform: translateY(-15px);
  }
}
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
}

@-webkit-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
  }
  20% {
    -webkit-transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
            transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
            transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}

@-webkit-keyframes tada {
  0% {
    -webkit-transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
  }
}
@keyframes tada {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
  }
}
.tada {
  -webkit-animation-name: tada;
  animation-name: tada;
}

.glyphicons {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: \"Glyphicons Regular\";
  font-style: normal;
  font-weight: normal;
  vertical-align: top;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.glyphicons.x05 {
  font-size: 12px;
}

.glyphicons.x2 {
  font-size: 48px;
}

.glyphicons.x3 {
  font-size: 72px;
}

.glyphicons.x4 {
  font-size: 96px;
}

.glyphicons.x5 {
  font-size: 120px;
}

.glyphicons.light:before {
  color: #f2f2f2;
}

.glyphicons.drop:before {
  text-shadow: -1px 1px 3px rgba(0, 0, 0, 0.3);
}

.glyphicons.flip {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  -webkit-filter: FlipH;
          filter: FlipH;
  -ms-filter: \"FlipH\";
}

.glyphicons.flipv {
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  -webkit-filter: FlipV;
          filter: FlipV;
  -ms-filter: \"FlipV\";
}

.glyphicons.rotate90 {
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.glyphicons.rotate180 {
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.glyphicons.rotate270 {
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.glyphicons-glass:before {
  content: \"\\E001\";
}

.glyphicons-leaf:before {
  content: \"\\E002\";
}

.glyphicons-dog:before {
  content: \"\\E003\";
}

.glyphicons-user:before {
  content: \"\\E004\";
}

.glyphicons-girl:before {
  content: \"\\E005\";
}

.glyphicons-car:before {
  content: \"\\E006\";
}

.glyphicons-user-add:before {
  content: \"\\E007\";
}

.glyphicons-user-remove:before {
  content: \"\\E008\";
}

.glyphicons-film:before {
  content: \"\\E009\";
}

.glyphicons-magic:before {
  content: \"\\E010\";
}

.glyphicons-envelope:before {
  content: \"\\2709\";
}

.glyphicons-camera:before {
  content: \"\\E011\";
}

.glyphicons-heart:before {
  content: \"\\E013\";
}

.glyphicons-beach-umbrella:before {
  content: \"\\E014\";
}

.glyphicons-train:before {
  content: \"\\E015\";
}

.glyphicons-print:before {
  content: \"\\E016\";
}

.glyphicons-bin:before {
  content: \"\\E017\";
}

.glyphicons-music:before {
  content: \"\\E018\";
}

.glyphicons-note:before {
  content: \"\\E019\";
}

.glyphicons-heart-empty:before {
  content: \"\\E020\";
}

.glyphicons-home:before {
  content: \"\\E021\";
}

.glyphicons-snowflake:before {
  content: \"\\2744\";
}

.glyphicons-fire:before {
  content: \"\\E023\";
}

.glyphicons-magnet:before {
  content: \"\\E024\";
}

.glyphicons-parents:before {
  content: \"\\E025\";
}

.glyphicons-binoculars:before {
  content: \"\\E026\";
}

.glyphicons-road:before {
  content: \"\\E027\";
}

.glyphicons-search:before {
  content: \"\\E028\";
}

.glyphicons-cars:before {
  content: \"\\E029\";
}

.glyphicons-notes-2:before {
  content: \"\\E030\";
}

.glyphicons-pencil:before {
  content: \"\\270F\";
}

.glyphicons-bus:before {
  content: \"\\E032\";
}

.glyphicons-wifi-alt:before {
  content: \"\\E033\";
}

.glyphicons-luggage:before {
  content: \"\\E034\";
}

.glyphicons-old-man:before {
  content: \"\\E035\";
}

.glyphicons-woman:before {
  content: \"\\E036\";
}

.glyphicons-file:before {
  content: \"\\E037\";
}

.glyphicons-coins:before {
  content: \"\\E038\";
}

.glyphicons-airplane:before {
  content: \"\\2708\";
}

.glyphicons-notes:before {
  content: \"\\E040\";
}

.glyphicons-stats:before {
  content: \"\\E041\";
}

.glyphicons-charts:before {
  content: \"\\E042\";
}

.glyphicons-pie-chart:before {
  content: \"\\E043\";
}

.glyphicons-group:before {
  content: \"\\E044\";
}

.glyphicons-keys:before {
  content: \"\\E045\";
}

.glyphicons-calendar:before {
  content: \"\\E046\";
}

.glyphicons-router:before {
  content: \"\\E047\";
}

.glyphicons-camera-small:before {
  content: \"\\E048\";
}

.glyphicons-star-empty:before {
  content: \"\\E049\";
}

.glyphicons-star:before {
  content: \"\\E050\";
}

.glyphicons-link:before {
  content: \"\\E051\";
}

.glyphicons-eye-open:before {
  content: \"\\E052\";
}

.glyphicons-eye-close:before {
  content: \"\\E053\";
}

.glyphicons-alarm:before {
  content: \"\\E054\";
}

.glyphicons-clock:before {
  content: \"\\E055\";
}

.glyphicons-stopwatch:before {
  content: \"\\E056\";
}

.glyphicons-projector:before {
  content: \"\\E057\";
}

.glyphicons-history:before {
  content: \"\\E058\";
}

.glyphicons-truck:before {
  content: \"\\E059\";
}

.glyphicons-cargo:before {
  content: \"\\E060\";
}

.glyphicons-compass:before {
  content: \"\\E061\";
}

.glyphicons-keynote:before {
  content: \"\\E062\";
}

.glyphicons-paperclip:before {
  content: \"\\E063\";
}

.glyphicons-power:before {
  content: \"\\E064\";
}

.glyphicons-lightbulb:before {
  content: \"\\E065\";
}

.glyphicons-tag:before {
  content: \"\\E066\";
}

.glyphicons-tags:before {
  content: \"\\E067\";
}

.glyphicons-cleaning:before {
  content: \"\\E068\";
}

.glyphicons-ruler:before {
  content: \"\\E069\";
}

.glyphicons-gift:before {
  content: \"\\E070\";
}

.glyphicons-umbrella:before {
  content: \"\\2602\";
}

.glyphicons-book:before {
  content: \"\\E072\";
}

.glyphicons-bookmark:before {
  content: \"\\E073\";
}

.glyphicons-wifi:before {
  content: \"\\E074\";
}

.glyphicons-cup:before {
  content: \"\\E075\";
}

.glyphicons-stroller:before {
  content: \"\\E076\";
}

.glyphicons-headphones:before {
  content: \"\\E077\";
}

.glyphicons-headset:before {
  content: \"\\E078\";
}

.glyphicons-warning-sign:before {
  content: \"\\E079\";
}

.glyphicons-signal:before {
  content: \"\\E080\";
}

.glyphicons-retweet:before {
  content: \"\\E081\";
}

.glyphicons-refresh:before {
  content: \"\\E082\";
}

.glyphicons-roundabout:before {
  content: \"\\E083\";
}

.glyphicons-random:before {
  content: \"\\E084\";
}

.glyphicons-heat:before {
  content: \"\\E085\";
}

.glyphicons-repeat:before {
  content: \"\\E086\";
}

.glyphicons-display:before {
  content: \"\\E087\";
}

.glyphicons-log-book:before {
  content: \"\\E088\";
}

.glyphicons-address-book:before {
  content: \"\\E089\";
}

.glyphicons-building:before {
  content: \"\\E090\";
}

.glyphicons-eyedropper:before {
  content: \"\\E091\";
}

.glyphicons-adjust:before {
  content: \"\\E092\";
}

.glyphicons-tint:before {
  content: \"\\E093\";
}

.glyphicons-crop:before {
  content: \"\\E094\";
}

.glyphicons-vector-path-square:before {
  content: \"\\E095\";
}

.glyphicons-vector-path-circle:before {
  content: \"\\E096\";
}

.glyphicons-vector-path-polygon:before {
  content: \"\\E097\";
}

.glyphicons-vector-path-line:before {
  content: \"\\E098\";
}

.glyphicons-vector-path-curve:before {
  content: \"\\E099\";
}

.glyphicons-vector-path-all:before {
  content: \"\\E100\";
}

.glyphicons-font:before {
  content: \"\\E101\";
}

.glyphicons-italic:before {
  content: \"\\E102\";
}

.glyphicons-bold:before {
  content: \"\\E103\";
}

.glyphicons-text-underline:before {
  content: \"\\E104\";
}

.glyphicons-text-strike:before {
  content: \"\\E105\";
}

.glyphicons-text-height:before {
  content: \"\\E106\";
}

.glyphicons-text-width:before {
  content: \"\\E107\";
}

.glyphicons-text-resize:before {
  content: \"\\E108\";
}

.glyphicons-left-indent:before {
  content: \"\\E109\";
}

.glyphicons-right-indent:before {
  content: \"\\E110\";
}

.glyphicons-align-left:before {
  content: \"\\E111\";
}

.glyphicons-align-center:before {
  content: \"\\E112\";
}

.glyphicons-align-right:before {
  content: \"\\E113\";
}

.glyphicons-justify:before {
  content: \"\\E114\";
}

.glyphicons-list:before {
  content: \"\\E115\";
}

.glyphicons-text-smaller:before {
  content: \"\\E116\";
}

.glyphicons-text-bigger:before {
  content: \"\\E117\";
}

.glyphicons-embed:before {
  content: \"\\E118\";
}

.glyphicons-embed-close:before {
  content: \"\\E119\";
}

.glyphicons-table:before {
  content: \"\\E120\";
}

.glyphicons-message-full:before {
  content: \"\\E121\";
}

.glyphicons-message-empty:before {
  content: \"\\E122\";
}

.glyphicons-message-in:before {
  content: \"\\E123\";
}

.glyphicons-message-out:before {
  content: \"\\E124\";
}

.glyphicons-message-plus:before {
  content: \"\\E125\";
}

.glyphicons-message-minus:before {
  content: \"\\E126\";
}

.glyphicons-message-ban:before {
  content: \"\\E127\";
}

.glyphicons-message-flag:before {
  content: \"\\E128\";
}

.glyphicons-message-lock:before {
  content: \"\\E129\";
}

.glyphicons-message-new:before {
  content: \"\\E130\";
}

.glyphicons-inbox:before {
  content: \"\\E131\";
}

.glyphicons-inbox-plus:before {
  content: \"\\E132\";
}

.glyphicons-inbox-minus:before {
  content: \"\\E133\";
}

.glyphicons-inbox-lock:before {
  content: \"\\E134\";
}

.glyphicons-inbox-in:before {
  content: \"\\E135\";
}

.glyphicons-inbox-out:before {
  content: \"\\E136\";
}

.glyphicons-cogwheel:before {
  content: \"\\E137\";
}

.glyphicons-cogwheels:before {
  content: \"\\E138\";
}

.glyphicons-picture:before {
  content: \"\\E139\";
}

.glyphicons-adjust-alt:before {
  content: \"\\E140\";
}

.glyphicons-database-lock:before {
  content: \"\\E141\";
}

.glyphicons-database-plus:before {
  content: \"\\E142\";
}

.glyphicons-database-minus:before {
  content: \"\\E143\";
}

.glyphicons-database-ban:before {
  content: \"\\E144\";
}

.glyphicons-folder-open:before {
  content: \"\\E145\";
}

.glyphicons-folder-plus:before {
  content: \"\\E146\";
}

.glyphicons-folder-minus:before {
  content: \"\\E147\";
}

.glyphicons-folder-lock:before {
  content: \"\\E148\";
}

.glyphicons-folder-flag:before {
  content: \"\\E149\";
}

.glyphicons-folder-new:before {
  content: \"\\E150\";
}

.glyphicons-edit:before {
  content: \"\\E151\";
}

.glyphicons-new-window:before {
  content: \"\\E152\";
}

.glyphicons-check:before {
  content: \"\\E153\";
}

.glyphicons-unchecked:before {
  content: \"\\E154\";
}

.glyphicons-more-windows:before {
  content: \"\\E155\";
}

.glyphicons-show-big-thumbnails:before {
  content: \"\\E156\";
}

.glyphicons-show-thumbnails:before {
  content: \"\\E157\";
}

.glyphicons-show-thumbnails-with-lines:before {
  content: \"\\E158\";
}

.glyphicons-show-lines:before {
  content: \"\\E159\";
}

.glyphicons-playlist:before {
  content: \"\\E160\";
}

.glyphicons-imac:before {
  content: \"\\E161\";
}

.glyphicons-macbook:before {
  content: \"\\E162\";
}

.glyphicons-ipad:before {
  content: \"\\E163\";
}

.glyphicons-iphone:before {
  content: \"\\E164\";
}

.glyphicons-iphone-transfer:before {
  content: \"\\E165\";
}

.glyphicons-iphone-exchange:before {
  content: \"\\E166\";
}

.glyphicons-ipod:before {
  content: \"\\E167\";
}

.glyphicons-ipod-shuffle:before {
  content: \"\\E168\";
}

.glyphicons-ear-plugs:before {
  content: \"\\E169\";
}

.glyphicons-record:before {
  content: \"\\E170\";
}

.glyphicons-step-backward:before {
  content: \"\\E171\";
}

.glyphicons-fast-backward:before {
  content: \"\\E172\";
}

.glyphicons-rewind:before {
  content: \"\\E173\";
}

.glyphicons-play:before {
  content: \"\\E174\";
}

.glyphicons-pause:before {
  content: \"\\E175\";
}

.glyphicons-stop:before {
  content: \"\\E176\";
}

.glyphicons-forward:before {
  content: \"\\E177\";
}

.glyphicons-fast-forward:before {
  content: \"\\E178\";
}

.glyphicons-step-forward:before {
  content: \"\\E179\";
}

.glyphicons-eject:before {
  content: \"\\E180\";
}

.glyphicons-facetime-video:before {
  content: \"\\E181\";
}

.glyphicons-download-alt:before {
  content: \"\\E182\";
}

.glyphicons-mute:before {
  content: \"\\E183\";
}

.glyphicons-volume-down:before {
  content: \"\\E184\";
}

.glyphicons-volume-up:before {
  content: \"\\E185\";
}

.glyphicons-screenshot:before {
  content: \"\\E186\";
}

.glyphicons-move:before {
  content: \"\\E187\";
}

.glyphicons-more:before {
  content: \"\\E188\";
}

.glyphicons-brightness-reduce:before {
  content: \"\\E189\";
}

.glyphicons-brightness-increase:before {
  content: \"\\E190\";
}

.glyphicons-circle-plus:before {
  content: \"\\E191\";
}

.glyphicons-circle-minus:before {
  content: \"\\E192\";
}

.glyphicons-circle-remove:before {
  content: \"\\E193\";
}

.glyphicons-circle-ok:before {
  content: \"\\E194\";
}

.glyphicons-circle-question-mark:before {
  content: \"\\E195\";
}

.glyphicons-circle-info:before {
  content: \"\\E196\";
}

.glyphicons-circle-exclamation-mark:before {
  content: \"\\E197\";
}

.glyphicons-remove:before {
  content: \"\\E198\";
}

.glyphicons-ok:before {
  content: \"\\E199\";
}

.glyphicons-ban:before {
  content: \"\\E200\";
}

.glyphicons-download:before {
  content: \"\\E201\";
}

.glyphicons-upload:before {
  content: \"\\E202\";
}

.glyphicons-shopping-cart:before {
  content: \"\\E203\";
}

.glyphicons-lock:before {
  content: \"\\E204\";
}

.glyphicons-unlock:before {
  content: \"\\E205\";
}

.glyphicons-electricity:before {
  content: \"\\E206\";
}

.glyphicons-ok-2:before {
  content: \"\\E207\";
}

.glyphicons-remove-2:before {
  content: \"\\E208\";
}

.glyphicons-cart-out:before {
  content: \"\\E209\";
}

.glyphicons-cart-in:before {
  content: \"\\E210\";
}

.glyphicons-left-arrow:before {
  content: \"\\E211\";
}

.glyphicons-right-arrow:before {
  content: \"\\E212\";
}

.glyphicons-down-arrow:before {
  content: \"\\E213\";
}

.glyphicons-up-arrow:before {
  content: \"\\E214\";
}

.glyphicons-resize-small:before {
  content: \"\\E215\";
}

.glyphicons-resize-full:before {
  content: \"\\E216\";
}

.glyphicons-circle-arrow-left:before {
  content: \"\\E217\";
}

.glyphicons-circle-arrow-right:before {
  content: \"\\E218\";
}

.glyphicons-circle-arrow-top:before {
  content: \"\\E219\";
}

.glyphicons-circle-arrow-down:before {
  content: \"\\E220\";
}

.glyphicons-play-button:before {
  content: \"\\E221\";
}

.glyphicons-unshare:before {
  content: \"\\E222\";
}

.glyphicons-share:before {
  content: \"\\E223\";
}

.glyphicons-chevron-right:before {
  content: \"\\E224\";
}

.glyphicons-chevron-left:before {
  content: \"\\E225\";
}

.glyphicons-bluetooth:before {
  content: \"\\E226\";
}

.glyphicons-euro:before {
  content: \"\\20AC\";
}

.glyphicons-usd:before {
  content: \"\\E228\";
}

.glyphicons-gbp:before {
  content: \"\\E229\";
}

.glyphicons-retweet-2:before {
  content: \"\\E230\";
}

.glyphicons-moon:before {
  content: \"\\E231\";
}

.glyphicons-sun:before {
  content: \"\\2609\";
}

.glyphicons-cloud:before {
  content: \"\\2601\";
}

.glyphicons-direction:before {
  content: \"\\E234\";
}

.glyphicons-brush:before {
  content: \"\\E235\";
}

.glyphicons-pen:before {
  content: \"\\E236\";
}

.glyphicons-zoom-in:before {
  content: \"\\E237\";
}

.glyphicons-zoom-out:before {
  content: \"\\E238\";
}

.glyphicons-pin:before {
  content: \"\\E239\";
}

.glyphicons-albums:before {
  content: \"\\E240\";
}

.glyphicons-rotation-lock:before {
  content: \"\\E241\";
}

.glyphicons-flash:before {
  content: \"\\E242\";
}

.glyphicons-google-maps:before {
  content: \"\\E243\";
}

.glyphicons-anchor:before {
  content: \"\\2693\";
}

.glyphicons-conversation:before {
  content: \"\\E245\";
}

.glyphicons-chat:before {
  content: \"\\E246\";
}

.glyphicons-male:before {
  content: \"\\E247\";
}

.glyphicons-female:before {
  content: \"\\E248\";
}

.glyphicons-asterisk:before {
  content: \"*\";
}

.glyphicons-divide:before {
  content: \"\\F7\";
}

.glyphicons-snorkel-diving:before {
  content: \"\\E251\";
}

.glyphicons-scuba-diving:before {
  content: \"\\E252\";
}

.glyphicons-oxygen-bottle:before {
  content: \"\\E253\";
}

.glyphicons-fins:before {
  content: \"\\E254\";
}

.glyphicons-fishes:before {
  content: \"\\E255\";
}

.glyphicons-boat:before {
  content: \"\\E256\";
}

.glyphicons-delete:before {
  content: \"\\E257\";
}

.glyphicons-sheriffs-star:before {
  content: \"\\E258\";
}

.glyphicons-qrcode:before {
  content: \"\\E259\";
}

.glyphicons-barcode:before {
  content: \"\\E260\";
}

.glyphicons-pool:before {
  content: \"\\E261\";
}

.glyphicons-buoy:before {
  content: \"\\E262\";
}

.glyphicons-spade:before {
  content: \"\\E263\";
}

.glyphicons-bank:before {
  content: \"\\E264\";
}

.glyphicons-vcard:before {
  content: \"\\E265\";
}

.glyphicons-electrical-plug:before {
  content: \"\\E266\";
}

.glyphicons-flag:before {
  content: \"\\E267\";
}

.glyphicons-credit-card:before {
  content: \"\\E268\";
}

.glyphicons-keyboard-wireless:before {
  content: \"\\E269\";
}

.glyphicons-keyboard-wired:before {
  content: \"\\E270\";
}

.glyphicons-shield:before {
  content: \"\\E271\";
}

.glyphicons-ring:before {
  content: \"\\2DA\";
}

.glyphicons-cake:before {
  content: \"\\E273\";
}

.glyphicons-drink:before {
  content: \"\\E274\";
}

.glyphicons-beer:before {
  content: \"\\E275\";
}

.glyphicons-fast-food:before {
  content: \"\\E276\";
}

.glyphicons-cutlery:before {
  content: \"\\E277\";
}

.glyphicons-pizza:before {
  content: \"\\E278\";
}

.glyphicons-birthday-cake:before {
  content: \"\\E279\";
}

.glyphicons-tablet:before {
  content: \"\\E280\";
}

.glyphicons-settings:before {
  content: \"\\E281\";
}

.glyphicons-bullets:before {
  content: \"\\E282\";
}

.glyphicons-cardio:before {
  content: \"\\E283\";
}

.glyphicons-t-shirt:before {
  content: \"\\E284\";
}

.glyphicons-pants:before {
  content: \"\\E285\";
}

.glyphicons-sweater:before {
  content: \"\\E286\";
}

.glyphicons-fabric:before {
  content: \"\\E287\";
}

.glyphicons-leather:before {
  content: \"\\E288\";
}

.glyphicons-scissors:before {
  content: \"\\E289\";
}

.glyphicons-bomb:before {
  content: \"\\E290\";
}

.glyphicons-skull:before {
  content: \"\\E291\";
}

.glyphicons-celebration:before {
  content: \"\\E292\";
}

.glyphicons-tea-kettle:before {
  content: \"\\E293\";
}

.glyphicons-french-press:before {
  content: \"\\E294\";
}

.glyphicons-coffee-cup:before {
  content: \"\\E295\";
}

.glyphicons-pot:before {
  content: \"\\E296\";
}

.glyphicons-grater:before {
  content: \"\\E297\";
}

.glyphicons-kettle:before {
  content: \"\\E298\";
}

.glyphicons-hospital:before {
  content: \"\\E299\";
}

.glyphicons-hospital-h:before {
  content: \"\\E300\";
}

.glyphicons-microphone:before {
  content: \"\\E301\";
}

.glyphicons-webcam:before {
  content: \"\\E302\";
}

.glyphicons-temple-christianity-church:before {
  content: \"\\E303\";
}

.glyphicons-temple-islam:before {
  content: \"\\E304\";
}

.glyphicons-temple-hindu:before {
  content: \"\\E305\";
}

.glyphicons-temple-buddhist:before {
  content: \"\\E306\";
}

.glyphicons-bicycle:before {
  content: \"\\E307\";
}

.glyphicons-life-preserver:before {
  content: \"\\E308\";
}

.glyphicons-share-alt:before {
  content: \"\\E309\";
}

.glyphicons-comments:before {
  content: \"\\E310\";
}

.glyphicons-flower:before {
  content: \"\\2698\";
}

.glyphicons-baseball:before {
  content: \"\\26BE\";
}

.glyphicons-rugby:before {
  content: \"\\E313\";
}

.glyphicons-ax:before {
  content: \"\\E314\";
}

.glyphicons-table-tennis:before {
  content: \"\\E315\";
}

.glyphicons-bowling:before {
  content: \"\\E316\";
}

.glyphicons-tree-conifer:before {
  content: \"\\E317\";
}

.glyphicons-tree-deciduous:before {
  content: \"\\E318\";
}

.glyphicons-more-items:before {
  content: \"\\E319\";
}

.glyphicons-sort:before {
  content: \"\\E320\";
}

.glyphicons-filter:before {
  content: \"\\E321\";
}

.glyphicons-gamepad:before {
  content: \"\\E322\";
}

.glyphicons-playing-dices:before {
  content: \"\\E323\";
}

.glyphicons-calculator:before {
  content: \"\\E324\";
}

.glyphicons-tie:before {
  content: \"\\E325\";
}

.glyphicons-wallet:before {
  content: \"\\E326\";
}

.glyphicons-piano:before {
  content: \"\\E327\";
}

.glyphicons-sampler:before {
  content: \"\\E328\";
}

.glyphicons-podium:before {
  content: \"\\E329\";
}

.glyphicons-soccer-ball:before {
  content: \"\\E330\";
}

.glyphicons-blog:before {
  content: \"\\E331\";
}

.glyphicons-dashboard:before {
  content: \"\\E332\";
}

.glyphicons-certificate:before {
  content: \"\\E333\";
}

.glyphicons-bell:before {
  content: \"\\E334\";
}

.glyphicons-candle:before {
  content: \"\\E335\";
}

.glyphicons-pushpin:before {
  content: \"\\E336\";
}

.glyphicons-iphone-shake:before {
  content: \"\\E337\";
}

.glyphicons-pin-flag:before {
  content: \"\\E338\";
}

.glyphicons-turtle:before {
  content: \"\\E339\";
}

.glyphicons-rabbit:before {
  content: \"\\E340\";
}

.glyphicons-globe:before {
  content: \"\\E341\";
}

.glyphicons-briefcase:before {
  content: \"\\E342\";
}

.glyphicons-hdd:before {
  content: \"\\E343\";
}

.glyphicons-thumbs-up:before {
  content: \"\\E344\";
}

.glyphicons-thumbs-down:before {
  content: \"\\E345\";
}

.glyphicons-hand-right:before {
  content: \"\\E346\";
}

.glyphicons-hand-left:before {
  content: \"\\E347\";
}

.glyphicons-hand-up:before {
  content: \"\\E348\";
}

.glyphicons-hand-down:before {
  content: \"\\E349\";
}

.glyphicons-fullscreen:before {
  content: \"\\E350\";
}

.glyphicons-shopping-bag:before {
  content: \"\\E351\";
}

.glyphicons-book-open:before {
  content: \"\\E352\";
}

.glyphicons-nameplate:before {
  content: \"\\E353\";
}

.glyphicons-nameplate-alt:before {
  content: \"\\E354\";
}

.glyphicons-vases:before {
  content: \"\\E355\";
}

.glyphicons-bullhorn:before {
  content: \"\\E356\";
}

.glyphicons-dumbbell:before {
  content: \"\\E357\";
}

.glyphicons-suitcase:before {
  content: \"\\E358\";
}

.glyphicons-file-import:before {
  content: \"\\E359\";
}

.glyphicons-file-export:before {
  content: \"\\E360\";
}

.glyphicons-bug:before {
  content: \"\\E361\";
}

.glyphicons-crown:before {
  content: \"\\E362\";
}

.glyphicons-smoking:before {
  content: \"\\E363\";
}

.glyphicons-cloud-download:before {
  content: \"\\E364\";
}

.glyphicons-cloud-upload:before {
  content: \"\\E365\";
}

.glyphicons-restart:before {
  content: \"\\E366\";
}

.glyphicons-security-camera:before {
  content: \"\\E367\";
}

.glyphicons-expand:before {
  content: \"\\E368\";
}

.glyphicons-collapse:before {
  content: \"\\E369\";
}

.glyphicons-collapse-top:before {
  content: \"\\E370\";
}

.glyphicons-globe-af:before {
  content: \"\\E371\";
}

.glyphicons-global:before {
  content: \"\\E372\";
}

.glyphicons-spray:before {
  content: \"\\E373\";
}

.glyphicons-nails:before {
  content: \"\\E374\";
}

.glyphicons-claw-hammer:before {
  content: \"\\E375\";
}

.glyphicons-classic-hammer:before {
  content: \"\\E376\";
}

.glyphicons-hand-saw:before {
  content: \"\\E377\";
}

.glyphicons-riflescope:before {
  content: \"\\E378\";
}

.glyphicons-electrical-socket-eu:before {
  content: \"\\E379\";
}

.glyphicons-electrical-socket-us:before {
  content: \"\\E380\";
}

.glyphicons-message-forward:before {
  content: \"\\E381\";
}

.glyphicons-coat-hanger:before {
  content: \"\\E382\";
}

.glyphicons-dress:before {
  content: \"\\E383\";
}

.glyphicons-bathrobe:before {
  content: \"\\E384\";
}

.glyphicons-shirt:before {
  content: \"\\E385\";
}

.glyphicons-underwear:before {
  content: \"\\E386\";
}

.glyphicons-log-in:before {
  content: \"\\E387\";
}

.glyphicons-log-out:before {
  content: \"\\E388\";
}

.glyphicons-exit:before {
  content: \"\\E389\";
}

.glyphicons-new-window-alt:before {
  content: \"\\E390\";
}

.glyphicons-video-sd:before {
  content: \"\\E391\";
}

.glyphicons-video-hd:before {
  content: \"\\E392\";
}

.glyphicons-subtitles:before {
  content: \"\\E393\";
}

.glyphicons-sound-stereo:before {
  content: \"\\E394\";
}

.glyphicons-sound-dolby:before {
  content: \"\\E395\";
}

.glyphicons-sound-5-1:before {
  content: \"\\E396\";
}

.glyphicons-sound-6-1:before {
  content: \"\\E397\";
}

.glyphicons-sound-7-1:before {
  content: \"\\E398\";
}

.glyphicons-copyright-mark:before {
  content: \"\\E399\";
}

.glyphicons-registration-mark:before {
  content: \"\\E400\";
}

.glyphicons-radar:before {
  content: \"\\E401\";
}

.glyphicons-skateboard:before {
  content: \"\\E402\";
}

.glyphicons-golf-course:before {
  content: \"\\E403\";
}

.glyphicons-sorting:before {
  content: \"\\E404\";
}

.glyphicons-sort-by-alphabet:before {
  content: \"\\E405\";
}

.glyphicons-sort-by-alphabet-alt:before {
  content: \"\\E406\";
}

.glyphicons-sort-by-order:before {
  content: \"\\E407\";
}

.glyphicons-sort-by-order-alt:before {
  content: \"\\E408\";
}

.glyphicons-sort-by-attributes:before {
  content: \"\\E409\";
}

.glyphicons-sort-by-attributes-alt:before {
  content: \"\\E410\";
}

.glyphicons-compressed:before {
  content: \"\\E411\";
}

.glyphicons-package:before {
  content: \"\\E412\";
}

.glyphicons-cloud-plus:before {
  content: \"\\E413\";
}

.glyphicons-cloud-minus:before {
  content: \"\\E414\";
}

.glyphicons-disk-save:before {
  content: \"\\E415\";
}

.glyphicons-disk-open:before {
  content: \"\\E416\";
}

.glyphicons-disk-saved:before {
  content: \"\\E417\";
}

.glyphicons-disk-remove:before {
  content: \"\\E418\";
}

.glyphicons-disk-import:before {
  content: \"\\E419\";
}

.glyphicons-disk-export:before {
  content: \"\\E420\";
}

.glyphicons-tower:before {
  content: \"\\E421\";
}

.glyphicons-send:before {
  content: \"\\E422\";
}

.glyphicons-git-branch:before {
  content: \"\\E423\";
}

.glyphicons-git-create:before {
  content: \"\\E424\";
}

.glyphicons-git-private:before {
  content: \"\\E425\";
}

.glyphicons-git-delete:before {
  content: \"\\E426\";
}

.glyphicons-git-merge:before {
  content: \"\\E427\";
}

.glyphicons-git-pull-request:before {
  content: \"\\E428\";
}

.glyphicons-git-compare:before {
  content: \"\\E429\";
}

.glyphicons-git-commit:before {
  content: \"\\E430\";
}

.glyphicons-construction-cone:before {
  content: \"\\E431\";
}

.glyphicons-shoe-steps:before {
  content: \"\\E432\";
}

.glyphicons-plus:before {
  content: \"+\";
}

.glyphicons-minus:before {
  content: \"\\2212\";
}

.glyphicons-redo:before {
  content: \"\\E435\";
}

.glyphicons-undo:before {
  content: \"\\E436\";
}

.glyphicons-golf:before {
  content: \"\\E437\";
}

.glyphicons-hockey:before {
  content: \"\\E438\";
}

.glyphicons-pipe:before {
  content: \"\\E439\";
}

.glyphicons-wrench:before {
  content: \"\\E440\";
}

.glyphicons-folder-closed:before {
  content: \"\\E441\";
}

.glyphicons-phone-alt:before {
  content: \"\\E442\";
}

.glyphicons-earphone:before {
  content: \"\\E443\";
}

.glyphicons-floppy-disk:before {
  content: \"\\E444\";
}

.glyphicons-floppy-saved:before {
  content: \"\\E445\";
}

.glyphicons-floppy-remove:before {
  content: \"\\E446\";
}

.glyphicons-floppy-save:before {
  content: \"\\E447\";
}

.glyphicons-floppy-open:before {
  content: \"\\E448\";
}

.glyphicons-translate:before {
  content: \"\\E449\";
}

.glyphicons-fax:before {
  content: \"\\E450\";
}

.glyphicons-factory:before {
  content: \"\\E451\";
}

.glyphicons-shop-window:before {
  content: \"\\E452\";
}

.glyphicons-shop:before {
  content: \"\\E453\";
}

.glyphicons-kiosk:before {
  content: \"\\E454\";
}

.glyphicons-kiosk-wheels:before {
  content: \"\\E455\";
}

.glyphicons-kiosk-light:before {
  content: \"\\E456\";
}

.glyphicons-kiosk-food:before {
  content: \"\\E457\";
}

.glyphicons-transfer:before {
  content: \"\\E458\";
}

.glyphicons-money:before {
  content: \"\\E459\";
}

.glyphicons-header:before {
  content: \"\\E460\";
}

.glyphicons-blacksmith:before {
  content: \"\\E461\";
}

.glyphicons-saw-blade:before {
  content: \"\\E462\";
}

.glyphicons-basketball:before {
  content: \"\\E463\";
}

.glyphicons-server:before {
  content: \"\\E464\";
}

.glyphicons-server-plus:before {
  content: \"\\E465\";
}

.glyphicons-server-minus:before {
  content: \"\\E466\";
}

.glyphicons-server-ban:before {
  content: \"\\E467\";
}

.glyphicons-server-flag:before {
  content: \"\\E468\";
}

.glyphicons-server-lock:before {
  content: \"\\E469\";
}

.glyphicons-server-new:before {
  content: \"\\E470\";
}

.glyphicons-charging-station:before {
  content: \"\\F471\";
}

.glyphicons-gas-station:before {
  content: \"\\E472\";
}

.glyphicons-target:before {
  content: \"\\E473\";
}

.glyphicons-bed-alt:before {
  content: \"\\E474\";
}

.glyphicons-mosquito-net:before {
  content: \"\\E475\";
}

.glyphicons-dining-set:before {
  content: \"\\E476\";
}

.glyphicons-plate-of-food:before {
  content: \"\\E477\";
}

.glyphicons-hygiene-kit:before {
  content: \"\\E478\";
}

.glyphicons-blackboard:before {
  content: \"\\E479\";
}

.glyphicons-marriage:before {
  content: \"\\E480\";
}

.glyphicons-bucket:before {
  content: \"\\E481\";
}

.glyphicons-none-color-swatch:before {
  content: \"\\E482\";
}

.glyphicons-bring-forward:before {
  content: \"\\E483\";
}

.glyphicons-bring-to-front:before {
  content: \"\\E484\";
}

.glyphicons-send-backward:before {
  content: \"\\E485\";
}

.glyphicons-send-to-back:before {
  content: \"\\E486\";
}

.glyphicons-fit-frame-to-image:before {
  content: \"\\E487\";
}

.glyphicons-fit-image-to-frame:before {
  content: \"\\E488\";
}

.glyphicons-multiple-displays:before {
  content: \"\\E489\";
}

.glyphicons-handshake:before {
  content: \"\\E490\";
}

.glyphicons-child:before {
  content: \"\\E491\";
}

.glyphicons-baby-formula:before {
  content: \"\\E492\";
}

.glyphicons-medicine:before {
  content: \"\\E493\";
}

.glyphicons-atv-vehicle:before {
  content: \"\\E494\";
}

.glyphicons-motorcycle:before {
  content: \"\\E495\";
}

.glyphicons-bed:before {
  content: \"\\E496\";
}

.glyphicons-tent:before {
  content: \"\\26FA\";
}

.glyphicons-glasses:before {
  content: \"\\E498\";
}

.glyphicons-sunglasses:before {
  content: \"\\E499\";
}

.glyphicons-family:before {
  content: \"\\E500\";
}

.glyphicons-education:before {
  content: \"\\E501\";
}

.glyphicons-shoes:before {
  content: \"\\E502\";
}

.glyphicons-map:before {
  content: \"\\E503\";
}

.glyphicons-cd:before {
  content: \"\\E504\";
}

.glyphicons-alert:before {
  content: \"\\E505\";
}

.glyphicons-piggy-bank:before {
  content: \"\\E506\";
}

.glyphicons-star-half:before {
  content: \"\\E507\";
}

.glyphicons-cluster:before {
  content: \"\\E508\";
}

.glyphicons-flowchart:before {
  content: \"\\E509\";
}

.glyphicons-commodities:before {
  content: \"\\E510\";
}

.glyphicons-duplicate:before {
  content: \"\\E511\";
}

.glyphicons-copy:before {
  content: \"\\E512\";
}

.glyphicons-paste:before {
  content: \"\\E513\";
}

.glyphicons-bath-bathtub:before {
  content: \"\\E514\";
}

.glyphicons-bath-shower:before {
  content: \"\\E515\";
}

.glyphicons-shower:before {
  content: \"\\1F6BF\";
}

.glyphicons-menu-hamburger:before {
  content: \"\\E517\";
}

.glyphicons-option-vertical:before {
  content: \"\\E518\";
}

.glyphicons-option-horizontal:before {
  content: \"\\E519\";
}

.glyphicons-currency-conversion:before {
  content: \"\\E520\";
}

.glyphicons-user-ban:before {
  content: \"\\E521\";
}

.glyphicons-user-lock:before {
  content: \"\\E522\";
}

.glyphicons-user-flag:before {
  content: \"\\E523\";
}

.glyphicons-user-asterisk:before {
  content: \"\\E524\";
}

.glyphicons-user-alert:before {
  content: \"\\E525\";
}

.glyphicons-user-key:before {
  content: \"\\E526\";
}

.glyphicons-user-conversation:before {
  content: \"\\E527\";
}

.glyphicons-database:before {
  content: \"\\E528\";
}

.glyphicons-database-search:before {
  content: \"\\E529\";
}

.glyphicons-list-alt:before {
  content: \"\\E530\";
}

.glyphicons-hazard-sign:before {
  content: \"\\E531\";
}

.glyphicons-hazard:before {
  content: \"\\E532\";
}

.glyphicons-stop-sign:before {
  content: \"\\E533\";
}

.glyphicons-lab:before {
  content: \"\\E534\";
}

.glyphicons-lab-alt:before {
  content: \"\\E535\";
}

.glyphicons-ice-cream:before {
  content: \"\\E536\";
}

.glyphicons-ice-lolly:before {
  content: \"\\E537\";
}

.glyphicons-ice-lolly-tasted:before {
  content: \"\\E538\";
}

.glyphicons-invoice:before {
  content: \"\\E539\";
}

.glyphicons-cart-tick:before {
  content: \"\\E540\";
}

.glyphicons-hourglass:before {
  content: \"\\231B\";
}

.glyphicons-cat:before {
  content: \"\\1F408\";
}

.glyphicons-lamp:before {
  content: \"\\E543\";
}

.glyphicons-scale-classic:before {
  content: \"\\E544\";
}

.glyphicons-eye-plus:before {
  content: \"\\E545\";
}

.glyphicons-eye-minus:before {
  content: \"\\E546\";
}

.glyphicons-quote:before {
  content: \"\\E547\";
}

.glyphicons-bitcoin:before {
  content: \"\\E548\";
}

.glyphicons-yen:before {
  content: \"\\A5\";
}

.glyphicons-ruble:before {
  content: \"\\20BD\";
}

.glyphicons-erase:before {
  content: \"\\E551\";
}

.glyphicons-podcast:before {
  content: \"\\E552\";
}

.glyphicons-firework:before {
  content: \"\\E553\";
}

.glyphicons-scale:before {
  content: \"\\E554\";
}

.glyphicons-king:before {
  content: \"\\E555\";
}

.glyphicons-queen:before {
  content: \"\\E556\";
}

.glyphicons-pawn:before {
  content: \"\\E557\";
}

.glyphicons-bishop:before {
  content: \"\\E558\";
}

.glyphicons-knight:before {
  content: \"\\E559\";
}

.glyphicons-mic-mute:before {
  content: \"\\E560\";
}

.glyphicons-voicemail:before {
  content: \"\\E561\";
}

.glyphicons-paragraph:before {
  content: \"\\B6\";
}

.glyphicons-person-walking:before {
  content: \"\\E563\";
}

.glyphicons-person-wheelchair:before {
  content: \"\\E564\";
}

.glyphicons-underground:before {
  content: \"\\E565\";
}

.glyphicons-car-hov:before {
  content: \"\\E566\";
}

.glyphicons-car-rental:before {
  content: \"\\E567\";
}

.glyphicons-transport:before {
  content: \"\\E568\";
}

.glyphicons-taxi:before {
  content: \"\\1F695\";
}

.glyphicons-ice-cream-no:before {
  content: \"\\E570\";
}

.glyphicons-uk-rat-u:before {
  content: \"\\E571\";
}

.glyphicons-uk-rat-pg:before {
  content: \"\\E572\";
}

.glyphicons-uk-rat-12a:before {
  content: \"\\E573\";
}

.glyphicons-uk-rat-12:before {
  content: \"\\E574\";
}

.glyphicons-uk-rat-15:before {
  content: \"\\E575\";
}

.glyphicons-uk-rat-18:before {
  content: \"\\E576\";
}

.glyphicons-uk-rat-r18:before {
  content: \"\\E577\";
}

.glyphicons-tv:before {
  content: \"\\E578\";
}

.glyphicons-sms:before {
  content: \"\\E579\";
}

.glyphicons-mms:before {
  content: \"\\E580\";
}

.glyphicons-us-rat-g:before {
  content: \"\\E581\";
}

.glyphicons-us-rat-pg:before {
  content: \"\\E582\";
}

.glyphicons-us-rat-pg-13:before {
  content: \"\\E583\";
}

.glyphicons-us-rat-restricted:before {
  content: \"\\E584\";
}

.glyphicons-us-rat-no-one-17:before {
  content: \"\\E585\";
}

.glyphicons-equalizer:before {
  content: \"\\E586\";
}

.glyphicons-speakers:before {
  content: \"\\E587\";
}

.glyphicons-remote-control:before {
  content: \"\\E588\";
}

.glyphicons-remote-control-tv:before {
  content: \"\\E589\";
}

.glyphicons-shredder:before {
  content: \"\\E590\";
}

.glyphicons-folder-heart:before {
  content: \"\\E591\";
}

.glyphicons-person-running:before {
  content: \"\\E592\";
}

.glyphicons-person:before {
  content: \"\\E593\";
}

.glyphicons-voice:before {
  content: \"\\E594\";
}

.glyphicons-stethoscope:before {
  content: \"\\E595\";
}

.glyphicons-hotspot:before {
  content: \"\\E596\";
}

.glyphicons-activity:before {
  content: \"\\E597\";
}

.glyphicons-watch:before {
  content: \"\\231A\";
}

.glyphicons-scissors-alt:before {
  content: \"\\E599\";
}

.glyphicons-car-wheel:before {
  content: \"\\E600\";
}

.glyphicons-chevron-up:before {
  content: \"\\E601\";
}

.glyphicons-chevron-down:before {
  content: \"\\E602\";
}

.glyphicons-superscript:before {
  content: \"\\E603\";
}

.glyphicons-subscript:before {
  content: \"\\E604\";
}

.glyphicons-text-size:before {
  content: \"\\E605\";
}

.glyphicons-text-color:before {
  content: \"\\E606\";
}

.glyphicons-text-background:before {
  content: \"\\E607\";
}

.glyphicons-modal-window:before {
  content: \"\\E608\";
}

.glyphicons-newspaper:before {
  content: \"\\1F4F0\";
}

.glyphicons-tractor:before {
  content: \"\\1F69C\";
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
  }
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

@-webkit-keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}
@keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(-200deg);
            transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(0);
            transform: rotate(0);
    opacity: 1;
  }
}
.rotateIn {
  -webkit-animation-name: rotateIn;
  animation-name: rotateIn;
}

@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
            transform: translateY(-15px);
  }
}
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
}

@-webkit-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
  }
  20% {
    -webkit-transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
            transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
            transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}

@-webkit-keyframes tada {
  0% {
    -webkit-transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
  }
}
@keyframes tada {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
  }
}
.tada {
  -webkit-animation-name: tada;
  animation-name: tada;
}

/* latin */
@font-face {
  font-family: \"Montserrat\";
  font-style: normal;
  font-weight: 400;
  src: local(\"Montserrat-Regular\"), url('";
        // line 3513
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/montserrat/montserrat-regular.woff2"]);
        echo "') format(\"woff2\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/montserrat/montserrat-regular.woff"]);
        echo "') format(\"woff\");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: \"Montserrat\";
  font-style: normal;
  font-weight: 700;
  src: local(\"Montserrat-Bold\"), url('";
        // line 3521
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/montserrat/montserrat-bold.woff2"]);
        echo "') format(\"woff2\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/montserrat/montserrat-bold.woff"]);
        echo "') format(\"woff\");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/*!
 *  Font Awesome 4.7.0 by @davegandy - http://fontawesome.io - @fontawesome
 *  License - http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
 */
/* FONT PATH
 * -------------------------- */
@font-face {
  font-family: \"FontAwesome\";
  src: url('";
        // line 3532
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.eot"]);
        echo "');
  src: url('";
        // line 3533
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.eot"]);
        echo "?#iefix') format(\"embedded-opentype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.woff2"]);
        echo "') format(\"woff2\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.woff"]);
        echo "') format(\"woff\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.ttf"]);
        echo "') format(\"truetype\"), url('";
        echo call_user_func_array($this->env->getFunction('asset_path')->getCallable(), ["path", "theme::fonts/font-awesome/fontawesome-webfont.svg"]);
        echo "#fontawesome') format(\"svg\");
  font-weight: normal;
  font-style: normal;
}
.fa {
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* makes the font 33% larger relative to the icon container */
.fa-lg {
  font-size: 1.33333333em;
  line-height: 0.75em;
  vertical-align: -15%;
}

.fa-2x {
  font-size: 2em;
}

.fa-3x {
  font-size: 3em;
}

.fa-4x {
  font-size: 4em;
}

.fa-5x {
  font-size: 5em;
}

.fa-fw {
  width: 1.28571429em;
  text-align: center;
}

.fa-ul {
  padding-left: 0;
  margin-left: 2.14285714em;
  list-style-type: none;
}

.fa-ul > li {
  position: relative;
}

.fa-li {
  position: absolute;
  left: -2.14285714em;
  width: 2.14285714em;
  top: 0.14285714em;
  text-align: center;
}

.fa-li.fa-lg {
  left: -1.85714286em;
}

.fa-border {
  padding: 0.2em 0.25em 0.15em;
  border: solid 0.08em #eeeeee;
  border-radius: 0.1em;
}

.fa-pull-left {
  float: left;
}

.fa-pull-right {
  float: right;
}

.fa.fa-pull-left {
  margin-right: 0.3em;
}

.fa.fa-pull-right {
  margin-left: 0.3em;
}

/* Deprecated as of 4.4.0 */
.pull-right {
  float: right;
}

.pull-left {
  float: left;
}

.fa.pull-left {
  margin-right: 0.3em;
}

.fa.pull-right {
  margin-left: 0.3em;
}

.fa-spin {
  -webkit-animation: fa-spin 2s infinite linear;
  animation: fa-spin 2s infinite linear;
}

.fa-pulse {
  -webkit-animation: fa-spin 1s infinite steps(8);
  animation: fa-spin 1s infinite steps(8);
}

@-webkit-keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
.fa-rotate-90 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=1)\";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.fa-rotate-180 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=2)\";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.fa-rotate-270 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=3)\";
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.fa-flip-horizontal {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)\";
  -webkit-transform: scale(-1, 1);
  transform: scale(-1, 1);
}

.fa-flip-vertical {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)\";
  -webkit-transform: scale(1, -1);
  transform: scale(1, -1);
}

:root .fa-rotate-90,
:root .fa-rotate-180,
:root .fa-rotate-270,
:root .fa-flip-horizontal,
:root .fa-flip-vertical {
  -webkit-filter: none;
          filter: none;
}

.fa-stack {
  position: relative;
  display: inline-block;
  width: 2em;
  height: 2em;
  line-height: 2em;
  vertical-align: middle;
}

.fa-stack-1x,
.fa-stack-2x {
  position: absolute;
  left: 0;
  width: 100%;
  text-align: center;
}

.fa-stack-1x {
  line-height: inherit;
}

.fa-stack-2x {
  font-size: 2em;
}

.fa-inverse {
  color: #ffffff;
}

/* Font Awesome uses the Unicode Private Use Area (PUA) to ensure screen
   readers do not read off random characters that represent icons */
.fa-glass:before {
  content: \"\\F000\";
}

.fa-music:before {
  content: \"\\F001\";
}

.fa-search:before {
  content: \"\\F002\";
}

.fa-envelope-o:before {
  content: \"\\F003\";
}

.fa-heart:before {
  content: \"\\F004\";
}

.fa-star:before {
  content: \"\\F005\";
}

.fa-star-o:before {
  content: \"\\F006\";
}

.fa-user:before {
  content: \"\\F007\";
}

.fa-film:before {
  content: \"\\F008\";
}

.fa-th-large:before {
  content: \"\\F009\";
}

.fa-th:before {
  content: \"\\F00A\";
}

.fa-th-list:before {
  content: \"\\F00B\";
}

.fa-check:before {
  content: \"\\F00C\";
}

.fa-remove:before,
.fa-close:before,
.fa-times:before {
  content: \"\\F00D\";
}

.fa-search-plus:before {
  content: \"\\F00E\";
}

.fa-search-minus:before {
  content: \"\\F010\";
}

.fa-power-off:before {
  content: \"\\F011\";
}

.fa-signal:before {
  content: \"\\F012\";
}

.fa-gear:before,
.fa-cog:before {
  content: \"\\F013\";
}

.fa-trash-o:before {
  content: \"\\F014\";
}

.fa-home:before {
  content: \"\\F015\";
}

.fa-file-o:before {
  content: \"\\F016\";
}

.fa-clock-o:before {
  content: \"\\F017\";
}

.fa-road:before {
  content: \"\\F018\";
}

.fa-download:before {
  content: \"\\F019\";
}

.fa-arrow-circle-o-down:before {
  content: \"\\F01A\";
}

.fa-arrow-circle-o-up:before {
  content: \"\\F01B\";
}

.fa-inbox:before {
  content: \"\\F01C\";
}

.fa-play-circle-o:before {
  content: \"\\F01D\";
}

.fa-rotate-right:before,
.fa-repeat:before {
  content: \"\\F01E\";
}

.fa-refresh:before {
  content: \"\\F021\";
}

.fa-list-alt:before {
  content: \"\\F022\";
}

.fa-lock:before {
  content: \"\\F023\";
}

.fa-flag:before {
  content: \"\\F024\";
}

.fa-headphones:before {
  content: \"\\F025\";
}

.fa-volume-off:before {
  content: \"\\F026\";
}

.fa-volume-down:before {
  content: \"\\F027\";
}

.fa-volume-up:before {
  content: \"\\F028\";
}

.fa-qrcode:before {
  content: \"\\F029\";
}

.fa-barcode:before {
  content: \"\\F02A\";
}

.fa-tag:before {
  content: \"\\F02B\";
}

.fa-tags:before {
  content: \"\\F02C\";
}

.fa-book:before {
  content: \"\\F02D\";
}

.fa-bookmark:before {
  content: \"\\F02E\";
}

.fa-print:before {
  content: \"\\F02F\";
}

.fa-camera:before {
  content: \"\\F030\";
}

.fa-font:before {
  content: \"\\F031\";
}

.fa-bold:before {
  content: \"\\F032\";
}

.fa-italic:before {
  content: \"\\F033\";
}

.fa-text-height:before {
  content: \"\\F034\";
}

.fa-text-width:before {
  content: \"\\F035\";
}

.fa-align-left:before {
  content: \"\\F036\";
}

.fa-align-center:before {
  content: \"\\F037\";
}

.fa-align-right:before {
  content: \"\\F038\";
}

.fa-align-justify:before {
  content: \"\\F039\";
}

.fa-list:before {
  content: \"\\F03A\";
}

.fa-dedent:before,
.fa-outdent:before {
  content: \"\\F03B\";
}

.fa-indent:before {
  content: \"\\F03C\";
}

.fa-video-camera:before {
  content: \"\\F03D\";
}

.fa-photo:before,
.fa-image:before,
.fa-picture-o:before {
  content: \"\\F03E\";
}

.fa-pencil:before {
  content: \"\\F040\";
}

.fa-map-marker:before {
  content: \"\\F041\";
}

.fa-adjust:before {
  content: \"\\F042\";
}

.fa-tint:before {
  content: \"\\F043\";
}

.fa-edit:before,
.fa-pencil-square-o:before {
  content: \"\\F044\";
}

.fa-share-square-o:before {
  content: \"\\F045\";
}

.fa-check-square-o:before {
  content: \"\\F046\";
}

.fa-arrows:before {
  content: \"\\F047\";
}

.fa-step-backward:before {
  content: \"\\F048\";
}

.fa-fast-backward:before {
  content: \"\\F049\";
}

.fa-backward:before {
  content: \"\\F04A\";
}

.fa-play:before {
  content: \"\\F04B\";
}

.fa-pause:before {
  content: \"\\F04C\";
}

.fa-stop:before {
  content: \"\\F04D\";
}

.fa-forward:before {
  content: \"\\F04E\";
}

.fa-fast-forward:before {
  content: \"\\F050\";
}

.fa-step-forward:before {
  content: \"\\F051\";
}

.fa-eject:before {
  content: \"\\F052\";
}

.fa-chevron-left:before {
  content: \"\\F053\";
}

.fa-chevron-right:before {
  content: \"\\F054\";
}

.fa-plus-circle:before {
  content: \"\\F055\";
}

.fa-minus-circle:before {
  content: \"\\F056\";
}

.fa-times-circle:before {
  content: \"\\F057\";
}

.fa-check-circle:before {
  content: \"\\F058\";
}

.fa-question-circle:before {
  content: \"\\F059\";
}

.fa-info-circle:before {
  content: \"\\F05A\";
}

.fa-crosshairs:before {
  content: \"\\F05B\";
}

.fa-times-circle-o:before {
  content: \"\\F05C\";
}

.fa-check-circle-o:before {
  content: \"\\F05D\";
}

.fa-ban:before {
  content: \"\\F05E\";
}

.fa-arrow-left:before {
  content: \"\\F060\";
}

.fa-arrow-right:before {
  content: \"\\F061\";
}

.fa-arrow-up:before {
  content: \"\\F062\";
}

.fa-arrow-down:before {
  content: \"\\F063\";
}

.fa-mail-forward:before,
.fa-share:before {
  content: \"\\F064\";
}

.fa-expand:before {
  content: \"\\F065\";
}

.fa-compress:before {
  content: \"\\F066\";
}

.fa-plus:before {
  content: \"\\F067\";
}

.fa-minus:before {
  content: \"\\F068\";
}

.fa-asterisk:before {
  content: \"\\F069\";
}

.fa-exclamation-circle:before {
  content: \"\\F06A\";
}

.fa-gift:before {
  content: \"\\F06B\";
}

.fa-leaf:before {
  content: \"\\F06C\";
}

.fa-fire:before {
  content: \"\\F06D\";
}

.fa-eye:before {
  content: \"\\F06E\";
}

.fa-eye-slash:before {
  content: \"\\F070\";
}

.fa-warning:before,
.fa-exclamation-triangle:before {
  content: \"\\F071\";
}

.fa-plane:before {
  content: \"\\F072\";
}

.fa-calendar:before {
  content: \"\\F073\";
}

.fa-random:before {
  content: \"\\F074\";
}

.fa-comment:before {
  content: \"\\F075\";
}

.fa-magnet:before {
  content: \"\\F076\";
}

.fa-chevron-up:before {
  content: \"\\F077\";
}

.fa-chevron-down:before {
  content: \"\\F078\";
}

.fa-retweet:before {
  content: \"\\F079\";
}

.fa-shopping-cart:before {
  content: \"\\F07A\";
}

.fa-folder:before {
  content: \"\\F07B\";
}

.fa-folder-open:before {
  content: \"\\F07C\";
}

.fa-arrows-v:before {
  content: \"\\F07D\";
}

.fa-arrows-h:before {
  content: \"\\F07E\";
}

.fa-bar-chart-o:before,
.fa-bar-chart:before {
  content: \"\\F080\";
}

.fa-twitter-square:before {
  content: \"\\F081\";
}

.fa-facebook-square:before {
  content: \"\\F082\";
}

.fa-camera-retro:before {
  content: \"\\F083\";
}

.fa-key:before {
  content: \"\\F084\";
}

.fa-gears:before,
.fa-cogs:before {
  content: \"\\F085\";
}

.fa-comments:before {
  content: \"\\F086\";
}

.fa-thumbs-o-up:before {
  content: \"\\F087\";
}

.fa-thumbs-o-down:before {
  content: \"\\F088\";
}

.fa-star-half:before {
  content: \"\\F089\";
}

.fa-heart-o:before {
  content: \"\\F08A\";
}

.fa-sign-out:before {
  content: \"\\F08B\";
}

.fa-linkedin-square:before {
  content: \"\\F08C\";
}

.fa-thumb-tack:before {
  content: \"\\F08D\";
}

.fa-external-link:before {
  content: \"\\F08E\";
}

.fa-sign-in:before {
  content: \"\\F090\";
}

.fa-trophy:before {
  content: \"\\F091\";
}

.fa-github-square:before {
  content: \"\\F092\";
}

.fa-upload:before {
  content: \"\\F093\";
}

.fa-lemon-o:before {
  content: \"\\F094\";
}

.fa-phone:before {
  content: \"\\F095\";
}

.fa-square-o:before {
  content: \"\\F096\";
}

.fa-bookmark-o:before {
  content: \"\\F097\";
}

.fa-phone-square:before {
  content: \"\\F098\";
}

.fa-twitter:before {
  content: \"\\F099\";
}

.fa-facebook-f:before,
.fa-facebook:before {
  content: \"\\F09A\";
}

.fa-github:before {
  content: \"\\F09B\";
}

.fa-unlock:before {
  content: \"\\F09C\";
}

.fa-credit-card:before {
  content: \"\\F09D\";
}

.fa-feed:before,
.fa-rss:before {
  content: \"\\F09E\";
}

.fa-hdd-o:before {
  content: \"\\F0A0\";
}

.fa-bullhorn:before {
  content: \"\\F0A1\";
}

.fa-bell:before {
  content: \"\\F0F3\";
}

.fa-certificate:before {
  content: \"\\F0A3\";
}

.fa-hand-o-right:before {
  content: \"\\F0A4\";
}

.fa-hand-o-left:before {
  content: \"\\F0A5\";
}

.fa-hand-o-up:before {
  content: \"\\F0A6\";
}

.fa-hand-o-down:before {
  content: \"\\F0A7\";
}

.fa-arrow-circle-left:before {
  content: \"\\F0A8\";
}

.fa-arrow-circle-right:before {
  content: \"\\F0A9\";
}

.fa-arrow-circle-up:before {
  content: \"\\F0AA\";
}

.fa-arrow-circle-down:before {
  content: \"\\F0AB\";
}

.fa-globe:before {
  content: \"\\F0AC\";
}

.fa-wrench:before {
  content: \"\\F0AD\";
}

.fa-tasks:before {
  content: \"\\F0AE\";
}

.fa-filter:before {
  content: \"\\F0B0\";
}

.fa-briefcase:before {
  content: \"\\F0B1\";
}

.fa-arrows-alt:before {
  content: \"\\F0B2\";
}

.fa-group:before,
.fa-users:before {
  content: \"\\F0C0\";
}

.fa-chain:before,
.fa-link:before {
  content: \"\\F0C1\";
}

.fa-cloud:before {
  content: \"\\F0C2\";
}

.fa-flask:before {
  content: \"\\F0C3\";
}

.fa-cut:before,
.fa-scissors:before {
  content: \"\\F0C4\";
}

.fa-copy:before,
.fa-files-o:before {
  content: \"\\F0C5\";
}

.fa-paperclip:before {
  content: \"\\F0C6\";
}

.fa-save:before,
.fa-floppy-o:before {
  content: \"\\F0C7\";
}

.fa-square:before {
  content: \"\\F0C8\";
}

.fa-navicon:before,
.fa-reorder:before,
.fa-bars:before {
  content: \"\\F0C9\";
}

.fa-list-ul:before {
  content: \"\\F0CA\";
}

.fa-list-ol:before {
  content: \"\\F0CB\";
}

.fa-strikethrough:before {
  content: \"\\F0CC\";
}

.fa-underline:before {
  content: \"\\F0CD\";
}

.fa-table:before {
  content: \"\\F0CE\";
}

.fa-magic:before {
  content: \"\\F0D0\";
}

.fa-truck:before {
  content: \"\\F0D1\";
}

.fa-pinterest:before {
  content: \"\\F0D2\";
}

.fa-pinterest-square:before {
  content: \"\\F0D3\";
}

.fa-google-plus-square:before {
  content: \"\\F0D4\";
}

.fa-google-plus:before {
  content: \"\\F0D5\";
}

.fa-money:before {
  content: \"\\F0D6\";
}

.fa-caret-down:before {
  content: \"\\F0D7\";
}

.fa-caret-up:before {
  content: \"\\F0D8\";
}

.fa-caret-left:before {
  content: \"\\F0D9\";
}

.fa-caret-right:before {
  content: \"\\F0DA\";
}

.fa-columns:before {
  content: \"\\F0DB\";
}

.fa-unsorted:before,
.fa-sort:before {
  content: \"\\F0DC\";
}

.fa-sort-down:before,
.fa-sort-desc:before {
  content: \"\\F0DD\";
}

.fa-sort-up:before,
.fa-sort-asc:before {
  content: \"\\F0DE\";
}

.fa-envelope:before {
  content: \"\\F0E0\";
}

.fa-linkedin:before {
  content: \"\\F0E1\";
}

.fa-rotate-left:before,
.fa-undo:before {
  content: \"\\F0E2\";
}

.fa-legal:before,
.fa-gavel:before {
  content: \"\\F0E3\";
}

.fa-dashboard:before,
.fa-tachometer:before {
  content: \"\\F0E4\";
}

.fa-comment-o:before {
  content: \"\\F0E5\";
}

.fa-comments-o:before {
  content: \"\\F0E6\";
}

.fa-flash:before,
.fa-bolt:before {
  content: \"\\F0E7\";
}

.fa-sitemap:before {
  content: \"\\F0E8\";
}

.fa-umbrella:before {
  content: \"\\F0E9\";
}

.fa-paste:before,
.fa-clipboard:before {
  content: \"\\F0EA\";
}

.fa-lightbulb-o:before {
  content: \"\\F0EB\";
}

.fa-exchange:before {
  content: \"\\F0EC\";
}

.fa-cloud-download:before {
  content: \"\\F0ED\";
}

.fa-cloud-upload:before {
  content: \"\\F0EE\";
}

.fa-user-md:before {
  content: \"\\F0F0\";
}

.fa-stethoscope:before {
  content: \"\\F0F1\";
}

.fa-suitcase:before {
  content: \"\\F0F2\";
}

.fa-bell-o:before {
  content: \"\\F0A2\";
}

.fa-coffee:before {
  content: \"\\F0F4\";
}

.fa-cutlery:before {
  content: \"\\F0F5\";
}

.fa-file-text-o:before {
  content: \"\\F0F6\";
}

.fa-building-o:before {
  content: \"\\F0F7\";
}

.fa-hospital-o:before {
  content: \"\\F0F8\";
}

.fa-ambulance:before {
  content: \"\\F0F9\";
}

.fa-medkit:before {
  content: \"\\F0FA\";
}

.fa-fighter-jet:before {
  content: \"\\F0FB\";
}

.fa-beer:before {
  content: \"\\F0FC\";
}

.fa-h-square:before {
  content: \"\\F0FD\";
}

.fa-plus-square:before {
  content: \"\\F0FE\";
}

.fa-angle-double-left:before {
  content: \"\\F100\";
}

.fa-angle-double-right:before {
  content: \"\\F101\";
}

.fa-angle-double-up:before {
  content: \"\\F102\";
}

.fa-angle-double-down:before {
  content: \"\\F103\";
}

.fa-angle-left:before {
  content: \"\\F104\";
}

.fa-angle-right:before {
  content: \"\\F105\";
}

.fa-angle-up:before {
  content: \"\\F106\";
}

.fa-angle-down:before {
  content: \"\\F107\";
}

.fa-desktop:before {
  content: \"\\F108\";
}

.fa-laptop:before {
  content: \"\\F109\";
}

.fa-tablet:before {
  content: \"\\F10A\";
}

.fa-mobile-phone:before,
.fa-mobile:before {
  content: \"\\F10B\";
}

.fa-circle-o:before {
  content: \"\\F10C\";
}

.fa-quote-left:before {
  content: \"\\F10D\";
}

.fa-quote-right:before {
  content: \"\\F10E\";
}

.fa-spinner:before {
  content: \"\\F110\";
}

.fa-circle:before {
  content: \"\\F111\";
}

.fa-mail-reply:before,
.fa-reply:before {
  content: \"\\F112\";
}

.fa-github-alt:before {
  content: \"\\F113\";
}

.fa-folder-o:before {
  content: \"\\F114\";
}

.fa-folder-open-o:before {
  content: \"\\F115\";
}

.fa-smile-o:before {
  content: \"\\F118\";
}

.fa-frown-o:before {
  content: \"\\F119\";
}

.fa-meh-o:before {
  content: \"\\F11A\";
}

.fa-gamepad:before {
  content: \"\\F11B\";
}

.fa-keyboard-o:before {
  content: \"\\F11C\";
}

.fa-flag-o:before {
  content: \"\\F11D\";
}

.fa-flag-checkered:before {
  content: \"\\F11E\";
}

.fa-terminal:before {
  content: \"\\F120\";
}

.fa-code:before {
  content: \"\\F121\";
}

.fa-mail-reply-all:before,
.fa-reply-all:before {
  content: \"\\F122\";
}

.fa-star-half-empty:before,
.fa-star-half-full:before,
.fa-star-half-o:before {
  content: \"\\F123\";
}

.fa-location-arrow:before {
  content: \"\\F124\";
}

.fa-crop:before {
  content: \"\\F125\";
}

.fa-code-fork:before {
  content: \"\\F126\";
}

.fa-unlink:before,
.fa-chain-broken:before {
  content: \"\\F127\";
}

.fa-question:before {
  content: \"\\F128\";
}

.fa-info:before {
  content: \"\\F129\";
}

.fa-exclamation:before {
  content: \"\\F12A\";
}

.fa-superscript:before {
  content: \"\\F12B\";
}

.fa-subscript:before {
  content: \"\\F12C\";
}

.fa-eraser:before {
  content: \"\\F12D\";
}

.fa-puzzle-piece:before {
  content: \"\\F12E\";
}

.fa-microphone:before {
  content: \"\\F130\";
}

.fa-microphone-slash:before {
  content: \"\\F131\";
}

.fa-shield:before {
  content: \"\\F132\";
}

.fa-calendar-o:before {
  content: \"\\F133\";
}

.fa-fire-extinguisher:before {
  content: \"\\F134\";
}

.fa-rocket:before {
  content: \"\\F135\";
}

.fa-maxcdn:before {
  content: \"\\F136\";
}

.fa-chevron-circle-left:before {
  content: \"\\F137\";
}

.fa-chevron-circle-right:before {
  content: \"\\F138\";
}

.fa-chevron-circle-up:before {
  content: \"\\F139\";
}

.fa-chevron-circle-down:before {
  content: \"\\F13A\";
}

.fa-html5:before {
  content: \"\\F13B\";
}

.fa-css3:before {
  content: \"\\F13C\";
}

.fa-anchor:before {
  content: \"\\F13D\";
}

.fa-unlock-alt:before {
  content: \"\\F13E\";
}

.fa-bullseye:before {
  content: \"\\F140\";
}

.fa-ellipsis-h:before {
  content: \"\\F141\";
}

.fa-ellipsis-v:before {
  content: \"\\F142\";
}

.fa-rss-square:before {
  content: \"\\F143\";
}

.fa-play-circle:before {
  content: \"\\F144\";
}

.fa-ticket:before {
  content: \"\\F145\";
}

.fa-minus-square:before {
  content: \"\\F146\";
}

.fa-minus-square-o:before {
  content: \"\\F147\";
}

.fa-level-up:before {
  content: \"\\F148\";
}

.fa-level-down:before {
  content: \"\\F149\";
}

.fa-check-square:before {
  content: \"\\F14A\";
}

.fa-pencil-square:before {
  content: \"\\F14B\";
}

.fa-external-link-square:before {
  content: \"\\F14C\";
}

.fa-share-square:before {
  content: \"\\F14D\";
}

.fa-compass:before {
  content: \"\\F14E\";
}

.fa-toggle-down:before,
.fa-caret-square-o-down:before {
  content: \"\\F150\";
}

.fa-toggle-up:before,
.fa-caret-square-o-up:before {
  content: \"\\F151\";
}

.fa-toggle-right:before,
.fa-caret-square-o-right:before {
  content: \"\\F152\";
}

.fa-euro:before,
.fa-eur:before {
  content: \"\\F153\";
}

.fa-gbp:before {
  content: \"\\F154\";
}

.fa-dollar:before,
.fa-usd:before {
  content: \"\\F155\";
}

.fa-rupee:before,
.fa-inr:before {
  content: \"\\F156\";
}

.fa-cny:before,
.fa-rmb:before,
.fa-yen:before,
.fa-jpy:before {
  content: \"\\F157\";
}

.fa-ruble:before,
.fa-rouble:before,
.fa-rub:before {
  content: \"\\F158\";
}

.fa-won:before,
.fa-krw:before {
  content: \"\\F159\";
}

.fa-bitcoin:before,
.fa-btc:before {
  content: \"\\F15A\";
}

.fa-file:before {
  content: \"\\F15B\";
}

.fa-file-text:before {
  content: \"\\F15C\";
}

.fa-sort-alpha-asc:before {
  content: \"\\F15D\";
}

.fa-sort-alpha-desc:before {
  content: \"\\F15E\";
}

.fa-sort-amount-asc:before {
  content: \"\\F160\";
}

.fa-sort-amount-desc:before {
  content: \"\\F161\";
}

.fa-sort-numeric-asc:before {
  content: \"\\F162\";
}

.fa-sort-numeric-desc:before {
  content: \"\\F163\";
}

.fa-thumbs-up:before {
  content: \"\\F164\";
}

.fa-thumbs-down:before {
  content: \"\\F165\";
}

.fa-youtube-square:before {
  content: \"\\F166\";
}

.fa-youtube:before {
  content: \"\\F167\";
}

.fa-xing:before {
  content: \"\\F168\";
}

.fa-xing-square:before {
  content: \"\\F169\";
}

.fa-youtube-play:before {
  content: \"\\F16A\";
}

.fa-dropbox:before {
  content: \"\\F16B\";
}

.fa-stack-overflow:before {
  content: \"\\F16C\";
}

.fa-instagram:before {
  content: \"\\F16D\";
}

.fa-flickr:before {
  content: \"\\F16E\";
}

.fa-adn:before {
  content: \"\\F170\";
}

.fa-bitbucket:before {
  content: \"\\F171\";
}

.fa-bitbucket-square:before {
  content: \"\\F172\";
}

.fa-tumblr:before {
  content: \"\\F173\";
}

.fa-tumblr-square:before {
  content: \"\\F174\";
}

.fa-long-arrow-down:before {
  content: \"\\F175\";
}

.fa-long-arrow-up:before {
  content: \"\\F176\";
}

.fa-long-arrow-left:before {
  content: \"\\F177\";
}

.fa-long-arrow-right:before {
  content: \"\\F178\";
}

.fa-apple:before {
  content: \"\\F179\";
}

.fa-windows:before {
  content: \"\\F17A\";
}

.fa-android:before {
  content: \"\\F17B\";
}

.fa-linux:before {
  content: \"\\F17C\";
}

.fa-dribbble:before {
  content: \"\\F17D\";
}

.fa-skype:before {
  content: \"\\F17E\";
}

.fa-foursquare:before {
  content: \"\\F180\";
}

.fa-trello:before {
  content: \"\\F181\";
}

.fa-female:before {
  content: \"\\F182\";
}

.fa-male:before {
  content: \"\\F183\";
}

.fa-gittip:before,
.fa-gratipay:before {
  content: \"\\F184\";
}

.fa-sun-o:before {
  content: \"\\F185\";
}

.fa-moon-o:before {
  content: \"\\F186\";
}

.fa-archive:before {
  content: \"\\F187\";
}

.fa-bug:before {
  content: \"\\F188\";
}

.fa-vk:before {
  content: \"\\F189\";
}

.fa-weibo:before {
  content: \"\\F18A\";
}

.fa-renren:before {
  content: \"\\F18B\";
}

.fa-pagelines:before {
  content: \"\\F18C\";
}

.fa-stack-exchange:before {
  content: \"\\F18D\";
}

.fa-arrow-circle-o-right:before {
  content: \"\\F18E\";
}

.fa-arrow-circle-o-left:before {
  content: \"\\F190\";
}

.fa-toggle-left:before,
.fa-caret-square-o-left:before {
  content: \"\\F191\";
}

.fa-dot-circle-o:before {
  content: \"\\F192\";
}

.fa-wheelchair:before {
  content: \"\\F193\";
}

.fa-vimeo-square:before {
  content: \"\\F194\";
}

.fa-turkish-lira:before,
.fa-try:before {
  content: \"\\F195\";
}

.fa-plus-square-o:before {
  content: \"\\F196\";
}

.fa-space-shuttle:before {
  content: \"\\F197\";
}

.fa-slack:before {
  content: \"\\F198\";
}

.fa-envelope-square:before {
  content: \"\\F199\";
}

.fa-wordpress:before {
  content: \"\\F19A\";
}

.fa-openid:before {
  content: \"\\F19B\";
}

.fa-institution:before,
.fa-bank:before,
.fa-university:before {
  content: \"\\F19C\";
}

.fa-mortar-board:before,
.fa-graduation-cap:before {
  content: \"\\F19D\";
}

.fa-yahoo:before {
  content: \"\\F19E\";
}

.fa-google:before {
  content: \"\\F1A0\";
}

.fa-reddit:before {
  content: \"\\F1A1\";
}

.fa-reddit-square:before {
  content: \"\\F1A2\";
}

.fa-stumbleupon-circle:before {
  content: \"\\F1A3\";
}

.fa-stumbleupon:before {
  content: \"\\F1A4\";
}

.fa-delicious:before {
  content: \"\\F1A5\";
}

.fa-digg:before {
  content: \"\\F1A6\";
}

.fa-pied-piper-pp:before {
  content: \"\\F1A7\";
}

.fa-pied-piper-alt:before {
  content: \"\\F1A8\";
}

.fa-drupal:before {
  content: \"\\F1A9\";
}

.fa-joomla:before {
  content: \"\\F1AA\";
}

.fa-language:before {
  content: \"\\F1AB\";
}

.fa-fax:before {
  content: \"\\F1AC\";
}

.fa-building:before {
  content: \"\\F1AD\";
}

.fa-child:before {
  content: \"\\F1AE\";
}

.fa-paw:before {
  content: \"\\F1B0\";
}

.fa-spoon:before {
  content: \"\\F1B1\";
}

.fa-cube:before {
  content: \"\\F1B2\";
}

.fa-cubes:before {
  content: \"\\F1B3\";
}

.fa-behance:before {
  content: \"\\F1B4\";
}

.fa-behance-square:before {
  content: \"\\F1B5\";
}

.fa-steam:before {
  content: \"\\F1B6\";
}

.fa-steam-square:before {
  content: \"\\F1B7\";
}

.fa-recycle:before {
  content: \"\\F1B8\";
}

.fa-automobile:before,
.fa-car:before {
  content: \"\\F1B9\";
}

.fa-cab:before,
.fa-taxi:before {
  content: \"\\F1BA\";
}

.fa-tree:before {
  content: \"\\F1BB\";
}

.fa-spotify:before {
  content: \"\\F1BC\";
}

.fa-deviantart:before {
  content: \"\\F1BD\";
}

.fa-soundcloud:before {
  content: \"\\F1BE\";
}

.fa-database:before {
  content: \"\\F1C0\";
}

.fa-file-pdf-o:before {
  content: \"\\F1C1\";
}

.fa-file-word-o:before {
  content: \"\\F1C2\";
}

.fa-file-excel-o:before {
  content: \"\\F1C3\";
}

.fa-file-powerpoint-o:before {
  content: \"\\F1C4\";
}

.fa-file-photo-o:before,
.fa-file-picture-o:before,
.fa-file-image-o:before {
  content: \"\\F1C5\";
}

.fa-file-zip-o:before,
.fa-file-archive-o:before {
  content: \"\\F1C6\";
}

.fa-file-sound-o:before,
.fa-file-audio-o:before {
  content: \"\\F1C7\";
}

.fa-file-movie-o:before,
.fa-file-video-o:before {
  content: \"\\F1C8\";
}

.fa-file-code-o:before {
  content: \"\\F1C9\";
}

.fa-vine:before {
  content: \"\\F1CA\";
}

.fa-codepen:before {
  content: \"\\F1CB\";
}

.fa-jsfiddle:before {
  content: \"\\F1CC\";
}

.fa-life-bouy:before,
.fa-life-buoy:before,
.fa-life-saver:before,
.fa-support:before,
.fa-life-ring:before {
  content: \"\\F1CD\";
}

.fa-circle-o-notch:before {
  content: \"\\F1CE\";
}

.fa-ra:before,
.fa-resistance:before,
.fa-rebel:before {
  content: \"\\F1D0\";
}

.fa-ge:before,
.fa-empire:before {
  content: \"\\F1D1\";
}

.fa-git-square:before {
  content: \"\\F1D2\";
}

.fa-git:before {
  content: \"\\F1D3\";
}

.fa-y-combinator-square:before,
.fa-yc-square:before,
.fa-hacker-news:before {
  content: \"\\F1D4\";
}

.fa-tencent-weibo:before {
  content: \"\\F1D5\";
}

.fa-qq:before {
  content: \"\\F1D6\";
}

.fa-wechat:before,
.fa-weixin:before {
  content: \"\\F1D7\";
}

.fa-send:before,
.fa-paper-plane:before {
  content: \"\\F1D8\";
}

.fa-send-o:before,
.fa-paper-plane-o:before {
  content: \"\\F1D9\";
}

.fa-history:before {
  content: \"\\F1DA\";
}

.fa-circle-thin:before {
  content: \"\\F1DB\";
}

.fa-header:before {
  content: \"\\F1DC\";
}

.fa-paragraph:before {
  content: \"\\F1DD\";
}

.fa-sliders:before {
  content: \"\\F1DE\";
}

.fa-share-alt:before {
  content: \"\\F1E0\";
}

.fa-share-alt-square:before {
  content: \"\\F1E1\";
}

.fa-bomb:before {
  content: \"\\F1E2\";
}

.fa-soccer-ball-o:before,
.fa-futbol-o:before {
  content: \"\\F1E3\";
}

.fa-tty:before {
  content: \"\\F1E4\";
}

.fa-binoculars:before {
  content: \"\\F1E5\";
}

.fa-plug:before {
  content: \"\\F1E6\";
}

.fa-slideshare:before {
  content: \"\\F1E7\";
}

.fa-twitch:before {
  content: \"\\F1E8\";
}

.fa-yelp:before {
  content: \"\\F1E9\";
}

.fa-newspaper-o:before {
  content: \"\\F1EA\";
}

.fa-wifi:before {
  content: \"\\F1EB\";
}

.fa-calculator:before {
  content: \"\\F1EC\";
}

.fa-paypal:before {
  content: \"\\F1ED\";
}

.fa-google-wallet:before {
  content: \"\\F1EE\";
}

.fa-cc-visa:before {
  content: \"\\F1F0\";
}

.fa-cc-mastercard:before {
  content: \"\\F1F1\";
}

.fa-cc-discover:before {
  content: \"\\F1F2\";
}

.fa-cc-amex:before {
  content: \"\\F1F3\";
}

.fa-cc-paypal:before {
  content: \"\\F1F4\";
}

.fa-cc-stripe:before {
  content: \"\\F1F5\";
}

.fa-bell-slash:before {
  content: \"\\F1F6\";
}

.fa-bell-slash-o:before {
  content: \"\\F1F7\";
}

.fa-trash:before {
  content: \"\\F1F8\";
}

.fa-copyright:before {
  content: \"\\F1F9\";
}

.fa-at:before {
  content: \"\\F1FA\";
}

.fa-eyedropper:before {
  content: \"\\F1FB\";
}

.fa-paint-brush:before {
  content: \"\\F1FC\";
}

.fa-birthday-cake:before {
  content: \"\\F1FD\";
}

.fa-area-chart:before {
  content: \"\\F1FE\";
}

.fa-pie-chart:before {
  content: \"\\F200\";
}

.fa-line-chart:before {
  content: \"\\F201\";
}

.fa-lastfm:before {
  content: \"\\F202\";
}

.fa-lastfm-square:before {
  content: \"\\F203\";
}

.fa-toggle-off:before {
  content: \"\\F204\";
}

.fa-toggle-on:before {
  content: \"\\F205\";
}

.fa-bicycle:before {
  content: \"\\F206\";
}

.fa-bus:before {
  content: \"\\F207\";
}

.fa-ioxhost:before {
  content: \"\\F208\";
}

.fa-angellist:before {
  content: \"\\F209\";
}

.fa-cc:before {
  content: \"\\F20A\";
}

.fa-shekel:before,
.fa-sheqel:before,
.fa-ils:before {
  content: \"\\F20B\";
}

.fa-meanpath:before {
  content: \"\\F20C\";
}

.fa-buysellads:before {
  content: \"\\F20D\";
}

.fa-connectdevelop:before {
  content: \"\\F20E\";
}

.fa-dashcube:before {
  content: \"\\F210\";
}

.fa-forumbee:before {
  content: \"\\F211\";
}

.fa-leanpub:before {
  content: \"\\F212\";
}

.fa-sellsy:before {
  content: \"\\F213\";
}

.fa-shirtsinbulk:before {
  content: \"\\F214\";
}

.fa-simplybuilt:before {
  content: \"\\F215\";
}

.fa-skyatlas:before {
  content: \"\\F216\";
}

.fa-cart-plus:before {
  content: \"\\F217\";
}

.fa-cart-arrow-down:before {
  content: \"\\F218\";
}

.fa-diamond:before {
  content: \"\\F219\";
}

.fa-ship:before {
  content: \"\\F21A\";
}

.fa-user-secret:before {
  content: \"\\F21B\";
}

.fa-motorcycle:before {
  content: \"\\F21C\";
}

.fa-street-view:before {
  content: \"\\F21D\";
}

.fa-heartbeat:before {
  content: \"\\F21E\";
}

.fa-venus:before {
  content: \"\\F221\";
}

.fa-mars:before {
  content: \"\\F222\";
}

.fa-mercury:before {
  content: \"\\F223\";
}

.fa-intersex:before,
.fa-transgender:before {
  content: \"\\F224\";
}

.fa-transgender-alt:before {
  content: \"\\F225\";
}

.fa-venus-double:before {
  content: \"\\F226\";
}

.fa-mars-double:before {
  content: \"\\F227\";
}

.fa-venus-mars:before {
  content: \"\\F228\";
}

.fa-mars-stroke:before {
  content: \"\\F229\";
}

.fa-mars-stroke-v:before {
  content: \"\\F22A\";
}

.fa-mars-stroke-h:before {
  content: \"\\F22B\";
}

.fa-neuter:before {
  content: \"\\F22C\";
}

.fa-genderless:before {
  content: \"\\F22D\";
}

.fa-facebook-official:before {
  content: \"\\F230\";
}

.fa-pinterest-p:before {
  content: \"\\F231\";
}

.fa-whatsapp:before {
  content: \"\\F232\";
}

.fa-server:before {
  content: \"\\F233\";
}

.fa-user-plus:before {
  content: \"\\F234\";
}

.fa-user-times:before {
  content: \"\\F235\";
}

.fa-hotel:before,
.fa-bed:before {
  content: \"\\F236\";
}

.fa-viacoin:before {
  content: \"\\F237\";
}

.fa-train:before {
  content: \"\\F238\";
}

.fa-subway:before {
  content: \"\\F239\";
}

.fa-medium:before {
  content: \"\\F23A\";
}

.fa-yc:before,
.fa-y-combinator:before {
  content: \"\\F23B\";
}

.fa-optin-monster:before {
  content: \"\\F23C\";
}

.fa-opencart:before {
  content: \"\\F23D\";
}

.fa-expeditedssl:before {
  content: \"\\F23E\";
}

.fa-battery-4:before,
.fa-battery:before,
.fa-battery-full:before {
  content: \"\\F240\";
}

.fa-battery-3:before,
.fa-battery-three-quarters:before {
  content: \"\\F241\";
}

.fa-battery-2:before,
.fa-battery-half:before {
  content: \"\\F242\";
}

.fa-battery-1:before,
.fa-battery-quarter:before {
  content: \"\\F243\";
}

.fa-battery-0:before,
.fa-battery-empty:before {
  content: \"\\F244\";
}

.fa-mouse-pointer:before {
  content: \"\\F245\";
}

.fa-i-cursor:before {
  content: \"\\F246\";
}

.fa-object-group:before {
  content: \"\\F247\";
}

.fa-object-ungroup:before {
  content: \"\\F248\";
}

.fa-sticky-note:before {
  content: \"\\F249\";
}

.fa-sticky-note-o:before {
  content: \"\\F24A\";
}

.fa-cc-jcb:before {
  content: \"\\F24B\";
}

.fa-cc-diners-club:before {
  content: \"\\F24C\";
}

.fa-clone:before {
  content: \"\\F24D\";
}

.fa-balance-scale:before {
  content: \"\\F24E\";
}

.fa-hourglass-o:before {
  content: \"\\F250\";
}

.fa-hourglass-1:before,
.fa-hourglass-start:before {
  content: \"\\F251\";
}

.fa-hourglass-2:before,
.fa-hourglass-half:before {
  content: \"\\F252\";
}

.fa-hourglass-3:before,
.fa-hourglass-end:before {
  content: \"\\F253\";
}

.fa-hourglass:before {
  content: \"\\F254\";
}

.fa-hand-grab-o:before,
.fa-hand-rock-o:before {
  content: \"\\F255\";
}

.fa-hand-stop-o:before,
.fa-hand-paper-o:before {
  content: \"\\F256\";
}

.fa-hand-scissors-o:before {
  content: \"\\F257\";
}

.fa-hand-lizard-o:before {
  content: \"\\F258\";
}

.fa-hand-spock-o:before {
  content: \"\\F259\";
}

.fa-hand-pointer-o:before {
  content: \"\\F25A\";
}

.fa-hand-peace-o:before {
  content: \"\\F25B\";
}

.fa-trademark:before {
  content: \"\\F25C\";
}

.fa-registered:before {
  content: \"\\F25D\";
}

.fa-creative-commons:before {
  content: \"\\F25E\";
}

.fa-gg:before {
  content: \"\\F260\";
}

.fa-gg-circle:before {
  content: \"\\F261\";
}

.fa-tripadvisor:before {
  content: \"\\F262\";
}

.fa-odnoklassniki:before {
  content: \"\\F263\";
}

.fa-odnoklassniki-square:before {
  content: \"\\F264\";
}

.fa-get-pocket:before {
  content: \"\\F265\";
}

.fa-wikipedia-w:before {
  content: \"\\F266\";
}

.fa-safari:before {
  content: \"\\F267\";
}

.fa-chrome:before {
  content: \"\\F268\";
}

.fa-firefox:before {
  content: \"\\F269\";
}

.fa-opera:before {
  content: \"\\F26A\";
}

.fa-internet-explorer:before {
  content: \"\\F26B\";
}

.fa-tv:before,
.fa-television:before {
  content: \"\\F26C\";
}

.fa-contao:before {
  content: \"\\F26D\";
}

.fa-500px:before {
  content: \"\\F26E\";
}

.fa-amazon:before {
  content: \"\\F270\";
}

.fa-calendar-plus-o:before {
  content: \"\\F271\";
}

.fa-calendar-minus-o:before {
  content: \"\\F272\";
}

.fa-calendar-times-o:before {
  content: \"\\F273\";
}

.fa-calendar-check-o:before {
  content: \"\\F274\";
}

.fa-industry:before {
  content: \"\\F275\";
}

.fa-map-pin:before {
  content: \"\\F276\";
}

.fa-map-signs:before {
  content: \"\\F277\";
}

.fa-map-o:before {
  content: \"\\F278\";
}

.fa-map:before {
  content: \"\\F279\";
}

.fa-commenting:before {
  content: \"\\F27A\";
}

.fa-commenting-o:before {
  content: \"\\F27B\";
}

.fa-houzz:before {
  content: \"\\F27C\";
}

.fa-vimeo:before {
  content: \"\\F27D\";
}

.fa-black-tie:before {
  content: \"\\F27E\";
}

.fa-fonticons:before {
  content: \"\\F280\";
}

.fa-reddit-alien:before {
  content: \"\\F281\";
}

.fa-edge:before {
  content: \"\\F282\";
}

.fa-credit-card-alt:before {
  content: \"\\F283\";
}

.fa-codiepie:before {
  content: \"\\F284\";
}

.fa-modx:before {
  content: \"\\F285\";
}

.fa-fort-awesome:before {
  content: \"\\F286\";
}

.fa-usb:before {
  content: \"\\F287\";
}

.fa-product-hunt:before {
  content: \"\\F288\";
}

.fa-mixcloud:before {
  content: \"\\F289\";
}

.fa-scribd:before {
  content: \"\\F28A\";
}

.fa-pause-circle:before {
  content: \"\\F28B\";
}

.fa-pause-circle-o:before {
  content: \"\\F28C\";
}

.fa-stop-circle:before {
  content: \"\\F28D\";
}

.fa-stop-circle-o:before {
  content: \"\\F28E\";
}

.fa-shopping-bag:before {
  content: \"\\F290\";
}

.fa-shopping-basket:before {
  content: \"\\F291\";
}

.fa-hashtag:before {
  content: \"\\F292\";
}

.fa-bluetooth:before {
  content: \"\\F293\";
}

.fa-bluetooth-b:before {
  content: \"\\F294\";
}

.fa-percent:before {
  content: \"\\F295\";
}

.fa-gitlab:before {
  content: \"\\F296\";
}

.fa-wpbeginner:before {
  content: \"\\F297\";
}

.fa-wpforms:before {
  content: \"\\F298\";
}

.fa-envira:before {
  content: \"\\F299\";
}

.fa-universal-access:before {
  content: \"\\F29A\";
}

.fa-wheelchair-alt:before {
  content: \"\\F29B\";
}

.fa-question-circle-o:before {
  content: \"\\F29C\";
}

.fa-blind:before {
  content: \"\\F29D\";
}

.fa-audio-description:before {
  content: \"\\F29E\";
}

.fa-volume-control-phone:before {
  content: \"\\F2A0\";
}

.fa-braille:before {
  content: \"\\F2A1\";
}

.fa-assistive-listening-systems:before {
  content: \"\\F2A2\";
}

.fa-asl-interpreting:before,
.fa-american-sign-language-interpreting:before {
  content: \"\\F2A3\";
}

.fa-deafness:before,
.fa-hard-of-hearing:before,
.fa-deaf:before {
  content: \"\\F2A4\";
}

.fa-glide:before {
  content: \"\\F2A5\";
}

.fa-glide-g:before {
  content: \"\\F2A6\";
}

.fa-signing:before,
.fa-sign-language:before {
  content: \"\\F2A7\";
}

.fa-low-vision:before {
  content: \"\\F2A8\";
}

.fa-viadeo:before {
  content: \"\\F2A9\";
}

.fa-viadeo-square:before {
  content: \"\\F2AA\";
}

.fa-snapchat:before {
  content: \"\\F2AB\";
}

.fa-snapchat-ghost:before {
  content: \"\\F2AC\";
}

.fa-snapchat-square:before {
  content: \"\\F2AD\";
}

.fa-pied-piper:before {
  content: \"\\F2AE\";
}

.fa-first-order:before {
  content: \"\\F2B0\";
}

.fa-yoast:before {
  content: \"\\F2B1\";
}

.fa-themeisle:before {
  content: \"\\F2B2\";
}

.fa-google-plus-circle:before,
.fa-google-plus-official:before {
  content: \"\\F2B3\";
}

.fa-fa:before,
.fa-font-awesome:before {
  content: \"\\F2B4\";
}

.fa-handshake-o:before {
  content: \"\\F2B5\";
}

.fa-envelope-open:before {
  content: \"\\F2B6\";
}

.fa-envelope-open-o:before {
  content: \"\\F2B7\";
}

.fa-linode:before {
  content: \"\\F2B8\";
}

.fa-address-book:before {
  content: \"\\F2B9\";
}

.fa-address-book-o:before {
  content: \"\\F2BA\";
}

.fa-vcard:before,
.fa-address-card:before {
  content: \"\\F2BB\";
}

.fa-vcard-o:before,
.fa-address-card-o:before {
  content: \"\\F2BC\";
}

.fa-user-circle:before {
  content: \"\\F2BD\";
}

.fa-user-circle-o:before {
  content: \"\\F2BE\";
}

.fa-user-o:before {
  content: \"\\F2C0\";
}

.fa-id-badge:before {
  content: \"\\F2C1\";
}

.fa-drivers-license:before,
.fa-id-card:before {
  content: \"\\F2C2\";
}

.fa-drivers-license-o:before,
.fa-id-card-o:before {
  content: \"\\F2C3\";
}

.fa-quora:before {
  content: \"\\F2C4\";
}

.fa-free-code-camp:before {
  content: \"\\F2C5\";
}

.fa-telegram:before {
  content: \"\\F2C6\";
}

.fa-thermometer-4:before,
.fa-thermometer:before,
.fa-thermometer-full:before {
  content: \"\\F2C7\";
}

.fa-thermometer-3:before,
.fa-thermometer-three-quarters:before {
  content: \"\\F2C8\";
}

.fa-thermometer-2:before,
.fa-thermometer-half:before {
  content: \"\\F2C9\";
}

.fa-thermometer-1:before,
.fa-thermometer-quarter:before {
  content: \"\\F2CA\";
}

.fa-thermometer-0:before,
.fa-thermometer-empty:before {
  content: \"\\F2CB\";
}

.fa-shower:before {
  content: \"\\F2CC\";
}

.fa-bathtub:before,
.fa-s15:before,
.fa-bath:before {
  content: \"\\F2CD\";
}

.fa-podcast:before {
  content: \"\\F2CE\";
}

.fa-window-maximize:before {
  content: \"\\F2D0\";
}

.fa-window-minimize:before {
  content: \"\\F2D1\";
}

.fa-window-restore:before {
  content: \"\\F2D2\";
}

.fa-times-rectangle:before,
.fa-window-close:before {
  content: \"\\F2D3\";
}

.fa-times-rectangle-o:before,
.fa-window-close-o:before {
  content: \"\\F2D4\";
}

.fa-bandcamp:before {
  content: \"\\F2D5\";
}

.fa-grav:before {
  content: \"\\F2D6\";
}

.fa-etsy:before {
  content: \"\\F2D7\";
}

.fa-imdb:before {
  content: \"\\F2D8\";
}

.fa-ravelry:before {
  content: \"\\F2D9\";
}

.fa-eercast:before {
  content: \"\\F2DA\";
}

.fa-microchip:before {
  content: \"\\F2DB\";
}

.fa-snowflake-o:before {
  content: \"\\F2DC\";
}

.fa-superpowers:before {
  content: \"\\F2DD\";
}

.fa-wpexplorer:before {
  content: \"\\F2DE\";
}

.fa-meetup:before {
  content: \"\\F2E0\";
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.sr-only-focusable:active,
.sr-only-focusable:focus {
  position: static;
  width: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  clip: auto;
}

@charset \"UTF-8\";
/*!
 * Bootstrap v4.0.0-alpha.5 (https://getbootstrap.com)
 * Copyright 2011-2016 The Bootstrap Authors
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
/*! normalize.css v4.2.0 | MIT License | github.com/necolas/normalize.css */
html {
  font-family: sans-serif;
  line-height: 1.15;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

body {
  margin: 0;
}

article,
aside,
details,
figcaption,
figure,
footer,
header,
main,
menu,
nav,
section,
summary {
  display: block;
}

audio,
canvas,
progress,
video {
  display: inline-block;
}

audio:not([controls]) {
  display: none;
  height: 0;
}

progress {
  vertical-align: baseline;
}

template,
[hidden] {
  display: none;
}

a {
  background-color: transparent;
  -webkit-text-decoration-skip: objects;
}

a:active,
a:hover {
  outline-width: 0;
}

abbr[title] {
  border-bottom: none;
  text-decoration: underline;
  -webkit-text-decoration: underline dotted;
          text-decoration: underline dotted;
}

b,
strong {
  font-weight: inherit;
}

b,
strong {
  font-weight: bolder;
}

dfn {
  font-style: italic;
}

h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

mark {
  background-color: #ff0;
  color: #000;
}

small {
  font-size: 80%;
}

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

img {
  border-style: none;
}

svg:not(:root) {
  overflow: hidden;
}

code,
kbd,
pre,
samp {
  font-family: monospace, monospace;
  font-size: 1em;
}

figure {
  margin: 1em 40px;
}

hr {
  box-sizing: content-box;
  height: 0;
  overflow: visible;
}

button,
input,
optgroup,
select,
textarea {
  font: inherit;
  margin: 0;
}

optgroup {
  font-weight: bold;
}

button,
input {
  overflow: visible;
}

button,
select {
  text-transform: none;
}

button,
html [type=button],
[type=reset],
[type=submit] {
  -webkit-appearance: button;
}

button::-moz-focus-inner,
[type=button]::-moz-focus-inner,
[type=reset]::-moz-focus-inner,
[type=submit]::-moz-focus-inner {
  border-style: none;
  padding: 0;
}

button:-moz-focusring,
[type=button]:-moz-focusring,
[type=reset]:-moz-focusring,
[type=submit]:-moz-focusring {
  outline: 1px dotted ButtonText;
}

fieldset {
  border: 1px solid #c0c0c0;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}

legend {
  box-sizing: border-box;
  color: inherit;
  display: table;
  max-width: 100%;
  padding: 0;
  white-space: normal;
}

textarea {
  overflow: auto;
}

[type=checkbox],
[type=radio] {
  box-sizing: border-box;
  padding: 0;
}

[type=number]::-webkit-inner-spin-button,
[type=number]::-webkit-outer-spin-button {
  height: auto;
}

[type=search] {
  -webkit-appearance: textfield;
  outline-offset: -2px;
}

[type=search]::-webkit-search-cancel-button,
[type=search]::-webkit-search-decoration {
  -webkit-appearance: none;
}

::-webkit-input-placeholder {
  color: inherit;
  opacity: 0.54;
}

::-webkit-file-upload-button {
  -webkit-appearance: button;
  font: inherit;
}

@media print {
  *,
*::before,
*::after,
*::first-letter,
p::first-line,
div::first-line,
blockquote::first-line,
li::first-line {
    text-shadow: none !important;
    box-shadow: none !important;
  }

  a,
a:visited {
    text-decoration: underline;
  }

  abbr[title]::after {
    content: \" (\" attr(title) \")\";
  }

  pre {
    white-space: pre-wrap !important;
  }

  pre,
blockquote {
    border: 1px solid #999;
    page-break-inside: avoid;
  }

  thead {
    display: table-header-group;
  }

  tr,
img {
    page-break-inside: avoid;
  }

  p,
h2,
h3 {
    orphans: 3;
    widows: 3;
  }

  h2,
h3 {
    page-break-after: avoid;
  }

  .navbar {
    display: none;
  }

  .btn > .caret,
.dropup > .btn > .caret {
    border-top-color: #000 !important;
  }

  .tag {
    border: 1px solid #000;
  }

  .table {
    border-collapse: collapse !important;
  }
  .table td,
.table th {
    background-color: #fff !important;
  }

  .table-bordered th,
.table-bordered td {
    border: 1px solid #ddd !important;
  }
}
html {
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: inherit;
}

@-ms-viewport {
  width: device-width;
}
html {
  font-size: 16px;
  -ms-overflow-style: scrollbar;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

body {
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-size: 1rem;
  line-height: 1.5;
  color: #373a3c;
  background-color: #fff;
}

[tabindex=\"-1\"]:focus {
  outline: none !important;
}

h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
}

p {
  margin-top: 0;
  margin-bottom: 1rem;
}

abbr[title],
abbr[data-original-title] {
  cursor: help;
  border-bottom: 1px dotted #888888;
}

address {
  margin-bottom: 1rem;
  font-style: normal;
  line-height: inherit;
}

ol,
ul,
dl {
  margin-top: 0;
  margin-bottom: 1rem;
}

ol ol,
ul ul,
ol ul,
ul ol {
  margin-bottom: 0;
}

dt {
  font-weight: bold;
}

dd {
  margin-bottom: 0.5rem;
  margin-left: 0;
}

blockquote {
  margin: 0 0 1rem;
}

a {
  color: #373a3c;
  text-decoration: none;
}
a:focus, a:hover {
  color: #121314;
  text-decoration: none;
}
a:focus {
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

a:not([href]):not([tabindex]) {
  color: inherit;
  text-decoration: none;
}
a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
  color: inherit;
  text-decoration: none;
}
a:not([href]):not([tabindex]):focus {
  outline: none;
}

pre {
  margin-top: 0;
  margin-bottom: 1rem;
  overflow: auto;
}

figure {
  margin: 0 0 1rem;
}

img {
  vertical-align: middle;
}

[role=button] {
  cursor: pointer;
}

a,
area,
button,
[role=button],
input,
label,
select,
summary,
textarea {
  touch-action: manipulation;
}

table {
  border-collapse: collapse;
  background-color: transparent;
}

caption {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  color: #888888;
  text-align: left;
  caption-side: bottom;
}

th {
  text-align: left;
}

label {
  display: inline-block;
  margin-bottom: 0.5rem;
}

button:focus {
  outline: 1px dotted;
  outline: 5px auto -webkit-focus-ring-color;
}

input,
button,
select,
textarea {
  line-height: inherit;
}

input[type=radio]:disabled,
input[type=checkbox]:disabled {
  cursor: not-allowed;
}

input[type=date],
input[type=time],
input[type=datetime-local],
input[type=month] {
  -webkit-appearance: listbox;
}

textarea {
  resize: vertical;
}

fieldset {
  min-width: 0;
  padding: 0;
  margin: 0;
  border: 0;
}

legend {
  display: block;
  width: 100%;
  padding: 0;
  margin-bottom: 0.5rem;
  font-size: 1.5rem;
  line-height: inherit;
}

input[type=search] {
  -webkit-appearance: none;
}

output {
  display: inline-block;
}

[hidden] {
  display: none !important;
}

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  margin-bottom: 0.5rem;
  font-family: inherit;
  font-weight: 500;
  line-height: 1.1;
  color: inherit;
}

h1, .h1 {
  font-size: 2rem;
}

h2, .h2 {
  font-size: 1.75rem;
}

h3, .h3 {
  font-size: 1.5rem;
}

h4, .h4 {
  font-size: 1.3rem;
}

h5, .h5 {
  font-size: 1.1rem;
}

h6, .h6 {
  font-size: 1rem;
}

.lead {
  font-size: 1.25rem;
  font-weight: 300;
}

.display-1 {
  font-size: 6rem;
  font-weight: 300;
}

.display-2 {
  font-size: 5.5rem;
  font-weight: 300;
}

.display-3 {
  font-size: 4.5rem;
  font-weight: 300;
}

.display-4 {
  font-size: 3.5rem;
  font-weight: 300;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}

small,
.small {
  font-size: 80%;
  font-weight: normal;
}

mark,
.mark {
  padding: 0.2em;
  background-color: #ff754b;
}

.list-unstyled {
  padding-left: 0;
  list-style: none;
}

.list-inline {
  padding-left: 0;
  list-style: none;
}

.list-inline-item {
  display: inline-block;
}
.list-inline-item:not(:last-child) {
  margin-right: 5px;
}

.initialism {
  font-size: 90%;
  text-transform: uppercase;
}

.blockquote {
  padding: 0.5rem 1rem;
  margin-bottom: 1rem;
  font-size: 1.25rem;
  border-left: 0.25rem solid #eceeef;
}

.blockquote-footer {
  display: block;
  font-size: 80%;
  color: #888888;
}
.blockquote-footer::before {
  content: \"\\2014\\A0\";
}

.blockquote-reverse {
  padding-right: 1rem;
  padding-left: 0;
  text-align: right;
  border-right: 0.25rem solid #eceeef;
  border-left: 0;
}

.blockquote-reverse .blockquote-footer::before {
  content: \"\";
}
.blockquote-reverse .blockquote-footer::after {
  content: \"\\A0\\2014\";
}

.img-fluid, .carousel-inner > .carousel-item > img,
.carousel-inner > .carousel-item > a > img {
  max-width: 100%;
  height: auto;
}

.img-thumbnail {
  padding: 0.25rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.17rem;
  transition: all 0.2s ease-in-out;
  max-width: 100%;
  height: auto;
}

.figure {
  display: inline-block;
}

.figure-img {
  margin-bottom: 0.5rem;
  line-height: 1;
}

.figure-caption {
  font-size: 90%;
  color: #888888;
}

code,
kbd,
pre,
samp {
  font-family: Menlo, Monaco, Consolas, \"Liberation Mono\", \"Courier New\", monospace;
}

code {
  padding: 0.2rem 0.4rem;
  font-size: 90%;
  color: #bd4147;
  background-color: #f7f7f9;
  border-radius: 0.17rem;
}

kbd {
  padding: 0.2rem 0.4rem;
  font-size: 90%;
  color: #fff;
  background-color: #333;
  border-radius: 0.1rem;
}
kbd kbd {
  padding: 0;
  font-size: 100%;
  font-weight: bold;
}

pre {
  display: block;
  margin-top: 0;
  margin-bottom: 1rem;
  font-size: 90%;
  color: #373a3c;
}
pre code {
  padding: 0;
  font-size: inherit;
  color: inherit;
  background-color: transparent;
  border-radius: 0;
}

.pre-scrollable {
  max-height: 340px;
  overflow-y: scroll;
}

.container {
  margin-left: auto;
  margin-right: auto;
  /*padding-left: 15px;*/
  /*padding-right: 15px;*/
}
@media (min-width: 576px) {
  .container {
    width: 540px;
    max-width: 100%;
  }
}
@media (min-width: 768px) {
  .container {
    width: 720px;
    max-width: 100%;
  }
}
@media (min-width: 992px) {
  .container {
    width: 960px;
    max-width: 100%;
  }
}
@media (min-width: 1200px) {
  .container {
    width: 1140px;
    max-width: 100%;
  }
}

.container-fluid {
  margin-left: auto;
  margin-right: auto;
  padding-left: 15px;
  padding-right: 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
@media (min-width: 576px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 768px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 992px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 1200px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}

.col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
  position: relative;
  min-height: 1px;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
@media (min-width: 576px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 768px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 992px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 1200px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}

.col-xs {
  flex-basis: 0;
  flex-grow: 1;
  max-width: 100%;
}

.col-xs-1 {
  flex: 0 0 4.1666666667%;
  max-width: 4.1666666667%;
}

.col-xs-2 {
  flex: 0 0 8.3333333333%;
  max-width: 8.3333333333%;
}

.col-xs-3 {
  flex: 0 0 12.5%;
  max-width: 12.5%;
}

.col-xs-4 {
  flex: 0 0 16.6666666667%;
  max-width: 16.6666666667%;
}

.col-xs-5 {
  flex: 0 0 20.8333333333%;
  max-width: 20.8333333333%;
}

.col-xs-6 {
  flex: 0 0 25%;
  max-width: 25%;
}

.col-xs-7 {
  flex: 0 0 29.1666666667%;
  max-width: 29.1666666667%;
}

.col-xs-8 {
  flex: 0 0 33.3333333333%;
  max-width: 33.3333333333%;
}

.col-xs-9 {
  flex: 0 0 37.5%;
  max-width: 37.5%;
}

.col-xs-10 {
  flex: 0 0 41.6666666667%;
  max-width: 41.6666666667%;
}

.col-xs-11 {
  flex: 0 0 45.8333333333%;
  max-width: 45.8333333333%;
}

.col-xs-12 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-xs-13 {
  flex: 0 0 54.1666666667%;
  max-width: 54.1666666667%;
}

.col-xs-14 {
  flex: 0 0 58.3333333333%;
  max-width: 58.3333333333%;
}

.col-xs-15 {
  flex: 0 0 62.5%;
  max-width: 62.5%;
}

.col-xs-16 {
  flex: 0 0 66.6666666667%;
  max-width: 66.6666666667%;
}

.col-xs-17 {
  flex: 0 0 70.8333333333%;
  max-width: 70.8333333333%;
}

.col-xs-18 {
  flex: 0 0 75%;
  max-width: 75%;
}

.col-xs-19 {
  flex: 0 0 79.1666666667%;
  max-width: 79.1666666667%;
}

.col-xs-20 {
  flex: 0 0 83.3333333333%;
  max-width: 83.3333333333%;
}

.col-xs-21 {
  flex: 0 0 87.5%;
  max-width: 87.5%;
}

.col-xs-22 {
  flex: 0 0 91.6666666667%;
  max-width: 91.6666666667%;
}

.col-xs-23 {
  flex: 0 0 95.8333333333%;
  max-width: 95.8333333333%;
}

.col-xs-24 {
  flex: 0 0 100%;
  max-width: 100%;
}

.pull-xs-0 {
  right: auto;
}

.pull-xs-1 {
  right: 4.1666666667%;
}

.pull-xs-2 {
  right: 8.3333333333%;
}

.pull-xs-3 {
  right: 12.5%;
}

.pull-xs-4 {
  right: 16.6666666667%;
}

.pull-xs-5 {
  right: 20.8333333333%;
}

.pull-xs-6 {
  right: 25%;
}

.pull-xs-7 {
  right: 29.1666666667%;
}

.pull-xs-8 {
  right: 33.3333333333%;
}

.pull-xs-9 {
  right: 37.5%;
}

.pull-xs-10 {
  right: 41.6666666667%;
}

.pull-xs-11 {
  right: 45.8333333333%;
}

.pull-xs-12 {
  right: 50%;
}

.pull-xs-13 {
  right: 54.1666666667%;
}

.pull-xs-14 {
  right: 58.3333333333%;
}

.pull-xs-15 {
  right: 62.5%;
}

.pull-xs-16 {
  right: 66.6666666667%;
}

.pull-xs-17 {
  right: 70.8333333333%;
}

.pull-xs-18 {
  right: 75%;
}

.pull-xs-19 {
  right: 79.1666666667%;
}

.pull-xs-20 {
  right: 83.3333333333%;
}

.pull-xs-21 {
  right: 87.5%;
}

.pull-xs-22 {
  right: 91.6666666667%;
}

.pull-xs-23 {
  right: 95.8333333333%;
}

.pull-xs-24 {
  right: 100%;
}

.push-xs-0 {
  left: auto;
}

.push-xs-1 {
  left: 4.1666666667%;
}

.push-xs-2 {
  left: 8.3333333333%;
}

.push-xs-3 {
  left: 12.5%;
}

.push-xs-4 {
  left: 16.6666666667%;
}

.push-xs-5 {
  left: 20.8333333333%;
}

.push-xs-6 {
  left: 25%;
}

.push-xs-7 {
  left: 29.1666666667%;
}

.push-xs-8 {
  left: 33.3333333333%;
}

.push-xs-9 {
  left: 37.5%;
}

.push-xs-10 {
  left: 41.6666666667%;
}

.push-xs-11 {
  left: 45.8333333333%;
}

.push-xs-12 {
  left: 50%;
}

.push-xs-13 {
  left: 54.1666666667%;
}

.push-xs-14 {
  left: 58.3333333333%;
}

.push-xs-15 {
  left: 62.5%;
}

.push-xs-16 {
  left: 66.6666666667%;
}

.push-xs-17 {
  left: 70.8333333333%;
}

.push-xs-18 {
  left: 75%;
}

.push-xs-19 {
  left: 79.1666666667%;
}

.push-xs-20 {
  left: 83.3333333333%;
}

.push-xs-21 {
  left: 87.5%;
}

.push-xs-22 {
  left: 91.6666666667%;
}

.push-xs-23 {
  left: 95.8333333333%;
}

.push-xs-24 {
  left: 100%;
}

.offset-xs-1 {
  margin-left: 4.1666666667%;
}

.offset-xs-2 {
  margin-left: 8.3333333333%;
}

.offset-xs-3 {
  margin-left: 12.5%;
}

.offset-xs-4 {
  margin-left: 16.6666666667%;
}

.offset-xs-5 {
  margin-left: 20.8333333333%;
}

.offset-xs-6 {
  margin-left: 25%;
}

.offset-xs-7 {
  margin-left: 29.1666666667%;
}

.offset-xs-8 {
  margin-left: 33.3333333333%;
}

.offset-xs-9 {
  margin-left: 37.5%;
}

.offset-xs-10 {
  margin-left: 41.6666666667%;
}

.offset-xs-11 {
  margin-left: 45.8333333333%;
}

.offset-xs-12 {
  margin-left: 50%;
}

.offset-xs-13 {
  margin-left: 54.1666666667%;
}

.offset-xs-14 {
  margin-left: 58.3333333333%;
}

.offset-xs-15 {
  margin-left: 62.5%;
}

.offset-xs-16 {
  margin-left: 66.6666666667%;
}

.offset-xs-17 {
  margin-left: 70.8333333333%;
}

.offset-xs-18 {
  margin-left: 75%;
}

.offset-xs-19 {
  margin-left: 79.1666666667%;
}

.offset-xs-20 {
  margin-left: 83.3333333333%;
}

.offset-xs-21 {
  margin-left: 87.5%;
}

.offset-xs-22 {
  margin-left: 91.6666666667%;
}

.offset-xs-23 {
  margin-left: 95.8333333333%;
}

@media (min-width: 576px) {
  .col-sm {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-sm-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-sm-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-sm-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-sm-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-sm-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-sm-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-sm-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-sm-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-sm-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-sm-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-sm-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-sm-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-sm-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-sm-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-sm-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-sm-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-sm-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-sm-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-sm-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-sm-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-sm-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-sm-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-sm-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-sm-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-sm-0 {
    right: auto;
  }

  .pull-sm-1 {
    right: 4.1666666667%;
  }

  .pull-sm-2 {
    right: 8.3333333333%;
  }

  .pull-sm-3 {
    right: 12.5%;
  }

  .pull-sm-4 {
    right: 16.6666666667%;
  }

  .pull-sm-5 {
    right: 20.8333333333%;
  }

  .pull-sm-6 {
    right: 25%;
  }

  .pull-sm-7 {
    right: 29.1666666667%;
  }

  .pull-sm-8 {
    right: 33.3333333333%;
  }

  .pull-sm-9 {
    right: 37.5%;
  }

  .pull-sm-10 {
    right: 41.6666666667%;
  }

  .pull-sm-11 {
    right: 45.8333333333%;
  }

  .pull-sm-12 {
    right: 50%;
  }

  .pull-sm-13 {
    right: 54.1666666667%;
  }

  .pull-sm-14 {
    right: 58.3333333333%;
  }

  .pull-sm-15 {
    right: 62.5%;
  }

  .pull-sm-16 {
    right: 66.6666666667%;
  }

  .pull-sm-17 {
    right: 70.8333333333%;
  }

  .pull-sm-18 {
    right: 75%;
  }

  .pull-sm-19 {
    right: 79.1666666667%;
  }

  .pull-sm-20 {
    right: 83.3333333333%;
  }

  .pull-sm-21 {
    right: 87.5%;
  }

  .pull-sm-22 {
    right: 91.6666666667%;
  }

  .pull-sm-23 {
    right: 95.8333333333%;
  }

  .pull-sm-24 {
    right: 100%;
  }

  .push-sm-0 {
    left: auto;
  }

  .push-sm-1 {
    left: 4.1666666667%;
  }

  .push-sm-2 {
    left: 8.3333333333%;
  }

  .push-sm-3 {
    left: 12.5%;
  }

  .push-sm-4 {
    left: 16.6666666667%;
  }

  .push-sm-5 {
    left: 20.8333333333%;
  }

  .push-sm-6 {
    left: 25%;
  }

  .push-sm-7 {
    left: 29.1666666667%;
  }

  .push-sm-8 {
    left: 33.3333333333%;
  }

  .push-sm-9 {
    left: 37.5%;
  }

  .push-sm-10 {
    left: 41.6666666667%;
  }

  .push-sm-11 {
    left: 45.8333333333%;
  }

  .push-sm-12 {
    left: 50%;
  }

  .push-sm-13 {
    left: 54.1666666667%;
  }

  .push-sm-14 {
    left: 58.3333333333%;
  }

  .push-sm-15 {
    left: 62.5%;
  }

  .push-sm-16 {
    left: 66.6666666667%;
  }

  .push-sm-17 {
    left: 70.8333333333%;
  }

  .push-sm-18 {
    left: 75%;
  }

  .push-sm-19 {
    left: 79.1666666667%;
  }

  .push-sm-20 {
    left: 83.3333333333%;
  }

  .push-sm-21 {
    left: 87.5%;
  }

  .push-sm-22 {
    left: 91.6666666667%;
  }

  .push-sm-23 {
    left: 95.8333333333%;
  }

  .push-sm-24 {
    left: 100%;
  }

  .offset-sm-0 {
    margin-left: 0%;
  }

  .offset-sm-1 {
    margin-left: 4.1666666667%;
  }

  .offset-sm-2 {
    margin-left: 8.3333333333%;
  }

  .offset-sm-3 {
    margin-left: 12.5%;
  }

  .offset-sm-4 {
    margin-left: 16.6666666667%;
  }

  .offset-sm-5 {
    margin-left: 20.8333333333%;
  }

  .offset-sm-6 {
    margin-left: 25%;
  }

  .offset-sm-7 {
    margin-left: 29.1666666667%;
  }

  .offset-sm-8 {
    margin-left: 33.3333333333%;
  }

  .offset-sm-9 {
    margin-left: 37.5%;
  }

  .offset-sm-10 {
    margin-left: 41.6666666667%;
  }

  .offset-sm-11 {
    margin-left: 45.8333333333%;
  }

  .offset-sm-12 {
    margin-left: 50%;
  }

  .offset-sm-13 {
    margin-left: 54.1666666667%;
  }

  .offset-sm-14 {
    margin-left: 58.3333333333%;
  }

  .offset-sm-15 {
    margin-left: 62.5%;
  }

  .offset-sm-16 {
    margin-left: 66.6666666667%;
  }

  .offset-sm-17 {
    margin-left: 70.8333333333%;
  }

  .offset-sm-18 {
    margin-left: 75%;
  }

  .offset-sm-19 {
    margin-left: 79.1666666667%;
  }

  .offset-sm-20 {
    margin-left: 83.3333333333%;
  }

  .offset-sm-21 {
    margin-left: 87.5%;
  }

  .offset-sm-22 {
    margin-left: 91.6666666667%;
  }

  .offset-sm-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 768px) {
  .col-md {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-md-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-md-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-md-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-md-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-md-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-md-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-md-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-md-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-md-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-md-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-md-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-md-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-md-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-md-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-md-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-md-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-md-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-md-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-md-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-md-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-md-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-md-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-md-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-md-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-md-0 {
    right: auto;
  }

  .pull-md-1 {
    right: 4.1666666667%;
  }

  .pull-md-2 {
    right: 8.3333333333%;
  }

  .pull-md-3 {
    right: 12.5%;
  }

  .pull-md-4 {
    right: 16.6666666667%;
  }

  .pull-md-5 {
    right: 20.8333333333%;
  }

  .pull-md-6 {
    right: 25%;
  }

  .pull-md-7 {
    right: 29.1666666667%;
  }

  .pull-md-8 {
    right: 33.3333333333%;
  }

  .pull-md-9 {
    right: 37.5%;
  }

  .pull-md-10 {
    right: 41.6666666667%;
  }

  .pull-md-11 {
    right: 45.8333333333%;
  }

  .pull-md-12 {
    right: 50%;
  }

  .pull-md-13 {
    right: 54.1666666667%;
  }

  .pull-md-14 {
    right: 58.3333333333%;
  }

  .pull-md-15 {
    right: 62.5%;
  }

  .pull-md-16 {
    right: 66.6666666667%;
  }

  .pull-md-17 {
    right: 70.8333333333%;
  }

  .pull-md-18 {
    right: 75%;
  }

  .pull-md-19 {
    right: 79.1666666667%;
  }

  .pull-md-20 {
    right: 83.3333333333%;
  }

  .pull-md-21 {
    right: 87.5%;
  }

  .pull-md-22 {
    right: 91.6666666667%;
  }

  .pull-md-23 {
    right: 95.8333333333%;
  }

  .pull-md-24 {
    right: 100%;
  }

  .push-md-0 {
    left: auto;
  }

  .push-md-1 {
    left: 4.1666666667%;
  }

  .push-md-2 {
    left: 8.3333333333%;
  }

  .push-md-3 {
    left: 12.5%;
  }

  .push-md-4 {
    left: 16.6666666667%;
  }

  .push-md-5 {
    left: 20.8333333333%;
  }

  .push-md-6 {
    left: 25%;
  }

  .push-md-7 {
    left: 29.1666666667%;
  }

  .push-md-8 {
    left: 33.3333333333%;
  }

  .push-md-9 {
    left: 37.5%;
  }

  .push-md-10 {
    left: 41.6666666667%;
  }

  .push-md-11 {
    left: 45.8333333333%;
  }

  .push-md-12 {
    left: 50%;
  }

  .push-md-13 {
    left: 54.1666666667%;
  }

  .push-md-14 {
    left: 58.3333333333%;
  }

  .push-md-15 {
    left: 62.5%;
  }

  .push-md-16 {
    left: 66.6666666667%;
  }

  .push-md-17 {
    left: 70.8333333333%;
  }

  .push-md-18 {
    left: 75%;
  }

  .push-md-19 {
    left: 79.1666666667%;
  }

  .push-md-20 {
    left: 83.3333333333%;
  }

  .push-md-21 {
    left: 87.5%;
  }

  .push-md-22 {
    left: 91.6666666667%;
  }

  .push-md-23 {
    left: 95.8333333333%;
  }

  .push-md-24 {
    left: 100%;
  }

  .offset-md-0 {
    margin-left: 0%;
  }

  .offset-md-1 {
    margin-left: 4.1666666667%;
  }

  .offset-md-2 {
    margin-left: 8.3333333333%;
  }

  .offset-md-3 {
    margin-left: 12.5%;
  }

  .offset-md-4 {
    margin-left: 16.6666666667%;
  }

  .offset-md-5 {
    margin-left: 20.8333333333%;
  }

  .offset-md-6 {
    margin-left: 25%;
  }

  .offset-md-7 {
    margin-left: 29.1666666667%;
  }

  .offset-md-8 {
    margin-left: 33.3333333333%;
  }

  .offset-md-9 {
    margin-left: 37.5%;
  }

  .offset-md-10 {
    margin-left: 41.6666666667%;
  }

  .offset-md-11 {
    margin-left: 45.8333333333%;
  }

  .offset-md-12 {
    margin-left: 50%;
  }

  .offset-md-13 {
    margin-left: 54.1666666667%;
  }

  .offset-md-14 {
    margin-left: 58.3333333333%;
  }

  .offset-md-15 {
    margin-left: 62.5%;
  }

  .offset-md-16 {
    margin-left: 66.6666666667%;
  }

  .offset-md-17 {
    margin-left: 70.8333333333%;
  }

  .offset-md-18 {
    margin-left: 75%;
  }

  .offset-md-19 {
    margin-left: 79.1666666667%;
  }

  .offset-md-20 {
    margin-left: 83.3333333333%;
  }

  .offset-md-21 {
    margin-left: 87.5%;
  }

  .offset-md-22 {
    margin-left: 91.6666666667%;
  }

  .offset-md-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 992px) {
  .col-lg {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-lg-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-lg-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-lg-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-lg-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-lg-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-lg-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-lg-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-lg-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-lg-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-lg-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-lg-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-lg-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-lg-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-lg-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-lg-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-lg-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-lg-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-lg-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-lg-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-lg-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-lg-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-lg-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-lg-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-lg-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-lg-0 {
    right: auto;
  }

  .pull-lg-1 {
    right: 4.1666666667%;
  }

  .pull-lg-2 {
    right: 8.3333333333%;
  }

  .pull-lg-3 {
    right: 12.5%;
  }

  .pull-lg-4 {
    right: 16.6666666667%;
  }

  .pull-lg-5 {
    right: 20.8333333333%;
  }

  .pull-lg-6 {
    right: 25%;
  }

  .pull-lg-7 {
    right: 29.1666666667%;
  }

  .pull-lg-8 {
    right: 33.3333333333%;
  }

  .pull-lg-9 {
    right: 37.5%;
  }

  .pull-lg-10 {
    right: 41.6666666667%;
  }

  .pull-lg-11 {
    right: 45.8333333333%;
  }

  .pull-lg-12 {
    right: 50%;
  }

  .pull-lg-13 {
    right: 54.1666666667%;
  }

  .pull-lg-14 {
    right: 58.3333333333%;
  }

  .pull-lg-15 {
    right: 62.5%;
  }

  .pull-lg-16 {
    right: 66.6666666667%;
  }

  .pull-lg-17 {
    right: 70.8333333333%;
  }

  .pull-lg-18 {
    right: 75%;
  }

  .pull-lg-19 {
    right: 79.1666666667%;
  }

  .pull-lg-20 {
    right: 83.3333333333%;
  }

  .pull-lg-21 {
    right: 87.5%;
  }

  .pull-lg-22 {
    right: 91.6666666667%;
  }

  .pull-lg-23 {
    right: 95.8333333333%;
  }

  .pull-lg-24 {
    right: 100%;
  }

  .push-lg-0 {
    left: auto;
  }

  .push-lg-1 {
    left: 4.1666666667%;
  }

  .push-lg-2 {
    left: 8.3333333333%;
  }

  .push-lg-3 {
    left: 12.5%;
  }

  .push-lg-4 {
    left: 16.6666666667%;
  }

  .push-lg-5 {
    left: 20.8333333333%;
  }

  .push-lg-6 {
    left: 25%;
  }

  .push-lg-7 {
    left: 29.1666666667%;
  }

  .push-lg-8 {
    left: 33.3333333333%;
  }

  .push-lg-9 {
    left: 37.5%;
  }

  .push-lg-10 {
    left: 41.6666666667%;
  }

  .push-lg-11 {
    left: 45.8333333333%;
  }

  .push-lg-12 {
    left: 50%;
  }

  .push-lg-13 {
    left: 54.1666666667%;
  }

  .push-lg-14 {
    left: 58.3333333333%;
  }

  .push-lg-15 {
    left: 62.5%;
  }

  .push-lg-16 {
    left: 66.6666666667%;
  }

  .push-lg-17 {
    left: 70.8333333333%;
  }

  .push-lg-18 {
    left: 75%;
  }

  .push-lg-19 {
    left: 79.1666666667%;
  }

  .push-lg-20 {
    left: 83.3333333333%;
  }

  .push-lg-21 {
    left: 87.5%;
  }

  .push-lg-22 {
    left: 91.6666666667%;
  }

  .push-lg-23 {
    left: 95.8333333333%;
  }

  .push-lg-24 {
    left: 100%;
  }

  .offset-lg-0 {
    margin-left: 0%;
  }

  .offset-lg-1 {
    margin-left: 4.1666666667%;
  }

  .offset-lg-2 {
    margin-left: 8.3333333333%;
  }

  .offset-lg-3 {
    margin-left: 12.5%;
  }

  .offset-lg-4 {
    margin-left: 16.6666666667%;
  }

  .offset-lg-5 {
    margin-left: 20.8333333333%;
  }

  .offset-lg-6 {
    margin-left: 25%;
  }

  .offset-lg-7 {
    margin-left: 29.1666666667%;
  }

  .offset-lg-8 {
    margin-left: 33.3333333333%;
  }

  .offset-lg-9 {
    margin-left: 37.5%;
  }

  .offset-lg-10 {
    margin-left: 41.6666666667%;
  }

  .offset-lg-11 {
    margin-left: 45.8333333333%;
  }

  .offset-lg-12 {
    margin-left: 50%;
  }

  .offset-lg-13 {
    margin-left: 54.1666666667%;
  }

  .offset-lg-14 {
    margin-left: 58.3333333333%;
  }

  .offset-lg-15 {
    margin-left: 62.5%;
  }

  .offset-lg-16 {
    margin-left: 66.6666666667%;
  }

  .offset-lg-17 {
    margin-left: 70.8333333333%;
  }

  .offset-lg-18 {
    margin-left: 75%;
  }

  .offset-lg-19 {
    margin-left: 79.1666666667%;
  }

  .offset-lg-20 {
    margin-left: 83.3333333333%;
  }

  .offset-lg-21 {
    margin-left: 87.5%;
  }

  .offset-lg-22 {
    margin-left: 91.6666666667%;
  }

  .offset-lg-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 1200px) {
  .col-xl {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-xl-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-xl-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-xl-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-xl-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-xl-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-xl-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-xl-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-xl-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-xl-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-xl-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-xl-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-xl-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-xl-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-xl-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-xl-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-xl-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-xl-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-xl-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-xl-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-xl-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-xl-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-xl-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-xl-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-xl-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-xl-0 {
    right: auto;
  }

  .pull-xl-1 {
    right: 4.1666666667%;
  }

  .pull-xl-2 {
    right: 8.3333333333%;
  }

  .pull-xl-3 {
    right: 12.5%;
  }

  .pull-xl-4 {
    right: 16.6666666667%;
  }

  .pull-xl-5 {
    right: 20.8333333333%;
  }

  .pull-xl-6 {
    right: 25%;
  }

  .pull-xl-7 {
    right: 29.1666666667%;
  }

  .pull-xl-8 {
    right: 33.3333333333%;
  }

  .pull-xl-9 {
    right: 37.5%;
  }

  .pull-xl-10 {
    right: 41.6666666667%;
  }

  .pull-xl-11 {
    right: 45.8333333333%;
  }

  .pull-xl-12 {
    right: 50%;
  }

  .pull-xl-13 {
    right: 54.1666666667%;
  }

  .pull-xl-14 {
    right: 58.3333333333%;
  }

  .pull-xl-15 {
    right: 62.5%;
  }

  .pull-xl-16 {
    right: 66.6666666667%;
  }

  .pull-xl-17 {
    right: 70.8333333333%;
  }

  .pull-xl-18 {
    right: 75%;
  }

  .pull-xl-19 {
    right: 79.1666666667%;
  }

  .pull-xl-20 {
    right: 83.3333333333%;
  }

  .pull-xl-21 {
    right: 87.5%;
  }

  .pull-xl-22 {
    right: 91.6666666667%;
  }

  .pull-xl-23 {
    right: 95.8333333333%;
  }

  .pull-xl-24 {
    right: 100%;
  }

  .push-xl-0 {
    left: auto;
  }

  .push-xl-1 {
    left: 4.1666666667%;
  }

  .push-xl-2 {
    left: 8.3333333333%;
  }

  .push-xl-3 {
    left: 12.5%;
  }

  .push-xl-4 {
    left: 16.6666666667%;
  }

  .push-xl-5 {
    left: 20.8333333333%;
  }

  .push-xl-6 {
    left: 25%;
  }

  .push-xl-7 {
    left: 29.1666666667%;
  }

  .push-xl-8 {
    left: 33.3333333333%;
  }

  .push-xl-9 {
    left: 37.5%;
  }

  .push-xl-10 {
    left: 41.6666666667%;
  }

  .push-xl-11 {
    left: 45.8333333333%;
  }

  .push-xl-12 {
    left: 50%;
  }

  .push-xl-13 {
    left: 54.1666666667%;
  }

  .push-xl-14 {
    left: 58.3333333333%;
  }

  .push-xl-15 {
    left: 62.5%;
  }

  .push-xl-16 {
    left: 66.6666666667%;
  }

  .push-xl-17 {
    left: 70.8333333333%;
  }

  .push-xl-18 {
    left: 75%;
  }

  .push-xl-19 {
    left: 79.1666666667%;
  }

  .push-xl-20 {
    left: 83.3333333333%;
  }

  .push-xl-21 {
    left: 87.5%;
  }

  .push-xl-22 {
    left: 91.6666666667%;
  }

  .push-xl-23 {
    left: 95.8333333333%;
  }

  .push-xl-24 {
    left: 100%;
  }

  .offset-xl-0 {
    margin-left: 0%;
  }

  .offset-xl-1 {
    margin-left: 4.1666666667%;
  }

  .offset-xl-2 {
    margin-left: 8.3333333333%;
  }

  .offset-xl-3 {
    margin-left: 12.5%;
  }

  .offset-xl-4 {
    margin-left: 16.6666666667%;
  }

  .offset-xl-5 {
    margin-left: 20.8333333333%;
  }

  .offset-xl-6 {
    margin-left: 25%;
  }

  .offset-xl-7 {
    margin-left: 29.1666666667%;
  }

  .offset-xl-8 {
    margin-left: 33.3333333333%;
  }

  .offset-xl-9 {
    margin-left: 37.5%;
  }

  .offset-xl-10 {
    margin-left: 41.6666666667%;
  }

  .offset-xl-11 {
    margin-left: 45.8333333333%;
  }

  .offset-xl-12 {
    margin-left: 50%;
  }

  .offset-xl-13 {
    margin-left: 54.1666666667%;
  }

  .offset-xl-14 {
    margin-left: 58.3333333333%;
  }

  .offset-xl-15 {
    margin-left: 62.5%;
  }

  .offset-xl-16 {
    margin-left: 66.6666666667%;
  }

  .offset-xl-17 {
    margin-left: 70.8333333333%;
  }

  .offset-xl-18 {
    margin-left: 75%;
  }

  .offset-xl-19 {
    margin-left: 79.1666666667%;
  }

  .offset-xl-20 {
    margin-left: 83.3333333333%;
  }

  .offset-xl-21 {
    margin-left: 87.5%;
  }

  .offset-xl-22 {
    margin-left: 91.6666666667%;
  }

  .offset-xl-23 {
    margin-left: 95.8333333333%;
  }
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
}
.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #eceeef;
}
.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #eceeef;
}
.table tbody + tbody {
  border-top: 2px solid #eceeef;
}
.table .table {
  background-color: #fff;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #eceeef;
}
.table-bordered th,
.table-bordered td {
  border: 1px solid #eceeef;
}
.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-active {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: rgba(0, 0, 0, 0.075);
}

.table-success {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #47d165;
}

.table-info {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #11bef6;
}

.table-warning {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #ff754b;
}

.table-danger {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #ff3160;
}

.thead-inverse th {
  color: #fff;
  background-color: #373a3c;
}

.thead-default th {
  color: #55595c;
  background-color: #eceeef;
}

.table-inverse {
  color: #eceeef;
  background-color: #373a3c;
}
.table-inverse th,
.table-inverse td,
.table-inverse thead th {
  border-color: #55595c;
}
.table-inverse.table-bordered {
  border: 0;
}

.table-responsive {
  display: block;
  width: 100%;
  min-height: 0%;
  overflow-x: auto;
}

.table-reflow thead {
  float: left;
}
.table-reflow tbody {
  display: block;
  white-space: nowrap;
}
.table-reflow th,
.table-reflow td {
  border-top: 1px solid #eceeef;
  border-left: 1px solid #eceeef;
}
.table-reflow th:last-child,
.table-reflow td:last-child {
  border-right: 1px solid #eceeef;
}
.table-reflow thead:last-child tr:last-child th,
.table-reflow thead:last-child tr:last-child td,
.table-reflow tbody:last-child tr:last-child th,
.table-reflow tbody:last-child tr:last-child td,
.table-reflow tfoot:last-child tr:last-child th,
.table-reflow tfoot:last-child tr:last-child td {
  border-bottom: 1px solid #eceeef;
}
.table-reflow tr {
  float: left;
}
.table-reflow tr th,
.table-reflow tr td {
  display: block !important;
  border: 1px solid #eceeef;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  line-height: 1.25;
  color: #55595c;
  background-color: #fff;
  background-image: none;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
}
.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}
.form-control:focus {
  color: #55595c;
  background-color: #fff;
  border-color: #11bef6;
  outline: none;
}
.form-control::-webkit-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control:-ms-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control::-ms-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control::placeholder {
  color: #999;
  opacity: 1;
}
.form-control:disabled, .form-control[readonly] {
  background-color: #eceeef;
  opacity: 1;
}
.form-control:disabled {
  cursor: not-allowed;
}

select.form-control:not([size]):not([multiple]) {
  height: calc(2.5rem - 2px);
}
select.form-control:focus::-ms-value {
  color: #55595c;
  background-color: #fff;
}

.form-control-file,
.form-control-range {
  display: block;
}

.col-form-label {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  margin-bottom: 0;
}

.col-form-label-lg {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1.25rem;
}

.col-form-label-sm {
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  font-size: 0.875rem;
}

.col-form-legend {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  margin-bottom: 0;
  font-size: 1rem;
}

.form-control-static {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  line-height: 1.25;
  border: solid transparent;
  border-width: 1px 0;
}
.form-control-static.form-control-sm, .input-group-sm > .form-control-static.form-control,
.input-group-sm > .form-control-static.input-group-addon,
.input-group-sm > .input-group-btn > .form-control-static.btn, .form-control-static.form-control-lg, .input-group-lg > .form-control-static.form-control,
.input-group-lg > .form-control-static.input-group-addon,
.input-group-lg > .input-group-btn > .form-control-static.btn {
  padding-right: 0;
  padding-left: 0;
}

.form-control-sm, .input-group-sm > .form-control,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}

select.form-control-sm:not([size]):not([multiple]), .input-group-sm > select.form-control:not([size]):not([multiple]),
.input-group-sm > select.input-group-addon:not([size]):not([multiple]),
.input-group-sm > .input-group-btn > select.btn:not([size]):not([multiple]) {
  height: 1.8125rem;
}

.form-control-lg, .input-group-lg > .form-control,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.25rem;
}

select.form-control-lg:not([size]):not([multiple]), .input-group-lg > select.form-control:not([size]):not([multiple]),
.input-group-lg > select.input-group-addon:not([size]):not([multiple]),
.input-group-lg > .input-group-btn > select.btn:not([size]):not([multiple]) {
  height: 3.1666666667rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-text {
  display: block;
  margin-top: 0.25rem;
}

.form-check {
  position: relative;
  display: block;
  margin-bottom: 0.75rem;
}
.form-check + .form-check {
  margin-top: -0.25rem;
}
.form-check.disabled .form-check-label {
  color: #888888;
  cursor: not-allowed;
}

.form-check-label {
  padding-left: 1.25rem;
  margin-bottom: 0;
  cursor: pointer;
}

.form-check-input {
  position: absolute;
  margin-top: 0.25rem;
  margin-left: -1.25rem;
}
.form-check-input:only-child {
  position: static;
}

.form-check-inline {
  position: relative;
  display: inline-block;
  padding-left: 1.25rem;
  margin-bottom: 0;
  vertical-align: middle;
  cursor: pointer;
}
.form-check-inline + .form-check-inline {
  margin-left: 0.75rem;
}
.form-check-inline.disabled {
  color: #888888;
  cursor: not-allowed;
}

.form-control-feedback {
  margin-top: 0.25rem;
}

.form-control-success,
.form-control-warning,
.form-control-danger {
  padding-right: 2.25rem;
  background-repeat: no-repeat;
  background-position: center right 0.625rem;
  background-size: 1.25rem 1.25rem;
}

.has-success .form-control-feedback,
.has-success .form-control-label,
.has-success .form-check-label,
.has-success .form-check-inline,
.has-success .custom-control {
  color: #47d165;
}
.has-success .form-control {
  border-color: #47d165;
}
.has-success .input-group-addon {
  color: #47d165;
  border-color: #47d165;
  background-color: #eafaee;
}
.has-success .form-control-success {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#47d165' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3E%3C/svg%3E\");
}

.has-warning .form-control-feedback,
.has-warning .form-control-label,
.has-warning .form-check-label,
.has-warning .form-check-inline,
.has-warning .custom-control {
  color: #ff754b;
}
.has-warning .form-control {
  border-color: #ff754b;
}
.has-warning .input-group-addon {
  color: #ff754b;
  border-color: #ff754b;
  background-color: white;
}
.has-warning .form-control-warning {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#ff754b' d='M4.4 5.324h-.8v-2.46h.8zm0 1.42h-.8V5.89h.8zM3.76.63L.04 7.075c-.115.2.016.425.26.426h7.397c.242 0 .372-.226.258-.426C6.726 4.924 5.47 2.79 4.253.63c-.113-.174-.39-.174-.494 0z'/%3E%3C/svg%3E\");
}

.has-danger .form-control-feedback,
.has-danger .form-control-label,
.has-danger .form-check-label,
.has-danger .form-check-inline,
.has-danger .custom-control {
  color: #ff3160;
}
.has-danger .form-control {
  border-color: #ff3160;
}
.has-danger .input-group-addon {
  color: #ff3160;
  border-color: #ff3160;
  background-color: #fffdfd;
}
.has-danger .form-control-danger {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='#ff3160' viewBox='-2 -2 7 7'%3E%3Cpath stroke='%23d9534f' d='M0 0l3 3m0-3L0 3'/%3E%3Ccircle r='.5'/%3E%3Ccircle cx='3' r='.5'/%3E%3Ccircle cy='3' r='.5'/%3E%3Ccircle cx='3' cy='3' r='.5'/%3E%3C/svg%3E\");
}

@media (min-width: 576px) {
  .form-inline .form-group {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
  }
  .form-inline .form-control-static {
    display: inline-block;
  }
  .form-inline .input-group {
    display: inline-table;
    width: auto;
    vertical-align: middle;
  }
  .form-inline .input-group .input-group-addon,
.form-inline .input-group .input-group-btn,
.form-inline .input-group .form-control {
    width: auto;
  }
  .form-inline .input-group > .form-control {
    width: 100%;
  }
  .form-inline .form-control-label {
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-check {
    display: inline-block;
    margin-top: 0;
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-check-label {
    padding-left: 0;
  }
  .form-inline .form-check-input {
    position: relative;
    margin-left: 0;
  }
  .form-inline .has-feedback .form-control-feedback {
    top: 0;
  }
}

.btn {
  display: inline-block;
  font-weight: normal;
  line-height: 1.25;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  border: 1px solid transparent;
  padding: 0.5rem 1rem;
  font-size: 1rem;
  border-radius: 0.1rem;
}
.btn:focus, .btn.focus, .btn:active:focus, .btn:active.focus, .btn.active:focus, .btn.active.focus {
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn:focus, .btn:hover {
  text-decoration: none;
}
.btn.focus {
  text-decoration: none;
}
.btn:active, .btn.active {
  background-image: none;
  outline: 0;
}
.btn.disabled, .btn:disabled {
  cursor: not-allowed;
  opacity: 0.65;
}

a.btn.disabled,
fieldset[disabled] a.btn {
  pointer-events: none;
}

.btn-primary {
  color: #fff !important;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-primary:hover {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
}
.btn-primary:focus, .btn-primary.focus {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
}
.btn-primary:active, .btn-primary.active, .open > .btn-primary.dropdown-toggle {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
  background-image: none;
}
.btn-primary:active:hover, .btn-primary:active:focus, .btn-primary:active.focus, .btn-primary.active:hover, .btn-primary.active:focus, .btn-primary.active.focus, .open > .btn-primary.dropdown-toggle:hover, .open > .btn-primary.dropdown-toggle:focus, .open > .btn-primary.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #6d1177;
  border-color: #4c0c54;
}
.btn-primary.disabled:focus, .btn-primary.disabled.focus, .btn-primary:disabled:focus, .btn-primary:disabled.focus {
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-primary.disabled:hover, .btn-primary:disabled:hover {
  background-color: #b21cc3;
  border-color: #b21cc3;
}

.btn-secondary {
  color: #373a3c !important;
  background-color: #fff;
  border-color: #ccc;
}
.btn-secondary:hover {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-secondary:focus, .btn-secondary.focus {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-secondary:active, .btn-secondary.active, .open > .btn-secondary.dropdown-toggle {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
  background-image: none;
}
.btn-secondary:active:hover, .btn-secondary:active:focus, .btn-secondary:active.focus, .btn-secondary.active:hover, .btn-secondary.active:focus, .btn-secondary.active.focus, .open > .btn-secondary.dropdown-toggle:hover, .open > .btn-secondary.dropdown-toggle:focus, .open > .btn-secondary.dropdown-toggle.focus {
  color: #373a3c !important;
  background-color: #d4d4d4;
  border-color: #8c8c8c;
}
.btn-secondary.disabled:focus, .btn-secondary.disabled.focus, .btn-secondary:disabled:focus, .btn-secondary:disabled.focus {
  background-color: #fff;
  border-color: #ccc;
}
.btn-secondary.disabled:hover, .btn-secondary:disabled:hover {
  background-color: #fff;
  border-color: #ccc;
}

.btn-info {
  color: #fff !important;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-info:hover {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
}
.btn-info:focus, .btn-info.focus {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
}
.btn-info:active, .btn-info.active, .open > .btn-info.dropdown-toggle {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
  background-image: none;
}
.btn-info:active:hover, .btn-info:active:focus, .btn-info:active.focus, .btn-info.active:hover, .btn-info.active:focus, .btn-info.active.focus, .open > .btn-info.dropdown-toggle:hover, .open > .btn-info.dropdown-toggle:focus, .open > .btn-info.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #0682aa;
  border-color: #056483;
}
.btn-info.disabled:focus, .btn-info.disabled.focus, .btn-info:disabled:focus, .btn-info:disabled.focus {
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-info.disabled:hover, .btn-info:disabled:hover {
  background-color: #11bef6;
  border-color: #11bef6;
}

.btn-success {
  color: #fff !important;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-success:hover {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
}
.btn-success:focus, .btn-success.focus {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
}
.btn-success:active, .btn-success.active, .open > .btn-success.dropdown-toggle {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
  background-image: none;
}
.btn-success:active:hover, .btn-success:active:focus, .btn-success:active.focus, .btn-success.active:hover, .btn-success.active:focus, .btn-success.active.focus, .open > .btn-success.dropdown-toggle:hover, .open > .btn-success.dropdown-toggle:focus, .open > .btn-success.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #279b40;
  border-color: #1f7a32;
}
.btn-success.disabled:focus, .btn-success.disabled.focus, .btn-success:disabled:focus, .btn-success:disabled.focus {
  background-color: #47d165;
  border-color: #47d165;
}
.btn-success.disabled:hover, .btn-success:disabled:hover {
  background-color: #47d165;
  border-color: #47d165;
}

.btn-warning {
  color: #fff !important;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-warning:hover {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
}
.btn-warning:focus, .btn-warning.focus {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
}
.btn-warning:active, .btn-warning.active, .open > .btn-warning.dropdown-toggle {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
  background-image: none;
}
.btn-warning:active:hover, .btn-warning:active:focus, .btn-warning:active.focus, .btn-warning.active:hover, .btn-warning.active:focus, .btn-warning.active.focus, .open > .btn-warning.dropdown-toggle:hover, .open > .btn-warning.dropdown-toggle:focus, .open > .btn-warning.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #f33900;
  border-color: #cb2f00;
}
.btn-warning.disabled:focus, .btn-warning.disabled.focus, .btn-warning:disabled:focus, .btn-warning:disabled.focus {
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-warning.disabled:hover, .btn-warning:disabled:hover {
  background-color: #ff754b;
  border-color: #ff754b;
}

.btn-danger {
  color: #fff !important;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-danger:hover {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
}
.btn-danger:focus, .btn-danger.focus {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
}
.btn-danger:active, .btn-danger.active, .open > .btn-danger.dropdown-toggle {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
  background-image: none;
}
.btn-danger:active:hover, .btn-danger:active:focus, .btn-danger:active.focus, .btn-danger.active:hover, .btn-danger.active:focus, .btn-danger.active.focus, .open > .btn-danger.dropdown-toggle:hover, .open > .btn-danger.dropdown-toggle:focus, .open > .btn-danger.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #d90032;
  border-color: #b10028;
}
.btn-danger.disabled:focus, .btn-danger.disabled.focus, .btn-danger:disabled:focus, .btn-danger:disabled.focus {
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-danger.disabled:hover, .btn-danger:disabled:hover {
  background-color: #ff3160;
  border-color: #ff3160;
}

.btn-outline-primary {
  color: #b21cc3;
  background-image: none;
  background-color: transparent;
  border-color: #b21cc3;
}
.btn-outline-primary:hover {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:focus, .btn-outline-primary.focus {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:active, .btn-outline-primary.active, .open > .btn-outline-primary.dropdown-toggle {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:active:hover, .btn-outline-primary:active:focus, .btn-outline-primary:active.focus, .btn-outline-primary.active:hover, .btn-outline-primary.active:focus, .btn-outline-primary.active.focus, .open > .btn-outline-primary.dropdown-toggle:hover, .open > .btn-outline-primary.dropdown-toggle:focus, .open > .btn-outline-primary.dropdown-toggle.focus {
  color: #fff;
  background-color: #6d1177;
  border-color: #4c0c54;
}
.btn-outline-primary.disabled:focus, .btn-outline-primary.disabled.focus, .btn-outline-primary:disabled:focus, .btn-outline-primary:disabled.focus {
  border-color: #da5de8;
}
.btn-outline-primary.disabled:hover, .btn-outline-primary:disabled:hover {
  border-color: #da5de8;
}

.btn-outline-secondary {
  color: #ccc;
  background-image: none;
  background-color: transparent;
  border-color: #ccc;
}
.btn-outline-secondary:hover {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:focus, .btn-outline-secondary.focus {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:active, .btn-outline-secondary.active, .open > .btn-outline-secondary.dropdown-toggle {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:active:hover, .btn-outline-secondary:active:focus, .btn-outline-secondary:active.focus, .btn-outline-secondary.active:hover, .btn-outline-secondary.active:focus, .btn-outline-secondary.active.focus, .open > .btn-outline-secondary.dropdown-toggle:hover, .open > .btn-outline-secondary.dropdown-toggle:focus, .open > .btn-outline-secondary.dropdown-toggle.focus {
  color: #fff;
  background-color: #a1a1a1;
  border-color: #8c8c8c;
}
.btn-outline-secondary.disabled:focus, .btn-outline-secondary.disabled.focus, .btn-outline-secondary:disabled:focus, .btn-outline-secondary:disabled.focus {
  border-color: white;
}
.btn-outline-secondary.disabled:hover, .btn-outline-secondary:disabled:hover {
  border-color: white;
}

.btn-outline-info {
  color: #11bef6;
  background-image: none;
  background-color: transparent;
  border-color: #11bef6;
}
.btn-outline-info:hover {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:focus, .btn-outline-info.focus {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:active, .btn-outline-info.active, .open > .btn-outline-info.dropdown-toggle {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:active:hover, .btn-outline-info:active:focus, .btn-outline-info:active.focus, .btn-outline-info.active:hover, .btn-outline-info.active:focus, .btn-outline-info.active.focus, .open > .btn-outline-info.dropdown-toggle:hover, .open > .btn-outline-info.dropdown-toggle:focus, .open > .btn-outline-info.dropdown-toggle.focus {
  color: #fff;
  background-color: #0682aa;
  border-color: #056483;
}
.btn-outline-info.disabled:focus, .btn-outline-info.disabled.focus, .btn-outline-info:disabled:focus, .btn-outline-info:disabled.focus {
  border-color: #73d9fa;
}
.btn-outline-info.disabled:hover, .btn-outline-info:disabled:hover {
  border-color: #73d9fa;
}

.btn-outline-success {
  color: #47d165;
  background-image: none;
  background-color: transparent;
  border-color: #47d165;
}
.btn-outline-success:hover {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:focus, .btn-outline-success.focus {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:active, .btn-outline-success.active, .open > .btn-outline-success.dropdown-toggle {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:active:hover, .btn-outline-success:active:focus, .btn-outline-success:active.focus, .btn-outline-success.active:hover, .btn-outline-success.active:focus, .btn-outline-success.active.focus, .open > .btn-outline-success.dropdown-toggle:hover, .open > .btn-outline-success.dropdown-toggle:focus, .open > .btn-outline-success.dropdown-toggle.focus {
  color: #fff;
  background-color: #279b40;
  border-color: #1f7a32;
}
.btn-outline-success.disabled:focus, .btn-outline-success.disabled.focus, .btn-outline-success:disabled:focus, .btn-outline-success:disabled.focus {
  border-color: #99e5a9;
}
.btn-outline-success.disabled:hover, .btn-outline-success:disabled:hover {
  border-color: #99e5a9;
}

.btn-outline-warning {
  color: #ff754b;
  background-image: none;
  background-color: transparent;
  border-color: #ff754b;
}
.btn-outline-warning:hover {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:focus, .btn-outline-warning.focus {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:active, .btn-outline-warning.active, .open > .btn-outline-warning.dropdown-toggle {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:active:hover, .btn-outline-warning:active:focus, .btn-outline-warning:active.focus, .btn-outline-warning.active:hover, .btn-outline-warning.active:focus, .btn-outline-warning.active.focus, .open > .btn-outline-warning.dropdown-toggle:hover, .open > .btn-outline-warning.dropdown-toggle:focus, .open > .btn-outline-warning.dropdown-toggle.focus {
  color: #fff;
  background-color: #f33900;
  border-color: #cb2f00;
}
.btn-outline-warning.disabled:focus, .btn-outline-warning.disabled.focus, .btn-outline-warning:disabled:focus, .btn-outline-warning:disabled.focus {
  border-color: #ffc3b1;
}
.btn-outline-warning.disabled:hover, .btn-outline-warning:disabled:hover {
  border-color: #ffc3b1;
}

.btn-outline-danger {
  color: #ff3160;
  background-image: none;
  background-color: transparent;
  border-color: #ff3160;
}
.btn-outline-danger:hover {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:focus, .btn-outline-danger.focus {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:active, .btn-outline-danger.active, .open > .btn-outline-danger.dropdown-toggle {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:active:hover, .btn-outline-danger:active:focus, .btn-outline-danger:active.focus, .btn-outline-danger.active:hover, .btn-outline-danger.active:focus, .btn-outline-danger.active.focus, .open > .btn-outline-danger.dropdown-toggle:hover, .open > .btn-outline-danger.dropdown-toggle:focus, .open > .btn-outline-danger.dropdown-toggle.focus {
  color: #fff;
  background-color: #d90032;
  border-color: #b10028;
}
.btn-outline-danger.disabled:focus, .btn-outline-danger.disabled.focus, .btn-outline-danger:disabled:focus, .btn-outline-danger:disabled.focus {
  border-color: #ff97af;
}
.btn-outline-danger.disabled:hover, .btn-outline-danger:disabled:hover {
  border-color: #ff97af;
}

.btn-link {
  font-weight: normal;
  color: #373a3c;
  border-radius: 0;
}
.btn-link, .btn-link:active, .btn-link.active, .btn-link:disabled {
  background-color: transparent;
}
.btn-link, .btn-link:focus, .btn-link:active {
  border-color: transparent;
}
.btn-link:hover {
  border-color: transparent;
}
.btn-link:focus, .btn-link:hover {
  color: #121314;
  text-decoration: none;
  background-color: transparent;
}
.btn-link:disabled:focus, .btn-link:disabled:hover {
  color: #888888;
  text-decoration: none;
}

.btn-lg, .btn-group-lg > .btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.1rem;
}

.btn-sm, .btn-group-sm > .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}

.btn-block {
  display: block;
  width: 100%;
}

.btn-block + .btn-block {
  margin-top: 0.5rem;
}

input[type=submit].btn-block,
input[type=reset].btn-block,
input[type=button].btn-block {
  width: 100%;
}

.fade {
  opacity: 0;
  transition: opacity 0.15s linear;
}
.fade.in {
  opacity: 1;
}

.collapse {
  display: none;
}
.collapse.in {
  display: block;
}

tr.collapse.in {
  display: table-row;
}

tbody.collapse.in {
  display: table-row-group;
}

.collapsing {
  position: relative;
  height: 0;
  overflow: hidden;
  transition-timing-function: ease;
  transition-duration: 0.35s;
  transition-property: height;
}

.dropup,
.dropdown {
  position: relative;
}

.dropdown-toggle::after {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 0.3em;
  vertical-align: middle;
  content: \"\";
  border-top: 0.3em solid;
  border-right: 0.3em solid transparent;
  border-left: 0.3em solid transparent;
}
.dropdown-toggle:focus {
  outline: 0;
}

.dropup .dropdown-toggle::after {
  border-top: 0;
  border-bottom: 0.3em solid;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #373a3c;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.17rem;
}

.dropdown-divider {
  height: 1px;
  margin: 0.5rem 0;
  overflow: hidden;
  background-color: #e5e5e5;
}

.dropdown-item {
  display: block;
  width: 100%;
  padding: 3px 1.5rem;
  clear: both;
  font-weight: normal;
  color: #55595c;
  text-align: inherit;
  white-space: nowrap;
  background: none;
  border: 0;
}
.dropdown-item:focus, .dropdown-item:hover {
  color: #494c4f;
  text-decoration: none;
  background-color: #f5f5f5;
}
.dropdown-item.active, .dropdown-item.active:focus, .dropdown-item.active:hover {
  color: #212121;
  text-decoration: none;
  background-color: #f5f5f5;
  outline: 0;
}
.dropdown-item.disabled, .dropdown-item.disabled:focus, .dropdown-item.disabled:hover {
  color: #888888;
}
.dropdown-item.disabled:focus, .dropdown-item.disabled:hover {
  text-decoration: none;
  cursor: not-allowed;
  background-color: transparent;
  background-image: none;
  filter: \"progid:DXImageTransform.Microsoft.gradient(enabled = false)\";
}

.open > .dropdown-menu {
  display: block;
}
.open > a {
  outline: 0;
}

.dropdown-menu-right {
  right: 0;
  left: auto;
}

.dropdown-menu-left {
  right: auto;
  left: 0;
}

.dropdown-header {
  display: block;
  padding: 0.5rem 1.5rem;
  margin-bottom: 0;
  font-size: 0.875rem;
  color: #888888;
  white-space: nowrap;
}

.dropdown-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 990;
}

.dropup .caret,
.navbar-fixed-bottom .dropdown .caret {
  content: \"\";
  border-top: 0;
  border-bottom: 0.3em solid;
}
.dropup .dropdown-menu,
.navbar-fixed-bottom .dropdown .dropdown-menu {
  top: auto;
  bottom: 100%;
  margin-bottom: 0.125rem;
}

.btn-group,
.btn-group-vertical {
  position: relative;
  display: inline-block;
  vertical-align: middle;
}
.btn-group > .btn,
.btn-group-vertical > .btn {
  position: relative;
  float: left;
  margin-bottom: 0;
}
.btn-group > .btn:focus, .btn-group > .btn:active, .btn-group > .btn.active,
.btn-group-vertical > .btn:focus,
.btn-group-vertical > .btn:active,
.btn-group-vertical > .btn.active {
  z-index: 2;
}
.btn-group > .btn:hover,
.btn-group-vertical > .btn:hover {
  z-index: 2;
}

.btn-group .btn + .btn,
.btn-group .btn + .btn-group,
.btn-group .btn-group + .btn,
.btn-group .btn-group + .btn-group {
  margin-left: -1px;
}

.btn-toolbar {
  margin-left: -0.5rem;
}
.btn-toolbar::after {
  content: \"\";
  display: table;
  clear: both;
}
.btn-toolbar .btn-group,
.btn-toolbar .input-group {
  float: left;
}
.btn-toolbar > .btn,
.btn-toolbar > .btn-group,
.btn-toolbar > .input-group {
  margin-left: 0.5rem;
}

.btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
  border-radius: 0;
}

.btn-group > .btn:first-child {
  margin-left: 0;
}
.btn-group > .btn:first-child:not(:last-child):not(.dropdown-toggle) {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.btn-group > .btn:last-child:not(:first-child),
.btn-group > .dropdown-toggle:not(:first-child) {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.btn-group > .btn-group {
  float: left;
}

.btn-group > .btn-group:not(:first-child):not(:last-child) > .btn {
  border-radius: 0;
}

.btn-group > .btn-group:first-child:not(:last-child) > .btn:last-child,
.btn-group > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.btn-group > .btn-group:last-child:not(:first-child) > .btn:first-child {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.btn-group .dropdown-toggle:active,
.btn-group.open .dropdown-toggle {
  outline: 0;
}

.btn + .dropdown-toggle-split {
  padding-right: 0.75rem;
  padding-left: 0.75rem;
}
.btn + .dropdown-toggle-split::after {
  margin-left: 0;
}

.btn-sm + .dropdown-toggle-split, .btn-group-sm > .btn + .dropdown-toggle-split {
  padding-right: 0.375rem;
  padding-left: 0.375rem;
}

.btn-lg + .dropdown-toggle-split, .btn-group-lg > .btn + .dropdown-toggle-split {
  padding-right: 1.125rem;
  padding-left: 1.125rem;
}

.btn .caret {
  margin-left: 0;
}

.btn-lg .caret, .btn-group-lg > .btn .caret {
  border-width: 0.3em 0.3em 0;
  border-bottom-width: 0;
}

.dropup .btn-lg .caret, .dropup .btn-group-lg > .btn .caret {
  border-width: 0 0.3em 0.3em;
}

.btn-group-vertical > .btn,
.btn-group-vertical > .btn-group,
.btn-group-vertical > .btn-group > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
}
.btn-group-vertical > .btn-group::after {
  content: \"\";
  display: table;
  clear: both;
}
.btn-group-vertical > .btn-group > .btn {
  float: none;
}
.btn-group-vertical > .btn + .btn,
.btn-group-vertical > .btn + .btn-group,
.btn-group-vertical > .btn-group + .btn,
.btn-group-vertical > .btn-group + .btn-group {
  margin-top: -1px;
  margin-left: 0;
}

.btn-group-vertical > .btn:not(:first-child):not(:last-child) {
  border-radius: 0;
}
.btn-group-vertical > .btn:first-child:not(:last-child) {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.btn-group-vertical > .btn:last-child:not(:first-child) {
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

.btn-group-vertical > .btn-group:not(:first-child):not(:last-child) > .btn {
  border-radius: 0;
}

.btn-group-vertical > .btn-group:first-child:not(:last-child) > .btn:last-child,
.btn-group-vertical > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.btn-group-vertical > .btn-group:last-child:not(:first-child) > .btn:first-child {
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

[data-toggle=buttons] > .btn input[type=radio],
[data-toggle=buttons] > .btn input[type=checkbox],
[data-toggle=buttons] > .btn-group > .btn input[type=radio],
[data-toggle=buttons] > .btn-group > .btn input[type=checkbox] {
  position: absolute;
  clip: rect(0, 0, 0, 0);
  pointer-events: none;
}

.input-group {
  position: relative;
  width: 100%;
  display: flex;
}
.input-group .form-control {
  position: relative;
  z-index: 2;
  flex: 1;
  margin-bottom: 0;
}
.input-group .form-control:focus, .input-group .form-control:active, .input-group .form-control:hover {
  z-index: 3;
}

.input-group-addon:not(:first-child):not(:last-child),
.input-group-btn:not(:first-child):not(:last-child),
.input-group .form-control:not(:first-child):not(:last-child) {
  border-radius: 0;
}

.input-group-addon,
.input-group-btn {
  white-space: nowrap;
  vertical-align: middle;
}

.input-group-addon {
  padding: 0.5rem 0.75rem;
  margin-bottom: 0;
  font-size: 1rem;
  font-weight: normal;
  line-height: 1.25;
  color: #55595c;
  text-align: center;
  background-color: #eceeef;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
}
.input-group-addon.form-control-sm,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .input-group-addon.btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}
.input-group-addon.form-control-lg,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .input-group-addon.btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.25rem;
}
.input-group-addon input[type=radio],
.input-group-addon input[type=checkbox] {
  margin-top: 0;
}

.input-group .form-control:not(:last-child),
.input-group-addon:not(:last-child),
.input-group-btn:not(:last-child) > .btn,
.input-group-btn:not(:last-child) > .btn-group > .btn,
.input-group-btn:not(:last-child) > .dropdown-toggle,
.input-group-btn:not(:first-child) > .btn:not(:last-child):not(.dropdown-toggle),
.input-group-btn:not(:first-child) > .btn-group:not(:last-child) > .btn {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.input-group-addon:not(:last-child) {
  border-right: 0;
}

.input-group .form-control:not(:first-child),
.input-group-addon:not(:first-child),
.input-group-btn:not(:first-child) > .btn,
.input-group-btn:not(:first-child) > .btn-group > .btn,
.input-group-btn:not(:first-child) > .dropdown-toggle,
.input-group-btn:not(:last-child) > .btn:not(:first-child),
.input-group-btn:not(:last-child) > .btn-group:not(:first-child) > .btn {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.form-control + .input-group-addon:not(:first-child) {
  border-left: 0;
}

.input-group-btn {
  position: relative;
  font-size: 0;
  white-space: nowrap;
}
.input-group-btn > .btn {
  position: relative;
}
.input-group-btn > .btn + .btn {
  margin-left: -1px;
}
.input-group-btn > .btn:focus, .input-group-btn > .btn:active, .input-group-btn > .btn:hover {
  z-index: 3;
}
.input-group-btn:not(:last-child) > .btn,
.input-group-btn:not(:last-child) > .btn-group {
  margin-right: -1px;
}
.input-group-btn:not(:first-child) > .btn,
.input-group-btn:not(:first-child) > .btn-group {
  z-index: 2;
  margin-left: -1px;
}
.input-group-btn:not(:first-child) > .btn:focus, .input-group-btn:not(:first-child) > .btn:active, .input-group-btn:not(:first-child) > .btn:hover,
.input-group-btn:not(:first-child) > .btn-group:focus,
.input-group-btn:not(:first-child) > .btn-group:active,
.input-group-btn:not(:first-child) > .btn-group:hover {
  z-index: 3;
}

.custom-control {
  position: relative;
  display: inline-block;
  padding-left: 1.5rem;
  cursor: pointer;
}
.custom-control + .custom-control {
  margin-left: 1rem;
}

.custom-control-input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.custom-control-input:checked ~ .custom-control-indicator {
  color: #fff;
  background-color: #0074d9;
}
.custom-control-input:focus ~ .custom-control-indicator {
  box-shadow: 0 0 0 0.075rem #fff, 0 0 0 0.2rem #0074d9;
}
.custom-control-input:active ~ .custom-control-indicator {
  color: #fff;
  background-color: #84c6ff;
}
.custom-control-input:disabled ~ .custom-control-indicator {
  cursor: not-allowed;
  background-color: #eee;
}
.custom-control-input:disabled ~ .custom-control-description {
  color: #767676;
  cursor: not-allowed;
}

.custom-control-indicator {
  position: absolute;
  top: 0.25rem;
  left: 0;
  display: block;
  width: 1rem;
  height: 1rem;
  pointer-events: none;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-color: #ddd;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 50% 50%;
}

.custom-checkbox .custom-control-indicator {
  border-radius: 0.17rem;
}
.custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E\");
}
.custom-checkbox .custom-control-input:indeterminate ~ .custom-control-indicator {
  background-color: #0074d9;
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3E%3Cpath stroke='#fff' d='M0 2h4'/%3E%3C/svg%3E\");
}

.custom-radio .custom-control-indicator {
  border-radius: 50%;
}
.custom-radio .custom-control-input:checked ~ .custom-control-indicator {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='#fff'/%3E%3C/svg%3E\");
}

.custom-controls-stacked .custom-control {
  float: left;
  clear: left;
}
.custom-controls-stacked .custom-control + .custom-control {
  margin-left: 0;
}

.custom-select {
  display: inline-block;
  max-width: 100%;
  height: calc(2.5rem - 2px);
  padding: 0.375rem 1.75rem 0.375rem 0.75rem;
  padding-right: 0.75rem \\9 ;
  color: #55595c;
  vertical-align: middle;
  background: #fff url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='#333' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E\") no-repeat right 0.75rem center;
  background-image: none \\9 ;
  background-size: 8px 10px;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
  -moz-appearance: none;
  -webkit-appearance: none;
}
.custom-select:focus {
  border-color: #51a7e8;
  outline: none;
}
.custom-select:focus::-ms-value {
  color: #55595c;
  background-color: #fff;
}
.custom-select:disabled {
  color: #888888;
  cursor: not-allowed;
  background-color: #eceeef;
}
.custom-select::-ms-expand {
  opacity: 0;
}

.custom-select-sm {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  font-size: 75%;
}

.custom-file {
  position: relative;
  display: inline-block;
  max-width: 100%;
  height: 2.5rem;
  cursor: pointer;
}

.custom-file-input {
  min-width: 14rem;
  max-width: 100%;
  margin: 0;
  filter: alpha(opacity=0);
  opacity: 0;
}
.custom-file-control {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  z-index: 5;
  height: 2.5rem;
  padding: 0.5rem 1rem;
  line-height: 1.5;
  color: #555;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.17rem;
}
.custom-file-control:lang(en)::after {
  content: \"Choose file...\";
}
.custom-file-control::before {
  position: absolute;
  top: -1px;
  right: -1px;
  bottom: -1px;
  z-index: 6;
  display: block;
  height: 2.5rem;
  padding: 0.5rem 1rem;
  line-height: 1.5;
  color: #555;
  background-color: #eee;
  border: 1px solid #ddd;
  border-radius: 0 0.17rem 0.17rem 0;
}
.custom-file-control:lang(en)::before {
  content: \"Browse\";
}

.nav {
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}

.nav-link {
  display: inline-block;
}
.nav-link:focus, .nav-link:hover {
  text-decoration: none;
}
.nav-link.disabled {
  color: #888888;
}
.nav-link.disabled, .nav-link.disabled:focus, .nav-link.disabled:hover {
  color: #888888;
  cursor: not-allowed;
  background-color: transparent;
}

.nav-inline .nav-item {
  display: inline-block;
}
.nav-inline .nav-item + .nav-item,
.nav-inline .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-tabs {
  border-bottom: 0 solid transparent;
}
.nav-tabs::after {
  content: \"\";
  display: table;
  clear: both;
}
.nav-tabs .nav-item {
  float: left;
  margin-bottom: 0;
}
.nav-tabs .nav-item + .nav-item {
  margin-left: 0.2rem;
}
.nav-tabs .nav-link {
  display: block;
  padding: 0.5em 1em;
  border: 0 solid transparent;
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
  border-color: transparent transparent transparent;
}
.nav-tabs .nav-link.disabled, .nav-tabs .nav-link.disabled:focus, .nav-tabs .nav-link.disabled:hover {
  color: #888888;
  background-color: transparent;
  border-color: transparent;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover,
.nav-tabs .nav-item.open .nav-link,
.nav-tabs .nav-item.open .nav-link:focus,
.nav-tabs .nav-item.open .nav-link:hover {
  color: #55595c;
  background-color: #fff;
  border-color: #ddd #ddd transparent;
}
.nav-tabs .dropdown-menu {
  margin-top: 0;
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

.nav-pills::after {
  content: \"\";
  display: table;
  clear: both;
}
.nav-pills .nav-item {
  float: left;
}
.nav-pills .nav-item + .nav-item {
  margin-left: 0.2rem;
}
.nav-pills .nav-link {
  display: block;
  padding: 0.5em 1em;
  border-radius: 0.17rem;
}
.nav-pills .nav-link.active, .nav-pills .nav-link.active:focus, .nav-pills .nav-link.active:hover,
.nav-pills .nav-item.open .nav-link,
.nav-pills .nav-item.open .nav-link:focus,
.nav-pills .nav-item.open .nav-link:hover {
  color: #fff;
  cursor: default;
  background-color: #eceeef;
}

.nav-stacked .nav-item {
  display: block;
  float: none;
}
.nav-stacked .nav-item + .nav-item {
  margin-top: 0.2rem;
  margin-left: 0;
}

.tab-content > .tab-pane {
  display: none;
}
.tab-content > .active {
  display: block;
}

.navbar {
  position: relative;
  padding: 0.5rem 1rem;
}
.navbar::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (min-width: 576px) {
  .navbar {
    border-radius: 0.17rem;
  }
}

.navbar-full {
  z-index: 1000;
}
@media (min-width: 576px) {
  .navbar-full {
    border-radius: 0;
  }
}

.navbar-fixed-top,
.navbar-fixed-bottom {
  position: fixed;
  right: 0;
  left: 0;
  z-index: 1030;
}
@media (min-width: 576px) {
  .navbar-fixed-top,
.navbar-fixed-bottom {
    border-radius: 0;
  }
}

.navbar-fixed-top {
  top: 0;
}

.navbar-fixed-bottom {
  bottom: 0;
}

.navbar-sticky-top {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1030;
  width: 100%;
}
@media (min-width: 576px) {
  .navbar-sticky-top {
    border-radius: 0;
  }
}

.navbar-brand {
  float: left;
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  margin-right: 1rem;
  font-size: 1.25rem;
  line-height: inherit;
}
.navbar-brand:focus, .navbar-brand:hover {
  text-decoration: none;
}

.navbar-divider {
  float: left;
  width: 1px;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
  margin-right: 1rem;
  margin-left: 1rem;
  overflow: hidden;
}
.navbar-divider::before {
  content: \"\\A0\";
}

.navbar-text {
  display: inline-block;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
}

.navbar-toggler {
  width: 2.5em;
  height: 2em;
  padding: 0.5rem 0.75rem;
  font-size: 1.25rem;
  line-height: 1;
  background: transparent no-repeat center center;
  background-size: 24px 24px;
  border: 1px solid transparent;
  border-radius: 0.1rem;
}
.navbar-toggler:focus, .navbar-toggler:hover {
  text-decoration: none;
}

.navbar-toggleable-xs::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 575px) {
  .navbar-toggleable-xs .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-xs .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-xs .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 576px) {
  .navbar-toggleable-xs {
    display: block;
  }
}
.navbar-toggleable-sm::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 767px) {
  .navbar-toggleable-sm .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-sm .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-sm .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 768px) {
  .navbar-toggleable-sm {
    display: block;
  }
}
.navbar-toggleable-md::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 991px) {
  .navbar-toggleable-md .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-md .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-md .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 992px) {
  .navbar-toggleable-md {
    display: block;
  }
}
.navbar-toggleable-lg::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 1199px) {
  .navbar-toggleable-lg .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-lg .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-lg .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 1200px) {
  .navbar-toggleable-lg {
    display: block;
  }
}
.navbar-toggleable-xl {
  display: block;
}
.navbar-toggleable-xl::after {
  content: \"\";
  display: table;
  clear: both;
}
.navbar-toggleable-xl .navbar-brand {
  display: block;
  float: none;
  margin-top: 0.5rem;
  margin-right: 0;
}
.navbar-toggleable-xl .navbar-nav {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}
.navbar-toggleable-xl .navbar-nav .dropdown-menu {
  position: static;
  float: none;
}

.navbar-nav .nav-item {
  float: left;
}
.navbar-nav .nav-link {
  display: block;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
}
.navbar-nav .nav-link + .nav-link {
  margin-left: 1rem;
}
.navbar-nav .nav-item + .nav-item {
  margin-left: 1rem;
}

.navbar-light .navbar-brand,
.navbar-light .navbar-toggler {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover,
.navbar-light .navbar-toggler:focus,
.navbar-light .navbar-toggler:hover {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-nav .nav-link {
  color: rgba(0, 0, 0, 0.3);
}
.navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
  color: rgba(0, 0, 0, 0.5);
}
.navbar-light .navbar-nav .open > .nav-link, .navbar-light .navbar-nav .open > .nav-link:focus, .navbar-light .navbar-nav .open > .nav-link:hover,
.navbar-light .navbar-nav .active > .nav-link,
.navbar-light .navbar-nav .active > .nav-link:focus,
.navbar-light .navbar-nav .active > .nav-link:hover,
.navbar-light .navbar-nav .nav-link.open,
.navbar-light .navbar-nav .nav-link.open:focus,
.navbar-light .navbar-nav .nav-link.open:hover,
.navbar-light .navbar-nav .nav-link.active,
.navbar-light .navbar-nav .nav-link.active:focus,
.navbar-light .navbar-nav .nav-link.active:hover {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-toggler {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 0, 0, 0.3)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E\");
  border-color: rgba(0, 0, 0, 0.1);
}
.navbar-light .navbar-divider {
  background-color: rgba(0, 0, 0, 0.075);
}

.navbar-dark .navbar-brand,
.navbar-dark .navbar-toggler {
  color: white;
}
.navbar-dark .navbar-brand:focus, .navbar-dark .navbar-brand:hover,
.navbar-dark .navbar-toggler:focus,
.navbar-dark .navbar-toggler:hover {
  color: white;
}
.navbar-dark .navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.5);
}
.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
  color: rgba(255, 255, 255, 0.75);
}
.navbar-dark .navbar-nav .open > .nav-link, .navbar-dark .navbar-nav .open > .nav-link:focus, .navbar-dark .navbar-nav .open > .nav-link:hover,
.navbar-dark .navbar-nav .active > .nav-link,
.navbar-dark .navbar-nav .active > .nav-link:focus,
.navbar-dark .navbar-nav .active > .nav-link:hover,
.navbar-dark .navbar-nav .nav-link.open,
.navbar-dark .navbar-nav .nav-link.open:focus,
.navbar-dark .navbar-nav .nav-link.open:hover,
.navbar-dark .navbar-nav .nav-link.active,
.navbar-dark .navbar-nav .nav-link.active:focus,
.navbar-dark .navbar-nav .nav-link.active:hover {
  color: white;
}
.navbar-dark .navbar-toggler {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E\");
  border-color: rgba(255, 255, 255, 0.1);
}
.navbar-dark .navbar-divider {
  background-color: rgba(255, 255, 255, 0.075);
}

.navbar-toggleable-xs::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 575px) {
  .navbar-toggleable-xs .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 576px) {
  .navbar-toggleable-xs {
    display: block !important;
  }
}
.navbar-toggleable-sm::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 767px) {
  .navbar-toggleable-sm .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 768px) {
  .navbar-toggleable-sm {
    display: block !important;
  }
}
.navbar-toggleable-md::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 991px) {
  .navbar-toggleable-md .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 992px) {
  .navbar-toggleable-md {
    display: block !important;
  }
}

.card {
  position: relative;
  display: block;
  margin-bottom: 0.75rem;
  background-color: #fff;
  border-radius: 0.1rem;
  border: 0 solid rgba(0, 0, 0, 0.125);
}

.card-block {
  padding: 1.25rem;
}
.card-block::after {
  content: \"\";
  display: table;
  clear: both;
}

.card-title {
  margin-bottom: 0.75rem;
}

.card-subtitle {
  margin-top: -0.375rem;
  margin-bottom: 0;
}

.card-text:last-child {
  margin-bottom: 0;
}

.card-link:hover {
  text-decoration: none;
}
.card-link + .card-link {
  margin-left: 1.25rem;
}

.card > .list-group:first-child .list-group-item:first-child {
  border-top-right-radius: 0.1rem;
  border-top-left-radius: 0.1rem;
}
.card > .list-group:last-child .list-group-item:last-child {
  border-bottom-right-radius: 0.1rem;
  border-bottom-left-radius: 0.1rem;
}

.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: #f5f5f5;
  border-bottom: 0 solid rgba(0, 0, 0, 0.125);
}
.card-header::after {
  content: \"\";
  display: table;
  clear: both;
}
.card-header:first-child {
  border-radius: calc(0.1rem - 0) calc(0.1rem - 0) 0 0;
}

.card-footer {
  padding: 0.75rem 1.25rem;
  background-color: #f5f5f5;
  border-top: 0 solid rgba(0, 0, 0, 0.125);
}
.card-footer::after {
  content: \"\";
  display: table;
  clear: both;
}
.card-footer:last-child {
  border-radius: 0 0 calc(0.1rem - 0) calc(0.1rem - 0);
}

.card-header-tabs {
  margin-right: -0.625rem;
  margin-bottom: -0.75rem;
  margin-left: -0.625rem;
  border-bottom: 0;
}

.card-header-pills {
  margin-right: -0.625rem;
  margin-left: -0.625rem;
}

.card-primary {
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.card-primary .card-header,
.card-primary .card-footer {
  background-color: transparent;
}

.card-success {
  background-color: #47d165;
  border-color: #47d165;
}
.card-success .card-header,
.card-success .card-footer {
  background-color: transparent;
}

.card-info {
  background-color: #11bef6;
  border-color: #11bef6;
}
.card-info .card-header,
.card-info .card-footer {
  background-color: transparent;
}

.card-warning {
  background-color: #ff754b;
  border-color: #ff754b;
}
.card-warning .card-header,
.card-warning .card-footer {
  background-color: transparent;
}

.card-danger {
  background-color: #ff3160;
  border-color: #ff3160;
}
.card-danger .card-header,
.card-danger .card-footer {
  background-color: transparent;
}

.card-outline-primary {
  background-color: transparent;
  border-color: #b21cc3;
}

.card-outline-secondary {
  background-color: transparent;
  border-color: #ccc;
}

.card-outline-info {
  background-color: transparent;
  border-color: #11bef6;
}

.card-outline-success {
  background-color: transparent;
  border-color: #47d165;
}

.card-outline-warning {
  background-color: transparent;
  border-color: #ff754b;
}

.card-outline-danger {
  background-color: transparent;
  border-color: #ff3160;
}

.card-inverse .card-header,
.card-inverse .card-footer {
  border-color: rgba(255, 255, 255, 0.2);
}
.card-inverse .card-header,
.card-inverse .card-footer,
.card-inverse .card-title,
.card-inverse .card-blockquote {
  color: #fff;
}
.card-inverse .card-link,
.card-inverse .card-text,
.card-inverse .card-subtitle,
.card-inverse .card-blockquote .blockquote-footer {
  color: rgba(255, 255, 255, 0.65);
}
.card-inverse .card-link:focus, .card-inverse .card-link:hover {
  color: #fff;
}

.card-blockquote {
  padding: 0;
  margin-bottom: 0;
  border-left: 0;
}

.card-img {
  border-radius: calc(0.1rem - 0);
}

.card-img-overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1.25rem;
}

.card-img-top {
  border-top-right-radius: calc(0.1rem - 0);
  border-top-left-radius: calc(0.1rem - 0);
}

.card-img-bottom {
  border-bottom-right-radius: calc(0.1rem - 0);
  border-bottom-left-radius: calc(0.1rem - 0);
}

@media (min-width: 576px) {
  .card-deck {
    display: flex;
    flex-flow: row wrap;
    margin-right: -0.625rem;
    margin-bottom: 0.75rem;
    margin-left: -0.625rem;
  }
  .card-deck .card {
    flex: 1 0 0;
    margin-right: 0.625rem;
    margin-bottom: 0;
    margin-left: 0.625rem;
  }
}
@media (min-width: 576px) {
  .card-group {
    display: flex;
    flex-flow: row wrap;
  }
  .card-group .card {
    flex: 1 0 0;
  }
  .card-group .card + .card {
    margin-left: 0;
    border-left: 0;
  }
  .card-group .card:first-child {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
  }
  .card-group .card:first-child .card-img-top {
    border-top-right-radius: 0;
  }
  .card-group .card:first-child .card-img-bottom {
    border-bottom-right-radius: 0;
  }
  .card-group .card:last-child {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
  }
  .card-group .card:last-child .card-img-top {
    border-top-left-radius: 0;
  }
  .card-group .card:last-child .card-img-bottom {
    border-bottom-left-radius: 0;
  }
  .card-group .card:not(:first-child):not(:last-child) {
    border-radius: 0;
  }
  .card-group .card:not(:first-child):not(:last-child) .card-img-top,
.card-group .card:not(:first-child):not(:last-child) .card-img-bottom {
    border-radius: 0;
  }
}
@media (min-width: 576px) {
  .card-columns {
    -webkit-column-count: 3;
            column-count: 3;
    -webkit-column-gap: 1.25rem;
            column-gap: 1.25rem;
  }
  .card-columns .card {
    display: inline-block;
    width: 100%;
  }
}
.breadcrumb {
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
  list-style: none;
  background-color: #eaeced;
  border-radius: 0.17rem;
}
.breadcrumb::after {
  content: \"\";
  display: table;
  clear: both;
}

.breadcrumb-item {
  float: left;
}
.breadcrumb-item + .breadcrumb-item::before {
  display: inline-block;
  padding-right: 0.5rem;
  padding-left: 0.5rem;
  color: #888888;
  content: \"/\";
}
.breadcrumb-item + .breadcrumb-item:hover::before {
  text-decoration: underline;
}
.breadcrumb-item + .breadcrumb-item:hover::before {
  text-decoration: none;
}
.breadcrumb-item.active {
  color: #bbbbbb;
}

.pagination {
  display: inline-block;
  padding-left: 0;
  margin-top: 1rem;
  margin-bottom: 1rem;
  border-radius: 0.17rem;
}

.page-item {
  display: inline;
}
.page-item:first-child .page-link {
  margin-left: 0;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.page-item:last-child .page-link {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}
.page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
  z-index: 2;
  color: #fff;
  cursor: default;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.page-item.disabled .page-link, .page-item.disabled .page-link:focus, .page-item.disabled .page-link:hover {
  color: #888888;
  pointer-events: none;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}

.page-link {
  position: relative;
  float: left;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  color: #373a3c;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.page-link:focus, .page-link:hover {
  color: #121314;
  background-color: #eceeef;
  border-color: #ddd;
}

.pagination-lg .page-link {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
}
.pagination-lg .page-item:first-child .page-link {
  border-bottom-left-radius: 0.25rem;
  border-top-left-radius: 0.25rem;
}
.pagination-lg .page-item:last-child .page-link {
  border-bottom-right-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}

.pagination-sm .page-link {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}
.pagination-sm .page-item:first-child .page-link {
  border-bottom-left-radius: 0.1rem;
  border-top-left-radius: 0.1rem;
}
.pagination-sm .page-item:last-child .page-link {
  border-bottom-right-radius: 0.1rem;
  border-top-right-radius: 0.1rem;
}

.tag {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: bold;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.17rem;
}
.tag:empty {
  display: none;
}

.btn .tag {
  position: relative;
  top: -1px;
}

a.tag:focus, a.tag:hover {
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}

.tag-pill {
  padding-right: 0.6em;
  padding-left: 0.6em;
  border-radius: 10rem;
}

.tag-default {
  background-color: #888888;
}
.tag-default[href]:focus, .tag-default[href]:hover {
  background-color: #6f6f6f;
}

.tag-primary {
  background-color: #b21cc3;
}
.tag-primary[href]:focus, .tag-primary[href]:hover {
  background-color: #891696;
}

.tag-success {
  background-color: #47d165;
}
.tag-success[href]:focus, .tag-success[href]:hover {
  background-color: #2eb74c;
}

.tag-info {
  background-color: #11bef6;
}
.tag-info[href]:focus, .tag-info[href]:hover {
  background-color: #089ccc;
}

.tag-warning {
  background-color: #ff754b;
}
.tag-warning[href]:focus, .tag-warning[href]:hover {
  background-color: #ff4e18;
}

.tag-danger {
  background-color: #ff3160;
}
.tag-danger[href]:focus, .tag-danger[href]:hover {
  background-color: #fd003a;
}

.jumbotron {
  padding: 2rem 1rem;
  margin-bottom: 2rem;
  background-color: #eceeef;
  border-radius: 0.25rem;
}
@media (min-width: 576px) {
  .jumbotron {
    padding: 4rem 2rem;
  }
}

.jumbotron-hr {
  border-top-color: #d0d5d8;
}

.jumbotron-fluid {
  padding-right: 0;
  padding-left: 0;
  border-radius: 0;
}

.alert {
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.1rem;
}

.alert-heading {
  color: inherit;
}

.alert-link {
  font-weight: bold;
}

.alert-dismissible {
  padding-right: 2.5rem;
}
.alert-dismissible .close {
  position: relative;
  top: -0.125rem;
  right: -1.25rem;
  color: inherit;
}

.alert-success {
  background-color: #47d165;
  border-color: #47d165;
  color: #ffffff;
}
.alert-success hr {
  border-top-color: #33cc54;
}
.alert-success .alert-link {
  color: #e6e6e6;
}

.alert-info {
  background-color: #11bef6;
  border-color: #11bef6;
  color: #ffffff;
}
.alert-info hr {
  border-top-color: #09afe5;
}
.alert-info .alert-link {
  color: #e6e6e6;
}

.alert-warning {
  background-color: #ff754b;
  border-color: #ff754b;
  color: #ffffff;
}
.alert-warning hr {
  border-top-color: #ff6132;
}
.alert-warning .alert-link {
  color: #e6e6e6;
}

.alert-danger {
  background-color: #ff3160;
  border-color: #ff3160;
  color: #ffffff;
}
.alert-danger hr {
  border-top-color: #ff184c;
}
.alert-danger .alert-link {
  color: #e6e6e6;
}

@-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

@keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}
.progress {
  display: block;
  width: 100%;
  height: 1rem;
  margin-bottom: 1rem;
}

.progress[value] {
  background-color: #cccccc;
  border: 0;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border-radius: 0.17rem;
}

.progress[value]::-ms-fill {
  background-color: #b21cc3;
  border: 0;
}

.progress[value]::-moz-progress-bar {
  background-color: #b21cc3;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.progress[value]::-webkit-progress-value {
  background-color: #b21cc3;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.progress[value=\"100\"]::-moz-progress-bar {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.progress[value=\"100\"]::-webkit-progress-value {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.progress[value]::-webkit-progress-bar {
  background-color: #cccccc;
  border-radius: 0.17rem;
}

base::-moz-progress-bar,
.progress[value] {
  background-color: #cccccc;
  border-radius: 0.17rem;
}

@media screen and (min-width: 0\\0 ) {
  .progress {
    background-color: #cccccc;
    border-radius: 0.17rem;
  }

  .progress-bar {
    display: inline-block;
    height: 1rem;
    text-indent: -999rem;
    background-color: #b21cc3;
    border-bottom-left-radius: 0.17rem;
    border-top-left-radius: 0.17rem;
  }

  .progress[width=\"100%\"] {
    border-bottom-right-radius: 0.17rem;
    border-top-right-radius: 0.17rem;
  }
}
.progress-striped[value]::-webkit-progress-value {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-striped[value]::-moz-progress-bar {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-striped[value]::-ms-fill {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

@media screen and (min-width: 0\\0 ) {
  .progress-bar-striped {
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
  }
}
.progress-animated[value]::-webkit-progress-value {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
          animation: progress-bar-stripes 2s linear infinite;
}

.progress-animated[value]::-moz-progress-bar {
  animation: progress-bar-stripes 2s linear infinite;
}

@media screen and (min-width: 0\\0 ) {
  .progress-animated .progress-bar-striped {
    -webkit-animation: progress-bar-stripes 2s linear infinite;
            animation: progress-bar-stripes 2s linear infinite;
  }
}
.progress-success[value]::-webkit-progress-value {
  background-color: #47d165;
}
.progress-success[value]::-moz-progress-bar {
  background-color: #47d165;
}
.progress-success[value]::-ms-fill {
  background-color: #47d165;
}
@media screen and (min-width: 0\\0 ) {
  .progress-success .progress-bar {
    background-color: #47d165;
  }
}

.progress-info[value]::-webkit-progress-value {
  background-color: #11bef6;
}
.progress-info[value]::-moz-progress-bar {
  background-color: #11bef6;
}
.progress-info[value]::-ms-fill {
  background-color: #11bef6;
}
@media screen and (min-width: 0\\0 ) {
  .progress-info .progress-bar {
    background-color: #11bef6;
  }
}

.progress-warning[value]::-webkit-progress-value {
  background-color: #ff754b;
}
.progress-warning[value]::-moz-progress-bar {
  background-color: #ff754b;
}
.progress-warning[value]::-ms-fill {
  background-color: #ff754b;
}
@media screen and (min-width: 0\\0 ) {
  .progress-warning .progress-bar {
    background-color: #ff754b;
  }
}

.progress-danger[value]::-webkit-progress-value {
  background-color: #ff3160;
}
.progress-danger[value]::-moz-progress-bar {
  background-color: #ff3160;
}
.progress-danger[value]::-ms-fill {
  background-color: #ff3160;
}
@media screen and (min-width: 0\\0 ) {
  .progress-danger .progress-bar {
    background-color: #ff3160;
  }
}

.media {
  display: flex;
}

.media-body {
  flex: 1;
}

.media-middle {
  align-self: center;
}

.media-bottom {
  align-self: flex-end;
}

.media-object {
  display: block;
}
.media-object.img-thumbnail {
  max-width: none;
}

.media-right {
  padding-left: 10px;
}

.media-left {
  padding-right: 10px;
}

.media-heading {
  margin-top: 0;
  margin-bottom: 5px;
}

.media-list {
  padding-left: 0;
  list-style: none;
}

.list-group {
  padding-left: 0;
  margin-bottom: 0;
}

.list-group-item {
  position: relative;
  display: block;
  padding: 0.75rem 1.25rem;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.list-group-item:first-child {
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.list-group-item:last-child {
  margin-bottom: 0;
  border-bottom-right-radius: 0.17rem;
  border-bottom-left-radius: 0.17rem;
}
.list-group-item.disabled, .list-group-item.disabled:focus, .list-group-item.disabled:hover {
  color: #888888;
  cursor: not-allowed;
  background-color: #eceeef;
}
.list-group-item.disabled .list-group-item-heading, .list-group-item.disabled:focus .list-group-item-heading, .list-group-item.disabled:hover .list-group-item-heading {
  color: inherit;
}
.list-group-item.disabled .list-group-item-text, .list-group-item.disabled:focus .list-group-item-text, .list-group-item.disabled:hover .list-group-item-text {
  color: #888888;
}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
  z-index: 2;
  color: #fff;
  text-decoration: none;
  background-color: #11bef6;
  border-color: #11bef6;
}
.list-group-item.active .list-group-item-heading,
.list-group-item.active .list-group-item-heading > small,
.list-group-item.active .list-group-item-heading > .small, .list-group-item.active:focus .list-group-item-heading,
.list-group-item.active:focus .list-group-item-heading > small,
.list-group-item.active:focus .list-group-item-heading > .small, .list-group-item.active:hover .list-group-item-heading,
.list-group-item.active:hover .list-group-item-heading > small,
.list-group-item.active:hover .list-group-item-heading > .small {
  color: inherit;
}
.list-group-item.active .list-group-item-text, .list-group-item.active:focus .list-group-item-text, .list-group-item.active:hover .list-group-item-text {
  color: #d6f4fd;
}

.list-group-flush .list-group-item {
  border-right: 0;
  border-left: 0;
  border-radius: 0;
}

.list-group-item-action {
  width: 100%;
  color: #555;
  text-align: inherit;
}
.list-group-item-action .list-group-item-heading {
  color: #333;
}
.list-group-item-action:focus, .list-group-item-action:hover {
  color: #555;
  text-decoration: none;
  background-color: #f5f5f5;
}

.list-group-item-success {
  color: #ffffff;
  background-color: #47d165;
}

a.list-group-item-success,
button.list-group-item-success {
  color: #ffffff;
}
a.list-group-item-success .list-group-item-heading,
button.list-group-item-success .list-group-item-heading {
  color: inherit;
}
a.list-group-item-success:focus, a.list-group-item-success:hover,
button.list-group-item-success:focus,
button.list-group-item-success:hover {
  color: #ffffff;
  background-color: #33cc54;
}
a.list-group-item-success.active, a.list-group-item-success.active:focus, a.list-group-item-success.active:hover,
button.list-group-item-success.active,
button.list-group-item-success.active:focus,
button.list-group-item-success.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-info {
  color: #ffffff;
  background-color: #11bef6;
}

a.list-group-item-info,
button.list-group-item-info {
  color: #ffffff;
}
a.list-group-item-info .list-group-item-heading,
button.list-group-item-info .list-group-item-heading {
  color: inherit;
}
a.list-group-item-info:focus, a.list-group-item-info:hover,
button.list-group-item-info:focus,
button.list-group-item-info:hover {
  color: #ffffff;
  background-color: #09afe5;
}
a.list-group-item-info.active, a.list-group-item-info.active:focus, a.list-group-item-info.active:hover,
button.list-group-item-info.active,
button.list-group-item-info.active:focus,
button.list-group-item-info.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-warning {
  color: #ffffff;
  background-color: #ff754b;
}

a.list-group-item-warning,
button.list-group-item-warning {
  color: #ffffff;
}
a.list-group-item-warning .list-group-item-heading,
button.list-group-item-warning .list-group-item-heading {
  color: inherit;
}
a.list-group-item-warning:focus, a.list-group-item-warning:hover,
button.list-group-item-warning:focus,
button.list-group-item-warning:hover {
  color: #ffffff;
  background-color: #ff6132;
}
a.list-group-item-warning.active, a.list-group-item-warning.active:focus, a.list-group-item-warning.active:hover,
button.list-group-item-warning.active,
button.list-group-item-warning.active:focus,
button.list-group-item-warning.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-danger {
  color: #ffffff;
  background-color: #ff3160;
}

a.list-group-item-danger,
button.list-group-item-danger {
  color: #ffffff;
}
a.list-group-item-danger .list-group-item-heading,
button.list-group-item-danger .list-group-item-heading {
  color: inherit;
}
a.list-group-item-danger:focus, a.list-group-item-danger:hover,
button.list-group-item-danger:focus,
button.list-group-item-danger:hover {
  color: #ffffff;
  background-color: #ff184c;
}
a.list-group-item-danger.active, a.list-group-item-danger.active:focus, a.list-group-item-danger.active:hover,
button.list-group-item-danger.active,
button.list-group-item-danger.active:focus,
button.list-group-item-danger.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-heading {
  margin-top: 0;
  margin-bottom: 5px;
}

.list-group-item-text {
  margin-bottom: 0;
  line-height: 1.3;
}

.embed-responsive {
  position: relative;
  display: block;
  height: 0;
  padding: 0;
  overflow: hidden;
}
.embed-responsive .embed-responsive-item,
.embed-responsive iframe,
.embed-responsive embed,
.embed-responsive object,
.embed-responsive video {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}

.embed-responsive-21by9 {
  padding-bottom: 42.8571428571%;
}

.embed-responsive-16by9 {
  padding-bottom: 56.25%;
}

.embed-responsive-4by3 {
  padding-bottom: 75%;
}

.embed-responsive-1by1 {
  padding-bottom: 100%;
}

.close {
  float: right;
  font-size: 1.5rem;
  font-weight: bold;
  line-height: 1;
  color: #ffffff;
  text-shadow: 1px 1px 0 rgba(66, 66, 66, 0.1);
  opacity: 0.2;
}
.close:focus, .close:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
  opacity: 0.5;
}

button.close {
  padding: 0;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
}

.modal-open {
  overflow: hidden;
}

.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  outline: 0;
}
.modal.fade .modal-dialog {
  transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  -webkit-transform: translate(0, -25%);
          transform: translate(0, -25%);
}
.modal.in .modal-dialog {
  -webkit-transform: translate(0, 0);
          transform: translate(0, 0);
}

.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}

.modal-dialog {
  position: relative;
  width: auto;
  margin: 10px;
}

.modal-content {
  position: relative;
  background-color: #fff;
  background-clip: padding-box;
  border: 0 solid transparent;
  border-radius: 0.25rem;
  outline: 0;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  background-color: #212121;
}
.modal-backdrop.fade {
  opacity: 0;
}
.modal-backdrop.in {
  opacity: 0.8;
}

.modal-header {
  padding: 15px;
  border-bottom: 0 solid #e5e5e5;
}
.modal-header::after {
  content: \"\";
  display: table;
  clear: both;
}

.modal-header .close {
  margin-top: -2px;
}

.modal-title {
  margin: 0;
  line-height: 1.5;
}

.modal-body {
  position: relative;
  padding: 15px;
}

.modal-footer {
  padding: 15px;
  text-align: right;
  border-top: 0 solid #e5e5e5;
}
.modal-footer::after {
  content: \"\";
  display: table;
  clear: both;
}

.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll;
}

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 600px;
    margin: 30px auto;
  }

  .modal-sm {
    max-width: 300px;
  }
}
@media (min-width: 992px) {
  .modal-lg {
    max-width: 900px;
  }
}
.tooltip {
  position: absolute;
  z-index: 1070;
  display: block;
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-style: normal;
  font-weight: normal;
  letter-spacing: normal;
  line-break: auto;
  line-height: 1.5;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  white-space: normal;
  word-break: normal;
  word-spacing: normal;
  font-size: 0.875rem;
  word-wrap: break-word;
  opacity: 0;
}
.tooltip.in {
  opacity: 0.9;
}
.tooltip.tooltip-top, .tooltip.bs-tether-element-attached-bottom {
  padding: 5px 0;
  margin-top: -3px;
}
.tooltip.tooltip-top .tooltip-inner::before, .tooltip.bs-tether-element-attached-bottom .tooltip-inner::before {
  bottom: 0;
  left: 50%;
  margin-left: -5px;
  content: \"\";
  border-width: 5px 5px 0;
  border-top-color: #212121;
}
.tooltip.tooltip-right, .tooltip.bs-tether-element-attached-left {
  padding: 0 5px;
  margin-left: 3px;
}
.tooltip.tooltip-right .tooltip-inner::before, .tooltip.bs-tether-element-attached-left .tooltip-inner::before {
  top: 50%;
  left: 0;
  margin-top: -5px;
  content: \"\";
  border-width: 5px 5px 5px 0;
  border-right-color: #212121;
}
.tooltip.tooltip-bottom, .tooltip.bs-tether-element-attached-top {
  padding: 5px 0;
  margin-top: 3px;
}
.tooltip.tooltip-bottom .tooltip-inner::before, .tooltip.bs-tether-element-attached-top .tooltip-inner::before {
  top: 0;
  left: 50%;
  margin-left: -5px;
  content: \"\";
  border-width: 0 5px 5px;
  border-bottom-color: #212121;
}
.tooltip.tooltip-left, .tooltip.bs-tether-element-attached-right {
  padding: 0 5px;
  margin-left: -3px;
}
.tooltip.tooltip-left .tooltip-inner::before, .tooltip.bs-tether-element-attached-right .tooltip-inner::before {
  top: 50%;
  right: 0;
  margin-top: -5px;
  content: \"\";
  border-width: 5px 0 5px 5px;
  border-left-color: #212121;
}

.tooltip-inner {
  max-width: 200px;
  padding: 3px 8px;
  color: #fff;
  text-align: center;
  background-color: #212121;
  border-radius: 0.17rem;
}
.tooltip-inner::before {
  position: absolute;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}

.popover {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1060;
  display: block;
  max-width: 276px;
  padding: 1px;
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-style: normal;
  font-weight: normal;
  letter-spacing: normal;
  line-break: auto;
  line-height: 1.5;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  white-space: normal;
  word-break: normal;
  word-spacing: normal;
  font-size: 0.875rem;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.25rem;
}
.popover.popover-top, .popover.bs-tether-element-attached-bottom {
  margin-top: -10px;
}
.popover.popover-top::before, .popover.popover-top::after, .popover.bs-tether-element-attached-bottom::before, .popover.bs-tether-element-attached-bottom::after {
  left: 50%;
  border-bottom-width: 0;
}
.popover.popover-top::before, .popover.bs-tether-element-attached-bottom::before {
  bottom: -11px;
  margin-left: -11px;
  border-top-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-top::after, .popover.bs-tether-element-attached-bottom::after {
  bottom: -10px;
  margin-left: -10px;
  border-top-color: #fff;
}
.popover.popover-right, .popover.bs-tether-element-attached-left {
  margin-left: 10px;
}
.popover.popover-right::before, .popover.popover-right::after, .popover.bs-tether-element-attached-left::before, .popover.bs-tether-element-attached-left::after {
  top: 50%;
  border-left-width: 0;
}
.popover.popover-right::before, .popover.bs-tether-element-attached-left::before {
  left: -11px;
  margin-top: -11px;
  border-right-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-right::after, .popover.bs-tether-element-attached-left::after {
  left: -10px;
  margin-top: -10px;
  border-right-color: #fff;
}
.popover.popover-bottom, .popover.bs-tether-element-attached-top {
  margin-top: 10px;
}
.popover.popover-bottom::before, .popover.popover-bottom::after, .popover.bs-tether-element-attached-top::before, .popover.bs-tether-element-attached-top::after {
  left: 50%;
  border-top-width: 0;
}
.popover.popover-bottom::before, .popover.bs-tether-element-attached-top::before {
  top: -11px;
  margin-left: -11px;
  border-bottom-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-bottom::after, .popover.bs-tether-element-attached-top::after {
  top: -10px;
  margin-left: -10px;
  border-bottom-color: #f7f7f7;
}
.popover.popover-bottom .popover-title::before, .popover.bs-tether-element-attached-top .popover-title::before {
  position: absolute;
  top: 0;
  left: 50%;
  display: block;
  width: 20px;
  margin-left: -10px;
  content: \"\";
  border-bottom: 1px solid #f7f7f7;
}
.popover.popover-left, .popover.bs-tether-element-attached-right {
  margin-left: -10px;
}
.popover.popover-left::before, .popover.popover-left::after, .popover.bs-tether-element-attached-right::before, .popover.bs-tether-element-attached-right::after {
  top: 50%;
  border-right-width: 0;
}
.popover.popover-left::before, .popover.bs-tether-element-attached-right::before {
  right: -11px;
  margin-top: -11px;
  border-left-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-left::after, .popover.bs-tether-element-attached-right::after {
  right: -10px;
  margin-top: -10px;
  border-left-color: #fff;
}

.popover-title {
  padding: 8px 14px;
  margin: 0;
  font-size: 1rem;
  background-color: #f7f7f7;
  border-bottom: 1px solid #ebebeb;
  border-radius: 0.1875rem 0.1875rem 0 0;
}
.popover-title:empty {
  display: none;
}

.popover-content {
  padding: 9px 14px;
}

.popover::before,
.popover::after {
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}

.popover::before {
  content: \"\";
  border-width: 11px;
}

.popover::after {
  content: \"\";
  border-width: 10px;
}

.carousel {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden;
}
.carousel-inner > .carousel-item {
  position: relative;
  display: none;
  transition: 0.6s ease-in-out left;
}
.carousel-inner > .carousel-item > img,
.carousel-inner > .carousel-item > a > img {
  line-height: 1;
}
@media all and (transform-3d), (-webkit-transform-3d) {
  .carousel-inner > .carousel-item {
    transition: -webkit-transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out, -webkit-transform 0.6s ease-in-out;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    -webkit-perspective: 1000px;
            perspective: 1000px;
  }
  .carousel-inner > .carousel-item.next, .carousel-inner > .carousel-item.active.right {
    left: 0;
    -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
  }
  .carousel-inner > .carousel-item.prev, .carousel-inner > .carousel-item.active.left {
    left: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
  }
  .carousel-inner > .carousel-item.next.left, .carousel-inner > .carousel-item.prev.right, .carousel-inner > .carousel-item.active {
    left: 0;
    -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
  }
}
.carousel-inner > .active,
.carousel-inner > .next,
.carousel-inner > .prev {
  display: block;
}
.carousel-inner > .active {
  left: 0;
}
.carousel-inner > .next,
.carousel-inner > .prev {
  position: absolute;
  top: 0;
  width: 100%;
}
.carousel-inner > .next {
  left: 100%;
}
.carousel-inner > .prev {
  left: -100%;
}
.carousel-inner > .next.left,
.carousel-inner > .prev.right {
  left: 0;
}
.carousel-inner > .active.left {
  left: -100%;
}
.carousel-inner > .active.right {
  left: 100%;
}

.carousel-control {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 15%;
  font-size: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  opacity: 0.5;
}
.carousel-control.left {
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.0001) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#80000000\", endColorstr=\"#00000000\", GradientType=1);
}
.carousel-control.right {
  right: 0;
  left: auto;
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0%, rgba(0, 0, 0, 0.5) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#00000000\", endColorstr=\"#80000000\", GradientType=1);
}
.carousel-control:focus, .carousel-control:hover {
  color: #fff;
  text-decoration: none;
  outline: 0;
  opacity: 0.9;
}
.carousel-control .icon-prev,
.carousel-control .icon-next {
  position: absolute;
  top: 50%;
  z-index: 5;
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  font-family: serif;
  line-height: 1;
}
.carousel-control .icon-prev {
  left: 50%;
  margin-left: -10px;
}
.carousel-control .icon-next {
  right: 50%;
  margin-right: -10px;
}
.carousel-control .icon-prev::before {
  content: \"\\2039\";
}
.carousel-control .icon-next::before {
  content: \"\\203A\";
}

.carousel-indicators {
  position: absolute;
  bottom: 10px;
  left: 50%;
  z-index: 15;
  width: 60%;
  padding-left: 0;
  margin-left: -30%;
  text-align: center;
  list-style: none;
}
.carousel-indicators li {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 1px;
  text-indent: -999px;
  cursor: pointer;
  background-color: rgba(0, 0, 0, 0);
  border: 1px solid #fff;
  border-radius: 10px;
}
.carousel-indicators .active {
  width: 12px;
  height: 12px;
  margin: 0;
  background-color: #fff;
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
}
.carousel-caption .btn {
  text-shadow: none;
}

@media (min-width: 576px) {
  .carousel-control .icon-prev,
.carousel-control .icon-next {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    font-size: 30px;
  }
  .carousel-control .icon-prev {
    margin-left: -15px;
  }
  .carousel-control .icon-next {
    margin-right: -15px;
  }

  .carousel-caption {
    right: 20%;
    left: 20%;
    padding-bottom: 30px;
  }

  .carousel-indicators {
    bottom: 20px;
  }
}
.align-baseline {
  vertical-align: baseline !important;
}

.align-top {
  vertical-align: top !important;
}

.align-middle {
  vertical-align: middle !important;
}

.align-bottom {
  vertical-align: bottom !important;
}

.align-text-bottom {
  vertical-align: text-bottom !important;
}

.align-text-top {
  vertical-align: text-top !important;
}

.bg-faded {
  background-color: #f7f7f9;
}

.bg-primary {
  background-color: #b21cc3 !important;
}

a.bg-primary:focus, a.bg-primary:hover {
  background-color: #891696 !important;
}

.bg-success {
  background-color: #47d165 !important;
}

a.bg-success:focus, a.bg-success:hover {
  background-color: #2eb74c !important;
}

.bg-info {
  background-color: #11bef6 !important;
}

a.bg-info:focus, a.bg-info:hover {
  background-color: #089ccc !important;
}

.bg-warning {
  background-color: #ff754b !important;
}

a.bg-warning:focus, a.bg-warning:hover {
  background-color: #ff4e18 !important;
}

.bg-danger {
  background-color: #ff3160 !important;
}

a.bg-danger:focus, a.bg-danger:hover {
  background-color: #fd003a !important;
}

.bg-inverse {
  background-color: #d4d6d7 !important;
}

a.bg-inverse:focus, a.bg-inverse:hover {
  background-color: #babdbe !important;
}

.rounded {
  border-radius: 0.17rem;
}

.rounded-top {
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.rounded-right {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.rounded-bottom {
  border-bottom-right-radius: 0.17rem;
  border-bottom-left-radius: 0.17rem;
}

.rounded-left {
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.rounded-circle {
  border-radius: 50%;
}

.clearfix::after {
  content: \"\";
  display: table;
  clear: both;
}

.d-block {
  display: block !important;
}

.d-inline-block {
  display: inline-block !important;
}

.d-inline {
  display: inline !important;
}

.flex-xs-first {
  order: -1;
}

.flex-xs-last {
  order: 1;
}

.flex-xs-unordered {
  order: 0;
}

.flex-items-xs-top {
  align-items: flex-start;
}

.flex-items-xs-middle {
  align-items: center;
}

.flex-items-xs-bottom {
  align-items: flex-end;
}

.flex-xs-top {
  align-self: flex-start;
}

.flex-xs-middle {
  align-self: center;
}

.flex-xs-bottom {
  align-self: flex-end;
}

.flex-items-xs-left {
  justify-content: flex-start;
}

.flex-items-xs-center {
  justify-content: center;
}

.flex-items-xs-right {
  justify-content: flex-end;
}

.flex-items-xs-around {
  justify-content: space-around;
}

.flex-items-xs-between {
  justify-content: space-between;
}

@media (min-width: 576px) {
  .flex-sm-first {
    order: -1;
  }

  .flex-sm-last {
    order: 1;
  }

  .flex-sm-unordered {
    order: 0;
  }
}
@media (min-width: 576px) {
  .flex-items-sm-top {
    align-items: flex-start;
  }

  .flex-items-sm-middle {
    align-items: center;
  }

  .flex-items-sm-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 576px) {
  .flex-sm-top {
    align-self: flex-start;
  }

  .flex-sm-middle {
    align-self: center;
  }

  .flex-sm-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 576px) {
  .flex-items-sm-left {
    justify-content: flex-start;
  }

  .flex-items-sm-center {
    justify-content: center;
  }

  .flex-items-sm-right {
    justify-content: flex-end;
  }

  .flex-items-sm-around {
    justify-content: space-around;
  }

  .flex-items-sm-between {
    justify-content: space-between;
  }
}
@media (min-width: 768px) {
  .flex-md-first {
    order: -1;
  }

  .flex-md-last {
    order: 1;
  }

  .flex-md-unordered {
    order: 0;
  }
}
@media (min-width: 768px) {
  .flex-items-md-top {
    align-items: flex-start;
  }

  .flex-items-md-middle {
    align-items: center;
  }

  .flex-items-md-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 768px) {
  .flex-md-top {
    align-self: flex-start;
  }

  .flex-md-middle {
    align-self: center;
  }

  .flex-md-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 768px) {
  .flex-items-md-left {
    justify-content: flex-start;
  }

  .flex-items-md-center {
    justify-content: center;
  }

  .flex-items-md-right {
    justify-content: flex-end;
  }

  .flex-items-md-around {
    justify-content: space-around;
  }

  .flex-items-md-between {
    justify-content: space-between;
  }
}
@media (min-width: 992px) {
  .flex-lg-first {
    order: -1;
  }

  .flex-lg-last {
    order: 1;
  }

  .flex-lg-unordered {
    order: 0;
  }
}
@media (min-width: 992px) {
  .flex-items-lg-top {
    align-items: flex-start;
  }

  .flex-items-lg-middle {
    align-items: center;
  }

  .flex-items-lg-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 992px) {
  .flex-lg-top {
    align-self: flex-start;
  }

  .flex-lg-middle {
    align-self: center;
  }

  .flex-lg-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 992px) {
  .flex-items-lg-left {
    justify-content: flex-start;
  }

  .flex-items-lg-center {
    justify-content: center;
  }

  .flex-items-lg-right {
    justify-content: flex-end;
  }

  .flex-items-lg-around {
    justify-content: space-around;
  }

  .flex-items-lg-between {
    justify-content: space-between;
  }
}
@media (min-width: 1200px) {
  .flex-xl-first {
    order: -1;
  }

  .flex-xl-last {
    order: 1;
  }

  .flex-xl-unordered {
    order: 0;
  }
}
@media (min-width: 1200px) {
  .flex-items-xl-top {
    align-items: flex-start;
  }

  .flex-items-xl-middle {
    align-items: center;
  }

  .flex-items-xl-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 1200px) {
  .flex-xl-top {
    align-self: flex-start;
  }

  .flex-xl-middle {
    align-self: center;
  }

  .flex-xl-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 1200px) {
  .flex-items-xl-left {
    justify-content: flex-start;
  }

  .flex-items-xl-center {
    justify-content: center;
  }

  .flex-items-xl-right {
    justify-content: flex-end;
  }

  .flex-items-xl-around {
    justify-content: space-around;
  }

  .flex-items-xl-between {
    justify-content: space-between;
  }
}
.float-xs-left {
  float: left !important;
}

.float-xs-right {
  float: right !important;
}

.float-xs-none {
  float: none !important;
}

@media (min-width: 576px) {
  .float-sm-left {
    float: left !important;
  }

  .float-sm-right {
    float: right !important;
  }

  .float-sm-none {
    float: none !important;
  }
}
@media (min-width: 768px) {
  .float-md-left {
    float: left !important;
  }

  .float-md-right {
    float: right !important;
  }

  .float-md-none {
    float: none !important;
  }
}
@media (min-width: 992px) {
  .float-lg-left {
    float: left !important;
  }

  .float-lg-right {
    float: right !important;
  }

  .float-lg-none {
    float: none !important;
  }
}
@media (min-width: 1200px) {
  .float-xl-left {
    float: left !important;
  }

  .float-xl-right {
    float: right !important;
  }

  .float-xl-none {
    float: none !important;
  }
}
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.sr-only-focusable:active, .sr-only-focusable:focus {
  position: static;
  width: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  clip: auto;
}

.w-100 {
  width: 100% !important;
}

.h-100 {
  height: 100% !important;
}

.mx-auto {
  margin-right: auto !important;
  margin-left: auto !important;
}

.m-0 {
  margin: 0 0 !important;
}

.mt-0 {
  margin-top: 0 !important;
}

.mr-0 {
  margin-right: 0 !important;
}

.mb-0 {
  margin-bottom: 0 !important;
}

.ml-0 {
  margin-left: 0 !important;
}

.mx-0 {
  margin-right: 0 !important;
  margin-left: 0 !important;
}

.my-0 {
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}

.m-1 {
  margin: 1rem 1rem !important;
}

.mt-1 {
  margin-top: 1rem !important;
}

.mr-1 {
  margin-right: 1rem !important;
}

.mb-1 {
  margin-bottom: 1rem !important;
}

.ml-1 {
  margin-left: 1rem !important;
}

.mx-1 {
  margin-right: 1rem !important;
  margin-left: 1rem !important;
}

.my-1 {
  margin-top: 1rem !important;
  margin-bottom: 1rem !important;
}

.m-2 {
  margin: 1.5rem 1.5rem !important;
}

.mt-2 {
  margin-top: 1.5rem !important;
}

.mr-2 {
  margin-right: 1.5rem !important;
}

.mb-2 {
  margin-bottom: 1.5rem !important;
}

.ml-2 {
  margin-left: 1.5rem !important;
}

.mx-2 {
  margin-right: 1.5rem !important;
  margin-left: 1.5rem !important;
}

.my-2 {
  margin-top: 1.5rem !important;
  margin-bottom: 1.5rem !important;
}

.m-3 {
  margin: 3rem 3rem !important;
}

.mt-3 {
  margin-top: 3rem !important;
}

.mr-3 {
  margin-right: 3rem !important;
}

.mb-3 {
  margin-bottom: 3rem !important;
}

.ml-3 {
  margin-left: 3rem !important;
}

.mx-3 {
  margin-right: 3rem !important;
  margin-left: 3rem !important;
}

.my-3 {
  margin-top: 3rem !important;
  margin-bottom: 3rem !important;
}

.p-0 {
  padding: 0 0 !important;
}

.pt-0 {
  padding-top: 0 !important;
}

.pr-0 {
  padding-right: 0 !important;
}

.pb-0 {
  padding-bottom: 0 !important;
}

.pl-0 {
  padding-left: 0 !important;
}

.px-0 {
  padding-right: 0 !important;
  padding-left: 0 !important;
}

.py-0 {
  padding-top: 0 !important;
  padding-bottom: 0 !important;
}

.p-1 {
  padding: 1rem 1rem !important;
}

.pt-1 {
  padding-top: 1rem !important;
}

.pr-1 {
  padding-right: 1rem !important;
}

.pb-1 {
  padding-bottom: 1rem !important;
}

.pl-1 {
  padding-left: 1rem !important;
}

.px-1 {
  padding-right: 1rem !important;
  padding-left: 1rem !important;
}

.py-1 {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}

.p-2 {
  padding: 1.5rem 1.5rem !important;
}

.pt-2 {
  padding-top: 1.5rem !important;
}

.pr-2 {
  padding-right: 1.5rem !important;
}

.pb-2 {
  padding-bottom: 1.5rem !important;
}

.pl-2 {
  padding-left: 1.5rem !important;
}

.px-2 {
  padding-right: 1.5rem !important;
  padding-left: 1.5rem !important;
}

.py-2 {
  padding-top: 1.5rem !important;
  padding-bottom: 1.5rem !important;
}

.p-3 {
  padding: 3rem 3rem !important;
}

.pt-3 {
  padding-top: 3rem !important;
}

.pr-3 {
  padding-right: 3rem !important;
}

.pb-3 {
  padding-bottom: 3rem !important;
}

.pl-3 {
  padding-left: 3rem !important;
}

.px-3 {
  padding-right: 3rem !important;
  padding-left: 3rem !important;
}

.py-3 {
  padding-top: 3rem !important;
  padding-bottom: 3rem !important;
}

.pos-f-t {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 1030;
}

.text-justify {
  text-align: justify !important;
}

.text-nowrap {
  white-space: nowrap !important;
}

.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.text-xs-left {
  text-align: left !important;
}

.text-xs-right {
  text-align: right !important;
}

.text-xs-center {
  text-align: center !important;
}

@media (min-width: 576px) {
  .text-sm-left {
    text-align: left !important;
  }

  .text-sm-right {
    text-align: right !important;
  }

  .text-sm-center {
    text-align: center !important;
  }
}
@media (min-width: 768px) {
  .text-md-left {
    text-align: left !important;
  }

  .text-md-right {
    text-align: right !important;
  }

  .text-md-center {
    text-align: center !important;
  }
}
@media (min-width: 992px) {
  .text-lg-left {
    text-align: left !important;
  }

  .text-lg-right {
    text-align: right !important;
  }

  .text-lg-center {
    text-align: center !important;
  }
}
@media (min-width: 1200px) {
  .text-xl-left {
    text-align: left !important;
  }

  .text-xl-right {
    text-align: right !important;
  }

  .text-xl-center {
    text-align: center !important;
  }
}
.text-lowercase {
  text-transform: lowercase !important;
}

.text-uppercase {
  text-transform: uppercase !important;
}

.text-capitalize {
  text-transform: capitalize !important;
}

.font-weight-normal {
  font-weight: normal;
}

.font-weight-bold {
  font-weight: bold;
}

.font-italic {
  font-style: italic;
}

.text-white {
  color: #fff !important;
}

.text-muted {
  color: #888888 !important;
}

a.text-muted:focus, a.text-muted:hover {
  color: #6f6f6f !important;
}

.text-primary {
  color: #b21cc3 !important;
}

a.text-primary:focus, a.text-primary:hover {
  color: #891696 !important;
}

.text-success {
  color: #47d165 !important;
}

a.text-success:focus, a.text-success:hover {
  color: #2eb74c !important;
}

.text-info {
  color: #11bef6 !important;
}

a.text-info:focus, a.text-info:hover {
  color: #089ccc !important;
}

.text-warning {
  color: #ff754b !important;
}

a.text-warning:focus, a.text-warning:hover {
  color: #ff4e18 !important;
}

.text-danger {
  color: #ff3160 !important;
}

a.text-danger:focus, a.text-danger:hover {
  color: #fd003a !important;
}

.text-gray-dark {
  color: #373a3c !important;
}

a.text-gray-dark:focus, a.text-gray-dark:hover {
  color: #1f2021 !important;
}

.text-hide {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.invisible {
  visibility: hidden !important;
}

.hidden-xs-up {
  display: none !important;
}

@media (max-width: 575px) {
  .hidden-xs-down {
    display: none !important;
  }
}

@media (min-width: 576px) {
  .hidden-sm-up {
    display: none !important;
  }
}

@media (max-width: 767px) {
  .hidden-sm-down {
    display: none !important;
  }
}

@media (min-width: 768px) {
  .hidden-md-up {
    display: none !important;
  }
}

@media (max-width: 991px) {
  .hidden-md-down {
    display: none !important;
  }
}

@media (min-width: 992px) {
  .hidden-lg-up {
    display: none !important;
  }
}

@media (max-width: 1199px) {
  .hidden-lg-down {
    display: none !important;
  }
}

@media (min-width: 1200px) {
  .hidden-xl-up {
    display: none !important;
  }
}

.hidden-xl-down {
  display: none !important;
}

.visible-print-block {
  display: none !important;
}
@media print {
  .visible-print-block {
    display: block !important;
  }
}

.visible-print-inline {
  display: none !important;
}
@media print {
  .visible-print-inline {
    display: inline !important;
  }
}

.visible-print-inline-block {
  display: none !important;
}
@media print {
  .visible-print-inline-block {
    display: inline-block !important;
  }
}

@media print {
  .hidden-print {
    display: none !important;
  }
}

.select2-container {
  box-sizing: border-box;
  display: inline-block;
  margin: 0;
  position: relative;
  vertical-align: middle; }
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      padding-left: 8px;
      padding-right: 20px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap; }
    .select2-container .select2-selection--single .select2-selection__clear {
      position: relative; }
  .select2-container[dir=\"rtl\"] .select2-selection--single .select2-selection__rendered {
    padding-right: 8px;
    padding-left: 20px; }
  .select2-container .select2-selection--multiple {
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    padding-bottom: 5px;
    min-height: 32px;
    user-select: none;
    -webkit-user-select: none; }
  .select2-container .select2-search--inline {
    float: left; }
    .select2-container .select2-search--inline .select2-search__field {
      box-sizing: border-box;
      border: none;
      font-size: 100%;
      margin-top: 5px;
      padding: 0; }
      .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
        -webkit-appearance: none; }

.select2-dropdown {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  box-sizing: border-box;
  display: block;
  position: absolute;
  left: -100000px;
  width: 100%;
  z-index: 1051; }

.select2-results {
  display: block; }

.select2-results__options {
  list-style: none;
  margin: 0;
  padding: 0; }

.select2-results__option {
  padding: 6px;
  user-select: none;
  -webkit-user-select: none; }
  .select2-results__option[aria-selected] {
    cursor: pointer; }

.select2-container--open .select2-dropdown {
  left: 0; }

.select2-container--open .select2-dropdown--above {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--open .select2-dropdown--below {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-search--dropdown {
  display: block;
  padding: 4px; }
  .select2-search--dropdown .select2-search__field {
    padding: 4px;
    width: 100%;
    box-sizing: border-box; }
    .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
      -webkit-appearance: none; }
  .select2-search--dropdown.select2-search--hide {
    display: none; }

.select2-close-mask {
  border: 0;
  margin: 0;
  padding: 0;
  display: block;
  position: fixed;
  left: 0;
  top: 0;
  min-height: 100%;
  min-width: 100%;
  height: auto;
  width: auto;
  opacity: 0;
  z-index: 99;
  background-color: #fff;
  filter: alpha(opacity=0); }

.select2-hidden-accessible {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important; }

.select2-container--default .select2-selection--single {
  background-color: #fff;
  border: 1px solid #aaa;
  border-radius: 4px; }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold; }
  .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px; }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow {
  left: 1px;
  right: auto; }

.select2-container--default.select2-container--disabled .select2-selection--single {
  background-color: #eee;
  cursor: default; }
  .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
    display: none; }

.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
  border-color: transparent transparent #888 transparent;
  border-width: 0 4px 5px 4px; }

.select2-container--default .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text; }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
      list-style: none; }
  .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #999;
    margin-top: 5px;
    float: left; }
  .select2-container--default .select2-selection--multiple .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-top: 5px;
    margin-right: 10px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #999;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #333; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice, .select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-search--inline {
  float: right; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--default.select2-container--focus .select2-selection--multiple {
  border: solid black 1px;
  outline: 0; }

.select2-container--default.select2-container--disabled .select2-selection--multiple {
  background-color: #eee;
  cursor: default; }

.select2-container--default.select2-container--disabled .select2-selection__choice__remove {
  display: none; }

.select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa; }

.select2-container--default .select2-search--inline .select2-search__field {
  background: transparent;
  border: none;
  outline: 0;
  box-shadow: none;
  -webkit-appearance: textfield; }

.select2-container--default .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--default .select2-results__option[role=group] {
  padding: 0; }

.select2-container--default .select2-results__option[aria-disabled=true] {
  color: #999; }

.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #ddd; }

.select2-container--default .select2-results__option .select2-results__option {
  padding-left: 1em; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
    padding-left: 0; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
    margin-left: -1em;
    padding-left: 2em; }
    .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
      margin-left: -2em;
      padding-left: 3em; }
      .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -3em;
        padding-left: 4em; }
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
          margin-left: -4em;
          padding-left: 5em; }
          .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em; }

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #5897fb;
  color: white; }

.select2-container--default .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic .select2-selection--single {
  background-color: #f7f7f7;
  border: 1px solid #aaa;
  border-radius: 4px;
  outline: 0;
  background-image: -webkit-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: -o-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: linear-gradient(to bottom, white 50%, #eeeeee 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }
  .select2-container--classic .select2-selection--single:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--classic .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-right: 10px; }
  .select2-container--classic .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--classic .select2-selection--single .select2-selection__arrow {
    background-color: #ddd;
    border: none;
    border-left: 1px solid #aaa;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
    background-image: -webkit-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: -o-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: linear-gradient(to bottom, #eeeeee 50%, #cccccc 100%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0); }
    .select2-container--classic .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow {
  border: none;
  border-right: 1px solid #aaa;
  border-radius: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  left: 1px;
  right: auto; }

.select2-container--classic.select2-container--open .select2-selection--single {
  border: 1px solid #5897fb; }
  .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow {
    background: transparent;
    border: none; }
    .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b {
      border-color: transparent transparent #888 transparent;
      border-width: 0 4px 5px 4px; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  background-image: -webkit-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: -o-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: linear-gradient(to bottom, white 0%, #eeeeee 50%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  background-image: -webkit-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: -o-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: linear-gradient(to bottom, #eeeeee 50%, white 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0); }

.select2-container--classic .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text;
  outline: 0; }
  .select2-container--classic .select2-selection--multiple:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--multiple .select2-selection__rendered {
    list-style: none;
    margin: 0;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__clear {
    display: none; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
    color: #888;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #555; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  float: right; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--classic.select2-container--open .select2-selection--multiple {
  border: 1px solid #5897fb; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--classic .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa;
  outline: 0; }

.select2-container--classic .select2-search--inline .select2-search__field {
  outline: 0;
  box-shadow: none; }

.select2-container--classic .select2-dropdown {
  background-color: white;
  border: 1px solid transparent; }

.select2-container--classic .select2-dropdown--above {
  border-bottom: none; }

.select2-container--classic .select2-dropdown--below {
  border-top: none; }

.select2-container--classic .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--classic .select2-results__option[role=group] {
  padding: 0; }

.select2-container--classic .select2-results__option[aria-disabled=true] {
  color: grey; }

.select2-container--classic .select2-results__option--highlighted[aria-selected] {
  background-color: #3875d7;
  color: white; }

.select2-container--classic .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic.select2-container--open .select2-dropdown {
  border-color: #5897fb; }


.iti {
    position: relative;
    display: inline-block; }
.iti * {
    box-sizing: border-box;
    -moz-box-sizing: border-box; }
.iti__hide {
    display: none; }
.iti__v-hide {
    visibility: hidden; }
.iti input, .iti input[type=text], .iti input[type=tel] {
    position: relative;
    z-index: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-right: 36px;
    margin-right: 0; }
.iti__flag-container {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    padding: 1px; }
.iti__selected-flag {
    z-index: 1;
    position: relative;
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 6px 0 8px; }
.iti__arrow {
    margin-left: 6px;
    width: 0;
    height: 0;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-top: 4px solid #555; }
.iti__arrow--up {
    border-top: none;
    border-bottom: 4px solid #555; }
.iti__country-list {
    position: absolute;
    z-index: 2;
    list-style: none;
    text-align: left;
    padding: 0;
    margin: 0 0 0 -1px;
    box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
    background-color: white;
    border: 1px solid #CCC;
    white-space: nowrap;
    max-height: 200px;
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch; }
.iti__country-list--dropup {
    bottom: 100%;
    margin-bottom: -1px; }
@media (max-width: 500px) {
    .iti__country-list {
        white-space: normal; } }
.iti__flag-box {
    display: inline-block;
    width: 20px; }
.iti__divider {
    padding-bottom: 5px;
    margin-bottom: 5px;
    border-bottom: 1px solid #CCC; }
.iti__country {
    padding: 5px 10px;
    outline: none; }
.iti__dial-code {
    color: #999; }
.iti__country.iti__highlight {
    background-color: rgba(0, 0, 0, 0.05); }
.iti__flag-box, .iti__country-name, .iti__dial-code {
    vertical-align: middle; }
.iti__flag-box, .iti__country-name {
    margin-right: 6px; }
.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
    padding-right: 6px;
    padding-left: 52px;
    margin-left: 0; }
.iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container {
    right: auto;
    left: 0; }
.iti--allow-dropdown .iti__flag-container:hover {
    cursor: pointer; }
.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
    background-color: rgba(0, 0, 0, 0.05); }
.iti--allow-dropdown input[disabled] + .iti__flag-container:hover,
.iti--allow-dropdown input[readonly] + .iti__flag-container:hover {
    cursor: default; }
.iti--allow-dropdown input[disabled] + .iti__flag-container:hover .iti__selected-flag,
.iti--allow-dropdown input[readonly] + .iti__flag-container:hover .iti__selected-flag {
    background-color: transparent; }
.iti--separate-dial-code .iti__selected-flag {
    background-color: rgba(0, 0, 0, 0.05); }
.iti--separate-dial-code .iti__selected-dial-code {
    margin-left: 6px; }
.iti--container {
    position: absolute;
    top: -1000px;
    left: -1000px;
    z-index: 1060;
    padding: 1px; }
.iti--container:hover {
    cursor: pointer; }

.iti-mobile .iti--container {
    top: 30px;
    bottom: 30px;
    left: 30px;
    right: 30px;
    position: fixed; }

.iti-mobile .iti__country-list {
    max-height: 100%;
    width: 100%; }

.iti-mobile .iti__country {
    padding: 10px 10px;
    line-height: 1.5em; }

.iti__flag {
    width: 20px; }
.iti__flag.iti__be {
    width: 18px; }
.iti__flag.iti__ch {
    width: 15px; }
.iti__flag.iti__mc {
    width: 19px; }
.iti__flag.iti__ne {
    width: 18px; }
.iti__flag.iti__np {
    width: 13px; }
.iti__flag.iti__va {
    width: 15px; }
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {
        background-size: 5652px 15px; } }
.iti__flag.iti__ac {
    height: 10px;
    background-position: 0px 0px; }
.iti__flag.iti__ad {
    height: 14px;
    background-position: -22px 0px; }
.iti__flag.iti__ae {
    height: 10px;
    background-position: -44px 0px; }
.iti__flag.iti__af {
    height: 14px;
    background-position: -66px 0px; }
.iti__flag.iti__ag {
    height: 14px;
    background-position: -88px 0px; }
.iti__flag.iti__ai {
    height: 10px;
    background-position: -110px 0px; }
.iti__flag.iti__al {
    height: 15px;
    background-position: -132px 0px; }
.iti__flag.iti__am {
    height: 10px;
    background-position: -154px 0px; }
.iti__flag.iti__ao {
    height: 14px;
    background-position: -176px 0px; }
.iti__flag.iti__aq {
    height: 14px;
    background-position: -198px 0px; }
.iti__flag.iti__ar {
    height: 13px;
    background-position: -220px 0px; }
.iti__flag.iti__as {
    height: 10px;
    background-position: -242px 0px; }
.iti__flag.iti__at {
    height: 14px;
    background-position: -264px 0px; }
.iti__flag.iti__au {
    height: 10px;
    background-position: -286px 0px; }
.iti__flag.iti__aw {
    height: 14px;
    background-position: -308px 0px; }
.iti__flag.iti__ax {
    height: 13px;
    background-position: -330px 0px; }
.iti__flag.iti__az {
    height: 10px;
    background-position: -352px 0px; }
.iti__flag.iti__ba {
    height: 10px;
    background-position: -374px 0px; }
.iti__flag.iti__bb {
    height: 14px;
    background-position: -396px 0px; }
.iti__flag.iti__bd {
    height: 12px;
    background-position: -418px 0px; }
.iti__flag.iti__be {
    height: 15px;
    background-position: -440px 0px; }
.iti__flag.iti__bf {
    height: 14px;
    background-position: -460px 0px; }
.iti__flag.iti__bg {
    height: 12px;
    background-position: -482px 0px; }
.iti__flag.iti__bh {
    height: 12px;
    background-position: -504px 0px; }
.iti__flag.iti__bi {
    height: 12px;
    background-position: -526px 0px; }
.iti__flag.iti__bj {
    height: 14px;
    background-position: -548px 0px; }
.iti__flag.iti__bl {
    height: 14px;
    background-position: -570px 0px; }
.iti__flag.iti__bm {
    height: 10px;
    background-position: -592px 0px; }
.iti__flag.iti__bn {
    height: 10px;
    background-position: -614px 0px; }
.iti__flag.iti__bo {
    height: 14px;
    background-position: -636px 0px; }
.iti__flag.iti__bq {
    height: 14px;
    background-position: -658px 0px; }
.iti__flag.iti__br {
    height: 14px;
    background-position: -680px 0px; }
.iti__flag.iti__bs {
    height: 10px;
    background-position: -702px 0px; }
.iti__flag.iti__bt {
    height: 14px;
    background-position: -724px 0px; }
.iti__flag.iti__bv {
    height: 15px;
    background-position: -746px 0px; }
.iti__flag.iti__bw {
    height: 14px;
    background-position: -768px 0px; }
.iti__flag.iti__by {
    height: 10px;
    background-position: -790px 0px; }
.iti__flag.iti__bz {
    height: 14px;
    background-position: -812px 0px; }
.iti__flag.iti__ca {
    height: 10px;
    background-position: -834px 0px; }
.iti__flag.iti__cc {
    height: 10px;
    background-position: -856px 0px; }
.iti__flag.iti__cd {
    height: 15px;
    background-position: -878px 0px; }
.iti__flag.iti__cf {
    height: 14px;
    background-position: -900px 0px; }
.iti__flag.iti__cg {
    height: 14px;
    background-position: -922px 0px; }
.iti__flag.iti__ch {
    height: 15px;
    background-position: -944px 0px; }
.iti__flag.iti__ci {
    height: 14px;
    background-position: -961px 0px; }
.iti__flag.iti__ck {
    height: 10px;
    background-position: -983px 0px; }
.iti__flag.iti__cl {
    height: 14px;
    background-position: -1005px 0px; }
.iti__flag.iti__cm {
    height: 14px;
    background-position: -1027px 0px; }
.iti__flag.iti__cn {
    height: 14px;
    background-position: -1049px 0px; }
.iti__flag.iti__co {
    height: 14px;
    background-position: -1071px 0px; }
.iti__flag.iti__cp {
    height: 14px;
    background-position: -1093px 0px; }
.iti__flag.iti__cr {
    height: 12px;
    background-position: -1115px 0px; }
.iti__flag.iti__cu {
    height: 10px;
    background-position: -1137px 0px; }
.iti__flag.iti__cv {
    height: 12px;
    background-position: -1159px 0px; }
.iti__flag.iti__cw {
    height: 14px;
    background-position: -1181px 0px; }
.iti__flag.iti__cx {
    height: 10px;
    background-position: -1203px 0px; }
.iti__flag.iti__cy {
    height: 14px;
    background-position: -1225px 0px; }
.iti__flag.iti__cz {
    height: 14px;
    background-position: -1247px 0px; }
.iti__flag.iti__de {
    height: 12px;
    background-position: -1269px 0px; }
.iti__flag.iti__dg {
    height: 10px;
    background-position: -1291px 0px; }
.iti__flag.iti__dj {
    height: 14px;
    background-position: -1313px 0px; }
.iti__flag.iti__dk {
    height: 15px;
    background-position: -1335px 0px; }
.iti__flag.iti__dm {
    height: 10px;
    background-position: -1357px 0px; }
.iti__flag.iti__do {
    height: 14px;
    background-position: -1379px 0px; }
.iti__flag.iti__dz {
    height: 14px;
    background-position: -1401px 0px; }
.iti__flag.iti__ea {
    height: 14px;
    background-position: -1423px 0px; }
.iti__flag.iti__ec {
    height: 14px;
    background-position: -1445px 0px; }
.iti__flag.iti__ee {
    height: 13px;
    background-position: -1467px 0px; }
.iti__flag.iti__eg {
    height: 14px;
    background-position: -1489px 0px; }
.iti__flag.iti__eh {
    height: 10px;
    background-position: -1511px 0px; }
.iti__flag.iti__er {
    height: 10px;
    background-position: -1533px 0px; }
.iti__flag.iti__es {
    height: 14px;
    background-position: -1555px 0px; }
.iti__flag.iti__et {
    height: 10px;
    background-position: -1577px 0px; }
.iti__flag.iti__eu {
    height: 14px;
    background-position: -1599px 0px; }
.iti__flag.iti__fi {
    height: 12px;
    background-position: -1621px 0px; }
.iti__flag.iti__fj {
    height: 10px;
    background-position: -1643px 0px; }
.iti__flag.iti__fk {
    height: 10px;
    background-position: -1665px 0px; }
.iti__flag.iti__fm {
    height: 11px;
    background-position: -1687px 0px; }
.iti__flag.iti__fo {
    height: 15px;
    background-position: -1709px 0px; }
.iti__flag.iti__fr {
    height: 14px;
    background-position: -1731px 0px; }
.iti__flag.iti__ga {
    height: 15px;
    background-position: -1753px 0px; }
.iti__flag.iti__gb {
    height: 10px;
    background-position: -1775px 0px; }
.iti__flag.iti__gd {
    height: 12px;
    background-position: -1797px 0px; }
.iti__flag.iti__ge {
    height: 14px;
    background-position: -1819px 0px; }
.iti__flag.iti__gf {
    height: 14px;
    background-position: -1841px 0px; }
.iti__flag.iti__gg {
    height: 14px;
    background-position: -1863px 0px; }
.iti__flag.iti__gh {
    height: 14px;
    background-position: -1885px 0px; }
.iti__flag.iti__gi {
    height: 10px;
    background-position: -1907px 0px; }
.iti__flag.iti__gl {
    height: 14px;
    background-position: -1929px 0px; }
.iti__flag.iti__gm {
    height: 14px;
    background-position: -1951px 0px; }
.iti__flag.iti__gn {
    height: 14px;
    background-position: -1973px 0px; }
.iti__flag.iti__gp {
    height: 14px;
    background-position: -1995px 0px; }
.iti__flag.iti__gq {
    height: 14px;
    background-position: -2017px 0px; }
.iti__flag.iti__gr {
    height: 14px;
    background-position: -2039px 0px; }
.iti__flag.iti__gs {
    height: 10px;
    background-position: -2061px 0px; }
.iti__flag.iti__gt {
    height: 13px;
    background-position: -2083px 0px; }
.iti__flag.iti__gu {
    height: 11px;
    background-position: -2105px 0px; }
.iti__flag.iti__gw {
    height: 10px;
    background-position: -2127px 0px; }
.iti__flag.iti__gy {
    height: 12px;
    background-position: -2149px 0px; }
.iti__flag.iti__hk {
    height: 14px;
    background-position: -2171px 0px; }
.iti__flag.iti__hm {
    height: 10px;
    background-position: -2193px 0px; }
.iti__flag.iti__hn {
    height: 10px;
    background-position: -2215px 0px; }
.iti__flag.iti__hr {
    height: 10px;
    background-position: -2237px 0px; }
.iti__flag.iti__ht {
    height: 12px;
    background-position: -2259px 0px; }
.iti__flag.iti__hu {
    height: 10px;
    background-position: -2281px 0px; }
.iti__flag.iti__ic {
    height: 14px;
    background-position: -2303px 0px; }
.iti__flag.iti__id {
    height: 14px;
    background-position: -2325px 0px; }
.iti__flag.iti__ie {
    height: 10px;
    background-position: -2347px 0px; }
.iti__flag.iti__il {
    height: 15px;
    background-position: -2369px 0px; }
.iti__flag.iti__im {
    height: 10px;
    background-position: -2391px 0px; }
.iti__flag.iti__in {
    height: 14px;
    background-position: -2413px 0px; }
.iti__flag.iti__io {
    height: 10px;
    background-position: -2435px 0px; }
.iti__flag.iti__iq {
    height: 14px;
    background-position: -2457px 0px; }
.iti__flag.iti__ir {
    height: 12px;
    background-position: -2479px 0px; }
.iti__flag.iti__is {
    height: 15px;
    background-position: -2501px 0px; }
.iti__flag.iti__it {
    height: 14px;
    background-position: -2523px 0px; }
.iti__flag.iti__je {
    height: 12px;
    background-position: -2545px 0px; }
.iti__flag.iti__jm {
    height: 10px;
    background-position: -2567px 0px; }
.iti__flag.iti__jo {
    height: 10px;
    background-position: -2589px 0px; }
.iti__flag.iti__jp {
    height: 14px;
    background-position: -2611px 0px; }
.iti__flag.iti__ke {
    height: 14px;
    background-position: -2633px 0px; }
.iti__flag.iti__kg {
    height: 12px;
    background-position: -2655px 0px; }
.iti__flag.iti__kh {
    height: 13px;
    background-position: -2677px 0px; }
.iti__flag.iti__ki {
    height: 10px;
    background-position: -2699px 0px; }
.iti__flag.iti__km {
    height: 12px;
    background-position: -2721px 0px; }
.iti__flag.iti__kn {
    height: 14px;
    background-position: -2743px 0px; }
.iti__flag.iti__kp {
    height: 10px;
    background-position: -2765px 0px; }
.iti__flag.iti__kr {
    height: 14px;
    background-position: -2787px 0px; }
.iti__flag.iti__kw {
    height: 10px;
    background-position: -2809px 0px; }
.iti__flag.iti__ky {
    height: 10px;
    background-position: -2831px 0px; }
.iti__flag.iti__kz {
    height: 10px;
    background-position: -2853px 0px; }
.iti__flag.iti__la {
    height: 14px;
    background-position: -2875px 0px; }
.iti__flag.iti__lb {
    height: 14px;
    background-position: -2897px 0px; }
.iti__flag.iti__lc {
    height: 10px;
    background-position: -2919px 0px; }
.iti__flag.iti__li {
    height: 12px;
    background-position: -2941px 0px; }
.iti__flag.iti__lk {
    height: 10px;
    background-position: -2963px 0px; }
.iti__flag.iti__lr {
    height: 11px;
    background-position: -2985px 0px; }
.iti__flag.iti__ls {
    height: 14px;
    background-position: -3007px 0px; }
.iti__flag.iti__lt {
    height: 12px;
    background-position: -3029px 0px; }
.iti__flag.iti__lu {
    height: 12px;
    background-position: -3051px 0px; }
.iti__flag.iti__lv {
    height: 10px;
    background-position: -3073px 0px; }
.iti__flag.iti__ly {
    height: 10px;
    background-position: -3095px 0px; }
.iti__flag.iti__ma {
    height: 14px;
    background-position: -3117px 0px; }
.iti__flag.iti__mc {
    height: 15px;
    background-position: -3139px 0px; }
.iti__flag.iti__md {
    height: 10px;
    background-position: -3160px 0px; }
.iti__flag.iti__me {
    height: 10px;
    background-position: -3182px 0px; }
.iti__flag.iti__mf {
    height: 14px;
    background-position: -3204px 0px; }
.iti__flag.iti__mg {
    height: 14px;
    background-position: -3226px 0px; }
.iti__flag.iti__mh {
    height: 11px;
    background-position: -3248px 0px; }
.iti__flag.iti__mk {
    height: 10px;
    background-position: -3270px 0px; }
.iti__flag.iti__ml {
    height: 14px;
    background-position: -3292px 0px; }
.iti__flag.iti__mm {
    height: 14px;
    background-position: -3314px 0px; }
.iti__flag.iti__mn {
    height: 10px;
    background-position: -3336px 0px; }
.iti__flag.iti__mo {
    height: 14px;
    background-position: -3358px 0px; }
.iti__flag.iti__mp {
    height: 10px;
    background-position: -3380px 0px; }
.iti__flag.iti__mq {
    height: 14px;
    background-position: -3402px 0px; }
.iti__flag.iti__mr {
    height: 14px;
    background-position: -3424px 0px; }
.iti__flag.iti__ms {
    height: 10px;
    background-position: -3446px 0px; }
.iti__flag.iti__mt {
    height: 14px;
    background-position: -3468px 0px; }
.iti__flag.iti__mu {
    height: 14px;
    background-position: -3490px 0px; }
.iti__flag.iti__mv {
    height: 14px;
    background-position: -3512px 0px; }
.iti__flag.iti__mw {
    height: 14px;
    background-position: -3534px 0px; }
.iti__flag.iti__mx {
    height: 12px;
    background-position: -3556px 0px; }
.iti__flag.iti__my {
    height: 10px;
    background-position: -3578px 0px; }
.iti__flag.iti__mz {
    height: 14px;
    background-position: -3600px 0px; }
.iti__flag.iti__na {
    height: 14px;
    background-position: -3622px 0px; }
.iti__flag.iti__nc {
    height: 10px;
    background-position: -3644px 0px; }
.iti__flag.iti__ne {
    height: 15px;
    background-position: -3666px 0px; }
.iti__flag.iti__nf {
    height: 10px;
    background-position: -3686px 0px; }
.iti__flag.iti__ng {
    height: 10px;
    background-position: -3708px 0px; }
.iti__flag.iti__ni {
    height: 12px;
    background-position: -3730px 0px; }
.iti__flag.iti__nl {
    height: 14px;
    background-position: -3752px 0px; }
.iti__flag.iti__no {
    height: 15px;
    background-position: -3774px 0px; }
.iti__flag.iti__np {
    height: 15px;
    background-position: -3796px 0px; }
.iti__flag.iti__nr {
    height: 10px;
    background-position: -3811px 0px; }
.iti__flag.iti__nu {
    height: 10px;
    background-position: -3833px 0px; }
.iti__flag.iti__nz {
    height: 10px;
    background-position: -3855px 0px; }
.iti__flag.iti__om {
    height: 10px;
    background-position: -3877px 0px; }
.iti__flag.iti__pa {
    height: 14px;
    background-position: -3899px 0px; }
.iti__flag.iti__pe {
    height: 14px;
    background-position: -3921px 0px; }
.iti__flag.iti__pf {
    height: 14px;
    background-position: -3943px 0px; }
.iti__flag.iti__pg {
    height: 15px;
    background-position: -3965px 0px; }
.iti__flag.iti__ph {
    height: 10px;
    background-position: -3987px 0px; }
.iti__flag.iti__pk {
    height: 14px;
    background-position: -4009px 0px; }
.iti__flag.iti__pl {
    height: 13px;
    background-position: -4031px 0px; }
.iti__flag.iti__pm {
    height: 14px;
    background-position: -4053px 0px; }
.iti__flag.iti__pn {
    height: 10px;
    background-position: -4075px 0px; }
.iti__flag.iti__pr {
    height: 14px;
    background-position: -4097px 0px; }
.iti__flag.iti__ps {
    height: 10px;
    background-position: -4119px 0px; }
.iti__flag.iti__pt {
    height: 14px;
    background-position: -4141px 0px; }
.iti__flag.iti__pw {
    height: 13px;
    background-position: -4163px 0px; }
.iti__flag.iti__py {
    height: 11px;
    background-position: -4185px 0px; }
.iti__flag.iti__qa {
    height: 8px;
    background-position: -4207px 0px; }
.iti__flag.iti__re {
    height: 14px;
    background-position: -4229px 0px; }
.iti__flag.iti__ro {
    height: 14px;
    background-position: -4251px 0px; }
.iti__flag.iti__rs {
    height: 14px;
    background-position: -4273px 0px; }
.iti__flag.iti__ru {
    height: 14px;
    background-position: -4295px 0px; }
.iti__flag.iti__rw {
    height: 14px;
    background-position: -4317px 0px; }
.iti__flag.iti__sa {
    height: 14px;
    background-position: -4339px 0px; }
.iti__flag.iti__sb {
    height: 10px;
    background-position: -4361px 0px; }
.iti__flag.iti__sc {
    height: 10px;
    background-position: -4383px 0px; }
.iti__flag.iti__sd {
    height: 10px;
    background-position: -4405px 0px; }
.iti__flag.iti__se {
    height: 13px;
    background-position: -4427px 0px; }
.iti__flag.iti__sg {
    height: 14px;
    background-position: -4449px 0px; }
.iti__flag.iti__sh {
    height: 10px;
    background-position: -4471px 0px; }
.iti__flag.iti__si {
    height: 10px;
    background-position: -4493px 0px; }
.iti__flag.iti__sj {
    height: 15px;
    background-position: -4515px 0px; }
.iti__flag.iti__sk {
    height: 14px;
    background-position: -4537px 0px; }
.iti__flag.iti__sl {
    height: 14px;
    background-position: -4559px 0px; }
.iti__flag.iti__sm {
    height: 15px;
    background-position: -4581px 0px; }
.iti__flag.iti__sn {
    height: 14px;
    background-position: -4603px 0px; }
.iti__flag.iti__so {
    height: 14px;
    background-position: -4625px 0px; }
.iti__flag.iti__sr {
    height: 14px;
    background-position: -4647px 0px; }
.iti__flag.iti__ss {
    height: 10px;
    background-position: -4669px 0px; }
.iti__flag.iti__st {
    height: 10px;
    background-position: -4691px 0px; }
.iti__flag.iti__sv {
    height: 12px;
    background-position: -4713px 0px; }
.iti__flag.iti__sx {
    height: 14px;
    background-position: -4735px 0px; }
.iti__flag.iti__sy {
    height: 14px;
    background-position: -4757px 0px; }
.iti__flag.iti__sz {
    height: 14px;
    background-position: -4779px 0px; }
.iti__flag.iti__ta {
    height: 10px;
    background-position: -4801px 0px; }
.iti__flag.iti__tc {
    height: 10px;
    background-position: -4823px 0px; }
.iti__flag.iti__td {
    height: 14px;
    background-position: -4845px 0px; }
.iti__flag.iti__tf {
    height: 14px;
    background-position: -4867px 0px; }
.iti__flag.iti__tg {
    height: 13px;
    background-position: -4889px 0px; }
.iti__flag.iti__th {
    height: 14px;
    background-position: -4911px 0px; }
.iti__flag.iti__tj {
    height: 10px;
    background-position: -4933px 0px; }
.iti__flag.iti__tk {
    height: 10px;
    background-position: -4955px 0px; }
.iti__flag.iti__tl {
    height: 10px;
    background-position: -4977px 0px; }
.iti__flag.iti__tm {
    height: 14px;
    background-position: -4999px 0px; }
.iti__flag.iti__tn {
    height: 14px;
    background-position: -5021px 0px; }
.iti__flag.iti__to {
    height: 10px;
    background-position: -5043px 0px; }
.iti__flag.iti__tr {
    height: 14px;
    background-position: -5065px 0px; }
.iti__flag.iti__tt {
    height: 12px;
    background-position: -5087px 0px; }
.iti__flag.iti__tv {
    height: 10px;
    background-position: -5109px 0px; }
.iti__flag.iti__tw {
    height: 14px;
    background-position: -5131px 0px; }
.iti__flag.iti__tz {
    height: 14px;
    background-position: -5153px 0px; }
.iti__flag.iti__ua {
    height: 14px;
    background-position: -5175px 0px; }
.iti__flag.iti__ug {
    height: 14px;
    background-position: -5197px 0px; }
.iti__flag.iti__um {
    height: 11px;
    background-position: -5219px 0px; }
.iti__flag.iti__un {
    height: 14px;
    background-position: -5241px 0px; }
.iti__flag.iti__us {
    height: 11px;
    background-position: -5263px 0px; }
.iti__flag.iti__uy {
    height: 14px;
    background-position: -5285px 0px; }
.iti__flag.iti__uz {
    height: 10px;
    background-position: -5307px 0px; }
.iti__flag.iti__va {
    height: 15px;
    background-position: -5329px 0px; }
.iti__flag.iti__vc {
    height: 14px;
    background-position: -5346px 0px; }
.iti__flag.iti__ve {
    height: 14px;
    background-position: -5368px 0px; }
.iti__flag.iti__vg {
    height: 10px;
    background-position: -5390px 0px; }
.iti__flag.iti__vi {
    height: 14px;
    background-position: -5412px 0px; }
.iti__flag.iti__vn {
    height: 14px;
    background-position: -5434px 0px; }
.iti__flag.iti__vu {
    height: 12px;
    background-position: -5456px 0px; }
.iti__flag.iti__wf {
    height: 14px;
    background-position: -5478px 0px; }
.iti__flag.iti__ws {
    height: 10px;
    background-position: -5500px 0px; }
.iti__flag.iti__xk {
    height: 15px;
    background-position: -5522px 0px; }
.iti__flag.iti__ye {
    height: 14px;
    background-position: -5544px 0px; }
.iti__flag.iti__yt {
    height: 14px;
    background-position: -5566px 0px; }
.iti__flag.iti__za {
    height: 14px;
    background-position: -5588px 0px; }
.iti__flag.iti__zm {
    height: 14px;
    background-position: -5610px 0px; }
.iti__flag.iti__zw {
    height: 10px;
    background-position: -5632px 0px; }

.iti__flag {
    height: 15px;
    box-shadow: 0px 0px 1px 0px #888;
    background-image: url('";
        // line 15594
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), ["visiosoft.theme.base::images/flags.png"]), "path", [], "any", false, false, false, 15594), "html", null, true);
        echo "');
    background-repeat: no-repeat;
    background-color: #DBDBDB;
    background-position: 20px 0; }
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {
        background-image: url('";
        // line 15600
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, call_user_func_array($this->env->getFunction('img')->getCallable(), ["visiosoft.theme.base::images/flags@2x.png"]), "url", [], "any", false, false, false, 15600), "html", null, true);
        echo "'); } }

.iti__flag.iti__np {
    background-color: transparent;
}

.iti--allow-dropdown {
    width: 100%;
}";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8d97feb171916a9b4b75d22f6a3de8e4.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  15693 => 15600,  15684 => 15594,  3612 => 3533,  3608 => 3532,  3592 => 3521,  3579 => 3513,  65 => 10,  61 => 9,  46 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("@charset \"UTF-8\";
@font-face {
  font-family: \"Glyphicons Regular\";
  src: url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.eot\") }}');
  src: url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.eot\") }}?#iefix') format(\"embedded-opentype\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.woff2\") }}') format(\"woff2\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.woff\") }}') format(\"woff\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.ttf\") }}') format(\"truetype\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-regular.svg\") }}#glyphiconsregular') format(\"svg\");
}
@font-face {
  font-family: \"Glyphicons Filetypes\";
  src: url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.eot\") }}');
  src: url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.eot\") }}?#iefix') format(\"embedded-opentype\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.woff2\") }}') format(\"woff2\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.woff\") }}') format(\"woff\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.ttf\") }}') format(\"truetype\"), url('{{ asset_path(\"theme::fonts/glyphicons/glyphicons-filetypes-regular.svg\") }}#glyphicons_filetypesregular') format(\"svg\");
}
.filetypes {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: \"Glyphicons Filetypes\";
  font-style: normal;
  font-weight: normal;
  vertical-align: top;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.filetypes.x05 {
  font-size: 12px;
}

.filetypes.x2 {
  font-size: 48px;
}

.filetypes.x3 {
  font-size: 72px;
}

.filetypes.x4 {
  font-size: 96px;
}

.filetypes.x5 {
  font-size: 120px;
}

.filetypes.light:before {
  color: #f2f2f2;
}

.filetypes.drop:before {
  text-shadow: -1px 1px 3px rgba(0, 0, 0, 0.3);
}

.filetypes.flip {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  -webkit-filter: FlipH;
          filter: FlipH;
  -ms-filter: \"FlipH\";
}

.filetypes.flipv {
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  -webkit-filter: FlipV;
          filter: FlipV;
  -ms-filter: \"FlipV\";
}

.filetypes.rotate90 {
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.filetypes.rotate180 {
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.filetypes.rotate270 {
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.filetypes-txt:before {
  content: \"\\E001\";
}

.filetypes-doc:before {
  content: \"\\E002\";
}

.filetypes-rtf:before {
  content: \"\\E003\";
}

.filetypes-log:before {
  content: \"\\E004\";
}

.filetypes-tex:before {
  content: \"\\E005\";
}

.filetypes-msg:before {
  content: \"\\E006\";
}

.filetypes-text:before {
  content: \"\\E007\";
}

.filetypes-wpd:before {
  content: \"\\E008\";
}

.filetypes-wps:before {
  content: \"\\E009\";
}

.filetypes-docx:before {
  content: \"\\E010\";
}

.filetypes-page:before {
  content: \"\\E011\";
}

.filetypes-csv:before {
  content: \"\\E012\";
}

.filetypes-dat:before {
  content: \"\\E013\";
}

.filetypes-tar:before {
  content: \"\\E014\";
}

.filetypes-xml:before {
  content: \"\\E015\";
}

.filetypes-vcf:before {
  content: \"\\E016\";
}

.filetypes-pps:before {
  content: \"\\E017\";
}

.filetypes-key:before {
  content: \"\\E018\";
}

.filetypes-ppt:before {
  content: \"\\E019\";
}

.filetypes-pptx:before {
  content: \"\\E020\";
}

.filetypes-sdf:before {
  content: \"\\E021\";
}

.filetypes-gbr:before {
  content: \"\\E022\";
}

.filetypes-ged:before {
  content: \"\\E023\";
}

.filetypes-mp3:before {
  content: \"\\E024\";
}

.filetypes-m4a:before {
  content: \"\\E025\";
}

.filetypes-waw:before {
  content: \"\\E026\";
}

.filetypes-wma:before {
  content: \"\\E027\";
}

.filetypes-mpa:before {
  content: \"\\E028\";
}

.filetypes-iff:before {
  content: \"\\E029\";
}

.filetypes-aif:before {
  content: \"\\E030\";
}

.filetypes-ra:before {
  content: \"\\E031\";
}

.filetypes-mid:before {
  content: \"\\E032\";
}

.filetypes-m3v:before {
  content: \"\\E033\";
}

.filetypes-e-3gp:before {
  content: \"\\E034\";
}

.filetypes-swf:before {
  content: \"\\E035\";
}

.filetypes-avi:before {
  content: \"\\E036\";
}

.filetypes-asx:before {
  content: \"\\E037\";
}

.filetypes-mp4:before {
  content: \"\\E038\";
}

.filetypes-e-3g2:before {
  content: \"\\E039\";
}

.filetypes-mpg:before {
  content: \"\\E040\";
}

.filetypes-asf:before {
  content: \"\\E041\";
}

.filetypes-vob:before {
  content: \"\\E042\";
}

.filetypes-wmv:before {
  content: \"\\E043\";
}

.filetypes-mov:before {
  content: \"\\E044\";
}

.filetypes-srt:before {
  content: \"\\E045\";
}

.filetypes-m4v:before {
  content: \"\\E046\";
}

.filetypes-flv:before {
  content: \"\\E047\";
}

.filetypes-rm:before {
  content: \"\\E048\";
}

.filetypes-png:before {
  content: \"\\E049\";
}

.filetypes-psd:before {
  content: \"\\E050\";
}

.filetypes-psp:before {
  content: \"\\E051\";
}

.filetypes-jpg:before {
  content: \"\\E052\";
}

.filetypes-tif:before {
  content: \"\\E053\";
}

.filetypes-tiff:before {
  content: \"\\E054\";
}

.filetypes-gif:before {
  content: \"\\E055\";
}

.filetypes-bmp:before {
  content: \"\\E056\";
}

.filetypes-tga:before {
  content: \"\\E057\";
}

.filetypes-thm:before {
  content: \"\\E058\";
}

.filetypes-yuv:before {
  content: \"\\E059\";
}

.filetypes-dds:before {
  content: \"\\E060\";
}

.filetypes-ai:before {
  content: \"\\E061\";
}

.filetypes-eps:before {
  content: \"\\E062\";
}

.filetypes-ps:before {
  content: \"\\E063\";
}

.filetypes-svg:before {
  content: \"\\E064\";
}

.filetypes-pdf:before {
  content: \"\\E065\";
}

.filetypes-pct:before {
  content: \"\\E066\";
}

.filetypes-indd:before {
  content: \"\\E067\";
}

.filetypes-xlr:before {
  content: \"\\E068\";
}

.filetypes-xls:before {
  content: \"\\E069\";
}

.filetypes-xlsx:before {
  content: \"\\E070\";
}

.filetypes-db:before {
  content: \"\\E071\";
}

.filetypes-dbf:before {
  content: \"\\E072\";
}

.filetypes-mdb:before {
  content: \"\\E073\";
}

.filetypes-pdb:before {
  content: \"\\E074\";
}

.filetypes-sql:before {
  content: \"\\E075\";
}

.filetypes-aacd:before {
  content: \"\\E076\";
}

.filetypes-app:before {
  content: \"\\E077\";
}

.filetypes-exe:before {
  content: \"\\E078\";
}

.filetypes-com:before {
  content: \"\\E079\";
}

.filetypes-bat:before {
  content: \"\\E080\";
}

.filetypes-apk:before {
  content: \"\\E081\";
}

.filetypes-jar:before {
  content: \"\\E082\";
}

.filetypes-hsf:before {
  content: \"\\E083\";
}

.filetypes-pif:before {
  content: \"\\E084\";
}

.filetypes-vb:before {
  content: \"\\E085\";
}

.filetypes-cgi:before {
  content: \"\\E086\";
}

.filetypes-css:before {
  content: \"\\E087\";
}

.filetypes-js:before {
  content: \"\\E088\";
}

.filetypes-php:before {
  content: \"\\E089\";
}

.filetypes-xhtml:before {
  content: \"\\E090\";
}

.filetypes-htm:before {
  content: \"\\E091\";
}

.filetypes-html:before {
  content: \"\\E092\";
}

.filetypes-asp:before {
  content: \"\\E093\";
}

.filetypes-cer:before {
  content: \"\\E094\";
}

.filetypes-jsp:before {
  content: \"\\E095\";
}

.filetypes-cfm:before {
  content: \"\\E096\";
}

.filetypes-aspx:before {
  content: \"\\E097\";
}

.filetypes-rss:before {
  content: \"\\E098\";
}

.filetypes-csr:before {
  content: \"\\E099\";
}

.filetypes-less:before {
  content: \"<\";
}

.filetypes-otf:before {
  content: \"\\E101\";
}

.filetypes-ttf:before {
  content: \"\\E102\";
}

.filetypes-font:before {
  content: \"\\E103\";
}

.filetypes-fnt:before {
  content: \"\\E104\";
}

.filetypes-eot:before {
  content: \"\\E105\";
}

.filetypes-woff:before {
  content: \"\\E106\";
}

.filetypes-zip:before {
  content: \"\\E107\";
}

.filetypes-zipx:before {
  content: \"\\E108\";
}

.filetypes-rar:before {
  content: \"\\E109\";
}

.filetypes-targ:before {
  content: \"\\E110\";
}

.filetypes-sitx:before {
  content: \"\\E111\";
}

.filetypes-deb:before {
  content: \"\\E112\";
}

.filetypes-e-7z:before {
  content: \"\\E113\";
}

.filetypes-pkg:before {
  content: \"\\E114\";
}

.filetypes-rpm:before {
  content: \"\\E115\";
}

.filetypes-cbr:before {
  content: \"\\E116\";
}

.filetypes-gz:before {
  content: \"\\E117\";
}

.filetypes-dmg:before {
  content: \"\\E118\";
}

.filetypes-cue:before {
  content: \"\\E119\";
}

.filetypes-bin:before {
  content: \"\\E120\";
}

.filetypes-iso:before {
  content: \"\\E121\";
}

.filetypes-hdf:before {
  content: \"\\E122\";
}

.filetypes-vcd:before {
  content: \"\\E123\";
}

.filetypes-bak:before {
  content: \"\\E124\";
}

.filetypes-tmp:before {
  content: \"\\E125\";
}

.filetypes-ics:before {
  content: \"\\E126\";
}

.filetypes-msi:before {
  content: \"\\E127\";
}

.filetypes-cfg:before {
  content: \"\\E128\";
}

.filetypes-ini:before {
  content: \"\\E129\";
}

.filetypes-prf:before {
  content: \"\\E130\";
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
  }
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

@-webkit-keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}
@keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(-200deg);
            transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(0);
            transform: rotate(0);
    opacity: 1;
  }
}
.rotateIn {
  -webkit-animation-name: rotateIn;
  animation-name: rotateIn;
}

@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
            transform: translateY(-15px);
  }
}
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
}

@-webkit-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
  }
  20% {
    -webkit-transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
            transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
            transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}

@-webkit-keyframes tada {
  0% {
    -webkit-transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
  }
}
@keyframes tada {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
  }
}
.tada {
  -webkit-animation-name: tada;
  animation-name: tada;
}

.glyphicons {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: \"Glyphicons Regular\";
  font-style: normal;
  font-weight: normal;
  vertical-align: top;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.glyphicons.x05 {
  font-size: 12px;
}

.glyphicons.x2 {
  font-size: 48px;
}

.glyphicons.x3 {
  font-size: 72px;
}

.glyphicons.x4 {
  font-size: 96px;
}

.glyphicons.x5 {
  font-size: 120px;
}

.glyphicons.light:before {
  color: #f2f2f2;
}

.glyphicons.drop:before {
  text-shadow: -1px 1px 3px rgba(0, 0, 0, 0.3);
}

.glyphicons.flip {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  -webkit-filter: FlipH;
          filter: FlipH;
  -ms-filter: \"FlipH\";
}

.glyphicons.flipv {
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  -webkit-filter: FlipV;
          filter: FlipV;
  -ms-filter: \"FlipV\";
}

.glyphicons.rotate90 {
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.glyphicons.rotate180 {
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.glyphicons.rotate270 {
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.glyphicons-glass:before {
  content: \"\\E001\";
}

.glyphicons-leaf:before {
  content: \"\\E002\";
}

.glyphicons-dog:before {
  content: \"\\E003\";
}

.glyphicons-user:before {
  content: \"\\E004\";
}

.glyphicons-girl:before {
  content: \"\\E005\";
}

.glyphicons-car:before {
  content: \"\\E006\";
}

.glyphicons-user-add:before {
  content: \"\\E007\";
}

.glyphicons-user-remove:before {
  content: \"\\E008\";
}

.glyphicons-film:before {
  content: \"\\E009\";
}

.glyphicons-magic:before {
  content: \"\\E010\";
}

.glyphicons-envelope:before {
  content: \"\\2709\";
}

.glyphicons-camera:before {
  content: \"\\E011\";
}

.glyphicons-heart:before {
  content: \"\\E013\";
}

.glyphicons-beach-umbrella:before {
  content: \"\\E014\";
}

.glyphicons-train:before {
  content: \"\\E015\";
}

.glyphicons-print:before {
  content: \"\\E016\";
}

.glyphicons-bin:before {
  content: \"\\E017\";
}

.glyphicons-music:before {
  content: \"\\E018\";
}

.glyphicons-note:before {
  content: \"\\E019\";
}

.glyphicons-heart-empty:before {
  content: \"\\E020\";
}

.glyphicons-home:before {
  content: \"\\E021\";
}

.glyphicons-snowflake:before {
  content: \"\\2744\";
}

.glyphicons-fire:before {
  content: \"\\E023\";
}

.glyphicons-magnet:before {
  content: \"\\E024\";
}

.glyphicons-parents:before {
  content: \"\\E025\";
}

.glyphicons-binoculars:before {
  content: \"\\E026\";
}

.glyphicons-road:before {
  content: \"\\E027\";
}

.glyphicons-search:before {
  content: \"\\E028\";
}

.glyphicons-cars:before {
  content: \"\\E029\";
}

.glyphicons-notes-2:before {
  content: \"\\E030\";
}

.glyphicons-pencil:before {
  content: \"\\270F\";
}

.glyphicons-bus:before {
  content: \"\\E032\";
}

.glyphicons-wifi-alt:before {
  content: \"\\E033\";
}

.glyphicons-luggage:before {
  content: \"\\E034\";
}

.glyphicons-old-man:before {
  content: \"\\E035\";
}

.glyphicons-woman:before {
  content: \"\\E036\";
}

.glyphicons-file:before {
  content: \"\\E037\";
}

.glyphicons-coins:before {
  content: \"\\E038\";
}

.glyphicons-airplane:before {
  content: \"\\2708\";
}

.glyphicons-notes:before {
  content: \"\\E040\";
}

.glyphicons-stats:before {
  content: \"\\E041\";
}

.glyphicons-charts:before {
  content: \"\\E042\";
}

.glyphicons-pie-chart:before {
  content: \"\\E043\";
}

.glyphicons-group:before {
  content: \"\\E044\";
}

.glyphicons-keys:before {
  content: \"\\E045\";
}

.glyphicons-calendar:before {
  content: \"\\E046\";
}

.glyphicons-router:before {
  content: \"\\E047\";
}

.glyphicons-camera-small:before {
  content: \"\\E048\";
}

.glyphicons-star-empty:before {
  content: \"\\E049\";
}

.glyphicons-star:before {
  content: \"\\E050\";
}

.glyphicons-link:before {
  content: \"\\E051\";
}

.glyphicons-eye-open:before {
  content: \"\\E052\";
}

.glyphicons-eye-close:before {
  content: \"\\E053\";
}

.glyphicons-alarm:before {
  content: \"\\E054\";
}

.glyphicons-clock:before {
  content: \"\\E055\";
}

.glyphicons-stopwatch:before {
  content: \"\\E056\";
}

.glyphicons-projector:before {
  content: \"\\E057\";
}

.glyphicons-history:before {
  content: \"\\E058\";
}

.glyphicons-truck:before {
  content: \"\\E059\";
}

.glyphicons-cargo:before {
  content: \"\\E060\";
}

.glyphicons-compass:before {
  content: \"\\E061\";
}

.glyphicons-keynote:before {
  content: \"\\E062\";
}

.glyphicons-paperclip:before {
  content: \"\\E063\";
}

.glyphicons-power:before {
  content: \"\\E064\";
}

.glyphicons-lightbulb:before {
  content: \"\\E065\";
}

.glyphicons-tag:before {
  content: \"\\E066\";
}

.glyphicons-tags:before {
  content: \"\\E067\";
}

.glyphicons-cleaning:before {
  content: \"\\E068\";
}

.glyphicons-ruler:before {
  content: \"\\E069\";
}

.glyphicons-gift:before {
  content: \"\\E070\";
}

.glyphicons-umbrella:before {
  content: \"\\2602\";
}

.glyphicons-book:before {
  content: \"\\E072\";
}

.glyphicons-bookmark:before {
  content: \"\\E073\";
}

.glyphicons-wifi:before {
  content: \"\\E074\";
}

.glyphicons-cup:before {
  content: \"\\E075\";
}

.glyphicons-stroller:before {
  content: \"\\E076\";
}

.glyphicons-headphones:before {
  content: \"\\E077\";
}

.glyphicons-headset:before {
  content: \"\\E078\";
}

.glyphicons-warning-sign:before {
  content: \"\\E079\";
}

.glyphicons-signal:before {
  content: \"\\E080\";
}

.glyphicons-retweet:before {
  content: \"\\E081\";
}

.glyphicons-refresh:before {
  content: \"\\E082\";
}

.glyphicons-roundabout:before {
  content: \"\\E083\";
}

.glyphicons-random:before {
  content: \"\\E084\";
}

.glyphicons-heat:before {
  content: \"\\E085\";
}

.glyphicons-repeat:before {
  content: \"\\E086\";
}

.glyphicons-display:before {
  content: \"\\E087\";
}

.glyphicons-log-book:before {
  content: \"\\E088\";
}

.glyphicons-address-book:before {
  content: \"\\E089\";
}

.glyphicons-building:before {
  content: \"\\E090\";
}

.glyphicons-eyedropper:before {
  content: \"\\E091\";
}

.glyphicons-adjust:before {
  content: \"\\E092\";
}

.glyphicons-tint:before {
  content: \"\\E093\";
}

.glyphicons-crop:before {
  content: \"\\E094\";
}

.glyphicons-vector-path-square:before {
  content: \"\\E095\";
}

.glyphicons-vector-path-circle:before {
  content: \"\\E096\";
}

.glyphicons-vector-path-polygon:before {
  content: \"\\E097\";
}

.glyphicons-vector-path-line:before {
  content: \"\\E098\";
}

.glyphicons-vector-path-curve:before {
  content: \"\\E099\";
}

.glyphicons-vector-path-all:before {
  content: \"\\E100\";
}

.glyphicons-font:before {
  content: \"\\E101\";
}

.glyphicons-italic:before {
  content: \"\\E102\";
}

.glyphicons-bold:before {
  content: \"\\E103\";
}

.glyphicons-text-underline:before {
  content: \"\\E104\";
}

.glyphicons-text-strike:before {
  content: \"\\E105\";
}

.glyphicons-text-height:before {
  content: \"\\E106\";
}

.glyphicons-text-width:before {
  content: \"\\E107\";
}

.glyphicons-text-resize:before {
  content: \"\\E108\";
}

.glyphicons-left-indent:before {
  content: \"\\E109\";
}

.glyphicons-right-indent:before {
  content: \"\\E110\";
}

.glyphicons-align-left:before {
  content: \"\\E111\";
}

.glyphicons-align-center:before {
  content: \"\\E112\";
}

.glyphicons-align-right:before {
  content: \"\\E113\";
}

.glyphicons-justify:before {
  content: \"\\E114\";
}

.glyphicons-list:before {
  content: \"\\E115\";
}

.glyphicons-text-smaller:before {
  content: \"\\E116\";
}

.glyphicons-text-bigger:before {
  content: \"\\E117\";
}

.glyphicons-embed:before {
  content: \"\\E118\";
}

.glyphicons-embed-close:before {
  content: \"\\E119\";
}

.glyphicons-table:before {
  content: \"\\E120\";
}

.glyphicons-message-full:before {
  content: \"\\E121\";
}

.glyphicons-message-empty:before {
  content: \"\\E122\";
}

.glyphicons-message-in:before {
  content: \"\\E123\";
}

.glyphicons-message-out:before {
  content: \"\\E124\";
}

.glyphicons-message-plus:before {
  content: \"\\E125\";
}

.glyphicons-message-minus:before {
  content: \"\\E126\";
}

.glyphicons-message-ban:before {
  content: \"\\E127\";
}

.glyphicons-message-flag:before {
  content: \"\\E128\";
}

.glyphicons-message-lock:before {
  content: \"\\E129\";
}

.glyphicons-message-new:before {
  content: \"\\E130\";
}

.glyphicons-inbox:before {
  content: \"\\E131\";
}

.glyphicons-inbox-plus:before {
  content: \"\\E132\";
}

.glyphicons-inbox-minus:before {
  content: \"\\E133\";
}

.glyphicons-inbox-lock:before {
  content: \"\\E134\";
}

.glyphicons-inbox-in:before {
  content: \"\\E135\";
}

.glyphicons-inbox-out:before {
  content: \"\\E136\";
}

.glyphicons-cogwheel:before {
  content: \"\\E137\";
}

.glyphicons-cogwheels:before {
  content: \"\\E138\";
}

.glyphicons-picture:before {
  content: \"\\E139\";
}

.glyphicons-adjust-alt:before {
  content: \"\\E140\";
}

.glyphicons-database-lock:before {
  content: \"\\E141\";
}

.glyphicons-database-plus:before {
  content: \"\\E142\";
}

.glyphicons-database-minus:before {
  content: \"\\E143\";
}

.glyphicons-database-ban:before {
  content: \"\\E144\";
}

.glyphicons-folder-open:before {
  content: \"\\E145\";
}

.glyphicons-folder-plus:before {
  content: \"\\E146\";
}

.glyphicons-folder-minus:before {
  content: \"\\E147\";
}

.glyphicons-folder-lock:before {
  content: \"\\E148\";
}

.glyphicons-folder-flag:before {
  content: \"\\E149\";
}

.glyphicons-folder-new:before {
  content: \"\\E150\";
}

.glyphicons-edit:before {
  content: \"\\E151\";
}

.glyphicons-new-window:before {
  content: \"\\E152\";
}

.glyphicons-check:before {
  content: \"\\E153\";
}

.glyphicons-unchecked:before {
  content: \"\\E154\";
}

.glyphicons-more-windows:before {
  content: \"\\E155\";
}

.glyphicons-show-big-thumbnails:before {
  content: \"\\E156\";
}

.glyphicons-show-thumbnails:before {
  content: \"\\E157\";
}

.glyphicons-show-thumbnails-with-lines:before {
  content: \"\\E158\";
}

.glyphicons-show-lines:before {
  content: \"\\E159\";
}

.glyphicons-playlist:before {
  content: \"\\E160\";
}

.glyphicons-imac:before {
  content: \"\\E161\";
}

.glyphicons-macbook:before {
  content: \"\\E162\";
}

.glyphicons-ipad:before {
  content: \"\\E163\";
}

.glyphicons-iphone:before {
  content: \"\\E164\";
}

.glyphicons-iphone-transfer:before {
  content: \"\\E165\";
}

.glyphicons-iphone-exchange:before {
  content: \"\\E166\";
}

.glyphicons-ipod:before {
  content: \"\\E167\";
}

.glyphicons-ipod-shuffle:before {
  content: \"\\E168\";
}

.glyphicons-ear-plugs:before {
  content: \"\\E169\";
}

.glyphicons-record:before {
  content: \"\\E170\";
}

.glyphicons-step-backward:before {
  content: \"\\E171\";
}

.glyphicons-fast-backward:before {
  content: \"\\E172\";
}

.glyphicons-rewind:before {
  content: \"\\E173\";
}

.glyphicons-play:before {
  content: \"\\E174\";
}

.glyphicons-pause:before {
  content: \"\\E175\";
}

.glyphicons-stop:before {
  content: \"\\E176\";
}

.glyphicons-forward:before {
  content: \"\\E177\";
}

.glyphicons-fast-forward:before {
  content: \"\\E178\";
}

.glyphicons-step-forward:before {
  content: \"\\E179\";
}

.glyphicons-eject:before {
  content: \"\\E180\";
}

.glyphicons-facetime-video:before {
  content: \"\\E181\";
}

.glyphicons-download-alt:before {
  content: \"\\E182\";
}

.glyphicons-mute:before {
  content: \"\\E183\";
}

.glyphicons-volume-down:before {
  content: \"\\E184\";
}

.glyphicons-volume-up:before {
  content: \"\\E185\";
}

.glyphicons-screenshot:before {
  content: \"\\E186\";
}

.glyphicons-move:before {
  content: \"\\E187\";
}

.glyphicons-more:before {
  content: \"\\E188\";
}

.glyphicons-brightness-reduce:before {
  content: \"\\E189\";
}

.glyphicons-brightness-increase:before {
  content: \"\\E190\";
}

.glyphicons-circle-plus:before {
  content: \"\\E191\";
}

.glyphicons-circle-minus:before {
  content: \"\\E192\";
}

.glyphicons-circle-remove:before {
  content: \"\\E193\";
}

.glyphicons-circle-ok:before {
  content: \"\\E194\";
}

.glyphicons-circle-question-mark:before {
  content: \"\\E195\";
}

.glyphicons-circle-info:before {
  content: \"\\E196\";
}

.glyphicons-circle-exclamation-mark:before {
  content: \"\\E197\";
}

.glyphicons-remove:before {
  content: \"\\E198\";
}

.glyphicons-ok:before {
  content: \"\\E199\";
}

.glyphicons-ban:before {
  content: \"\\E200\";
}

.glyphicons-download:before {
  content: \"\\E201\";
}

.glyphicons-upload:before {
  content: \"\\E202\";
}

.glyphicons-shopping-cart:before {
  content: \"\\E203\";
}

.glyphicons-lock:before {
  content: \"\\E204\";
}

.glyphicons-unlock:before {
  content: \"\\E205\";
}

.glyphicons-electricity:before {
  content: \"\\E206\";
}

.glyphicons-ok-2:before {
  content: \"\\E207\";
}

.glyphicons-remove-2:before {
  content: \"\\E208\";
}

.glyphicons-cart-out:before {
  content: \"\\E209\";
}

.glyphicons-cart-in:before {
  content: \"\\E210\";
}

.glyphicons-left-arrow:before {
  content: \"\\E211\";
}

.glyphicons-right-arrow:before {
  content: \"\\E212\";
}

.glyphicons-down-arrow:before {
  content: \"\\E213\";
}

.glyphicons-up-arrow:before {
  content: \"\\E214\";
}

.glyphicons-resize-small:before {
  content: \"\\E215\";
}

.glyphicons-resize-full:before {
  content: \"\\E216\";
}

.glyphicons-circle-arrow-left:before {
  content: \"\\E217\";
}

.glyphicons-circle-arrow-right:before {
  content: \"\\E218\";
}

.glyphicons-circle-arrow-top:before {
  content: \"\\E219\";
}

.glyphicons-circle-arrow-down:before {
  content: \"\\E220\";
}

.glyphicons-play-button:before {
  content: \"\\E221\";
}

.glyphicons-unshare:before {
  content: \"\\E222\";
}

.glyphicons-share:before {
  content: \"\\E223\";
}

.glyphicons-chevron-right:before {
  content: \"\\E224\";
}

.glyphicons-chevron-left:before {
  content: \"\\E225\";
}

.glyphicons-bluetooth:before {
  content: \"\\E226\";
}

.glyphicons-euro:before {
  content: \"\\20AC\";
}

.glyphicons-usd:before {
  content: \"\\E228\";
}

.glyphicons-gbp:before {
  content: \"\\E229\";
}

.glyphicons-retweet-2:before {
  content: \"\\E230\";
}

.glyphicons-moon:before {
  content: \"\\E231\";
}

.glyphicons-sun:before {
  content: \"\\2609\";
}

.glyphicons-cloud:before {
  content: \"\\2601\";
}

.glyphicons-direction:before {
  content: \"\\E234\";
}

.glyphicons-brush:before {
  content: \"\\E235\";
}

.glyphicons-pen:before {
  content: \"\\E236\";
}

.glyphicons-zoom-in:before {
  content: \"\\E237\";
}

.glyphicons-zoom-out:before {
  content: \"\\E238\";
}

.glyphicons-pin:before {
  content: \"\\E239\";
}

.glyphicons-albums:before {
  content: \"\\E240\";
}

.glyphicons-rotation-lock:before {
  content: \"\\E241\";
}

.glyphicons-flash:before {
  content: \"\\E242\";
}

.glyphicons-google-maps:before {
  content: \"\\E243\";
}

.glyphicons-anchor:before {
  content: \"\\2693\";
}

.glyphicons-conversation:before {
  content: \"\\E245\";
}

.glyphicons-chat:before {
  content: \"\\E246\";
}

.glyphicons-male:before {
  content: \"\\E247\";
}

.glyphicons-female:before {
  content: \"\\E248\";
}

.glyphicons-asterisk:before {
  content: \"*\";
}

.glyphicons-divide:before {
  content: \"\\F7\";
}

.glyphicons-snorkel-diving:before {
  content: \"\\E251\";
}

.glyphicons-scuba-diving:before {
  content: \"\\E252\";
}

.glyphicons-oxygen-bottle:before {
  content: \"\\E253\";
}

.glyphicons-fins:before {
  content: \"\\E254\";
}

.glyphicons-fishes:before {
  content: \"\\E255\";
}

.glyphicons-boat:before {
  content: \"\\E256\";
}

.glyphicons-delete:before {
  content: \"\\E257\";
}

.glyphicons-sheriffs-star:before {
  content: \"\\E258\";
}

.glyphicons-qrcode:before {
  content: \"\\E259\";
}

.glyphicons-barcode:before {
  content: \"\\E260\";
}

.glyphicons-pool:before {
  content: \"\\E261\";
}

.glyphicons-buoy:before {
  content: \"\\E262\";
}

.glyphicons-spade:before {
  content: \"\\E263\";
}

.glyphicons-bank:before {
  content: \"\\E264\";
}

.glyphicons-vcard:before {
  content: \"\\E265\";
}

.glyphicons-electrical-plug:before {
  content: \"\\E266\";
}

.glyphicons-flag:before {
  content: \"\\E267\";
}

.glyphicons-credit-card:before {
  content: \"\\E268\";
}

.glyphicons-keyboard-wireless:before {
  content: \"\\E269\";
}

.glyphicons-keyboard-wired:before {
  content: \"\\E270\";
}

.glyphicons-shield:before {
  content: \"\\E271\";
}

.glyphicons-ring:before {
  content: \"\\2DA\";
}

.glyphicons-cake:before {
  content: \"\\E273\";
}

.glyphicons-drink:before {
  content: \"\\E274\";
}

.glyphicons-beer:before {
  content: \"\\E275\";
}

.glyphicons-fast-food:before {
  content: \"\\E276\";
}

.glyphicons-cutlery:before {
  content: \"\\E277\";
}

.glyphicons-pizza:before {
  content: \"\\E278\";
}

.glyphicons-birthday-cake:before {
  content: \"\\E279\";
}

.glyphicons-tablet:before {
  content: \"\\E280\";
}

.glyphicons-settings:before {
  content: \"\\E281\";
}

.glyphicons-bullets:before {
  content: \"\\E282\";
}

.glyphicons-cardio:before {
  content: \"\\E283\";
}

.glyphicons-t-shirt:before {
  content: \"\\E284\";
}

.glyphicons-pants:before {
  content: \"\\E285\";
}

.glyphicons-sweater:before {
  content: \"\\E286\";
}

.glyphicons-fabric:before {
  content: \"\\E287\";
}

.glyphicons-leather:before {
  content: \"\\E288\";
}

.glyphicons-scissors:before {
  content: \"\\E289\";
}

.glyphicons-bomb:before {
  content: \"\\E290\";
}

.glyphicons-skull:before {
  content: \"\\E291\";
}

.glyphicons-celebration:before {
  content: \"\\E292\";
}

.glyphicons-tea-kettle:before {
  content: \"\\E293\";
}

.glyphicons-french-press:before {
  content: \"\\E294\";
}

.glyphicons-coffee-cup:before {
  content: \"\\E295\";
}

.glyphicons-pot:before {
  content: \"\\E296\";
}

.glyphicons-grater:before {
  content: \"\\E297\";
}

.glyphicons-kettle:before {
  content: \"\\E298\";
}

.glyphicons-hospital:before {
  content: \"\\E299\";
}

.glyphicons-hospital-h:before {
  content: \"\\E300\";
}

.glyphicons-microphone:before {
  content: \"\\E301\";
}

.glyphicons-webcam:before {
  content: \"\\E302\";
}

.glyphicons-temple-christianity-church:before {
  content: \"\\E303\";
}

.glyphicons-temple-islam:before {
  content: \"\\E304\";
}

.glyphicons-temple-hindu:before {
  content: \"\\E305\";
}

.glyphicons-temple-buddhist:before {
  content: \"\\E306\";
}

.glyphicons-bicycle:before {
  content: \"\\E307\";
}

.glyphicons-life-preserver:before {
  content: \"\\E308\";
}

.glyphicons-share-alt:before {
  content: \"\\E309\";
}

.glyphicons-comments:before {
  content: \"\\E310\";
}

.glyphicons-flower:before {
  content: \"\\2698\";
}

.glyphicons-baseball:before {
  content: \"\\26BE\";
}

.glyphicons-rugby:before {
  content: \"\\E313\";
}

.glyphicons-ax:before {
  content: \"\\E314\";
}

.glyphicons-table-tennis:before {
  content: \"\\E315\";
}

.glyphicons-bowling:before {
  content: \"\\E316\";
}

.glyphicons-tree-conifer:before {
  content: \"\\E317\";
}

.glyphicons-tree-deciduous:before {
  content: \"\\E318\";
}

.glyphicons-more-items:before {
  content: \"\\E319\";
}

.glyphicons-sort:before {
  content: \"\\E320\";
}

.glyphicons-filter:before {
  content: \"\\E321\";
}

.glyphicons-gamepad:before {
  content: \"\\E322\";
}

.glyphicons-playing-dices:before {
  content: \"\\E323\";
}

.glyphicons-calculator:before {
  content: \"\\E324\";
}

.glyphicons-tie:before {
  content: \"\\E325\";
}

.glyphicons-wallet:before {
  content: \"\\E326\";
}

.glyphicons-piano:before {
  content: \"\\E327\";
}

.glyphicons-sampler:before {
  content: \"\\E328\";
}

.glyphicons-podium:before {
  content: \"\\E329\";
}

.glyphicons-soccer-ball:before {
  content: \"\\E330\";
}

.glyphicons-blog:before {
  content: \"\\E331\";
}

.glyphicons-dashboard:before {
  content: \"\\E332\";
}

.glyphicons-certificate:before {
  content: \"\\E333\";
}

.glyphicons-bell:before {
  content: \"\\E334\";
}

.glyphicons-candle:before {
  content: \"\\E335\";
}

.glyphicons-pushpin:before {
  content: \"\\E336\";
}

.glyphicons-iphone-shake:before {
  content: \"\\E337\";
}

.glyphicons-pin-flag:before {
  content: \"\\E338\";
}

.glyphicons-turtle:before {
  content: \"\\E339\";
}

.glyphicons-rabbit:before {
  content: \"\\E340\";
}

.glyphicons-globe:before {
  content: \"\\E341\";
}

.glyphicons-briefcase:before {
  content: \"\\E342\";
}

.glyphicons-hdd:before {
  content: \"\\E343\";
}

.glyphicons-thumbs-up:before {
  content: \"\\E344\";
}

.glyphicons-thumbs-down:before {
  content: \"\\E345\";
}

.glyphicons-hand-right:before {
  content: \"\\E346\";
}

.glyphicons-hand-left:before {
  content: \"\\E347\";
}

.glyphicons-hand-up:before {
  content: \"\\E348\";
}

.glyphicons-hand-down:before {
  content: \"\\E349\";
}

.glyphicons-fullscreen:before {
  content: \"\\E350\";
}

.glyphicons-shopping-bag:before {
  content: \"\\E351\";
}

.glyphicons-book-open:before {
  content: \"\\E352\";
}

.glyphicons-nameplate:before {
  content: \"\\E353\";
}

.glyphicons-nameplate-alt:before {
  content: \"\\E354\";
}

.glyphicons-vases:before {
  content: \"\\E355\";
}

.glyphicons-bullhorn:before {
  content: \"\\E356\";
}

.glyphicons-dumbbell:before {
  content: \"\\E357\";
}

.glyphicons-suitcase:before {
  content: \"\\E358\";
}

.glyphicons-file-import:before {
  content: \"\\E359\";
}

.glyphicons-file-export:before {
  content: \"\\E360\";
}

.glyphicons-bug:before {
  content: \"\\E361\";
}

.glyphicons-crown:before {
  content: \"\\E362\";
}

.glyphicons-smoking:before {
  content: \"\\E363\";
}

.glyphicons-cloud-download:before {
  content: \"\\E364\";
}

.glyphicons-cloud-upload:before {
  content: \"\\E365\";
}

.glyphicons-restart:before {
  content: \"\\E366\";
}

.glyphicons-security-camera:before {
  content: \"\\E367\";
}

.glyphicons-expand:before {
  content: \"\\E368\";
}

.glyphicons-collapse:before {
  content: \"\\E369\";
}

.glyphicons-collapse-top:before {
  content: \"\\E370\";
}

.glyphicons-globe-af:before {
  content: \"\\E371\";
}

.glyphicons-global:before {
  content: \"\\E372\";
}

.glyphicons-spray:before {
  content: \"\\E373\";
}

.glyphicons-nails:before {
  content: \"\\E374\";
}

.glyphicons-claw-hammer:before {
  content: \"\\E375\";
}

.glyphicons-classic-hammer:before {
  content: \"\\E376\";
}

.glyphicons-hand-saw:before {
  content: \"\\E377\";
}

.glyphicons-riflescope:before {
  content: \"\\E378\";
}

.glyphicons-electrical-socket-eu:before {
  content: \"\\E379\";
}

.glyphicons-electrical-socket-us:before {
  content: \"\\E380\";
}

.glyphicons-message-forward:before {
  content: \"\\E381\";
}

.glyphicons-coat-hanger:before {
  content: \"\\E382\";
}

.glyphicons-dress:before {
  content: \"\\E383\";
}

.glyphicons-bathrobe:before {
  content: \"\\E384\";
}

.glyphicons-shirt:before {
  content: \"\\E385\";
}

.glyphicons-underwear:before {
  content: \"\\E386\";
}

.glyphicons-log-in:before {
  content: \"\\E387\";
}

.glyphicons-log-out:before {
  content: \"\\E388\";
}

.glyphicons-exit:before {
  content: \"\\E389\";
}

.glyphicons-new-window-alt:before {
  content: \"\\E390\";
}

.glyphicons-video-sd:before {
  content: \"\\E391\";
}

.glyphicons-video-hd:before {
  content: \"\\E392\";
}

.glyphicons-subtitles:before {
  content: \"\\E393\";
}

.glyphicons-sound-stereo:before {
  content: \"\\E394\";
}

.glyphicons-sound-dolby:before {
  content: \"\\E395\";
}

.glyphicons-sound-5-1:before {
  content: \"\\E396\";
}

.glyphicons-sound-6-1:before {
  content: \"\\E397\";
}

.glyphicons-sound-7-1:before {
  content: \"\\E398\";
}

.glyphicons-copyright-mark:before {
  content: \"\\E399\";
}

.glyphicons-registration-mark:before {
  content: \"\\E400\";
}

.glyphicons-radar:before {
  content: \"\\E401\";
}

.glyphicons-skateboard:before {
  content: \"\\E402\";
}

.glyphicons-golf-course:before {
  content: \"\\E403\";
}

.glyphicons-sorting:before {
  content: \"\\E404\";
}

.glyphicons-sort-by-alphabet:before {
  content: \"\\E405\";
}

.glyphicons-sort-by-alphabet-alt:before {
  content: \"\\E406\";
}

.glyphicons-sort-by-order:before {
  content: \"\\E407\";
}

.glyphicons-sort-by-order-alt:before {
  content: \"\\E408\";
}

.glyphicons-sort-by-attributes:before {
  content: \"\\E409\";
}

.glyphicons-sort-by-attributes-alt:before {
  content: \"\\E410\";
}

.glyphicons-compressed:before {
  content: \"\\E411\";
}

.glyphicons-package:before {
  content: \"\\E412\";
}

.glyphicons-cloud-plus:before {
  content: \"\\E413\";
}

.glyphicons-cloud-minus:before {
  content: \"\\E414\";
}

.glyphicons-disk-save:before {
  content: \"\\E415\";
}

.glyphicons-disk-open:before {
  content: \"\\E416\";
}

.glyphicons-disk-saved:before {
  content: \"\\E417\";
}

.glyphicons-disk-remove:before {
  content: \"\\E418\";
}

.glyphicons-disk-import:before {
  content: \"\\E419\";
}

.glyphicons-disk-export:before {
  content: \"\\E420\";
}

.glyphicons-tower:before {
  content: \"\\E421\";
}

.glyphicons-send:before {
  content: \"\\E422\";
}

.glyphicons-git-branch:before {
  content: \"\\E423\";
}

.glyphicons-git-create:before {
  content: \"\\E424\";
}

.glyphicons-git-private:before {
  content: \"\\E425\";
}

.glyphicons-git-delete:before {
  content: \"\\E426\";
}

.glyphicons-git-merge:before {
  content: \"\\E427\";
}

.glyphicons-git-pull-request:before {
  content: \"\\E428\";
}

.glyphicons-git-compare:before {
  content: \"\\E429\";
}

.glyphicons-git-commit:before {
  content: \"\\E430\";
}

.glyphicons-construction-cone:before {
  content: \"\\E431\";
}

.glyphicons-shoe-steps:before {
  content: \"\\E432\";
}

.glyphicons-plus:before {
  content: \"+\";
}

.glyphicons-minus:before {
  content: \"\\2212\";
}

.glyphicons-redo:before {
  content: \"\\E435\";
}

.glyphicons-undo:before {
  content: \"\\E436\";
}

.glyphicons-golf:before {
  content: \"\\E437\";
}

.glyphicons-hockey:before {
  content: \"\\E438\";
}

.glyphicons-pipe:before {
  content: \"\\E439\";
}

.glyphicons-wrench:before {
  content: \"\\E440\";
}

.glyphicons-folder-closed:before {
  content: \"\\E441\";
}

.glyphicons-phone-alt:before {
  content: \"\\E442\";
}

.glyphicons-earphone:before {
  content: \"\\E443\";
}

.glyphicons-floppy-disk:before {
  content: \"\\E444\";
}

.glyphicons-floppy-saved:before {
  content: \"\\E445\";
}

.glyphicons-floppy-remove:before {
  content: \"\\E446\";
}

.glyphicons-floppy-save:before {
  content: \"\\E447\";
}

.glyphicons-floppy-open:before {
  content: \"\\E448\";
}

.glyphicons-translate:before {
  content: \"\\E449\";
}

.glyphicons-fax:before {
  content: \"\\E450\";
}

.glyphicons-factory:before {
  content: \"\\E451\";
}

.glyphicons-shop-window:before {
  content: \"\\E452\";
}

.glyphicons-shop:before {
  content: \"\\E453\";
}

.glyphicons-kiosk:before {
  content: \"\\E454\";
}

.glyphicons-kiosk-wheels:before {
  content: \"\\E455\";
}

.glyphicons-kiosk-light:before {
  content: \"\\E456\";
}

.glyphicons-kiosk-food:before {
  content: \"\\E457\";
}

.glyphicons-transfer:before {
  content: \"\\E458\";
}

.glyphicons-money:before {
  content: \"\\E459\";
}

.glyphicons-header:before {
  content: \"\\E460\";
}

.glyphicons-blacksmith:before {
  content: \"\\E461\";
}

.glyphicons-saw-blade:before {
  content: \"\\E462\";
}

.glyphicons-basketball:before {
  content: \"\\E463\";
}

.glyphicons-server:before {
  content: \"\\E464\";
}

.glyphicons-server-plus:before {
  content: \"\\E465\";
}

.glyphicons-server-minus:before {
  content: \"\\E466\";
}

.glyphicons-server-ban:before {
  content: \"\\E467\";
}

.glyphicons-server-flag:before {
  content: \"\\E468\";
}

.glyphicons-server-lock:before {
  content: \"\\E469\";
}

.glyphicons-server-new:before {
  content: \"\\E470\";
}

.glyphicons-charging-station:before {
  content: \"\\F471\";
}

.glyphicons-gas-station:before {
  content: \"\\E472\";
}

.glyphicons-target:before {
  content: \"\\E473\";
}

.glyphicons-bed-alt:before {
  content: \"\\E474\";
}

.glyphicons-mosquito-net:before {
  content: \"\\E475\";
}

.glyphicons-dining-set:before {
  content: \"\\E476\";
}

.glyphicons-plate-of-food:before {
  content: \"\\E477\";
}

.glyphicons-hygiene-kit:before {
  content: \"\\E478\";
}

.glyphicons-blackboard:before {
  content: \"\\E479\";
}

.glyphicons-marriage:before {
  content: \"\\E480\";
}

.glyphicons-bucket:before {
  content: \"\\E481\";
}

.glyphicons-none-color-swatch:before {
  content: \"\\E482\";
}

.glyphicons-bring-forward:before {
  content: \"\\E483\";
}

.glyphicons-bring-to-front:before {
  content: \"\\E484\";
}

.glyphicons-send-backward:before {
  content: \"\\E485\";
}

.glyphicons-send-to-back:before {
  content: \"\\E486\";
}

.glyphicons-fit-frame-to-image:before {
  content: \"\\E487\";
}

.glyphicons-fit-image-to-frame:before {
  content: \"\\E488\";
}

.glyphicons-multiple-displays:before {
  content: \"\\E489\";
}

.glyphicons-handshake:before {
  content: \"\\E490\";
}

.glyphicons-child:before {
  content: \"\\E491\";
}

.glyphicons-baby-formula:before {
  content: \"\\E492\";
}

.glyphicons-medicine:before {
  content: \"\\E493\";
}

.glyphicons-atv-vehicle:before {
  content: \"\\E494\";
}

.glyphicons-motorcycle:before {
  content: \"\\E495\";
}

.glyphicons-bed:before {
  content: \"\\E496\";
}

.glyphicons-tent:before {
  content: \"\\26FA\";
}

.glyphicons-glasses:before {
  content: \"\\E498\";
}

.glyphicons-sunglasses:before {
  content: \"\\E499\";
}

.glyphicons-family:before {
  content: \"\\E500\";
}

.glyphicons-education:before {
  content: \"\\E501\";
}

.glyphicons-shoes:before {
  content: \"\\E502\";
}

.glyphicons-map:before {
  content: \"\\E503\";
}

.glyphicons-cd:before {
  content: \"\\E504\";
}

.glyphicons-alert:before {
  content: \"\\E505\";
}

.glyphicons-piggy-bank:before {
  content: \"\\E506\";
}

.glyphicons-star-half:before {
  content: \"\\E507\";
}

.glyphicons-cluster:before {
  content: \"\\E508\";
}

.glyphicons-flowchart:before {
  content: \"\\E509\";
}

.glyphicons-commodities:before {
  content: \"\\E510\";
}

.glyphicons-duplicate:before {
  content: \"\\E511\";
}

.glyphicons-copy:before {
  content: \"\\E512\";
}

.glyphicons-paste:before {
  content: \"\\E513\";
}

.glyphicons-bath-bathtub:before {
  content: \"\\E514\";
}

.glyphicons-bath-shower:before {
  content: \"\\E515\";
}

.glyphicons-shower:before {
  content: \"\\1F6BF\";
}

.glyphicons-menu-hamburger:before {
  content: \"\\E517\";
}

.glyphicons-option-vertical:before {
  content: \"\\E518\";
}

.glyphicons-option-horizontal:before {
  content: \"\\E519\";
}

.glyphicons-currency-conversion:before {
  content: \"\\E520\";
}

.glyphicons-user-ban:before {
  content: \"\\E521\";
}

.glyphicons-user-lock:before {
  content: \"\\E522\";
}

.glyphicons-user-flag:before {
  content: \"\\E523\";
}

.glyphicons-user-asterisk:before {
  content: \"\\E524\";
}

.glyphicons-user-alert:before {
  content: \"\\E525\";
}

.glyphicons-user-key:before {
  content: \"\\E526\";
}

.glyphicons-user-conversation:before {
  content: \"\\E527\";
}

.glyphicons-database:before {
  content: \"\\E528\";
}

.glyphicons-database-search:before {
  content: \"\\E529\";
}

.glyphicons-list-alt:before {
  content: \"\\E530\";
}

.glyphicons-hazard-sign:before {
  content: \"\\E531\";
}

.glyphicons-hazard:before {
  content: \"\\E532\";
}

.glyphicons-stop-sign:before {
  content: \"\\E533\";
}

.glyphicons-lab:before {
  content: \"\\E534\";
}

.glyphicons-lab-alt:before {
  content: \"\\E535\";
}

.glyphicons-ice-cream:before {
  content: \"\\E536\";
}

.glyphicons-ice-lolly:before {
  content: \"\\E537\";
}

.glyphicons-ice-lolly-tasted:before {
  content: \"\\E538\";
}

.glyphicons-invoice:before {
  content: \"\\E539\";
}

.glyphicons-cart-tick:before {
  content: \"\\E540\";
}

.glyphicons-hourglass:before {
  content: \"\\231B\";
}

.glyphicons-cat:before {
  content: \"\\1F408\";
}

.glyphicons-lamp:before {
  content: \"\\E543\";
}

.glyphicons-scale-classic:before {
  content: \"\\E544\";
}

.glyphicons-eye-plus:before {
  content: \"\\E545\";
}

.glyphicons-eye-minus:before {
  content: \"\\E546\";
}

.glyphicons-quote:before {
  content: \"\\E547\";
}

.glyphicons-bitcoin:before {
  content: \"\\E548\";
}

.glyphicons-yen:before {
  content: \"\\A5\";
}

.glyphicons-ruble:before {
  content: \"\\20BD\";
}

.glyphicons-erase:before {
  content: \"\\E551\";
}

.glyphicons-podcast:before {
  content: \"\\E552\";
}

.glyphicons-firework:before {
  content: \"\\E553\";
}

.glyphicons-scale:before {
  content: \"\\E554\";
}

.glyphicons-king:before {
  content: \"\\E555\";
}

.glyphicons-queen:before {
  content: \"\\E556\";
}

.glyphicons-pawn:before {
  content: \"\\E557\";
}

.glyphicons-bishop:before {
  content: \"\\E558\";
}

.glyphicons-knight:before {
  content: \"\\E559\";
}

.glyphicons-mic-mute:before {
  content: \"\\E560\";
}

.glyphicons-voicemail:before {
  content: \"\\E561\";
}

.glyphicons-paragraph:before {
  content: \"\\B6\";
}

.glyphicons-person-walking:before {
  content: \"\\E563\";
}

.glyphicons-person-wheelchair:before {
  content: \"\\E564\";
}

.glyphicons-underground:before {
  content: \"\\E565\";
}

.glyphicons-car-hov:before {
  content: \"\\E566\";
}

.glyphicons-car-rental:before {
  content: \"\\E567\";
}

.glyphicons-transport:before {
  content: \"\\E568\";
}

.glyphicons-taxi:before {
  content: \"\\1F695\";
}

.glyphicons-ice-cream-no:before {
  content: \"\\E570\";
}

.glyphicons-uk-rat-u:before {
  content: \"\\E571\";
}

.glyphicons-uk-rat-pg:before {
  content: \"\\E572\";
}

.glyphicons-uk-rat-12a:before {
  content: \"\\E573\";
}

.glyphicons-uk-rat-12:before {
  content: \"\\E574\";
}

.glyphicons-uk-rat-15:before {
  content: \"\\E575\";
}

.glyphicons-uk-rat-18:before {
  content: \"\\E576\";
}

.glyphicons-uk-rat-r18:before {
  content: \"\\E577\";
}

.glyphicons-tv:before {
  content: \"\\E578\";
}

.glyphicons-sms:before {
  content: \"\\E579\";
}

.glyphicons-mms:before {
  content: \"\\E580\";
}

.glyphicons-us-rat-g:before {
  content: \"\\E581\";
}

.glyphicons-us-rat-pg:before {
  content: \"\\E582\";
}

.glyphicons-us-rat-pg-13:before {
  content: \"\\E583\";
}

.glyphicons-us-rat-restricted:before {
  content: \"\\E584\";
}

.glyphicons-us-rat-no-one-17:before {
  content: \"\\E585\";
}

.glyphicons-equalizer:before {
  content: \"\\E586\";
}

.glyphicons-speakers:before {
  content: \"\\E587\";
}

.glyphicons-remote-control:before {
  content: \"\\E588\";
}

.glyphicons-remote-control-tv:before {
  content: \"\\E589\";
}

.glyphicons-shredder:before {
  content: \"\\E590\";
}

.glyphicons-folder-heart:before {
  content: \"\\E591\";
}

.glyphicons-person-running:before {
  content: \"\\E592\";
}

.glyphicons-person:before {
  content: \"\\E593\";
}

.glyphicons-voice:before {
  content: \"\\E594\";
}

.glyphicons-stethoscope:before {
  content: \"\\E595\";
}

.glyphicons-hotspot:before {
  content: \"\\E596\";
}

.glyphicons-activity:before {
  content: \"\\E597\";
}

.glyphicons-watch:before {
  content: \"\\231A\";
}

.glyphicons-scissors-alt:before {
  content: \"\\E599\";
}

.glyphicons-car-wheel:before {
  content: \"\\E600\";
}

.glyphicons-chevron-up:before {
  content: \"\\E601\";
}

.glyphicons-chevron-down:before {
  content: \"\\E602\";
}

.glyphicons-superscript:before {
  content: \"\\E603\";
}

.glyphicons-subscript:before {
  content: \"\\E604\";
}

.glyphicons-text-size:before {
  content: \"\\E605\";
}

.glyphicons-text-color:before {
  content: \"\\E606\";
}

.glyphicons-text-background:before {
  content: \"\\E607\";
}

.glyphicons-modal-window:before {
  content: \"\\E608\";
}

.glyphicons-newspaper:before {
  content: \"\\1F4F0\";
}

.glyphicons-tractor:before {
  content: \"\\1F69C\";
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
  }
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

@-webkit-keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}
@keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(-200deg);
            transform: rotate(-200deg);
    opacity: 0;
  }
  100% {
    -webkit-transform-origin: center center;
            transform-origin: center center;
    -webkit-transform: rotate(0);
            transform: rotate(0);
    opacity: 1;
  }
}
.rotateIn {
  -webkit-animation-name: rotateIn;
  animation-name: rotateIn;
}

@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
            transform: translateY(-15px);
  }
}
.bounce {
  -webkit-animation-name: bounce;
  animation-name: bounce;
}

@-webkit-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
  }
  20% {
    -webkit-transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  40% {
    -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
  }
  60% {
    -webkit-transform: rotate(5deg);
            transform: rotate(5deg);
  }
  80% {
    -webkit-transform: rotate(-5deg);
            transform: rotate(-5deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}

@-webkit-keyframes tada {
  0% {
    -webkit-transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
  }
}
@keyframes tada {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
  }
  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
  }
  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
  }
  100% {
    -webkit-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
  }
}
.tada {
  -webkit-animation-name: tada;
  animation-name: tada;
}

/* latin */
@font-face {
  font-family: \"Montserrat\";
  font-style: normal;
  font-weight: 400;
  src: local(\"Montserrat-Regular\"), url('{{ asset_path(\"theme::fonts/montserrat/montserrat-regular.woff2\") }}') format(\"woff2\"), url('{{ asset_path(\"theme::fonts/montserrat/montserrat-regular.woff\") }}') format(\"woff\");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: \"Montserrat\";
  font-style: normal;
  font-weight: 700;
  src: local(\"Montserrat-Bold\"), url('{{ asset_path(\"theme::fonts/montserrat/montserrat-bold.woff2\") }}') format(\"woff2\"), url('{{ asset_path(\"theme::fonts/montserrat/montserrat-bold.woff\") }}') format(\"woff\");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/*!
 *  Font Awesome 4.7.0 by @davegandy - http://fontawesome.io - @fontawesome
 *  License - http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
 */
/* FONT PATH
 * -------------------------- */
@font-face {
  font-family: \"FontAwesome\";
  src: url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.eot\") }}');
  src: url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.eot\") }}?#iefix') format(\"embedded-opentype\"), url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.woff2\") }}') format(\"woff2\"), url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.woff\") }}') format(\"woff\"), url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.ttf\") }}') format(\"truetype\"), url('{{ asset_path(\"theme::fonts/font-awesome/fontawesome-webfont.svg\") }}#fontawesome') format(\"svg\");
  font-weight: normal;
  font-style: normal;
}
.fa {
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* makes the font 33% larger relative to the icon container */
.fa-lg {
  font-size: 1.33333333em;
  line-height: 0.75em;
  vertical-align: -15%;
}

.fa-2x {
  font-size: 2em;
}

.fa-3x {
  font-size: 3em;
}

.fa-4x {
  font-size: 4em;
}

.fa-5x {
  font-size: 5em;
}

.fa-fw {
  width: 1.28571429em;
  text-align: center;
}

.fa-ul {
  padding-left: 0;
  margin-left: 2.14285714em;
  list-style-type: none;
}

.fa-ul > li {
  position: relative;
}

.fa-li {
  position: absolute;
  left: -2.14285714em;
  width: 2.14285714em;
  top: 0.14285714em;
  text-align: center;
}

.fa-li.fa-lg {
  left: -1.85714286em;
}

.fa-border {
  padding: 0.2em 0.25em 0.15em;
  border: solid 0.08em #eeeeee;
  border-radius: 0.1em;
}

.fa-pull-left {
  float: left;
}

.fa-pull-right {
  float: right;
}

.fa.fa-pull-left {
  margin-right: 0.3em;
}

.fa.fa-pull-right {
  margin-left: 0.3em;
}

/* Deprecated as of 4.4.0 */
.pull-right {
  float: right;
}

.pull-left {
  float: left;
}

.fa.pull-left {
  margin-right: 0.3em;
}

.fa.pull-right {
  margin-left: 0.3em;
}

.fa-spin {
  -webkit-animation: fa-spin 2s infinite linear;
  animation: fa-spin 2s infinite linear;
}

.fa-pulse {
  -webkit-animation: fa-spin 1s infinite steps(8);
  animation: fa-spin 1s infinite steps(8);
}

@-webkit-keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
.fa-rotate-90 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=1)\";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.fa-rotate-180 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=2)\";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.fa-rotate-270 {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=3)\";
  -webkit-transform: rotate(270deg);
  transform: rotate(270deg);
}

.fa-flip-horizontal {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)\";
  -webkit-transform: scale(-1, 1);
  transform: scale(-1, 1);
}

.fa-flip-vertical {
  -ms-filter: \"progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)\";
  -webkit-transform: scale(1, -1);
  transform: scale(1, -1);
}

:root .fa-rotate-90,
:root .fa-rotate-180,
:root .fa-rotate-270,
:root .fa-flip-horizontal,
:root .fa-flip-vertical {
  -webkit-filter: none;
          filter: none;
}

.fa-stack {
  position: relative;
  display: inline-block;
  width: 2em;
  height: 2em;
  line-height: 2em;
  vertical-align: middle;
}

.fa-stack-1x,
.fa-stack-2x {
  position: absolute;
  left: 0;
  width: 100%;
  text-align: center;
}

.fa-stack-1x {
  line-height: inherit;
}

.fa-stack-2x {
  font-size: 2em;
}

.fa-inverse {
  color: #ffffff;
}

/* Font Awesome uses the Unicode Private Use Area (PUA) to ensure screen
   readers do not read off random characters that represent icons */
.fa-glass:before {
  content: \"\\F000\";
}

.fa-music:before {
  content: \"\\F001\";
}

.fa-search:before {
  content: \"\\F002\";
}

.fa-envelope-o:before {
  content: \"\\F003\";
}

.fa-heart:before {
  content: \"\\F004\";
}

.fa-star:before {
  content: \"\\F005\";
}

.fa-star-o:before {
  content: \"\\F006\";
}

.fa-user:before {
  content: \"\\F007\";
}

.fa-film:before {
  content: \"\\F008\";
}

.fa-th-large:before {
  content: \"\\F009\";
}

.fa-th:before {
  content: \"\\F00A\";
}

.fa-th-list:before {
  content: \"\\F00B\";
}

.fa-check:before {
  content: \"\\F00C\";
}

.fa-remove:before,
.fa-close:before,
.fa-times:before {
  content: \"\\F00D\";
}

.fa-search-plus:before {
  content: \"\\F00E\";
}

.fa-search-minus:before {
  content: \"\\F010\";
}

.fa-power-off:before {
  content: \"\\F011\";
}

.fa-signal:before {
  content: \"\\F012\";
}

.fa-gear:before,
.fa-cog:before {
  content: \"\\F013\";
}

.fa-trash-o:before {
  content: \"\\F014\";
}

.fa-home:before {
  content: \"\\F015\";
}

.fa-file-o:before {
  content: \"\\F016\";
}

.fa-clock-o:before {
  content: \"\\F017\";
}

.fa-road:before {
  content: \"\\F018\";
}

.fa-download:before {
  content: \"\\F019\";
}

.fa-arrow-circle-o-down:before {
  content: \"\\F01A\";
}

.fa-arrow-circle-o-up:before {
  content: \"\\F01B\";
}

.fa-inbox:before {
  content: \"\\F01C\";
}

.fa-play-circle-o:before {
  content: \"\\F01D\";
}

.fa-rotate-right:before,
.fa-repeat:before {
  content: \"\\F01E\";
}

.fa-refresh:before {
  content: \"\\F021\";
}

.fa-list-alt:before {
  content: \"\\F022\";
}

.fa-lock:before {
  content: \"\\F023\";
}

.fa-flag:before {
  content: \"\\F024\";
}

.fa-headphones:before {
  content: \"\\F025\";
}

.fa-volume-off:before {
  content: \"\\F026\";
}

.fa-volume-down:before {
  content: \"\\F027\";
}

.fa-volume-up:before {
  content: \"\\F028\";
}

.fa-qrcode:before {
  content: \"\\F029\";
}

.fa-barcode:before {
  content: \"\\F02A\";
}

.fa-tag:before {
  content: \"\\F02B\";
}

.fa-tags:before {
  content: \"\\F02C\";
}

.fa-book:before {
  content: \"\\F02D\";
}

.fa-bookmark:before {
  content: \"\\F02E\";
}

.fa-print:before {
  content: \"\\F02F\";
}

.fa-camera:before {
  content: \"\\F030\";
}

.fa-font:before {
  content: \"\\F031\";
}

.fa-bold:before {
  content: \"\\F032\";
}

.fa-italic:before {
  content: \"\\F033\";
}

.fa-text-height:before {
  content: \"\\F034\";
}

.fa-text-width:before {
  content: \"\\F035\";
}

.fa-align-left:before {
  content: \"\\F036\";
}

.fa-align-center:before {
  content: \"\\F037\";
}

.fa-align-right:before {
  content: \"\\F038\";
}

.fa-align-justify:before {
  content: \"\\F039\";
}

.fa-list:before {
  content: \"\\F03A\";
}

.fa-dedent:before,
.fa-outdent:before {
  content: \"\\F03B\";
}

.fa-indent:before {
  content: \"\\F03C\";
}

.fa-video-camera:before {
  content: \"\\F03D\";
}

.fa-photo:before,
.fa-image:before,
.fa-picture-o:before {
  content: \"\\F03E\";
}

.fa-pencil:before {
  content: \"\\F040\";
}

.fa-map-marker:before {
  content: \"\\F041\";
}

.fa-adjust:before {
  content: \"\\F042\";
}

.fa-tint:before {
  content: \"\\F043\";
}

.fa-edit:before,
.fa-pencil-square-o:before {
  content: \"\\F044\";
}

.fa-share-square-o:before {
  content: \"\\F045\";
}

.fa-check-square-o:before {
  content: \"\\F046\";
}

.fa-arrows:before {
  content: \"\\F047\";
}

.fa-step-backward:before {
  content: \"\\F048\";
}

.fa-fast-backward:before {
  content: \"\\F049\";
}

.fa-backward:before {
  content: \"\\F04A\";
}

.fa-play:before {
  content: \"\\F04B\";
}

.fa-pause:before {
  content: \"\\F04C\";
}

.fa-stop:before {
  content: \"\\F04D\";
}

.fa-forward:before {
  content: \"\\F04E\";
}

.fa-fast-forward:before {
  content: \"\\F050\";
}

.fa-step-forward:before {
  content: \"\\F051\";
}

.fa-eject:before {
  content: \"\\F052\";
}

.fa-chevron-left:before {
  content: \"\\F053\";
}

.fa-chevron-right:before {
  content: \"\\F054\";
}

.fa-plus-circle:before {
  content: \"\\F055\";
}

.fa-minus-circle:before {
  content: \"\\F056\";
}

.fa-times-circle:before {
  content: \"\\F057\";
}

.fa-check-circle:before {
  content: \"\\F058\";
}

.fa-question-circle:before {
  content: \"\\F059\";
}

.fa-info-circle:before {
  content: \"\\F05A\";
}

.fa-crosshairs:before {
  content: \"\\F05B\";
}

.fa-times-circle-o:before {
  content: \"\\F05C\";
}

.fa-check-circle-o:before {
  content: \"\\F05D\";
}

.fa-ban:before {
  content: \"\\F05E\";
}

.fa-arrow-left:before {
  content: \"\\F060\";
}

.fa-arrow-right:before {
  content: \"\\F061\";
}

.fa-arrow-up:before {
  content: \"\\F062\";
}

.fa-arrow-down:before {
  content: \"\\F063\";
}

.fa-mail-forward:before,
.fa-share:before {
  content: \"\\F064\";
}

.fa-expand:before {
  content: \"\\F065\";
}

.fa-compress:before {
  content: \"\\F066\";
}

.fa-plus:before {
  content: \"\\F067\";
}

.fa-minus:before {
  content: \"\\F068\";
}

.fa-asterisk:before {
  content: \"\\F069\";
}

.fa-exclamation-circle:before {
  content: \"\\F06A\";
}

.fa-gift:before {
  content: \"\\F06B\";
}

.fa-leaf:before {
  content: \"\\F06C\";
}

.fa-fire:before {
  content: \"\\F06D\";
}

.fa-eye:before {
  content: \"\\F06E\";
}

.fa-eye-slash:before {
  content: \"\\F070\";
}

.fa-warning:before,
.fa-exclamation-triangle:before {
  content: \"\\F071\";
}

.fa-plane:before {
  content: \"\\F072\";
}

.fa-calendar:before {
  content: \"\\F073\";
}

.fa-random:before {
  content: \"\\F074\";
}

.fa-comment:before {
  content: \"\\F075\";
}

.fa-magnet:before {
  content: \"\\F076\";
}

.fa-chevron-up:before {
  content: \"\\F077\";
}

.fa-chevron-down:before {
  content: \"\\F078\";
}

.fa-retweet:before {
  content: \"\\F079\";
}

.fa-shopping-cart:before {
  content: \"\\F07A\";
}

.fa-folder:before {
  content: \"\\F07B\";
}

.fa-folder-open:before {
  content: \"\\F07C\";
}

.fa-arrows-v:before {
  content: \"\\F07D\";
}

.fa-arrows-h:before {
  content: \"\\F07E\";
}

.fa-bar-chart-o:before,
.fa-bar-chart:before {
  content: \"\\F080\";
}

.fa-twitter-square:before {
  content: \"\\F081\";
}

.fa-facebook-square:before {
  content: \"\\F082\";
}

.fa-camera-retro:before {
  content: \"\\F083\";
}

.fa-key:before {
  content: \"\\F084\";
}

.fa-gears:before,
.fa-cogs:before {
  content: \"\\F085\";
}

.fa-comments:before {
  content: \"\\F086\";
}

.fa-thumbs-o-up:before {
  content: \"\\F087\";
}

.fa-thumbs-o-down:before {
  content: \"\\F088\";
}

.fa-star-half:before {
  content: \"\\F089\";
}

.fa-heart-o:before {
  content: \"\\F08A\";
}

.fa-sign-out:before {
  content: \"\\F08B\";
}

.fa-linkedin-square:before {
  content: \"\\F08C\";
}

.fa-thumb-tack:before {
  content: \"\\F08D\";
}

.fa-external-link:before {
  content: \"\\F08E\";
}

.fa-sign-in:before {
  content: \"\\F090\";
}

.fa-trophy:before {
  content: \"\\F091\";
}

.fa-github-square:before {
  content: \"\\F092\";
}

.fa-upload:before {
  content: \"\\F093\";
}

.fa-lemon-o:before {
  content: \"\\F094\";
}

.fa-phone:before {
  content: \"\\F095\";
}

.fa-square-o:before {
  content: \"\\F096\";
}

.fa-bookmark-o:before {
  content: \"\\F097\";
}

.fa-phone-square:before {
  content: \"\\F098\";
}

.fa-twitter:before {
  content: \"\\F099\";
}

.fa-facebook-f:before,
.fa-facebook:before {
  content: \"\\F09A\";
}

.fa-github:before {
  content: \"\\F09B\";
}

.fa-unlock:before {
  content: \"\\F09C\";
}

.fa-credit-card:before {
  content: \"\\F09D\";
}

.fa-feed:before,
.fa-rss:before {
  content: \"\\F09E\";
}

.fa-hdd-o:before {
  content: \"\\F0A0\";
}

.fa-bullhorn:before {
  content: \"\\F0A1\";
}

.fa-bell:before {
  content: \"\\F0F3\";
}

.fa-certificate:before {
  content: \"\\F0A3\";
}

.fa-hand-o-right:before {
  content: \"\\F0A4\";
}

.fa-hand-o-left:before {
  content: \"\\F0A5\";
}

.fa-hand-o-up:before {
  content: \"\\F0A6\";
}

.fa-hand-o-down:before {
  content: \"\\F0A7\";
}

.fa-arrow-circle-left:before {
  content: \"\\F0A8\";
}

.fa-arrow-circle-right:before {
  content: \"\\F0A9\";
}

.fa-arrow-circle-up:before {
  content: \"\\F0AA\";
}

.fa-arrow-circle-down:before {
  content: \"\\F0AB\";
}

.fa-globe:before {
  content: \"\\F0AC\";
}

.fa-wrench:before {
  content: \"\\F0AD\";
}

.fa-tasks:before {
  content: \"\\F0AE\";
}

.fa-filter:before {
  content: \"\\F0B0\";
}

.fa-briefcase:before {
  content: \"\\F0B1\";
}

.fa-arrows-alt:before {
  content: \"\\F0B2\";
}

.fa-group:before,
.fa-users:before {
  content: \"\\F0C0\";
}

.fa-chain:before,
.fa-link:before {
  content: \"\\F0C1\";
}

.fa-cloud:before {
  content: \"\\F0C2\";
}

.fa-flask:before {
  content: \"\\F0C3\";
}

.fa-cut:before,
.fa-scissors:before {
  content: \"\\F0C4\";
}

.fa-copy:before,
.fa-files-o:before {
  content: \"\\F0C5\";
}

.fa-paperclip:before {
  content: \"\\F0C6\";
}

.fa-save:before,
.fa-floppy-o:before {
  content: \"\\F0C7\";
}

.fa-square:before {
  content: \"\\F0C8\";
}

.fa-navicon:before,
.fa-reorder:before,
.fa-bars:before {
  content: \"\\F0C9\";
}

.fa-list-ul:before {
  content: \"\\F0CA\";
}

.fa-list-ol:before {
  content: \"\\F0CB\";
}

.fa-strikethrough:before {
  content: \"\\F0CC\";
}

.fa-underline:before {
  content: \"\\F0CD\";
}

.fa-table:before {
  content: \"\\F0CE\";
}

.fa-magic:before {
  content: \"\\F0D0\";
}

.fa-truck:before {
  content: \"\\F0D1\";
}

.fa-pinterest:before {
  content: \"\\F0D2\";
}

.fa-pinterest-square:before {
  content: \"\\F0D3\";
}

.fa-google-plus-square:before {
  content: \"\\F0D4\";
}

.fa-google-plus:before {
  content: \"\\F0D5\";
}

.fa-money:before {
  content: \"\\F0D6\";
}

.fa-caret-down:before {
  content: \"\\F0D7\";
}

.fa-caret-up:before {
  content: \"\\F0D8\";
}

.fa-caret-left:before {
  content: \"\\F0D9\";
}

.fa-caret-right:before {
  content: \"\\F0DA\";
}

.fa-columns:before {
  content: \"\\F0DB\";
}

.fa-unsorted:before,
.fa-sort:before {
  content: \"\\F0DC\";
}

.fa-sort-down:before,
.fa-sort-desc:before {
  content: \"\\F0DD\";
}

.fa-sort-up:before,
.fa-sort-asc:before {
  content: \"\\F0DE\";
}

.fa-envelope:before {
  content: \"\\F0E0\";
}

.fa-linkedin:before {
  content: \"\\F0E1\";
}

.fa-rotate-left:before,
.fa-undo:before {
  content: \"\\F0E2\";
}

.fa-legal:before,
.fa-gavel:before {
  content: \"\\F0E3\";
}

.fa-dashboard:before,
.fa-tachometer:before {
  content: \"\\F0E4\";
}

.fa-comment-o:before {
  content: \"\\F0E5\";
}

.fa-comments-o:before {
  content: \"\\F0E6\";
}

.fa-flash:before,
.fa-bolt:before {
  content: \"\\F0E7\";
}

.fa-sitemap:before {
  content: \"\\F0E8\";
}

.fa-umbrella:before {
  content: \"\\F0E9\";
}

.fa-paste:before,
.fa-clipboard:before {
  content: \"\\F0EA\";
}

.fa-lightbulb-o:before {
  content: \"\\F0EB\";
}

.fa-exchange:before {
  content: \"\\F0EC\";
}

.fa-cloud-download:before {
  content: \"\\F0ED\";
}

.fa-cloud-upload:before {
  content: \"\\F0EE\";
}

.fa-user-md:before {
  content: \"\\F0F0\";
}

.fa-stethoscope:before {
  content: \"\\F0F1\";
}

.fa-suitcase:before {
  content: \"\\F0F2\";
}

.fa-bell-o:before {
  content: \"\\F0A2\";
}

.fa-coffee:before {
  content: \"\\F0F4\";
}

.fa-cutlery:before {
  content: \"\\F0F5\";
}

.fa-file-text-o:before {
  content: \"\\F0F6\";
}

.fa-building-o:before {
  content: \"\\F0F7\";
}

.fa-hospital-o:before {
  content: \"\\F0F8\";
}

.fa-ambulance:before {
  content: \"\\F0F9\";
}

.fa-medkit:before {
  content: \"\\F0FA\";
}

.fa-fighter-jet:before {
  content: \"\\F0FB\";
}

.fa-beer:before {
  content: \"\\F0FC\";
}

.fa-h-square:before {
  content: \"\\F0FD\";
}

.fa-plus-square:before {
  content: \"\\F0FE\";
}

.fa-angle-double-left:before {
  content: \"\\F100\";
}

.fa-angle-double-right:before {
  content: \"\\F101\";
}

.fa-angle-double-up:before {
  content: \"\\F102\";
}

.fa-angle-double-down:before {
  content: \"\\F103\";
}

.fa-angle-left:before {
  content: \"\\F104\";
}

.fa-angle-right:before {
  content: \"\\F105\";
}

.fa-angle-up:before {
  content: \"\\F106\";
}

.fa-angle-down:before {
  content: \"\\F107\";
}

.fa-desktop:before {
  content: \"\\F108\";
}

.fa-laptop:before {
  content: \"\\F109\";
}

.fa-tablet:before {
  content: \"\\F10A\";
}

.fa-mobile-phone:before,
.fa-mobile:before {
  content: \"\\F10B\";
}

.fa-circle-o:before {
  content: \"\\F10C\";
}

.fa-quote-left:before {
  content: \"\\F10D\";
}

.fa-quote-right:before {
  content: \"\\F10E\";
}

.fa-spinner:before {
  content: \"\\F110\";
}

.fa-circle:before {
  content: \"\\F111\";
}

.fa-mail-reply:before,
.fa-reply:before {
  content: \"\\F112\";
}

.fa-github-alt:before {
  content: \"\\F113\";
}

.fa-folder-o:before {
  content: \"\\F114\";
}

.fa-folder-open-o:before {
  content: \"\\F115\";
}

.fa-smile-o:before {
  content: \"\\F118\";
}

.fa-frown-o:before {
  content: \"\\F119\";
}

.fa-meh-o:before {
  content: \"\\F11A\";
}

.fa-gamepad:before {
  content: \"\\F11B\";
}

.fa-keyboard-o:before {
  content: \"\\F11C\";
}

.fa-flag-o:before {
  content: \"\\F11D\";
}

.fa-flag-checkered:before {
  content: \"\\F11E\";
}

.fa-terminal:before {
  content: \"\\F120\";
}

.fa-code:before {
  content: \"\\F121\";
}

.fa-mail-reply-all:before,
.fa-reply-all:before {
  content: \"\\F122\";
}

.fa-star-half-empty:before,
.fa-star-half-full:before,
.fa-star-half-o:before {
  content: \"\\F123\";
}

.fa-location-arrow:before {
  content: \"\\F124\";
}

.fa-crop:before {
  content: \"\\F125\";
}

.fa-code-fork:before {
  content: \"\\F126\";
}

.fa-unlink:before,
.fa-chain-broken:before {
  content: \"\\F127\";
}

.fa-question:before {
  content: \"\\F128\";
}

.fa-info:before {
  content: \"\\F129\";
}

.fa-exclamation:before {
  content: \"\\F12A\";
}

.fa-superscript:before {
  content: \"\\F12B\";
}

.fa-subscript:before {
  content: \"\\F12C\";
}

.fa-eraser:before {
  content: \"\\F12D\";
}

.fa-puzzle-piece:before {
  content: \"\\F12E\";
}

.fa-microphone:before {
  content: \"\\F130\";
}

.fa-microphone-slash:before {
  content: \"\\F131\";
}

.fa-shield:before {
  content: \"\\F132\";
}

.fa-calendar-o:before {
  content: \"\\F133\";
}

.fa-fire-extinguisher:before {
  content: \"\\F134\";
}

.fa-rocket:before {
  content: \"\\F135\";
}

.fa-maxcdn:before {
  content: \"\\F136\";
}

.fa-chevron-circle-left:before {
  content: \"\\F137\";
}

.fa-chevron-circle-right:before {
  content: \"\\F138\";
}

.fa-chevron-circle-up:before {
  content: \"\\F139\";
}

.fa-chevron-circle-down:before {
  content: \"\\F13A\";
}

.fa-html5:before {
  content: \"\\F13B\";
}

.fa-css3:before {
  content: \"\\F13C\";
}

.fa-anchor:before {
  content: \"\\F13D\";
}

.fa-unlock-alt:before {
  content: \"\\F13E\";
}

.fa-bullseye:before {
  content: \"\\F140\";
}

.fa-ellipsis-h:before {
  content: \"\\F141\";
}

.fa-ellipsis-v:before {
  content: \"\\F142\";
}

.fa-rss-square:before {
  content: \"\\F143\";
}

.fa-play-circle:before {
  content: \"\\F144\";
}

.fa-ticket:before {
  content: \"\\F145\";
}

.fa-minus-square:before {
  content: \"\\F146\";
}

.fa-minus-square-o:before {
  content: \"\\F147\";
}

.fa-level-up:before {
  content: \"\\F148\";
}

.fa-level-down:before {
  content: \"\\F149\";
}

.fa-check-square:before {
  content: \"\\F14A\";
}

.fa-pencil-square:before {
  content: \"\\F14B\";
}

.fa-external-link-square:before {
  content: \"\\F14C\";
}

.fa-share-square:before {
  content: \"\\F14D\";
}

.fa-compass:before {
  content: \"\\F14E\";
}

.fa-toggle-down:before,
.fa-caret-square-o-down:before {
  content: \"\\F150\";
}

.fa-toggle-up:before,
.fa-caret-square-o-up:before {
  content: \"\\F151\";
}

.fa-toggle-right:before,
.fa-caret-square-o-right:before {
  content: \"\\F152\";
}

.fa-euro:before,
.fa-eur:before {
  content: \"\\F153\";
}

.fa-gbp:before {
  content: \"\\F154\";
}

.fa-dollar:before,
.fa-usd:before {
  content: \"\\F155\";
}

.fa-rupee:before,
.fa-inr:before {
  content: \"\\F156\";
}

.fa-cny:before,
.fa-rmb:before,
.fa-yen:before,
.fa-jpy:before {
  content: \"\\F157\";
}

.fa-ruble:before,
.fa-rouble:before,
.fa-rub:before {
  content: \"\\F158\";
}

.fa-won:before,
.fa-krw:before {
  content: \"\\F159\";
}

.fa-bitcoin:before,
.fa-btc:before {
  content: \"\\F15A\";
}

.fa-file:before {
  content: \"\\F15B\";
}

.fa-file-text:before {
  content: \"\\F15C\";
}

.fa-sort-alpha-asc:before {
  content: \"\\F15D\";
}

.fa-sort-alpha-desc:before {
  content: \"\\F15E\";
}

.fa-sort-amount-asc:before {
  content: \"\\F160\";
}

.fa-sort-amount-desc:before {
  content: \"\\F161\";
}

.fa-sort-numeric-asc:before {
  content: \"\\F162\";
}

.fa-sort-numeric-desc:before {
  content: \"\\F163\";
}

.fa-thumbs-up:before {
  content: \"\\F164\";
}

.fa-thumbs-down:before {
  content: \"\\F165\";
}

.fa-youtube-square:before {
  content: \"\\F166\";
}

.fa-youtube:before {
  content: \"\\F167\";
}

.fa-xing:before {
  content: \"\\F168\";
}

.fa-xing-square:before {
  content: \"\\F169\";
}

.fa-youtube-play:before {
  content: \"\\F16A\";
}

.fa-dropbox:before {
  content: \"\\F16B\";
}

.fa-stack-overflow:before {
  content: \"\\F16C\";
}

.fa-instagram:before {
  content: \"\\F16D\";
}

.fa-flickr:before {
  content: \"\\F16E\";
}

.fa-adn:before {
  content: \"\\F170\";
}

.fa-bitbucket:before {
  content: \"\\F171\";
}

.fa-bitbucket-square:before {
  content: \"\\F172\";
}

.fa-tumblr:before {
  content: \"\\F173\";
}

.fa-tumblr-square:before {
  content: \"\\F174\";
}

.fa-long-arrow-down:before {
  content: \"\\F175\";
}

.fa-long-arrow-up:before {
  content: \"\\F176\";
}

.fa-long-arrow-left:before {
  content: \"\\F177\";
}

.fa-long-arrow-right:before {
  content: \"\\F178\";
}

.fa-apple:before {
  content: \"\\F179\";
}

.fa-windows:before {
  content: \"\\F17A\";
}

.fa-android:before {
  content: \"\\F17B\";
}

.fa-linux:before {
  content: \"\\F17C\";
}

.fa-dribbble:before {
  content: \"\\F17D\";
}

.fa-skype:before {
  content: \"\\F17E\";
}

.fa-foursquare:before {
  content: \"\\F180\";
}

.fa-trello:before {
  content: \"\\F181\";
}

.fa-female:before {
  content: \"\\F182\";
}

.fa-male:before {
  content: \"\\F183\";
}

.fa-gittip:before,
.fa-gratipay:before {
  content: \"\\F184\";
}

.fa-sun-o:before {
  content: \"\\F185\";
}

.fa-moon-o:before {
  content: \"\\F186\";
}

.fa-archive:before {
  content: \"\\F187\";
}

.fa-bug:before {
  content: \"\\F188\";
}

.fa-vk:before {
  content: \"\\F189\";
}

.fa-weibo:before {
  content: \"\\F18A\";
}

.fa-renren:before {
  content: \"\\F18B\";
}

.fa-pagelines:before {
  content: \"\\F18C\";
}

.fa-stack-exchange:before {
  content: \"\\F18D\";
}

.fa-arrow-circle-o-right:before {
  content: \"\\F18E\";
}

.fa-arrow-circle-o-left:before {
  content: \"\\F190\";
}

.fa-toggle-left:before,
.fa-caret-square-o-left:before {
  content: \"\\F191\";
}

.fa-dot-circle-o:before {
  content: \"\\F192\";
}

.fa-wheelchair:before {
  content: \"\\F193\";
}

.fa-vimeo-square:before {
  content: \"\\F194\";
}

.fa-turkish-lira:before,
.fa-try:before {
  content: \"\\F195\";
}

.fa-plus-square-o:before {
  content: \"\\F196\";
}

.fa-space-shuttle:before {
  content: \"\\F197\";
}

.fa-slack:before {
  content: \"\\F198\";
}

.fa-envelope-square:before {
  content: \"\\F199\";
}

.fa-wordpress:before {
  content: \"\\F19A\";
}

.fa-openid:before {
  content: \"\\F19B\";
}

.fa-institution:before,
.fa-bank:before,
.fa-university:before {
  content: \"\\F19C\";
}

.fa-mortar-board:before,
.fa-graduation-cap:before {
  content: \"\\F19D\";
}

.fa-yahoo:before {
  content: \"\\F19E\";
}

.fa-google:before {
  content: \"\\F1A0\";
}

.fa-reddit:before {
  content: \"\\F1A1\";
}

.fa-reddit-square:before {
  content: \"\\F1A2\";
}

.fa-stumbleupon-circle:before {
  content: \"\\F1A3\";
}

.fa-stumbleupon:before {
  content: \"\\F1A4\";
}

.fa-delicious:before {
  content: \"\\F1A5\";
}

.fa-digg:before {
  content: \"\\F1A6\";
}

.fa-pied-piper-pp:before {
  content: \"\\F1A7\";
}

.fa-pied-piper-alt:before {
  content: \"\\F1A8\";
}

.fa-drupal:before {
  content: \"\\F1A9\";
}

.fa-joomla:before {
  content: \"\\F1AA\";
}

.fa-language:before {
  content: \"\\F1AB\";
}

.fa-fax:before {
  content: \"\\F1AC\";
}

.fa-building:before {
  content: \"\\F1AD\";
}

.fa-child:before {
  content: \"\\F1AE\";
}

.fa-paw:before {
  content: \"\\F1B0\";
}

.fa-spoon:before {
  content: \"\\F1B1\";
}

.fa-cube:before {
  content: \"\\F1B2\";
}

.fa-cubes:before {
  content: \"\\F1B3\";
}

.fa-behance:before {
  content: \"\\F1B4\";
}

.fa-behance-square:before {
  content: \"\\F1B5\";
}

.fa-steam:before {
  content: \"\\F1B6\";
}

.fa-steam-square:before {
  content: \"\\F1B7\";
}

.fa-recycle:before {
  content: \"\\F1B8\";
}

.fa-automobile:before,
.fa-car:before {
  content: \"\\F1B9\";
}

.fa-cab:before,
.fa-taxi:before {
  content: \"\\F1BA\";
}

.fa-tree:before {
  content: \"\\F1BB\";
}

.fa-spotify:before {
  content: \"\\F1BC\";
}

.fa-deviantart:before {
  content: \"\\F1BD\";
}

.fa-soundcloud:before {
  content: \"\\F1BE\";
}

.fa-database:before {
  content: \"\\F1C0\";
}

.fa-file-pdf-o:before {
  content: \"\\F1C1\";
}

.fa-file-word-o:before {
  content: \"\\F1C2\";
}

.fa-file-excel-o:before {
  content: \"\\F1C3\";
}

.fa-file-powerpoint-o:before {
  content: \"\\F1C4\";
}

.fa-file-photo-o:before,
.fa-file-picture-o:before,
.fa-file-image-o:before {
  content: \"\\F1C5\";
}

.fa-file-zip-o:before,
.fa-file-archive-o:before {
  content: \"\\F1C6\";
}

.fa-file-sound-o:before,
.fa-file-audio-o:before {
  content: \"\\F1C7\";
}

.fa-file-movie-o:before,
.fa-file-video-o:before {
  content: \"\\F1C8\";
}

.fa-file-code-o:before {
  content: \"\\F1C9\";
}

.fa-vine:before {
  content: \"\\F1CA\";
}

.fa-codepen:before {
  content: \"\\F1CB\";
}

.fa-jsfiddle:before {
  content: \"\\F1CC\";
}

.fa-life-bouy:before,
.fa-life-buoy:before,
.fa-life-saver:before,
.fa-support:before,
.fa-life-ring:before {
  content: \"\\F1CD\";
}

.fa-circle-o-notch:before {
  content: \"\\F1CE\";
}

.fa-ra:before,
.fa-resistance:before,
.fa-rebel:before {
  content: \"\\F1D0\";
}

.fa-ge:before,
.fa-empire:before {
  content: \"\\F1D1\";
}

.fa-git-square:before {
  content: \"\\F1D2\";
}

.fa-git:before {
  content: \"\\F1D3\";
}

.fa-y-combinator-square:before,
.fa-yc-square:before,
.fa-hacker-news:before {
  content: \"\\F1D4\";
}

.fa-tencent-weibo:before {
  content: \"\\F1D5\";
}

.fa-qq:before {
  content: \"\\F1D6\";
}

.fa-wechat:before,
.fa-weixin:before {
  content: \"\\F1D7\";
}

.fa-send:before,
.fa-paper-plane:before {
  content: \"\\F1D8\";
}

.fa-send-o:before,
.fa-paper-plane-o:before {
  content: \"\\F1D9\";
}

.fa-history:before {
  content: \"\\F1DA\";
}

.fa-circle-thin:before {
  content: \"\\F1DB\";
}

.fa-header:before {
  content: \"\\F1DC\";
}

.fa-paragraph:before {
  content: \"\\F1DD\";
}

.fa-sliders:before {
  content: \"\\F1DE\";
}

.fa-share-alt:before {
  content: \"\\F1E0\";
}

.fa-share-alt-square:before {
  content: \"\\F1E1\";
}

.fa-bomb:before {
  content: \"\\F1E2\";
}

.fa-soccer-ball-o:before,
.fa-futbol-o:before {
  content: \"\\F1E3\";
}

.fa-tty:before {
  content: \"\\F1E4\";
}

.fa-binoculars:before {
  content: \"\\F1E5\";
}

.fa-plug:before {
  content: \"\\F1E6\";
}

.fa-slideshare:before {
  content: \"\\F1E7\";
}

.fa-twitch:before {
  content: \"\\F1E8\";
}

.fa-yelp:before {
  content: \"\\F1E9\";
}

.fa-newspaper-o:before {
  content: \"\\F1EA\";
}

.fa-wifi:before {
  content: \"\\F1EB\";
}

.fa-calculator:before {
  content: \"\\F1EC\";
}

.fa-paypal:before {
  content: \"\\F1ED\";
}

.fa-google-wallet:before {
  content: \"\\F1EE\";
}

.fa-cc-visa:before {
  content: \"\\F1F0\";
}

.fa-cc-mastercard:before {
  content: \"\\F1F1\";
}

.fa-cc-discover:before {
  content: \"\\F1F2\";
}

.fa-cc-amex:before {
  content: \"\\F1F3\";
}

.fa-cc-paypal:before {
  content: \"\\F1F4\";
}

.fa-cc-stripe:before {
  content: \"\\F1F5\";
}

.fa-bell-slash:before {
  content: \"\\F1F6\";
}

.fa-bell-slash-o:before {
  content: \"\\F1F7\";
}

.fa-trash:before {
  content: \"\\F1F8\";
}

.fa-copyright:before {
  content: \"\\F1F9\";
}

.fa-at:before {
  content: \"\\F1FA\";
}

.fa-eyedropper:before {
  content: \"\\F1FB\";
}

.fa-paint-brush:before {
  content: \"\\F1FC\";
}

.fa-birthday-cake:before {
  content: \"\\F1FD\";
}

.fa-area-chart:before {
  content: \"\\F1FE\";
}

.fa-pie-chart:before {
  content: \"\\F200\";
}

.fa-line-chart:before {
  content: \"\\F201\";
}

.fa-lastfm:before {
  content: \"\\F202\";
}

.fa-lastfm-square:before {
  content: \"\\F203\";
}

.fa-toggle-off:before {
  content: \"\\F204\";
}

.fa-toggle-on:before {
  content: \"\\F205\";
}

.fa-bicycle:before {
  content: \"\\F206\";
}

.fa-bus:before {
  content: \"\\F207\";
}

.fa-ioxhost:before {
  content: \"\\F208\";
}

.fa-angellist:before {
  content: \"\\F209\";
}

.fa-cc:before {
  content: \"\\F20A\";
}

.fa-shekel:before,
.fa-sheqel:before,
.fa-ils:before {
  content: \"\\F20B\";
}

.fa-meanpath:before {
  content: \"\\F20C\";
}

.fa-buysellads:before {
  content: \"\\F20D\";
}

.fa-connectdevelop:before {
  content: \"\\F20E\";
}

.fa-dashcube:before {
  content: \"\\F210\";
}

.fa-forumbee:before {
  content: \"\\F211\";
}

.fa-leanpub:before {
  content: \"\\F212\";
}

.fa-sellsy:before {
  content: \"\\F213\";
}

.fa-shirtsinbulk:before {
  content: \"\\F214\";
}

.fa-simplybuilt:before {
  content: \"\\F215\";
}

.fa-skyatlas:before {
  content: \"\\F216\";
}

.fa-cart-plus:before {
  content: \"\\F217\";
}

.fa-cart-arrow-down:before {
  content: \"\\F218\";
}

.fa-diamond:before {
  content: \"\\F219\";
}

.fa-ship:before {
  content: \"\\F21A\";
}

.fa-user-secret:before {
  content: \"\\F21B\";
}

.fa-motorcycle:before {
  content: \"\\F21C\";
}

.fa-street-view:before {
  content: \"\\F21D\";
}

.fa-heartbeat:before {
  content: \"\\F21E\";
}

.fa-venus:before {
  content: \"\\F221\";
}

.fa-mars:before {
  content: \"\\F222\";
}

.fa-mercury:before {
  content: \"\\F223\";
}

.fa-intersex:before,
.fa-transgender:before {
  content: \"\\F224\";
}

.fa-transgender-alt:before {
  content: \"\\F225\";
}

.fa-venus-double:before {
  content: \"\\F226\";
}

.fa-mars-double:before {
  content: \"\\F227\";
}

.fa-venus-mars:before {
  content: \"\\F228\";
}

.fa-mars-stroke:before {
  content: \"\\F229\";
}

.fa-mars-stroke-v:before {
  content: \"\\F22A\";
}

.fa-mars-stroke-h:before {
  content: \"\\F22B\";
}

.fa-neuter:before {
  content: \"\\F22C\";
}

.fa-genderless:before {
  content: \"\\F22D\";
}

.fa-facebook-official:before {
  content: \"\\F230\";
}

.fa-pinterest-p:before {
  content: \"\\F231\";
}

.fa-whatsapp:before {
  content: \"\\F232\";
}

.fa-server:before {
  content: \"\\F233\";
}

.fa-user-plus:before {
  content: \"\\F234\";
}

.fa-user-times:before {
  content: \"\\F235\";
}

.fa-hotel:before,
.fa-bed:before {
  content: \"\\F236\";
}

.fa-viacoin:before {
  content: \"\\F237\";
}

.fa-train:before {
  content: \"\\F238\";
}

.fa-subway:before {
  content: \"\\F239\";
}

.fa-medium:before {
  content: \"\\F23A\";
}

.fa-yc:before,
.fa-y-combinator:before {
  content: \"\\F23B\";
}

.fa-optin-monster:before {
  content: \"\\F23C\";
}

.fa-opencart:before {
  content: \"\\F23D\";
}

.fa-expeditedssl:before {
  content: \"\\F23E\";
}

.fa-battery-4:before,
.fa-battery:before,
.fa-battery-full:before {
  content: \"\\F240\";
}

.fa-battery-3:before,
.fa-battery-three-quarters:before {
  content: \"\\F241\";
}

.fa-battery-2:before,
.fa-battery-half:before {
  content: \"\\F242\";
}

.fa-battery-1:before,
.fa-battery-quarter:before {
  content: \"\\F243\";
}

.fa-battery-0:before,
.fa-battery-empty:before {
  content: \"\\F244\";
}

.fa-mouse-pointer:before {
  content: \"\\F245\";
}

.fa-i-cursor:before {
  content: \"\\F246\";
}

.fa-object-group:before {
  content: \"\\F247\";
}

.fa-object-ungroup:before {
  content: \"\\F248\";
}

.fa-sticky-note:before {
  content: \"\\F249\";
}

.fa-sticky-note-o:before {
  content: \"\\F24A\";
}

.fa-cc-jcb:before {
  content: \"\\F24B\";
}

.fa-cc-diners-club:before {
  content: \"\\F24C\";
}

.fa-clone:before {
  content: \"\\F24D\";
}

.fa-balance-scale:before {
  content: \"\\F24E\";
}

.fa-hourglass-o:before {
  content: \"\\F250\";
}

.fa-hourglass-1:before,
.fa-hourglass-start:before {
  content: \"\\F251\";
}

.fa-hourglass-2:before,
.fa-hourglass-half:before {
  content: \"\\F252\";
}

.fa-hourglass-3:before,
.fa-hourglass-end:before {
  content: \"\\F253\";
}

.fa-hourglass:before {
  content: \"\\F254\";
}

.fa-hand-grab-o:before,
.fa-hand-rock-o:before {
  content: \"\\F255\";
}

.fa-hand-stop-o:before,
.fa-hand-paper-o:before {
  content: \"\\F256\";
}

.fa-hand-scissors-o:before {
  content: \"\\F257\";
}

.fa-hand-lizard-o:before {
  content: \"\\F258\";
}

.fa-hand-spock-o:before {
  content: \"\\F259\";
}

.fa-hand-pointer-o:before {
  content: \"\\F25A\";
}

.fa-hand-peace-o:before {
  content: \"\\F25B\";
}

.fa-trademark:before {
  content: \"\\F25C\";
}

.fa-registered:before {
  content: \"\\F25D\";
}

.fa-creative-commons:before {
  content: \"\\F25E\";
}

.fa-gg:before {
  content: \"\\F260\";
}

.fa-gg-circle:before {
  content: \"\\F261\";
}

.fa-tripadvisor:before {
  content: \"\\F262\";
}

.fa-odnoklassniki:before {
  content: \"\\F263\";
}

.fa-odnoklassniki-square:before {
  content: \"\\F264\";
}

.fa-get-pocket:before {
  content: \"\\F265\";
}

.fa-wikipedia-w:before {
  content: \"\\F266\";
}

.fa-safari:before {
  content: \"\\F267\";
}

.fa-chrome:before {
  content: \"\\F268\";
}

.fa-firefox:before {
  content: \"\\F269\";
}

.fa-opera:before {
  content: \"\\F26A\";
}

.fa-internet-explorer:before {
  content: \"\\F26B\";
}

.fa-tv:before,
.fa-television:before {
  content: \"\\F26C\";
}

.fa-contao:before {
  content: \"\\F26D\";
}

.fa-500px:before {
  content: \"\\F26E\";
}

.fa-amazon:before {
  content: \"\\F270\";
}

.fa-calendar-plus-o:before {
  content: \"\\F271\";
}

.fa-calendar-minus-o:before {
  content: \"\\F272\";
}

.fa-calendar-times-o:before {
  content: \"\\F273\";
}

.fa-calendar-check-o:before {
  content: \"\\F274\";
}

.fa-industry:before {
  content: \"\\F275\";
}

.fa-map-pin:before {
  content: \"\\F276\";
}

.fa-map-signs:before {
  content: \"\\F277\";
}

.fa-map-o:before {
  content: \"\\F278\";
}

.fa-map:before {
  content: \"\\F279\";
}

.fa-commenting:before {
  content: \"\\F27A\";
}

.fa-commenting-o:before {
  content: \"\\F27B\";
}

.fa-houzz:before {
  content: \"\\F27C\";
}

.fa-vimeo:before {
  content: \"\\F27D\";
}

.fa-black-tie:before {
  content: \"\\F27E\";
}

.fa-fonticons:before {
  content: \"\\F280\";
}

.fa-reddit-alien:before {
  content: \"\\F281\";
}

.fa-edge:before {
  content: \"\\F282\";
}

.fa-credit-card-alt:before {
  content: \"\\F283\";
}

.fa-codiepie:before {
  content: \"\\F284\";
}

.fa-modx:before {
  content: \"\\F285\";
}

.fa-fort-awesome:before {
  content: \"\\F286\";
}

.fa-usb:before {
  content: \"\\F287\";
}

.fa-product-hunt:before {
  content: \"\\F288\";
}

.fa-mixcloud:before {
  content: \"\\F289\";
}

.fa-scribd:before {
  content: \"\\F28A\";
}

.fa-pause-circle:before {
  content: \"\\F28B\";
}

.fa-pause-circle-o:before {
  content: \"\\F28C\";
}

.fa-stop-circle:before {
  content: \"\\F28D\";
}

.fa-stop-circle-o:before {
  content: \"\\F28E\";
}

.fa-shopping-bag:before {
  content: \"\\F290\";
}

.fa-shopping-basket:before {
  content: \"\\F291\";
}

.fa-hashtag:before {
  content: \"\\F292\";
}

.fa-bluetooth:before {
  content: \"\\F293\";
}

.fa-bluetooth-b:before {
  content: \"\\F294\";
}

.fa-percent:before {
  content: \"\\F295\";
}

.fa-gitlab:before {
  content: \"\\F296\";
}

.fa-wpbeginner:before {
  content: \"\\F297\";
}

.fa-wpforms:before {
  content: \"\\F298\";
}

.fa-envira:before {
  content: \"\\F299\";
}

.fa-universal-access:before {
  content: \"\\F29A\";
}

.fa-wheelchair-alt:before {
  content: \"\\F29B\";
}

.fa-question-circle-o:before {
  content: \"\\F29C\";
}

.fa-blind:before {
  content: \"\\F29D\";
}

.fa-audio-description:before {
  content: \"\\F29E\";
}

.fa-volume-control-phone:before {
  content: \"\\F2A0\";
}

.fa-braille:before {
  content: \"\\F2A1\";
}

.fa-assistive-listening-systems:before {
  content: \"\\F2A2\";
}

.fa-asl-interpreting:before,
.fa-american-sign-language-interpreting:before {
  content: \"\\F2A3\";
}

.fa-deafness:before,
.fa-hard-of-hearing:before,
.fa-deaf:before {
  content: \"\\F2A4\";
}

.fa-glide:before {
  content: \"\\F2A5\";
}

.fa-glide-g:before {
  content: \"\\F2A6\";
}

.fa-signing:before,
.fa-sign-language:before {
  content: \"\\F2A7\";
}

.fa-low-vision:before {
  content: \"\\F2A8\";
}

.fa-viadeo:before {
  content: \"\\F2A9\";
}

.fa-viadeo-square:before {
  content: \"\\F2AA\";
}

.fa-snapchat:before {
  content: \"\\F2AB\";
}

.fa-snapchat-ghost:before {
  content: \"\\F2AC\";
}

.fa-snapchat-square:before {
  content: \"\\F2AD\";
}

.fa-pied-piper:before {
  content: \"\\F2AE\";
}

.fa-first-order:before {
  content: \"\\F2B0\";
}

.fa-yoast:before {
  content: \"\\F2B1\";
}

.fa-themeisle:before {
  content: \"\\F2B2\";
}

.fa-google-plus-circle:before,
.fa-google-plus-official:before {
  content: \"\\F2B3\";
}

.fa-fa:before,
.fa-font-awesome:before {
  content: \"\\F2B4\";
}

.fa-handshake-o:before {
  content: \"\\F2B5\";
}

.fa-envelope-open:before {
  content: \"\\F2B6\";
}

.fa-envelope-open-o:before {
  content: \"\\F2B7\";
}

.fa-linode:before {
  content: \"\\F2B8\";
}

.fa-address-book:before {
  content: \"\\F2B9\";
}

.fa-address-book-o:before {
  content: \"\\F2BA\";
}

.fa-vcard:before,
.fa-address-card:before {
  content: \"\\F2BB\";
}

.fa-vcard-o:before,
.fa-address-card-o:before {
  content: \"\\F2BC\";
}

.fa-user-circle:before {
  content: \"\\F2BD\";
}

.fa-user-circle-o:before {
  content: \"\\F2BE\";
}

.fa-user-o:before {
  content: \"\\F2C0\";
}

.fa-id-badge:before {
  content: \"\\F2C1\";
}

.fa-drivers-license:before,
.fa-id-card:before {
  content: \"\\F2C2\";
}

.fa-drivers-license-o:before,
.fa-id-card-o:before {
  content: \"\\F2C3\";
}

.fa-quora:before {
  content: \"\\F2C4\";
}

.fa-free-code-camp:before {
  content: \"\\F2C5\";
}

.fa-telegram:before {
  content: \"\\F2C6\";
}

.fa-thermometer-4:before,
.fa-thermometer:before,
.fa-thermometer-full:before {
  content: \"\\F2C7\";
}

.fa-thermometer-3:before,
.fa-thermometer-three-quarters:before {
  content: \"\\F2C8\";
}

.fa-thermometer-2:before,
.fa-thermometer-half:before {
  content: \"\\F2C9\";
}

.fa-thermometer-1:before,
.fa-thermometer-quarter:before {
  content: \"\\F2CA\";
}

.fa-thermometer-0:before,
.fa-thermometer-empty:before {
  content: \"\\F2CB\";
}

.fa-shower:before {
  content: \"\\F2CC\";
}

.fa-bathtub:before,
.fa-s15:before,
.fa-bath:before {
  content: \"\\F2CD\";
}

.fa-podcast:before {
  content: \"\\F2CE\";
}

.fa-window-maximize:before {
  content: \"\\F2D0\";
}

.fa-window-minimize:before {
  content: \"\\F2D1\";
}

.fa-window-restore:before {
  content: \"\\F2D2\";
}

.fa-times-rectangle:before,
.fa-window-close:before {
  content: \"\\F2D3\";
}

.fa-times-rectangle-o:before,
.fa-window-close-o:before {
  content: \"\\F2D4\";
}

.fa-bandcamp:before {
  content: \"\\F2D5\";
}

.fa-grav:before {
  content: \"\\F2D6\";
}

.fa-etsy:before {
  content: \"\\F2D7\";
}

.fa-imdb:before {
  content: \"\\F2D8\";
}

.fa-ravelry:before {
  content: \"\\F2D9\";
}

.fa-eercast:before {
  content: \"\\F2DA\";
}

.fa-microchip:before {
  content: \"\\F2DB\";
}

.fa-snowflake-o:before {
  content: \"\\F2DC\";
}

.fa-superpowers:before {
  content: \"\\F2DD\";
}

.fa-wpexplorer:before {
  content: \"\\F2DE\";
}

.fa-meetup:before {
  content: \"\\F2E0\";
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.sr-only-focusable:active,
.sr-only-focusable:focus {
  position: static;
  width: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  clip: auto;
}

@charset \"UTF-8\";
/*!
 * Bootstrap v4.0.0-alpha.5 (https://getbootstrap.com)
 * Copyright 2011-2016 The Bootstrap Authors
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
/*! normalize.css v4.2.0 | MIT License | github.com/necolas/normalize.css */
html {
  font-family: sans-serif;
  line-height: 1.15;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

body {
  margin: 0;
}

article,
aside,
details,
figcaption,
figure,
footer,
header,
main,
menu,
nav,
section,
summary {
  display: block;
}

audio,
canvas,
progress,
video {
  display: inline-block;
}

audio:not([controls]) {
  display: none;
  height: 0;
}

progress {
  vertical-align: baseline;
}

template,
[hidden] {
  display: none;
}

a {
  background-color: transparent;
  -webkit-text-decoration-skip: objects;
}

a:active,
a:hover {
  outline-width: 0;
}

abbr[title] {
  border-bottom: none;
  text-decoration: underline;
  -webkit-text-decoration: underline dotted;
          text-decoration: underline dotted;
}

b,
strong {
  font-weight: inherit;
}

b,
strong {
  font-weight: bolder;
}

dfn {
  font-style: italic;
}

h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

mark {
  background-color: #ff0;
  color: #000;
}

small {
  font-size: 80%;
}

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

img {
  border-style: none;
}

svg:not(:root) {
  overflow: hidden;
}

code,
kbd,
pre,
samp {
  font-family: monospace, monospace;
  font-size: 1em;
}

figure {
  margin: 1em 40px;
}

hr {
  box-sizing: content-box;
  height: 0;
  overflow: visible;
}

button,
input,
optgroup,
select,
textarea {
  font: inherit;
  margin: 0;
}

optgroup {
  font-weight: bold;
}

button,
input {
  overflow: visible;
}

button,
select {
  text-transform: none;
}

button,
html [type=button],
[type=reset],
[type=submit] {
  -webkit-appearance: button;
}

button::-moz-focus-inner,
[type=button]::-moz-focus-inner,
[type=reset]::-moz-focus-inner,
[type=submit]::-moz-focus-inner {
  border-style: none;
  padding: 0;
}

button:-moz-focusring,
[type=button]:-moz-focusring,
[type=reset]:-moz-focusring,
[type=submit]:-moz-focusring {
  outline: 1px dotted ButtonText;
}

fieldset {
  border: 1px solid #c0c0c0;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}

legend {
  box-sizing: border-box;
  color: inherit;
  display: table;
  max-width: 100%;
  padding: 0;
  white-space: normal;
}

textarea {
  overflow: auto;
}

[type=checkbox],
[type=radio] {
  box-sizing: border-box;
  padding: 0;
}

[type=number]::-webkit-inner-spin-button,
[type=number]::-webkit-outer-spin-button {
  height: auto;
}

[type=search] {
  -webkit-appearance: textfield;
  outline-offset: -2px;
}

[type=search]::-webkit-search-cancel-button,
[type=search]::-webkit-search-decoration {
  -webkit-appearance: none;
}

::-webkit-input-placeholder {
  color: inherit;
  opacity: 0.54;
}

::-webkit-file-upload-button {
  -webkit-appearance: button;
  font: inherit;
}

@media print {
  *,
*::before,
*::after,
*::first-letter,
p::first-line,
div::first-line,
blockquote::first-line,
li::first-line {
    text-shadow: none !important;
    box-shadow: none !important;
  }

  a,
a:visited {
    text-decoration: underline;
  }

  abbr[title]::after {
    content: \" (\" attr(title) \")\";
  }

  pre {
    white-space: pre-wrap !important;
  }

  pre,
blockquote {
    border: 1px solid #999;
    page-break-inside: avoid;
  }

  thead {
    display: table-header-group;
  }

  tr,
img {
    page-break-inside: avoid;
  }

  p,
h2,
h3 {
    orphans: 3;
    widows: 3;
  }

  h2,
h3 {
    page-break-after: avoid;
  }

  .navbar {
    display: none;
  }

  .btn > .caret,
.dropup > .btn > .caret {
    border-top-color: #000 !important;
  }

  .tag {
    border: 1px solid #000;
  }

  .table {
    border-collapse: collapse !important;
  }
  .table td,
.table th {
    background-color: #fff !important;
  }

  .table-bordered th,
.table-bordered td {
    border: 1px solid #ddd !important;
  }
}
html {
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: inherit;
}

@-ms-viewport {
  width: device-width;
}
html {
  font-size: 16px;
  -ms-overflow-style: scrollbar;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

body {
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-size: 1rem;
  line-height: 1.5;
  color: #373a3c;
  background-color: #fff;
}

[tabindex=\"-1\"]:focus {
  outline: none !important;
}

h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
}

p {
  margin-top: 0;
  margin-bottom: 1rem;
}

abbr[title],
abbr[data-original-title] {
  cursor: help;
  border-bottom: 1px dotted #888888;
}

address {
  margin-bottom: 1rem;
  font-style: normal;
  line-height: inherit;
}

ol,
ul,
dl {
  margin-top: 0;
  margin-bottom: 1rem;
}

ol ol,
ul ul,
ol ul,
ul ol {
  margin-bottom: 0;
}

dt {
  font-weight: bold;
}

dd {
  margin-bottom: 0.5rem;
  margin-left: 0;
}

blockquote {
  margin: 0 0 1rem;
}

a {
  color: #373a3c;
  text-decoration: none;
}
a:focus, a:hover {
  color: #121314;
  text-decoration: none;
}
a:focus {
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

a:not([href]):not([tabindex]) {
  color: inherit;
  text-decoration: none;
}
a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
  color: inherit;
  text-decoration: none;
}
a:not([href]):not([tabindex]):focus {
  outline: none;
}

pre {
  margin-top: 0;
  margin-bottom: 1rem;
  overflow: auto;
}

figure {
  margin: 0 0 1rem;
}

img {
  vertical-align: middle;
}

[role=button] {
  cursor: pointer;
}

a,
area,
button,
[role=button],
input,
label,
select,
summary,
textarea {
  touch-action: manipulation;
}

table {
  border-collapse: collapse;
  background-color: transparent;
}

caption {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  color: #888888;
  text-align: left;
  caption-side: bottom;
}

th {
  text-align: left;
}

label {
  display: inline-block;
  margin-bottom: 0.5rem;
}

button:focus {
  outline: 1px dotted;
  outline: 5px auto -webkit-focus-ring-color;
}

input,
button,
select,
textarea {
  line-height: inherit;
}

input[type=radio]:disabled,
input[type=checkbox]:disabled {
  cursor: not-allowed;
}

input[type=date],
input[type=time],
input[type=datetime-local],
input[type=month] {
  -webkit-appearance: listbox;
}

textarea {
  resize: vertical;
}

fieldset {
  min-width: 0;
  padding: 0;
  margin: 0;
  border: 0;
}

legend {
  display: block;
  width: 100%;
  padding: 0;
  margin-bottom: 0.5rem;
  font-size: 1.5rem;
  line-height: inherit;
}

input[type=search] {
  -webkit-appearance: none;
}

output {
  display: inline-block;
}

[hidden] {
  display: none !important;
}

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  margin-bottom: 0.5rem;
  font-family: inherit;
  font-weight: 500;
  line-height: 1.1;
  color: inherit;
}

h1, .h1 {
  font-size: 2rem;
}

h2, .h2 {
  font-size: 1.75rem;
}

h3, .h3 {
  font-size: 1.5rem;
}

h4, .h4 {
  font-size: 1.3rem;
}

h5, .h5 {
  font-size: 1.1rem;
}

h6, .h6 {
  font-size: 1rem;
}

.lead {
  font-size: 1.25rem;
  font-weight: 300;
}

.display-1 {
  font-size: 6rem;
  font-weight: 300;
}

.display-2 {
  font-size: 5.5rem;
  font-weight: 300;
}

.display-3 {
  font-size: 4.5rem;
  font-weight: 300;
}

.display-4 {
  font-size: 3.5rem;
  font-weight: 300;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}

small,
.small {
  font-size: 80%;
  font-weight: normal;
}

mark,
.mark {
  padding: 0.2em;
  background-color: #ff754b;
}

.list-unstyled {
  padding-left: 0;
  list-style: none;
}

.list-inline {
  padding-left: 0;
  list-style: none;
}

.list-inline-item {
  display: inline-block;
}
.list-inline-item:not(:last-child) {
  margin-right: 5px;
}

.initialism {
  font-size: 90%;
  text-transform: uppercase;
}

.blockquote {
  padding: 0.5rem 1rem;
  margin-bottom: 1rem;
  font-size: 1.25rem;
  border-left: 0.25rem solid #eceeef;
}

.blockquote-footer {
  display: block;
  font-size: 80%;
  color: #888888;
}
.blockquote-footer::before {
  content: \"\\2014\\A0\";
}

.blockquote-reverse {
  padding-right: 1rem;
  padding-left: 0;
  text-align: right;
  border-right: 0.25rem solid #eceeef;
  border-left: 0;
}

.blockquote-reverse .blockquote-footer::before {
  content: \"\";
}
.blockquote-reverse .blockquote-footer::after {
  content: \"\\A0\\2014\";
}

.img-fluid, .carousel-inner > .carousel-item > img,
.carousel-inner > .carousel-item > a > img {
  max-width: 100%;
  height: auto;
}

.img-thumbnail {
  padding: 0.25rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.17rem;
  transition: all 0.2s ease-in-out;
  max-width: 100%;
  height: auto;
}

.figure {
  display: inline-block;
}

.figure-img {
  margin-bottom: 0.5rem;
  line-height: 1;
}

.figure-caption {
  font-size: 90%;
  color: #888888;
}

code,
kbd,
pre,
samp {
  font-family: Menlo, Monaco, Consolas, \"Liberation Mono\", \"Courier New\", monospace;
}

code {
  padding: 0.2rem 0.4rem;
  font-size: 90%;
  color: #bd4147;
  background-color: #f7f7f9;
  border-radius: 0.17rem;
}

kbd {
  padding: 0.2rem 0.4rem;
  font-size: 90%;
  color: #fff;
  background-color: #333;
  border-radius: 0.1rem;
}
kbd kbd {
  padding: 0;
  font-size: 100%;
  font-weight: bold;
}

pre {
  display: block;
  margin-top: 0;
  margin-bottom: 1rem;
  font-size: 90%;
  color: #373a3c;
}
pre code {
  padding: 0;
  font-size: inherit;
  color: inherit;
  background-color: transparent;
  border-radius: 0;
}

.pre-scrollable {
  max-height: 340px;
  overflow-y: scroll;
}

.container {
  margin-left: auto;
  margin-right: auto;
  /*padding-left: 15px;*/
  /*padding-right: 15px;*/
}
@media (min-width: 576px) {
  .container {
    width: 540px;
    max-width: 100%;
  }
}
@media (min-width: 768px) {
  .container {
    width: 720px;
    max-width: 100%;
  }
}
@media (min-width: 992px) {
  .container {
    width: 960px;
    max-width: 100%;
  }
}
@media (min-width: 1200px) {
  .container {
    width: 1140px;
    max-width: 100%;
  }
}

.container-fluid {
  margin-left: auto;
  margin-right: auto;
  padding-left: 15px;
  padding-right: 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
@media (min-width: 576px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 768px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 992px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
@media (min-width: 1200px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}

.col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
  position: relative;
  min-height: 1px;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
@media (min-width: 576px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 768px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 992px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}
@media (min-width: 1200px) {
  .col-xl-24, .col-xl-23, .col-xl-22, .col-xl-21, .col-xl-20, .col-xl-19, .col-xl-18, .col-xl-17, .col-xl-16, .col-xl-15, .col-xl-14, .col-xl-13, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-xl, .col-lg-24, .col-lg-23, .col-lg-22, .col-lg-21, .col-lg-20, .col-lg-19, .col-lg-18, .col-lg-17, .col-lg-16, .col-lg-15, .col-lg-14, .col-lg-13, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-lg, .col-md-24, .col-md-23, .col-md-22, .col-md-21, .col-md-20, .col-md-19, .col-md-18, .col-md-17, .col-md-16, .col-md-15, .col-md-14, .col-md-13, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-md, .col-sm-24, .col-sm-23, .col-sm-22, .col-sm-21, .col-sm-20, .col-sm-19, .col-sm-18, .col-sm-17, .col-sm-16, .col-sm-15, .col-sm-14, .col-sm-13, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col-sm, .col-xs-24, .col-xs-23, .col-xs-22, .col-xs-21, .col-xs-20, .col-xs-19, .col-xs-18, .col-xs-17, .col-xs-16, .col-xs-15, .col-xs-14, .col-xs-13, .col-xs-12, .col-xs-11, .col-xs-10, .col-xs-9, .col-xs-8, .col-xs-7, .col-xs-6, .col-xs-5, .col-xs-4, .col-xs-3, .col-xs-2, .col-xs-1, .col-xs {
    padding-right: 15px;
    padding-left: 15px;
  }
}

.col-xs {
  flex-basis: 0;
  flex-grow: 1;
  max-width: 100%;
}

.col-xs-1 {
  flex: 0 0 4.1666666667%;
  max-width: 4.1666666667%;
}

.col-xs-2 {
  flex: 0 0 8.3333333333%;
  max-width: 8.3333333333%;
}

.col-xs-3 {
  flex: 0 0 12.5%;
  max-width: 12.5%;
}

.col-xs-4 {
  flex: 0 0 16.6666666667%;
  max-width: 16.6666666667%;
}

.col-xs-5 {
  flex: 0 0 20.8333333333%;
  max-width: 20.8333333333%;
}

.col-xs-6 {
  flex: 0 0 25%;
  max-width: 25%;
}

.col-xs-7 {
  flex: 0 0 29.1666666667%;
  max-width: 29.1666666667%;
}

.col-xs-8 {
  flex: 0 0 33.3333333333%;
  max-width: 33.3333333333%;
}

.col-xs-9 {
  flex: 0 0 37.5%;
  max-width: 37.5%;
}

.col-xs-10 {
  flex: 0 0 41.6666666667%;
  max-width: 41.6666666667%;
}

.col-xs-11 {
  flex: 0 0 45.8333333333%;
  max-width: 45.8333333333%;
}

.col-xs-12 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-xs-13 {
  flex: 0 0 54.1666666667%;
  max-width: 54.1666666667%;
}

.col-xs-14 {
  flex: 0 0 58.3333333333%;
  max-width: 58.3333333333%;
}

.col-xs-15 {
  flex: 0 0 62.5%;
  max-width: 62.5%;
}

.col-xs-16 {
  flex: 0 0 66.6666666667%;
  max-width: 66.6666666667%;
}

.col-xs-17 {
  flex: 0 0 70.8333333333%;
  max-width: 70.8333333333%;
}

.col-xs-18 {
  flex: 0 0 75%;
  max-width: 75%;
}

.col-xs-19 {
  flex: 0 0 79.1666666667%;
  max-width: 79.1666666667%;
}

.col-xs-20 {
  flex: 0 0 83.3333333333%;
  max-width: 83.3333333333%;
}

.col-xs-21 {
  flex: 0 0 87.5%;
  max-width: 87.5%;
}

.col-xs-22 {
  flex: 0 0 91.6666666667%;
  max-width: 91.6666666667%;
}

.col-xs-23 {
  flex: 0 0 95.8333333333%;
  max-width: 95.8333333333%;
}

.col-xs-24 {
  flex: 0 0 100%;
  max-width: 100%;
}

.pull-xs-0 {
  right: auto;
}

.pull-xs-1 {
  right: 4.1666666667%;
}

.pull-xs-2 {
  right: 8.3333333333%;
}

.pull-xs-3 {
  right: 12.5%;
}

.pull-xs-4 {
  right: 16.6666666667%;
}

.pull-xs-5 {
  right: 20.8333333333%;
}

.pull-xs-6 {
  right: 25%;
}

.pull-xs-7 {
  right: 29.1666666667%;
}

.pull-xs-8 {
  right: 33.3333333333%;
}

.pull-xs-9 {
  right: 37.5%;
}

.pull-xs-10 {
  right: 41.6666666667%;
}

.pull-xs-11 {
  right: 45.8333333333%;
}

.pull-xs-12 {
  right: 50%;
}

.pull-xs-13 {
  right: 54.1666666667%;
}

.pull-xs-14 {
  right: 58.3333333333%;
}

.pull-xs-15 {
  right: 62.5%;
}

.pull-xs-16 {
  right: 66.6666666667%;
}

.pull-xs-17 {
  right: 70.8333333333%;
}

.pull-xs-18 {
  right: 75%;
}

.pull-xs-19 {
  right: 79.1666666667%;
}

.pull-xs-20 {
  right: 83.3333333333%;
}

.pull-xs-21 {
  right: 87.5%;
}

.pull-xs-22 {
  right: 91.6666666667%;
}

.pull-xs-23 {
  right: 95.8333333333%;
}

.pull-xs-24 {
  right: 100%;
}

.push-xs-0 {
  left: auto;
}

.push-xs-1 {
  left: 4.1666666667%;
}

.push-xs-2 {
  left: 8.3333333333%;
}

.push-xs-3 {
  left: 12.5%;
}

.push-xs-4 {
  left: 16.6666666667%;
}

.push-xs-5 {
  left: 20.8333333333%;
}

.push-xs-6 {
  left: 25%;
}

.push-xs-7 {
  left: 29.1666666667%;
}

.push-xs-8 {
  left: 33.3333333333%;
}

.push-xs-9 {
  left: 37.5%;
}

.push-xs-10 {
  left: 41.6666666667%;
}

.push-xs-11 {
  left: 45.8333333333%;
}

.push-xs-12 {
  left: 50%;
}

.push-xs-13 {
  left: 54.1666666667%;
}

.push-xs-14 {
  left: 58.3333333333%;
}

.push-xs-15 {
  left: 62.5%;
}

.push-xs-16 {
  left: 66.6666666667%;
}

.push-xs-17 {
  left: 70.8333333333%;
}

.push-xs-18 {
  left: 75%;
}

.push-xs-19 {
  left: 79.1666666667%;
}

.push-xs-20 {
  left: 83.3333333333%;
}

.push-xs-21 {
  left: 87.5%;
}

.push-xs-22 {
  left: 91.6666666667%;
}

.push-xs-23 {
  left: 95.8333333333%;
}

.push-xs-24 {
  left: 100%;
}

.offset-xs-1 {
  margin-left: 4.1666666667%;
}

.offset-xs-2 {
  margin-left: 8.3333333333%;
}

.offset-xs-3 {
  margin-left: 12.5%;
}

.offset-xs-4 {
  margin-left: 16.6666666667%;
}

.offset-xs-5 {
  margin-left: 20.8333333333%;
}

.offset-xs-6 {
  margin-left: 25%;
}

.offset-xs-7 {
  margin-left: 29.1666666667%;
}

.offset-xs-8 {
  margin-left: 33.3333333333%;
}

.offset-xs-9 {
  margin-left: 37.5%;
}

.offset-xs-10 {
  margin-left: 41.6666666667%;
}

.offset-xs-11 {
  margin-left: 45.8333333333%;
}

.offset-xs-12 {
  margin-left: 50%;
}

.offset-xs-13 {
  margin-left: 54.1666666667%;
}

.offset-xs-14 {
  margin-left: 58.3333333333%;
}

.offset-xs-15 {
  margin-left: 62.5%;
}

.offset-xs-16 {
  margin-left: 66.6666666667%;
}

.offset-xs-17 {
  margin-left: 70.8333333333%;
}

.offset-xs-18 {
  margin-left: 75%;
}

.offset-xs-19 {
  margin-left: 79.1666666667%;
}

.offset-xs-20 {
  margin-left: 83.3333333333%;
}

.offset-xs-21 {
  margin-left: 87.5%;
}

.offset-xs-22 {
  margin-left: 91.6666666667%;
}

.offset-xs-23 {
  margin-left: 95.8333333333%;
}

@media (min-width: 576px) {
  .col-sm {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-sm-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-sm-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-sm-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-sm-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-sm-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-sm-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-sm-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-sm-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-sm-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-sm-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-sm-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-sm-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-sm-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-sm-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-sm-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-sm-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-sm-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-sm-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-sm-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-sm-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-sm-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-sm-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-sm-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-sm-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-sm-0 {
    right: auto;
  }

  .pull-sm-1 {
    right: 4.1666666667%;
  }

  .pull-sm-2 {
    right: 8.3333333333%;
  }

  .pull-sm-3 {
    right: 12.5%;
  }

  .pull-sm-4 {
    right: 16.6666666667%;
  }

  .pull-sm-5 {
    right: 20.8333333333%;
  }

  .pull-sm-6 {
    right: 25%;
  }

  .pull-sm-7 {
    right: 29.1666666667%;
  }

  .pull-sm-8 {
    right: 33.3333333333%;
  }

  .pull-sm-9 {
    right: 37.5%;
  }

  .pull-sm-10 {
    right: 41.6666666667%;
  }

  .pull-sm-11 {
    right: 45.8333333333%;
  }

  .pull-sm-12 {
    right: 50%;
  }

  .pull-sm-13 {
    right: 54.1666666667%;
  }

  .pull-sm-14 {
    right: 58.3333333333%;
  }

  .pull-sm-15 {
    right: 62.5%;
  }

  .pull-sm-16 {
    right: 66.6666666667%;
  }

  .pull-sm-17 {
    right: 70.8333333333%;
  }

  .pull-sm-18 {
    right: 75%;
  }

  .pull-sm-19 {
    right: 79.1666666667%;
  }

  .pull-sm-20 {
    right: 83.3333333333%;
  }

  .pull-sm-21 {
    right: 87.5%;
  }

  .pull-sm-22 {
    right: 91.6666666667%;
  }

  .pull-sm-23 {
    right: 95.8333333333%;
  }

  .pull-sm-24 {
    right: 100%;
  }

  .push-sm-0 {
    left: auto;
  }

  .push-sm-1 {
    left: 4.1666666667%;
  }

  .push-sm-2 {
    left: 8.3333333333%;
  }

  .push-sm-3 {
    left: 12.5%;
  }

  .push-sm-4 {
    left: 16.6666666667%;
  }

  .push-sm-5 {
    left: 20.8333333333%;
  }

  .push-sm-6 {
    left: 25%;
  }

  .push-sm-7 {
    left: 29.1666666667%;
  }

  .push-sm-8 {
    left: 33.3333333333%;
  }

  .push-sm-9 {
    left: 37.5%;
  }

  .push-sm-10 {
    left: 41.6666666667%;
  }

  .push-sm-11 {
    left: 45.8333333333%;
  }

  .push-sm-12 {
    left: 50%;
  }

  .push-sm-13 {
    left: 54.1666666667%;
  }

  .push-sm-14 {
    left: 58.3333333333%;
  }

  .push-sm-15 {
    left: 62.5%;
  }

  .push-sm-16 {
    left: 66.6666666667%;
  }

  .push-sm-17 {
    left: 70.8333333333%;
  }

  .push-sm-18 {
    left: 75%;
  }

  .push-sm-19 {
    left: 79.1666666667%;
  }

  .push-sm-20 {
    left: 83.3333333333%;
  }

  .push-sm-21 {
    left: 87.5%;
  }

  .push-sm-22 {
    left: 91.6666666667%;
  }

  .push-sm-23 {
    left: 95.8333333333%;
  }

  .push-sm-24 {
    left: 100%;
  }

  .offset-sm-0 {
    margin-left: 0%;
  }

  .offset-sm-1 {
    margin-left: 4.1666666667%;
  }

  .offset-sm-2 {
    margin-left: 8.3333333333%;
  }

  .offset-sm-3 {
    margin-left: 12.5%;
  }

  .offset-sm-4 {
    margin-left: 16.6666666667%;
  }

  .offset-sm-5 {
    margin-left: 20.8333333333%;
  }

  .offset-sm-6 {
    margin-left: 25%;
  }

  .offset-sm-7 {
    margin-left: 29.1666666667%;
  }

  .offset-sm-8 {
    margin-left: 33.3333333333%;
  }

  .offset-sm-9 {
    margin-left: 37.5%;
  }

  .offset-sm-10 {
    margin-left: 41.6666666667%;
  }

  .offset-sm-11 {
    margin-left: 45.8333333333%;
  }

  .offset-sm-12 {
    margin-left: 50%;
  }

  .offset-sm-13 {
    margin-left: 54.1666666667%;
  }

  .offset-sm-14 {
    margin-left: 58.3333333333%;
  }

  .offset-sm-15 {
    margin-left: 62.5%;
  }

  .offset-sm-16 {
    margin-left: 66.6666666667%;
  }

  .offset-sm-17 {
    margin-left: 70.8333333333%;
  }

  .offset-sm-18 {
    margin-left: 75%;
  }

  .offset-sm-19 {
    margin-left: 79.1666666667%;
  }

  .offset-sm-20 {
    margin-left: 83.3333333333%;
  }

  .offset-sm-21 {
    margin-left: 87.5%;
  }

  .offset-sm-22 {
    margin-left: 91.6666666667%;
  }

  .offset-sm-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 768px) {
  .col-md {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-md-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-md-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-md-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-md-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-md-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-md-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-md-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-md-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-md-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-md-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-md-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-md-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-md-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-md-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-md-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-md-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-md-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-md-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-md-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-md-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-md-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-md-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-md-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-md-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-md-0 {
    right: auto;
  }

  .pull-md-1 {
    right: 4.1666666667%;
  }

  .pull-md-2 {
    right: 8.3333333333%;
  }

  .pull-md-3 {
    right: 12.5%;
  }

  .pull-md-4 {
    right: 16.6666666667%;
  }

  .pull-md-5 {
    right: 20.8333333333%;
  }

  .pull-md-6 {
    right: 25%;
  }

  .pull-md-7 {
    right: 29.1666666667%;
  }

  .pull-md-8 {
    right: 33.3333333333%;
  }

  .pull-md-9 {
    right: 37.5%;
  }

  .pull-md-10 {
    right: 41.6666666667%;
  }

  .pull-md-11 {
    right: 45.8333333333%;
  }

  .pull-md-12 {
    right: 50%;
  }

  .pull-md-13 {
    right: 54.1666666667%;
  }

  .pull-md-14 {
    right: 58.3333333333%;
  }

  .pull-md-15 {
    right: 62.5%;
  }

  .pull-md-16 {
    right: 66.6666666667%;
  }

  .pull-md-17 {
    right: 70.8333333333%;
  }

  .pull-md-18 {
    right: 75%;
  }

  .pull-md-19 {
    right: 79.1666666667%;
  }

  .pull-md-20 {
    right: 83.3333333333%;
  }

  .pull-md-21 {
    right: 87.5%;
  }

  .pull-md-22 {
    right: 91.6666666667%;
  }

  .pull-md-23 {
    right: 95.8333333333%;
  }

  .pull-md-24 {
    right: 100%;
  }

  .push-md-0 {
    left: auto;
  }

  .push-md-1 {
    left: 4.1666666667%;
  }

  .push-md-2 {
    left: 8.3333333333%;
  }

  .push-md-3 {
    left: 12.5%;
  }

  .push-md-4 {
    left: 16.6666666667%;
  }

  .push-md-5 {
    left: 20.8333333333%;
  }

  .push-md-6 {
    left: 25%;
  }

  .push-md-7 {
    left: 29.1666666667%;
  }

  .push-md-8 {
    left: 33.3333333333%;
  }

  .push-md-9 {
    left: 37.5%;
  }

  .push-md-10 {
    left: 41.6666666667%;
  }

  .push-md-11 {
    left: 45.8333333333%;
  }

  .push-md-12 {
    left: 50%;
  }

  .push-md-13 {
    left: 54.1666666667%;
  }

  .push-md-14 {
    left: 58.3333333333%;
  }

  .push-md-15 {
    left: 62.5%;
  }

  .push-md-16 {
    left: 66.6666666667%;
  }

  .push-md-17 {
    left: 70.8333333333%;
  }

  .push-md-18 {
    left: 75%;
  }

  .push-md-19 {
    left: 79.1666666667%;
  }

  .push-md-20 {
    left: 83.3333333333%;
  }

  .push-md-21 {
    left: 87.5%;
  }

  .push-md-22 {
    left: 91.6666666667%;
  }

  .push-md-23 {
    left: 95.8333333333%;
  }

  .push-md-24 {
    left: 100%;
  }

  .offset-md-0 {
    margin-left: 0%;
  }

  .offset-md-1 {
    margin-left: 4.1666666667%;
  }

  .offset-md-2 {
    margin-left: 8.3333333333%;
  }

  .offset-md-3 {
    margin-left: 12.5%;
  }

  .offset-md-4 {
    margin-left: 16.6666666667%;
  }

  .offset-md-5 {
    margin-left: 20.8333333333%;
  }

  .offset-md-6 {
    margin-left: 25%;
  }

  .offset-md-7 {
    margin-left: 29.1666666667%;
  }

  .offset-md-8 {
    margin-left: 33.3333333333%;
  }

  .offset-md-9 {
    margin-left: 37.5%;
  }

  .offset-md-10 {
    margin-left: 41.6666666667%;
  }

  .offset-md-11 {
    margin-left: 45.8333333333%;
  }

  .offset-md-12 {
    margin-left: 50%;
  }

  .offset-md-13 {
    margin-left: 54.1666666667%;
  }

  .offset-md-14 {
    margin-left: 58.3333333333%;
  }

  .offset-md-15 {
    margin-left: 62.5%;
  }

  .offset-md-16 {
    margin-left: 66.6666666667%;
  }

  .offset-md-17 {
    margin-left: 70.8333333333%;
  }

  .offset-md-18 {
    margin-left: 75%;
  }

  .offset-md-19 {
    margin-left: 79.1666666667%;
  }

  .offset-md-20 {
    margin-left: 83.3333333333%;
  }

  .offset-md-21 {
    margin-left: 87.5%;
  }

  .offset-md-22 {
    margin-left: 91.6666666667%;
  }

  .offset-md-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 992px) {
  .col-lg {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-lg-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-lg-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-lg-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-lg-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-lg-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-lg-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-lg-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-lg-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-lg-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-lg-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-lg-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-lg-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-lg-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-lg-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-lg-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-lg-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-lg-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-lg-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-lg-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-lg-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-lg-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-lg-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-lg-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-lg-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-lg-0 {
    right: auto;
  }

  .pull-lg-1 {
    right: 4.1666666667%;
  }

  .pull-lg-2 {
    right: 8.3333333333%;
  }

  .pull-lg-3 {
    right: 12.5%;
  }

  .pull-lg-4 {
    right: 16.6666666667%;
  }

  .pull-lg-5 {
    right: 20.8333333333%;
  }

  .pull-lg-6 {
    right: 25%;
  }

  .pull-lg-7 {
    right: 29.1666666667%;
  }

  .pull-lg-8 {
    right: 33.3333333333%;
  }

  .pull-lg-9 {
    right: 37.5%;
  }

  .pull-lg-10 {
    right: 41.6666666667%;
  }

  .pull-lg-11 {
    right: 45.8333333333%;
  }

  .pull-lg-12 {
    right: 50%;
  }

  .pull-lg-13 {
    right: 54.1666666667%;
  }

  .pull-lg-14 {
    right: 58.3333333333%;
  }

  .pull-lg-15 {
    right: 62.5%;
  }

  .pull-lg-16 {
    right: 66.6666666667%;
  }

  .pull-lg-17 {
    right: 70.8333333333%;
  }

  .pull-lg-18 {
    right: 75%;
  }

  .pull-lg-19 {
    right: 79.1666666667%;
  }

  .pull-lg-20 {
    right: 83.3333333333%;
  }

  .pull-lg-21 {
    right: 87.5%;
  }

  .pull-lg-22 {
    right: 91.6666666667%;
  }

  .pull-lg-23 {
    right: 95.8333333333%;
  }

  .pull-lg-24 {
    right: 100%;
  }

  .push-lg-0 {
    left: auto;
  }

  .push-lg-1 {
    left: 4.1666666667%;
  }

  .push-lg-2 {
    left: 8.3333333333%;
  }

  .push-lg-3 {
    left: 12.5%;
  }

  .push-lg-4 {
    left: 16.6666666667%;
  }

  .push-lg-5 {
    left: 20.8333333333%;
  }

  .push-lg-6 {
    left: 25%;
  }

  .push-lg-7 {
    left: 29.1666666667%;
  }

  .push-lg-8 {
    left: 33.3333333333%;
  }

  .push-lg-9 {
    left: 37.5%;
  }

  .push-lg-10 {
    left: 41.6666666667%;
  }

  .push-lg-11 {
    left: 45.8333333333%;
  }

  .push-lg-12 {
    left: 50%;
  }

  .push-lg-13 {
    left: 54.1666666667%;
  }

  .push-lg-14 {
    left: 58.3333333333%;
  }

  .push-lg-15 {
    left: 62.5%;
  }

  .push-lg-16 {
    left: 66.6666666667%;
  }

  .push-lg-17 {
    left: 70.8333333333%;
  }

  .push-lg-18 {
    left: 75%;
  }

  .push-lg-19 {
    left: 79.1666666667%;
  }

  .push-lg-20 {
    left: 83.3333333333%;
  }

  .push-lg-21 {
    left: 87.5%;
  }

  .push-lg-22 {
    left: 91.6666666667%;
  }

  .push-lg-23 {
    left: 95.8333333333%;
  }

  .push-lg-24 {
    left: 100%;
  }

  .offset-lg-0 {
    margin-left: 0%;
  }

  .offset-lg-1 {
    margin-left: 4.1666666667%;
  }

  .offset-lg-2 {
    margin-left: 8.3333333333%;
  }

  .offset-lg-3 {
    margin-left: 12.5%;
  }

  .offset-lg-4 {
    margin-left: 16.6666666667%;
  }

  .offset-lg-5 {
    margin-left: 20.8333333333%;
  }

  .offset-lg-6 {
    margin-left: 25%;
  }

  .offset-lg-7 {
    margin-left: 29.1666666667%;
  }

  .offset-lg-8 {
    margin-left: 33.3333333333%;
  }

  .offset-lg-9 {
    margin-left: 37.5%;
  }

  .offset-lg-10 {
    margin-left: 41.6666666667%;
  }

  .offset-lg-11 {
    margin-left: 45.8333333333%;
  }

  .offset-lg-12 {
    margin-left: 50%;
  }

  .offset-lg-13 {
    margin-left: 54.1666666667%;
  }

  .offset-lg-14 {
    margin-left: 58.3333333333%;
  }

  .offset-lg-15 {
    margin-left: 62.5%;
  }

  .offset-lg-16 {
    margin-left: 66.6666666667%;
  }

  .offset-lg-17 {
    margin-left: 70.8333333333%;
  }

  .offset-lg-18 {
    margin-left: 75%;
  }

  .offset-lg-19 {
    margin-left: 79.1666666667%;
  }

  .offset-lg-20 {
    margin-left: 83.3333333333%;
  }

  .offset-lg-21 {
    margin-left: 87.5%;
  }

  .offset-lg-22 {
    margin-left: 91.6666666667%;
  }

  .offset-lg-23 {
    margin-left: 95.8333333333%;
  }
}
@media (min-width: 1200px) {
  .col-xl {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }

  .col-xl-1 {
    flex: 0 0 4.1666666667%;
    max-width: 4.1666666667%;
  }

  .col-xl-2 {
    flex: 0 0 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .col-xl-3 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .col-xl-4 {
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .col-xl-5 {
    flex: 0 0 20.8333333333%;
    max-width: 20.8333333333%;
  }

  .col-xl-6 {
    flex: 0 0 25%;
    max-width: 25%;
  }

  .col-xl-7 {
    flex: 0 0 29.1666666667%;
    max-width: 29.1666666667%;
  }

  .col-xl-8 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .col-xl-9 {
    flex: 0 0 37.5%;
    max-width: 37.5%;
  }

  .col-xl-10 {
    flex: 0 0 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .col-xl-11 {
    flex: 0 0 45.8333333333%;
    max-width: 45.8333333333%;
  }

  .col-xl-12 {
    flex: 0 0 50%;
    max-width: 50%;
  }

  .col-xl-13 {
    flex: 0 0 54.1666666667%;
    max-width: 54.1666666667%;
  }

  .col-xl-14 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .col-xl-15 {
    flex: 0 0 62.5%;
    max-width: 62.5%;
  }

  .col-xl-16 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .col-xl-17 {
    flex: 0 0 70.8333333333%;
    max-width: 70.8333333333%;
  }

  .col-xl-18 {
    flex: 0 0 75%;
    max-width: 75%;
  }

  .col-xl-19 {
    flex: 0 0 79.1666666667%;
    max-width: 79.1666666667%;
  }

  .col-xl-20 {
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .col-xl-21 {
    flex: 0 0 87.5%;
    max-width: 87.5%;
  }

  .col-xl-22 {
    flex: 0 0 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .col-xl-23 {
    flex: 0 0 95.8333333333%;
    max-width: 95.8333333333%;
  }

  .col-xl-24 {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .pull-xl-0 {
    right: auto;
  }

  .pull-xl-1 {
    right: 4.1666666667%;
  }

  .pull-xl-2 {
    right: 8.3333333333%;
  }

  .pull-xl-3 {
    right: 12.5%;
  }

  .pull-xl-4 {
    right: 16.6666666667%;
  }

  .pull-xl-5 {
    right: 20.8333333333%;
  }

  .pull-xl-6 {
    right: 25%;
  }

  .pull-xl-7 {
    right: 29.1666666667%;
  }

  .pull-xl-8 {
    right: 33.3333333333%;
  }

  .pull-xl-9 {
    right: 37.5%;
  }

  .pull-xl-10 {
    right: 41.6666666667%;
  }

  .pull-xl-11 {
    right: 45.8333333333%;
  }

  .pull-xl-12 {
    right: 50%;
  }

  .pull-xl-13 {
    right: 54.1666666667%;
  }

  .pull-xl-14 {
    right: 58.3333333333%;
  }

  .pull-xl-15 {
    right: 62.5%;
  }

  .pull-xl-16 {
    right: 66.6666666667%;
  }

  .pull-xl-17 {
    right: 70.8333333333%;
  }

  .pull-xl-18 {
    right: 75%;
  }

  .pull-xl-19 {
    right: 79.1666666667%;
  }

  .pull-xl-20 {
    right: 83.3333333333%;
  }

  .pull-xl-21 {
    right: 87.5%;
  }

  .pull-xl-22 {
    right: 91.6666666667%;
  }

  .pull-xl-23 {
    right: 95.8333333333%;
  }

  .pull-xl-24 {
    right: 100%;
  }

  .push-xl-0 {
    left: auto;
  }

  .push-xl-1 {
    left: 4.1666666667%;
  }

  .push-xl-2 {
    left: 8.3333333333%;
  }

  .push-xl-3 {
    left: 12.5%;
  }

  .push-xl-4 {
    left: 16.6666666667%;
  }

  .push-xl-5 {
    left: 20.8333333333%;
  }

  .push-xl-6 {
    left: 25%;
  }

  .push-xl-7 {
    left: 29.1666666667%;
  }

  .push-xl-8 {
    left: 33.3333333333%;
  }

  .push-xl-9 {
    left: 37.5%;
  }

  .push-xl-10 {
    left: 41.6666666667%;
  }

  .push-xl-11 {
    left: 45.8333333333%;
  }

  .push-xl-12 {
    left: 50%;
  }

  .push-xl-13 {
    left: 54.1666666667%;
  }

  .push-xl-14 {
    left: 58.3333333333%;
  }

  .push-xl-15 {
    left: 62.5%;
  }

  .push-xl-16 {
    left: 66.6666666667%;
  }

  .push-xl-17 {
    left: 70.8333333333%;
  }

  .push-xl-18 {
    left: 75%;
  }

  .push-xl-19 {
    left: 79.1666666667%;
  }

  .push-xl-20 {
    left: 83.3333333333%;
  }

  .push-xl-21 {
    left: 87.5%;
  }

  .push-xl-22 {
    left: 91.6666666667%;
  }

  .push-xl-23 {
    left: 95.8333333333%;
  }

  .push-xl-24 {
    left: 100%;
  }

  .offset-xl-0 {
    margin-left: 0%;
  }

  .offset-xl-1 {
    margin-left: 4.1666666667%;
  }

  .offset-xl-2 {
    margin-left: 8.3333333333%;
  }

  .offset-xl-3 {
    margin-left: 12.5%;
  }

  .offset-xl-4 {
    margin-left: 16.6666666667%;
  }

  .offset-xl-5 {
    margin-left: 20.8333333333%;
  }

  .offset-xl-6 {
    margin-left: 25%;
  }

  .offset-xl-7 {
    margin-left: 29.1666666667%;
  }

  .offset-xl-8 {
    margin-left: 33.3333333333%;
  }

  .offset-xl-9 {
    margin-left: 37.5%;
  }

  .offset-xl-10 {
    margin-left: 41.6666666667%;
  }

  .offset-xl-11 {
    margin-left: 45.8333333333%;
  }

  .offset-xl-12 {
    margin-left: 50%;
  }

  .offset-xl-13 {
    margin-left: 54.1666666667%;
  }

  .offset-xl-14 {
    margin-left: 58.3333333333%;
  }

  .offset-xl-15 {
    margin-left: 62.5%;
  }

  .offset-xl-16 {
    margin-left: 66.6666666667%;
  }

  .offset-xl-17 {
    margin-left: 70.8333333333%;
  }

  .offset-xl-18 {
    margin-left: 75%;
  }

  .offset-xl-19 {
    margin-left: 79.1666666667%;
  }

  .offset-xl-20 {
    margin-left: 83.3333333333%;
  }

  .offset-xl-21 {
    margin-left: 87.5%;
  }

  .offset-xl-22 {
    margin-left: 91.6666666667%;
  }

  .offset-xl-23 {
    margin-left: 95.8333333333%;
  }
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
}
.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #eceeef;
}
.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #eceeef;
}
.table tbody + tbody {
  border-top: 2px solid #eceeef;
}
.table .table {
  background-color: #fff;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #eceeef;
}
.table-bordered th,
.table-bordered td {
  border: 1px solid #eceeef;
}
.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-active {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: rgba(0, 0, 0, 0.075);
}

.table-success {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #47d165;
}

.table-info {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #11bef6;
}

.table-warning {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #ff754b;
}

.table-danger {
  box-sizing: border-box;
  border-left: 3px solid;
  border-color: #ff3160;
}

.thead-inverse th {
  color: #fff;
  background-color: #373a3c;
}

.thead-default th {
  color: #55595c;
  background-color: #eceeef;
}

.table-inverse {
  color: #eceeef;
  background-color: #373a3c;
}
.table-inverse th,
.table-inverse td,
.table-inverse thead th {
  border-color: #55595c;
}
.table-inverse.table-bordered {
  border: 0;
}

.table-responsive {
  display: block;
  width: 100%;
  min-height: 0%;
  overflow-x: auto;
}

.table-reflow thead {
  float: left;
}
.table-reflow tbody {
  display: block;
  white-space: nowrap;
}
.table-reflow th,
.table-reflow td {
  border-top: 1px solid #eceeef;
  border-left: 1px solid #eceeef;
}
.table-reflow th:last-child,
.table-reflow td:last-child {
  border-right: 1px solid #eceeef;
}
.table-reflow thead:last-child tr:last-child th,
.table-reflow thead:last-child tr:last-child td,
.table-reflow tbody:last-child tr:last-child th,
.table-reflow tbody:last-child tr:last-child td,
.table-reflow tfoot:last-child tr:last-child th,
.table-reflow tfoot:last-child tr:last-child td {
  border-bottom: 1px solid #eceeef;
}
.table-reflow tr {
  float: left;
}
.table-reflow tr th,
.table-reflow tr td {
  display: block !important;
  border: 1px solid #eceeef;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  line-height: 1.25;
  color: #55595c;
  background-color: #fff;
  background-image: none;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
}
.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}
.form-control:focus {
  color: #55595c;
  background-color: #fff;
  border-color: #11bef6;
  outline: none;
}
.form-control::-webkit-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control:-ms-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control::-ms-input-placeholder {
  color: #999;
  opacity: 1;
}
.form-control::placeholder {
  color: #999;
  opacity: 1;
}
.form-control:disabled, .form-control[readonly] {
  background-color: #eceeef;
  opacity: 1;
}
.form-control:disabled {
  cursor: not-allowed;
}

select.form-control:not([size]):not([multiple]) {
  height: calc(2.5rem - 2px);
}
select.form-control:focus::-ms-value {
  color: #55595c;
  background-color: #fff;
}

.form-control-file,
.form-control-range {
  display: block;
}

.col-form-label {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  margin-bottom: 0;
}

.col-form-label-lg {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1.25rem;
}

.col-form-label-sm {
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  font-size: 0.875rem;
}

.col-form-legend {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  margin-bottom: 0;
  font-size: 1rem;
}

.form-control-static {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  line-height: 1.25;
  border: solid transparent;
  border-width: 1px 0;
}
.form-control-static.form-control-sm, .input-group-sm > .form-control-static.form-control,
.input-group-sm > .form-control-static.input-group-addon,
.input-group-sm > .input-group-btn > .form-control-static.btn, .form-control-static.form-control-lg, .input-group-lg > .form-control-static.form-control,
.input-group-lg > .form-control-static.input-group-addon,
.input-group-lg > .input-group-btn > .form-control-static.btn {
  padding-right: 0;
  padding-left: 0;
}

.form-control-sm, .input-group-sm > .form-control,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}

select.form-control-sm:not([size]):not([multiple]), .input-group-sm > select.form-control:not([size]):not([multiple]),
.input-group-sm > select.input-group-addon:not([size]):not([multiple]),
.input-group-sm > .input-group-btn > select.btn:not([size]):not([multiple]) {
  height: 1.8125rem;
}

.form-control-lg, .input-group-lg > .form-control,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.25rem;
}

select.form-control-lg:not([size]):not([multiple]), .input-group-lg > select.form-control:not([size]):not([multiple]),
.input-group-lg > select.input-group-addon:not([size]):not([multiple]),
.input-group-lg > .input-group-btn > select.btn:not([size]):not([multiple]) {
  height: 3.1666666667rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-text {
  display: block;
  margin-top: 0.25rem;
}

.form-check {
  position: relative;
  display: block;
  margin-bottom: 0.75rem;
}
.form-check + .form-check {
  margin-top: -0.25rem;
}
.form-check.disabled .form-check-label {
  color: #888888;
  cursor: not-allowed;
}

.form-check-label {
  padding-left: 1.25rem;
  margin-bottom: 0;
  cursor: pointer;
}

.form-check-input {
  position: absolute;
  margin-top: 0.25rem;
  margin-left: -1.25rem;
}
.form-check-input:only-child {
  position: static;
}

.form-check-inline {
  position: relative;
  display: inline-block;
  padding-left: 1.25rem;
  margin-bottom: 0;
  vertical-align: middle;
  cursor: pointer;
}
.form-check-inline + .form-check-inline {
  margin-left: 0.75rem;
}
.form-check-inline.disabled {
  color: #888888;
  cursor: not-allowed;
}

.form-control-feedback {
  margin-top: 0.25rem;
}

.form-control-success,
.form-control-warning,
.form-control-danger {
  padding-right: 2.25rem;
  background-repeat: no-repeat;
  background-position: center right 0.625rem;
  background-size: 1.25rem 1.25rem;
}

.has-success .form-control-feedback,
.has-success .form-control-label,
.has-success .form-check-label,
.has-success .form-check-inline,
.has-success .custom-control {
  color: #47d165;
}
.has-success .form-control {
  border-color: #47d165;
}
.has-success .input-group-addon {
  color: #47d165;
  border-color: #47d165;
  background-color: #eafaee;
}
.has-success .form-control-success {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#47d165' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3E%3C/svg%3E\");
}

.has-warning .form-control-feedback,
.has-warning .form-control-label,
.has-warning .form-check-label,
.has-warning .form-check-inline,
.has-warning .custom-control {
  color: #ff754b;
}
.has-warning .form-control {
  border-color: #ff754b;
}
.has-warning .input-group-addon {
  color: #ff754b;
  border-color: #ff754b;
  background-color: white;
}
.has-warning .form-control-warning {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#ff754b' d='M4.4 5.324h-.8v-2.46h.8zm0 1.42h-.8V5.89h.8zM3.76.63L.04 7.075c-.115.2.016.425.26.426h7.397c.242 0 .372-.226.258-.426C6.726 4.924 5.47 2.79 4.253.63c-.113-.174-.39-.174-.494 0z'/%3E%3C/svg%3E\");
}

.has-danger .form-control-feedback,
.has-danger .form-control-label,
.has-danger .form-check-label,
.has-danger .form-check-inline,
.has-danger .custom-control {
  color: #ff3160;
}
.has-danger .form-control {
  border-color: #ff3160;
}
.has-danger .input-group-addon {
  color: #ff3160;
  border-color: #ff3160;
  background-color: #fffdfd;
}
.has-danger .form-control-danger {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='#ff3160' viewBox='-2 -2 7 7'%3E%3Cpath stroke='%23d9534f' d='M0 0l3 3m0-3L0 3'/%3E%3Ccircle r='.5'/%3E%3Ccircle cx='3' r='.5'/%3E%3Ccircle cy='3' r='.5'/%3E%3Ccircle cx='3' cy='3' r='.5'/%3E%3C/svg%3E\");
}

@media (min-width: 576px) {
  .form-inline .form-group {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
  }
  .form-inline .form-control-static {
    display: inline-block;
  }
  .form-inline .input-group {
    display: inline-table;
    width: auto;
    vertical-align: middle;
  }
  .form-inline .input-group .input-group-addon,
.form-inline .input-group .input-group-btn,
.form-inline .input-group .form-control {
    width: auto;
  }
  .form-inline .input-group > .form-control {
    width: 100%;
  }
  .form-inline .form-control-label {
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-check {
    display: inline-block;
    margin-top: 0;
    margin-bottom: 0;
    vertical-align: middle;
  }
  .form-inline .form-check-label {
    padding-left: 0;
  }
  .form-inline .form-check-input {
    position: relative;
    margin-left: 0;
  }
  .form-inline .has-feedback .form-control-feedback {
    top: 0;
  }
}

.btn {
  display: inline-block;
  font-weight: normal;
  line-height: 1.25;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  border: 1px solid transparent;
  padding: 0.5rem 1rem;
  font-size: 1rem;
  border-radius: 0.1rem;
}
.btn:focus, .btn.focus, .btn:active:focus, .btn:active.focus, .btn.active:focus, .btn.active.focus {
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn:focus, .btn:hover {
  text-decoration: none;
}
.btn.focus {
  text-decoration: none;
}
.btn:active, .btn.active {
  background-image: none;
  outline: 0;
}
.btn.disabled, .btn:disabled {
  cursor: not-allowed;
  opacity: 0.65;
}

a.btn.disabled,
fieldset[disabled] a.btn {
  pointer-events: none;
}

.btn-primary {
  color: #fff !important;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-primary:hover {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
}
.btn-primary:focus, .btn-primary.focus {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
}
.btn-primary:active, .btn-primary.active, .open > .btn-primary.dropdown-toggle {
  color: #fff !important;
  background-color: #891696;
  border-color: #81148d;
  background-image: none;
}
.btn-primary:active:hover, .btn-primary:active:focus, .btn-primary:active.focus, .btn-primary.active:hover, .btn-primary.active:focus, .btn-primary.active.focus, .open > .btn-primary.dropdown-toggle:hover, .open > .btn-primary.dropdown-toggle:focus, .open > .btn-primary.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #6d1177;
  border-color: #4c0c54;
}
.btn-primary.disabled:focus, .btn-primary.disabled.focus, .btn-primary:disabled:focus, .btn-primary:disabled.focus {
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-primary.disabled:hover, .btn-primary:disabled:hover {
  background-color: #b21cc3;
  border-color: #b21cc3;
}

.btn-secondary {
  color: #373a3c !important;
  background-color: #fff;
  border-color: #ccc;
}
.btn-secondary:hover {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-secondary:focus, .btn-secondary.focus {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-secondary:active, .btn-secondary.active, .open > .btn-secondary.dropdown-toggle {
  color: #373a3c !important;
  background-color: #e6e6e6;
  border-color: #adadad;
  background-image: none;
}
.btn-secondary:active:hover, .btn-secondary:active:focus, .btn-secondary:active.focus, .btn-secondary.active:hover, .btn-secondary.active:focus, .btn-secondary.active.focus, .open > .btn-secondary.dropdown-toggle:hover, .open > .btn-secondary.dropdown-toggle:focus, .open > .btn-secondary.dropdown-toggle.focus {
  color: #373a3c !important;
  background-color: #d4d4d4;
  border-color: #8c8c8c;
}
.btn-secondary.disabled:focus, .btn-secondary.disabled.focus, .btn-secondary:disabled:focus, .btn-secondary:disabled.focus {
  background-color: #fff;
  border-color: #ccc;
}
.btn-secondary.disabled:hover, .btn-secondary:disabled:hover {
  background-color: #fff;
  border-color: #ccc;
}

.btn-info {
  color: #fff !important;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-info:hover {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
}
.btn-info:focus, .btn-info.focus {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
}
.btn-info:active, .btn-info.active, .open > .btn-info.dropdown-toggle {
  color: #fff !important;
  background-color: #089ccc;
  border-color: #0795c2;
  background-image: none;
}
.btn-info:active:hover, .btn-info:active:focus, .btn-info:active.focus, .btn-info.active:hover, .btn-info.active:focus, .btn-info.active.focus, .open > .btn-info.dropdown-toggle:hover, .open > .btn-info.dropdown-toggle:focus, .open > .btn-info.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #0682aa;
  border-color: #056483;
}
.btn-info.disabled:focus, .btn-info.disabled.focus, .btn-info:disabled:focus, .btn-info:disabled.focus {
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-info.disabled:hover, .btn-info:disabled:hover {
  background-color: #11bef6;
  border-color: #11bef6;
}

.btn-success {
  color: #fff !important;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-success:hover {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
}
.btn-success:focus, .btn-success.focus {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
}
.btn-success:active, .btn-success.active, .open > .btn-success.dropdown-toggle {
  color: #fff !important;
  background-color: #2eb74c;
  border-color: #2caf48;
  background-image: none;
}
.btn-success:active:hover, .btn-success:active:focus, .btn-success:active.focus, .btn-success.active:hover, .btn-success.active:focus, .btn-success.active.focus, .open > .btn-success.dropdown-toggle:hover, .open > .btn-success.dropdown-toggle:focus, .open > .btn-success.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #279b40;
  border-color: #1f7a32;
}
.btn-success.disabled:focus, .btn-success.disabled.focus, .btn-success:disabled:focus, .btn-success:disabled.focus {
  background-color: #47d165;
  border-color: #47d165;
}
.btn-success.disabled:hover, .btn-success:disabled:hover {
  background-color: #47d165;
  border-color: #47d165;
}

.btn-warning {
  color: #fff !important;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-warning:hover {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
}
.btn-warning:focus, .btn-warning.focus {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
}
.btn-warning:active, .btn-warning.active, .open > .btn-warning.dropdown-toggle {
  color: #fff !important;
  background-color: #ff4e18;
  border-color: #ff460e;
  background-image: none;
}
.btn-warning:active:hover, .btn-warning:active:focus, .btn-warning:active.focus, .btn-warning.active:hover, .btn-warning.active:focus, .btn-warning.active.focus, .open > .btn-warning.dropdown-toggle:hover, .open > .btn-warning.dropdown-toggle:focus, .open > .btn-warning.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #f33900;
  border-color: #cb2f00;
}
.btn-warning.disabled:focus, .btn-warning.disabled.focus, .btn-warning:disabled:focus, .btn-warning:disabled.focus {
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-warning.disabled:hover, .btn-warning:disabled:hover {
  background-color: #ff754b;
  border-color: #ff754b;
}

.btn-danger {
  color: #fff !important;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-danger:hover {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
}
.btn-danger:focus, .btn-danger.focus {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
}
.btn-danger:active, .btn-danger.active, .open > .btn-danger.dropdown-toggle {
  color: #fff !important;
  background-color: #fd003a;
  border-color: #f30037;
  background-image: none;
}
.btn-danger:active:hover, .btn-danger:active:focus, .btn-danger:active.focus, .btn-danger.active:hover, .btn-danger.active:focus, .btn-danger.active.focus, .open > .btn-danger.dropdown-toggle:hover, .open > .btn-danger.dropdown-toggle:focus, .open > .btn-danger.dropdown-toggle.focus {
  color: #fff !important;
  background-color: #d90032;
  border-color: #b10028;
}
.btn-danger.disabled:focus, .btn-danger.disabled.focus, .btn-danger:disabled:focus, .btn-danger:disabled.focus {
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-danger.disabled:hover, .btn-danger:disabled:hover {
  background-color: #ff3160;
  border-color: #ff3160;
}

.btn-outline-primary {
  color: #b21cc3;
  background-image: none;
  background-color: transparent;
  border-color: #b21cc3;
}
.btn-outline-primary:hover {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:focus, .btn-outline-primary.focus {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:active, .btn-outline-primary.active, .open > .btn-outline-primary.dropdown-toggle {
  color: #fff;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.btn-outline-primary:active:hover, .btn-outline-primary:active:focus, .btn-outline-primary:active.focus, .btn-outline-primary.active:hover, .btn-outline-primary.active:focus, .btn-outline-primary.active.focus, .open > .btn-outline-primary.dropdown-toggle:hover, .open > .btn-outline-primary.dropdown-toggle:focus, .open > .btn-outline-primary.dropdown-toggle.focus {
  color: #fff;
  background-color: #6d1177;
  border-color: #4c0c54;
}
.btn-outline-primary.disabled:focus, .btn-outline-primary.disabled.focus, .btn-outline-primary:disabled:focus, .btn-outline-primary:disabled.focus {
  border-color: #da5de8;
}
.btn-outline-primary.disabled:hover, .btn-outline-primary:disabled:hover {
  border-color: #da5de8;
}

.btn-outline-secondary {
  color: #ccc;
  background-image: none;
  background-color: transparent;
  border-color: #ccc;
}
.btn-outline-secondary:hover {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:focus, .btn-outline-secondary.focus {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:active, .btn-outline-secondary.active, .open > .btn-outline-secondary.dropdown-toggle {
  color: #fff;
  background-color: #ccc;
  border-color: #ccc;
}
.btn-outline-secondary:active:hover, .btn-outline-secondary:active:focus, .btn-outline-secondary:active.focus, .btn-outline-secondary.active:hover, .btn-outline-secondary.active:focus, .btn-outline-secondary.active.focus, .open > .btn-outline-secondary.dropdown-toggle:hover, .open > .btn-outline-secondary.dropdown-toggle:focus, .open > .btn-outline-secondary.dropdown-toggle.focus {
  color: #fff;
  background-color: #a1a1a1;
  border-color: #8c8c8c;
}
.btn-outline-secondary.disabled:focus, .btn-outline-secondary.disabled.focus, .btn-outline-secondary:disabled:focus, .btn-outline-secondary:disabled.focus {
  border-color: white;
}
.btn-outline-secondary.disabled:hover, .btn-outline-secondary:disabled:hover {
  border-color: white;
}

.btn-outline-info {
  color: #11bef6;
  background-image: none;
  background-color: transparent;
  border-color: #11bef6;
}
.btn-outline-info:hover {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:focus, .btn-outline-info.focus {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:active, .btn-outline-info.active, .open > .btn-outline-info.dropdown-toggle {
  color: #fff;
  background-color: #11bef6;
  border-color: #11bef6;
}
.btn-outline-info:active:hover, .btn-outline-info:active:focus, .btn-outline-info:active.focus, .btn-outline-info.active:hover, .btn-outline-info.active:focus, .btn-outline-info.active.focus, .open > .btn-outline-info.dropdown-toggle:hover, .open > .btn-outline-info.dropdown-toggle:focus, .open > .btn-outline-info.dropdown-toggle.focus {
  color: #fff;
  background-color: #0682aa;
  border-color: #056483;
}
.btn-outline-info.disabled:focus, .btn-outline-info.disabled.focus, .btn-outline-info:disabled:focus, .btn-outline-info:disabled.focus {
  border-color: #73d9fa;
}
.btn-outline-info.disabled:hover, .btn-outline-info:disabled:hover {
  border-color: #73d9fa;
}

.btn-outline-success {
  color: #47d165;
  background-image: none;
  background-color: transparent;
  border-color: #47d165;
}
.btn-outline-success:hover {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:focus, .btn-outline-success.focus {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:active, .btn-outline-success.active, .open > .btn-outline-success.dropdown-toggle {
  color: #fff;
  background-color: #47d165;
  border-color: #47d165;
}
.btn-outline-success:active:hover, .btn-outline-success:active:focus, .btn-outline-success:active.focus, .btn-outline-success.active:hover, .btn-outline-success.active:focus, .btn-outline-success.active.focus, .open > .btn-outline-success.dropdown-toggle:hover, .open > .btn-outline-success.dropdown-toggle:focus, .open > .btn-outline-success.dropdown-toggle.focus {
  color: #fff;
  background-color: #279b40;
  border-color: #1f7a32;
}
.btn-outline-success.disabled:focus, .btn-outline-success.disabled.focus, .btn-outline-success:disabled:focus, .btn-outline-success:disabled.focus {
  border-color: #99e5a9;
}
.btn-outline-success.disabled:hover, .btn-outline-success:disabled:hover {
  border-color: #99e5a9;
}

.btn-outline-warning {
  color: #ff754b;
  background-image: none;
  background-color: transparent;
  border-color: #ff754b;
}
.btn-outline-warning:hover {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:focus, .btn-outline-warning.focus {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:active, .btn-outline-warning.active, .open > .btn-outline-warning.dropdown-toggle {
  color: #fff;
  background-color: #ff754b;
  border-color: #ff754b;
}
.btn-outline-warning:active:hover, .btn-outline-warning:active:focus, .btn-outline-warning:active.focus, .btn-outline-warning.active:hover, .btn-outline-warning.active:focus, .btn-outline-warning.active.focus, .open > .btn-outline-warning.dropdown-toggle:hover, .open > .btn-outline-warning.dropdown-toggle:focus, .open > .btn-outline-warning.dropdown-toggle.focus {
  color: #fff;
  background-color: #f33900;
  border-color: #cb2f00;
}
.btn-outline-warning.disabled:focus, .btn-outline-warning.disabled.focus, .btn-outline-warning:disabled:focus, .btn-outline-warning:disabled.focus {
  border-color: #ffc3b1;
}
.btn-outline-warning.disabled:hover, .btn-outline-warning:disabled:hover {
  border-color: #ffc3b1;
}

.btn-outline-danger {
  color: #ff3160;
  background-image: none;
  background-color: transparent;
  border-color: #ff3160;
}
.btn-outline-danger:hover {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:focus, .btn-outline-danger.focus {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:active, .btn-outline-danger.active, .open > .btn-outline-danger.dropdown-toggle {
  color: #fff;
  background-color: #ff3160;
  border-color: #ff3160;
}
.btn-outline-danger:active:hover, .btn-outline-danger:active:focus, .btn-outline-danger:active.focus, .btn-outline-danger.active:hover, .btn-outline-danger.active:focus, .btn-outline-danger.active.focus, .open > .btn-outline-danger.dropdown-toggle:hover, .open > .btn-outline-danger.dropdown-toggle:focus, .open > .btn-outline-danger.dropdown-toggle.focus {
  color: #fff;
  background-color: #d90032;
  border-color: #b10028;
}
.btn-outline-danger.disabled:focus, .btn-outline-danger.disabled.focus, .btn-outline-danger:disabled:focus, .btn-outline-danger:disabled.focus {
  border-color: #ff97af;
}
.btn-outline-danger.disabled:hover, .btn-outline-danger:disabled:hover {
  border-color: #ff97af;
}

.btn-link {
  font-weight: normal;
  color: #373a3c;
  border-radius: 0;
}
.btn-link, .btn-link:active, .btn-link.active, .btn-link:disabled {
  background-color: transparent;
}
.btn-link, .btn-link:focus, .btn-link:active {
  border-color: transparent;
}
.btn-link:hover {
  border-color: transparent;
}
.btn-link:focus, .btn-link:hover {
  color: #121314;
  text-decoration: none;
  background-color: transparent;
}
.btn-link:disabled:focus, .btn-link:disabled:hover {
  color: #888888;
  text-decoration: none;
}

.btn-lg, .btn-group-lg > .btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.1rem;
}

.btn-sm, .btn-group-sm > .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}

.btn-block {
  display: block;
  width: 100%;
}

.btn-block + .btn-block {
  margin-top: 0.5rem;
}

input[type=submit].btn-block,
input[type=reset].btn-block,
input[type=button].btn-block {
  width: 100%;
}

.fade {
  opacity: 0;
  transition: opacity 0.15s linear;
}
.fade.in {
  opacity: 1;
}

.collapse {
  display: none;
}
.collapse.in {
  display: block;
}

tr.collapse.in {
  display: table-row;
}

tbody.collapse.in {
  display: table-row-group;
}

.collapsing {
  position: relative;
  height: 0;
  overflow: hidden;
  transition-timing-function: ease;
  transition-duration: 0.35s;
  transition-property: height;
}

.dropup,
.dropdown {
  position: relative;
}

.dropdown-toggle::after {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 0.3em;
  vertical-align: middle;
  content: \"\";
  border-top: 0.3em solid;
  border-right: 0.3em solid transparent;
  border-left: 0.3em solid transparent;
}
.dropdown-toggle:focus {
  outline: 0;
}

.dropup .dropdown-toggle::after {
  border-top: 0;
  border-bottom: 0.3em solid;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #373a3c;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.17rem;
}

.dropdown-divider {
  height: 1px;
  margin: 0.5rem 0;
  overflow: hidden;
  background-color: #e5e5e5;
}

.dropdown-item {
  display: block;
  width: 100%;
  padding: 3px 1.5rem;
  clear: both;
  font-weight: normal;
  color: #55595c;
  text-align: inherit;
  white-space: nowrap;
  background: none;
  border: 0;
}
.dropdown-item:focus, .dropdown-item:hover {
  color: #494c4f;
  text-decoration: none;
  background-color: #f5f5f5;
}
.dropdown-item.active, .dropdown-item.active:focus, .dropdown-item.active:hover {
  color: #212121;
  text-decoration: none;
  background-color: #f5f5f5;
  outline: 0;
}
.dropdown-item.disabled, .dropdown-item.disabled:focus, .dropdown-item.disabled:hover {
  color: #888888;
}
.dropdown-item.disabled:focus, .dropdown-item.disabled:hover {
  text-decoration: none;
  cursor: not-allowed;
  background-color: transparent;
  background-image: none;
  filter: \"progid:DXImageTransform.Microsoft.gradient(enabled = false)\";
}

.open > .dropdown-menu {
  display: block;
}
.open > a {
  outline: 0;
}

.dropdown-menu-right {
  right: 0;
  left: auto;
}

.dropdown-menu-left {
  right: auto;
  left: 0;
}

.dropdown-header {
  display: block;
  padding: 0.5rem 1.5rem;
  margin-bottom: 0;
  font-size: 0.875rem;
  color: #888888;
  white-space: nowrap;
}

.dropdown-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 990;
}

.dropup .caret,
.navbar-fixed-bottom .dropdown .caret {
  content: \"\";
  border-top: 0;
  border-bottom: 0.3em solid;
}
.dropup .dropdown-menu,
.navbar-fixed-bottom .dropdown .dropdown-menu {
  top: auto;
  bottom: 100%;
  margin-bottom: 0.125rem;
}

.btn-group,
.btn-group-vertical {
  position: relative;
  display: inline-block;
  vertical-align: middle;
}
.btn-group > .btn,
.btn-group-vertical > .btn {
  position: relative;
  float: left;
  margin-bottom: 0;
}
.btn-group > .btn:focus, .btn-group > .btn:active, .btn-group > .btn.active,
.btn-group-vertical > .btn:focus,
.btn-group-vertical > .btn:active,
.btn-group-vertical > .btn.active {
  z-index: 2;
}
.btn-group > .btn:hover,
.btn-group-vertical > .btn:hover {
  z-index: 2;
}

.btn-group .btn + .btn,
.btn-group .btn + .btn-group,
.btn-group .btn-group + .btn,
.btn-group .btn-group + .btn-group {
  margin-left: -1px;
}

.btn-toolbar {
  margin-left: -0.5rem;
}
.btn-toolbar::after {
  content: \"\";
  display: table;
  clear: both;
}
.btn-toolbar .btn-group,
.btn-toolbar .input-group {
  float: left;
}
.btn-toolbar > .btn,
.btn-toolbar > .btn-group,
.btn-toolbar > .input-group {
  margin-left: 0.5rem;
}

.btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
  border-radius: 0;
}

.btn-group > .btn:first-child {
  margin-left: 0;
}
.btn-group > .btn:first-child:not(:last-child):not(.dropdown-toggle) {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.btn-group > .btn:last-child:not(:first-child),
.btn-group > .dropdown-toggle:not(:first-child) {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.btn-group > .btn-group {
  float: left;
}

.btn-group > .btn-group:not(:first-child):not(:last-child) > .btn {
  border-radius: 0;
}

.btn-group > .btn-group:first-child:not(:last-child) > .btn:last-child,
.btn-group > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.btn-group > .btn-group:last-child:not(:first-child) > .btn:first-child {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.btn-group .dropdown-toggle:active,
.btn-group.open .dropdown-toggle {
  outline: 0;
}

.btn + .dropdown-toggle-split {
  padding-right: 0.75rem;
  padding-left: 0.75rem;
}
.btn + .dropdown-toggle-split::after {
  margin-left: 0;
}

.btn-sm + .dropdown-toggle-split, .btn-group-sm > .btn + .dropdown-toggle-split {
  padding-right: 0.375rem;
  padding-left: 0.375rem;
}

.btn-lg + .dropdown-toggle-split, .btn-group-lg > .btn + .dropdown-toggle-split {
  padding-right: 1.125rem;
  padding-left: 1.125rem;
}

.btn .caret {
  margin-left: 0;
}

.btn-lg .caret, .btn-group-lg > .btn .caret {
  border-width: 0.3em 0.3em 0;
  border-bottom-width: 0;
}

.dropup .btn-lg .caret, .dropup .btn-group-lg > .btn .caret {
  border-width: 0 0.3em 0.3em;
}

.btn-group-vertical > .btn,
.btn-group-vertical > .btn-group,
.btn-group-vertical > .btn-group > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
}
.btn-group-vertical > .btn-group::after {
  content: \"\";
  display: table;
  clear: both;
}
.btn-group-vertical > .btn-group > .btn {
  float: none;
}
.btn-group-vertical > .btn + .btn,
.btn-group-vertical > .btn + .btn-group,
.btn-group-vertical > .btn-group + .btn,
.btn-group-vertical > .btn-group + .btn-group {
  margin-top: -1px;
  margin-left: 0;
}

.btn-group-vertical > .btn:not(:first-child):not(:last-child) {
  border-radius: 0;
}
.btn-group-vertical > .btn:first-child:not(:last-child) {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.btn-group-vertical > .btn:last-child:not(:first-child) {
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

.btn-group-vertical > .btn-group:not(:first-child):not(:last-child) > .btn {
  border-radius: 0;
}

.btn-group-vertical > .btn-group:first-child:not(:last-child) > .btn:last-child,
.btn-group-vertical > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.btn-group-vertical > .btn-group:last-child:not(:first-child) > .btn:first-child {
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

[data-toggle=buttons] > .btn input[type=radio],
[data-toggle=buttons] > .btn input[type=checkbox],
[data-toggle=buttons] > .btn-group > .btn input[type=radio],
[data-toggle=buttons] > .btn-group > .btn input[type=checkbox] {
  position: absolute;
  clip: rect(0, 0, 0, 0);
  pointer-events: none;
}

.input-group {
  position: relative;
  width: 100%;
  display: flex;
}
.input-group .form-control {
  position: relative;
  z-index: 2;
  flex: 1;
  margin-bottom: 0;
}
.input-group .form-control:focus, .input-group .form-control:active, .input-group .form-control:hover {
  z-index: 3;
}

.input-group-addon:not(:first-child):not(:last-child),
.input-group-btn:not(:first-child):not(:last-child),
.input-group .form-control:not(:first-child):not(:last-child) {
  border-radius: 0;
}

.input-group-addon,
.input-group-btn {
  white-space: nowrap;
  vertical-align: middle;
}

.input-group-addon {
  padding: 0.5rem 0.75rem;
  margin-bottom: 0;
  font-size: 1rem;
  font-weight: normal;
  line-height: 1.25;
  color: #55595c;
  text-align: center;
  background-color: #eceeef;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
}
.input-group-addon.form-control-sm,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .input-group-addon.btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  border-radius: 0.1rem;
}
.input-group-addon.form-control-lg,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .input-group-addon.btn {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  border-radius: 0.25rem;
}
.input-group-addon input[type=radio],
.input-group-addon input[type=checkbox] {
  margin-top: 0;
}

.input-group .form-control:not(:last-child),
.input-group-addon:not(:last-child),
.input-group-btn:not(:last-child) > .btn,
.input-group-btn:not(:last-child) > .btn-group > .btn,
.input-group-btn:not(:last-child) > .dropdown-toggle,
.input-group-btn:not(:first-child) > .btn:not(:last-child):not(.dropdown-toggle),
.input-group-btn:not(:first-child) > .btn-group:not(:last-child) > .btn {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.input-group-addon:not(:last-child) {
  border-right: 0;
}

.input-group .form-control:not(:first-child),
.input-group-addon:not(:first-child),
.input-group-btn:not(:first-child) > .btn,
.input-group-btn:not(:first-child) > .btn-group > .btn,
.input-group-btn:not(:first-child) > .dropdown-toggle,
.input-group-btn:not(:last-child) > .btn:not(:first-child),
.input-group-btn:not(:last-child) > .btn-group:not(:first-child) > .btn {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.form-control + .input-group-addon:not(:first-child) {
  border-left: 0;
}

.input-group-btn {
  position: relative;
  font-size: 0;
  white-space: nowrap;
}
.input-group-btn > .btn {
  position: relative;
}
.input-group-btn > .btn + .btn {
  margin-left: -1px;
}
.input-group-btn > .btn:focus, .input-group-btn > .btn:active, .input-group-btn > .btn:hover {
  z-index: 3;
}
.input-group-btn:not(:last-child) > .btn,
.input-group-btn:not(:last-child) > .btn-group {
  margin-right: -1px;
}
.input-group-btn:not(:first-child) > .btn,
.input-group-btn:not(:first-child) > .btn-group {
  z-index: 2;
  margin-left: -1px;
}
.input-group-btn:not(:first-child) > .btn:focus, .input-group-btn:not(:first-child) > .btn:active, .input-group-btn:not(:first-child) > .btn:hover,
.input-group-btn:not(:first-child) > .btn-group:focus,
.input-group-btn:not(:first-child) > .btn-group:active,
.input-group-btn:not(:first-child) > .btn-group:hover {
  z-index: 3;
}

.custom-control {
  position: relative;
  display: inline-block;
  padding-left: 1.5rem;
  cursor: pointer;
}
.custom-control + .custom-control {
  margin-left: 1rem;
}

.custom-control-input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.custom-control-input:checked ~ .custom-control-indicator {
  color: #fff;
  background-color: #0074d9;
}
.custom-control-input:focus ~ .custom-control-indicator {
  box-shadow: 0 0 0 0.075rem #fff, 0 0 0 0.2rem #0074d9;
}
.custom-control-input:active ~ .custom-control-indicator {
  color: #fff;
  background-color: #84c6ff;
}
.custom-control-input:disabled ~ .custom-control-indicator {
  cursor: not-allowed;
  background-color: #eee;
}
.custom-control-input:disabled ~ .custom-control-description {
  color: #767676;
  cursor: not-allowed;
}

.custom-control-indicator {
  position: absolute;
  top: 0.25rem;
  left: 0;
  display: block;
  width: 1rem;
  height: 1rem;
  pointer-events: none;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-color: #ddd;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 50% 50%;
}

.custom-checkbox .custom-control-indicator {
  border-radius: 0.17rem;
}
.custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='#fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E\");
}
.custom-checkbox .custom-control-input:indeterminate ~ .custom-control-indicator {
  background-color: #0074d9;
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3E%3Cpath stroke='#fff' d='M0 2h4'/%3E%3C/svg%3E\");
}

.custom-radio .custom-control-indicator {
  border-radius: 50%;
}
.custom-radio .custom-control-input:checked ~ .custom-control-indicator {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='#fff'/%3E%3C/svg%3E\");
}

.custom-controls-stacked .custom-control {
  float: left;
  clear: left;
}
.custom-controls-stacked .custom-control + .custom-control {
  margin-left: 0;
}

.custom-select {
  display: inline-block;
  max-width: 100%;
  height: calc(2.5rem - 2px);
  padding: 0.375rem 1.75rem 0.375rem 0.75rem;
  padding-right: 0.75rem \\9 ;
  color: #55595c;
  vertical-align: middle;
  background: #fff url(\"data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='#333' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E\") no-repeat right 0.75rem center;
  background-image: none \\9 ;
  background-size: 8px 10px;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.1rem;
  -moz-appearance: none;
  -webkit-appearance: none;
}
.custom-select:focus {
  border-color: #51a7e8;
  outline: none;
}
.custom-select:focus::-ms-value {
  color: #55595c;
  background-color: #fff;
}
.custom-select:disabled {
  color: #888888;
  cursor: not-allowed;
  background-color: #eceeef;
}
.custom-select::-ms-expand {
  opacity: 0;
}

.custom-select-sm {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  font-size: 75%;
}

.custom-file {
  position: relative;
  display: inline-block;
  max-width: 100%;
  height: 2.5rem;
  cursor: pointer;
}

.custom-file-input {
  min-width: 14rem;
  max-width: 100%;
  margin: 0;
  filter: alpha(opacity=0);
  opacity: 0;
}
.custom-file-control {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  z-index: 5;
  height: 2.5rem;
  padding: 0.5rem 1rem;
  line-height: 1.5;
  color: #555;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.17rem;
}
.custom-file-control:lang(en)::after {
  content: \"Choose file...\";
}
.custom-file-control::before {
  position: absolute;
  top: -1px;
  right: -1px;
  bottom: -1px;
  z-index: 6;
  display: block;
  height: 2.5rem;
  padding: 0.5rem 1rem;
  line-height: 1.5;
  color: #555;
  background-color: #eee;
  border: 1px solid #ddd;
  border-radius: 0 0.17rem 0.17rem 0;
}
.custom-file-control:lang(en)::before {
  content: \"Browse\";
}

.nav {
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}

.nav-link {
  display: inline-block;
}
.nav-link:focus, .nav-link:hover {
  text-decoration: none;
}
.nav-link.disabled {
  color: #888888;
}
.nav-link.disabled, .nav-link.disabled:focus, .nav-link.disabled:hover {
  color: #888888;
  cursor: not-allowed;
  background-color: transparent;
}

.nav-inline .nav-item {
  display: inline-block;
}
.nav-inline .nav-item + .nav-item,
.nav-inline .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-tabs {
  border-bottom: 0 solid transparent;
}
.nav-tabs::after {
  content: \"\";
  display: table;
  clear: both;
}
.nav-tabs .nav-item {
  float: left;
  margin-bottom: 0;
}
.nav-tabs .nav-item + .nav-item {
  margin-left: 0.2rem;
}
.nav-tabs .nav-link {
  display: block;
  padding: 0.5em 1em;
  border: 0 solid transparent;
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
  border-color: transparent transparent transparent;
}
.nav-tabs .nav-link.disabled, .nav-tabs .nav-link.disabled:focus, .nav-tabs .nav-link.disabled:hover {
  color: #888888;
  background-color: transparent;
  border-color: transparent;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover,
.nav-tabs .nav-item.open .nav-link,
.nav-tabs .nav-item.open .nav-link:focus,
.nav-tabs .nav-item.open .nav-link:hover {
  color: #55595c;
  background-color: #fff;
  border-color: #ddd #ddd transparent;
}
.nav-tabs .dropdown-menu {
  margin-top: 0;
  border-top-right-radius: 0;
  border-top-left-radius: 0;
}

.nav-pills::after {
  content: \"\";
  display: table;
  clear: both;
}
.nav-pills .nav-item {
  float: left;
}
.nav-pills .nav-item + .nav-item {
  margin-left: 0.2rem;
}
.nav-pills .nav-link {
  display: block;
  padding: 0.5em 1em;
  border-radius: 0.17rem;
}
.nav-pills .nav-link.active, .nav-pills .nav-link.active:focus, .nav-pills .nav-link.active:hover,
.nav-pills .nav-item.open .nav-link,
.nav-pills .nav-item.open .nav-link:focus,
.nav-pills .nav-item.open .nav-link:hover {
  color: #fff;
  cursor: default;
  background-color: #eceeef;
}

.nav-stacked .nav-item {
  display: block;
  float: none;
}
.nav-stacked .nav-item + .nav-item {
  margin-top: 0.2rem;
  margin-left: 0;
}

.tab-content > .tab-pane {
  display: none;
}
.tab-content > .active {
  display: block;
}

.navbar {
  position: relative;
  padding: 0.5rem 1rem;
}
.navbar::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (min-width: 576px) {
  .navbar {
    border-radius: 0.17rem;
  }
}

.navbar-full {
  z-index: 1000;
}
@media (min-width: 576px) {
  .navbar-full {
    border-radius: 0;
  }
}

.navbar-fixed-top,
.navbar-fixed-bottom {
  position: fixed;
  right: 0;
  left: 0;
  z-index: 1030;
}
@media (min-width: 576px) {
  .navbar-fixed-top,
.navbar-fixed-bottom {
    border-radius: 0;
  }
}

.navbar-fixed-top {
  top: 0;
}

.navbar-fixed-bottom {
  bottom: 0;
}

.navbar-sticky-top {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1030;
  width: 100%;
}
@media (min-width: 576px) {
  .navbar-sticky-top {
    border-radius: 0;
  }
}

.navbar-brand {
  float: left;
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  margin-right: 1rem;
  font-size: 1.25rem;
  line-height: inherit;
}
.navbar-brand:focus, .navbar-brand:hover {
  text-decoration: none;
}

.navbar-divider {
  float: left;
  width: 1px;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
  margin-right: 1rem;
  margin-left: 1rem;
  overflow: hidden;
}
.navbar-divider::before {
  content: \"\\A0\";
}

.navbar-text {
  display: inline-block;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
}

.navbar-toggler {
  width: 2.5em;
  height: 2em;
  padding: 0.5rem 0.75rem;
  font-size: 1.25rem;
  line-height: 1;
  background: transparent no-repeat center center;
  background-size: 24px 24px;
  border: 1px solid transparent;
  border-radius: 0.1rem;
}
.navbar-toggler:focus, .navbar-toggler:hover {
  text-decoration: none;
}

.navbar-toggleable-xs::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 575px) {
  .navbar-toggleable-xs .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-xs .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-xs .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 576px) {
  .navbar-toggleable-xs {
    display: block;
  }
}
.navbar-toggleable-sm::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 767px) {
  .navbar-toggleable-sm .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-sm .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-sm .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 768px) {
  .navbar-toggleable-sm {
    display: block;
  }
}
.navbar-toggleable-md::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 991px) {
  .navbar-toggleable-md .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-md .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-md .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 992px) {
  .navbar-toggleable-md {
    display: block;
  }
}
.navbar-toggleable-lg::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 1199px) {
  .navbar-toggleable-lg .navbar-brand {
    display: block;
    float: none;
    margin-top: 0.5rem;
    margin-right: 0;
  }
  .navbar-toggleable-lg .navbar-nav {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .navbar-toggleable-lg .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
}
@media (min-width: 1200px) {
  .navbar-toggleable-lg {
    display: block;
  }
}
.navbar-toggleable-xl {
  display: block;
}
.navbar-toggleable-xl::after {
  content: \"\";
  display: table;
  clear: both;
}
.navbar-toggleable-xl .navbar-brand {
  display: block;
  float: none;
  margin-top: 0.5rem;
  margin-right: 0;
}
.navbar-toggleable-xl .navbar-nav {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}
.navbar-toggleable-xl .navbar-nav .dropdown-menu {
  position: static;
  float: none;
}

.navbar-nav .nav-item {
  float: left;
}
.navbar-nav .nav-link {
  display: block;
  padding-top: 0.425rem;
  padding-bottom: 0.425rem;
}
.navbar-nav .nav-link + .nav-link {
  margin-left: 1rem;
}
.navbar-nav .nav-item + .nav-item {
  margin-left: 1rem;
}

.navbar-light .navbar-brand,
.navbar-light .navbar-toggler {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover,
.navbar-light .navbar-toggler:focus,
.navbar-light .navbar-toggler:hover {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-nav .nav-link {
  color: rgba(0, 0, 0, 0.3);
}
.navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
  color: rgba(0, 0, 0, 0.5);
}
.navbar-light .navbar-nav .open > .nav-link, .navbar-light .navbar-nav .open > .nav-link:focus, .navbar-light .navbar-nav .open > .nav-link:hover,
.navbar-light .navbar-nav .active > .nav-link,
.navbar-light .navbar-nav .active > .nav-link:focus,
.navbar-light .navbar-nav .active > .nav-link:hover,
.navbar-light .navbar-nav .nav-link.open,
.navbar-light .navbar-nav .nav-link.open:focus,
.navbar-light .navbar-nav .nav-link.open:hover,
.navbar-light .navbar-nav .nav-link.active,
.navbar-light .navbar-nav .nav-link.active:focus,
.navbar-light .navbar-nav .nav-link.active:hover {
  color: rgba(0, 0, 0, 0.9);
}
.navbar-light .navbar-toggler {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 0, 0, 0.3)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E\");
  border-color: rgba(0, 0, 0, 0.1);
}
.navbar-light .navbar-divider {
  background-color: rgba(0, 0, 0, 0.075);
}

.navbar-dark .navbar-brand,
.navbar-dark .navbar-toggler {
  color: white;
}
.navbar-dark .navbar-brand:focus, .navbar-dark .navbar-brand:hover,
.navbar-dark .navbar-toggler:focus,
.navbar-dark .navbar-toggler:hover {
  color: white;
}
.navbar-dark .navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.5);
}
.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
  color: rgba(255, 255, 255, 0.75);
}
.navbar-dark .navbar-nav .open > .nav-link, .navbar-dark .navbar-nav .open > .nav-link:focus, .navbar-dark .navbar-nav .open > .nav-link:hover,
.navbar-dark .navbar-nav .active > .nav-link,
.navbar-dark .navbar-nav .active > .nav-link:focus,
.navbar-dark .navbar-nav .active > .nav-link:hover,
.navbar-dark .navbar-nav .nav-link.open,
.navbar-dark .navbar-nav .nav-link.open:focus,
.navbar-dark .navbar-nav .nav-link.open:hover,
.navbar-dark .navbar-nav .nav-link.active,
.navbar-dark .navbar-nav .nav-link.active:focus,
.navbar-dark .navbar-nav .nav-link.active:hover {
  color: white;
}
.navbar-dark .navbar-toggler {
  background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E\");
  border-color: rgba(255, 255, 255, 0.1);
}
.navbar-dark .navbar-divider {
  background-color: rgba(255, 255, 255, 0.075);
}

.navbar-toggleable-xs::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 575px) {
  .navbar-toggleable-xs .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 576px) {
  .navbar-toggleable-xs {
    display: block !important;
  }
}
.navbar-toggleable-sm::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 767px) {
  .navbar-toggleable-sm .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 768px) {
  .navbar-toggleable-sm {
    display: block !important;
  }
}
.navbar-toggleable-md::after {
  content: \"\";
  display: table;
  clear: both;
}
@media (max-width: 991px) {
  .navbar-toggleable-md .navbar-nav .nav-item {
    float: none;
    margin-left: 0;
  }
}
@media (min-width: 992px) {
  .navbar-toggleable-md {
    display: block !important;
  }
}

.card {
  position: relative;
  display: block;
  margin-bottom: 0.75rem;
  background-color: #fff;
  border-radius: 0.1rem;
  border: 0 solid rgba(0, 0, 0, 0.125);
}

.card-block {
  padding: 1.25rem;
}
.card-block::after {
  content: \"\";
  display: table;
  clear: both;
}

.card-title {
  margin-bottom: 0.75rem;
}

.card-subtitle {
  margin-top: -0.375rem;
  margin-bottom: 0;
}

.card-text:last-child {
  margin-bottom: 0;
}

.card-link:hover {
  text-decoration: none;
}
.card-link + .card-link {
  margin-left: 1.25rem;
}

.card > .list-group:first-child .list-group-item:first-child {
  border-top-right-radius: 0.1rem;
  border-top-left-radius: 0.1rem;
}
.card > .list-group:last-child .list-group-item:last-child {
  border-bottom-right-radius: 0.1rem;
  border-bottom-left-radius: 0.1rem;
}

.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: #f5f5f5;
  border-bottom: 0 solid rgba(0, 0, 0, 0.125);
}
.card-header::after {
  content: \"\";
  display: table;
  clear: both;
}
.card-header:first-child {
  border-radius: calc(0.1rem - 0) calc(0.1rem - 0) 0 0;
}

.card-footer {
  padding: 0.75rem 1.25rem;
  background-color: #f5f5f5;
  border-top: 0 solid rgba(0, 0, 0, 0.125);
}
.card-footer::after {
  content: \"\";
  display: table;
  clear: both;
}
.card-footer:last-child {
  border-radius: 0 0 calc(0.1rem - 0) calc(0.1rem - 0);
}

.card-header-tabs {
  margin-right: -0.625rem;
  margin-bottom: -0.75rem;
  margin-left: -0.625rem;
  border-bottom: 0;
}

.card-header-pills {
  margin-right: -0.625rem;
  margin-left: -0.625rem;
}

.card-primary {
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.card-primary .card-header,
.card-primary .card-footer {
  background-color: transparent;
}

.card-success {
  background-color: #47d165;
  border-color: #47d165;
}
.card-success .card-header,
.card-success .card-footer {
  background-color: transparent;
}

.card-info {
  background-color: #11bef6;
  border-color: #11bef6;
}
.card-info .card-header,
.card-info .card-footer {
  background-color: transparent;
}

.card-warning {
  background-color: #ff754b;
  border-color: #ff754b;
}
.card-warning .card-header,
.card-warning .card-footer {
  background-color: transparent;
}

.card-danger {
  background-color: #ff3160;
  border-color: #ff3160;
}
.card-danger .card-header,
.card-danger .card-footer {
  background-color: transparent;
}

.card-outline-primary {
  background-color: transparent;
  border-color: #b21cc3;
}

.card-outline-secondary {
  background-color: transparent;
  border-color: #ccc;
}

.card-outline-info {
  background-color: transparent;
  border-color: #11bef6;
}

.card-outline-success {
  background-color: transparent;
  border-color: #47d165;
}

.card-outline-warning {
  background-color: transparent;
  border-color: #ff754b;
}

.card-outline-danger {
  background-color: transparent;
  border-color: #ff3160;
}

.card-inverse .card-header,
.card-inverse .card-footer {
  border-color: rgba(255, 255, 255, 0.2);
}
.card-inverse .card-header,
.card-inverse .card-footer,
.card-inverse .card-title,
.card-inverse .card-blockquote {
  color: #fff;
}
.card-inverse .card-link,
.card-inverse .card-text,
.card-inverse .card-subtitle,
.card-inverse .card-blockquote .blockquote-footer {
  color: rgba(255, 255, 255, 0.65);
}
.card-inverse .card-link:focus, .card-inverse .card-link:hover {
  color: #fff;
}

.card-blockquote {
  padding: 0;
  margin-bottom: 0;
  border-left: 0;
}

.card-img {
  border-radius: calc(0.1rem - 0);
}

.card-img-overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1.25rem;
}

.card-img-top {
  border-top-right-radius: calc(0.1rem - 0);
  border-top-left-radius: calc(0.1rem - 0);
}

.card-img-bottom {
  border-bottom-right-radius: calc(0.1rem - 0);
  border-bottom-left-radius: calc(0.1rem - 0);
}

@media (min-width: 576px) {
  .card-deck {
    display: flex;
    flex-flow: row wrap;
    margin-right: -0.625rem;
    margin-bottom: 0.75rem;
    margin-left: -0.625rem;
  }
  .card-deck .card {
    flex: 1 0 0;
    margin-right: 0.625rem;
    margin-bottom: 0;
    margin-left: 0.625rem;
  }
}
@media (min-width: 576px) {
  .card-group {
    display: flex;
    flex-flow: row wrap;
  }
  .card-group .card {
    flex: 1 0 0;
  }
  .card-group .card + .card {
    margin-left: 0;
    border-left: 0;
  }
  .card-group .card:first-child {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
  }
  .card-group .card:first-child .card-img-top {
    border-top-right-radius: 0;
  }
  .card-group .card:first-child .card-img-bottom {
    border-bottom-right-radius: 0;
  }
  .card-group .card:last-child {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
  }
  .card-group .card:last-child .card-img-top {
    border-top-left-radius: 0;
  }
  .card-group .card:last-child .card-img-bottom {
    border-bottom-left-radius: 0;
  }
  .card-group .card:not(:first-child):not(:last-child) {
    border-radius: 0;
  }
  .card-group .card:not(:first-child):not(:last-child) .card-img-top,
.card-group .card:not(:first-child):not(:last-child) .card-img-bottom {
    border-radius: 0;
  }
}
@media (min-width: 576px) {
  .card-columns {
    -webkit-column-count: 3;
            column-count: 3;
    -webkit-column-gap: 1.25rem;
            column-gap: 1.25rem;
  }
  .card-columns .card {
    display: inline-block;
    width: 100%;
  }
}
.breadcrumb {
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
  list-style: none;
  background-color: #eaeced;
  border-radius: 0.17rem;
}
.breadcrumb::after {
  content: \"\";
  display: table;
  clear: both;
}

.breadcrumb-item {
  float: left;
}
.breadcrumb-item + .breadcrumb-item::before {
  display: inline-block;
  padding-right: 0.5rem;
  padding-left: 0.5rem;
  color: #888888;
  content: \"/\";
}
.breadcrumb-item + .breadcrumb-item:hover::before {
  text-decoration: underline;
}
.breadcrumb-item + .breadcrumb-item:hover::before {
  text-decoration: none;
}
.breadcrumb-item.active {
  color: #bbbbbb;
}

.pagination {
  display: inline-block;
  padding-left: 0;
  margin-top: 1rem;
  margin-bottom: 1rem;
  border-radius: 0.17rem;
}

.page-item {
  display: inline;
}
.page-item:first-child .page-link {
  margin-left: 0;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.page-item:last-child .page-link {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}
.page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
  z-index: 2;
  color: #fff;
  cursor: default;
  background-color: #b21cc3;
  border-color: #b21cc3;
}
.page-item.disabled .page-link, .page-item.disabled .page-link:focus, .page-item.disabled .page-link:hover {
  color: #888888;
  pointer-events: none;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}

.page-link {
  position: relative;
  float: left;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  color: #373a3c;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.page-link:focus, .page-link:hover {
  color: #121314;
  background-color: #eceeef;
  border-color: #ddd;
}

.pagination-lg .page-link {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
}
.pagination-lg .page-item:first-child .page-link {
  border-bottom-left-radius: 0.25rem;
  border-top-left-radius: 0.25rem;
}
.pagination-lg .page-item:last-child .page-link {
  border-bottom-right-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}

.pagination-sm .page-link {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}
.pagination-sm .page-item:first-child .page-link {
  border-bottom-left-radius: 0.1rem;
  border-top-left-radius: 0.1rem;
}
.pagination-sm .page-item:last-child .page-link {
  border-bottom-right-radius: 0.1rem;
  border-top-right-radius: 0.1rem;
}

.tag {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: bold;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.17rem;
}
.tag:empty {
  display: none;
}

.btn .tag {
  position: relative;
  top: -1px;
}

a.tag:focus, a.tag:hover {
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}

.tag-pill {
  padding-right: 0.6em;
  padding-left: 0.6em;
  border-radius: 10rem;
}

.tag-default {
  background-color: #888888;
}
.tag-default[href]:focus, .tag-default[href]:hover {
  background-color: #6f6f6f;
}

.tag-primary {
  background-color: #b21cc3;
}
.tag-primary[href]:focus, .tag-primary[href]:hover {
  background-color: #891696;
}

.tag-success {
  background-color: #47d165;
}
.tag-success[href]:focus, .tag-success[href]:hover {
  background-color: #2eb74c;
}

.tag-info {
  background-color: #11bef6;
}
.tag-info[href]:focus, .tag-info[href]:hover {
  background-color: #089ccc;
}

.tag-warning {
  background-color: #ff754b;
}
.tag-warning[href]:focus, .tag-warning[href]:hover {
  background-color: #ff4e18;
}

.tag-danger {
  background-color: #ff3160;
}
.tag-danger[href]:focus, .tag-danger[href]:hover {
  background-color: #fd003a;
}

.jumbotron {
  padding: 2rem 1rem;
  margin-bottom: 2rem;
  background-color: #eceeef;
  border-radius: 0.25rem;
}
@media (min-width: 576px) {
  .jumbotron {
    padding: 4rem 2rem;
  }
}

.jumbotron-hr {
  border-top-color: #d0d5d8;
}

.jumbotron-fluid {
  padding-right: 0;
  padding-left: 0;
  border-radius: 0;
}

.alert {
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.1rem;
}

.alert-heading {
  color: inherit;
}

.alert-link {
  font-weight: bold;
}

.alert-dismissible {
  padding-right: 2.5rem;
}
.alert-dismissible .close {
  position: relative;
  top: -0.125rem;
  right: -1.25rem;
  color: inherit;
}

.alert-success {
  background-color: #47d165;
  border-color: #47d165;
  color: #ffffff;
}
.alert-success hr {
  border-top-color: #33cc54;
}
.alert-success .alert-link {
  color: #e6e6e6;
}

.alert-info {
  background-color: #11bef6;
  border-color: #11bef6;
  color: #ffffff;
}
.alert-info hr {
  border-top-color: #09afe5;
}
.alert-info .alert-link {
  color: #e6e6e6;
}

.alert-warning {
  background-color: #ff754b;
  border-color: #ff754b;
  color: #ffffff;
}
.alert-warning hr {
  border-top-color: #ff6132;
}
.alert-warning .alert-link {
  color: #e6e6e6;
}

.alert-danger {
  background-color: #ff3160;
  border-color: #ff3160;
  color: #ffffff;
}
.alert-danger hr {
  border-top-color: #ff184c;
}
.alert-danger .alert-link {
  color: #e6e6e6;
}

@-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

@keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}
.progress {
  display: block;
  width: 100%;
  height: 1rem;
  margin-bottom: 1rem;
}

.progress[value] {
  background-color: #cccccc;
  border: 0;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border-radius: 0.17rem;
}

.progress[value]::-ms-fill {
  background-color: #b21cc3;
  border: 0;
}

.progress[value]::-moz-progress-bar {
  background-color: #b21cc3;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.progress[value]::-webkit-progress-value {
  background-color: #b21cc3;
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.progress[value=\"100\"]::-moz-progress-bar {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.progress[value=\"100\"]::-webkit-progress-value {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.progress[value]::-webkit-progress-bar {
  background-color: #cccccc;
  border-radius: 0.17rem;
}

base::-moz-progress-bar,
.progress[value] {
  background-color: #cccccc;
  border-radius: 0.17rem;
}

@media screen and (min-width: 0\\0 ) {
  .progress {
    background-color: #cccccc;
    border-radius: 0.17rem;
  }

  .progress-bar {
    display: inline-block;
    height: 1rem;
    text-indent: -999rem;
    background-color: #b21cc3;
    border-bottom-left-radius: 0.17rem;
    border-top-left-radius: 0.17rem;
  }

  .progress[width=\"100%\"] {
    border-bottom-right-radius: 0.17rem;
    border-top-right-radius: 0.17rem;
  }
}
.progress-striped[value]::-webkit-progress-value {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-striped[value]::-moz-progress-bar {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-striped[value]::-ms-fill {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

@media screen and (min-width: 0\\0 ) {
  .progress-bar-striped {
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
  }
}
.progress-animated[value]::-webkit-progress-value {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
          animation: progress-bar-stripes 2s linear infinite;
}

.progress-animated[value]::-moz-progress-bar {
  animation: progress-bar-stripes 2s linear infinite;
}

@media screen and (min-width: 0\\0 ) {
  .progress-animated .progress-bar-striped {
    -webkit-animation: progress-bar-stripes 2s linear infinite;
            animation: progress-bar-stripes 2s linear infinite;
  }
}
.progress-success[value]::-webkit-progress-value {
  background-color: #47d165;
}
.progress-success[value]::-moz-progress-bar {
  background-color: #47d165;
}
.progress-success[value]::-ms-fill {
  background-color: #47d165;
}
@media screen and (min-width: 0\\0 ) {
  .progress-success .progress-bar {
    background-color: #47d165;
  }
}

.progress-info[value]::-webkit-progress-value {
  background-color: #11bef6;
}
.progress-info[value]::-moz-progress-bar {
  background-color: #11bef6;
}
.progress-info[value]::-ms-fill {
  background-color: #11bef6;
}
@media screen and (min-width: 0\\0 ) {
  .progress-info .progress-bar {
    background-color: #11bef6;
  }
}

.progress-warning[value]::-webkit-progress-value {
  background-color: #ff754b;
}
.progress-warning[value]::-moz-progress-bar {
  background-color: #ff754b;
}
.progress-warning[value]::-ms-fill {
  background-color: #ff754b;
}
@media screen and (min-width: 0\\0 ) {
  .progress-warning .progress-bar {
    background-color: #ff754b;
  }
}

.progress-danger[value]::-webkit-progress-value {
  background-color: #ff3160;
}
.progress-danger[value]::-moz-progress-bar {
  background-color: #ff3160;
}
.progress-danger[value]::-ms-fill {
  background-color: #ff3160;
}
@media screen and (min-width: 0\\0 ) {
  .progress-danger .progress-bar {
    background-color: #ff3160;
  }
}

.media {
  display: flex;
}

.media-body {
  flex: 1;
}

.media-middle {
  align-self: center;
}

.media-bottom {
  align-self: flex-end;
}

.media-object {
  display: block;
}
.media-object.img-thumbnail {
  max-width: none;
}

.media-right {
  padding-left: 10px;
}

.media-left {
  padding-right: 10px;
}

.media-heading {
  margin-top: 0;
  margin-bottom: 5px;
}

.media-list {
  padding-left: 0;
  list-style: none;
}

.list-group {
  padding-left: 0;
  margin-bottom: 0;
}

.list-group-item {
  position: relative;
  display: block;
  padding: 0.75rem 1.25rem;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.list-group-item:first-child {
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}
.list-group-item:last-child {
  margin-bottom: 0;
  border-bottom-right-radius: 0.17rem;
  border-bottom-left-radius: 0.17rem;
}
.list-group-item.disabled, .list-group-item.disabled:focus, .list-group-item.disabled:hover {
  color: #888888;
  cursor: not-allowed;
  background-color: #eceeef;
}
.list-group-item.disabled .list-group-item-heading, .list-group-item.disabled:focus .list-group-item-heading, .list-group-item.disabled:hover .list-group-item-heading {
  color: inherit;
}
.list-group-item.disabled .list-group-item-text, .list-group-item.disabled:focus .list-group-item-text, .list-group-item.disabled:hover .list-group-item-text {
  color: #888888;
}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
  z-index: 2;
  color: #fff;
  text-decoration: none;
  background-color: #11bef6;
  border-color: #11bef6;
}
.list-group-item.active .list-group-item-heading,
.list-group-item.active .list-group-item-heading > small,
.list-group-item.active .list-group-item-heading > .small, .list-group-item.active:focus .list-group-item-heading,
.list-group-item.active:focus .list-group-item-heading > small,
.list-group-item.active:focus .list-group-item-heading > .small, .list-group-item.active:hover .list-group-item-heading,
.list-group-item.active:hover .list-group-item-heading > small,
.list-group-item.active:hover .list-group-item-heading > .small {
  color: inherit;
}
.list-group-item.active .list-group-item-text, .list-group-item.active:focus .list-group-item-text, .list-group-item.active:hover .list-group-item-text {
  color: #d6f4fd;
}

.list-group-flush .list-group-item {
  border-right: 0;
  border-left: 0;
  border-radius: 0;
}

.list-group-item-action {
  width: 100%;
  color: #555;
  text-align: inherit;
}
.list-group-item-action .list-group-item-heading {
  color: #333;
}
.list-group-item-action:focus, .list-group-item-action:hover {
  color: #555;
  text-decoration: none;
  background-color: #f5f5f5;
}

.list-group-item-success {
  color: #ffffff;
  background-color: #47d165;
}

a.list-group-item-success,
button.list-group-item-success {
  color: #ffffff;
}
a.list-group-item-success .list-group-item-heading,
button.list-group-item-success .list-group-item-heading {
  color: inherit;
}
a.list-group-item-success:focus, a.list-group-item-success:hover,
button.list-group-item-success:focus,
button.list-group-item-success:hover {
  color: #ffffff;
  background-color: #33cc54;
}
a.list-group-item-success.active, a.list-group-item-success.active:focus, a.list-group-item-success.active:hover,
button.list-group-item-success.active,
button.list-group-item-success.active:focus,
button.list-group-item-success.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-info {
  color: #ffffff;
  background-color: #11bef6;
}

a.list-group-item-info,
button.list-group-item-info {
  color: #ffffff;
}
a.list-group-item-info .list-group-item-heading,
button.list-group-item-info .list-group-item-heading {
  color: inherit;
}
a.list-group-item-info:focus, a.list-group-item-info:hover,
button.list-group-item-info:focus,
button.list-group-item-info:hover {
  color: #ffffff;
  background-color: #09afe5;
}
a.list-group-item-info.active, a.list-group-item-info.active:focus, a.list-group-item-info.active:hover,
button.list-group-item-info.active,
button.list-group-item-info.active:focus,
button.list-group-item-info.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-warning {
  color: #ffffff;
  background-color: #ff754b;
}

a.list-group-item-warning,
button.list-group-item-warning {
  color: #ffffff;
}
a.list-group-item-warning .list-group-item-heading,
button.list-group-item-warning .list-group-item-heading {
  color: inherit;
}
a.list-group-item-warning:focus, a.list-group-item-warning:hover,
button.list-group-item-warning:focus,
button.list-group-item-warning:hover {
  color: #ffffff;
  background-color: #ff6132;
}
a.list-group-item-warning.active, a.list-group-item-warning.active:focus, a.list-group-item-warning.active:hover,
button.list-group-item-warning.active,
button.list-group-item-warning.active:focus,
button.list-group-item-warning.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-danger {
  color: #ffffff;
  background-color: #ff3160;
}

a.list-group-item-danger,
button.list-group-item-danger {
  color: #ffffff;
}
a.list-group-item-danger .list-group-item-heading,
button.list-group-item-danger .list-group-item-heading {
  color: inherit;
}
a.list-group-item-danger:focus, a.list-group-item-danger:hover,
button.list-group-item-danger:focus,
button.list-group-item-danger:hover {
  color: #ffffff;
  background-color: #ff184c;
}
a.list-group-item-danger.active, a.list-group-item-danger.active:focus, a.list-group-item-danger.active:hover,
button.list-group-item-danger.active,
button.list-group-item-danger.active:focus,
button.list-group-item-danger.active:hover {
  color: #fff;
  background-color: #ffffff;
  border-color: #ffffff;
}

.list-group-item-heading {
  margin-top: 0;
  margin-bottom: 5px;
}

.list-group-item-text {
  margin-bottom: 0;
  line-height: 1.3;
}

.embed-responsive {
  position: relative;
  display: block;
  height: 0;
  padding: 0;
  overflow: hidden;
}
.embed-responsive .embed-responsive-item,
.embed-responsive iframe,
.embed-responsive embed,
.embed-responsive object,
.embed-responsive video {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}

.embed-responsive-21by9 {
  padding-bottom: 42.8571428571%;
}

.embed-responsive-16by9 {
  padding-bottom: 56.25%;
}

.embed-responsive-4by3 {
  padding-bottom: 75%;
}

.embed-responsive-1by1 {
  padding-bottom: 100%;
}

.close {
  float: right;
  font-size: 1.5rem;
  font-weight: bold;
  line-height: 1;
  color: #ffffff;
  text-shadow: 1px 1px 0 rgba(66, 66, 66, 0.1);
  opacity: 0.2;
}
.close:focus, .close:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
  opacity: 0.5;
}

button.close {
  padding: 0;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
}

.modal-open {
  overflow: hidden;
}

.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  outline: 0;
}
.modal.fade .modal-dialog {
  transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  -webkit-transform: translate(0, -25%);
          transform: translate(0, -25%);
}
.modal.in .modal-dialog {
  -webkit-transform: translate(0, 0);
          transform: translate(0, 0);
}

.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}

.modal-dialog {
  position: relative;
  width: auto;
  margin: 10px;
}

.modal-content {
  position: relative;
  background-color: #fff;
  background-clip: padding-box;
  border: 0 solid transparent;
  border-radius: 0.25rem;
  outline: 0;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  background-color: #212121;
}
.modal-backdrop.fade {
  opacity: 0;
}
.modal-backdrop.in {
  opacity: 0.8;
}

.modal-header {
  padding: 15px;
  border-bottom: 0 solid #e5e5e5;
}
.modal-header::after {
  content: \"\";
  display: table;
  clear: both;
}

.modal-header .close {
  margin-top: -2px;
}

.modal-title {
  margin: 0;
  line-height: 1.5;
}

.modal-body {
  position: relative;
  padding: 15px;
}

.modal-footer {
  padding: 15px;
  text-align: right;
  border-top: 0 solid #e5e5e5;
}
.modal-footer::after {
  content: \"\";
  display: table;
  clear: both;
}

.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll;
}

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 600px;
    margin: 30px auto;
  }

  .modal-sm {
    max-width: 300px;
  }
}
@media (min-width: 992px) {
  .modal-lg {
    max-width: 900px;
  }
}
.tooltip {
  position: absolute;
  z-index: 1070;
  display: block;
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-style: normal;
  font-weight: normal;
  letter-spacing: normal;
  line-break: auto;
  line-height: 1.5;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  white-space: normal;
  word-break: normal;
  word-spacing: normal;
  font-size: 0.875rem;
  word-wrap: break-word;
  opacity: 0;
}
.tooltip.in {
  opacity: 0.9;
}
.tooltip.tooltip-top, .tooltip.bs-tether-element-attached-bottom {
  padding: 5px 0;
  margin-top: -3px;
}
.tooltip.tooltip-top .tooltip-inner::before, .tooltip.bs-tether-element-attached-bottom .tooltip-inner::before {
  bottom: 0;
  left: 50%;
  margin-left: -5px;
  content: \"\";
  border-width: 5px 5px 0;
  border-top-color: #212121;
}
.tooltip.tooltip-right, .tooltip.bs-tether-element-attached-left {
  padding: 0 5px;
  margin-left: 3px;
}
.tooltip.tooltip-right .tooltip-inner::before, .tooltip.bs-tether-element-attached-left .tooltip-inner::before {
  top: 50%;
  left: 0;
  margin-top: -5px;
  content: \"\";
  border-width: 5px 5px 5px 0;
  border-right-color: #212121;
}
.tooltip.tooltip-bottom, .tooltip.bs-tether-element-attached-top {
  padding: 5px 0;
  margin-top: 3px;
}
.tooltip.tooltip-bottom .tooltip-inner::before, .tooltip.bs-tether-element-attached-top .tooltip-inner::before {
  top: 0;
  left: 50%;
  margin-left: -5px;
  content: \"\";
  border-width: 0 5px 5px;
  border-bottom-color: #212121;
}
.tooltip.tooltip-left, .tooltip.bs-tether-element-attached-right {
  padding: 0 5px;
  margin-left: -3px;
}
.tooltip.tooltip-left .tooltip-inner::before, .tooltip.bs-tether-element-attached-right .tooltip-inner::before {
  top: 50%;
  right: 0;
  margin-top: -5px;
  content: \"\";
  border-width: 5px 0 5px 5px;
  border-left-color: #212121;
}

.tooltip-inner {
  max-width: 200px;
  padding: 3px 8px;
  color: #fff;
  text-align: center;
  background-color: #212121;
  border-radius: 0.17rem;
}
.tooltip-inner::before {
  position: absolute;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}

.popover {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1060;
  display: block;
  max-width: 276px;
  padding: 1px;
  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
  font-style: normal;
  font-weight: normal;
  letter-spacing: normal;
  line-break: auto;
  line-height: 1.5;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  white-space: normal;
  word-break: normal;
  word-spacing: normal;
  font-size: 0.875rem;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.25rem;
}
.popover.popover-top, .popover.bs-tether-element-attached-bottom {
  margin-top: -10px;
}
.popover.popover-top::before, .popover.popover-top::after, .popover.bs-tether-element-attached-bottom::before, .popover.bs-tether-element-attached-bottom::after {
  left: 50%;
  border-bottom-width: 0;
}
.popover.popover-top::before, .popover.bs-tether-element-attached-bottom::before {
  bottom: -11px;
  margin-left: -11px;
  border-top-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-top::after, .popover.bs-tether-element-attached-bottom::after {
  bottom: -10px;
  margin-left: -10px;
  border-top-color: #fff;
}
.popover.popover-right, .popover.bs-tether-element-attached-left {
  margin-left: 10px;
}
.popover.popover-right::before, .popover.popover-right::after, .popover.bs-tether-element-attached-left::before, .popover.bs-tether-element-attached-left::after {
  top: 50%;
  border-left-width: 0;
}
.popover.popover-right::before, .popover.bs-tether-element-attached-left::before {
  left: -11px;
  margin-top: -11px;
  border-right-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-right::after, .popover.bs-tether-element-attached-left::after {
  left: -10px;
  margin-top: -10px;
  border-right-color: #fff;
}
.popover.popover-bottom, .popover.bs-tether-element-attached-top {
  margin-top: 10px;
}
.popover.popover-bottom::before, .popover.popover-bottom::after, .popover.bs-tether-element-attached-top::before, .popover.bs-tether-element-attached-top::after {
  left: 50%;
  border-top-width: 0;
}
.popover.popover-bottom::before, .popover.bs-tether-element-attached-top::before {
  top: -11px;
  margin-left: -11px;
  border-bottom-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-bottom::after, .popover.bs-tether-element-attached-top::after {
  top: -10px;
  margin-left: -10px;
  border-bottom-color: #f7f7f7;
}
.popover.popover-bottom .popover-title::before, .popover.bs-tether-element-attached-top .popover-title::before {
  position: absolute;
  top: 0;
  left: 50%;
  display: block;
  width: 20px;
  margin-left: -10px;
  content: \"\";
  border-bottom: 1px solid #f7f7f7;
}
.popover.popover-left, .popover.bs-tether-element-attached-right {
  margin-left: -10px;
}
.popover.popover-left::before, .popover.popover-left::after, .popover.bs-tether-element-attached-right::before, .popover.bs-tether-element-attached-right::after {
  top: 50%;
  border-right-width: 0;
}
.popover.popover-left::before, .popover.bs-tether-element-attached-right::before {
  right: -11px;
  margin-top: -11px;
  border-left-color: rgba(0, 0, 0, 0.25);
}
.popover.popover-left::after, .popover.bs-tether-element-attached-right::after {
  right: -10px;
  margin-top: -10px;
  border-left-color: #fff;
}

.popover-title {
  padding: 8px 14px;
  margin: 0;
  font-size: 1rem;
  background-color: #f7f7f7;
  border-bottom: 1px solid #ebebeb;
  border-radius: 0.1875rem 0.1875rem 0 0;
}
.popover-title:empty {
  display: none;
}

.popover-content {
  padding: 9px 14px;
}

.popover::before,
.popover::after {
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}

.popover::before {
  content: \"\";
  border-width: 11px;
}

.popover::after {
  content: \"\";
  border-width: 10px;
}

.carousel {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden;
}
.carousel-inner > .carousel-item {
  position: relative;
  display: none;
  transition: 0.6s ease-in-out left;
}
.carousel-inner > .carousel-item > img,
.carousel-inner > .carousel-item > a > img {
  line-height: 1;
}
@media all and (transform-3d), (-webkit-transform-3d) {
  .carousel-inner > .carousel-item {
    transition: -webkit-transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out;
    transition: transform 0.6s ease-in-out, -webkit-transform 0.6s ease-in-out;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    -webkit-perspective: 1000px;
            perspective: 1000px;
  }
  .carousel-inner > .carousel-item.next, .carousel-inner > .carousel-item.active.right {
    left: 0;
    -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
  }
  .carousel-inner > .carousel-item.prev, .carousel-inner > .carousel-item.active.left {
    left: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
  }
  .carousel-inner > .carousel-item.next.left, .carousel-inner > .carousel-item.prev.right, .carousel-inner > .carousel-item.active {
    left: 0;
    -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
  }
}
.carousel-inner > .active,
.carousel-inner > .next,
.carousel-inner > .prev {
  display: block;
}
.carousel-inner > .active {
  left: 0;
}
.carousel-inner > .next,
.carousel-inner > .prev {
  position: absolute;
  top: 0;
  width: 100%;
}
.carousel-inner > .next {
  left: 100%;
}
.carousel-inner > .prev {
  left: -100%;
}
.carousel-inner > .next.left,
.carousel-inner > .prev.right {
  left: 0;
}
.carousel-inner > .active.left {
  left: -100%;
}
.carousel-inner > .active.right {
  left: 100%;
}

.carousel-control {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 15%;
  font-size: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  opacity: 0.5;
}
.carousel-control.left {
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.0001) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#80000000\", endColorstr=\"#00000000\", GradientType=1);
}
.carousel-control.right {
  right: 0;
  left: auto;
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0%, rgba(0, 0, 0, 0.5) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#00000000\", endColorstr=\"#80000000\", GradientType=1);
}
.carousel-control:focus, .carousel-control:hover {
  color: #fff;
  text-decoration: none;
  outline: 0;
  opacity: 0.9;
}
.carousel-control .icon-prev,
.carousel-control .icon-next {
  position: absolute;
  top: 50%;
  z-index: 5;
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  font-family: serif;
  line-height: 1;
}
.carousel-control .icon-prev {
  left: 50%;
  margin-left: -10px;
}
.carousel-control .icon-next {
  right: 50%;
  margin-right: -10px;
}
.carousel-control .icon-prev::before {
  content: \"\\2039\";
}
.carousel-control .icon-next::before {
  content: \"\\203A\";
}

.carousel-indicators {
  position: absolute;
  bottom: 10px;
  left: 50%;
  z-index: 15;
  width: 60%;
  padding-left: 0;
  margin-left: -30%;
  text-align: center;
  list-style: none;
}
.carousel-indicators li {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 1px;
  text-indent: -999px;
  cursor: pointer;
  background-color: rgba(0, 0, 0, 0);
  border: 1px solid #fff;
  border-radius: 10px;
}
.carousel-indicators .active {
  width: 12px;
  height: 12px;
  margin: 0;
  background-color: #fff;
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
}
.carousel-caption .btn {
  text-shadow: none;
}

@media (min-width: 576px) {
  .carousel-control .icon-prev,
.carousel-control .icon-next {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    font-size: 30px;
  }
  .carousel-control .icon-prev {
    margin-left: -15px;
  }
  .carousel-control .icon-next {
    margin-right: -15px;
  }

  .carousel-caption {
    right: 20%;
    left: 20%;
    padding-bottom: 30px;
  }

  .carousel-indicators {
    bottom: 20px;
  }
}
.align-baseline {
  vertical-align: baseline !important;
}

.align-top {
  vertical-align: top !important;
}

.align-middle {
  vertical-align: middle !important;
}

.align-bottom {
  vertical-align: bottom !important;
}

.align-text-bottom {
  vertical-align: text-bottom !important;
}

.align-text-top {
  vertical-align: text-top !important;
}

.bg-faded {
  background-color: #f7f7f9;
}

.bg-primary {
  background-color: #b21cc3 !important;
}

a.bg-primary:focus, a.bg-primary:hover {
  background-color: #891696 !important;
}

.bg-success {
  background-color: #47d165 !important;
}

a.bg-success:focus, a.bg-success:hover {
  background-color: #2eb74c !important;
}

.bg-info {
  background-color: #11bef6 !important;
}

a.bg-info:focus, a.bg-info:hover {
  background-color: #089ccc !important;
}

.bg-warning {
  background-color: #ff754b !important;
}

a.bg-warning:focus, a.bg-warning:hover {
  background-color: #ff4e18 !important;
}

.bg-danger {
  background-color: #ff3160 !important;
}

a.bg-danger:focus, a.bg-danger:hover {
  background-color: #fd003a !important;
}

.bg-inverse {
  background-color: #d4d6d7 !important;
}

a.bg-inverse:focus, a.bg-inverse:hover {
  background-color: #babdbe !important;
}

.rounded {
  border-radius: 0.17rem;
}

.rounded-top {
  border-top-right-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.rounded-right {
  border-bottom-right-radius: 0.17rem;
  border-top-right-radius: 0.17rem;
}

.rounded-bottom {
  border-bottom-right-radius: 0.17rem;
  border-bottom-left-radius: 0.17rem;
}

.rounded-left {
  border-bottom-left-radius: 0.17rem;
  border-top-left-radius: 0.17rem;
}

.rounded-circle {
  border-radius: 50%;
}

.clearfix::after {
  content: \"\";
  display: table;
  clear: both;
}

.d-block {
  display: block !important;
}

.d-inline-block {
  display: inline-block !important;
}

.d-inline {
  display: inline !important;
}

.flex-xs-first {
  order: -1;
}

.flex-xs-last {
  order: 1;
}

.flex-xs-unordered {
  order: 0;
}

.flex-items-xs-top {
  align-items: flex-start;
}

.flex-items-xs-middle {
  align-items: center;
}

.flex-items-xs-bottom {
  align-items: flex-end;
}

.flex-xs-top {
  align-self: flex-start;
}

.flex-xs-middle {
  align-self: center;
}

.flex-xs-bottom {
  align-self: flex-end;
}

.flex-items-xs-left {
  justify-content: flex-start;
}

.flex-items-xs-center {
  justify-content: center;
}

.flex-items-xs-right {
  justify-content: flex-end;
}

.flex-items-xs-around {
  justify-content: space-around;
}

.flex-items-xs-between {
  justify-content: space-between;
}

@media (min-width: 576px) {
  .flex-sm-first {
    order: -1;
  }

  .flex-sm-last {
    order: 1;
  }

  .flex-sm-unordered {
    order: 0;
  }
}
@media (min-width: 576px) {
  .flex-items-sm-top {
    align-items: flex-start;
  }

  .flex-items-sm-middle {
    align-items: center;
  }

  .flex-items-sm-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 576px) {
  .flex-sm-top {
    align-self: flex-start;
  }

  .flex-sm-middle {
    align-self: center;
  }

  .flex-sm-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 576px) {
  .flex-items-sm-left {
    justify-content: flex-start;
  }

  .flex-items-sm-center {
    justify-content: center;
  }

  .flex-items-sm-right {
    justify-content: flex-end;
  }

  .flex-items-sm-around {
    justify-content: space-around;
  }

  .flex-items-sm-between {
    justify-content: space-between;
  }
}
@media (min-width: 768px) {
  .flex-md-first {
    order: -1;
  }

  .flex-md-last {
    order: 1;
  }

  .flex-md-unordered {
    order: 0;
  }
}
@media (min-width: 768px) {
  .flex-items-md-top {
    align-items: flex-start;
  }

  .flex-items-md-middle {
    align-items: center;
  }

  .flex-items-md-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 768px) {
  .flex-md-top {
    align-self: flex-start;
  }

  .flex-md-middle {
    align-self: center;
  }

  .flex-md-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 768px) {
  .flex-items-md-left {
    justify-content: flex-start;
  }

  .flex-items-md-center {
    justify-content: center;
  }

  .flex-items-md-right {
    justify-content: flex-end;
  }

  .flex-items-md-around {
    justify-content: space-around;
  }

  .flex-items-md-between {
    justify-content: space-between;
  }
}
@media (min-width: 992px) {
  .flex-lg-first {
    order: -1;
  }

  .flex-lg-last {
    order: 1;
  }

  .flex-lg-unordered {
    order: 0;
  }
}
@media (min-width: 992px) {
  .flex-items-lg-top {
    align-items: flex-start;
  }

  .flex-items-lg-middle {
    align-items: center;
  }

  .flex-items-lg-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 992px) {
  .flex-lg-top {
    align-self: flex-start;
  }

  .flex-lg-middle {
    align-self: center;
  }

  .flex-lg-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 992px) {
  .flex-items-lg-left {
    justify-content: flex-start;
  }

  .flex-items-lg-center {
    justify-content: center;
  }

  .flex-items-lg-right {
    justify-content: flex-end;
  }

  .flex-items-lg-around {
    justify-content: space-around;
  }

  .flex-items-lg-between {
    justify-content: space-between;
  }
}
@media (min-width: 1200px) {
  .flex-xl-first {
    order: -1;
  }

  .flex-xl-last {
    order: 1;
  }

  .flex-xl-unordered {
    order: 0;
  }
}
@media (min-width: 1200px) {
  .flex-items-xl-top {
    align-items: flex-start;
  }

  .flex-items-xl-middle {
    align-items: center;
  }

  .flex-items-xl-bottom {
    align-items: flex-end;
  }
}
@media (min-width: 1200px) {
  .flex-xl-top {
    align-self: flex-start;
  }

  .flex-xl-middle {
    align-self: center;
  }

  .flex-xl-bottom {
    align-self: flex-end;
  }
}
@media (min-width: 1200px) {
  .flex-items-xl-left {
    justify-content: flex-start;
  }

  .flex-items-xl-center {
    justify-content: center;
  }

  .flex-items-xl-right {
    justify-content: flex-end;
  }

  .flex-items-xl-around {
    justify-content: space-around;
  }

  .flex-items-xl-between {
    justify-content: space-between;
  }
}
.float-xs-left {
  float: left !important;
}

.float-xs-right {
  float: right !important;
}

.float-xs-none {
  float: none !important;
}

@media (min-width: 576px) {
  .float-sm-left {
    float: left !important;
  }

  .float-sm-right {
    float: right !important;
  }

  .float-sm-none {
    float: none !important;
  }
}
@media (min-width: 768px) {
  .float-md-left {
    float: left !important;
  }

  .float-md-right {
    float: right !important;
  }

  .float-md-none {
    float: none !important;
  }
}
@media (min-width: 992px) {
  .float-lg-left {
    float: left !important;
  }

  .float-lg-right {
    float: right !important;
  }

  .float-lg-none {
    float: none !important;
  }
}
@media (min-width: 1200px) {
  .float-xl-left {
    float: left !important;
  }

  .float-xl-right {
    float: right !important;
  }

  .float-xl-none {
    float: none !important;
  }
}
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.sr-only-focusable:active, .sr-only-focusable:focus {
  position: static;
  width: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  clip: auto;
}

.w-100 {
  width: 100% !important;
}

.h-100 {
  height: 100% !important;
}

.mx-auto {
  margin-right: auto !important;
  margin-left: auto !important;
}

.m-0 {
  margin: 0 0 !important;
}

.mt-0 {
  margin-top: 0 !important;
}

.mr-0 {
  margin-right: 0 !important;
}

.mb-0 {
  margin-bottom: 0 !important;
}

.ml-0 {
  margin-left: 0 !important;
}

.mx-0 {
  margin-right: 0 !important;
  margin-left: 0 !important;
}

.my-0 {
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}

.m-1 {
  margin: 1rem 1rem !important;
}

.mt-1 {
  margin-top: 1rem !important;
}

.mr-1 {
  margin-right: 1rem !important;
}

.mb-1 {
  margin-bottom: 1rem !important;
}

.ml-1 {
  margin-left: 1rem !important;
}

.mx-1 {
  margin-right: 1rem !important;
  margin-left: 1rem !important;
}

.my-1 {
  margin-top: 1rem !important;
  margin-bottom: 1rem !important;
}

.m-2 {
  margin: 1.5rem 1.5rem !important;
}

.mt-2 {
  margin-top: 1.5rem !important;
}

.mr-2 {
  margin-right: 1.5rem !important;
}

.mb-2 {
  margin-bottom: 1.5rem !important;
}

.ml-2 {
  margin-left: 1.5rem !important;
}

.mx-2 {
  margin-right: 1.5rem !important;
  margin-left: 1.5rem !important;
}

.my-2 {
  margin-top: 1.5rem !important;
  margin-bottom: 1.5rem !important;
}

.m-3 {
  margin: 3rem 3rem !important;
}

.mt-3 {
  margin-top: 3rem !important;
}

.mr-3 {
  margin-right: 3rem !important;
}

.mb-3 {
  margin-bottom: 3rem !important;
}

.ml-3 {
  margin-left: 3rem !important;
}

.mx-3 {
  margin-right: 3rem !important;
  margin-left: 3rem !important;
}

.my-3 {
  margin-top: 3rem !important;
  margin-bottom: 3rem !important;
}

.p-0 {
  padding: 0 0 !important;
}

.pt-0 {
  padding-top: 0 !important;
}

.pr-0 {
  padding-right: 0 !important;
}

.pb-0 {
  padding-bottom: 0 !important;
}

.pl-0 {
  padding-left: 0 !important;
}

.px-0 {
  padding-right: 0 !important;
  padding-left: 0 !important;
}

.py-0 {
  padding-top: 0 !important;
  padding-bottom: 0 !important;
}

.p-1 {
  padding: 1rem 1rem !important;
}

.pt-1 {
  padding-top: 1rem !important;
}

.pr-1 {
  padding-right: 1rem !important;
}

.pb-1 {
  padding-bottom: 1rem !important;
}

.pl-1 {
  padding-left: 1rem !important;
}

.px-1 {
  padding-right: 1rem !important;
  padding-left: 1rem !important;
}

.py-1 {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}

.p-2 {
  padding: 1.5rem 1.5rem !important;
}

.pt-2 {
  padding-top: 1.5rem !important;
}

.pr-2 {
  padding-right: 1.5rem !important;
}

.pb-2 {
  padding-bottom: 1.5rem !important;
}

.pl-2 {
  padding-left: 1.5rem !important;
}

.px-2 {
  padding-right: 1.5rem !important;
  padding-left: 1.5rem !important;
}

.py-2 {
  padding-top: 1.5rem !important;
  padding-bottom: 1.5rem !important;
}

.p-3 {
  padding: 3rem 3rem !important;
}

.pt-3 {
  padding-top: 3rem !important;
}

.pr-3 {
  padding-right: 3rem !important;
}

.pb-3 {
  padding-bottom: 3rem !important;
}

.pl-3 {
  padding-left: 3rem !important;
}

.px-3 {
  padding-right: 3rem !important;
  padding-left: 3rem !important;
}

.py-3 {
  padding-top: 3rem !important;
  padding-bottom: 3rem !important;
}

.pos-f-t {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 1030;
}

.text-justify {
  text-align: justify !important;
}

.text-nowrap {
  white-space: nowrap !important;
}

.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.text-xs-left {
  text-align: left !important;
}

.text-xs-right {
  text-align: right !important;
}

.text-xs-center {
  text-align: center !important;
}

@media (min-width: 576px) {
  .text-sm-left {
    text-align: left !important;
  }

  .text-sm-right {
    text-align: right !important;
  }

  .text-sm-center {
    text-align: center !important;
  }
}
@media (min-width: 768px) {
  .text-md-left {
    text-align: left !important;
  }

  .text-md-right {
    text-align: right !important;
  }

  .text-md-center {
    text-align: center !important;
  }
}
@media (min-width: 992px) {
  .text-lg-left {
    text-align: left !important;
  }

  .text-lg-right {
    text-align: right !important;
  }

  .text-lg-center {
    text-align: center !important;
  }
}
@media (min-width: 1200px) {
  .text-xl-left {
    text-align: left !important;
  }

  .text-xl-right {
    text-align: right !important;
  }

  .text-xl-center {
    text-align: center !important;
  }
}
.text-lowercase {
  text-transform: lowercase !important;
}

.text-uppercase {
  text-transform: uppercase !important;
}

.text-capitalize {
  text-transform: capitalize !important;
}

.font-weight-normal {
  font-weight: normal;
}

.font-weight-bold {
  font-weight: bold;
}

.font-italic {
  font-style: italic;
}

.text-white {
  color: #fff !important;
}

.text-muted {
  color: #888888 !important;
}

a.text-muted:focus, a.text-muted:hover {
  color: #6f6f6f !important;
}

.text-primary {
  color: #b21cc3 !important;
}

a.text-primary:focus, a.text-primary:hover {
  color: #891696 !important;
}

.text-success {
  color: #47d165 !important;
}

a.text-success:focus, a.text-success:hover {
  color: #2eb74c !important;
}

.text-info {
  color: #11bef6 !important;
}

a.text-info:focus, a.text-info:hover {
  color: #089ccc !important;
}

.text-warning {
  color: #ff754b !important;
}

a.text-warning:focus, a.text-warning:hover {
  color: #ff4e18 !important;
}

.text-danger {
  color: #ff3160 !important;
}

a.text-danger:focus, a.text-danger:hover {
  color: #fd003a !important;
}

.text-gray-dark {
  color: #373a3c !important;
}

a.text-gray-dark:focus, a.text-gray-dark:hover {
  color: #1f2021 !important;
}

.text-hide {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.invisible {
  visibility: hidden !important;
}

.hidden-xs-up {
  display: none !important;
}

@media (max-width: 575px) {
  .hidden-xs-down {
    display: none !important;
  }
}

@media (min-width: 576px) {
  .hidden-sm-up {
    display: none !important;
  }
}

@media (max-width: 767px) {
  .hidden-sm-down {
    display: none !important;
  }
}

@media (min-width: 768px) {
  .hidden-md-up {
    display: none !important;
  }
}

@media (max-width: 991px) {
  .hidden-md-down {
    display: none !important;
  }
}

@media (min-width: 992px) {
  .hidden-lg-up {
    display: none !important;
  }
}

@media (max-width: 1199px) {
  .hidden-lg-down {
    display: none !important;
  }
}

@media (min-width: 1200px) {
  .hidden-xl-up {
    display: none !important;
  }
}

.hidden-xl-down {
  display: none !important;
}

.visible-print-block {
  display: none !important;
}
@media print {
  .visible-print-block {
    display: block !important;
  }
}

.visible-print-inline {
  display: none !important;
}
@media print {
  .visible-print-inline {
    display: inline !important;
  }
}

.visible-print-inline-block {
  display: none !important;
}
@media print {
  .visible-print-inline-block {
    display: inline-block !important;
  }
}

@media print {
  .hidden-print {
    display: none !important;
  }
}

.select2-container {
  box-sizing: border-box;
  display: inline-block;
  margin: 0;
  position: relative;
  vertical-align: middle; }
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      padding-left: 8px;
      padding-right: 20px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap; }
    .select2-container .select2-selection--single .select2-selection__clear {
      position: relative; }
  .select2-container[dir=\"rtl\"] .select2-selection--single .select2-selection__rendered {
    padding-right: 8px;
    padding-left: 20px; }
  .select2-container .select2-selection--multiple {
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    padding-bottom: 5px;
    min-height: 32px;
    user-select: none;
    -webkit-user-select: none; }
  .select2-container .select2-search--inline {
    float: left; }
    .select2-container .select2-search--inline .select2-search__field {
      box-sizing: border-box;
      border: none;
      font-size: 100%;
      margin-top: 5px;
      padding: 0; }
      .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
        -webkit-appearance: none; }

.select2-dropdown {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  box-sizing: border-box;
  display: block;
  position: absolute;
  left: -100000px;
  width: 100%;
  z-index: 1051; }

.select2-results {
  display: block; }

.select2-results__options {
  list-style: none;
  margin: 0;
  padding: 0; }

.select2-results__option {
  padding: 6px;
  user-select: none;
  -webkit-user-select: none; }
  .select2-results__option[aria-selected] {
    cursor: pointer; }

.select2-container--open .select2-dropdown {
  left: 0; }

.select2-container--open .select2-dropdown--above {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--open .select2-dropdown--below {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-search--dropdown {
  display: block;
  padding: 4px; }
  .select2-search--dropdown .select2-search__field {
    padding: 4px;
    width: 100%;
    box-sizing: border-box; }
    .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
      -webkit-appearance: none; }
  .select2-search--dropdown.select2-search--hide {
    display: none; }

.select2-close-mask {
  border: 0;
  margin: 0;
  padding: 0;
  display: block;
  position: fixed;
  left: 0;
  top: 0;
  min-height: 100%;
  min-width: 100%;
  height: auto;
  width: auto;
  opacity: 0;
  z-index: 99;
  background-color: #fff;
  filter: alpha(opacity=0); }

.select2-hidden-accessible {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important; }

.select2-container--default .select2-selection--single {
  background-color: #fff;
  border: 1px solid #aaa;
  border-radius: 4px; }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold; }
  .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px; }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow {
  left: 1px;
  right: auto; }

.select2-container--default.select2-container--disabled .select2-selection--single {
  background-color: #eee;
  cursor: default; }
  .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
    display: none; }

.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
  border-color: transparent transparent #888 transparent;
  border-width: 0 4px 5px 4px; }

.select2-container--default .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text; }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
      list-style: none; }
  .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #999;
    margin-top: 5px;
    float: left; }
  .select2-container--default .select2-selection--multiple .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-top: 5px;
    margin-right: 10px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #999;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #333; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice, .select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-search--inline {
  float: right; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--default.select2-container--focus .select2-selection--multiple {
  border: solid black 1px;
  outline: 0; }

.select2-container--default.select2-container--disabled .select2-selection--multiple {
  background-color: #eee;
  cursor: default; }

.select2-container--default.select2-container--disabled .select2-selection__choice__remove {
  display: none; }

.select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa; }

.select2-container--default .select2-search--inline .select2-search__field {
  background: transparent;
  border: none;
  outline: 0;
  box-shadow: none;
  -webkit-appearance: textfield; }

.select2-container--default .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--default .select2-results__option[role=group] {
  padding: 0; }

.select2-container--default .select2-results__option[aria-disabled=true] {
  color: #999; }

.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #ddd; }

.select2-container--default .select2-results__option .select2-results__option {
  padding-left: 1em; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
    padding-left: 0; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
    margin-left: -1em;
    padding-left: 2em; }
    .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
      margin-left: -2em;
      padding-left: 3em; }
      .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -3em;
        padding-left: 4em; }
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
          margin-left: -4em;
          padding-left: 5em; }
          .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em; }

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #5897fb;
  color: white; }

.select2-container--default .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic .select2-selection--single {
  background-color: #f7f7f7;
  border: 1px solid #aaa;
  border-radius: 4px;
  outline: 0;
  background-image: -webkit-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: -o-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: linear-gradient(to bottom, white 50%, #eeeeee 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }
  .select2-container--classic .select2-selection--single:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--classic .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-right: 10px; }
  .select2-container--classic .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--classic .select2-selection--single .select2-selection__arrow {
    background-color: #ddd;
    border: none;
    border-left: 1px solid #aaa;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
    background-image: -webkit-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: -o-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: linear-gradient(to bottom, #eeeeee 50%, #cccccc 100%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0); }
    .select2-container--classic .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow {
  border: none;
  border-right: 1px solid #aaa;
  border-radius: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  left: 1px;
  right: auto; }

.select2-container--classic.select2-container--open .select2-selection--single {
  border: 1px solid #5897fb; }
  .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow {
    background: transparent;
    border: none; }
    .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b {
      border-color: transparent transparent #888 transparent;
      border-width: 0 4px 5px 4px; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  background-image: -webkit-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: -o-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: linear-gradient(to bottom, white 0%, #eeeeee 50%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  background-image: -webkit-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: -o-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: linear-gradient(to bottom, #eeeeee 50%, white 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0); }

.select2-container--classic .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text;
  outline: 0; }
  .select2-container--classic .select2-selection--multiple:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--multiple .select2-selection__rendered {
    list-style: none;
    margin: 0;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__clear {
    display: none; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
    color: #888;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #555; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  float: right; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--classic.select2-container--open .select2-selection--multiple {
  border: 1px solid #5897fb; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--classic .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa;
  outline: 0; }

.select2-container--classic .select2-search--inline .select2-search__field {
  outline: 0;
  box-shadow: none; }

.select2-container--classic .select2-dropdown {
  background-color: white;
  border: 1px solid transparent; }

.select2-container--classic .select2-dropdown--above {
  border-bottom: none; }

.select2-container--classic .select2-dropdown--below {
  border-top: none; }

.select2-container--classic .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--classic .select2-results__option[role=group] {
  padding: 0; }

.select2-container--classic .select2-results__option[aria-disabled=true] {
  color: grey; }

.select2-container--classic .select2-results__option--highlighted[aria-selected] {
  background-color: #3875d7;
  color: white; }

.select2-container--classic .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic.select2-container--open .select2-dropdown {
  border-color: #5897fb; }


.iti {
    position: relative;
    display: inline-block; }
.iti * {
    box-sizing: border-box;
    -moz-box-sizing: border-box; }
.iti__hide {
    display: none; }
.iti__v-hide {
    visibility: hidden; }
.iti input, .iti input[type=text], .iti input[type=tel] {
    position: relative;
    z-index: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-right: 36px;
    margin-right: 0; }
.iti__flag-container {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    padding: 1px; }
.iti__selected-flag {
    z-index: 1;
    position: relative;
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 6px 0 8px; }
.iti__arrow {
    margin-left: 6px;
    width: 0;
    height: 0;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-top: 4px solid #555; }
.iti__arrow--up {
    border-top: none;
    border-bottom: 4px solid #555; }
.iti__country-list {
    position: absolute;
    z-index: 2;
    list-style: none;
    text-align: left;
    padding: 0;
    margin: 0 0 0 -1px;
    box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
    background-color: white;
    border: 1px solid #CCC;
    white-space: nowrap;
    max-height: 200px;
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch; }
.iti__country-list--dropup {
    bottom: 100%;
    margin-bottom: -1px; }
@media (max-width: 500px) {
    .iti__country-list {
        white-space: normal; } }
.iti__flag-box {
    display: inline-block;
    width: 20px; }
.iti__divider {
    padding-bottom: 5px;
    margin-bottom: 5px;
    border-bottom: 1px solid #CCC; }
.iti__country {
    padding: 5px 10px;
    outline: none; }
.iti__dial-code {
    color: #999; }
.iti__country.iti__highlight {
    background-color: rgba(0, 0, 0, 0.05); }
.iti__flag-box, .iti__country-name, .iti__dial-code {
    vertical-align: middle; }
.iti__flag-box, .iti__country-name {
    margin-right: 6px; }
.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
    padding-right: 6px;
    padding-left: 52px;
    margin-left: 0; }
.iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container {
    right: auto;
    left: 0; }
.iti--allow-dropdown .iti__flag-container:hover {
    cursor: pointer; }
.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
    background-color: rgba(0, 0, 0, 0.05); }
.iti--allow-dropdown input[disabled] + .iti__flag-container:hover,
.iti--allow-dropdown input[readonly] + .iti__flag-container:hover {
    cursor: default; }
.iti--allow-dropdown input[disabled] + .iti__flag-container:hover .iti__selected-flag,
.iti--allow-dropdown input[readonly] + .iti__flag-container:hover .iti__selected-flag {
    background-color: transparent; }
.iti--separate-dial-code .iti__selected-flag {
    background-color: rgba(0, 0, 0, 0.05); }
.iti--separate-dial-code .iti__selected-dial-code {
    margin-left: 6px; }
.iti--container {
    position: absolute;
    top: -1000px;
    left: -1000px;
    z-index: 1060;
    padding: 1px; }
.iti--container:hover {
    cursor: pointer; }

.iti-mobile .iti--container {
    top: 30px;
    bottom: 30px;
    left: 30px;
    right: 30px;
    position: fixed; }

.iti-mobile .iti__country-list {
    max-height: 100%;
    width: 100%; }

.iti-mobile .iti__country {
    padding: 10px 10px;
    line-height: 1.5em; }

.iti__flag {
    width: 20px; }
.iti__flag.iti__be {
    width: 18px; }
.iti__flag.iti__ch {
    width: 15px; }
.iti__flag.iti__mc {
    width: 19px; }
.iti__flag.iti__ne {
    width: 18px; }
.iti__flag.iti__np {
    width: 13px; }
.iti__flag.iti__va {
    width: 15px; }
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {
        background-size: 5652px 15px; } }
.iti__flag.iti__ac {
    height: 10px;
    background-position: 0px 0px; }
.iti__flag.iti__ad {
    height: 14px;
    background-position: -22px 0px; }
.iti__flag.iti__ae {
    height: 10px;
    background-position: -44px 0px; }
.iti__flag.iti__af {
    height: 14px;
    background-position: -66px 0px; }
.iti__flag.iti__ag {
    height: 14px;
    background-position: -88px 0px; }
.iti__flag.iti__ai {
    height: 10px;
    background-position: -110px 0px; }
.iti__flag.iti__al {
    height: 15px;
    background-position: -132px 0px; }
.iti__flag.iti__am {
    height: 10px;
    background-position: -154px 0px; }
.iti__flag.iti__ao {
    height: 14px;
    background-position: -176px 0px; }
.iti__flag.iti__aq {
    height: 14px;
    background-position: -198px 0px; }
.iti__flag.iti__ar {
    height: 13px;
    background-position: -220px 0px; }
.iti__flag.iti__as {
    height: 10px;
    background-position: -242px 0px; }
.iti__flag.iti__at {
    height: 14px;
    background-position: -264px 0px; }
.iti__flag.iti__au {
    height: 10px;
    background-position: -286px 0px; }
.iti__flag.iti__aw {
    height: 14px;
    background-position: -308px 0px; }
.iti__flag.iti__ax {
    height: 13px;
    background-position: -330px 0px; }
.iti__flag.iti__az {
    height: 10px;
    background-position: -352px 0px; }
.iti__flag.iti__ba {
    height: 10px;
    background-position: -374px 0px; }
.iti__flag.iti__bb {
    height: 14px;
    background-position: -396px 0px; }
.iti__flag.iti__bd {
    height: 12px;
    background-position: -418px 0px; }
.iti__flag.iti__be {
    height: 15px;
    background-position: -440px 0px; }
.iti__flag.iti__bf {
    height: 14px;
    background-position: -460px 0px; }
.iti__flag.iti__bg {
    height: 12px;
    background-position: -482px 0px; }
.iti__flag.iti__bh {
    height: 12px;
    background-position: -504px 0px; }
.iti__flag.iti__bi {
    height: 12px;
    background-position: -526px 0px; }
.iti__flag.iti__bj {
    height: 14px;
    background-position: -548px 0px; }
.iti__flag.iti__bl {
    height: 14px;
    background-position: -570px 0px; }
.iti__flag.iti__bm {
    height: 10px;
    background-position: -592px 0px; }
.iti__flag.iti__bn {
    height: 10px;
    background-position: -614px 0px; }
.iti__flag.iti__bo {
    height: 14px;
    background-position: -636px 0px; }
.iti__flag.iti__bq {
    height: 14px;
    background-position: -658px 0px; }
.iti__flag.iti__br {
    height: 14px;
    background-position: -680px 0px; }
.iti__flag.iti__bs {
    height: 10px;
    background-position: -702px 0px; }
.iti__flag.iti__bt {
    height: 14px;
    background-position: -724px 0px; }
.iti__flag.iti__bv {
    height: 15px;
    background-position: -746px 0px; }
.iti__flag.iti__bw {
    height: 14px;
    background-position: -768px 0px; }
.iti__flag.iti__by {
    height: 10px;
    background-position: -790px 0px; }
.iti__flag.iti__bz {
    height: 14px;
    background-position: -812px 0px; }
.iti__flag.iti__ca {
    height: 10px;
    background-position: -834px 0px; }
.iti__flag.iti__cc {
    height: 10px;
    background-position: -856px 0px; }
.iti__flag.iti__cd {
    height: 15px;
    background-position: -878px 0px; }
.iti__flag.iti__cf {
    height: 14px;
    background-position: -900px 0px; }
.iti__flag.iti__cg {
    height: 14px;
    background-position: -922px 0px; }
.iti__flag.iti__ch {
    height: 15px;
    background-position: -944px 0px; }
.iti__flag.iti__ci {
    height: 14px;
    background-position: -961px 0px; }
.iti__flag.iti__ck {
    height: 10px;
    background-position: -983px 0px; }
.iti__flag.iti__cl {
    height: 14px;
    background-position: -1005px 0px; }
.iti__flag.iti__cm {
    height: 14px;
    background-position: -1027px 0px; }
.iti__flag.iti__cn {
    height: 14px;
    background-position: -1049px 0px; }
.iti__flag.iti__co {
    height: 14px;
    background-position: -1071px 0px; }
.iti__flag.iti__cp {
    height: 14px;
    background-position: -1093px 0px; }
.iti__flag.iti__cr {
    height: 12px;
    background-position: -1115px 0px; }
.iti__flag.iti__cu {
    height: 10px;
    background-position: -1137px 0px; }
.iti__flag.iti__cv {
    height: 12px;
    background-position: -1159px 0px; }
.iti__flag.iti__cw {
    height: 14px;
    background-position: -1181px 0px; }
.iti__flag.iti__cx {
    height: 10px;
    background-position: -1203px 0px; }
.iti__flag.iti__cy {
    height: 14px;
    background-position: -1225px 0px; }
.iti__flag.iti__cz {
    height: 14px;
    background-position: -1247px 0px; }
.iti__flag.iti__de {
    height: 12px;
    background-position: -1269px 0px; }
.iti__flag.iti__dg {
    height: 10px;
    background-position: -1291px 0px; }
.iti__flag.iti__dj {
    height: 14px;
    background-position: -1313px 0px; }
.iti__flag.iti__dk {
    height: 15px;
    background-position: -1335px 0px; }
.iti__flag.iti__dm {
    height: 10px;
    background-position: -1357px 0px; }
.iti__flag.iti__do {
    height: 14px;
    background-position: -1379px 0px; }
.iti__flag.iti__dz {
    height: 14px;
    background-position: -1401px 0px; }
.iti__flag.iti__ea {
    height: 14px;
    background-position: -1423px 0px; }
.iti__flag.iti__ec {
    height: 14px;
    background-position: -1445px 0px; }
.iti__flag.iti__ee {
    height: 13px;
    background-position: -1467px 0px; }
.iti__flag.iti__eg {
    height: 14px;
    background-position: -1489px 0px; }
.iti__flag.iti__eh {
    height: 10px;
    background-position: -1511px 0px; }
.iti__flag.iti__er {
    height: 10px;
    background-position: -1533px 0px; }
.iti__flag.iti__es {
    height: 14px;
    background-position: -1555px 0px; }
.iti__flag.iti__et {
    height: 10px;
    background-position: -1577px 0px; }
.iti__flag.iti__eu {
    height: 14px;
    background-position: -1599px 0px; }
.iti__flag.iti__fi {
    height: 12px;
    background-position: -1621px 0px; }
.iti__flag.iti__fj {
    height: 10px;
    background-position: -1643px 0px; }
.iti__flag.iti__fk {
    height: 10px;
    background-position: -1665px 0px; }
.iti__flag.iti__fm {
    height: 11px;
    background-position: -1687px 0px; }
.iti__flag.iti__fo {
    height: 15px;
    background-position: -1709px 0px; }
.iti__flag.iti__fr {
    height: 14px;
    background-position: -1731px 0px; }
.iti__flag.iti__ga {
    height: 15px;
    background-position: -1753px 0px; }
.iti__flag.iti__gb {
    height: 10px;
    background-position: -1775px 0px; }
.iti__flag.iti__gd {
    height: 12px;
    background-position: -1797px 0px; }
.iti__flag.iti__ge {
    height: 14px;
    background-position: -1819px 0px; }
.iti__flag.iti__gf {
    height: 14px;
    background-position: -1841px 0px; }
.iti__flag.iti__gg {
    height: 14px;
    background-position: -1863px 0px; }
.iti__flag.iti__gh {
    height: 14px;
    background-position: -1885px 0px; }
.iti__flag.iti__gi {
    height: 10px;
    background-position: -1907px 0px; }
.iti__flag.iti__gl {
    height: 14px;
    background-position: -1929px 0px; }
.iti__flag.iti__gm {
    height: 14px;
    background-position: -1951px 0px; }
.iti__flag.iti__gn {
    height: 14px;
    background-position: -1973px 0px; }
.iti__flag.iti__gp {
    height: 14px;
    background-position: -1995px 0px; }
.iti__flag.iti__gq {
    height: 14px;
    background-position: -2017px 0px; }
.iti__flag.iti__gr {
    height: 14px;
    background-position: -2039px 0px; }
.iti__flag.iti__gs {
    height: 10px;
    background-position: -2061px 0px; }
.iti__flag.iti__gt {
    height: 13px;
    background-position: -2083px 0px; }
.iti__flag.iti__gu {
    height: 11px;
    background-position: -2105px 0px; }
.iti__flag.iti__gw {
    height: 10px;
    background-position: -2127px 0px; }
.iti__flag.iti__gy {
    height: 12px;
    background-position: -2149px 0px; }
.iti__flag.iti__hk {
    height: 14px;
    background-position: -2171px 0px; }
.iti__flag.iti__hm {
    height: 10px;
    background-position: -2193px 0px; }
.iti__flag.iti__hn {
    height: 10px;
    background-position: -2215px 0px; }
.iti__flag.iti__hr {
    height: 10px;
    background-position: -2237px 0px; }
.iti__flag.iti__ht {
    height: 12px;
    background-position: -2259px 0px; }
.iti__flag.iti__hu {
    height: 10px;
    background-position: -2281px 0px; }
.iti__flag.iti__ic {
    height: 14px;
    background-position: -2303px 0px; }
.iti__flag.iti__id {
    height: 14px;
    background-position: -2325px 0px; }
.iti__flag.iti__ie {
    height: 10px;
    background-position: -2347px 0px; }
.iti__flag.iti__il {
    height: 15px;
    background-position: -2369px 0px; }
.iti__flag.iti__im {
    height: 10px;
    background-position: -2391px 0px; }
.iti__flag.iti__in {
    height: 14px;
    background-position: -2413px 0px; }
.iti__flag.iti__io {
    height: 10px;
    background-position: -2435px 0px; }
.iti__flag.iti__iq {
    height: 14px;
    background-position: -2457px 0px; }
.iti__flag.iti__ir {
    height: 12px;
    background-position: -2479px 0px; }
.iti__flag.iti__is {
    height: 15px;
    background-position: -2501px 0px; }
.iti__flag.iti__it {
    height: 14px;
    background-position: -2523px 0px; }
.iti__flag.iti__je {
    height: 12px;
    background-position: -2545px 0px; }
.iti__flag.iti__jm {
    height: 10px;
    background-position: -2567px 0px; }
.iti__flag.iti__jo {
    height: 10px;
    background-position: -2589px 0px; }
.iti__flag.iti__jp {
    height: 14px;
    background-position: -2611px 0px; }
.iti__flag.iti__ke {
    height: 14px;
    background-position: -2633px 0px; }
.iti__flag.iti__kg {
    height: 12px;
    background-position: -2655px 0px; }
.iti__flag.iti__kh {
    height: 13px;
    background-position: -2677px 0px; }
.iti__flag.iti__ki {
    height: 10px;
    background-position: -2699px 0px; }
.iti__flag.iti__km {
    height: 12px;
    background-position: -2721px 0px; }
.iti__flag.iti__kn {
    height: 14px;
    background-position: -2743px 0px; }
.iti__flag.iti__kp {
    height: 10px;
    background-position: -2765px 0px; }
.iti__flag.iti__kr {
    height: 14px;
    background-position: -2787px 0px; }
.iti__flag.iti__kw {
    height: 10px;
    background-position: -2809px 0px; }
.iti__flag.iti__ky {
    height: 10px;
    background-position: -2831px 0px; }
.iti__flag.iti__kz {
    height: 10px;
    background-position: -2853px 0px; }
.iti__flag.iti__la {
    height: 14px;
    background-position: -2875px 0px; }
.iti__flag.iti__lb {
    height: 14px;
    background-position: -2897px 0px; }
.iti__flag.iti__lc {
    height: 10px;
    background-position: -2919px 0px; }
.iti__flag.iti__li {
    height: 12px;
    background-position: -2941px 0px; }
.iti__flag.iti__lk {
    height: 10px;
    background-position: -2963px 0px; }
.iti__flag.iti__lr {
    height: 11px;
    background-position: -2985px 0px; }
.iti__flag.iti__ls {
    height: 14px;
    background-position: -3007px 0px; }
.iti__flag.iti__lt {
    height: 12px;
    background-position: -3029px 0px; }
.iti__flag.iti__lu {
    height: 12px;
    background-position: -3051px 0px; }
.iti__flag.iti__lv {
    height: 10px;
    background-position: -3073px 0px; }
.iti__flag.iti__ly {
    height: 10px;
    background-position: -3095px 0px; }
.iti__flag.iti__ma {
    height: 14px;
    background-position: -3117px 0px; }
.iti__flag.iti__mc {
    height: 15px;
    background-position: -3139px 0px; }
.iti__flag.iti__md {
    height: 10px;
    background-position: -3160px 0px; }
.iti__flag.iti__me {
    height: 10px;
    background-position: -3182px 0px; }
.iti__flag.iti__mf {
    height: 14px;
    background-position: -3204px 0px; }
.iti__flag.iti__mg {
    height: 14px;
    background-position: -3226px 0px; }
.iti__flag.iti__mh {
    height: 11px;
    background-position: -3248px 0px; }
.iti__flag.iti__mk {
    height: 10px;
    background-position: -3270px 0px; }
.iti__flag.iti__ml {
    height: 14px;
    background-position: -3292px 0px; }
.iti__flag.iti__mm {
    height: 14px;
    background-position: -3314px 0px; }
.iti__flag.iti__mn {
    height: 10px;
    background-position: -3336px 0px; }
.iti__flag.iti__mo {
    height: 14px;
    background-position: -3358px 0px; }
.iti__flag.iti__mp {
    height: 10px;
    background-position: -3380px 0px; }
.iti__flag.iti__mq {
    height: 14px;
    background-position: -3402px 0px; }
.iti__flag.iti__mr {
    height: 14px;
    background-position: -3424px 0px; }
.iti__flag.iti__ms {
    height: 10px;
    background-position: -3446px 0px; }
.iti__flag.iti__mt {
    height: 14px;
    background-position: -3468px 0px; }
.iti__flag.iti__mu {
    height: 14px;
    background-position: -3490px 0px; }
.iti__flag.iti__mv {
    height: 14px;
    background-position: -3512px 0px; }
.iti__flag.iti__mw {
    height: 14px;
    background-position: -3534px 0px; }
.iti__flag.iti__mx {
    height: 12px;
    background-position: -3556px 0px; }
.iti__flag.iti__my {
    height: 10px;
    background-position: -3578px 0px; }
.iti__flag.iti__mz {
    height: 14px;
    background-position: -3600px 0px; }
.iti__flag.iti__na {
    height: 14px;
    background-position: -3622px 0px; }
.iti__flag.iti__nc {
    height: 10px;
    background-position: -3644px 0px; }
.iti__flag.iti__ne {
    height: 15px;
    background-position: -3666px 0px; }
.iti__flag.iti__nf {
    height: 10px;
    background-position: -3686px 0px; }
.iti__flag.iti__ng {
    height: 10px;
    background-position: -3708px 0px; }
.iti__flag.iti__ni {
    height: 12px;
    background-position: -3730px 0px; }
.iti__flag.iti__nl {
    height: 14px;
    background-position: -3752px 0px; }
.iti__flag.iti__no {
    height: 15px;
    background-position: -3774px 0px; }
.iti__flag.iti__np {
    height: 15px;
    background-position: -3796px 0px; }
.iti__flag.iti__nr {
    height: 10px;
    background-position: -3811px 0px; }
.iti__flag.iti__nu {
    height: 10px;
    background-position: -3833px 0px; }
.iti__flag.iti__nz {
    height: 10px;
    background-position: -3855px 0px; }
.iti__flag.iti__om {
    height: 10px;
    background-position: -3877px 0px; }
.iti__flag.iti__pa {
    height: 14px;
    background-position: -3899px 0px; }
.iti__flag.iti__pe {
    height: 14px;
    background-position: -3921px 0px; }
.iti__flag.iti__pf {
    height: 14px;
    background-position: -3943px 0px; }
.iti__flag.iti__pg {
    height: 15px;
    background-position: -3965px 0px; }
.iti__flag.iti__ph {
    height: 10px;
    background-position: -3987px 0px; }
.iti__flag.iti__pk {
    height: 14px;
    background-position: -4009px 0px; }
.iti__flag.iti__pl {
    height: 13px;
    background-position: -4031px 0px; }
.iti__flag.iti__pm {
    height: 14px;
    background-position: -4053px 0px; }
.iti__flag.iti__pn {
    height: 10px;
    background-position: -4075px 0px; }
.iti__flag.iti__pr {
    height: 14px;
    background-position: -4097px 0px; }
.iti__flag.iti__ps {
    height: 10px;
    background-position: -4119px 0px; }
.iti__flag.iti__pt {
    height: 14px;
    background-position: -4141px 0px; }
.iti__flag.iti__pw {
    height: 13px;
    background-position: -4163px 0px; }
.iti__flag.iti__py {
    height: 11px;
    background-position: -4185px 0px; }
.iti__flag.iti__qa {
    height: 8px;
    background-position: -4207px 0px; }
.iti__flag.iti__re {
    height: 14px;
    background-position: -4229px 0px; }
.iti__flag.iti__ro {
    height: 14px;
    background-position: -4251px 0px; }
.iti__flag.iti__rs {
    height: 14px;
    background-position: -4273px 0px; }
.iti__flag.iti__ru {
    height: 14px;
    background-position: -4295px 0px; }
.iti__flag.iti__rw {
    height: 14px;
    background-position: -4317px 0px; }
.iti__flag.iti__sa {
    height: 14px;
    background-position: -4339px 0px; }
.iti__flag.iti__sb {
    height: 10px;
    background-position: -4361px 0px; }
.iti__flag.iti__sc {
    height: 10px;
    background-position: -4383px 0px; }
.iti__flag.iti__sd {
    height: 10px;
    background-position: -4405px 0px; }
.iti__flag.iti__se {
    height: 13px;
    background-position: -4427px 0px; }
.iti__flag.iti__sg {
    height: 14px;
    background-position: -4449px 0px; }
.iti__flag.iti__sh {
    height: 10px;
    background-position: -4471px 0px; }
.iti__flag.iti__si {
    height: 10px;
    background-position: -4493px 0px; }
.iti__flag.iti__sj {
    height: 15px;
    background-position: -4515px 0px; }
.iti__flag.iti__sk {
    height: 14px;
    background-position: -4537px 0px; }
.iti__flag.iti__sl {
    height: 14px;
    background-position: -4559px 0px; }
.iti__flag.iti__sm {
    height: 15px;
    background-position: -4581px 0px; }
.iti__flag.iti__sn {
    height: 14px;
    background-position: -4603px 0px; }
.iti__flag.iti__so {
    height: 14px;
    background-position: -4625px 0px; }
.iti__flag.iti__sr {
    height: 14px;
    background-position: -4647px 0px; }
.iti__flag.iti__ss {
    height: 10px;
    background-position: -4669px 0px; }
.iti__flag.iti__st {
    height: 10px;
    background-position: -4691px 0px; }
.iti__flag.iti__sv {
    height: 12px;
    background-position: -4713px 0px; }
.iti__flag.iti__sx {
    height: 14px;
    background-position: -4735px 0px; }
.iti__flag.iti__sy {
    height: 14px;
    background-position: -4757px 0px; }
.iti__flag.iti__sz {
    height: 14px;
    background-position: -4779px 0px; }
.iti__flag.iti__ta {
    height: 10px;
    background-position: -4801px 0px; }
.iti__flag.iti__tc {
    height: 10px;
    background-position: -4823px 0px; }
.iti__flag.iti__td {
    height: 14px;
    background-position: -4845px 0px; }
.iti__flag.iti__tf {
    height: 14px;
    background-position: -4867px 0px; }
.iti__flag.iti__tg {
    height: 13px;
    background-position: -4889px 0px; }
.iti__flag.iti__th {
    height: 14px;
    background-position: -4911px 0px; }
.iti__flag.iti__tj {
    height: 10px;
    background-position: -4933px 0px; }
.iti__flag.iti__tk {
    height: 10px;
    background-position: -4955px 0px; }
.iti__flag.iti__tl {
    height: 10px;
    background-position: -4977px 0px; }
.iti__flag.iti__tm {
    height: 14px;
    background-position: -4999px 0px; }
.iti__flag.iti__tn {
    height: 14px;
    background-position: -5021px 0px; }
.iti__flag.iti__to {
    height: 10px;
    background-position: -5043px 0px; }
.iti__flag.iti__tr {
    height: 14px;
    background-position: -5065px 0px; }
.iti__flag.iti__tt {
    height: 12px;
    background-position: -5087px 0px; }
.iti__flag.iti__tv {
    height: 10px;
    background-position: -5109px 0px; }
.iti__flag.iti__tw {
    height: 14px;
    background-position: -5131px 0px; }
.iti__flag.iti__tz {
    height: 14px;
    background-position: -5153px 0px; }
.iti__flag.iti__ua {
    height: 14px;
    background-position: -5175px 0px; }
.iti__flag.iti__ug {
    height: 14px;
    background-position: -5197px 0px; }
.iti__flag.iti__um {
    height: 11px;
    background-position: -5219px 0px; }
.iti__flag.iti__un {
    height: 14px;
    background-position: -5241px 0px; }
.iti__flag.iti__us {
    height: 11px;
    background-position: -5263px 0px; }
.iti__flag.iti__uy {
    height: 14px;
    background-position: -5285px 0px; }
.iti__flag.iti__uz {
    height: 10px;
    background-position: -5307px 0px; }
.iti__flag.iti__va {
    height: 15px;
    background-position: -5329px 0px; }
.iti__flag.iti__vc {
    height: 14px;
    background-position: -5346px 0px; }
.iti__flag.iti__ve {
    height: 14px;
    background-position: -5368px 0px; }
.iti__flag.iti__vg {
    height: 10px;
    background-position: -5390px 0px; }
.iti__flag.iti__vi {
    height: 14px;
    background-position: -5412px 0px; }
.iti__flag.iti__vn {
    height: 14px;
    background-position: -5434px 0px; }
.iti__flag.iti__vu {
    height: 12px;
    background-position: -5456px 0px; }
.iti__flag.iti__wf {
    height: 14px;
    background-position: -5478px 0px; }
.iti__flag.iti__ws {
    height: 10px;
    background-position: -5500px 0px; }
.iti__flag.iti__xk {
    height: 15px;
    background-position: -5522px 0px; }
.iti__flag.iti__ye {
    height: 14px;
    background-position: -5544px 0px; }
.iti__flag.iti__yt {
    height: 14px;
    background-position: -5566px 0px; }
.iti__flag.iti__za {
    height: 14px;
    background-position: -5588px 0px; }
.iti__flag.iti__zm {
    height: 14px;
    background-position: -5610px 0px; }
.iti__flag.iti__zw {
    height: 10px;
    background-position: -5632px 0px; }

.iti__flag {
    height: 15px;
    box-shadow: 0px 0px 1px 0px #888;
    background-image: url('{{ img(\"visiosoft.theme.base::images/flags.png\").path }}');
    background-repeat: no-repeat;
    background-color: #DBDBDB;
    background-position: 20px 0; }
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {
        background-image: url('{{ img(\"visiosoft.theme.base::images/flags@2x.png\").url }}'); } }

.iti__flag.iti__np {
    background-color: transparent;
}

.iti--allow-dropdown {
    width: 100%;
}", "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8d97feb171916a9b4b75d22f6a3de8e4.twig", "C:\\wamp64\\www\\ocify\\storage\\streams\\default/support/parsed/8d97feb171916a9b4b75d22f6a3de8e4.twig");
    }
}
