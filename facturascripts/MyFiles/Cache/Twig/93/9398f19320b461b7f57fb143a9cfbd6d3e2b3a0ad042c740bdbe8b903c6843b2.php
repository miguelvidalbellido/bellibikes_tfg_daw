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

/* Tab/DocFiles.html.twig */
class __TwigTemplate_9c6596e3fa69c7aab692a2a93e99624dc8531c20e02dcba1fe69ac6ed1c155e0 extends Template
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
        $context["firstView"] = twig_first($this->env, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "views", [], "any", false, false, false, 1));
        // line 2
        $context["doc"] = twig_get_attribute($this->env, $this->source, ($context["firstView"] ?? null), "model", [], "any", false, false, false, 2);
        // line 3
        $context["currentView"] = twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "getCurrentView", [], "method", false, false, false, 3);
        // line 4
        echo "
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col\">
            ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "cursor", [], "any", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["docfile"]) {
            // line 9
            echo "                <form action=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "url", [], "method", false, false, false, 9), "html", null, true);
            echo "\" method=\"post\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"activetab\" value=\"";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 10), "html", null, true);
            echo "\"/>
                    <input type=\"hidden\" name=\"id\" value=\"";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["docfile"], "id", [], "any", false, false, false, 11), "html", null, true);
            echo "\"/>
                    ";
            // line 12
            echo $this->env->getFunction('formToken')->getCallable()();
            echo "
                    <div class=\"card shadow mb-3\">
                        <div class=\"card-body\">
                            <div class=\"form-group\">
                                <textarea name=\"observations\" class=\"form-control\"
                                          placeholder=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("observations"), "html", null, true);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["docfile"], "observations", [], "any", false, false, false, 17);
            echo "</textarea>
                            </div>
                            <div class=\"form-row align-items-end\">
                                <div class=\"col\">
                                    ";
            // line 21
            $context["file"] = twig_get_attribute($this->env, $this->source, $context["docfile"], "getFile", [], "method", false, false, false, 21);
            // line 22
            echo "                                    <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('asset')->getCallable()(twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "url", [], "method", false, false, false, 22)), "html", null, true);
            echo "\" class=\"btn btn-sm btn-outline-primary\">
                                        <i class=\"far fa-file\"></i> ";
            // line 23
            echo twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "filename", [], "any", false, false, false, 23);
            echo "
                                    </a>
                                </div>
                                <div class=\"col\">
                                    <p class=\"text-muted mb-0\">
                                        ";
            // line 28
            if (twig_get_attribute($this->env, $this->source, $context["docfile"], "nick", [], "any", false, false, false, 28)) {
                // line 29
                echo "                                            <i class=\"fas fa-user\"></i> ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["docfile"], "nick", [], "any", false, false, false, 29), "html", null, true);
                echo "
                                        ";
            }
            // line 31
            echo "                                        <i class=\"fas fa-calendar-alt ml-2\"></i> ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["docfile"], "creationdate", [], "any", false, false, false, 31), "html", null, true);
            echo "
                                    </p>
                                </div>
                                <div class=\"col text-right\">
                                    <button type=\"submit\" name=\"action\" value=\"edit-file\"
                                            class=\"btn btn-sm btn-primary\">
                                        <i class=\"fas fa-save fa-fw\" aria-hidden=\"true\"></i> ";
            // line 37
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("save"), "html", null, true);
            echo "
                                    </button>
                                    ";
            // line 39
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "permissions", [], "any", false, false, false, 39), "allowDelete", [], "any", false, false, false, 39)) {
                // line 40
                echo "                                        <div class=\"btn-group ml-2\">
                                            <div class=\"dropdown\">
                                                <button class=\"btn btn-sm btn-danger dropdown-toggle\" type=\"button\"
                                                        data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                                        aria-expanded=\"false\">
                                                    <i class=\"fas fa-trash-alt\"></i>
                                                </button>
                                                <div class=\"dropdown-menu dropdown-menu-right\">
                                                    <button type=\"submit\" name=\"action\" value=\"delete-file\"
                                                            class=\"dropdown-item\" href=\"#\">
                                                        <i class=\"far fa-trash-alt fa-fw\"></i> ";
                // line 50
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("delete-file"), "html", null, true);
                echo "
                                                    </button>
                                                    <button type=\"submit\" name=\"action\" value=\"unlink-file\"
                                                            class=\"dropdown-item\" href=\"#\">
                                                        <i class=\"fas fa-unlink fa-fw\"></i> ";
                // line 54
                echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("unlink-file"), "html", null, true);
                echo "
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    ";
            }
            // line 60
            echo "                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['docfile'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "            ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["fsc"] ?? null), "permissions", [], "any", false, false, false, 66), "allowUpdate", [], "any", false, false, false, 66)) {
            // line 67
            echo "                <form action=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "url", [], "method", false, false, false, 67), "html", null, true);
            echo "\" method=\"post\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"activetab\" value=\"";
            // line 68
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "getViewName", [], "method", false, false, false, 68), "html", null, true);
            echo "\"/>
                    <input type=\"hidden\" name=\"action\" value=\"add-file\"/>
                    ";
            // line 70
            echo $this->env->getFunction('formToken')->getCallable()();
            echo "
                    <div class=\"card border-success shadow\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">
                                <i class=\"far fa-file\"></i> ";
            // line 74
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("new"), "html", null, true);
            echo "
                            </h5>
                            <div class=\"form-group\">
                                <textarea name=\"observations\" class=\"form-control\"
                                          placeholder=\"";
            // line 78
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("observations"), "html", null, true);
            echo "\"></textarea>
                            </div>
                            <div class=\"form-row align-items-end\">
                                <div class=\"col\">
                                    <input type=\"file\" name=\"new-file\" class=\"form-control-file\" required/>
                                    <p class=\"text-muted mb-0\">
                                        ";
            // line 84
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("help-server-accepts-filesize", ["%size%" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentView"] ?? null), "model", [], "any", false, false, false, 84), "getMaxFileUpload", [], "method", false, false, false, 84)]), "html", null, true);
            echo "
                                    </p>
                                </div>
                                <div class=\"col text-right\">
                                    <button type=\"submit\" class=\"btn btn-sm btn-success\">
                                        <i class=\"fas fa-save fa-fw\" aria-hidden=\"true\"></i> ";
            // line 89
            echo twig_escape_filter($this->env, $this->env->getFunction('trans')->getCallable()("save"), "html", null, true);
            echo "
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            ";
        }
        // line 97
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "Tab/DocFiles.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 97,  206 => 89,  198 => 84,  189 => 78,  182 => 74,  175 => 70,  170 => 68,  165 => 67,  162 => 66,  151 => 60,  142 => 54,  135 => 50,  123 => 40,  121 => 39,  116 => 37,  106 => 31,  100 => 29,  98 => 28,  90 => 23,  85 => 22,  83 => 21,  74 => 17,  66 => 12,  62 => 11,  58 => 10,  53 => 9,  49 => 8,  43 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Tab/DocFiles.html.twig", "/var/www/html/Dinamic/View/Tab/DocFiles.html.twig");
    }
}
