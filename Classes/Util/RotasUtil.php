<?php

namespace Util;

class RotasUtil
{

    /**
     * @return array
     */
    public static function getRotas()
    {
        $urls = self::getUrls();
        $request=[];
        $request['rota']=strtoupper($urls[0]);
        $request['recurso']=$urls[1] ??null;
        $request['id']=$urls[2] ??null;
        $request['metodo']=$_SERVER['REQUEST_METHOD'];

        return $request;

    }

    /**
     * @return string[]
     */
    public static function getUrls ()
    {/*srt_replace pega oque for passado e procura dentro do server*/
      $uri = str_replace('/'.DIR_PROJETO,'',$_SERVER['REQUEST_URI']);
      return explode('/',trim($uri,'/'));/*trin tira espaços*/return explode('/', trim($uri, '/'));

    }
}