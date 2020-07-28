<?php
namespace Vexpro\PontosProduto\Model;

use Vexpro\PontosProduto\Api\CustomerGreetingInterface;
use Magento\Customer\Model\CustomerRegistry;

class CustomerGreeting implements CustomerGreetingInterface
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
    )
   {
       $this->customerRegistry = $customerRegistry;
       $this->productRepository = $productRepository;
       $this->senha = 'kFsrvHwmIMO5ldntjeTurBqYn1btKzbKY5PtZ8h6mdsToE15H6M54MQjyBuIomZx';
   }

   /**
    * Get customer's name by Customer ID and return greeting message.
    *
    * @api
    * @param string $sku
    * @param int $pointsValue
    * @param int $redeemValue
    * @return \Magento\Customer\Api\Data\CustomerInterface
    * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
    * @throws \Magento\Framework\Exception\LocalizedException
    */

   public function sayHello($sku, $pointsValue, $redeemValue)
   {

        //Get Object Manager Instance
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        //Load product by product id
        $cabeca = $objectManager->create('Magento\Framework\App\RequestInterface');

        $autorizacao = $cabeca->getHeader('Authorization');
        $autorizacao = explode(" ", $autorizacao);
        $autorizacao = $autorizacao[1];
        $status = 'success';

        if ($autorizacao == $this->senha){
            $msg = $sku;
            try {
                $product = $this->productRepository->get($sku);
                $product->setCustomAttribute('pontos_produto', $pointsValue);
                $product->setCustomAttribute('pontuacao', $redeemValue);
                $product->save();
            } catch (Exception $e){
                $status = 'error';
                $msg = 'Product not found';
            }
            
        } else {
            $status = 'error';
            $msg = 'authorization';
        }
        
        $response = ['status' => $status, 'message' => $msg];
        $result = json_encode($response, JSON_UNESCAPED_SLASHES);
        return $result;
   }
}