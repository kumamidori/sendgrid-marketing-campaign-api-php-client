<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Recipients;

class CreateRecipientsResponseError
{
    public function __construct(
        public string $message,
        /** @var array<int> $errorIndices */
        public array $errorIndices,
    ) {
    }
}
