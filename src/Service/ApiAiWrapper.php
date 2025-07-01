<?php

declare(strict_types=1);

/*
 * WebEx Api Ai Wrapper Bundle
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/api-ai-wrapper-bundle/
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WebExMachina\ApiAiWrapperBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Provides various functionalities for interacting with AI tools for SEO optimization, text processing,
 * image metadata generation, and translation.
 */
final readonly class ApiAiWrapper
{
    public function __construct(
        private IaToolCall $toolCall
    ) {
    }

    public function generateSeoTitle(string|array $keywords, string $theme, string $language, string $text, string $token): string
    {
        if (is_array($keywords)) {
            $keywords = implode(',', $keywords);
        }

        $parameters = [
            'keyword' => $keywords,
            'theme' => $theme,
            'lang' => $language,
            'text' => $text,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/generate/meta-title'));
    }

    public function generateSeoDescription(string|array $keywords, string $theme, string $language, string $text, string $token): string
    {
        if (is_array($keywords)) {
            $keywords = implode(',', $keywords);
        }

        $parameters = [
            'keyword' => $keywords,
            'theme' => $theme,
            'lang' => $language,
            'text' => $text,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/generate/meta-description'));
    }

    public function optimizeSeoText(string|array $keywords, string $language, string $text, string $token): string
    {
        if (is_array($keywords)) {
            $keywords = implode(',', $keywords);
        }

        $parameters = [
            'keyword' => $keywords,
            'lang' => $language,
            'text' => $text,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/text/search-engine-optimization'));
    }

    public function fixTypoText(string $language, string $text, string $token): string
    {

        $parameters = [
            'lang' => $language,
            'text' => $text,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/text/fix-typo'));
    }

    public function generateSeoImageTitle(string|array $keywords, string $theme, string $language, string $image, string $token): string
    {
        if (is_array($keywords)) {
            $keywords = implode(',', $keywords);
        }

        $parameters = [
            'keyword' => $keywords,
            'lang' => $language,
            'theme' => $theme,
            'image' => $image,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/image/meta-title'));
    }

    public function generateImageAlt(string $language, string $image, string $token): string
    {
        $parameters = [
            'lang' => $language,
            'image' => $image,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/image/alt'));
    }

    public function translateText(string $from, string $to, string $text, string $token): string
    {
        $parameters = [
            'language_in' => $from,
            'language_out' => $to,
            'text' => $text,
        ];
        return $this->getTheMessage($this->toolCall->request(params: $parameters, token: $token, path: '/translation/text'));
    }

    /**
     * Extracts and returns the content of a message from the response object.
     *
     * @param ResponseInterface $response The HTTP response object containing the API output.
     *
     * @return string The extracted message content from the response.
     * @throws ClientExceptionInterface|DecodingExceptionInterface|ServerExceptionInterface|TransportExceptionInterface|RedirectionExceptionInterface
     */
    private function getTheMessage(ResponseInterface $response): string
    {
        return $response->toArray()['choices'][0]['message']['content'];
    }
}
