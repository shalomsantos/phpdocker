<?php

declare(strict_types=1);

namespace App\Services;

final class NewsContentSanitizer
{
    public function sanitize(string $content): string
    {
        $config = \HTMLPurifier_Config::createDefault();

        $config->set(
            'HTML.Allowed',
            'p,br,h2,h3,h4,strong,b,em,i,u,s,blockquote,ul,ol,li,'
            . 'a[href|title|target|rel],table,thead,tbody,tr,th,td'
        );

        $config->set('URI.AllowedSchemes', [
            'http' => true,
            'https' => true
        ]);

        $config->set('Attr.AllowedFrameTargets', ['_blank']);

        $config->set('Cache.SerializerPath', dirname(__DIR__, 2) . '/storage/cache/htmlpurifier');

        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($content);
    }
}
