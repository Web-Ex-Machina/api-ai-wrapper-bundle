# Web ex Machina AI API Wrapper Bundle

A Symfony bundle that provides a wrapper around the Web ex Machina AI API for SEO optimization, text processing, image metadata generation, and translation.

## Features

- Generate SEO titles and descriptions
- Optimize text for search engines
- Fix typos in text
- Generate SEO image titles and alt text
- Translate text between languages

## Requirements

- PHP 8.2 or higher
- Symfony Framework Bundle 6.4.x or 7.2.x
- Symfony HTTP Client 7.3+

## Installation

1. Install the bundle via Composer:

```bash
composer require webexmachina/api-ai-wrapper-bundle
```

2. If you're using Symfony Flex, the bundle will be automatically registered. Otherwise, add it to your `config/bundles.php`:

```php
return [
    // ...
    WebExMachina\ApiAiWrapperBundle\ApiAiWrapperBundle::class => ['all' => true],
];
```

## Usage

The bundle provides the `ApiAiWrapper` service which you can inject into your controllers or services:

```php
use WebExMachina\ApiAiWrapperBundle\Service\ApiAiWrapper;

class YourController
{
    public function __construct(
        private ApiAiWrapper $apiAiWrapper
    ) {
    }

    public function myFunction(): void
    {
        // Your JWT token, up to you to retrive and caching him.
        $token = $this->getMyJWTToken();

        // Generate SEO title
        // return a string
        $seoTitle = $this->apiAiWrapper->generateSeoTitle(
            keywords: ['symfony', 'bundle', 'seo'],
            theme: 'Web Development',
            language: 'en_EN',
            text: 'your text',
            token: $token
        );
        
    }
}
```

### Getting an API Token

To use this bundle, you need an account on your API. Please create an account there [Web ex Machina AI API](https://ai.webexmachina.fr/) to obtain your credentials.

## Contribution

This bundle is experimental and contributions are welcome! If you find a bug or have suggestions for improvements, feel free to submit an issue or pull request.

## License

This project is licensed under the [Apache 2.0](https://github.com/Web-Ex-Machina/api-ai-wrapper-bundle?tab=Apache-2.0-1-ov-file).
