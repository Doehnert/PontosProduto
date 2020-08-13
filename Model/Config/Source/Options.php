<?php
namespace Vexpro\PontosProduto\Model\Config\Source;


class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
    * Get all options
    *
    * @return array
    */
    public function getAllOptions()
    {
        $this->_options = [
                ['label' => __('SAP'), 'value'=>'0'],
                ['label' => __('Magento'), 'value'=>'1'],
                ['label' => __('Outro'), 'value'=>'2']
            ];
 
    return $this->_options;
 
    }
 
}
