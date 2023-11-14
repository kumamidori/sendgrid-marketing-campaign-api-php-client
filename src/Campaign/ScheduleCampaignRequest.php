<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Campaign;

readonly class ScheduleCampaignRequest
{
    // timestamp
    public int $sendAt;

    public function __construct(
        \DateTimeImmutable $shouldSendAt,
    ) {
        $this->sendAt = $shouldSendAt->getTimestamp();
    }
}
