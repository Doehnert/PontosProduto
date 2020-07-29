<?php
namespace Vexpro\PontosProduto\Api;

interface ProductPointsInterface
{
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
   public function changePoints($sku, $pointsValue, $redeemValue);

}