<?php
/**
 * @package     Infosys/ProductSaleable
 * @version     1.0.0
 * @author      Infosys Limited
 * @copyright   Copyright © 2021. All Rights Reserved.
 */
declare(strict_types=1);

namespace Infosys\ProductSaleable\Publisher;

use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * Class AapProductStatus
 */
class AapProductStatus
{

    public const TOPIC_NAME = "magento.aap-product.status";

    /**
     * @var PublisherInterface
     */
    private PublisherInterface $publisher;

    /**
     * Publisher for update *product status based on config setting
     *
     * @param PublisherInterface $publisher
     */
    public function __construct(
        PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     *
     * @param mixed $data
     * @return bool
     */
    public function publish($data): bool
    {
        $this->publisher->publish(self::TOPIC_NAME, $data);
        return true;
    }
}
