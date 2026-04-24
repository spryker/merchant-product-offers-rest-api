<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\MerchantProductOffersRestApi\Api\Storefront\Provider;

use Generated\Api\Storefront\ProductOffersStorefrontResource;
use Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferStorageTransfer;
use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface;
use Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ProductOffersStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string URI_VAR_OFFER_REFERENCE = 'productOfferReference';

    public function __construct(
        protected ProductOfferStorageClientInterface $productOfferStorageClient,
    ) {
    }

    protected function provideCollection(): array
    {
        $this->throwMissingOfferReference();
    }

    protected function provideItem(): ?object
    {
        $productOfferReference = $this->resolveOfferReference();

        $productOfferStorageTransfer = $this->productOfferStorageClient
            ->findProductOfferStorageByReference($productOfferReference);

        if ($productOfferStorageTransfer === null) {
            $this->throwOfferNotFound();
        }

        $defaultOfferReference = $this->findDefaultOfferReference($productOfferStorageTransfer);

        if ($defaultOfferReference === null) {
            $this->throwOfferNotFound();
        }

        return $this->mapToResource($productOfferStorageTransfer, $defaultOfferReference);
    }

    protected function resolveOfferReference(): string
    {
        if (!$this->hasUriVariable(static::URI_VAR_OFFER_REFERENCE)) {
            $this->throwMissingOfferReference();
        }

        $productOfferReference = (string)$this->getUriVariable(static::URI_VAR_OFFER_REFERENCE);

        if ($productOfferReference === '') {
            $this->throwMissingOfferReference();
        }

        return $productOfferReference;
    }

    protected function findDefaultOfferReference(ProductOfferStorageTransfer $productOfferStorageTransfer): ?string
    {
        $productConcreteSku = $productOfferStorageTransfer->getProductConcreteSku();

        if ($productConcreteSku === null || $productConcreteSku === '') {
            return null;
        }

        return $this->productOfferStorageClient->findProductConcreteDefaultProductOffer(
            (new ProductOfferStorageCriteriaTransfer())->addProductConcreteSku($productConcreteSku),
        );
    }

    protected function mapToResource(
        ProductOfferStorageTransfer $productOfferStorageTransfer,
        string $defaultOfferReference
    ): ProductOffersStorefrontResource {
        $resource = new ProductOffersStorefrontResource();
        $resource->productOfferReference = $productOfferStorageTransfer->getProductOfferReference();
        $resource->merchantSku = $productOfferStorageTransfer->getMerchantSku();
        $resource->merchantReference = $productOfferStorageTransfer->getMerchantReference();
        $resource->isDefault = $defaultOfferReference === $productOfferStorageTransfer->getProductOfferReference();

        return $resource;
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     *
     * @return never
     */
    protected function throwMissingOfferReference(): void
    {
        throw new GlueApiException(
            Response::HTTP_BAD_REQUEST,
            MerchantProductOffersRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_ID_IS_NOT_SPECIFIED,
            MerchantProductOffersRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_ID_SKU_IS_NOT_SPECIFIED,
        );
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     *
     * @return never
     */
    protected function throwOfferNotFound(): void
    {
        throw new GlueApiException(
            Response::HTTP_NOT_FOUND,
            MerchantProductOffersRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_NOT_FOUND,
            MerchantProductOffersRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_NOT_FOUND,
        );
    }
}
