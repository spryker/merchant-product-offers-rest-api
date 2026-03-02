<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferStorageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface ProductOfferRestResponseBuilderInterface
{
    public function createProductOfferEmptyRestResponse(): RestResponseInterface;

    /**
     * @param array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface> $productOfferRestResources
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createProductOfferCollectionRestResponse(
        array $productOfferRestResources
    ): RestResponseInterface;

    public function createProductOfferRestResponse(
        ProductOfferStorageTransfer $productOfferStorageTransfer,
        string $defaultMerchantProductOfferReference
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer $productOfferStorageCollectionTransfer
     *
     * @return array<array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>>
     */
    public function createProductOfferRestResources(ProductOfferStorageCollectionTransfer $productOfferStorageCollectionTransfer): array;

    public function createProductConcreteSkuNotSpecifiedErrorResponse(): RestResponseInterface;

    public function createProductOfferIdNotSpecifiedErrorResponse(): RestResponseInterface;

    public function createProductOfferNotFoundErrorResponse(): RestResponseInterface;
}
