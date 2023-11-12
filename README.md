# simple php client for sendgrid marketing campaign apis

## installation

```shell
composer require linkage/sendgrid-marketing-campaign-api-client
```

## usage

```php

$apiKey = 'get your api key from sendgrid admin screen';

$sendgridClient = new \Linkage\SendgridMarketingCampaignApiClient\Client(
    new \Linkage\SendgridMarketingCampaignApiClient\SendgridApiRequester($apiKey),
);
try {
    $sendgridClient->createContactList(
        new \Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListRequest('my new contact list'),
    );
} catch (\Linkage\SendgridMarketingCampaignApiClient\SendgridApiClientException $e) {
    // handle client error
} catch (\Linkage\SendgridMarketingCampaignApiClient\SendgridApiServerException $e) {
    // handle server error
}
```
