<?php

namespace helpers;

class Captcha
{
    protected $imageParams = ['width' => 200, 'height' => 50];
    protected $textParams = ['length' => 6];

    public function __construct($force = false)
    {
        $this->generateImage($force);
    }

    protected function generateImage($force = false)
    {
        header("Content-type: image/png");
        $img = imagecreate($this->imageParams['width'], $this->imageParams['height']);
        imagecolorallocate($img, 255, 255, 255);
        $text_color = imagecolorallocate($img, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
        $line_color = imagecolorallocate($img, mt_rand(100,255), mt_rand(100,255), mt_rand(100,255));
        for($i=0; $i<50; $i++)
            imageline($img,0,mt_rand(0,($this->imageParams['width']-50)),$this->imageParams['width'],mt_rand(0, $this->imageParams['height'] - 20),$line_color);
        imagestring($img, 5, mt_rand(50,($this->imageParams['width'] - 50)), mt_rand(10,($this->imageParams['height'] - 20)),  $this->generateText($force), $text_color);
        imagepng($img);
        imagedestroy($img);
    }

    protected function generateText($force = false)
    {
        if(!isset($_SESSION['captcha']) || $force)
        {
            $word = array_merge(range('a', 'z'), range('A', 'Z'));
            shuffle($word);
            $randomWord = substr(implode($word), 0, $this->textParams['length']);
            $_SESSION['captcha'] = $randomWord;
            return $randomWord;
        }
        else
            return $_SESSION['captcha'];
    }
}