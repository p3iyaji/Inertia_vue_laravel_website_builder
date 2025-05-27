<?php

// app/Services/ColorConverter.php
namespace App\Services;

class ColorConverter
{
    protected $colorMap = [
        '#ffffff' => 'white',
        '#feffff' => 'white',
        '#ff2600' => 'red-700',
        '#000000' => 'black',
        '#ef4444' => 'red-500',
        '#ff9200' => 'orange-400',
        '#aa7941' => 'brown-700',
        '#0432ff' => 'indigo-600',

        // Add more mappings as needed
    ];

    public function hexToTailwind($hex)
    {
        $hex = strtolower($hex);
        return $this->colorMap[$hex] ?? null;
    }
}