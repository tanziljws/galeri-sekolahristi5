<?php

namespace App\Helpers;

class ContentFilter
{
    private static $inappropriateWords = [
        // Indonesian inappropriate words
        'anjing', 'bangsat', 'babi', 'kontol', 'memek', 'pantek', 'bajingan', 'bego', 'goblok', 'tolol',
        'bodoh', 'dungu', 'idiot', 'sialan', 'brengsek', 'kampret', 'asu', 'babi', 'anjing',
        'fuck', 'shit', 'damn', 'bitch', 'asshole', 'stupid', 'idiot', 'moron', 'crap',
        'kurang ajar', 'tidak sopan', 'kasar', 'jorok', 'kotor', 'najis',
        // Additional variations and common misspellings
        'anjg', 'bngst', 'bgo', 'gblk', 'tlol', 'bdo', 'dngu', 'slan', 'brngsk', 'kmprt',
        'f*ck', 'sh*t', 'd*mn', 'b*tch', 'a*shole', 'st*pid', 'm*ron'
    ];

    /**
     * Check if content contains inappropriate words
     */
    public static function hasInappropriateContent($text)
    {
        $text = strtolower($text);
        $detectedWords = [];

        foreach (self::$inappropriateWords as $word) {
            if (strpos($text, $word) !== false) {
                $detectedWords[] = $word;
            }
        }

        return [
            'has_inappropriate' => !empty($detectedWords),
            'detected_words' => $detectedWords
        ];
    }

    /**
     * Filter inappropriate content from text
     */
    public static function filterContent($text)
    {
        $result = self::hasInappropriateContent($text);
        
        if ($result['has_inappropriate']) {
            $filteredText = $text;
            foreach ($result['detected_words'] as $word) {
                $filteredText = str_ireplace($word, str_repeat('*', strlen($word)), $filteredText);
            }
            return $filteredText;
        }

        return $text;
    }

    /**
     * Get warning message for inappropriate content
     */
    public static function getWarningMessage($detectedWords = [])
    {
        $message = 'Komentar Anda mengandung kata-kata yang tidak pantas. ';
        
        if (!empty($detectedWords)) {
            $message .= 'Kata yang terdeteksi: ' . implode(', ', $detectedWords) . '. ';
        }
        
        $message .= 'Silakan gunakan bahasa yang sopan dan pantas.';
        
        return $message;
    }
}
