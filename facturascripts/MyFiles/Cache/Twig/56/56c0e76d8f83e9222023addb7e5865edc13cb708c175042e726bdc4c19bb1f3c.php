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

/* Tab/ApiAccess.html.twig */
class __TwigTemplate_5ff289606c52e796d4fd094628dbf8706abaa1e5e78c9c7cb62ce1c74ab8eb91 extends Template
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
        echo "<form action=\"\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit-rules\" />
    <input type=\"hidden\" name=\"activetab\" value=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getCurrentView", [], "method", false, false, false, 3), "getViewName", [], "method", false, false, false, 3), "html", null, true);
        echo "\" />
    <input type=\"hidden\" name=\"multireqtoken\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "multiRequestProtection", [], "any", false, false, false, 4), "newToken", [], "method", false, false, false, 4), "html", null, true);
        echo "\"/>
    <div class=\"card shadow\">
        <div class=\"card-body text-right\">
            <button type=\"submit\" class=\"btn btn-sm btn-primary\">
                <i class=\"fas fa-save fa-fw\"></i> ";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "save"], "method", false, false, false, 8), "html", null, true);
        echo "
            </button>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead>
                    <tr>
                        <th>";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "resource"], "method", false, false, false, 15), "html", null, true);
        echo "</th>
                        <th class=\"text-center\">";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "allow-get-data"], "method", false, false, false, 16), "html", null, true);
        echo "</th>
                        <th class=\"text-center\">";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "allow-put-data"], "method", false, false, false, 17), "html", null, true);
        echo "</th>
                        <th class=\"text-center\">";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "allow-post-data"], "method", false, false, false, 18), "html", null, true);
        echo "</th>
                        <th class=\"text-center\">";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "allow-delete-data"], "method", false, false, false, 19), "html", null, true);
        echo "</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getAccessRules", [], "method", false, false, false, 23));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["resource"] => $context["rule"]) {
            // line 24
            echo "                        <tr>
                            <td>";
            // line 25
            echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
            echo "</td>
                            <td class=\"text-center\">
                                ";
            // line 27
            if (twig_get_attribute($this->env, $this->source, $context["rule"], "allowget", [], "any", false, false, false, 27)) {
                // line 28
                echo "                                    <input type=\"checkbox\" name=\"allowget[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" checked=\"\" />
                                ";
            } else {
                // line 30
                echo "                                    <input type=\"checkbox\" name=\"allowget[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" />
                                ";
            }
            // line 32
            echo "                            </td>
                            <td class=\"text-center\">
                                ";
            // line 34
            if (twig_get_attribute($this->env, $this->source, $context["rule"], "allowput", [], "any", false, false, false, 34)) {
                // line 35
                echo "                                    <input type=\"checkbox\" name=\"allowput[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" checked=\"\" />
                                ";
            } else {
                // line 37
                echo "                                    <input type=\"checkbox\" name=\"allowput[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" />
                                ";
            }
            // line 39
            echo "                            </td>
                            <td class=\"text-center\">
                                ";
            // line 41
            if (twig_get_attribute($this->env, $this->source, $context["rule"], "allowpost", [], "any", false, false, false, 41)) {
                // line 42
                echo "                                    <input type=\"checkbox\" name=\"allowpost[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" checked=\"\" />
                                ";
            } else {
                // line 44
                echo "                                    <input type=\"checkbox\" name=\"allowpost[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" />
                                ";
            }
            // line 46
            echo "                            </td>
                            <td class=\"text-center\">
                                ";
            // line 48
            if (twig_get_attribute($this->env, $this->source, $context["rule"], "allowdelete", [], "any", false, false, false, 48)) {
                // line 49
                echo "                                    <input type=\"checkbox\" name=\"allowdelete[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" checked=\"\" />
                                ";
            } else {
                // line 51
                echo "                                    <input type=\"checkbox\" name=\"allowdelete[]\" value=\"";
                echo twig_escape_filter($this->env, $context["resource"], "html", null, true);
                echo "\" />
                                ";
            }
            // line 53
            echo "                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 56
            echo "                        <tr class=\"table-warning\">
                            <td colspan=\"5\">
                                ";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "no-data"], "method", false, false, false, 58), "html", null, true);
            echo "
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['resource'], $context['rule'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "                </tbody>
            </table>
        </div>
        <div class=\"card-body text-right\">
            <button type=\"submit\" class=\"btn btn-sm btn-primary\">
                <i class=\"fas fa-save fa-fw\"></i> ";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["i18n"] ?? null), "trans", [0 => "save"], "method", false, false, false, 67), "html", null, true);
        echo "
            </button>
        </div>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "Tab/ApiAccess.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  194 => 67,  187 => 62,  177 => 58,  173 => 56,  166 => 53,  160 => 51,  154 => 49,  152 => 48,  148 => 46,  142 => 44,  136 => 42,  134 => 41,  130 => 39,  124 => 37,  118 => 35,  116 => 34,  112 => 32,  106 => 30,  100 => 28,  98 => 27,  93 => 25,  90 => 24,  85 => 23,  78 => 19,  74 => 18,  70 => 17,  66 => 16,  62 => 15,  52 => 8,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Tab/ApiAccess.html.twig", "/var/www/html/Dinamic/View/Tab/ApiAccess.html.twig");
    }
}
