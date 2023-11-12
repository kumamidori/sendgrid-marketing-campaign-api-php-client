<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Recipients;

readonly class RecipientRequest
{
    public function __construct(
        public string $email,
    ) {
    }
}