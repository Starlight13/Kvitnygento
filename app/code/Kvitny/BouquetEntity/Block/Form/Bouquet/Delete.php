<?php

namespace Kvitny\BouquetEntity\Block\Form\Bouquet;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            'Delete',
            'delete',
            'deleteConfirm(\''
            . __('Are you sure you want to delete this bouquet?')
            . '\', \'' . $this->getUrl('*/*/delete', ['bouquet_id' => $this->getBouquetId()]) . '\')',
            [],
            20
        );
    }
}
