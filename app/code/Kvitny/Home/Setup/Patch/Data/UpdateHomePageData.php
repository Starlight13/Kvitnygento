<?php


namespace Kvitny\Home\Setup\Patch\Data;


use Exception;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class UpdateHomePageData implements DataPatchInterface, PatchRevertableInterface
{

    const PAGE_IDENTIFIER = 'home';

    protected ModuleDataSetupInterface $moduleDataSetup;
    protected PageFactory $pageFactory;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup, PageFactory $pageFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    /**
     * @throws Exception
     */
    public function apply()
    {
        $pageData = [
            'title' => 'Home page',
            'page_layout' => '1column',
            'meta_keywords' => null,
            'meta_description' => null,
            'identifier' => self::PAGE_IDENTIFIER,
            'content_heading' => null,
            'content' => '{{widget type="Kvitny\Banner\Block\Widget\Banner" banner_title="Quick delivery to any place" banner_subtitle="We will make every effort, so that the flower ordering and delivery takes minimum time and brings you maximum joy" has-order-button="true" banner_image="wysiwyg/baner.png"}}',
            'layout_update_xml' => '<!--
    <referenceContainer name="right">
    <referenceBlock name="catalog.compare.sidebar" remove="true" />
    </referenceContainer>-->',
            'url_key' => 'home',
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->moduleDataSetup->startSetup();
        try {
            $page = $this->pageFactory->create()->load($pageData['identifier'], 'identifier');
            if (!$page->getIdentifier()) {
                $page->setData($pageData)->save();
            } else {
                $page->setContent($pageData['content']);
                $page->save();
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        $this->moduleDataSetup->endSetup();

    }

    /**
     * @throws Exception
     */
    public function revert()
    {
        $this->moduleDataSetup->startSetup();
        try {
            $page = $this->pageFactory->create()->load(self::PAGE_IDENTIFIER,'identifier');
            if ($page->getIdentifier()) {
                $page->setContent(null);
                $page->save();
            }
        }
        catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [
            UpdateBlockData::class
        ];
    }
}
