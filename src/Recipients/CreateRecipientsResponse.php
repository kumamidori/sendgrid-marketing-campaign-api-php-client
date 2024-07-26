<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Recipients;

class CreateRecipientsResponse
{
    /**
     * @param array<int>    $errorIndices
     * @param array<int>    $unmodifiedIndices
     * @param array<string> $persistedRecipients
     * @param array<CreateRecipientsResponseError|array<array{message: string, error_indices: array<int>}> $errors
     */
    public function __construct(
        public int $errorCount,
        public array $errorIndices,
        public array $unmodifiedIndices,
        public int $newCount,
        public array $persistedRecipients,
        public int $updatedCount,
        public array $errors,
    ) {
    }

    /**
     * @param array<CreateRecipientsResponseError> $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return array<array{message: string, error_indices: array<int>}>|array<CreateRecipientsResponseError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
