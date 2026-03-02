<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi;

use Spryker\Glue\Kernel\AbstractFactory;
use Spryker\Glue\MerchantProductOffersRestApi\Dependency\Client\MerchantProductOffersRestApiToProductOfferStorageClientInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\CartItem\Expander\CartItemExpander;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\CartItem\Expander\CartItemExpanderInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\CartItem\Mapper\CartItemsAttributesMapper;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\CartItem\Mapper\CartItemsAttributesMapperInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Expander\ProductOfferExpander;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Expander\ProductOfferExpanderInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Expander\QuoteRequestItemExpander;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Expander\QuoteRequestItemExpanderInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Reader\ProductOfferReader;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\Reader\ProductOfferReaderInterface;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\RestResponseBuilder\ProductOfferRestResponseBuilder;
use Spryker\Glue\MerchantProductOffersRestApi\Processor\RestResponseBuilder\ProductOfferRestResponseBuilderInterface;

class MerchantProductOffersRestApiFactory extends AbstractFactory
{
    public function createProductOfferReader(): ProductOfferReaderInterface
    {
        return new ProductOfferReader(
            $this->createProductOfferRestResponseBuilder(),
            $this->getProductOfferStorageClient(),
        );
    }

    public function createProductOfferExpander(): ProductOfferExpanderInterface
    {
        return new ProductOfferExpander($this->createProductOfferReader());
    }

    public function createProductOfferRestResponseBuilder(): ProductOfferRestResponseBuilderInterface
    {
        return new ProductOfferRestResponseBuilder(
            $this->getResourceBuilder(),
        );
    }

    public function createCartItemExpander(): CartItemExpanderInterface
    {
        return new CartItemExpander($this->getProductOfferStorageClient());
    }

    public function createCartItemsAttributesMapper(): CartItemsAttributesMapperInterface
    {
        return new CartItemsAttributesMapper();
    }

    public function getProductOfferStorageClient(): MerchantProductOffersRestApiToProductOfferStorageClientInterface
    {
        return $this->getProvidedDependency(MerchantProductOffersRestApiDependencyProvider::CLIENT_PRODUCT_OFFER_STORAGE);
    }

    public function createQuoteRequestItemExpander(): QuoteRequestItemExpanderInterface
    {
        return new QuoteRequestItemExpander();
    }
}
