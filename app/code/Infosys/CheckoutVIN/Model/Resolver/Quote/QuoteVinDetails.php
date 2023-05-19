<?php

/**
 * @package     Infosys/CheckoutVIN
 * @version     1.0.0
 * @author      Infosys Limited
 * @copyright   Copyright © 2021. All Rights Reserved.
 */

namespace Infosys\CheckoutVIN\Model\Resolver\Quote;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use \Magento\Framework\Serialize\Serializer\Json;

/**
 * Class to update vin details in the cart query response
 */
class QuoteVinDetails implements ResolverInterface
{
    /**
     * @var Json
     */
    protected $json;

    /**
     * Constructor function
     *
     * @param Json $json
     */
    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    /**
     * Get quote item attribute value
     *
     * @param object $field
     * @param object $context
     * @param object $info
     * @param array $value
     * @param array $args
     * @return array
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $quote =  $value['model'];
        if ($quote) {
            $vin_details = $quote->getData($field->getName());
            if ($vin_details) {
                return $this->getJsonDecode($vin_details);
            }
        }
    }

     /**
      * Json data
      *
      * @param array $response
      * @return array
      */
    public function getJsonDecode($response)
    {
        return $this->json->unserialize($response); // it's same as like json_decode
    }
}
