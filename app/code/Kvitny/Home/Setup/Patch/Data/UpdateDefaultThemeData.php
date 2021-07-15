<?php


namespace Kvitny\Home\Setup\Patch\Data;


use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Theme\Model\ResourceModel\Theme\CollectionFactory;
use Magento\Indexer\Model\IndexerFactory;

class UpdateDefaultThemeData implements DataPatchInterface, PatchRevertableInterface
{
    const THEME_NAME = 'Kvitny/simple';

    private CollectionFactory $collectionFactory;
    protected ModuleDataSetupInterface $moduleDataSetup;
    protected IndexerFactory $indexerFactory;
    protected WriterInterface $writer;


    public function __construct(WriterInterface $writer, CollectionFactory $collectionFactory, ModuleDataSetupInterface $moduleDataSetup, IndexerFactory $indexerFactory)
    {
        $this->writer = $writer;
        $this->collectionFactory = $collectionFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->indexerFactory = $indexerFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $themes = $this->collectionFactory->create()->loadRegisteredThemes();

            foreach ($themes as $theme) {
                if ($theme->getCode() == self::THEME_NAME) {
                    $this->writer->save('design/theme/theme_id', $theme->getId());
                    $indexer = $this->indexerFactory->create()->load('design_config_grid');
                    $indexer->reindexAll($indexer);
                }
            }
        }
        catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        $this->moduleDataSetup->endSetup();
    }

    public function revert()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $themes = $this->collectionFactory->create()->loadRegisteredThemes();

            foreach ($themes as $theme) {
                if ($theme->getCode() == 'Magento/luma') {
                    $this->writer->save('design/theme/theme_id', $theme->getId());
                    $indexer = $this->indexerFactory->create()->load('design_config_grid');
                    $indexer->reindexAll($indexer);
                }
            }
        }
        catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
