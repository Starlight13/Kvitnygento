<?php


namespace Kvitny\Catalog\Plugin\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav as EavModifier;

class Eav
{
    /**
     * Set 'add_widgets' to true for the description attribute in order to display the "Insert Widget..." button
     *
     * @param EavModifier $subject
     * @param EavModifier $result
     * @return EavModifier
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSetupAttributeMeta(
        EavModifier $subject,
        $result
    )
    {
        if (isset($result['arguments']['data']['config']['code']) &&
            $result['arguments']['data']['config']['code'] == 'custom_content') {
            $result['arguments']['data']['config']['wysiwygConfigData'] = [
                'add_variables' => false,
                'add_widgets' => true,
                'add_directives' => true,
                'use_container' => true,
                'container_class' => 'hor-scroll'
            ];
        }

        return $result;
    }
}
