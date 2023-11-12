<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Campaign;

readonly class SendCampaignResponse
{
    public function __construct(
        public int $id,
        public string $status,
    ) {
    }
}
