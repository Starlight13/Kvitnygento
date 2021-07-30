<?php

namespace Kvitny\Home\Setup\Patch\Data;

use Exception;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Indexer\Model\IndexerFactory;
use Magento\Theme\Model\ResourceModel\Theme\CollectionFactory;

/**
 * Class UpdateDefaultThemeData
 * @package Kvitny\Home\Setup\Patch\Data
 */
class UpdateDefaultThemeData implements DataPatchInterface, PatchRevertableInterface
{
    const THEME_NAME = 'Kvitny/simple';

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var IndexerFactory
     */
    protected IndexerFactory $indexerFactory;

    /**
     * @var WriterInterface
     */
    protected WriterInterface $writer;


    /**
     * UpdateDefaultThemeData constructor.
     * @param WriterInterface $writer
     * @param CollectionFactory $collectionFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param IndexerFactory $indexerFactory
     */
    public function __construct(
        WriterInterface $writer,
        CollectionFactory $collectionFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        IndexerFactory $indexerFactory
    ) {
        $this->writer = $writer;
        $this->collectionFactory = $collectionFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->indexerFactory = $indexerFactory;
    }

    /**
     * @throws Exception
     */
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
        catch (Exception $exception) {
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
            $themes = $this->collectionFactory->create()->loadRegisteredThemes();

            foreach ($themes as $theme) {
                if ($theme->getCode() == 'Magento/luma') {
                    $this->writer->save('design/theme/theme_id', $theme->getId());
                    $indexer = $this->indexerFactory->create()->load('design_config_grid');
                    $indexer->reindexAll($indexer);
                }
            }
        }
        catch (Exception $exception) {
            throw new Exception($exception->getMessage());
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
