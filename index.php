<?php
include 'bootstrap.php';

use Util\ConstantesGenericasUtil;
use Util\jsonUtil;
use Util\RotasUtil;
use Validator\RequestValidator;




try{
    $RequestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $RequestValidator->processarRequest();


    $jsonUtil= new jsonUtil();
    $jsonUtil->processarArrayParaRetornar($retorno);
}catch (Exception $exception){
    echo json_encode([
        ConstantesGenericasUtil::TIPO=> ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA=>utf8_encode($exception->getMessage())
    ]);
}
