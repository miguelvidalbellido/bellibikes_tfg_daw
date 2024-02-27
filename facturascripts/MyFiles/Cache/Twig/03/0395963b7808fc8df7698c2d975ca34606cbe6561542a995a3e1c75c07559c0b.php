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

/* CSVfields.html.twig */
class __TwigTemplate_b5960a4122fe790e4c593d3f25b34b15df3225fa087c351012cc2bb32f038162 extends Template
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
        // line 1
        $context["profile"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getModel", [], "method", false, false, false, 1), "getProfile", [], "method", false, false, false, 1);
        // line 2
        $context["rows"] = twig_get_attribute($this->env, $this->source, ($context["profile"] ?? null), "getRows", [], "method", false, false, false, 2);
        // line 3
        $context["fields"] = twig_get_attribute($this->env, $this->source, ($context["profile"] ?? null), "getDataFields", [], "method", false, false, false, 3);
        // line 4
        echo "
";
        // line 5
        if (($context["rows"] ?? null)) {
            // line 6
            echo "    ";
            echo twig_call_macro($macros["_self"], "macro_renderRows", [($context["fsc"] ?? null), ($context["i18n"] ?? null), ($context["rows"] ?? null), ($context["fields"] ?? null)], 6, $context, $this->getSourceContext());
            echo "
";
        } elseif (        // line 7
($context["fields"] ?? null)) {
            // line 8
            echo "    ";
            echo twig_call_macro($macros["_self"], "macro_renderFields", [($context["fsc"] ?? null), ($context["i18n"] ?? null), ($context["fields"] ?? null)], 8, $context, $this->getSourceContext());
            echo "
";
        }
        // line 10
        echo "
<script>
    function sendFormImport(action) {
        animateSpinner('add');
        document.formImport.action.value = action;
        document.formImport.submit();
    }
</script>

";
        // line 49
        echo "
";
    }

    // line 19
    public function macro_renderFields($__fsc__ = null, $__i18n__ = null, $__fields__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "i18n" => $__i18n__,
            "fields" => $__fields__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 20
            echo "    <div class=\"card shadow border-secondary\">
        <div class=\"card-header bg-secondary\">
            <h2 class=\"h5\">
                <i class=\"fas fa-file-import\"></i> ";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "generic-template"], "method", false, false, false, 23), "html", null, true);
            echo "
            </h2>
            <p class=\"card-text\">
                ";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "generic-template-p"], "method", false, false, false, 26), "html", null, true);
            echo "
            </p>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-striped mb-0\">
                <thead>
                <tr>
                    <th>";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "column"], "method", false, false, false, 33), "html", null, true);
            echo "</th>
                    <th>";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "description"], "method", false, false, false, 34), "html", null, true);
            echo "</th>
                </tr>
                </thead>
                <tbody>
                ";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["field"]) {
                // line 39
                echo "                    <tr>
                        <td>";
                // line 40
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "</td>
                        <td>";
                // line 41
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => twig_get_attribute($this->env, $this->source, $context["field"], "title", [], "any", false, false, false, 41)], "method", false, false, false, 41), "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
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

    // line 50
    public function macro_renderRows($__fsc__ = null, $__i18n__ = null, $__rows__ = null, $__fields__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "fsc" => $__fsc__,
            "i18n" => $__i18n__,
            "rows" => $__rows__,
            "fields" => $__fields__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 51
            echo "    <form method=\"post\" name=\"formImport\">
        <input type=\"hidden\" name=\"action\" value=\"\"/>
        <input type=\"hidden\" name=\"multireqtoken\" value=\"";
            // line 53
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "multiRequestProtection", [], "any", false, false, false, 53), "newToken", [], "method", false, false, false, 53), "html", null, true);
            echo "\"/>
        <div class=\"card shadow border-warning\">
            <div class=\"card-header bg-warning\">
                <h2 class=\"h5\">
                    <i class=\"fas fa-file-import\"></i> ";
            // line 57
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "import-options"], "method", false, false, false, 57), "html", null, true);
            echo "
                </h2>
                <p class=\"card-text\">
                    ";
            // line 60
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "strange-characters-p"], "method", false, false, false, 60), "html", null, true);
            echo "
                </p>
            </div>
            <div class=\"table-responsive\">
                <table class=\"table table-hover\">
                    <thead>
                    <tr>
                        <th>";
            // line 67
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "column"], "method", false, false, false, 67), "html", null, true);
            echo "</th>
                        <th>";
            // line 68
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "value-1"], "method", false, false, false, 68), "html", null, true);
            echo "</th>
                        <th>";
            // line 69
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "value-2"], "method", false, false, false, 69), "html", null, true);
            echo "</th>
                        <th>";
            // line 70
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "value-3"], "method", false, false, false, 70), "html", null, true);
            echo "</th>
                        <th>";
            // line 71
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "use-as"], "method", false, false, false, 71), "html", null, true);
            echo "</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 76
                echo "                        <tr>
                            <td>";
                // line 77
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "title", [], "any", false, false, false, 77), "html", null, true);
                echo "</td>
                            <td>";
                // line 78
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "value1", [], "any", false, false, false, 78), "html", null, true);
                echo "</td>
                            <td>";
                // line 79
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "value2", [], "any", false, false, false, 79), "html", null, true);
                echo "</td>
                            <td>";
                // line 80
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "value3", [], "any", false, false, false, 80), "html", null, true);
                echo "</td>
                            <td class=\"";
                // line 81
                echo ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["row"], "use", [], "any", false, false, false, 81))) ? ("table-warning") : ("table-success"));
                echo "\">
                                ";
                // line 82
                $context["fieldName"] = ("field" . twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 82));
                // line 83
                echo "                                <select name=\"";
                echo twig_escape_filter($this->env, ($context["fieldName"] ?? null), "html", null, true);
                echo "\" class=\"form-control\">
                                    <option value=\"\">";
                // line 84
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "do-not-use"], "method", false, false, false, 84), "html", null, true);
                echo "</option>
                                    <option value=\"\">------</option>
                                    ";
                // line 86
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                    // line 87
                    echo "                                        ";
                    if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["row"], "use", [], "any", false, false, false, 87), $context["key"]))) {
                        // line 88
                        echo "                                            <option value=\"";
                        echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "\"
                                                    selected=\"\">";
                        // line 89
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => twig_get_attribute($this->env, $this->source, $context["option"], "title", [], "any", false, false, false, 89)], "method", false, false, false, 89), "html", null, true);
                        echo "</option>
                                        ";
                    } else {
                        // line 91
                        echo "                                            <option value=\"";
                        echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => twig_get_attribute($this->env, $this->source, $context["option"], "title", [], "any", false, false, false, 91)], "method", false, false, false, 91), "html", null, true);
                        echo "</option>
                                        ";
                    }
                    // line 93
                    echo "                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 94
                echo "                                </select>
                            </td>
                        </tr>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                    </tbody>
                </table>
            </div>
            <div class=\"card-body\">
                <button type=\"button\" class=\"btn btn-primary btn-spin-action\"
                        onclick=\"return sendFormImport('save-columns');\">
                    <i class=\"fas fa-save\"></i> ";
            // line 104
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "save-columns"], "method", false, false, false, 104), "html", null, true);
            echo "
                </button>
                <button type=\"button\" class=\"btn btn-warning float-right btn-spin-action\"
                        onclick=\"return sendFormImport('import');\">
                    <i class=\"fas fa-file-import\"></i> ";
            // line 108
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "import"], "method", false, false, false, 108), "html", null, true);
            echo "
                </button>
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
        return "CSVfields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  339 => 108,  332 => 104,  324 => 98,  307 => 94,  301 => 93,  293 => 91,  288 => 89,  283 => 88,  280 => 87,  276 => 86,  271 => 84,  266 => 83,  264 => 82,  260 => 81,  256 => 80,  252 => 79,  248 => 78,  244 => 77,  241 => 76,  224 => 75,  217 => 71,  213 => 70,  209 => 69,  205 => 68,  201 => 67,  191 => 60,  185 => 57,  178 => 53,  174 => 51,  158 => 50,  145 => 44,  136 => 41,  132 => 40,  129 => 39,  125 => 38,  118 => 34,  114 => 33,  104 => 26,  98 => 23,  93 => 20,  78 => 19,  73 => 49,  62 => 10,  56 => 8,  54 => 7,  49 => 6,  47 => 5,  44 => 4,  42 => 3,  40 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "CSVfields.html.twig", "/var/www/html/Dinamic/View/CSVfields.html.twig");
    }
}
