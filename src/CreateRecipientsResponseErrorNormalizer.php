<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponseError;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CreateRecipientsResponseErrorNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function getSupportedTypes(?string $format): array
    {
        return [
            CreateRecipientsResponseError::class => true,
        ];
    }

    /**
     * @param array<string, mixed> $context
     *
     * @return array{message: string, error_indices: array<int>}
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        if (!$object instanceof CreateRecipientsResponseError) {
            throw new InvalidArgumentException('The object must be an instance of "CreateRecipientsResponseError".');
        }

        return [
            'message' => $object->message,
            'error_indices' => $object->errorIndices,
        ];
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof CreateRecipientsResponseError;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if ($data === null) {
            return null;
        }
        if ($type !== CreateRecipientsResponseError::class) {
            throw new InvalidArgumentException('type must be CreateRecipientsResponseError.');
        }

        if (!\is_array($data) || !isset($data['message']) || !isset($data['error_indices'])) {
            throw new InvalidArgumentException('type must be CreateRecipientsResponseError.');
        }

        return new CreateRecipientsResponseError(
            message: $data['message'],
            errorIndices: $data['error_indices'],
        );
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateRecipientsResponseError::class;
    }
}
