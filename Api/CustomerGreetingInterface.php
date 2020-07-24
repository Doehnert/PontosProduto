<?php
namespace Vexpro\PontosProduto\Api;

interface CustomerGreetingInterface
{
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
   public function sayHello($sku, $pointsValue, $redeemValue);

}