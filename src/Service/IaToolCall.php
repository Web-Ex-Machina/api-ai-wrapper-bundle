<?php

declare(strict_types=1);

namespace WebExMachina\ApiAiWrapperBundle\Service;

use JsonException;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;


/** @internal */
#[Autoconfigure(public: false)]
readonly class IaToolCall
{

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function request(array $params, string $token, string $path): ResponseInterface
    {
        $body = json_encode($params, JSON_THROW_ON_ERROR);

        return $this->client->request(
            'POST',
            'https://ai.webexmachina.fr/api'.$path,
            [
                'auth_bearer' => $token,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ]
        );
    }
}
