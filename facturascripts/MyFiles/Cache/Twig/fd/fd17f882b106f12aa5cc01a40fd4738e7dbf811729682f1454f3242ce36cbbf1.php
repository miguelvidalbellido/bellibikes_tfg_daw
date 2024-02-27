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

/* Wizard-2.html.twig */
class __TwigTemplate_87ec2b14581856c9f67ea87fb65e09188792f8c844e7e3b47ebb7583998ab1b3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'messages' => [$this, 'block_messages'],
            'body' => [$this, 'block_body'],
            'css' => [$this, 'block_css'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 20
        return "Master/MicroTemplate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/MicroTemplate.html.twig", "Wizard-2.html.twig", 20);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_messages($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "    <div class=\"bg-primary pt-5 pb-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col\">
                    ";
        // line 27
        $this->displayParentBlock("messages", $context, $blocks);
        echo "
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>
";
    }

    // line 37
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 38
        echo "    <!-- Macros Template Imports -->
    ";
        // line 39
        $macros["forms"] = $this->loadTemplate("Macro/Forms.html.twig", "Wizard-2.html.twig", 39)->unwrap();
        // line 40
        echo "    ";
        $context["codimpuesto"] = twig_get_attribute($this->env, $this->source, ($context["appSettings"] ?? null), "get", [0 => "default", 1 => "codimpuesto"], "method", false, false, false, 40);
        // line 41
        echo "    ";
        $context["codretencion"] = twig_get_attribute($this->env, $this->source, ($context["appSettings"] ?? null), "get", [0 => "default", 1 => "codretencion"], "method", false, false, false, 41);
        // line 42
        echo "
    <div class=\"container\" style=\"margin-top: -100px;\">
        <div class=\"card shadow mb-5\">
            <div class=\"card-body\">
                <h1 class=\"h3\">
                    <i class=\"fas fa-magic\" aria-hidden=\"true\"></i> ";
        // line 47
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "wizard"], "method", false, false, false, 47), "html", null, true);
        echo "
                    <a href=\"";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "url", [], "method", false, false, false, 48), "html", null, true);
        echo "\" class=\"btn btn-sm btn-outline-secondary\"
                       title=\"";
        // line 49
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "refresh"], "method", false, false, false, 49), "html", null, true);
        echo "\">
                        <i class=\"fas fa-redo\" aria-hidden=\"true\"></i>
                    </a>
                </h1>
                <p>";
        // line 53
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "wizard-p"], "method", false, false, false, 53), "html", null, true);
        echo "</p>
                <hr/>
                <form action=\"#\" method=\"post\" class=\"form\" id=\"formWizard\">
                    <input type=\"hidden\" name=\"action\" value=\"step2\"/>
                    ";
        // line 57
        echo $this->env->getFunction('formToken')->getCallable()();
        echo "
                    <div class=\"form-row\">
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                ";
        // line 61
        echo twig_call_macro($macros["forms"], "macro_simpleSelect", ["regimeniva", "regimeniva", twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "empresa", [], "any", false, false, false, 61), "regimeniva", [], "any", false, false, false, 61), twig_get_attribute($this->env, $this->source,         // line 62
($context["fsc"] ?? null), "getRegimenIva", [], "method", false, false, false, 62), twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "vat-regime"], "method", false, false, false, 62)], 61, $context, $this->getSourceContext());
        echo "
                            </div>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                ";
        // line 67
        echo twig_call_macro($macros["forms"], "macro_simpleSelect", ["codimpuesto", "codimpuesto", ($context["codimpuesto"] ?? null), twig_get_attribute($this->env, $this->source,         // line 68
($context["fsc"] ?? null), "getSelectValues", [0 => "Impuesto", 1 => true], "method", false, false, false, 68), twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "default-tax"], "method", false, false, false, 68)], 67, $context, $this->getSourceContext());
        echo "
                            </div>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                <label class=\"mb-1\">";
        // line 73
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "cost-price-policy"], "method", false, false, false, 73), "html", null, true);
        echo "</label>
                                <select name=\"costpricepolicy\" class=\"form-control\">
                                    <option value=\"\">------</option>
                                    <option value=\"last-price\">";
        // line 76
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "last-purchase-price"], "method", false, false, false, 76), "html", null, true);
        echo "</option>
                                    <option value=\"average-price\">";
        // line 77
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "average-purchase-price"], "method", false, false, false, 77), "html", null, true);
        echo "</option>
                                    <option value=\"actual-price\">";
        // line 78
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "actual-cost-price"], "method", false, false, false, 78), "html", null, true);
        echo "</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-row\">
                        <div class=\"col-sm-auto\">
                            <div class=\"form-group form-check pr-3\">
                                <input type=\"checkbox\" name=\"defaultplan\" value=\"1\" id=\"checkboxPlan\"
                                       class=\"form-check-input\" checked=\"\"/>
                                <label for=\"checkboxPlan\">";
        // line 88
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "load-def-acc-plan"], "method", false, false, false, 88), "html", null, true);
        echo "</label>
                            </div>
                        </div>
                        <div class=\"col-sm-auto\">
                            <div class=\"form-group form-check pr-3\">
                                ";
        // line 93
        if (twig_get_attribute($this->env, $this->source, ($context["appSettings"] ?? null), "get", [0 => "default", 1 => "ventasinstock"], "method", false, false, false, 93)) {
            // line 94
            echo "                                    <input type=\"checkbox\" name=\"ventasinstock\" value=\"1\" id=\"cbNoStock\"
                                           class=\"form-check-input\" checked=\"\"/>
                                ";
        } else {
            // line 97
            echo "                                    <input type=\"checkbox\" name=\"ventasinstock\" value=\"1\" id=\"cbNoStock\"
                                           class=\"form-check-input\"/>
                                ";
        }
        // line 100
        echo "                                <label for=\"cbNoStock\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "allow-sale-without-stock-n"], "method", false, false, false, 100), "html", null, true);
        echo "</label>
                            </div>
                        </div>
                        <div class=\"col-sm-auto\">
                            <div class=\"form-group form-check\">
                                ";
        // line 105
        if (twig_get_attribute($this->env, $this->source, ($context["appSettings"] ?? null), "get", [0 => "default", 1 => "updatesupplierprices"], "method", false, false, false, 105)) {
            // line 106
            echo "                                    <input type=\"checkbox\" name=\"updatesupplierprices\" value=\"1\"
                                           id=\"cbUpdateSupplierPrices\" class=\"form-check-input\" checked=\"\"/>
                                ";
        } else {
            // line 109
            echo "                                    <input type=\"checkbox\" name=\"updatesupplierprices\" value=\"1\"
                                           id=\"cbUpdateSupplierPrices\" class=\"form-check-input\"/>
                                ";
        }
        // line 112
        echo "                                <label for=\"cbUpdateSupplierPrices\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "update-supplier-prices"], "method", false, false, false, 112), "html", null, true);
        echo "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"text-right\">
                        <button type=\"submit\" class=\"btn btn-primary\" id=\"btnWizard\">
                            ";
        // line 118
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "continue"], "method", false, false, false, 118), "html", null, true);
        echo "
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br/>
    </div>
";
    }

    // line 128
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 129
        echo "    ";
        $this->displayParentBlock("css", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 130
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/CSS/custom.css"), "html", null, true);
        echo "\"/>
";
    }

    // line 133
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 134
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/pace-js/pace.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/JS/Custom.js"), "html", null, true);
        echo "\"></script>
    <script>
        \$(document).ready(function () {
            \$(\"#formWizard\").submit(function () {
                \$(\"#btnWizard\").prop('disabled', true);
                \$(\"#btnWizard\").html('<i class=\"fas fa-circle-notch fa-spin\"></i>');
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "Wizard-2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 136,  256 => 135,  251 => 134,  247 => 133,  241 => 130,  236 => 129,  232 => 128,  219 => 118,  209 => 112,  204 => 109,  199 => 106,  197 => 105,  188 => 100,  183 => 97,  178 => 94,  176 => 93,  168 => 88,  155 => 78,  151 => 77,  147 => 76,  141 => 73,  133 => 68,  132 => 67,  124 => 62,  123 => 61,  116 => 57,  109 => 53,  102 => 49,  98 => 48,  94 => 47,  87 => 42,  84 => 41,  81 => 40,  79 => 39,  76 => 38,  72 => 37,  59 => 27,  53 => 23,  49 => 22,  38 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Wizard-2.html.twig", "/var/www/html/Dinamic/View/Wizard-2.html.twig");
    }
}
