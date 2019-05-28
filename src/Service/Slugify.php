<?php

namespace App\Service;

class Slugify
{
    public function generate(string $string): string
    {
        setlocale(LC_ALL, 'en_US.UTF-8');
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower($slug);
        $slug = preg_replace("/[\/_|+ -]+/", '-', $slug);
        return trim($slug, '-');

    }

}