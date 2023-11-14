<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

use Linkage\SendgridMarketingCampaignApiClient\Campaign\CreateCampaignRequest;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\CreateCampaignResponse;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\ScheduleCampaignRequest;
use Linkage\SendgridMarketingCampaignApiClient\Campaign\ScheduleCampaignResponse;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\AddMultipleRecipientsRequest;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\AddMultipleRecipientsResponse;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListRequest;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListResponse;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsRequest;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponse;

interface ClientInterface
{
    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/contactdb.html#Create-a-List-POST
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createContactList(CreateContactListRequest $request): CreateContactListResponse;

    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/contactdb.html#Add-Multiple-Recipients-POST
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createRecipients(CreateRecipientsRequest $request): CreateRecipientsResponse;

    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/contactdb.html#Add-Multiple-Recipients-to-a-List-POST
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function addMultipleRecipientsToContactList(int $listId, AddMultipleRecipientsRequest $request): AddMultipleRecipientsResponse;

    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/campaigns.html#Create-a-Campaign-POST
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function createCampaign(CreateCampaignRequest $request): CreateCampaignResponse;

    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/campaigns.html#Send-a-Campaign-POST
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function scheduleCampaign(int $campaignId, ScheduleCampaignRequest $request): ScheduleCampaignResponse;
}
