<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\MerchantProductOffersRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\MerchantProductOffersRestApi\Dependency\Client\MerchantProductOffersRestApiToProductOfferStorageClientBridge;

/**
 * @method \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig getConfig()
 */
class MerchantProductOffersRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PRODUCT_OFFER_STORAGE = 'CLIENT_PRODUCT_OFFER_STORAGE';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addProductOfferStorageClient($container);

        return $container;
    }

    protected function addProductOfferStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_OFFER_STORAGE, function (Container $container) {
            return new MerchantProductOffersRestApiToProductOfferStorageClientBridge(
                $container->getLocator()->productOfferStorage()->client(),
            );
        });

        return $container;
    }
}
