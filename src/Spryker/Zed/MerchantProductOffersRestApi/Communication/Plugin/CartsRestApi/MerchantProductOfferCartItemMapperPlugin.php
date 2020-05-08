<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOffersRestApi\Communication\Plugin\CartsRestApi;

use Generated\Shared\Transfer\CartItemRequestTransfer;
use Generated\Shared\Transfer\PersistentCartChangeTransfer;
use Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\CartItemMapperPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\MerchantProductOffersRestApi\Business\MerchantProductOffersRestApiFacadeInterface getFacade()
 * @method \Spryker\Zed\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig getConfig()
 */
class MerchantProductOfferCartItemMapperPlugin extends AbstractPlugin implements CartItemMapperPluginInterface
{
    /**
     * {@inheritDoc}
     * - Maps CartItemRequestTransfer::$productOptionValues to PersistentCartChangeTransfer::$productOptions.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartItemRequestTransfer $cartItemRequestTransfer
     * @param \Generated\Shared\Transfer\PersistentCartChangeTransfer $persistentCartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\PersistentCartChangeTransfer
     */
    public function mapCartItemRequestTransferToPersistentCartChangeTransfer(
        CartItemRequestTransfer $cartItemRequestTransfer,
        PersistentCartChangeTransfer $persistentCartChangeTransfer
    ): PersistentCartChangeTransfer {
        foreach ($persistentCartChangeTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getSku() !== $cartItemRequestTransfer->getSku()) {
                continue;
            }

            $itemTransfer->setProductOfferReference($cartItemRequestTransfer->getProductOfferReference());
            $itemTransfer->setMerchantReference($cartItemRequestTransfer->getMerchantReference());

            break;
        }

        return $persistentCartChangeTransfer;
    }
}
