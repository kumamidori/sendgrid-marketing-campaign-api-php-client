<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Campaign;

readonly class CreateCampaignResponse
{
    /**
     * @param array<int> $listIds
     * @param array<int> $segmentIds
     * @param array<string> $categories
     */
    public function __construct(
        public int $id,
        public string $status,
        public string $editor,
        public string $title,
        public string $subject,
        public int $senderId,
        public int $suppressionGroupId,
        public string|null $htmlContent = null,
        public string|null $plainContent = null,
        public string $customUnsubscribeUrl = '',
        public array $listIds = [],
        public array $segmentIds = [],
        public array $categories = [],
        public string|null $ipPool = null,
    ) {
    }
}
