<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

interface ClientInterface
{
    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/contactdb.html#Create-a-List-POST
     */
    public function createContactList(ContactList\CreateContactListRequest $request): ContactList\CreateContactListResponse;

    /**
     * @see https://sendgrid.kke.co.jp/docs/API_Reference/Web_API_v3/Marketing_Campaigns/contactdb.html#Add-Multiple-Recipients-POST
     */
    public function createRecipients(Recipients\CreateRecipientsRequest $request): Recipients\CreateRecipientsResponse;
}
