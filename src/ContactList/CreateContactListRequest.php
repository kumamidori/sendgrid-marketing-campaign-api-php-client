<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\ContactList;

readonly class CreateContactListRequest
{
    public function __construct(
        public string $name,
    ) {
    }
}