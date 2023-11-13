<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Campaign;

readonly class CreateCampaignRequest
{
    /**
     * @param null|array<int>    $listIds
     * @param null|array<int>    $segmentIds
     * @param null|array<string> $categories
     */
    public function __construct(
        public string $title,
        public string $subject,
        public int $senderId,
        public int $suppressionGroupId,
        public string|null $htmlContent = null,
        public string|null $plainContent = null,
        public string|null $customUnsubscribeUrl = null,
        public array|null $listIds = null,
        public array|null $segmentIds = null,
        public array|null $categories = null,
        public string|null $ipPool = null,
    ) {
    }
}
