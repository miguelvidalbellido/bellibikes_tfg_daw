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

/* Master/PanelControllerBottom.html.twig */
class __TwigTemplate_e31dd6fb7df0e589e54ec7bead20a94b3f530d32f5a07aaa6701fffbc9ebf8f5 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 20
        return "Master/PanelController.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/PanelController.html.twig", "Master/PanelControllerBottom.html.twig", 20);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col\">
                ";
        // line 27
        echo "                ";
        $context["firstView"] = twig_first($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 27));
        // line 28
        echo "                ";
        $context["firstViewName"] = twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "getViewName", [], "method", false, false, false, 28);
        // line 29
        echo "                ";
        twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "setCurrentView", [0 => ($context["firstViewName"] ?? null)], "method", false, false, false, 29);
        // line 30
        echo "                ";
        echo twig_include($this->env, $context, twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "template", [], "any", false, false, false, 30));
        echo "
            </div>
        </div>
        ";
        // line 33
        if ((1 === twig_compare(twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 33)), 2))) {
            // line 34
            echo "            <div class=\"row\">
                <div class=\"col\">
                    <ul class=\"nav nav-pills mb-3 d-print-none\" id=\"mainTabs\" role=\"tablist\">
                        ";
            // line 37
            $context["contActiveTab"] = 0;
            // line 38
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 38), 1, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 38))));
            foreach ($context['_seq'] as $context["viewName"] => $context["view"]) {
                // line 39
                echo "                            ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 39), "active", [], "any", false, false, false, 39)) {
                    // line 40
                    echo "                                ";
                    $context["contActiveTab"] = (($context["contActiveTab"] ?? null) + 1);
                    // line 41
                    echo "                                <li class=\"nav-item\">
                                    ";
                    // line 42
                    $context["active"] = ((((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 42))) || ((0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 42), ($context["firstViewName"] ?? null))) && (0 === twig_compare(($context["contActiveTab"] ?? null), 1))))) ? (" active") : (""));
                    // line 43
                    echo "                                    <a href=\"#";
                    echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                    echo "\" class=\"nav-link";
                    echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["disable"] ?? null), "html", null, true);
                    echo "\" data-toggle=\"tab\" role=\"tab\" aria-controls=\"";
                    echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                    echo "\">
                                        <i class=\"";
                    // line 44
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "icon", [], "any", false, false, false, 44), "html", null, true);
                    echo "\" aria-hidden=\"true\"></i>
                                        <span class=\"d-none d-sm-inline-block\">&nbsp;";
                    // line 45
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["view"], "title", [], "any", false, false, false, 45), "html", null, true);
                    echo "</span>
                                        ";
                    // line 46
                    if ((1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 46), 0))) {
                        // line 47
                        echo "                                            <span class=\"badge badge-secondary\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "toolBox", [], "method", false, false, false, 47), "numbers", [], "method", false, false, false, 47), "format", [0 => twig_get_attribute($this->env, $this->source, $context["view"], "count", [], "any", false, false, false, 47), 1 => 0], "method", false, false, false, 47), "html", null, true);
                        echo "</span>
                                        ";
                    }
                    // line 49
                    echo "                                    </a>
                                </li>
                            ";
                }
                // line 52
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['viewName'], $context['view'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo "                    </ul>
                </div>
            </div>
        ";
        }
        // line 57
        echo "        <div class=\"tab-content\" id=\"mainTabsContent\">
            ";
        // line 58
        $context["contActiveTab"] = 0;
        // line 59
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 59), 1, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 59))));
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
            // line 60
            echo "                ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["view"], "settings", [], "any", false, false, false, 60), "active", [], "any", false, false, false, 60)) {
                // line 61
                echo "                    ";
                $context["contActiveTab"] = (($context["contActiveTab"] ?? null) + 1);
                // line 62
                echo "                    ";
                $context["active"] = ((((0 === twig_compare($context["viewName"], twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 62))) || ((0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "active", [], "any", false, false, false, 62), ($context["firstViewName"] ?? null))) && (0 === twig_compare(($context["contActiveTab"] ?? null), 1))))) ? (" show active") : (""));
                // line 63
                echo "                    <div class=\"tab-pane";
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo "\" id=\"";
                echo twig_escape_filter($this->env, $context["viewName"], "html", null, true);
                echo "\" role=\"tabpanel\">
                        ";
                // line 64
                twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "setCurrentView", [0 => $context["viewName"]], "method", false, false, false, 64);
                // line 65
                echo "                        ";
                echo twig_include($this->env, $context, twig_get_attribute($this->env, $this->source, $context["view"], "template", [], "any", false, false, false, 65));
                echo "
                    </div>
                ";
            }
            // line 68
            echo "            ";
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
        // line 69
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "Master/PanelControllerBottom.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 69,  187 => 68,  180 => 65,  178 => 64,  171 => 63,  168 => 62,  165 => 61,  162 => 60,  144 => 59,  142 => 58,  139 => 57,  133 => 53,  127 => 52,  122 => 49,  116 => 47,  114 => 46,  110 => 45,  106 => 44,  96 => 43,  94 => 42,  91 => 41,  88 => 40,  85 => 39,  80 => 38,  78 => 37,  73 => 34,  71 => 33,  64 => 30,  61 => 29,  58 => 28,  55 => 27,  50 => 23,  46 => 22,  35 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/PanelControllerBottom.html.twig", "/var/www/html/Dinamic/View/Master/PanelControllerBottom.html.twig");
    }
}
