<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\MerchantProductOffersRestApi;

use Codeception\Actor;
use Generated\Shared\DataBuilder\CartItemRequestBuilder;
use Generated\Shared\DataBuilder\ItemBuilder;
use Generated\Shared\Transfer\CartItemRequestTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PersistentCartChangeTransfer;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class MerchantProductOffersRestApiBusinessTester extends Actor
{
    use _generated\MerchantProductOffersRestApiBusinessTesterActions;

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CartItemRequestTransfer
     */
    public function prepareCartItemRequestTransfer(array $seed = []): CartItemRequestTransfer
    {
        return (new CartItemRequestBuilder($seed))->build();
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\PersistentCartChangeTransfer
     */
    public function createPersistentCartChangeTransfer(array $seed = []): PersistentCartChangeTransfer
    {
        return (new PersistentCartChangeTransfer())
            ->fromArray($seed, true);
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function prepareItemTransfer(array $seed = []): ItemTransfer
    {
        return (new ItemBuilder($seed))->build();
    }
}
