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

/* Master/MenuTemplate.html.twig */
class __TwigTemplate_ee956795be62b95550969f85e654eb9a1da5d0854a44afeb13fa35f3b6188939 extends Template
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
            'navbar' => [$this, 'block_navbar'],
            'navbarContent' => [$this, 'block_navbarContent'],
            'messages' => [$this, 'block_messages'],
            'bodyHeaderOptions' => [$this, 'block_bodyHeaderOptions'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 20
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_constant("FS_LANG"), 0, 2), "html", null, true);
        echo "\"
      xml:lang=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_constant("FS_LANG"), 0, 2), "html", null, true);
        echo "\">
<head>
    ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "HeadFirst"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 25
            echo "        ";
            $this->loadTemplate((($__internal_compile_0 = $context["item"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 25)->display($context);
            // line 26
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    ";
        $this->displayBlock('meta', $context, $blocks);
        // line 35
        echo "    ";
        $this->displayBlock('icons', $context, $blocks);
        // line 40
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "CssBefore"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 41
            echo "        ";
            $this->loadTemplate((($__internal_compile_1 = $context["item"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 41)->display($context);
            // line 42
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "    ";
        $this->displayBlock('css', $context, $blocks);
        // line 48
        echo "    ";
        // line 49
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["assetManager"] ?? null), "get", [0 => "css"], "method", false, false, false, 49));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 50
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $context["css"], "html", null, true);
            echo "\"/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "CssAfter"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 53
            echo "        ";
            $this->loadTemplate((($__internal_compile_2 = $context["item"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 53)->display($context);
            // line 54
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "JsHeadBefore"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 56
            echo "        ";
            $this->loadTemplate((($__internal_compile_3 = $context["item"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 56)->display($context);
            // line 57
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "    ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 67
        echo "    ";
        // line 68
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["assetManager"] ?? null), "get", [0 => "js"], "method", false, false, false, 68));
        foreach ($context['_seq'] as $context["_key"] => $context["js"]) {
            // line 69
            echo "        <script src=\"";
            echo twig_escape_filter($this->env, $context["js"], "html", null, true);
            echo "\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "JsHeadAfter"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 72
            echo "        ";
            $this->loadTemplate((($__internal_compile_4 = $context["item"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 72)->display($context);
            // line 73
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "    ";
        echo twig_get_attribute($this->env, $this->source, ($context["debugBarRender"] ?? null), "renderHead", [], "method", false, false, false, 74);
        echo "
    ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "HeadEnd"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 76
            echo "        ";
            $this->loadTemplate((($__internal_compile_5 = $context["item"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 76)->display($context);
            // line 77
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "</head>
";
        // line 79
        $this->displayBlock('fullBody', $context, $blocks);
        // line 171
        echo "</html>
";
    }

    // line 27
    public function block_meta($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 28
        echo "        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
        <title>";
        // line 29
        echo twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "title", [], "any", false, false, false, 29);
        echo "</title>
        <meta name=\"description\" content=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("meta-description"), "html", null, true);
        echo "\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
        <meta name=\"generator\" content=\"FacturaScripts\"/>
        <meta name=\"robots\" content=\"noindex\"/>
    ";
    }

    // line 35
    public function block_icons($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/Images/favicon.ico"), "html", null, true);
        echo "\"/>
        <link rel=\"apple-touch-icon\" sizes=\"180x180\"
              href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/Images/apple-icon-180x180.png"), "html", null, true);
        echo "\"/>
    ";
    }

    // line 43
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 44
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootstrap/dist/css/bootstrap.min.css"), "html", null, true);
        echo "\"/>
        <link rel=\"stylesheet\" href=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/@fortawesome/fontawesome-free/css/all.min.css"), "html", null, true);
        echo "\"/>
        <link rel=\"stylesheet\" href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/CSS/custom.css"), "html", null, true);
        echo "?v=6\"/>
    ";
    }

    // line 58
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 59
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/jquery/dist/jquery.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootbox/dist/bootbox.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/bootbox/dist/bootbox.locales.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/pace-js/pace.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("node_modules/@fortawesome/fontawesome-free/js/all.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/JS/Custom.js"), "html", null, true);
        echo "?v=6\"></script>
    ";
    }

    // line 79
    public function block_fullBody($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 80
        echo "    <body>
    ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "BodyFirst"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 82
            echo "        ";
            $this->loadTemplate((($__internal_compile_6 = $context["item"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 82)->display($context);
            // line 83
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "    ";
        $this->displayBlock('navbar', $context, $blocks);
        // line 140
        echo "    <div class=\"pt-3\">
        ";
        // line 141
        $this->displayBlock('messages', $context, $blocks);
        // line 154
        echo "        ";
        $this->displayBlock('bodyHeaderOptions', $context, $blocks);
        // line 156
        echo "    </div>
    ";
        // line 157
        $this->displayBlock('body', $context, $blocks);
        // line 159
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "JsFooter"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 160
            echo "        ";
            $this->loadTemplate((($__internal_compile_7 = $context["item"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 160)->display($context);
            // line 161
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        echo "    <br/>
    <br/>
    <br/>
    ";
        // line 165
        echo twig_get_attribute($this->env, $this->source, ($context["debugBarRender"] ?? null), "render", [], "method", false, false, false, 165);
        echo "
    ";
        // line 166
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "BodyEnd"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 167
            echo "        ";
            $this->loadTemplate((($__internal_compile_8 = $context["item"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 167)->display($context);
            // line 168
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 169
        echo "    </body>
";
    }

    // line 84
    public function block_navbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 85
        echo "        <nav class=\"navbar navbar-expand navbar-dark bg-primary sticky-top d-print-none\">
            ";
        // line 86
        $this->displayBlock('navbarContent', $context, $blocks);
        // line 138
        echo "        </nav>
    ";
    }

    // line 86
    public function block_navbarContent($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 87
        echo "                <a class=\"navbar-brand d-none d-sm-inline\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(""), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("homepage"), "html", null, true);
        echo "\">
                    <img src=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()("Dinamic/Assets/Images/logo-white.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\"
                         class=\"d-inline-block align-top\" alt=\"FacturaScripts\"/>
                    <span class=\"d-none d-xl-inline-block\">";
        // line 90
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "empresa", [], "any", false, false, false, 90), "nombrecorto", [], "any", false, false, false, 90);
        echo "</span>
                </a>
                <div class=\"navbar-collapse collapse\">
                    <ul class=\"navbar-nav pt-1\">
                        ";
        // line 94
        $macros["macros"] = $this->loadTemplate("Macro/Menu.html.twig", "Master/MenuTemplate.html.twig", 94)->unwrap();
        // line 95
        echo "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["menuManager"] ?? null), "getMenu", [], "method", false, false, false, 95));
        foreach ($context['_seq'] as $context["_key"] => $context["menuItem"]) {
            // line 96
            echo "                            ";
            echo twig_call_macro($macros["macros"], "macro_showMenu", [$context["menuItem"]], 96, $context, $this->getSourceContext());
            echo "
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menuItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "                    </ul>
                    <ul class=\"navbar-nav flex-row ml-auto\">
                        ";
        // line 100
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "MenuIconBefore"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 101
            echo "                            ";
            $this->loadTemplate((($__internal_compile_9 = $context["item"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 101)->display($context);
            // line 102
            echo "                        ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "                        <li class=\"nav-item";
        echo (((0 === twig_compare(($context["template"] ?? null), "MegaSearch.html.twig"))) ? (" active") : (""));
        echo "\"
                            title=\"";
        // line 104
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("search"), "html", null, true);
        echo "\">
                            <a class=\"nav-link\" href=\"MegaSearch\">
                                <i class=\"fas fa-search\" aria-hidden=\"true\"></i>
                            </a>
                        </li>
                        <li class=\"nav-item\" title=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("help"), "html", null, true);
        echo "\">
                            <a class=\"nav-link\" href=\"https://facturascripts.com/ayuda\" rel=\"nofollow\" target=\"_blank\">
                                <i class=\"fas fa-question-circle\" aria-hidden=\"true\"></i>
                            </a>
                        </li>
                        <li class=\"nav-item dropdown\" title=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("user"), "html", null, true);
        echo "\">
                            <a class=\"nav-link dropdown-toggle mr-md-2\" href=\"#\" data-toggle=\"dropdown\"
                               aria-haspopup=\"true\" aria-expanded=\"false\">
                                <i class=\"fas fa-user-circle fa-fw\" aria-hidden=\"true\"></i>
                            </a>
                            <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"user-list\">
                                <a class=\"dropdown-item\" href=\"";
        // line 120
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "user", [], "any", false, false, false, 120), "url", [], "method", false, false, false, 120), "html", null, true);
        echo "\">
                                    <i class=\"fas fa-user-circle fa-fw\" aria-hidden=\"true\"></i> ";
        // line 121
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "user", [], "any", false, false, false, 121), "nick", [], "any", false, false, false, 121), "html", null, true);
        echo "
                                </a>
                                ";
        // line 123
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "MenuIconUser"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 124
            echo "                                    ";
            $this->loadTemplate((($__internal_compile_10 = $context["item"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 124)->display($context);
            // line 125
            echo "                                ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"?logout=TRUE\">
                                    <i class=\"fas fa-door-open fa-fw\" aria-hidden=\"true\"></i> ";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("logout"), "html", null, true);
        echo "
                                </a>
                            </div>
                        </li>
                        ";
        // line 132
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getFunction('getIncludeViews')->getCallable()("MenuTemplate", "MenuIconAfter"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 133
            echo "                            ";
            $this->loadTemplate((($__internal_compile_11 = $context["item"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["path"] ?? null) : null), "Master/MenuTemplate.html.twig", 133)->display($context);
            // line 134
            echo "                        ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 135
        echo "                    </ul>
                </div>
            ";
    }

    // line 141
    public function block_messages($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 142
        echo "            ";
        $macros["__internal_parse_0"] = $this->loadTemplate("Macro/Utils.html.twig", "Master/MenuTemplate.html.twig", 142)->unwrap();
        // line 143
        echo "            <div class=\"container-fluid\">
                <div class=\"row\">
                    <div class=\"col-12\">
                        ";
        // line 146
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "error", 1 => "critical"], "danger"], 146, $context, $this->getSourceContext());
        echo "
                        ";
        // line 147
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "warning"], "warning"], 147, $context, $this->getSourceContext());
        echo "
                        ";
        // line 148
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "notice"], "success"], 148, $context, $this->getSourceContext());
        echo "
                        ";
        // line 149
        echo twig_call_macro($macros["__internal_parse_0"], "macro_message", [($context["log"] ?? null), [0 => "info"], "info"], 149, $context, $this->getSourceContext());
        echo "
                    </div>
                </div>
            </div>
        ";
    }

    // line 154
    public function block_bodyHeaderOptions($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 155
        echo "        ";
    }

    // line 157
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 158
        echo "    ";
    }

    public function getTemplateName()
    {
        return "Master/MenuTemplate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  816 => 158,  812 => 157,  808 => 155,  804 => 154,  795 => 149,  791 => 148,  787 => 147,  783 => 146,  778 => 143,  775 => 142,  771 => 141,  765 => 135,  751 => 134,  748 => 133,  731 => 132,  724 => 128,  720 => 126,  706 => 125,  703 => 124,  686 => 123,  681 => 121,  677 => 120,  668 => 114,  660 => 109,  652 => 104,  647 => 103,  633 => 102,  630 => 101,  613 => 100,  609 => 98,  600 => 96,  595 => 95,  593 => 94,  586 => 90,  581 => 88,  574 => 87,  570 => 86,  565 => 138,  563 => 86,  560 => 85,  556 => 84,  551 => 169,  537 => 168,  534 => 167,  517 => 166,  513 => 165,  508 => 162,  494 => 161,  491 => 160,  473 => 159,  471 => 157,  468 => 156,  465 => 154,  463 => 141,  460 => 140,  457 => 84,  443 => 83,  440 => 82,  423 => 81,  420 => 80,  416 => 79,  410 => 65,  406 => 64,  402 => 63,  398 => 62,  394 => 61,  390 => 60,  385 => 59,  381 => 58,  375 => 46,  371 => 45,  366 => 44,  362 => 43,  356 => 38,  350 => 36,  346 => 35,  337 => 30,  333 => 29,  330 => 28,  326 => 27,  321 => 171,  319 => 79,  316 => 78,  302 => 77,  299 => 76,  282 => 75,  277 => 74,  263 => 73,  260 => 72,  242 => 71,  233 => 69,  228 => 68,  226 => 67,  223 => 58,  209 => 57,  206 => 56,  188 => 55,  174 => 54,  171 => 53,  153 => 52,  144 => 50,  139 => 49,  137 => 48,  134 => 43,  120 => 42,  117 => 41,  99 => 40,  96 => 35,  93 => 27,  79 => 26,  76 => 25,  59 => 24,  54 => 22,  50 => 21,  47 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "Master/MenuTemplate.html.twig", "/var/www/html/Dinamic/View/Master/MenuTemplate.html.twig");
    }
}
