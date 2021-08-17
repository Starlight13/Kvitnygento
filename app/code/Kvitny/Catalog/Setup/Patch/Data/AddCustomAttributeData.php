<?php


namespace Kvitny\Catalog\Setup\Patch\Data;


use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddCustomAttributeData implements DataPatchInterface, PatchRevertableInterface
{
    const ATTRIBUTE_CODE = 'custom_content';

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @var EavConfig
     */
    private EavConfig $eavConfig;

    /**
     * AddCustomAttributeData constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param EavConfig $eavConfig
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        EavConfig $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return AddCustomAttributeData|void
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        if (!$this->isProductAttributeExists(self::ATTRIBUTE_CODE)) {
            $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE, [
                'type' => 'text',
                'label' => 'Custom content',
                'input' => 'textarea',
                'used_in_product_listing' => true,
                'user_defined' => true,
                'source' => null,
                'frontend' => '',
                'required' => false,
                'backend' => '',
                'sort_order' => '30',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default' => null,
                'visible' => true,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => 'simple,grouped,bundle,configurable,virtual',
                'group' => 'General',
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'option' => ''
            ]);
        }
    }

    /**
     * @return array
     */
    public function revert()
    {
        return [];
    }

    /**
     * @param $attr_code
     * @return mixed
     * @throws LocalizedException
     */
    public function isProductAttributeExists($attr_code)
    {
        $attr = $this->eavConfig->getAttribute(Product::ENTITY, $attr_code);
        return $attr->getId();
    }
}
