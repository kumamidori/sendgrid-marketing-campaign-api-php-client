<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Recipients;

readonly class CreateRecipientsResponse
{
    public function __construct(
        public int $errorCount,
        public array $errorIndices,
        public array $unmodifiedIndices,
        public int $newCount,
        public array $persistedRecipients,
        public int $updatedCount,
    ) {
    }
}