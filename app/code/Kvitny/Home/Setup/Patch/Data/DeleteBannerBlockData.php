<?php


namespace Kvitny\Home\Setup\Patch\Data;


use Exception;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class DeleteBannerBlockData implements DataPatchInterface, PatchRevertableInterface
{
    protected BlockFactory $blockFactory;

    public function __construct(BlockFactory $blockFactory)
    {
        $this->blockFactory = $blockFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    /**
     * @throws Exception
     */
    public function apply()
    {
        try {
            $block = $this->blockFactory->create()->load('home_page_banner', 'identifier');

            if (!$block->getId()) {
                $block->delete();
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function revert()
    {
        return [];
    }
}
