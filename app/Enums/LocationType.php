<?php

namespace App\Enums;

enum LocationType: string
{
    case Region       = 'region';
    case Province     = 'province';
    case District     = 'district';
    case Neighborhood = 'neighborhood';
    case Place        = 'place';
}
