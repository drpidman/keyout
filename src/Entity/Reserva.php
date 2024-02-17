<?php

namespace App\Entity;

class Reserva
{
    public $idreserva;
    public $idusuario;
    public $idsala;
    public $periodo;

    public function __construct(int $idreserva = null, string $periodo = null, int $idusuario = null, int $idsala = null)
    {
        $this->idreserva = $idreserva;
        $this->periodo = $periodo;
        $this->idusuario = $idusuario;
        $this->idsala = $idsala;
    }
}
