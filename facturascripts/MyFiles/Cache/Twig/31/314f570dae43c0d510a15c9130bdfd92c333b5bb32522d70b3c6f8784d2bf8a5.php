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

/* Master/MenuBgTemplate.html.twig */
class __TwigTemplate_5c513a4f60aaad7274f7295773d3bc750fca1e9a2de36159767f21e6677eaa6f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'fullBody' => [$this, 'block_fullBody'],
            'navbar' => [$this, 'block_navbar'],
            'messages' => [$this, 'block_messages'],
            'bodyHeaderOptions' => [$this, 'block_bodyHeaderOptions'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 20
        return "Master/MenuTemplate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Master/MenuTemplate.html.twig", "Master/MenuBgTemplate.html.twig", 20);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_fullBody($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "    <body class=\"bg-light\">
    ";
        // line 24
        $this->displayBlock('navbar', $context, $blocks);
        // line 27
        echo "    <div class=\"pt-3\">
        ";
        // line 28
        $this->displayBlock('messages', $context, $blocks);
        // line 31
        echo "        ";
        $this->displayBlock('bodyHeaderOptions', $context, $blocks);
        // line 34
        echo "    </div>
    ";
        // line 35
        $this->displayBlock('body', $context, $blocks);
        // line 38
        echo "    <br/>
    <br/>
    <br/>
    ";
        // line 41
        echo twig_get_attribute($this->env, $this->source, ($context["debugBarRender"] ?? null), "render", [], "method", false, false, false, 41);
        echo "
    </body>
";
    }

    // line 24
    public function block_navbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "        ";
        $this->displayParentBlock("navbar", $context, $blocks);
        echo "
    ";
    }

    // line 28
    public function block_messages($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 29
        echo "            ";
        $this->displayParentBlock("messages", $context, $blocks);
        echo "
        ";
    }

    // line 31
    public function block_bodyHeaderOptions($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 32
        echo "            ";
        $this->displayParentBlock("bodyHeaderOptions", $context, $blocks);
        echo "
        ";
    }

    // line 35
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        echo "        ";
        $this->displayParentBlock("body", $context, $blocks);
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "Master/MenuBgTemplate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 36,  117 => 35,  110 => 32,  106 => 31,  99 => 29,  95 => 28,  88 => 25,  84 => 24,  77 => 41,  72 => 38,  70 => 35,  67 => 34,  64 => 31,  62 => 28,  59 => 27,  57 => 24,  54 => 23,  50 => 22,  39 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/MenuBgTemplate.html.twig", "/var/www/html/Dinamic/View/Master/MenuBgTemplate.html.twig");
    }
}
