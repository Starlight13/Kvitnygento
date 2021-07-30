<?php

namespace Kvitny\Home\Setup\Patch\Data;

use Exception;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class UpdateBlockData implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var BlockFactory
     */
    protected BlockFactory $blockFactory;

    /**
     * UpdateBlockData constructor.
     * @param BlockFactory $blockFactory
     */
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
        $blocks = [
            [
                'title' => 'Instagram images',
                'identifier' => 'instagram_images',
                'content' => '<img src="{{media url=&quot;wysiwyg/instagram1.png&quot;}}" alt="" />
                              <img src="{{media url=&quot;wysiwyg/instagram2.png&quot;}}" alt="" />
                              <img src="{{media url=&quot;wysiwyg/instagram3.png&quot;}}" alt="" />
                              <img src="{{media url=&quot;wysiwyg/instagram4.jpeg&quot;}}" alt="" />',
                'is_active' => 1
            ]
        ];

        foreach ($blocks as $blockData) {
            try {
                $block = $this->blockFactory->create()->load($blockData['identifier'], 'identifier');

                if (!$block->getId()) {
                    $block->setData($blockData)->save();
                } else {
                    $block->setContent($blockData['content'])->save();
                }
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        }
    }

    public function revert()
    {
        return [];
    }
}
