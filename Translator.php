<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 08.08.2015
 * Time: 14:13
 */

namespace Helda\PigLatin;

class Translator
{

    /**
     * Array of vowels
     * @var array
     */
    private $vowels = [];

    private $state;

    public function __construct()
    {
        $this->vowels = [
            "a", "e", "i", "o", "u", "y"
        ];
    }

    /**
     * This function translate input string
     * @param string $inputStr
     * @return array
     */
    public function translate($inputStr)
    {
        $outputString = [];
        foreach ($this->splitWords($inputStr) as $word)
        {
            $outputString[] = $this->prepareTranslateString($word);
        }

        return $outputString;
    }

    /**
     * Split more word to array
     * @param string $str
     * @return array
     */
    private function splitWords($str)
    {
        return explode(" ", $str);
    }

    /**
     * Remove punction from word
     * @param string $word
     * @return string
     */
    private function removePunction($word)
    {
        return preg_replace("#[[:punct:]]#", "", $word);
    }

    /**
     * @param string $word
     * @return string
     */
    private function prepareTranslateString($word)
    {
        $word = $this->removePunction($word);
        if($this->isVowel(substr($word, 0, 1)))
        {
            return $word . "-way";
        } else {
            return $this->prepareWord($word) . "ay";
        }
    }

    /**
     * @param string $word
     * @return string
     */
    private function prepareWord($word)
    {
        if (!$this->isVowel(substr($word, 0, 1)))
        {
            $letter = !$this->state ? "-" . strtolower(substr($word, 0, 1)) : "" . strtolower(substr($word, 0, 1));
            $word = substr($word, 1) . $letter;
            $this->state = true;
            return $this->prepareWord($word);
        } else {
            $this->state = false;
            return $word;
        }
    }

    /**
     * Check if letter is vowel
     * @param string $char
     * @return bool
     */
    private function isVowel($char)
    {
        for ($i = 0; $i < 6; $i++)
        {
            if (strtolower($char) == $this->vowels[$i])
            {
                return true;
            }
        }

        return false;
    }

}