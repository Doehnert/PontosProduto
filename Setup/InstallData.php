<?php
namespace Vexpro\PontosProduto\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use \Magento\Catalog\Model\Product;
use \Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;    

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;        
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'pontos_produto',
            [
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

        // fator de conversão entre os pontos e o valor em dinheiro, cada pontuacao vale quanto em dinheiro
        $eavSetup->addAttribute(
            Product::ENTITY,
            'pontuacao',
            [
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

        // mostrar a pontuacao sim ou nao
        $eavSetup->addAttribute(
            Product::ENTITY,
            'mostrar_pontuacao',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'mostrar_pontuacao',
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

        $setup->endSetup();

    }
}