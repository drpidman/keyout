<?php

namespace App\Entity;

class Professor
{
    public $idusuario;
    public $nome;
    public $nregistro;

    public function __construct(int $idusuario = null, string $nome = null, int $nregistro = null)
    {
        $this->idusuario = $idusuario;
        $this->nome = $nome;
        $this->nregistro = $nregistro;
    }

    public function getName(self $user)
    {
        return $user->nome;
    }

    public function getNRegistro(self $user)
    {
        return $user->nregistro;
    }
}