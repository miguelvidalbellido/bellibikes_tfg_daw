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

/* Dashboard.html.twig */
class __TwigTemplate_2c074b1703c1f804f03e2f422b17f626aba97f5326e55a792b165fd89cad52e6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
            'sectionLinks' => [$this, 'block_sectionLinks'],
            'sectionStats' => [$this, 'block_sectionStats'],
            'sections' => [$this, 'block_sections'],
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
        $this->parent = $this->loadTemplate("Master/MenuBghTemplate.html.twig", "Dashboard.html.twig", 20);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "    <div class=\"bg-light pt-4 pb-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col\">
                    <h1 class=\"h4\">
                        ";
        // line 28
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getPageData", [], "method", false, false, false, 28), "name", [], "any", false, false, false, 28), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "user", [], "any", false, false, false, 28), "homepage", [], "any", false, false, false, 28)))) {
            // line 29
            echo "                            <a class=\"btn btn-sm btn-secondary align-bottom active\"
                               href=\"";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 30), "html", null, true);
            echo "?defaultPage=FALSE\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("marked-as-homepage"), "html", null, true);
            echo "\">
                                <i class=\"fas fa-bookmark\" aria-hidden=\"true\"></i>
                            </a>
                        ";
        } else {
            // line 34
            echo "                            <a class=\"btn btn-sm btn-secondary align-bottom\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 34), "html", null, true);
            echo "?defaultPage=TRUE\"
                               title=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("mark-as-homepage"), "html", null, true);
            echo "\">
                                <i class=\"far fa-bookmark\" aria-hidden=\"true\"></i>
                            </a>
                        ";
        }
        // line 39
        echo "                        <span class=\"ml-2\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 39), "html", null, true);
        echo "</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class=\"container\" style=\"margin-top: -40px;\">
        ";
        // line 46
        $this->displayBlock('sectionLinks', $context, $blocks);
        // line 53
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "showBackupWarning", [], "method", false, false, false, 53)) {
            // line 54
            echo "            <div class=\"row\">
                <div class=\"col\">
                    <div class=\"card bg-warning shadow mb-3\">
                        <div class=\"card-body\">
                            <h2 class=\"h3\">
                                <i class=\"fas fa-save\"></i> ";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("dashboard-backup"), "html", null, true);
            echo "
                            </h2>
                            <p class=\"card-text\">";
            // line 61
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("dashboard-backup-p"), "html", null, true);
            echo "</p>
                            <ul class=\"mb-0\">
                                <li>";
            // line 63
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("dasboard-backup-li1"), "html", null, true);
            echo "</li>
                                <li>";
            // line 64
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("dasboard-backup-li2"), "html", null, true);
            echo "</li>
                                <li>";
            // line 65
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("dasboard-backup-li3"), "html", null, true);
            echo "</li>
                            </ul>
                        </div>
                        <div class=\"card-footer\">
                            <a href=\"https://facturascripts.com/plugins/backup\" target=\"_blank\" rel=\"nofollow\"
                               class=\"btn btn-secondary\"> Backup
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        ";
        }
        // line 77
        echo "        ";
        $this->displayBlock('sectionStats', $context, $blocks);
        // line 80
        echo "        ";
        $this->displayBlock('sections', $context, $blocks);
        // line 93
        echo "    </div>
";
    }

    // line 46
    public function block_sectionLinks($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 47
        echo "            <div class=\"row\">
                <div class=\"col\">
                    ";
        // line 49
        echo twig_call_macro($macros["_self"], "macro_sectionLinks", [($context["fsc"] ?? null)], 49, $context, $this->getSourceContext());
        echo "
                </div>
            </div>
        ";
    }

    // line 77
    public function block_sectionStats($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 78
        echo "            ";
        echo twig_call_macro($macros["_self"], "macro_sectionStats", [($context["fsc"] ?? null)], 78, $context, $this->getSourceContext());
        echo "
        ";
    }

    // line 80
    public function block_sections($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 81
        echo "            <div class=\"row\">
                <div class=\"col\">
                    ";
        // line 83
        if (twig_in_filter("receipts", twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "sections", [], "any", false, false, false, 83))) {
            // line 84
            echo "                        ";
            echo twig_call_macro($macros["_self"], "macro_sectionReceipts", [($context["fsc"] ?? null)], 84, $context, $this->getSourceContext());
            echo "
                    ";
        }
        // line 86
        echo "                    ";
        if (twig_in_filter("low-stock", twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "sections", [], "any", false, false, false, 86))) {
            // line 87
            echo "                        ";
            echo twig_call_macro($macros["_self"], "macro_sectionLowStock", [($context["fsc"] ?? null)], 87, $context, $this->getSourceContext());
            echo "
                    ";
        }
        // line 89
        echo "                </div>
            </div>
            ";
        // line 91
        echo twig_call_macro($macros["_self"], "macro_sectionNews", [($context["fsc"] ?? null)], 91, $context, $this->getSourceContext());
        echo "
        ";
    }

    // line 96
    public function macro_drawStatsBox($__fsc__ = null, $__group__ = null, $__color__ = null, $__ismoney__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "group" => $__group__,
            "color" => $__color__,
            "ismoney" => $__ismoney__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 97
            echo "    <div class=\"card shadow mb-3\">
        <div class=\"card-body p-2 text-white ";
            // line 98
            echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
            echo "\">
            <h2 class=\"h5 text-center mb-0\">
                ";
            // line 100
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(($context["group"] ?? null)), "html", null, true);
            echo "
            </h2>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table mb-0\">
                ";
            // line 105
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "stats", [], "any", false, false, false, 105)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[($context["group"] ?? null)] ?? null) : null));
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 106
                echo "                    <tr>
                        <td>";
                // line 107
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()($context["key"]), "html", null, true);
                echo "</td>
                        ";
                // line 108
                $context["color"] = (((-1 === twig_compare($context["value"], 0))) ? (" text-danger") : (""));
                // line 109
                echo "                        ";
                if (($context["ismoney"] ?? null)) {
                    // line 110
                    echo "                            <td class=\"text-right";
                    echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getFunction('money')->getCallable()($context["value"]), "html", null, true);
                    echo "</td>
                        ";
                } else {
                    // line 112
                    echo "                            <td class=\"text-right\">";
                    echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                    echo "</td>
                        ";
                }
                // line 114
                echo "                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            echo "            </table>
        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 121
    public function macro_sectionLinks($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 122
            echo "    <div class=\"card shadow mb-3\">
        <div class=\"pl-3 pt-1 pr-3 pb-3\">
            <div class=\"form-row\">
                <div class=\"col-md\">
                    <h2 class=\"h4 mt-3 mb-1\">
                        <i class=\"fas fa-plus fa-fw\"></i> ";
            // line 127
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("create"), "html", null, true);
            echo "
                    </h2>
                    <ul class=\"mb-1\">
                        ";
            // line 130
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "createLinks", [], "any", false, false, false, 130));
            foreach ($context['_seq'] as $context["link"] => $context["label"]) {
                // line 131
                echo "                            <li>
                                <a href=\"";
                // line 132
                echo twig_escape_filter($this->env, $context["link"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()($context["label"]), "html", null, true);
                echo "</a>
                            </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['link'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 135
            echo "                    </ul>
                </div>
                ";
            // line 137
            if (twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "openLinks", [], "any", false, false, false, 137)) {
                // line 138
                echo "                    <div class=\"col-md\">
                        <h2 class=\"h4 mt-3 mb-1\">
                            <i class=\"fas fa-folder-open fa-fw\"></i> ";
                // line 140
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("open"), "html", null, true);
                echo "
                        </h2>
                        <ul class=\"mb-1\">
                            ";
                // line 143
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "openLinks", [], "any", false, false, false, 143));
                foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                    // line 144
                    echo "                                <li>
                                    ";
                    // line 145
                    echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()(twig_get_attribute($this->env, $this->source, $context["link"], "type", [], "any", false, false, false, 145)), "html", null, true);
                    echo "
                                    <a href=\"";
                    // line 146
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["link"], "url", [], "any", false, false, false, 146), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["link"], "name", [], "any", false, false, false, 146), "html", null, true);
                    echo "</a>
                                    <span class=\"text-muted\">";
                    // line 147
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["link"], "date", [], "any", false, false, false, 147), "html", null, true);
                    echo "</span>
                                </li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 150
                echo "                        </ul>
                    </div>
                ";
            }
            // line 153
            echo "                <div class=\"col-md\">
                    <h2 class=\"h4 mt-3 mb-1\">
                        <i class=\"fas fa-question-circle fa-fw\"></i> ";
            // line 155
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("help"), "html", null, true);
            echo "
                    </h2>
                    <ul class=\"mb-1\">
                        <li>
                            <a href=\"https://facturascripts.com/publicaciones/configuracion-15\" rel=\"nofollow\"
                               target=\"_blank\">Configuración</a>
                        </li>
                        <li>
                            <a href=\"https://facturascripts.com/publicaciones/primeros-pasos-303\" rel=\"nofollow\"
                               target=\"_blank\">Primeros pasos</a>
                        </li>
                        <li>
                            <a href=\"https://facturascripts.com/publicaciones/problemas-frecuentes-469\" rel=\"nofollow\"
                               target=\"_blank\">Problemas frecuentes</a>
                        </li>
                        <li>
                            <a href=\"https://forms.gle/WhGgWWB6EbWjBNna6\" rel=\"nofollow\"
                               target=\"_blank\">Encuesta de uso 2022/23
                                <i class=\"fas fa-clipboard-check\"></i>
                            </a>
                        </li>
                        <li>
                            <a href=\"https://facturascripts.com/contacto\" rel=\"nofollow\" target=\"_blank\">Soporte
                                <i class=\"far fa-comment-dots\"></i></a>
                        </li>
                    </ul>
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

    // line 187
    public function macro_sectionLowStock($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 188
            echo "    <div class=\"card shadow mb-3\">
        <div class=\"p-3\">
            <h2 class=\"h4 mb-0\">
                <i class=\"fas fa-pallet fa-fw\"></i> ";
            // line 191
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("minimum-stock"), "html", null, true);
            echo "
            </h2>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-sm table-hover mb-0\">
                <thead>
                <tr>
                    <th>";
            // line 198
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("reference"), "html", null, true);
            echo "</th>
                    <th>";
            // line 199
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("warehouse"), "html", null, true);
            echo "</th>
                    <th class=\"text-right\">";
            // line 200
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("minimum-stock"), "html", null, true);
            echo "</th>
                    <th class=\"text-right\">";
            // line 201
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("available"), "html", null, true);
            echo "</th>
                </tr>
                </thead>
                <tbody>
                ";
            // line 205
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "lowStock", [], "any", false, false, false, 205));
            foreach ($context['_seq'] as $context["_key"] => $context["stock"]) {
                // line 206
                echo "                    <tr class=\"clickableRow table-danger\" data-href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["stock"], "url", [], "method", false, false, false, 206), "html", null, true);
                echo "\">
                        <td>";
                // line 207
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["stock"], "referencia", [], "any", false, false, false, 207), "html", null, true);
                echo "</td>
                        <td>";
                // line 208
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["stock"], "codalmacen", [], "any", false, false, false, 208), "html", null, true);
                echo "</td>
                        <td class=\"text-right\">";
                // line 209
                echo twig_escape_filter($this->env, $this->env->getFunction('number')->getCallable()(twig_get_attribute($this->env, $this->source, $context["stock"], "stockmin", [], "any", false, false, false, 209)), "html", null, true);
                echo "</td>
                        <td class=\"text-right\">";
                // line 210
                echo twig_escape_filter($this->env, $this->env->getFunction('number')->getCallable()(twig_get_attribute($this->env, $this->source, $context["stock"], "disponible", [], "any", false, false, false, 210)), "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stock'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 213
            echo "                </tbody>
            </table>
        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 219
    public function macro_sectionNews($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 220
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "news", [], "any", false, false, false, 220));
            foreach ($context['_seq'] as $context["_key"] => $context["news"]) {
                // line 221
                echo "        <div class=\"row\">
            <div class=\"col\">
                <div class=\"card shadow mb-3\">
                    <div class=\"card-header\">
                        <span class=\"float-right\">";
                // line 225
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["news"], "fecha", [], "any", false, false, false, 225), "html", null, true);
                echo "</span>
                        <a href=\"";
                // line 226
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["news"], "url", [], "any", false, false, false, 226), "html", null, true);
                echo "\" target=\"_blank\">";
                echo twig_get_attribute($this->env, $this->source, $context["news"], "title", [], "any", false, false, false, 226);
                echo "</a>
                    </div>
                    <div class=\"card-body p-3\">
                        <div class=\"form-row align-items-center\">
                            <div class=\"col-auto\">
                                <a href=\"";
                // line 231
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["news"], "url", [], "any", false, false, false, 231), "html", null, true);
                echo "\" target=\"_blank\" class=\"btn btn-outline-secondary\">
                                    <i class=\"far fa-newspaper fa-3x\"></i>
                                </a>
                            </div>
                            <div class=\"col\">";
                // line 235
                echo twig_get_attribute($this->env, $this->source, $context["news"], "body", [], "any", false, false, false, 235);
                echo "</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['news'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 244
    public function macro_sectionReceipts($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 245
            echo "    <div class=\"card shadow mb-3\">
        <div class=\"p-3\">
            <span class=\"float-right badge badge-danger\">";
            // line 247
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("unpaid"), "html", null, true);
            echo "</span>
            <h2 class=\"h4 mb-0\">
                <i class=\"fas fa-dollar-sign fa-fw\"></i>
                ";
            // line 250
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("receipts"), "html", null, true);
            echo "
            </h2>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-sm table-hover mb-0\">
                <thead>
                <tr>
                    <th>";
            // line 257
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("customer"), "html", null, true);
            echo "</th>
                    <th>";
            // line 258
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("observations"), "html", null, true);
            echo "</th>
                    <th class=\"text-right\">";
            // line 259
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("amount"), "html", null, true);
            echo "</th>
                    <th class=\"text-right\">";
            // line 260
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("expiration"), "html", null, true);
            echo "</th>
                </tr>
                </thead>
                <tbody>
                ";
            // line 264
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "receipts", [], "any", false, false, false, 264));
            foreach ($context['_seq'] as $context["_key"] => $context["receipt"]) {
                // line 265
                echo "                    <tr class=\"clickableRow table-danger\" data-href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["receipt"], "url", [], "method", false, false, false, 265), "html", null, true);
                echo "\">
                        <td>";
                // line 266
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["receipt"], "getSubject", [], "method", false, false, false, 266), "nombre", [], "any", false, false, false, 266);
                echo "</td>
                        <td>";
                // line 267
                echo twig_get_attribute($this->env, $this->source, $context["receipt"], "observaciones", [], "any", false, false, false, 267);
                echo "</td>
                        <td class=\"text-right text-nowrap\">";
                // line 268
                echo twig_escape_filter($this->env, $this->env->getFunction('money')->getCallable()(twig_get_attribute($this->env, $this->source, $context["receipt"], "importe", [], "any", false, false, false, 268)), "html", null, true);
                echo "</td>
                        <td class=\"text-right text-nowrap\">";
                // line 269
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["receipt"], "vencimiento", [], "any", false, false, false, 269), "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['receipt'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 272
            echo "                </tbody>
            </table>
        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 278
    public function macro_sectionStats($__fsc__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 279
            echo "    <div class=\"form-row\">
        <div class=\"col-sm-6 col-lg-3\">
            ";
            // line 281
            echo twig_call_macro($macros["_self"], "macro_drawStatsBox", [($context["fsc"] ?? null), "purchases", "bg-danger", true], 281, $context, $this->getSourceContext());
            echo "
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            ";
            // line 284
            echo twig_call_macro($macros["_self"], "macro_drawStatsBox", [($context["fsc"] ?? null), "sales", "bg-success", true], 284, $context, $this->getSourceContext());
            echo "
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            ";
            // line 287
            echo twig_call_macro($macros["_self"], "macro_drawStatsBox", [($context["fsc"] ?? null), "taxes", "bg-warning", true], 287, $context, $this->getSourceContext());
            echo "
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            ";
            // line 290
            echo twig_call_macro($macros["_self"], "macro_drawStatsBox", [($context["fsc"] ?? null), "new-customers", "bg-info", false], 290, $context, $this->getSourceContext());
            echo "
        </div>
    </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "Dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  717 => 290,  711 => 287,  705 => 284,  699 => 281,  695 => 279,  682 => 278,  669 => 272,  660 => 269,  656 => 268,  652 => 267,  648 => 266,  643 => 265,  639 => 264,  632 => 260,  628 => 259,  624 => 258,  620 => 257,  610 => 250,  604 => 247,  600 => 245,  587 => 244,  567 => 235,  560 => 231,  550 => 226,  546 => 225,  540 => 221,  535 => 220,  522 => 219,  509 => 213,  500 => 210,  496 => 209,  492 => 208,  488 => 207,  483 => 206,  479 => 205,  472 => 201,  468 => 200,  464 => 199,  460 => 198,  450 => 191,  445 => 188,  432 => 187,  392 => 155,  388 => 153,  383 => 150,  374 => 147,  368 => 146,  364 => 145,  361 => 144,  357 => 143,  351 => 140,  347 => 138,  345 => 137,  341 => 135,  330 => 132,  327 => 131,  323 => 130,  317 => 127,  310 => 122,  297 => 121,  285 => 116,  278 => 114,  272 => 112,  264 => 110,  261 => 109,  259 => 108,  255 => 107,  252 => 106,  248 => 105,  240 => 100,  235 => 98,  232 => 97,  216 => 96,  210 => 91,  206 => 89,  200 => 87,  197 => 86,  191 => 84,  189 => 83,  185 => 81,  181 => 80,  174 => 78,  170 => 77,  162 => 49,  158 => 47,  154 => 46,  149 => 93,  146 => 80,  143 => 77,  128 => 65,  124 => 64,  120 => 63,  115 => 61,  110 => 59,  103 => 54,  100 => 53,  98 => 46,  87 => 39,  80 => 35,  75 => 34,  66 => 30,  63 => 29,  61 => 28,  54 => 23,  50 => 22,  39 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Dashboard.html.twig", "/var/www/html/Dinamic/View/Dashboard.html.twig");
    }
}
