<?php

namespace App\Enums;

enum HistoricalPeriod: string
{
    case PreTerremoto   = 'pre_terremoto';
    case Terremoto1970  = 'terremoto_1970';
    case Reconstruccion = 'reconstruccion';
    case SigloXxi       = 'siglo_xxi';

    public function label(): string
    {
        return match($this) {
            self::PreTerremoto   => 'Antes del Terremoto',
            self::Terremoto1970  => 'Terremoto 1970',
            self::Reconstruccion => 'Reconstrucción',
            self::SigloXxi       => 'Siglo XXI',
        };
    }

    public function barLabel(): string
    {
        return match($this) {
            self::PreTerremoto   => 'ANTES DEL TERREMOTO',
            self::Terremoto1970  => 'TERREMOTO 1970',
            self::Reconstruccion => 'RECONSTRUCCIÓN',
            self::SigloXxi       => 'SIGLO XXI',
        };
    }
}
