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

/* Master/ListView.html.twig */
class __TwigTemplate_6d208f8dfd9abd3b8352d57bd13722933defb49def473e6a69040a88c16c2824 extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 20
        $context["currentView"] = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getCurrentView", [], "method", false, false, false, 20);
        // line 21
        $context["formName"] = ("form" . twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 21));
        // line 22
        echo "
<script>
    var listViewDeleteCancel = \"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("cancel"), "html", null, true);
        echo "\";
    var listViewDeleteConfirm = \"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("confirm"), "html", null, true);
        echo "\";
    var listViewDeleteMessage = \"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("are-you-sure"), "html", null, true);
        echo "\";
    var listViewDeleteTitle = \"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("confirm-delete"), "html", null, true);
        echo "\";
</script>

<form id=\"";
        // line 30
        echo twig_escape_filter($this->env, ($context["formName"] ?? null), "html", null, true);
        echo "\" method=\"post\">
    <input type=\"hidden\" name=\"action\"/>
    <input type=\"hidden\" name=\"activetab\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 32), "html", null, true);
        echo "\"/>
    <input type=\"hidden\" name=\"loadfilter\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "pageFilterKey", [], "any", false, false, false, 33), "html", null, true);
        echo "\"/>
    <input type=\"hidden\" name=\"multireqtoken\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "multiRequestProtection", [], "any", false, false, false, 34), "newToken", [], "method", false, false, false, 34), "html", null, true);
        echo "\"/>
    <input type=\"hidden\" name=\"offset\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "offset", [], "any", false, false, false, 35), "html", null, true);
        echo "\"/>
    <input type=\"hidden\" name=\"order\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderKey", [], "any", false, false, false, 36), "html", null, true);
        echo "\"/>
    <div class=\"";
        // line 37
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 37), "card", [], "any", false, false, false, 37)) ? ("card shadow") : (""));
        echo "\">
        <div class=\"";
        // line 38
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 38), "card", [], "any", false, false, false, 38)) ? ("container-fluid pt-3") : ("container-fluid"));
        echo "\">
            <div class=\"form-row\">
                ";
        // line 41
        echo "                <div class=\"col-md-auto mb-2\">
                    ";
        // line 42
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 42), "btnNew", [], "any", false, false, false, 42)) {
            // line 43
            echo "                        ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 43), "modalInsert", [], "any", false, false, false, 43)) {
                // line 44
                echo "                            <button type=\"button\" class=\"btn btn-success\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
                echo "\"
                                    data-toggle=\"modal\" data-target=\"#modal";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 45), "modalInsert", [], "any", false, false, false, 45), "html", null, true);
                echo "\">
                                <i class=\"fas fa-plus fa-fw\" aria-hidden=\"true\"></i>
                                ";
                // line 47
                if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 47), "card", [], "any", false, false, false, 47), false))) {
                    // line 48
                    echo "                                    <span class=\"d-none d-xl-inline-block\">";
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
                    echo "</span>
                                ";
                }
                // line 50
                echo "                            </button>
                        ";
            } else {
                // line 52
                echo "                            <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "btnNewUrl", [], "method", false, false, false, 52)), "html", null, true);
                echo "\" class=\"btn btn-success\"
                               title=\"";
                // line 53
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
                echo "\"><i class=\"fas fa-plus fa-fw\" aria-hidden=\"true\"></i>
                                ";
                // line 54
                if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 54), "card", [], "any", false, false, false, 54), false))) {
                    // line 55
                    echo "                                    <span class=\"d-none d-xl-inline-block\">";
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
                    echo "</span>
                                ";
                }
                // line 57
                echo "                            </a>
                        ";
            }
            // line 59
            echo "                    ";
        }
        // line 60
        echo "                    ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 60), "btnDelete", [], "any", false, false, false, 60)) {
            // line 61
            echo "                        <button type=\"button\" class=\"btn btn-danger\"
                                onclick=\"listViewDelete('";
            // line 62
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 62), "html", null, true);
            echo "');\"
                                title=\"";
            // line 63
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("delete"), "html", null, true);
            echo "\">
                            <i class=\"fas fa-trash-alt fa-fw\" aria-hidden=\"true\"></i>
                        </button>
                    ";
        }
        // line 67
        echo "                    ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 67), "btnPrint", [], "any", false, false, false, 67)) {
            // line 68
            echo "                        <div class=\"btn-group\">
                            ";
            // line 69
            echo twig_call_macro($macros["_self"], "macro_printButton", [($context["fsc"] ?? null), ($context["currentView"] ?? null)], 69, $context, $this->getSourceContext());
            echo "
                        </div>
                    ";
        }
        // line 72
        echo "                    ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 72), "clickable", [], "any", false, false, false, 72)) {
            // line 73
            echo "                        <button type=\"button\" class=\"btn btn-light\"
                                onclick=\"listViewOpenTab('";
            // line 74
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 74), "html", null, true);
            echo "');\"
                                title=\"";
            // line 75
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("open-tab"), "html", null, true);
            echo "\">
                            <i class=\"fas fa-external-link-alt fa-fw\" aria-hidden=\"true\"></i>
                        </button>
                    ";
        }
        // line 79
        echo "                    ";
        // line 80
        echo "                    ";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "actions"], "method", false, false, false, 80), "render", [0 => true, 1 => twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 80)], "method", false, false, false, 80);
        echo "
                    ";
        // line 82
        echo "                    ";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "statistics"], "method", false, false, false, 82), "render", [0 => ($context["fsc"] ?? null)], "method", false, false, false, 82);
        echo "
                </div>
                <div class=\"col-sm mb-2\">
                    ";
        // line 86
        echo "                    ";
        echo twig_call_macro($macros["_self"], "macro_searchControl", [($context["currentView"] ?? null)], 86, $context, $this->getSourceContext());
        echo "
                </div>
                <div class=\"col-sm-auto text-right mb-2\">
                    ";
        // line 90
        echo "                    ";
        echo twig_call_macro($macros["_self"], "macro_filterButton", [($context["currentView"] ?? null), ($context["fsc"] ?? null)], 90, $context, $this->getSourceContext());
        echo "
                    ";
        // line 92
        echo "                    ";
        echo twig_call_macro($macros["_self"], "macro_sortButton", [($context["currentView"] ?? null)], 92, $context, $this->getSourceContext());
        echo "
                    ";
        // line 94
        echo "                    ";
        echo twig_call_macro($macros["_self"], "macro_colorsButton", [($context["currentView"] ?? null)], 94, $context, $this->getSourceContext());
        echo "
                </div>
            </div>
            ";
        // line 98
        echo "            ";
        $context["divFiltersStyle"] = ((twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "showFilters", [], "any", false, false, false, 98)) ? ("") : ("display: none;"));
        // line 99
        echo "            <div id=\"form";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 99), "html", null, true);
        echo "Filters\" class=\"form-row align-items-center border-bottom mb-3\"
                 style=\"";
        // line 100
        echo twig_escape_filter($this->env, ($context["divFiltersStyle"] ?? null), "html", null, true);
        echo "\">
                ";
        // line 101
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "filters", [], "any", false, false, false, 101));
        foreach ($context['_seq'] as $context["filterName"] => $context["filter"]) {
            // line 102
            echo "                    ";
            echo twig_get_attribute($this->env, $this->source, $context["filter"], "render", [], "method", false, false, false, 102);
            echo "
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['filterName'], $context['filter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "            </div>
            ";
        // line 106
        echo "            <div class=\"row\">
                ";
        // line 107
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "header"], "method", false, false, false, 107), "render", [0 => twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 107), 1 => "listViewSetAction", 2 => ($context["fsc"] ?? null)], "method", false, false, false, 107);
        echo "
            </div>
        </div>
        ";
        // line 111
        echo "        ";
        $context["pages"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getPagination", [], "method", false, false, false, 111);
        // line 112
        echo "        ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["pages"] ?? null)), 4))) {
            // line 113
            echo "            <div class=\"text-center pb-2\">
                <div class=\"btn-group\">
                    ";
            // line 115
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getPagination", [], "method", false, false, false, 115));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 116
                echo "                        ";
                $context["btnClass"] = ((twig_get_attribute($this->env, $this->source, $context["page"], "active", [], "any", false, false, false, 116)) ? ("btn btn-outline-dark active") : ("btn btn-outline-dark"));
                // line 117
                echo "                        <button type=\"button\" class=\"";
                echo twig_escape_filter($this->env, ($context["btnClass"] ?? null), "html", null, true);
                echo "\"
                                onclick=\"listViewSetOffset('";
                // line 118
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 118), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["page"], "offset", [], "any", false, false, false, 118), "html", null, true);
                echo "');\">
                            ";
                // line 119
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["page"], "num", [], "any", false, false, false, 119), "html", null, true);
                echo "
                        </button>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "                </div>
            </div>
        ";
        }
        // line 125
        echo "        ";
        // line 126
        echo "        <div class=\"table-responsive\">
            ";
        // line 127
        $context["tableClass"] = (((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "toolBox", [], "method", false, false, false, 127), "appSettings", [], "method", false, false, false, 127), "get", [0 => "default", 1 => "tablesize"], "method", false, false, false, 127), "small"))) ? ("table-sm") : (""));
        // line 128
        echo "            <table class=\"table table-hover mb-0 ";
        echo twig_escape_filter($this->env, ($context["tableClass"] ?? null), "html", null, true);
        echo "\">
                <thead>
                <tr>
                    ";
        // line 131
        if (((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "cursor", [], "any", false, false, false, 131)), 0)) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 131), "checkBoxes", [], "any", false, false, false, 131) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 131), "clickable", [], "any", false, false, false, 131)))) {
            // line 132
            echo "                        <th width=\"50\" class=\"text-center\">
                            ";
            // line 133
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 133), "checkBoxes", [], "any", false, false, false, 133)) {
                // line 134
                echo "                                <div class=\"form-check form-check-inline m-0 toggle-ext-link\">
                                    <input class=\"form-check-input listActionCB\" type=\"checkbox\"
                                           onclick=\"listViewCheckboxes('";
                // line 136
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 136), "html", null, true);
                echo "');\"/>
                                </div>
                            ";
            }
            // line 139
            echo "                            ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 139), "clickable", [], "any", false, false, false, 139)) {
                // line 140
                echo "                                <i class=\"fas fa-external-link-alt toggle-ext-link d-none\"
                                   title=\"";
                // line 141
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("open-tab"), "html", null, true);
                echo "\"></i>
                            ";
            }
            // line 143
            echo "                        </th>
                    ";
        }
        // line 145
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getColumns", [], "method", false, false, false, 145));
        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
            // line 146
            echo "                        ";
            echo twig_get_attribute($this->env, $this->source, $context["column"], "tableHeader", [], "method", false, false, false, 146);
            echo "
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        echo "                </tr>
                </thead>
                <tbody>
                ";
        // line 151
        $context["rowStatus"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "status"], "method", false, false, false, 151);
        // line 152
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "cursor", [], "any", false, false, false, 152));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["model"]) {
            // line 153
            echo "                    ";
            $context["trClass"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 153), "clickable", [], "any", false, false, false, 153)) ? (("clickableListRow " . twig_get_attribute($this->env, $this->source, ($context["rowStatus"] ?? null), "trClass", [0 => $context["model"]], "method", false, false, false, 153))) : (twig_get_attribute($this->env, $this->source, ($context["rowStatus"] ?? null), "trClass", [0 => $context["model"]], "method", false, false, false, 153)));
            // line 154
            echo "                    ";
            $context["trTitle"] = twig_get_attribute($this->env, $this->source, ($context["rowStatus"] ?? null), "trTitle", [0 => $context["model"]], "method", false, false, false, 154);
            // line 155
            echo "                    <tr class=\"";
            echo twig_escape_filter($this->env, ($context["trClass"] ?? null), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, ($context["trTitle"] ?? null), "html", null, true);
            echo "\" data-href=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(twig_get_attribute($this->env, $this->source, $context["model"], "url", [], "method", false, false, false, 155)), "html", null, true);
            echo "\">
                        ";
            // line 156
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 156), "checkBoxes", [], "any", false, false, false, 156) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 156), "clickable", [], "any", false, false, false, 156))) {
                // line 157
                echo "                            <td class=\"cancelClickable p-0 text-center align-middle\">
                                ";
                // line 158
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 158), "checkBoxes", [], "any", false, false, false, 158)) {
                    // line 159
                    echo "                                    <div class=\"form-check form-check-inline m-0 toggle-ext-link\">
                                        <input class=\"form-check-input listAction\" type=\"checkbox\" name=\"code[]\"
                                               value=\"";
                    // line 161
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["model"], "primaryColumnValue", [], "method", false, false, false, 161), "html", null, true);
                    echo "\"/>
                                    </div>
                                ";
                }
                // line 164
                echo "                                ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 164), "clickable", [], "any", false, false, false, 164)) {
                    // line 165
                    echo "                                    <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(twig_get_attribute($this->env, $this->source, $context["model"], "url", [], "method", false, false, false, 165)), "html", null, true);
                    echo "\" target=\"_blank\" class=\"toggle-ext-link d-none\"
                                       onauxclick=\"\$(this).addClass('text-dark');\" title=\"";
                    // line 166
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("open-tab"), "html", null, true);
                    echo "\">
                                        <i class=\"fas fa-external-link-alt\"></i>
                                    </a>
                                ";
                }
                // line 170
                echo "                            </td>
                        ";
            }
            // line 172
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getColumns", [], "method", false, false, false, 172));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 173
                echo "                            ";
                echo twig_get_attribute($this->env, $this->source, $context["column"], "tableCell", [0 => $context["model"]], "method", false, false, false, 173);
                echo "
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 175
            echo "                    </tr>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 177
            echo "                    <tr class=\"table-warning\">
                        <td colspan=\"";
            // line 178
            echo twig_escape_filter($this->env, (1 + twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getColumns", [], "method", false, false, false, 178))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("no-data"), "html", null, true);
            echo "</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['model'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 181
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 185
        echo "        ";
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "totalAmounts", [], "any", false, false, false, 185))) {
            // line 186
            echo "            <div class=\"table-responsive\">
                <table class=\"table table-sm table-hover mt-4 mb-0\">
                    <thead>
                    <tr>
                        <th></th>
                        ";
            // line 191
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "totalAmounts", [], "any", false, false, false, 191));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 192
                echo "                            <th class=\"text-right text-capitalize\">
                                ";
                // line 193
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 193)), "html", null, true);
                echo "
                            </th>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 196
            echo "                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class=\"text-right\">";
            // line 200
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("page-total-amount"), "html", null, true);
            echo "</td>
                        ";
            // line 201
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "totalAmounts", [], "any", false, false, false, 201));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 202
                echo "                            <td class=\"text-right\">
                                ";
                // line 203
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "toolBox", [], "method", false, false, false, 203), "numbers", [], "method", false, false, false, 203), "format", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "page", [], "any", false, false, false, 203)], "method", false, false, false, 203), "html", null, true);
                echo "
                            </td>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 206
            echo "                    </tr>
                    <tr>
                        <td class=\"text-right\">";
            // line 208
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("total-amount"), "html", null, true);
            echo "</td>
                        ";
            // line 209
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "totalAmounts", [], "any", false, false, false, 209));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 210
                echo "                            <td class=\"text-right\">
                                ";
                // line 211
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "toolBox", [], "method", false, false, false, 211), "numbers", [], "method", false, false, false, 211), "format", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "total", [], "any", false, false, false, 211)], "method", false, false, false, 211), "html", null, true);
                echo "
                            </td>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 214
            echo "                    </tr>
                    </tbody>
                </table>
            </div>
        ";
        }
        // line 219
        echo "        ";
        // line 220
        echo "        ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["pages"] ?? null)), 0))) {
            // line 221
            echo "            <div class=\"";
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "settings", [], "any", false, false, false, 221), "card", [], "any", false, false, false, 221)) ? ("card-footer text-center") : ("pt-3 text-center"));
            echo "\">
                <div class=\"btn-group\">
                    ";
            // line 223
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getPagination", [], "method", false, false, false, 223));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 224
                echo "                        ";
                $context["btnClass"] = ((twig_get_attribute($this->env, $this->source, $context["page"], "active", [], "any", false, false, false, 224)) ? ("btn btn-outline-dark active") : ("btn btn-outline-dark"));
                // line 225
                echo "                        <button type=\"button\" class=\"";
                echo twig_escape_filter($this->env, ($context["btnClass"] ?? null), "html", null, true);
                echo "\"
                                onclick=\"listViewSetOffset('";
                // line 226
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 226), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["page"], "offset", [], "any", false, false, false, 226), "html", null, true);
                echo "');\">
                            ";
                // line 227
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["page"], "num", [], "any", false, false, false, 227), "html", null, true);
                echo "
                        </button>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 230
            echo "                </div>
            </div>
        ";
        }
        // line 233
        echo "    </div>
    <br/>
    ";
        // line 236
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            ";
        // line 238
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "footer"], "method", false, false, false, 238), "render", [0 => twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 238), 1 => "listViewSetAction", 2 => ($context["fsc"] ?? null)], "method", false, false, false, 238);
        echo "
        </div>
    </div>
    ";
        // line 242
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "showFilters", [], "any", false, false, false, 242)) {
            // line 243
            echo "        ";
            echo twig_call_macro($macros["_self"], "macro_filterSaveModal", [($context["currentView"] ?? null)], 243, $context, $this->getSourceContext());
            echo "
    ";
        }
        // line 245
        echo "</form>

";
        // line 248
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getModals", [], "method", false, false, false, 248));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 249
            echo "    ";
            echo twig_get_attribute($this->env, $this->source, $context["group"], "modal", [0 => twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "model", [], "any", false, false, false, 249), 1 => twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 249)], "method", false, false, false, 249);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 251
        echo "
";
        // line 304
        echo "
";
        // line 342
        echo "
";
        // line 363
        echo "
";
        // line 390
        echo "
";
        // line 406
        echo "
";
    }

    // line 253
    public function macro_filterButton($__currentView__ = null, $__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "currentView" => $__currentView__,
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 254
            echo "    ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "filters", [], "any", false, false, false, 254))) {
                // line 255
                echo "        ";
                $context["viewName"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 255);
                // line 256
                echo "        ";
                if (twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "pageFilterKey", [], "any", false, false, false, 256)) {
                    // line 257
                    echo "            ";
                    // line 258
                    echo "            <a href=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 258), "html", null, true);
                    echo "?activetab=";
                    echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                    echo "\" class=\"btn btn-light\" title=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("all"), "html", null, true);
                    echo "\">
                <i class=\"fas fa-filter fa-fw\"></i> ";
                    // line 259
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("all"), "html", null, true);
                    echo "
            </a>
        ";
                } else {
                    // line 262
                    echo "            <button type=\"button\" class=\"btn btn-light\" onclick=\"listViewShowFilters('";
                    echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                    echo "');\">
                <i class=\"fas fa-filter fa-fw\"></i> ";
                    // line 263
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("filters"), "html", null, true);
                    echo "
            </button>
            ";
                    // line 265
                    if (twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "showFilters", [], "any", false, false, false, 265)) {
                        // line 266
                        echo "                ";
                        // line 267
                        echo "                <button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\"
                        data-target=\"#savefilter";
                        // line 268
                        echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                        echo "\"
                        title=\"";
                        // line 269
                        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("save-filter"), "html", null, true);
                        echo "\">
                    <i class=\"fas fa-save fa-fw\"></i> ";
                        // line 270
                        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("save"), "html", null, true);
                        echo "
                </button>
            ";
                    }
                    // line 273
                    echo "        ";
                }
                // line 274
                echo "        ";
                $context["saveFilters"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "pageFilters", [], "any", false, false, false, 274);
                // line 275
                echo "        ";
                if ( !twig_test_empty(($context["saveFilters"] ?? null))) {
                    // line 276
                    echo "            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["saveFilters"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["pageFilter"]) {
                        // line 277
                        echo "                ";
                        $context["icon"] = ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["pageFilter"], "nick", [], "any", false, false, false, 277))) ? ("fa-users") : ("fa-user"));
                        // line 278
                        echo "                ";
                        $context["filterDesc"] = (((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "description", [], "any", false, false, false, 278)), 10))) ? ((twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "description", [], "any", false, false, false, 278), 0, 10) . "...")) : (twig_get_attribute($this->env, $this->source, $context["pageFilter"], "description", [], "any", false, false, false, 278)));
                        // line 279
                        echo "                ";
                        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["pageFilter"], "id", [], "any", false, false, false, 279), twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "pageFilterKey", [], "any", false, false, false, 279)))) {
                            // line 280
                            echo "                    <div class=\"btn-group\">
                        ";
                            // line 282
                            echo "                        <button title=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "description", [], "any", false, false, false, 282), "html", null, true);
                            echo "\" class=\"btn btn-light active\"
                                onclick=\"listViewSetLoadFilter('";
                            // line 283
                            echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                            echo "', '";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "id", [], "any", false, false, false, 283), "html", null, true);
                            echo "');\">
                            <i class=\"fas fa-filter fa-fw\"></i> ";
                            // line 284
                            echo twig_escape_filter($this->env, ($context["filterDesc"] ?? null), "html", null, true);
                            echo "
                        </button>
                        ";
                            // line 287
                            echo "                        <button type=\"button\" class=\"btn btn-light text-danger\"
                                title=\"";
                            // line 288
                            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("remove-filter"), "html", null, true);
                            echo "\"
                                onclick=\"listViewSetAction('";
                            // line 289
                            echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                            echo "', 'delete-filter');\">
                            <i class=\"fas fa-trash-alt fa-fw\"></i>
                        </button>
                    </div>
                ";
                        } else {
                            // line 294
                            echo "                    ";
                            // line 295
                            echo "                    <button title=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "description", [], "any", false, false, false, 295), "html", null, true);
                            echo "\" class=\"btn btn-light\"
                            onclick=\"listViewSetLoadFilter('";
                            // line 296
                            echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
                            echo "', '";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pageFilter"], "id", [], "any", false, false, false, 296), "html", null, true);
                            echo "');\">
                        <i class=\"fas fa-filter fa-fw\"></i> ";
                            // line 297
                            echo twig_escape_filter($this->env, ($context["filterDesc"] ?? null), "html", null, true);
                            echo "
                    </button>
                ";
                        }
                        // line 300
                        echo "            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pageFilter'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 301
                    echo "        ";
                }
                // line 302
                echo "    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 305
    public function macro_filterSaveModal($__currentView__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "currentView" => $__currentView__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 306
            echo "    ";
            $context["viewName"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 306);
            // line 307
            echo "    <div class=\"modal\" id=\"savefilter";
            echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
            echo "\" tabindex=\"-1\" role=\"dialog\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\">
                        <i class=\"fas fa-filter fa-fw\"></i> ";
            // line 312
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("save-filter"), "html", null, true);
            echo "
                    </h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">×</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    <div class=\"row\">
                        <div class=\"col\">
                            <div class=\"form-group\">
                                <label>";
            // line 322
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("description"), "html", null, true);
            echo "</label>
                                <input type=\"text\" name=\"filter-description\" class=\"form-control noEnterKey\"
                                       autofocus=\"\"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">
                        ";
            // line 331
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("cancel"), "html", null, true);
            echo "
                    </button>
                    <button type=\"button\" class=\"btn btn-primary\"
                            onclick=\"listViewSetAction('";
            // line 334
            echo twig_escape_filter($this->env, ($context["viewName"] ?? null), "html", null, true);
            echo "', 'save-filter');\">
                        ";
            // line 335
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("accept"), "html", null, true);
            echo "
                    </button>
                </div>
            </div>
        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 343
    public function macro_colorsButton($__currentView__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "currentView" => $__currentView__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 344
            echo "    ";
            $context["legend"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getRow", [0 => "status"], "method", false, false, false, 344), "legend", [], "method", false, false, false, 344);
            // line 345
            echo "    ";
            if (($context["legend"] ?? null)) {
                // line 346
                echo "        ";
                $context["viewName"] = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 346);
                // line 347
                echo "        <div class=\"btn-group\">
            <div class=\"dropdown\">
                <button class=\"btn btn-light dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                        aria-expanded=\"false\">
                    <i class=\"fas fa-fill-drip fa-fw\" aria-hidden=\"true\"></i>
                </button>
                <div class=\"dropdown-menu dropdown-menu-right pb-0\">
                    <h6 class=\"dropdown-header\">
                        ";
                // line 355
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("colors"), "html", null, true);
                echo "
                    </h6>
                    ";
                // line 357
                echo ($context["legend"] ?? null);
                echo "
                </div>
            </div>
        </div>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 364
    public function macro_printButton($__fsc__ = null, $__currentView__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "currentView" => $__currentView__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 365
            echo "    <div class=\"dropdown\">
        <button class=\"btn btn-light dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                aria-expanded=\"false\">
            <i class=\"fas fa-print fa-fw\" aria-hidden=\"true\"></i>
        </button>
        <div class=\"dropdown-menu\">
            ";
            // line 371
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 371), "options", [], "method", false, false, false, 371));
            foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                // line 372
                echo "                <a href=\"#\" class=\"dropdown-item\"
                   onclick=\"listViewPrintAction('";
                // line 373
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 373), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "');\">
                    <i class=\"";
                // line 374
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "icon", [], "any", false, false, false, 374), "html", null, true);
                echo " fa-fw\" aria-hidden=\"true\"></i>
                    ";
                // line 375
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["option"], "description", [], "any", false, false, false, 375)), "html", null, true);
                echo "
                </a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 378
            echo "            ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 378), "tools", [], "any", false, false, false, 378))) {
                // line 379
                echo "                <div class=\"dropdown-divider\"></div>
                ";
                // line 380
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "exportManager", [], "any", false, false, false, 380), "tools", [], "method", false, false, false, 380));
                foreach ($context['_seq'] as $context["key"] => $context["tool"]) {
                    // line 381
                    echo "                    <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(twig_get_attribute($this->env, $this->source, $context["tool"], "link", [], "any", false, false, false, 381)), "html", null, true);
                    echo "\" class=\"dropdown-item\">
                        <i class=\"";
                    // line 382
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tool"], "icon", [], "any", false, false, false, 382), "html", null, true);
                    echo " fa-fw\" aria-hidden=\"true\"></i>
                        ";
                    // line 383
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["tool"], "description", [], "any", false, false, false, 383)), "html", null, true);
                    echo "
                    </a>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['tool'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 386
                echo "            ";
            }
            // line 387
            echo "        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 391
    public function macro_searchControl($__currentView__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "currentView" => $__currentView__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 392
            echo "    ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "searchFields", [], "any", false, false, false, 392))) {
                // line 393
                echo "        <div class=\"form-group\">
            <div class=\"input-group\">
                <input class=\"form-control\" type=\"text\" name=\"query\" value=\"";
                // line 395
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "query", [], "any", false, false, false, 395), "html", null, true);
                echo "\" autocomplete=\"off\"
                       placeholder=\"";
                // line 396
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("search"), "html", null, true);
                echo "\"/>
                <span class=\"input-group-append\">
                    <button type=\"submit\" class=\"btn btn-secondary\">
                        <i class=\"fas fa-search\" aria-hidden=\"true\"></i>
                    </button>
                </span>
            </div>
        </div>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 407
    public function macro_sortButton($__currentView__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "currentView" => $__currentView__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 408
            echo "    ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderOptions", [], "any", false, false, false, 408))) {
                // line 409
                echo "        <div class=\"btn-group\">
            <button class=\"btn btn-light dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                    aria-expanded=\"true\">
                ";
                // line 412
                $context["icon"] = (((0 === twig_compare((($__internal_compile_0 = (($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderOptions", [], "any", false, false, false, 412)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderKey", [], "any", false, false, false, 412)] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null), "ASC"))) ? ("fas fa-sort-amount-down-alt") : ("fas fa-sort-amount-down"));
                // line 413
                echo "                <i class=\"";
                echo twig_escape_filter($this->env, ($context["icon"] ?? null), "html", null, true);
                echo " fa-fw\" aria-hidden=\"true\"></i>
                <span class=\"d-none d-lg-inline\">";
                // line 414
                echo twig_escape_filter($this->env, (($__internal_compile_2 = (($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderOptions", [], "any", false, false, false, 414)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderKey", [], "any", false, false, false, 414)] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["label"] ?? null) : null), "html", null, true);
                echo "</span>
                <span class=\"caret\"></span>
            </button>
            <div class=\"dropdown-menu dropdown-menu-right\">
                ";
                // line 418
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderOptions", [], "any", false, false, false, 418));
                foreach ($context['_seq'] as $context["key"] => $context["orderby"]) {
                    // line 419
                    echo "                    ";
                    $context["activeClass"] = (((0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "orderKey", [], "any", false, false, false, 419), $context["key"]))) ? (" active") : (""));
                    // line 420
                    echo "                    ";
                    $context["icon"] = (((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["orderby"], "type", [], "any", false, false, false, 420), "ASC"))) ? ("fas fa-sort-amount-down-alt") : ("fas fa-sort-amount-down"));
                    // line 421
                    echo "                    <a class=\"dropdown-item";
                    echo twig_escape_filter($this->env, ($context["activeClass"] ?? null), "html", null, true);
                    echo "\" href=\"#\"
                       onclick=\"listViewSetOrder('";
                    // line 422
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 422), "html", null, true);
                    echo "', '";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "');\">
                        <i class=\"";
                    // line 423
                    echo twig_escape_filter($this->env, ($context["icon"] ?? null), "html", null, true);
                    echo " fa-fw\" aria-hidden=\"true\"></i> ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["orderby"], "label", [], "any", false, false, false, 423), "html", null, true);
                    echo "
                    </a>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['orderby'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 426
                echo "            </div>
        </div>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "Master/ListView.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1158 => 426,  1147 => 423,  1141 => 422,  1136 => 421,  1133 => 420,  1130 => 419,  1126 => 418,  1119 => 414,  1114 => 413,  1112 => 412,  1107 => 409,  1104 => 408,  1091 => 407,  1072 => 396,  1068 => 395,  1064 => 393,  1061 => 392,  1048 => 391,  1037 => 387,  1034 => 386,  1025 => 383,  1021 => 382,  1016 => 381,  1012 => 380,  1009 => 379,  1006 => 378,  997 => 375,  993 => 374,  987 => 373,  984 => 372,  980 => 371,  972 => 365,  958 => 364,  943 => 357,  938 => 355,  928 => 347,  925 => 346,  922 => 345,  919 => 344,  906 => 343,  890 => 335,  886 => 334,  880 => 331,  868 => 322,  855 => 312,  846 => 307,  843 => 306,  830 => 305,  820 => 302,  817 => 301,  811 => 300,  805 => 297,  799 => 296,  794 => 295,  792 => 294,  784 => 289,  780 => 288,  777 => 287,  772 => 284,  766 => 283,  761 => 282,  758 => 280,  755 => 279,  752 => 278,  749 => 277,  744 => 276,  741 => 275,  738 => 274,  735 => 273,  729 => 270,  725 => 269,  721 => 268,  718 => 267,  716 => 266,  714 => 265,  709 => 263,  704 => 262,  698 => 259,  689 => 258,  687 => 257,  684 => 256,  681 => 255,  678 => 254,  664 => 253,  659 => 406,  656 => 390,  653 => 363,  650 => 342,  647 => 304,  644 => 251,  635 => 249,  631 => 248,  627 => 245,  621 => 243,  618 => 242,  612 => 238,  608 => 236,  604 => 233,  599 => 230,  590 => 227,  584 => 226,  579 => 225,  576 => 224,  572 => 223,  566 => 221,  563 => 220,  561 => 219,  554 => 214,  545 => 211,  542 => 210,  538 => 209,  534 => 208,  530 => 206,  521 => 203,  518 => 202,  514 => 201,  510 => 200,  504 => 196,  495 => 193,  492 => 192,  488 => 191,  481 => 186,  478 => 185,  473 => 181,  462 => 178,  459 => 177,  453 => 175,  444 => 173,  439 => 172,  435 => 170,  428 => 166,  423 => 165,  420 => 164,  414 => 161,  410 => 159,  408 => 158,  405 => 157,  403 => 156,  394 => 155,  391 => 154,  388 => 153,  382 => 152,  380 => 151,  375 => 148,  366 => 146,  361 => 145,  357 => 143,  352 => 141,  349 => 140,  346 => 139,  340 => 136,  336 => 134,  334 => 133,  331 => 132,  329 => 131,  322 => 128,  320 => 127,  317 => 126,  315 => 125,  310 => 122,  301 => 119,  295 => 118,  290 => 117,  287 => 116,  283 => 115,  279 => 113,  276 => 112,  273 => 111,  267 => 107,  264 => 106,  261 => 104,  252 => 102,  248 => 101,  244 => 100,  239 => 99,  236 => 98,  229 => 94,  224 => 92,  219 => 90,  212 => 86,  205 => 82,  200 => 80,  198 => 79,  191 => 75,  187 => 74,  184 => 73,  181 => 72,  175 => 69,  172 => 68,  169 => 67,  162 => 63,  158 => 62,  155 => 61,  152 => 60,  149 => 59,  145 => 57,  139 => 55,  137 => 54,  133 => 53,  128 => 52,  124 => 50,  118 => 48,  116 => 47,  111 => 45,  106 => 44,  103 => 43,  101 => 42,  98 => 41,  93 => 38,  89 => 37,  85 => 36,  81 => 35,  77 => 34,  73 => 33,  69 => 32,  64 => 30,  58 => 27,  54 => 26,  50 => 25,  46 => 24,  42 => 22,  40 => 21,  38 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/ListView.html.twig", "/var/www/html/Dinamic/View/Master/ListView.html.twig");
    }
}
