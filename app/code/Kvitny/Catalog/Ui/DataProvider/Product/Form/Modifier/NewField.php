<?php


namespace Kvitny\Catalog\Ui\DataProvider\Product\Form\Modifier;


use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Catalog\Model\ProductFactory;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Wysiwyg;

class NewField extends AbstractModifier
{

    private LocatorInterface $locator;
    private ProductFactory $productFactory;

    public function __construct(
        LocatorInterface $locator,
        ProductFactory $productFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->locator = $locator;
    }

    public function modifyData(array $data)
    {
        $productId = $this->locator->getProduct()->getId();

        $product = $this->productFactory->create()->load($productId);

        $data = array_replace_recursive(

            $data,

            [

                $product->getId() => [

                    'product' => [

                        'my_content' => '<p>hello</p>'

                    ]

                ]

            ]

        );

        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_content' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Custom Content'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.custom_content',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
                        'custom_content' => $this->getCustomField()
                    ],
                ]
            ]
        );

        return $meta;
    }

    public function getCustomField()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom content'),
                        'componentType' => Field::NAME,
                        'formElement' => Wysiwyg::NAME,
                        'dataScope' => 'my_content',
                        'dataType' => Text::NAME,
                        'sortOrder' => 10,
                    ],
                ],
            ],
        ];
    }
}
