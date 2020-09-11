<?php

namespace Vexpro\PontosProduto\Observer;

class CatalogProductSaveBeforeObserver implements \Magento\Framework\Event\ObserverInterface
{
    // This event is dispatched only when creating or editing in the admin area
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();

        $origem = $product->getOrigem();
        if ($origem == 1) {
            $product->lockAttribute('sku');
        }
    }
}
