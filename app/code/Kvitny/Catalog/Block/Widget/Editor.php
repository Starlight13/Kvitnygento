<?php

namespace Kvitny\Catalog\Block\Widget;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;

Class Editor extends Template
{
    /**
     * @var Config
     */
    protected $wysiwygConfig;

    /**
     * @var Factory
     */
    protected $factoryElement;

    /**
     * Editor constructor.
     * @param Context $context
     * @param Factory $factoryElement
     * @param Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Factory $factoryElement,
        Config $wysiwygConfig,
        $data = []
    ) {
        $this->factoryElement = $factoryElement;
        $this->wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    /**
     * @param AbstractElement $element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $editor = $this->factoryElement->create('editor', ['data' => $element->getData()])
            ->setLabel('')
            ->setForm($element->getForm())
            ->setWysiwyg(true)
            ->setConfig(
                $this->wysiwygConfig->getConfig([
                    'add_variables' => false,
                    'add_widgets' => false,
                    'add_images' => false
                ])
            );

        if ($element->getRequired()) {
            $editor->addClass('required-entry');
        }
        $element->setData('after_element_html', $editor->getElementHtml());
        $element->setValue('');
        return $element;
    }
}
