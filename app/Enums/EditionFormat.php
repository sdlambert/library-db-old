<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Unknown()
 * @method static static Hardcover()
 * @method static static Paperback()
 */
final class EditionFormat extends Enum
{
    const Unknown             = 0;
    const Hardcover           = 1;
    const Paperback           = 2;
    const MassMarketPaperback = 3;
}
