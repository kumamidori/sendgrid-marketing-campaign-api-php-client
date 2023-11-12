<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

readonly class Client implements ClientInterface
{
    public function __construct(
        private HttpRequester $requester,
    ) {
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createContactList(
        ContactList\CreateContactListRequest $request,
    ): ContactList\CreateContactListResponse {
        return $this->requester->post(
            '/contactdb/lists',
            $request,
            ContactList\CreateContactListResponse::class,
        );
    }
}
