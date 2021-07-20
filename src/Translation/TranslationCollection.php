<?php

namespace App\Translation;

use App\Exception\MissingTranslationException;

class TranslationCollection
{
    private array $translations;

    public function __construct()
    {
        $this->translations = [
            'Above' => 'Mub',
            'Alarm' => 'Kishtraum',
            'Allor' => 'Laudh',
            'Armor' => 'Armor',
            'Bury' => 'Jargza',
            'Conquer' => 'Sundog',
            'Death' => 'Gurz',
            'Downhill' => 'Taposhat',
            'Eye' => 'Su',
            'Explosive' => 'Plasas'
        ];
    }

    public function getTranslation(string $word): string
    {
        if (key_exists($word, $this->translations) === false) {
            throw new MissingTranslationException('The word does not have a translation' . PHP_EOL);
        }

        return $this->translations[$word];
    }
}