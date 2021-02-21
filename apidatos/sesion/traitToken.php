<?php


trait traitToken{

  
    function getToken(){

        $factory = new \PsrJwt\Factory\Jwt();

        $scr= $_ENV["TKN_SCRT"];

        $builder = $factory->builder();
        
        $token = $builder->setSecret($scr)
            ->setPayloadClaim('uid', 12)
            ->build();
        
        return $token->getToken();


    }



}