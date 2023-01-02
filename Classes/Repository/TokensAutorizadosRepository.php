<?php

namespace Repository;

use DB\MySQL;
use InvalidArgumentException as InvalidArgumentExceptionAlias;
use Util\ConstantesGenericasUtil;

class TokensAutorizadosRepository
{

    private object $MySQL;
    public const TABELA="token_autorizados";


    public function __construct()
    {
        $this->MySQL=new MySQL();

        
    }

    public function validarToken($token)
    {
        $token = str_replace([' ', 'Bearer'], '', $token);

        if ($token) {
            $consultaToken = 'SELECT id FROM ' . self::TABELA . ' WHERE token = :token AND status = :status';
            $stmt = $this->getMySQL()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if ($stmt->rowCount() !== 1) {
                header("HTTP/1.1 401 Unauthorized");
                throw new InvalidArgumentExceptionAlias(ConstantesGenericasUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
        } else {
            throw new InvalidArgumentExceptionAlias(ConstantesGenericasUtil::MSG_ERRO_TOKEN_VAZIO);
        }

    }

    /**
     * @return MySQL|object
     */
    public function getMySQL()
    {
        return $this->MySQL;

    }


}