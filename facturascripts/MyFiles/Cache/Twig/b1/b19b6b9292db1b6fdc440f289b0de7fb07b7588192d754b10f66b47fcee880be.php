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

/* Master/ListController.html.twig */
class __TwigTemplate_fe11c6ad81e53b762bfb37d72c5ebb97d3bc9466a2302e5452d5483b0dbb762c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'bodyHeaderOptions' => [$this, 'block_bodyHeaderOptions'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 20
        return "Master/MenuBghTemplate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/MenuBghTemplate.html.twig", "Master/ListController.html.twig", 20);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_bodyHeaderOptions($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "    ";
        $this->displayParentBlock("bodyHeaderOptions", $context, $blocks);
        echo "
    ";
        // line 24
        $context["pageData"] = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getPageData", [], "method", false, false, false, 24);
        // line 25
        echo "    ";
        $context["firstView"] = twig_first($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 25));
        // line 26
        echo "    <div class=\"container-fluid mb-3 d-print-none\">
        <div class=\"row\">
            <div class=\"col-md-7\">
                ";
        // line 30
        echo "                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb d-md-none\">
                        <li class=\"breadcrumb-item\">
                            <a href=\"#\">";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "menu", [], "any", false, false, false, 33)), "html", null, true);
        echo "</a>
                        </li>
                        ";
        // line 35
        if (twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "submenu", [], "any", false, false, false, 35)) {
            // line 36
            echo "                            <li class=\"breadcrumb-item\">
                                <a href=\"#\">";
            // line 37
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "submenu", [], "any", false, false, false, 37)), "html", null, true);
            echo "</a>
                            </li>
                        ";
        }
        // line 40
        echo "                        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 40), "html", null, true);
        echo "</li>
                    </ol>
                </nav>
                <div class=\"btn-group\">
                    <a class=\"btn btn-sm btn-secondary\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 44), "html", null, true);
        echo "\"
                       title=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("refresh"), "html", null, true);
        echo "\">
                        <i class=\"fas fa-redo\" aria-hidden=\"true\"></i>
                    </a>
                    ";
        // line 48
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "name", [], "any", false, false, false, 48), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "user", [], "any", false, false, false, 48), "homepage", [], "any", false, false, false, 48)))) {
            // line 49
            echo "                        <a class=\"btn btn-sm btn-secondary active\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 49), "html", null, true);
            echo "?defaultPage=FALSE\"
                           title=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("marked-as-homepage"), "html", null, true);
            echo "\">
                            <i class=\"fas fa-bookmark\" aria-hidden=\"true\"></i>
                        </a>
                    ";
        } else {
            // line 54
            echo "                        <a class=\"btn btn-sm btn-secondary\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 54), "html", null, true);
            echo "?defaultPage=TRUE\"
                           title=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("mark-as-homepage"), "html", null, true);
            echo "\">
                            <i class=\"far fa-bookmark\" aria-hidden=\"true\"></i>
                        </a>
                    ";
        }
        // line 59
        echo "                </div>
                ";
        // line 61
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "settings", [], "any", false, false, false, 61), "btnOptions", [], "any", false, false, false, 61)) {
            // line 62
            echo "                    <div class=\"btn-group\">
                        <div class=\"dropdown\">
                            <button class=\"btn btn-sm btn-secondary dropdown-toggle\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                <i class=\"fas fa-wrench fa-fw\" aria-hidden=\"true\"></i> ";
            // line 66
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("options"), "html", null, true);
            echo "
                            </button>
                            <div class=\"dropdown-menu\">
                                <h6 class=\"dropdown-header\">";
            // line 69
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("options-button-header"), "html", null, true);
            echo "</h6>
                                ";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 70));
            foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
                // line 71
                echo "                                    <a class=\"dropdown-item\"
                                       href=\"EditPageOption?code=";
                // line 72
                echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                echo "&url=";
                echo twig_escape_filter($this->env, twig_urlencode_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "model", [], "any", false, false, false, 72), "url", [], "method", false, false, false, 72)), "html", null, true);
                echo "\">
                                        <i class=\"";
                // line 73
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "icon", [], "any", false, false, false, 73), "html", null, true);
                echo " fa-fw\" aria-hidden=\"true\"></i> ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 73), "html", null, true);
                echo "
                                        ";
                // line 74
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 74), "customized", [], "any", false, false, false, 74)) {
                    // line 75
                    echo "                                            <i class=\"fa-solid fa-user-pen ml-2\" title=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("personalized"), "html", null, true);
                    echo "\"></i>
                                        ";
                }
                // line 77
                echo "                                    </a>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "                            </div>
                        </div>
                    </div>
                ";
        }
        // line 83
        echo "            </div>
            <div class=\"col-md-5 text-right\">
                <h1 class=\"h4 mb-0 d-none d-md-inline-block\">
                    ";
        // line 86
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 86), "html", null, true);
        echo "<i class=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "icon", [], "any", false, false, false, 86), "html", null, true);
        echo " ml-3\" aria-hidden=\"true\"></i>
                </h1>
            </div>
        </div>
    </div>
    ";
        // line 92
        echo "    <ul class=\"nav nav-tabs d-print-none\" id=\"mainTabs\" role=\"tablist\">
        ";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 93));
        foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
            // line 94
            echo "            <li class=\"nav-item\">
                ";
            // line 95
            $context["active"] = (((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 95)))) ? (" active") : (""));
            // line 96
            echo "                <a href=\"#";
            echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
            echo "\" class=\"nav-link";
            echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
            echo "\" data-toggle=\"tab\" role=\"tab\"
                   aria-controls=\"";
            // line 97
            echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 97), "html", null, true);
            echo "\">
                    <i class=\"";
            // line 98
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "icon", [], "any", false, false, false, 98), "html", null, true);
            echo "\" aria-hidden=\"true\"></i>
                    ";
            // line 99
            if ((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 99)), 15))) {
                // line 100
                echo "                        <span class=\"d-none d-sm-inline-block\">";
                echo twig_escape_filter($this->env, twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 100), 0, 15), "html", null, true);
                echo "...</span>
                    ";
            } else {
                // line 102
                echo "                        <span class=\"d-none d-sm-inline-block\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 102), "html", null, true);
                echo "</span>
                    ";
            }
            // line 104
            echo "                    ";
            if ((1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 104), 0))) {
                // line 105
                echo "                        <span class=\"badge badge-secondary\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "toolBox", [], "method", false, false, false, 105), "numbers", [], "method", false, false, false, 105), "format", [0 => twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 105), 1 => 0], "method", false, false, false, 105), "html", null, true);
                echo "</span>
                    ";
            }
            // line 107
            echo "                </a>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "    </ul>
";
    }

    // line 113
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 114
        echo "    ";
        $this->displayParentBlock("body", $context, $blocks);
        echo "
    ";
        // line 116
        echo "    <div class=\"tab-content pt-3\" id=\"mainTabsContent\">
        ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 117));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
            // line 118
            echo "            ";
            $context["active"] = (((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 118)))) ? (" show active") : (""));
            // line 119
            echo "            <div class=\"tab-pane fade";
            echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
            echo "\" role=\"tabpanel\">
                ";
            // line 120
            twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "setCurrentView", [0 => $context["viewName"]], "method", false, false, false, 120);
            // line 121
            echo "                ";
            echo twig_include($this->env, $context, twig_get_attribute($this->env, $this->source, $context["view"], "template", [], "any", false, false, false, 121));
            echo "
            </div>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "    </div>
";
    }

    // line 127
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 128
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script>
        \$(document).ready(function () {
            if (document.location.hash) {
                \$(\".nav-tabs a[href=\\\\\" + document.location.hash + \"]\").tab('show');
            }
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) == false) {
                \$(\"input[name='query']:visible\").focus();
            }
            \$('.nav-tabs a').click(function (e) {
                \$(this).tab('show');
                var scrollmem = \$('body').scrollTop();
                window.location.hash = this.hash;
                \$('html,body').scrollTop(scrollmem);
            });
            \$('a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) == false) {
                    \$(\"input[name='query']:visible\").focus();
                }
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "Master/ListController.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  342 => 128,  338 => 127,  333 => 124,  315 => 121,  313 => 120,  306 => 119,  303 => 118,  286 => 117,  283 => 116,  278 => 114,  274 => 113,  269 => 110,  261 => 107,  255 => 105,  252 => 104,  246 => 102,  240 => 100,  238 => 99,  234 => 98,  228 => 97,  221 => 96,  219 => 95,  216 => 94,  212 => 93,  209 => 92,  199 => 86,  194 => 83,  188 => 79,  181 => 77,  175 => 75,  173 => 74,  167 => 73,  161 => 72,  158 => 71,  154 => 70,  150 => 69,  144 => 66,  138 => 62,  135 => 61,  132 => 59,  125 => 55,  120 => 54,  113 => 50,  108 => 49,  106 => 48,  100 => 45,  96 => 44,  88 => 40,  82 => 37,  79 => 36,  77 => 35,  72 => 33,  67 => 30,  62 => 26,  59 => 25,  57 => 24,  52 => 23,  48 => 22,  37 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/ListController.html.twig", "/var/www/html/Dinamic/View/Master/ListController.html.twig");
    }
}
