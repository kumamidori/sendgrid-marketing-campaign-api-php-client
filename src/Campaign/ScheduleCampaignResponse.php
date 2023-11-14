<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Campaign;

readonly class ScheduleCampaignResponse
{
    public function __construct(
        public int $id,
        public int $sendAt,
        public string $status,
    ) {
    }
}
