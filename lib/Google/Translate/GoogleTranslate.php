<?php

namespace Google\Translate;

use Google\Translate\Exception\MissingFromLanguageException; 
use Google\Translate\Exception\MissingToLanguageException; 
use Google\Translate\Exception\MissingTextLanguageException; 
use Google\Translate\Exception\TranslateServerIsDownException; 

use Guzzle\Stream\Stream;



class GoogleTranslate 
{
    private $googleTranslateServiceUrl = "http://translate.google.com";


    public function translate ($from, $to, $from_text, $options = [])
    {   
        if(!$from){
            throw new MissingFromLanguageException();
        }
        elseif(!$to){
            throw new MissingToLanguageException();
        }
        elseif(!$from_text){
            throw new MissingTextLanguageException();
        }
        $from_text = urlencode($from_text);
        $url = $this->googleTranslateServiceUrl . "/translate_a/t?client=t&text=$from_text&hl=$from&sl=auto&tl=$to&multires=1&prev=btn&ssel=0&tsel=4&uptl=$to&alttl=$from&sc=1&oe=UTF-8&ie=UTF-8&otf=1&pc=1";
        
            $stream = new Stream(fopen($url, 'r'));
            $content = $stream;
            $tab = explode(",", $content);

            $new_tab = array();
            foreach($tab as $elem){
                if($elem == ''){
                    $new_tab[] = "\"\"";
                }
                else {
                    $new_tab[] = $elem;
                }
            }

            $result = implode(",", $new_tab);
            $result = json_decode($result, true) ;
            if(!$result || $result ==""){
                throw new TranslateServerIsDownException();
            }
            $stream->close();
            return array($result[0][0][0], $result[0][0][1]);

    }

    public function supportedLanguages()
    {
        return $this->fetchLanguages($this->googleTranslateServiceUrl, []);
    }

    private function fetchLanguages($request, $keys)
    {
    
    }

    private function collectLanguages($buffer, $index, $tagName, $tagId)
    {
    
    }
}
