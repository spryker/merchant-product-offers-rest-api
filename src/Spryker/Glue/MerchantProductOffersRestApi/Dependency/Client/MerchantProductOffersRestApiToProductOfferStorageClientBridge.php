<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi\Dependency\Client;

use Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferStorageTransfer;

class MerchantProductOffersRestApiToProductOfferStorageClientBridge implements MerchantProductOffersRestApiToProductOfferStorageClientInterface
{
    /**
     * @var \Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface
     */
    protected $productOfferStorageClient;

    /**
     * @param \Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface $productOfferStorageClient
     */
    public function __construct($productOfferStorageClient)
    {
        $this->productOfferStorageClient = $productOfferStorageClient;
    }

    public function getProductOfferStoragesBySkus(
        ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer
    ): ProductOfferStorageCollectionTransfer {
        return $this->productOfferStorageClient->getProductOfferStoragesBySkus($productOfferStorageCriteriaTransfer);
    }

    public function findProductConcreteDefaultProductOffer(ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer): ?string
    {
        return $this->productOfferStorageClient->findProductConcreteDefaultProductOffer($productOfferStorageCriteriaTransfer);
    }

    public function findProductOfferStorageByReference(string $productOfferReference): ?ProductOfferStorageTransfer
    {
        return $this->productOfferStorageClient->findProductOfferStorageByReference($productOfferReference);
    }
}
