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

/* Macro/Utils.html.twig */
class __TwigTemplate_238c53ff40f6b1dd463b89d82e67b22bf3654a77d18f3dc6592ae7849c7e0e00 extends Template
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
        // line 20
        echo "
";
        // line 35
        echo "
";
        // line 49
        echo "
";
    }

    // line 22
    public function macro_message($__log__ = null, $__levels__ = null, $__style__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "log" => $__log__,
            "levels" => $__levels__,
            "style" => $__style__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 23
            echo "    ";
            $context["messages"] = twig_array_merge(twig_get_attribute($this->env, $this->source, ($context["log"] ?? null), "read", [0 => "master", 1 => ($context["levels"] ?? null)], "method", false, false, false, 23), twig_get_attribute($this->env, $this->source, ($context["log"] ?? null), "read", [0 => "database", 1 => ($context["levels"] ?? null)], "method", false, false, false, 23));
            // line 24
            echo "    ";
            if ((1 === twig_compare(twig_length_filter($this->env, ($context["messages"] ?? null)), 0))) {
                // line 25
                echo "        <div class=\"alert alert-";
                echo twig_escape_filter($this->env, ($context["style"] ?? null), "html", null, true);
                echo "\" role=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
            ";
                // line 29
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 30
                    echo "                <div>";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "message", [], "any", false, false, false, 30);
                    echo "</div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 32
                echo "        </div>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 37
    public function macro_messageCompat($__log__ = null, $__levels__ = null, $__style__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "log" => $__log__,
            "levels" => $__levels__,
            "style" => $__style__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 38
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["log"] ?? null), "read", [], "method", false, false, false, 38));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 39
                echo "        ";
                if ((twig_in_filter(twig_get_attribute($this->env, $this->source, $context["item"], "level", [], "any", false, false, false, 39), ($context["levels"] ?? null)) && (0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["item"], "channel", [], "any", false, false, false, 39), "master")))) {
                    // line 40
                    echo "            <div class=\"alert alert-";
                    echo twig_escape_filter($this->env, ($context["style"] ?? null), "html", null, true);
                    echo "\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
                <div>";
                    // line 44
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "message", [], "any", false, false, false, 44);
                    echo "</div>
            </div>
        ";
                }
                // line 47
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 51
    public function macro_popoverTitle($__msg__ = null, $__position__ = "auto", ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "msg" => $__msg__,
            "position" => $__position__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 52
            echo "    ";
            if ((1 === twig_compare(twig_length_filter($this->env, ($context["msg"] ?? null)), 0))) {
                echo "data-toggle=\"popover\" data-placement=\"";
                echo twig_escape_filter($this->env, ($context["position"] ?? null), "html", null, true);
                echo "\" data-trigger=\"hover\" data-content=\"";
                echo twig_escape_filter($this->env, ($context["msg"] ?? null), "html", null, true);
                echo "\"";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "Macro/Utils.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 52,  151 => 51,  138 => 47,  132 => 44,  124 => 40,  121 => 39,  116 => 38,  101 => 37,  90 => 32,  81 => 30,  77 => 29,  69 => 25,  66 => 24,  63 => 23,  48 => 22,  43 => 49,  40 => 35,  37 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Macro/Utils.html.twig", "/var/www/html/Dinamic/View/Macro/Utils.html.twig");
    }
}
