<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi\Dependency\Client;

use Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferStorageTransfer;

interface MerchantProductOffersRestApiToProductOfferStorageClientInterface
{
    public function getProductOfferStoragesBySkus(
        ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer
    ): ProductOfferStorageCollectionTransfer;

    public function findProductConcreteDefaultProductOffer(ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer): ?string;

    public function findProductOfferStorageByReference(string $productOfferReference): ?ProductOfferStorageTransfer;
}
