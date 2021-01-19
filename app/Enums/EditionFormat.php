<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Hardcover()
 * @method static static TradePaperback()
 * @method static static Paperback()
 * @method static static BookClubEdition()php ar
 */
final class EditionFormat extends Enum
{
    const Hardcover       = 0;
    const TradePaperback  = 1;
    const Paperback       = 2;
    const BookClubEdition = 3;
}
