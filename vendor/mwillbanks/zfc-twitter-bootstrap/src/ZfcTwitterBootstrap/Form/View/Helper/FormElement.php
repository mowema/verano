<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as ZendFormElement;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\View\Helper\EscapeHtml;

/**
 * Form Element
 */
class FormElement extends ZendFormElement
{
    /**
     * @var \Zend\Form\View\Helper\FormLabel
     */
    protected $labelHelper;

    /**
     * @var \Zend\Form\View\Helper\ZendFormElement
     */
    protected $elementHelper;

    /**
     * @var \Zend\View\Helper\EscapeHtml
     */
    protected $escapeHelper;

    /**
     * @var \Zend\Form\View\Helper\FormElementErrors
     */
    protected $elementErrorHelper;

    /**
     * @var FormDescription
     */
    protected $descriptionHelper;

    /**
     * @var string
     */
    protected $groupWrapper = '<div class="form-group %s">%s</div>';

    /**
     * @var string
     */
    protected $controlWrapper = '<div class="col-md-6 col-sm-6" id="controls-%s">%s%s%s</div>';
    //protected $controlWrappersubmit = '<div class="col-offset-2 col-6" id="controls-%s">%s%s%s</div>';

    /**
     * Set Label Helper
     *
     * @param  Zend\Form\View\Helper\FormLabel $labelHelper
     * @return self
     */
    public function setLabelHelper(FormLabel $labelHelper)
    {
        $labelHelper->setView($this->getView());
        $this->labelHelper = $labelHelper;

        return $this;
    }

    /**
     * Get Label Helper
     *
     * @return \Zend\Form\View\Helper\FormLabel
     */
    public function getLabelHelper()
    {
        if (!$this->labelHelper) {
            $this->setLabelHelper($this->view->plugin('formlabel'));
        }

        return $this->labelHelper;
    }

    /**
     * Set EscapeHtml Helper
     *
     * @param  \Zend\View\Helper\EscapeHtml $escapeHelper
     * @return self
     */
    public function setEscapeHtmlHelper(EscapeHtml $escapeHelper)
    {
        $escapeHelper->setView($this->getView());
        $this->escapeHelper = $escapeHelper;

        return $this;
    }

    /**
     * Get EscapeHtml Helper
     *
     * @return \Zend\View\Helper\EscapeHtml
     */
    public function getEscapeHtmlHelper()
    {
        if (!$this->escapeHelper) {
            $this->setEscapeHtmlHelper($this->view->plugin('escapehtml'));
        }

        return $this->escapeHelper;
    }

    /**
     * Set Element Helper
     *
     * @param  \Zend\Form\View\Helper\FormElement $elementHelper
     * @return self
     */
    public function setElementHelper(ZendFormElement $elementHelper)
    {
        $elementHelper->setView($this->getView());
        $this->elementHelper = $elementHelper;

        return $this;
    }

    /**
     * Get Element Helper
     *
     * @return \Zend\Form\View\Helper\FormElement
     */
    public function getElementHelper()
    {
        if (!$this->elementHelper) {
            $this->setElementHelper($this->view->plugin('formelement'));
        }

        return $this->elementHelper;
    }

    /**
     * Set Element Error Helper
     *
     * @param  \Zend\Form\View\Helper\FormElementErrors $errorHelper
     * @return self
     */
    public function setElementErrorHelper(FormElementErrors $errorHelper)
    {
        $errorHelper->setView($this->getView());
        
        $this->elementErrorHelper = $errorHelper;
        
        return $this;
    }

    /**
     * Get Element Error Helper
     *
     * @return \Zend\Form\View\Helper\FormElementErrors
     */
    public function getElementErrorHelper()
    {
        if (!$this->elementErrorHelper) {
            $this->setElementErrorHelper($this->view->plugin('formelementerrors'));
        }

        return $this->elementErrorHelper;
    }

    /**
     * Set Description Helper
     *
     * @param FormDescription
     * @return self
     */
    public function setDescriptionHelper(FormDescription $descriptionHelper)
    {
        $descriptionHelper->setView($this->getView());
        $this->descriptionHelper = $descriptionHelper;

        return $this;
    }

    /**
     * Get Description Helper
     *
     * @return FormDescription
     */
    public function getDescriptionHelper()
    {
        if (!$this->descriptionHelper) {
            $this->setDescriptionHelper($this->view->plugin('ztbformdescription'));
        }

        return $this->descriptionHelper;
    }

    /**
     * Set Group Wrapper
     *
     * @param  string $groupWrapper
     * @return self
     */
    public function setGroupWrapper($groupWrapper)
    {
        $this->groupWrapper = (string) $groupWrapper;

        return $this;
    }

    /**
     * Get Group Wrapper
     *
     * @return string
     */
    public function getGroupWrapper()
    {
        return $this->groupWrapper;
    }

    /**
     * Set Control Wrapper
     *
     * @param  string $controlWrapper;
     * @return self
     */
    public function setControlWrapper($controlWrapper)
    {
        $this->controlWrapper = (string) $controlWrapper;

        return $this;
    }

    /**
     * Get Control Wrapper
     *
     * @return string
     */
    public function getControlWrapper()
    {
        return $this->controlWrapper;
    }

    /**
     * Render
     *
     * @param  \Zend\Form\ElementInterface $element
     * @param  string                      $groupWrapper
     * @param  string                      $controlWrapper
     * @return string
     */
    public function render(ElementInterface $element, $groupWrapper = null, $controlWrapper = null)
    {
    	
        $labelHelper = $this->getLabelHelper();
        $escapeHelper = $this->getEscapeHtmlHelper();
        $elementHelper = $this->getElementHelper();
        $elementErrorHelper = $this->getElementErrorHelper();
        $descriptionHelper = $this->getDescriptionHelper();
        $groupWrapper = $groupWrapper ?: $this->groupWrapper;
        $controlWrapper = $controlWrapper ?: $this->controlWrapper;
        $renderer = $elementHelper->getView();

        $hiddenElementForCheckbox = '';
        if (method_exists($element, 'useHiddenElement') && $element->useHiddenElement()) {
            // If we have hidden input with checkbox's unchecked value, render that separately so it can be prepended later, and unset it in the element
            $withHidden = $elementHelper->render($element);
            $withoutHidden = $elementHelper->render($element->setUseHiddenElement(false));
            $hiddenElementForCheckbox = str_ireplace($withoutHidden, '', $withHidden);
        }

        $id = $element->getAttribute('id') ?: $element->getAttribute('name');
        $anchi = $element->getAttribute('col') ?: '6';
        $display = $element->getAttribute('display');

        if (method_exists($renderer, 'plugin')) {
            if ($element instanceof \Zend\Form\Element\Radio) {
                $renderer->plugin('form_radio')->setLabelAttributes(array(
                    'class' => 'radio',
                ));
            } elseif ($element instanceof \Zend\Form\Element\MultiCheckbox) {
                $renderer->plugin('form_multi_checkbox')->setLabelAttributes(array(
                    'class' => 'checkbox',
                ));
            }
            
            // if ($element->getValue() == 'Guardar'){Debug::dump($element);}
            //echo $element->getAttribute('type');
        }
        
        // \Zend\Debug\Debug::dump( $element->getAttribute('type') );
        
        if ( ($element instanceof \Zend\Form\Element\Submit) || ($element->getAttribute('type')=="reset")) {
        	//$element->setAttribute('class', 'btn btn-default');
            $controlWrapper = '<div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6" id="controls-%s">%s%s%s</div>';
            
        } elseif ($element->getAttribute('type')=="textarea") { 
        	$controlWrapper = '<div class="col-md-9 col-sm-9" id="controls-%s">%s%s%s</div>';
        } elseif ($element->getAttribute('type')=="file") {
        	$element->setAttribute('class', 'btn btn-default');
        	$controlWrapper = '<div class="col-md-9 col-sm-9" id="controls-%s">%s%s%s</div>';
        } elseif ($element->getAttribute('type') == "datetime"){
            $controlWrapper = '<div id="controls-%s"'.
                    ' class="sandbox-container date input-group col-md-3 col-sm-3" '.
                    'data-date-format = "DD-MM-YYYY">%s%s<span class="input-group-addon">'.
                    '<span class="glyphicon glyphicon-calendar"></span></span></div>'.
                    '<div class="input-group col-md-8 col-md-offset-2">%s</div> ';
        } elseif ($element instanceof \Zend\Form\Element\Hidden){
            
           
        } elseif ($element->getAttribute('type') == "multi_checkbox"){
           
        } else {
            if ($element->getAttribute('class') == "") {$element->setAttribute('class', 'form-control');} // agegamos ----------------------------
            $controlWrapper = '<div class="col-md-'.$anchi.' col-sm-'.($anchi+1).'" id="controls-%s">%s%s%s</div>';
        }
        
        
        
        
        if ($element->getValue() == "Cargar"){
        	$controlWrapper = '<div class="col-md-offset-4 col-sm-offset-4"  id="controls-%s">%s%s%s</div>';
        }

        $controlLabel = '';
        $label = $element->getLabel();
        if (strlen($label) === 0) {
            $label = $element->getOption('label') ?: $element->getAttribute('label');
        }

        if ($label && !$element->getOption('skipLabel')) {

            $controlLabel .= $labelHelper->openTag(array(
                'class' => ($element->getOption('wrapCheckboxInLabel') ? 'checkbox' : 'col-md-2 col-sm-2 control-label'),
            ) + ($element->hasAttribute('id') ? array('for' => $id) : array()));

            if (null !== ($translator = $labelHelper->getTranslator())) {
                $label = $translator->translate(
                    $label, $labelHelper->getTranslatorTextDomain()
                );
            }
            if ($element->getOption('wrapCheckboxInLabel')) {
                $controlLabel .= $elementHelper->render($element) . ' ';
            }
            if ($element->getOption('skipLabelEscape')) {
                $controlLabel .= $label;
            } else {
                $controlLabel .= $escapeHelper($label);
            }
            $controlLabel .= $labelHelper->closeTag();
            if ($element instanceof \Zend\Form\Element\Radio
                || $element instanceof \Zend\Form\Element\MultiCheckbox) {
                $controlLabel = str_replace(array('<label', '</label>'), array('<div', '</div>'), $controlLabel);
            }
        }

        $controls = '';

        if ($element->getOption('wrapCheckboxInLabel')) {
            $controls = $controlLabel;
            $controlLabel = '';
        } else {
            $controls = $elementHelper->render($element);
        }
        
        
        $addtClass = ($element->getMessages()) ? ' has-error' : '';
        
        
        if ($element->getAttribute('required') == "required"){
            $addtClass .= ' required' ;
        }
        
        $html = $hiddenElementForCheckbox . $controlLabel . sprintf($controlWrapper,
            $id,
            $controls,
            $descriptionHelper->render($element),
            $elementErrorHelper->render($element)
        );
        $addtClass .= ($element->getOption('collapse')) ? ' collapse' : '';
        
        
        $addtClass .= ($element->getOption('collapse')) ? ' collapse' : '';
        
        
        
        
        if ($element instanceof \Zend\Form\Element\Hidden){
            return $hiddenElementForCheckbox.$controls.$descriptionHelper->render($element).$elementErrorHelper->render($element);
        }
        if ($display == 'inline'){
            return sprintf('<span style="padding:14px;float:right">%s%s%s</span>',
            
            $controls,
            $descriptionHelper->render($element),
            $elementErrorHelper->render($element));
        }
        return sprintf($groupWrapper, $addtClass, $html);
    }

    /**
     * Magical Invoke
     *
     * @param  \Zend\Form\ElementInterface $element
     * @param  string                      $groupWrapper
     * @param  string                      $controlWrapper
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null, $groupWrapper = null, $controlWrapper = null)
    {
        if ($element) {
            return $this->render($element, $groupWrapper, $controlWrapper);
        }

        return $this;
    }
}