<?php

namespace App\Enums;

enum ApplyStatus: string
{
    case New = 'new';
    case Process = 'process';
    case Accept = 'accept';
    case Reject = 'reject';
}
