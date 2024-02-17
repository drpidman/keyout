<?php

namespace App\Entity;

class Salas
{
    public $idsala;
    public $nome;
    public $reservado;
    public $listagem;


    public function __construct(int $idsala, string $nome = null, bool $reservado = null, string $listagem = null)
    {
        $this->idsala = $idsala;
        $this->nome = $nome;
        $this->reservado = $reservado;
        $this->listagem = $listagem;
    }
}
