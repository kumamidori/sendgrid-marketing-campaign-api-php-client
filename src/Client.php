<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

use Linkage\SendgridMarketingCampaignApiClient\Campaign\CreateCampaignRequest;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\CreateCampaignResponse;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\SendCampaignRequest;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\SendCampaignResponse;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\AddMultipleRecipientsRequest;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\AddMultipleRecipientsResponse;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListRequest;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListResponse;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsRequest;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponse;

readonly class Client implements ClientInterface
{
    public function __construct(
        private SendgridApiRequester $requester,
    ) {
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createContactList(
        CreateContactListRequest $request,
    ): CreateContactListResponse {
        return $this->requester->post(
            '/contactdb/lists',
            $request,
            CreateContactListResponse::class,
        );
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createRecipients(CreateRecipientsRequest $request): CreateRecipientsResponse
    {
        return $this->requester->post(
            '/contactdb/recipients',
            $request,
            CreateRecipientsResponse::class,
        );
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function addMultipleRecipientsToContactList(
        int $listId,
        AddMultipleRecipientsRequest $request,
    ): AddMultipleRecipientsResponse {
        return $this->requester->post(
            sprintf('/contactdb/lists/%d/recipients', $listId),
            $request,
            AddMultipleRecipientsResponse::class,
        );
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createCampaign(CreateCampaignRequest $request): CreateCampaignResponse
    {
        return $this->requester->post(
            '/campaigns',
            $request,
            CreateCampaignResponse::class,
        );
    }

    /**
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function sendCampaign(int $campaignId, SendCampaignRequest $request): SendCampaignResponse
    {
        return $this->requester->post(
            sprintf('/campaigns/%d/schedules/now', $campaignId),
            $request,
            SendCampaignResponse::class,
        );
    }
}
