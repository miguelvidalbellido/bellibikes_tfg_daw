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

/* Master/PanelController.html.twig */
class __TwigTemplate_9c2b7336bd3b8a94678aabc0a4742b4847bcb8042dd747f20ba878f6c5a9a01d extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doGetParent(array $context)
    {
        // line 20
        return "Master/MenuBgTemplate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/MenuBgTemplate.html.twig", "Master/PanelController.html.twig", 20);
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
        echo "    <div class=\"container-fluid d-print-none\">
        <div class=\"row\">
            <div class=\"col-md-12\">
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
        echo "                        <li class=\"breadcrumb-item\">
                            <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 41), "url", [0 => "list"], "method", false, false, false, 41), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "title", [], "any", false, false, false, 41)), "html", null, true);
        echo "</a>
                        </li>
                        <li class=\"breadcrumb-item active\" aria-current=\"page\">
                            ";
        // line 44
        if (twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "hasData", [], "any", false, false, false, 44)) {
            // line 45
            echo "                                ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 45), "primaryDescription", [], "method", false, false, false, 45);
            echo "
                            ";
        } else {
            // line 47
            echo "                                ";
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
            echo "
                            ";
        }
        // line 49
        echo "                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class=\"row\">
            ";
        // line 56
        echo "            <div class=\"col-md-8 mb-2\">
                <div class=\"btn-group\">
                    <a href=\"";
        // line 58
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 58), "url", [0 => "list"], "method", false, false, false, 58), "html", null, true);
        echo "\" class=\"btn btn-sm btn-secondary\">
                        <i class=\"fas fa-list fa-fw\" aria-hidden=\"true\"></i>
                        <span class=\"d-none d-lg-inline-block\">";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("all"), "html", null, true);
        echo "</span>
                    </a>
                    <a href=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 62), "url", [0 => "edit"], "method", false, false, false, 62), "html", null, true);
        echo "\" class=\"btn btn-sm btn-secondary\"
                       title=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("refresh"), "html", null, true);
        echo "\">
                        <i class=\"fas fa-redo\" aria-hidden=\"true\"></i>
                    </a>
                </div>
                ";
        // line 68
        echo "                ";
        echo twig_call_macro($macros["_self"], "macro_optionsButton", [($context["fsc"] ?? null), ($context["firstView"] ?? null), ($context["i18n"] ?? null)], 68, $context, $this->getSourceContext());
        echo "
                ";
        // line 70
        echo "                ";
        if ((twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "hasData", [], "any", false, false, false, 70) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "settings", [], "any", false, false, false, 70), "btnNew", [], "any", false, false, false, 70))) {
            // line 71
            echo "                    <a href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 71), "url", [0 => "new"], "method", false, false, false, 71), "html", null, true);
            echo "\" class=\"btn btn-sm btn-success\">
                        <i class=\"fas fa-plus fa-fw\" aria-hidden=\"true\"></i>
                        <span class=\"d-none d-lg-inline-block\">";
            // line 73
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
            echo "</span>
                    </a>
                ";
        }
        // line 76
        echo "                ";
        // line 77
        echo "                ";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "getRow", [0 => "actions"], "method", false, false, false, 77), "renderTop", [], "method", false, false, false, 77);
        echo "
                ";
        // line 79
        echo "                ";
        if ((twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "hasData", [], "any", false, false, false, 79) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "settings", [], "any", false, false, false, 79), "btnPrint", [], "any", false, false, false, 79))) {
            // line 80
            echo "                    ";
            echo twig_call_macro($macros["_self"], "macro_printButton", [($context["fsc"] ?? null), ($context["firstView"] ?? null), ($context["i18n"] ?? null)], 80, $context, $this->getSourceContext());
            echo "
                ";
        }
        // line 82
        echo "            </div>
            ";
        // line 84
        echo "            <div class=\"col-md d-none d-md-inline-block text-right\">
                ";
        // line 85
        $context["image"] = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getImageUrl", [], "method", false, false, false, 85);
        // line 86
        echo "                ";
        if (twig_test_empty(($context["image"] ?? null))) {
            // line 87
            echo "                    <i class=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "icon", [], "any", false, false, false, 87), "html", null, true);
            echo " fa-3x pl-3 float-right\" aria-hidden=\"true\"></i>
                ";
        } else {
            // line 89
            echo "                    <img src=\"";
            echo twig_escape_filter($this->env, ($context["image"] ?? null), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 89), "html", null, true);
            echo "\" class=\"img-thumbnail ml-3 mb-2 float-right\"/>
                ";
        }
        // line 91
        echo "                <h1 class=\"h5 mb-0\">";
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["pageData"] ?? null), "title", [], "any", false, false, false, 91)), "html", null, true);
        echo "</h1>
                ";
        // line 92
        if (twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "hasData", [], "any", false, false, false, 92)) {
            // line 93
            echo "                    <p class=\"text-info mb-3\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 93), "primaryDescription", [], "method", false, false, false, 93);
            echo "</p>
                ";
        } else {
            // line 95
            echo "                    <p class=\"text-info mb-3\">";
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
            echo "</p>
                ";
        }
        // line 97
        echo "            </div>
        </div>
    </div>
";
    }

    // line 102
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 103
        echo "    ";
        $context["firstView"] = twig_first($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 103));
        // line 104
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            ";
        // line 107
        echo "            ";
        if ((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 107)), 1))) {
            // line 108
            echo "                <div class=\"col-lg-2\">
                    ";
            // line 110
            echo "                    <div class=\"nav nav-pills flex-row flex-lg-column pb-3\" id=\"mainTabs\" role=\"tablist\">
                        ";
            // line 111
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 111));
            foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
                // line 112
                echo "                            ";
                $context["active"] = (((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 112)))) ? (" active") : (""));
                // line 113
                echo "                            ";
                $context["disable"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 113), "active", [], "any", false, false, false, 113)) ? ("") : (" disabled"));
                // line 114
                echo "                            <a class=\"nav-link";
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["disable"] ?? null), "html", null, true);
                echo "\" id=\"";
                echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                echo "-tab\" data-toggle=\"pill\"
                               href=\"#";
                // line 115
                echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                echo "\" role=\"tab\" aria-controls=\"";
                echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                echo "\" aria-expanded=\"true\">
                                <i class=\"";
                // line 116
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "icon", [], "any", false, false, false, 116), "html", null, true);
                echo " fa-fw mr-1 d-none d-xl-inline-block\"
                                   aria-hidden=\"true\"></i>";
                // line 117
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 117), "html", null, true);
                echo "
                                ";
                // line 118
                if (((0 <= twig_compare(twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 118), 1)) && (0 !== twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "getViewName", [], "method", false, false, false, 118))))) {
                    // line 119
                    echo "                                    <span class='badge badge-secondary mt-lg-1 mb-lg-1 float-lg-right'>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 119), "html", null, true);
                    echo "</span>
                                ";
                }
                // line 121
                echo "                            </a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 123
            echo "                    </div>
                </div>
            ";
        }
        // line 126
        echo "            ";
        // line 127
        echo "            ";
        $context["rightPanelClass"] = (((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 127)), 1))) ? ("col-lg-10") : ("col"));
        // line 128
        echo "            <div class=\"";
        echo twig_escape_filter($this->env, ($context["rightPanelClass"] ?? null), "html", null, true);
        echo "\">
                ";
        // line 130
        echo "                <div class=\"tab-content\" id=\"mainTabsContent\">
                    ";
        // line 131
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 131));
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
            // line 132
            echo "                        ";
            $context["active"] = (((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 132)))) ? (" show active") : (""));
            // line 133
            echo "                        <div class=\"tab-pane fade";
            echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
            echo "\" role=\"tabpanel\"
                             aria-labelledby=\"";
            // line 134
            echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
            echo "-tab\">
                            ";
            // line 135
            twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "setCurrentView", [0 => $context["viewName"]], "method", false, false, false, 135);
            // line 136
            echo "                            ";
            echo twig_include($this->env, $context, twig_get_attribute($this->env, $this->source, $context["view"], "template", [], "any", false, false, false, 136));
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
        // line 139
        echo "                </div>
            </div>
        </div>
    </div>
";
    }

    // line 145
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 146
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script>
        \$(document).ready(function () {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) == false) {
                \$(\"input:visible,textarea:visible\").filter(\":not([readonly='readonly']):not([disabled='disabled']):not([type='hidden']):not([type='checkbox']):not([type='radio'])\").first().focus();
            }
        });
    </script>
";
    }

    // line 156
    public function macro_optionsButton($__fsc__ = null, $__firstView__ = null, $__i18n__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "firstView" => $__firstView__,
            "i18n" => $__i18n__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 157
            echo "    ";
            $context["show"] = false;
            // line 158
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 158));
            foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
                // line 159
                echo "        ";
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 159), "active", [], "any", false, false, false, 159) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["view"], "columns", [], "any", false, false, false, 159)))) {
                    // line 160
                    echo "            ";
                    $context["show"] = true;
                    // line 161
                    echo "        ";
                }
                // line 162
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 163
            echo "    ";
            if ((($context["show"] ?? null) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "settings", [], "any", false, false, false, 163), "btnOptions", [], "any", false, false, false, 163))) {
                // line 164
                echo "        <div class=\"btn-group\">
            <div class=\"dropdown\">
                <button class=\"btn btn-sm btn-secondary mr-3 dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                    <i class=\"fas fa-wrench fa-fw\" aria-hidden=\"true\"></i>
                    <span class=\"d-none d-lg-inline-block\">";
                // line 169
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("options"), "html", null, true);
                echo "</span>
                </button>
                <div class=\"dropdown-menu\">
                    <h6 class=\"dropdown-header\">";
                // line 172
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("options-button-header"), "html", null, true);
                echo "</h6>
                    ";
                // line 173
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 173));
                foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
                    // line 174
                    echo "                        ";
                    if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 174), "active", [], "any", false, false, false, 174) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["view"], "columns", [], "any", false, false, false, 174)))) {
                        // line 175
                        echo "                            <a class=\"dropdown-item\"
                               href=\"EditPageOption?code=";
                        // line 176
                        echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                        echo "&url=";
                        echo twig_escape_filter($this->env, twig_urlencode_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 176), "url", [], "method", false, false, false, 176)), "html", null, true);
                        echo "\">
                                <i class=\"";
                        // line 177
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "icon", [], "any", false, false, false, 177), "html", null, true);
                        echo " fa-fw\" aria-hidden=\"true\"></i> ";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 177), "html", null, true);
                        echo "
                                ";
                        // line 178
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 178), "customized", [], "any", false, false, false, 178)) {
                            // line 179
                            echo "                                    <i class=\"fas fa-user-pen ml-2\" title=\"";
                            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("personalized"), "html", null, true);
                            echo "\"></i>
                                ";
                        }
                        // line 181
                        echo "                            </a>
                        ";
                    }
                    // line 183
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 184
                echo "                </div>
            </div>
        </div>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 190
    public function macro_printButton($__fsc__ = null, $__firstView__ = null, $__i18n__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "firstView" => $__firstView__,
            "i18n" => $__i18n__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 191
            echo "    <div class=\"btn-group\">
        <a href=\"";
            // line 192
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 192), "url", [], "method", false, false, false, 192), "html", null, true);
            echo "&action=export&option=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 192), "defaultOption", [], "method", false, false, false, 192), "html", null, true);
            echo "\"
           target=\"_blank\" class=\"btn btn-sm btn-secondary\">
            <i class=\"fas fa-print fa-fw\" aria-hidden=\"true\"></i>
            <span class=\"d-none d-lg-inline-block\">";
            // line 195
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("print"), "html", null, true);
            echo "</span>
        </a>
        <button type=\"button\" class=\"btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split\"
                data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            <span class=\"sr-only\">";
            // line 199
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("more"), "html", null, true);
            echo "</span>
        </button>
        <div class=\"dropdown-menu dropdown-menu-right\">
            ";
            // line 202
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 202), "options", [], "method", false, false, false, 202));
            foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                // line 203
                echo "                ";
                if ((0 !== twig_compare($context["key"], twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 203), "defaultOption", [], "method", false, false, false, 203)))) {
                    // line 204
                    echo "                    <a href=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 204), "url", [], "method", false, false, false, 204), "html", null, true);
                    echo "&action=export&option=";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\" class=\"dropdown-item\">
                        <i class=\"";
                    // line 205
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "icon", [], "any", false, false, false, 205), "html", null, true);
                    echo " fa-fw\" aria-hidden=\"true\"></i>
                        ";
                    // line 206
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["option"], "description", [], "any", false, false, false, 206)), "html", null, true);
                    echo "
                    </a>
                ";
                }
                // line 209
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 210
            echo "            <div class=\"dropdown-divider\"></div>
            <a href=\"#\" class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#advancedExportModal\">
                <i class=\"fas fa-tools fa-fw\" aria-hidden=\"true\"></i>
                ";
            // line 213
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("advanced"), "html", null, true);
            echo "
            </a>
            ";
            // line 215
            $context["tools"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 215), "tools", [], "method", false, false, false, 215);
            // line 216
            echo "            ";
            if ( !twig_test_empty(($context["tools"] ?? null))) {
                // line 217
                echo "                <div class=\"dropdown-divider\"></div>
                ";
                // line 218
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["tools"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["tool"]) {
                    // line 219
                    echo "                    <a href=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tool"], "link", [], "any", false, false, false, 219), "html", null, true);
                    echo "\" target=\"_blank\" class=\"dropdown-item\">
                        <i class=\"";
                    // line 220
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tool"], "icon", [], "any", false, false, false, 220), "html", null, true);
                    echo " fa-fw\" aria-hidden=\"true\"></i>
                        ";
                    // line 221
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["tool"], "description", [], "any", false, false, false, 221)), "html", null, true);
                    echo "
                    </a>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['tool'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 224
                echo "            ";
            }
            // line 225
            echo "        </div>
    </div>
    <form action=\"";
            // line 227
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 227), "url", [], "method", false, false, false, 227), "html", null, true);
            echo "\" method=\"post\" target=\"_blank\">
        <input type=\"hidden\" name=\"action\" value=\"export\"/>
        <div class=\"modal fade\" id=\"advancedExportModal\" tabindex=\"-1\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\">
                            <i class=\"fas fa-tools fa-fw\" aria-hidden=\"true\"></i>
                            ";
            // line 235
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("advanced"), "html", null, true);
            echo "
                        </h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class=\"modal-body text-left\">
                        <div class=\"form-group\">
                            <select name=\"option\" class=\"form-control\">
                                ";
            // line 244
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 244), "options", [], "method", false, false, false, 244));
            foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                // line 245
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["option"], "description", [], "any", false, false, false, 245)), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 247
            echo "                            </select>
                        </div>
                        <div class=\"form-group\">
                            ";
            // line 250
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("format"), "html", null, true);
            echo "
                            <select name=\"idformat\" class=\"form-control\">
                                <option value=\"\">";
            // line 252
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("default"), "html", null, true);
            echo "</option>
                                <option value=\"\">------</option>
                                ";
            // line 254
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 254), "getFormats", [0 => twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 254)], "method", false, false, false, 254));
            foreach ($context['_seq'] as $context["_key"] => $context["format"]) {
                // line 255
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["format"], "id", [], "any", false, false, false, 255), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["format"], "nombre", [], "any", false, false, false, 255), "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['format'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 257
            echo "                            </select>
                        </div>
                        <div class=\"form-group\">
                            ";
            // line 260
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("language"), "html", null, true);
            echo "
                            <select name=\"langcode\" class=\"form-control\">
                                <option value=\"\">";
            // line 262
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("default"), "html", null, true);
            echo "</option>
                                <option value=\"\">------</option>
                                ";
            // line 264
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "getAvailableLanguages", [], "method", false, false, false, 264));
            foreach ($context['_seq'] as $context["code"] => $context["lang"]) {
                // line 265
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, $context["code"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["lang"], "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['code'], $context['lang'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 267
            echo "                            </select>
                        </div>
                        <div class=\"text-right\">
                            <button type=\"submit\" class=\"btn btn-primary\">
                                ";
            // line 271
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("accept"), "html", null, true);
            echo "
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "Master/PanelController.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  727 => 271,  721 => 267,  710 => 265,  706 => 264,  701 => 262,  696 => 260,  691 => 257,  680 => 255,  676 => 254,  671 => 252,  666 => 250,  661 => 247,  650 => 245,  646 => 244,  634 => 235,  623 => 227,  619 => 225,  616 => 224,  607 => 221,  603 => 220,  598 => 219,  594 => 218,  591 => 217,  588 => 216,  586 => 215,  581 => 213,  576 => 210,  570 => 209,  564 => 206,  560 => 205,  553 => 204,  550 => 203,  546 => 202,  540 => 199,  533 => 195,  525 => 192,  522 => 191,  507 => 190,  494 => 184,  488 => 183,  484 => 181,  478 => 179,  476 => 178,  470 => 177,  464 => 176,  461 => 175,  458 => 174,  454 => 173,  450 => 172,  444 => 169,  437 => 164,  434 => 163,  428 => 162,  425 => 161,  422 => 160,  419 => 159,  414 => 158,  411 => 157,  396 => 156,  382 => 146,  378 => 145,  370 => 139,  352 => 136,  350 => 135,  346 => 134,  339 => 133,  336 => 132,  319 => 131,  316 => 130,  311 => 128,  308 => 127,  306 => 126,  301 => 123,  294 => 121,  288 => 119,  286 => 118,  282 => 117,  278 => 116,  272 => 115,  264 => 114,  261 => 113,  258 => 112,  254 => 111,  251 => 110,  248 => 108,  245 => 107,  241 => 104,  238 => 103,  234 => 102,  227 => 97,  221 => 95,  215 => 93,  213 => 92,  208 => 91,  200 => 89,  194 => 87,  191 => 86,  189 => 85,  186 => 84,  183 => 82,  177 => 80,  174 => 79,  169 => 77,  167 => 76,  161 => 73,  155 => 71,  152 => 70,  147 => 68,  140 => 63,  136 => 62,  131 => 60,  126 => 58,  122 => 56,  114 => 49,  108 => 47,  102 => 45,  100 => 44,  92 => 41,  89 => 40,  83 => 37,  80 => 36,  78 => 35,  73 => 33,  68 => 30,  63 => 26,  60 => 25,  58 => 24,  53 => 23,  49 => 22,  38 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/PanelController.html.twig", "/var/www/html/Dinamic/View/Master/PanelController.html.twig");
    }
}
