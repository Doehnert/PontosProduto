<?php

namespace Vexpro\PontosProduto\Model;

use Vexpro\PontosProduto\Api\ProductPointsInterface;
use Magento\Customer\Model\CustomerRegistry;

class ProductPoints implements ProductPointsInterface
{
    /**
     * @var CustomerRegistry
     */

    private $productRepository;
    protected $customerRegistry;
    protected $senha;

    public function __construct(
        CustomerRegistry $customerRegistry,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->customerRegistry = $customerRegistry;
        $this->productRepository = $productRepository;
        $this->senha = 'kFsrvHwmIMO5ldntjeTurBqYn1btKzbKY5PtZ8h6mdsToE15H6M54MQjyBuIomZx';
    }

    /**
     * Set the product pontos_valor and pontuacao
     *
     * @api
     * @param string $sku
     * @param int $pointsValue
     * @param int $redeemValue
     * @return string $response
     * @throws Magento\Framework\Exception\AuthorizationException If not authorized
     * @throws \Magento\Framework\Exception\NoSuchEntityException If product dont exist
     */

    public function changePoints($sku, $pointsValue, $redeemValue)
    {

        //Get Object Manager Instance
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        //Load product by product id
        $cabeca = $objectManager->create('Magento\Framework\App\RequestInterface');

        $autorizacao = $cabeca->getHeader('Authorization');
        $autorizacao = explode(" ", $autorizacao);
        $autorizacao = $autorizacao[1];
        $status = 'success';

        if ($autorizacao != $this->senha) {
            throw new \Magento\Framework\Exception\AuthorizationException(
                __(\Magento\Framework\Exception\AuthorizationException::NOT_AUTHORIZED)
            );
        }

        $msg = $sku;
        try {
            $product = $this->productRepository->get($sku);
            $product->setCustomAttribute('pontos_produto', $redeemValue);
            $product->setCustomAttribute('pontuacao', $pointsValue);
            $product->save();
        } catch (Exception $e) {
            return;
        }

        $response = ['status' => $status, 'message' => $msg];
        $result = json_encode($response, JSON_UNESCAPED_SLASHES);
        return $result;
    }
}
