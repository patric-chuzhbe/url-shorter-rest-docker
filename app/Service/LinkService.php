<?php

namespace App\Service;

use App\Models\Link;
use Exception;

class LinkService
{
    private const UNIQUE_SUFFIX_ATTEMPTS_MAX = 20;

    private const SUFFIX_LENGTH = 6;

    /**
     * @param string $urlToShort
     * @return string
     */
    public function getShortUrlSuffix(string $urlToShort): string
    {
        $existingSuffix = $this->tryToFindExistingSuffix($urlToShort);
        if ($existingSuffix) {
            return $existingSuffix;
        }

        $shortUrlSuffix = $this->generateShortUrlSuffix();

        Link::create([
            'url_to_short' => $urlToShort,
            'short_url_suffix' => $shortUrlSuffix,
        ]);

        return $shortUrlSuffix;
    }

    /**
     * @return string
     */
    private function generateShortUrlSuffix(): string
    {
        for ($i = 0; $i <= self::UNIQUE_SUFFIX_ATTEMPTS_MAX; ++$i) {
            $randomSymbols = $this->getRandomSymbols();
            if ($this->isSuffixUnique($randomSymbols)) {
                return $randomSymbols;
            }
        }

        throw new Exception(
            'Не удалось сгенерировать уникальный суффикс короткого URL за '
                . self::UNIQUE_SUFFIX_ATTEMPTS_MAX
                . ' попыток'
        );
    }

    /**
     * @return string
     */
    private function getRandomSymbols(): string
    {
        return bin2hex(random_bytes(self::SUFFIX_LENGTH / 2));
    }

    /**
     * @param string $randomSymbols
     * @return bool
     */
    private function isSuffixUnique(string $randomSymbols): bool
    {
        return Link::where('short_url_suffix', '=', $randomSymbols)->count() === 0;
    }

    /**
     * @param string $urlToShort
     * @return string|null
     */
    private function tryToFindExistingSuffix(string $urlToShort): ?string
    {
        return Link::where('url_to_short', '=', $urlToShort)->value('short_url_suffix');
    }
}
