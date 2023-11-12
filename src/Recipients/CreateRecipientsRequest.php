<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Recipients;

/**
 * @extends \ArrayIterator<int, RecipientRequest>
 */
class CreateRecipientsRequest extends \ArrayIterator
{
    /**
     * @param array<RecipientRequest> $emails
     */
    public function __construct(
        array $emails,
    ) {
        parent::__construct($emails);
    }
}
