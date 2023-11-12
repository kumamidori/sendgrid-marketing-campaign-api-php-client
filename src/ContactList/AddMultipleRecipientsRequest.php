<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\ContactList;

/**
 * @extends \ArrayIterator<int, string>
 */
class AddMultipleRecipientsRequest extends \ArrayIterator
{
    /**
     * @param array<string> $recipientIds
     */
    public function __construct(
        array $recipientIds,
    ) {
        parent::__construct($recipientIds);
    }
}
