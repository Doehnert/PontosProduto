<?php

namespace Vexpro\PontosProduto\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;

class InstallSchema implements InstallSchemaInterface
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'pontos_produto',
            [
                'group' => 'General',
                'type' => 'int',
                'default' => 0,
                'backend' => '',
                'frontend' => '',
                'label' => 'Parametrização de resgate',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
                'visible'                   => true,
                'is_html_allowed_on_front'  => true,
                'visible_on_front'          => true
            ]
        );

        // fator de conversão entre os pontos e o valor em dinheiro, cada pontuacao vale quanto em dinheiro
        $eavSetup->addAttribute(
            Product::ENTITY,
            'pontuacao',
            [
                'group'         => 'General',
                'type' => 'int',
                'default' => 0,
                'backend' => '',
                'frontend' => '',
                'label' => 'Parametrização de pontos',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
                'visible'                   => true,
                'is_html_allowed_on_front'  => true,
                'visible_on_front'          => true
            ]
        );

        // mostrar a pontuacao sim ou nao
        $eavSetup->addAttribute(
            Product::ENTITY,
            'mostrar_pontuacao',
            [
                'group'         => 'General',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Mostrar parametrização de pontos',
                'input' => 'boolean',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
                'visible'                   => true,
                'is_html_allowed_on_front'  => true,
                'visible_on_front'          => true
            ]
        );

        // informa origem dos produtos
        $eavSetup->addAttribute(
            Product::ENTITY,
            'origem',
            [
                'group' => 'General',
                'type' => 'int',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'frontend' => '',
                'label' => 'origem sap?',
                'default' => false,
                'input' => 'boolean',
                'class' => 'origem',
                'source' => 'Vexpro\PontosProduto\Model\YesNo',
                // 'source' => 'Vexpro\PontosProduto\Model\Config\Source\Options',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => true,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
                'visible'                   => true,
                'is_html_allowed_on_front'  => true,
                'visible_on_front'          => true
            ]
        );

        $installer->endSetup();
    }
}
