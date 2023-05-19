<?php
/**
 * @package     Infosys/DealerSavings
 * @version     1.0.0
 * @author      Infosys Limited
 * @copyright   Copyright © 2021. All Rights Reserved.
 */

namespace Infosys\DealerSavings\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * @inheritdoc
 */
class CartDealerSavings implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $cart = $value["model"];
        $totalSavings = 0;
        foreach ($cart->getAllItems() as $item) {
            $productOrignalPrice = $item->getProduct()->getPrice();
            $discountedprice = $item->getPrice();
            $itemsaving = $productOrignalPrice - $discountedprice;
            if ($itemsaving > 0) {
                $totalSavings += $itemsaving * $item->getQty();
            }
        }
        $subtotalWithoutDiscount = $cart->getBaseSubtotal() + $totalSavings;
        $dealerSavings = [
            'subtotal_excluding_dealer_discount' => $subtotalWithoutDiscount,
            'dealer_discount'   => $totalSavings
        ];
        return $dealerSavings;
    }
}
