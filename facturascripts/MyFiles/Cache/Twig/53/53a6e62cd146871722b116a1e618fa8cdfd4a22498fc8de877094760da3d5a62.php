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

/* Master/MicroTemplate.html.twig */
class __TwigTemplate_6a4ade77062190c9082e6e47b0d36b8df624f64ec5dbaa26be110d8f2a885ce7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'meta' => [$this, 'block_meta'],
            'icons' => [$this, 'block_icons'],
            'css' => [$this, 'block_css'],
            'javascripts' => [$this, 'block_javascripts'],
            'fullBody' => [$this, 'block_fullBody'],
            'messages' => [$this, 'block_messages'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_constant("FS_LANG"), 0, 2), "html", null, true);
        echo "\" xml:lang=\"";
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_constant("FS_LANG"), 0, 2), "html", null, true);
        echo "\" >
    <head>
        ";
        // line 24
        $this->displayBlock('meta', $context, $blocks);
        // line 32
        echo "        ";
        $this->displayBlock('icons', $context, $blocks);
        // line 36
        echo "        ";
        $this->displayBlock('css', $context, $blocks);
        // line 40
        echo "        ";
        // line 41
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["assetManager"] ?? null), "get", [0 => "css"], "method", false, false, false, 41));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 42
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $context["css"], "html", null, true);
            echo "\" />
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 49
        echo "        ";
        // line 50
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["assetManager"] ?? null), "get", [0 => "js"], "method", false, false, false, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["js"]) {
            // line 51
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, $context["js"], "html", null, true);
            echo "\"></script>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        echo "        ";
        echo twig_get_attribute($this->env, $this->source, ($context["debugBarRender"] ?? null), "renderHead", [], "method", false, false, false, 53);
        echo "
    </head>
    ";
        // line 55
        $this->displayBlock('fullBody', $context, $blocks);
        // line 69
        echo "</html>";
    }

    // line 24
    public function block_meta($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <title>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 26), "html", null, true);
        echo "</title>
            <meta name=\"description\" content=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("meta-description"), "html", null, true);
        echo "\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
            <meta name=\"generator\" content=\"FacturaScripts\" />
            <meta name=\"robots\" content=\"noindex\" />
        ";
    }

    // line 32
    public function block_icons($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "            <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/Images/favicon.ico"), "html", null, true);
        echo "\" />
            <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/Images/apple-icon-180x180.png"), "html", null, true);
        echo "\" />
        ";
    }

    // line 36
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 37
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootstrap/dist/css/bootstrap.min.css"), "html", null, true);
        echo "\" />
            <link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/@fortawesome/fontawesome-free/css/all.min.css"), "html", null, true);
        echo "\"/>
        ";
    }

    // line 44
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 45
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/jquery/dist/jquery.min.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/@fortawesome/fontawesome-free/js/all.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    // line 55
    public function block_fullBody($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 56
        echo "        <body>
            ";
        // line 57
        $this->displayBlock('messages', $context, $blocks);
        // line 64
        echo "            ";
        $this->displayBlock('body', $context, $blocks);
        // line 66
        echo "            ";
        echo twig_get_attribute($this->env, $this->source, ($context["debugBarRender"] ?? null), "render", [], "method", false, false, false, 66);
        echo "
        </body>
    ";
    }

    // line 57
    public function block_messages($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 58
        echo "                ";
        $macros["__internal_parse_0"] = $this->loadTemplate("Macro/Utils.html.twig", "Master/MicroTemplate.html.twig", 58)->unwrap();
        // line 59
        echo "                ";
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "error", 1 => "critical"], "danger"], 59, $context, $this->getSourceContext());
        echo "
                ";
        // line 60
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "warning"], "warning"], 60, $context, $this->getSourceContext());
        echo "
                ";
        // line 61
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "notice"], "success"], 61, $context, $this->getSourceContext());
        echo "
                ";
        // line 62
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "info"], "info"], 62, $context, $this->getSourceContext());
        echo "
            ";
    }

    // line 64
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 65
        echo "            ";
    }

    public function getTemplateName()
    {
        return "Master/MicroTemplate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 65,  224 => 64,  218 => 62,  214 => 61,  210 => 60,  205 => 59,  202 => 58,  198 => 57,  190 => 66,  187 => 64,  185 => 57,  182 => 56,  178 => 55,  172 => 47,  168 => 46,  163 => 45,  159 => 44,  153 => 38,  148 => 37,  144 => 36,  138 => 34,  133 => 33,  129 => 32,  120 => 27,  116 => 26,  113 => 25,  109 => 24,  105 => 69,  103 => 55,  97 => 53,  88 => 51,  83 => 50,  81 => 49,  78 => 44,  69 => 42,  64 => 41,  62 => 40,  59 => 36,  56 => 32,  54 => 24,  47 => 22,  44 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/MicroTemplate.html.twig", "/var/www/html/Dinamic/View/Master/MicroTemplate.html.twig");
    }
}
