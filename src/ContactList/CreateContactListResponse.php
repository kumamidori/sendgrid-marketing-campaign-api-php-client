<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\ContactList;

readonly class CreateContactListResponse
{
    public function __construct(
        public int $id,
        public string $name,
        public int $recipientCount,
    ) {
    }
}