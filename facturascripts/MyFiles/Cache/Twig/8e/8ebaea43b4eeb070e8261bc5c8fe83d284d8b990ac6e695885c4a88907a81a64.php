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

/* AdminPlugins.html.twig */
class __TwigTemplate_a19a5818561c67b47eb523d7363dc0e78f8c9d98b98f62332684f4185d18c377 extends Template
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
        return "Master/MenuBghTemplate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/MenuBghTemplate.html.twig", "AdminPlugins.html.twig", 20);
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
    <div class=\"container-fluid mb-2\">
        <div class=\"row\">
            <div class=\"col-sm-6\">
                <div class=\"btn-group\">
                    <a class=\"btn btn-sm btn-secondary\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 28), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("refresh"), "html", null, true);
        echo "\">
                        <i class=\"fas fa-redo\" aria-hidden=\"true\"></i>
                    </a>
                    ";
        // line 31
        if ((0 === twig_compare((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getPageData", [], "method", false, false, false, 31)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "user", [], "any", false, false, false, 31), "homepage", [], "any", false, false, false, 31)))) {
            // line 32
            echo "                        <a class=\"btn btn-sm btn-secondary active\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 32), "html", null, true);
            echo "?defaultPage=FALSE\"
                           title=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("marked-as-homepage"), "html", null, true);
            echo "\">
                            <i class=\"fas fa-bookmark\" aria-hidden=\"true\"></i>
                        </a>
                    ";
        } else {
            // line 37
            echo "                        <a class=\"btn btn-sm btn-secondary\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 37), "html", null, true);
            echo "?defaultPage=TRUE\"
                           title=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("mark-as-homepage"), "html", null, true);
            echo "\">
                            <i class=\"far fa-bookmark\" aria-hidden=\"true\"></i>
                        </a>
                    ";
        }
        // line 42
        echo "                </div>
                ";
        // line 43
        if ( !twig_constant("FS_DISABLE_ADD_PLUGINS")) {
            // line 44
            echo "                    <button class=\"btn btn-sm btn-success\" type=\"button\" data-toggle=\"modal\"
                            data-target=\"#modalAddPlugin\">
                        <i class=\"fas fa-plus fa-fw\" aria-hidden=\"true\"></i>
                        <span class=\"d-none d-sm-inline-block\">";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("add"), "html", null, true);
            echo "</span>
                    </button>
                ";
        }
        // line 50
        echo "                <div class=\"btn-group\">
                    <a href=\"";
        // line 51
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 51), "html", null, true);
        echo "?action=rebuild&multireqtoken=";
        echo $this->env->getFunction('formToken')->getCallable()(false);
        echo "\"
                       class=\"btn btn-sm btn-warning\">
                        <i class=\"fas fa-hammer fa-fw\" aria-hidden=\"true\"></i>
                        <span class=\"d-none d-sm-inline-block\">";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("rebuild"), "html", null, true);
        echo "</span>
                    </a>
                </div>
            </div>
            <div class=\"col-sm text-right\">
                <h1 class=\"h3\">
                    ";
        // line 60
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $this->env->getFunction('trans')->getCallable()((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getPageData", [], "method", false, false, false, 60)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["title"] ?? null) : null))), "html", null, true);
        echo "
                    <i class=\"";
        // line 61
        echo twig_escape_filter($this->env, (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getPageData", [], "method", false, false, false, 61)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["icon"] ?? null) : null), "html", null, true);
        echo "\" aria-hidden=\"true\"></i>
                </h1>
            </div>
        </div>
    </div>
    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\">
            <a class=\"nav-link active\" id=\"installedPluginsTab\" data-toggle=\"tab\" href=\"#installed\" role=\"tab\">
                <i class=\"fas fa-box-open fa-fw\" aria-hidden=\"true\"></i> ";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("installed-plugins"), "html", null, true);
        echo "
                ";
        // line 70
        if ((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "pluginList", [], "any", false, false, false, 70)), 0))) {
            // line 71
            echo "                    <span class=\"badge badge-secondary\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "pluginList", [], "any", false, false, false, 71)), "html", null, true);
            echo "</span>
                ";
        }
        // line 73
        echo "            </a>
        </li>
        ";
        // line 75
        if ( !twig_constant("FS_DISABLE_ADD_PLUGINS")) {
            // line 76
            echo "            <li class=\"nav-item\">
                <a class=\"nav-link\" id=\"allPluginsTab\" data-toggle=\"tab\" href=\"#all\" role=\"tab\">
                    <i class=\"fas fa-boxes fa-fw\" aria-hidden=\"true\"></i>
                    <span class=\"d-none d-sm-inline-block\">";
            // line 79
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("more-plugins"), "html", null, true);
            echo "</span>
                    ";
            // line 80
            if ((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "remotePluginList", [], "any", false, false, false, 80)), 0))) {
                // line 81
                echo "                        <span class=\"badge badge-secondary\">";
                echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "remotePluginList", [], "any", false, false, false, 81)), "html", null, true);
                echo "</span>
                    ";
            }
            // line 83
            echo "                </a>
            </li>
        ";
        }
        // line 86
        echo "    </ul>
";
    }

    // line 89
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 90
        echo "    ";
        $this->displayParentBlock("body", $context, $blocks);
        echo "
    <div class=\"tab-content\">
        <div class=\"tab-pane fade show active\" id=\"installed\" role=\"tabpanel\">
            ";
        // line 93
        echo twig_call_macro($macros["_self"], "macro_showInstalledPlugins", [($context["fsc"] ?? null)], 93, $context, $this->getSourceContext());
        echo "
        </div>
        ";
        // line 95
        if ( !twig_constant("FS_DISABLE_ADD_PLUGINS")) {
            // line 96
            echo "            <div class=\"tab-pane fade\" id=\"all\" role=\"tabpanel\">
                ";
            // line 97
            echo twig_call_macro($macros["_self"], "macro_showAllPlugins", [($context["fsc"] ?? null)], 97, $context, $this->getSourceContext());
            echo "
            </div>
        ";
        }
        // line 100
        echo "    </div>

    ";
        // line 103
        echo "    ";
        if ( !twig_constant("FS_DISABLE_ADD_PLUGINS")) {
            // line 104
            echo "        <form action=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 104), "html", null, true);
            echo "\" name=\"upload-plugins\" method=\"post\" class=\"form\" enctype=\"multipart/form-data\">
            ";
            // line 105
            echo $this->env->getFunction('formToken')->getCallable()();
            echo "
            <input type=\"hidden\" name=\"action\" value=\"upload\"/>
            <div class=\"modal fade\" id=\"modalAddPlugin\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
                <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\">";
            // line 111
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("add-new-plugin"), "html", null, true);
            echo "</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                                    aria-label=\"";
            // line 113
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("close"), "html", null, true);
            echo "\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        ";
            // line 117
            if ((-1 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getMaxFileUpload", [], "method", false, false, false, 117), 99))) {
                // line 118
                echo "                            <div class=\"alert alert-warning mb-0\">
                                ";
                // line 119
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("help-server-accepts-filesize", ["%size%" => twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getMaxFileUpload", [], "method", false, false, false, 119)]), "html", null, true);
                echo "
                            </div>
                        ";
            }
            // line 122
            echo "                        <div class=\"modal-body\">
                            <div class=\"form-group\">
                                ";
            // line 124
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("select-plugin-zip-file"), "html", null, true);
            echo "
                                <input type=\"file\" name=\"plugin[]\" multiple=\"\" accept=\"application/zip\" required=\"\"/>
                                ";
            // line 126
            if ((0 <= twig_compare(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getMaxFileUpload", [], "method", false, false, false, 126), 99))) {
                // line 127
                echo "                                    <small class=\"form-text text-muted\">
                                        ";
                // line 128
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("help-server-accepts-filesize", ["%size%" => twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getMaxFileUpload", [], "method", false, false, false, 128)]), "html", null, true);
                echo "
                                    </small>
                                ";
            }
            // line 131
            echo "                            </div>
                            <div class=\"text-right mt-5\">
                                <button type=\"button\" class=\"btn btn-secondary\"
                                        data-dismiss=\"modal\">";
            // line 134
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("cancel"), "html", null, true);
            echo "</button>
                                <button type=\"submit\" class=\"btn btn-primary\">";
            // line 135
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("continue"), "html", null, true);
            echo "</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    ";
        }
    }

    // line 145
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 146
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 147
        if ( !twig_constant("FS_DISABLE_RM_PLUGINS")) {
            // line 148
            echo "        <script>
            function deletePlugin(pluginName) {
                bootbox.confirm({
                    title: \"";
            // line 151
            echo $this->env->getFunction('trans')->getCallable()("confirm-delete");
            echo "\",
                    message: \"";
            // line 152
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("are-you-sure"), "html", null, true);
            echo "\",
                    closeButton: false,
                    buttons: {
                        cancel: {
                            label: \"<i class='fas fa-times'></i> ";
            // line 156
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("cancel"), "html", null, true);
            echo "\"
                        },
                        confirm: {
                            label: \"<i class='fas fa-check'></i> ";
            // line 159
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("delete"), "html", null, true);
            echo "\",
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            animateSpinner('add');
                            window.location = \"";
            // line 166
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 166), "html", null, true);
            echo "?action=remove\" + \"\\u0026\" + \"plugin=\" + pluginName
                                + \"\\u0026\" + \"multireqtoken=";
            // line 167
            echo $this->env->getFunction('formToken')->getCallable()(false);
            echo "\";
                        }
                    }
                });
            }
        </script>
    ";
        }
    }

    // line 176
    public function macro_healthStatus($__value__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "value" => $__value__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 177
            echo "    ";
            if ((-1 === twig_compare(($context["value"] ?? null), 1))) {
                // line 178
                echo "        <i class=\"fas fa-heart-broken\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
    ";
            } elseif ((-1 === twig_compare(            // line 183
($context["value"] ?? null), 2))) {
                // line 184
                echo "        <i class=\"fas fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
    ";
            } elseif ((-1 === twig_compare(            // line 189
($context["value"] ?? null), 3))) {
                // line 190
                echo "        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
    ";
            } elseif ((-1 === twig_compare(            // line 195
($context["value"] ?? null), 4))) {
                // line 196
                echo "        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
    ";
            } elseif ((-1 === twig_compare(            // line 201
($context["value"] ?? null), 5))) {
                // line 202
                echo "        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"far fa-heart\"></i>
    ";
            } else {
                // line 208
                echo "        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
        <i class=\"fas fa-heart\"></i>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 216
    public function macro_showAllPlugins($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 217
            echo "    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead>
            <tr>
                <th>";
            // line 221
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("name"), "html", null, true);
            echo "</th>
                <th>";
            // line 222
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("description"), "html", null, true);
            echo "</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 226
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "remotePluginList", [], "any", false, false, false, 226));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["plugin"]) {
                // line 227
                echo "                ";
                $context["extraClass"] = (((1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["plugin"], "health", [], "any", false, false, false, 227), 2))) ? ("table-success") : ((((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["plugin"], "health", [], "any", false, false, false, 227), 0))) ? ("table-danger") : ("table-warning"))));
                // line 228
                echo "                <tr class=\"clickableRow ";
                echo twig_escape_filter($this->env, ($context["extraClass"] ?? null), "html", null, true);
                echo "\" data-href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "url", [], "any", false, false, false, 228), "html", null, true);
                echo "\" data-target=\"_blank\">
                    <td>
                        <div class=\"h6\">";
                // line 230
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "name", [], "any", false, false, false, 230), "html", null, true);
                echo "</div>
                        <span class=\"mr-1 text-secondary\" title=\"";
                // line 231
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("health"), "html", null, true);
                echo "\">
                            ";
                // line 232
                echo twig_call_macro($macros["_self"], "macro_healthStatus", [twig_get_attribute($this->env, $this->source, $context["plugin"], "health", [], "any", false, false, false, 232)], 232, $context, $this->getSourceContext());
                echo "
                        </span>
                        v";
                // line 234
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "version", [], "any", false, false, false, 234), "html", null, true);
                echo "
                    </td>
                    <td>";
                // line 236
                echo twig_nl2br(twig_escape_filter($this->env, twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "description", [], "any", false, false, false, 236), 0, 300), "html", null, true));
                echo "</td>
                </tr>
            ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 239
                echo "                <tr class=\"table-warning\">
                    <td colspan=\"2\">";
                // line 240
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("no-data"), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plugin'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 243
            echo "            </tbody>
        </table>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 248
    public function macro_showInstalledPlugins($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 249
            echo "    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead>
            <tr>
                <th>";
            // line 253
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("name"), "html", null, true);
            echo "</th>
                <th class=\"text-right\">";
            // line 254
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("version"), "html", null, true);
            echo "</th>
                <th>";
            // line 255
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("description"), "html", null, true);
            echo "</th>
                <th class=\"text-right pr-3\">";
            // line 256
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("actions"), "html", null, true);
            echo "</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 260
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "pluginList", [], "any", false, false, false, 260));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["plugin"]) {
                // line 261
                echo "                ";
                $context["trClass"] = "table-danger";
                // line 262
                echo "                ";
                if (twig_get_attribute($this->env, $this->source, $context["plugin"], "enabled", [], "any", false, false, false, 262)) {
                    // line 263
                    echo "                    ";
                    $context["trClass"] = "table-success";
                    // line 264
                    echo "                ";
                } elseif (twig_get_attribute($this->env, $this->source, $context["plugin"], "compatible", [], "any", false, false, false, 264)) {
                    // line 265
                    echo "                    ";
                    $context["trClass"] = "";
                    // line 266
                    echo "                ";
                }
                // line 267
                echo "                <tr class=\"";
                echo twig_escape_filter($this->env, ($context["trClass"] ?? null), "html", null, true);
                echo "\">
                    <td>";
                // line 268
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "name", [], "any", false, false, false, 268), "html", null, true);
                echo "</td>
                    <td class=\"text-right\">
                        ";
                // line 270
                if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["plugin"], "version", [], "any", false, false, false, 270), 0))) {
                    // line 271
                    echo "                            <span class=\"text-danger\">v";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "version", [], "any", false, false, false, 271), "html", null, true);
                    echo "</span>
                        ";
                } elseif ((-1 === twig_compare(twig_get_attribute($this->env, $this->source,                 // line 272
$context["plugin"], "version", [], "any", false, false, false, 272), 1))) {
                    // line 273
                    echo "                            <span class=\"text-warning\">v";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "version", [], "any", false, false, false, 273), "html", null, true);
                    echo "</span>
                        ";
                } else {
                    // line 275
                    echo "                            v";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "version", [], "any", false, false, false, 275), "html", null, true);
                    echo "
                        ";
                }
                // line 277
                echo "                    </td>
                    <td>
                        ";
                // line 279
                echo twig_nl2br(twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "description", [], "any", false, false, false, 279), "html", null, true));
                echo "
                        ";
                // line 280
                if (twig_get_attribute($this->env, $this->source, $context["plugin"], "forja", [0 => "url", 1 => ""], "method", false, false, false, 280)) {
                    // line 281
                    echo "                            <a href=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "forja", [0 => "url", 1 => ""], "method", false, false, false, 281), "html", null, true);
                    echo "\" target=\"_blank\" class=\"ml-2\">
                                ";
                    // line 282
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("more"), "html", null, true);
                    echo " <i class=\"fas fa-external-link-alt\"></i>
                            </a>
                        ";
                }
                // line 285
                echo "                    </td>
                    <td class=\"text-right text-nowrap\">
                        ";
                // line 287
                if (twig_get_attribute($this->env, $this->source, $context["plugin"], "hasUpdate", [], "method", false, false, false, 287)) {
                    // line 288
                    echo "                            <a href=\"Updater\" class=\"btn btn-sm btn-info mr-1\" title=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("updater"), "html", null, true);
                    echo "\">
                                <i class=\"fas fa-cloud-download-alt\" aria-hidden=\"true\"></i>
                            </a>
                        ";
                }
                // line 292
                echo "                        ";
                if (twig_get_attribute($this->env, $this->source, $context["plugin"], "enabled", [], "any", false, false, false, 292)) {
                    // line 293
                    echo "                            <a class=\"btn btn-sm btn-secondary btn-spin-action\" onclick=\"animateSpinner('add');\"
                               href=\"";
                    // line 294
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 294), "html", null, true);
                    echo "?action=disable&amp;plugin=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "name", [], "any", false, false, false, 294), "html", null, true);
                    echo "&amp;multireqtoken=";
                    echo $this->env->getFunction('formToken')->getCallable()(false);
                    echo "\">
                                <i class=\"fas fa-times\" aria-hidden=\"true\"></i>
                                <span class=\"d-none d-sm-inline-block\">";
                    // line 296
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("disable"), "html", null, true);
                    echo "</span>
                            </a>
                            <br/>
                            <small>";
                    // line 299
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("plugin-order", ["%num%" => twig_get_attribute($this->env, $this->source, $context["plugin"], "order", [], "any", false, false, false, 299)]), "html", null, true);
                    echo "</small>
                        ";
                } elseif (twig_get_attribute($this->env, $this->source,                 // line 300
$context["plugin"], "compatible", [], "any", false, false, false, 300)) {
                    // line 301
                    echo "                            ";
                    if ( !twig_constant("FS_DISABLE_RM_PLUGINS")) {
                        // line 302
                        echo "                                <a class=\"btn btn-sm btn-danger mr-1 btn-spin-action\" href=\"#\"
                                   title=\"";
                        // line 303
                        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("delete"), "html", null, true);
                        echo "\" onclick=\"deletePlugin('";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "name", [], "any", false, false, false, 303), "html", null, true);
                        echo "');\">
                                    <i class=\"fas fa-trash-alt\" aria-hidden=\"true\"></i>
                                </a>
                            ";
                    }
                    // line 307
                    echo "                            <a class=\"btn btn-sm btn-success btn-spin-action\" onclick=\"animateSpinner('add');\"
                               href=\"";
                    // line 308
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 308), "html", null, true);
                    echo "?action=enable&amp;plugin=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "name", [], "any", false, false, false, 308), "html", null, true);
                    echo "&amp;multireqtoken=";
                    echo $this->env->getFunction('formToken')->getCallable()(false);
                    echo "\">
                                <i class=\"fas fa-check\" aria-hidden=\"true\"></i>
                                <span class=\"d-none d-sm-inline-block\">";
                    // line 310
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("enable"), "html", null, true);
                    echo "</span>
                            </a>
                        ";
                } else {
                    // line 313
                    echo "                            ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["plugin"], "compatibilityDescription", [], "method", false, false, false, 313), "html", null, true);
                    echo "
                        ";
                }
                // line 315
                echo "                    </td>
                </tr>
            ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 318
                echo "                <tr class=\"table-warning\">
                    <td colspan=\"4\"><b>";
                // line 319
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("no-data"), "html", null, true);
                echo "</b></td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plugin'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 322
            echo "            </tbody>
        </table>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "AdminPlugins.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  747 => 322,  738 => 319,  735 => 318,  728 => 315,  722 => 313,  716 => 310,  707 => 308,  704 => 307,  695 => 303,  692 => 302,  689 => 301,  687 => 300,  683 => 299,  677 => 296,  668 => 294,  665 => 293,  662 => 292,  654 => 288,  652 => 287,  648 => 285,  642 => 282,  637 => 281,  635 => 280,  631 => 279,  627 => 277,  621 => 275,  615 => 273,  613 => 272,  608 => 271,  606 => 270,  601 => 268,  596 => 267,  593 => 266,  590 => 265,  587 => 264,  584 => 263,  581 => 262,  578 => 261,  573 => 260,  566 => 256,  562 => 255,  558 => 254,  554 => 253,  548 => 249,  535 => 248,  523 => 243,  514 => 240,  511 => 239,  503 => 236,  498 => 234,  493 => 232,  489 => 231,  485 => 230,  477 => 228,  474 => 227,  469 => 226,  462 => 222,  458 => 221,  452 => 217,  439 => 216,  424 => 208,  416 => 202,  414 => 201,  407 => 196,  405 => 195,  398 => 190,  396 => 189,  389 => 184,  387 => 183,  380 => 178,  377 => 177,  364 => 176,  352 => 167,  348 => 166,  338 => 159,  332 => 156,  325 => 152,  321 => 151,  316 => 148,  314 => 147,  309 => 146,  305 => 145,  292 => 135,  288 => 134,  283 => 131,  277 => 128,  274 => 127,  272 => 126,  267 => 124,  263 => 122,  257 => 119,  254 => 118,  252 => 117,  245 => 113,  240 => 111,  231 => 105,  226 => 104,  223 => 103,  219 => 100,  213 => 97,  210 => 96,  208 => 95,  203 => 93,  196 => 90,  192 => 89,  187 => 86,  182 => 83,  176 => 81,  174 => 80,  170 => 79,  165 => 76,  163 => 75,  159 => 73,  153 => 71,  151 => 70,  147 => 69,  136 => 61,  132 => 60,  123 => 54,  115 => 51,  112 => 50,  106 => 47,  101 => 44,  99 => 43,  96 => 42,  89 => 38,  84 => 37,  77 => 33,  72 => 32,  70 => 31,  62 => 28,  53 => 23,  49 => 22,  38 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdminPlugins.html.twig", "/var/www/html/Dinamic/View/AdminPlugins.html.twig");
    }
}
