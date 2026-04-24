<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\MerchantProductOffersRestApi\Api\Storefront\Provider;

use Generated\Api\Storefront\ConcreteProductsProductOffersStorefrontResource;
use Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferStorageTransfer;
use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface;
use Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ConcreteProductsProductOffersStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string URI_VAR_SKU = 'sku';

    public function __construct(
        protected ProductOfferStorageClientInterface $productOfferStorageClient,
    ) {
    }

    /**
     * @return array<\Generated\Api\Storefront\ConcreteProductsProductOffersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        $sku = $this->resolveConcreteProductSku();

        $productOfferStorageCollectionTransfer = $this->productOfferStorageClient->getProductOfferStoragesBySkus(
            (new ProductOfferStorageCriteriaTransfer())->setProductConcreteSkus([$sku]),
        );

        $resources = [];
        foreach ($productOfferStorageCollectionTransfer->getProductOffers() as $productOffer) {
            $resources[] = $this->mapOfferToResource($productOffer);
        }

        return $resources;
    }

    protected function resolveConcreteProductSku(): string
    {
        if (!$this->hasUriVariable(static::URI_VAR_SKU)) {
            $this->throwMissingConcreteProductSku();
        }

        $sku = (string)$this->getUriVariable(static::URI_VAR_SKU);

        if ($sku === '') {
            $this->throwMissingConcreteProductSku();
        }

        return $sku;
    }

    protected function throwMissingConcreteProductSku(): never
    {
        throw new GlueApiException(
            Response::HTTP_BAD_REQUEST,
            MerchantProductOffersRestApiConfig::RESPONSE_CODE_CONCRETE_PRODUCT_SKU_IS_NOT_SPECIFIED,
            MerchantProductOffersRestApiConfig::RESPONSE_DETAIL_CONCRETE_PRODUCT_SKU_IS_NOT_SPECIFIED,
        );
    }

    protected function mapOfferToResource(ProductOfferStorageTransfer $productOffer): ConcreteProductsProductOffersStorefrontResource
    {
        $resource = new ConcreteProductsProductOffersStorefrontResource();
        $resource->productOfferReference = $productOffer->getProductOfferReference();
        $resource->merchantSku = $productOffer->getMerchantSku();
        $resource->merchantReference = $productOffer->getMerchantReference();
        $resource->isDefault = (bool)$productOffer->getIsDefault();

        return $resource;
    }
}
