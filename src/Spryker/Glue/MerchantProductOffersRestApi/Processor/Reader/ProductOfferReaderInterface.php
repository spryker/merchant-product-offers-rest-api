<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi\Processor\Reader;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductOfferReaderInterface
{
    public function getProductOffer(RestRequestInterface $restRequest): RestResponseInterface;

    public function getProductOffers(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array<array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>>
     */
    public function getProductOfferResourcesByProductConcreteSkus(array $productConcreteSkus): array;
}
