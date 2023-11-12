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

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createRecipients(Recipients\CreateRecipientsRequest $request): Recipients\CreateRecipientsResponse
    {
        return $this->requester->post(
            '/contactdb/recipients',
            $request,
            Recipients\CreateRecipientsResponse::class,
        );
    }
}
