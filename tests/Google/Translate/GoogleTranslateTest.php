<?php

use Google\Translate\GoogleTranslate;


class GoogleTranslateTest extends \PHPUnit_Framework_TestCase
{
    public function testinstanceOfTranslator()
    {
        $t = new GoogleTranslate();
        $translation = $t->translate("fr", "es", "Bonjour Tout le monde");
        print_r($t->translate("fr", "es", "épargner"));

        $this->assertTrue($t instanceof GoogleTranslate ) ; 
        $this->assertEquals($translation[1], "Bonjour Tout le monde" ) ; 
        $this->assertEquals($translation[0], "Hola a todos" ) ; 
    } 
}
