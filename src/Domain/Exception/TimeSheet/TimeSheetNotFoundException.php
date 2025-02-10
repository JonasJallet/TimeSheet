<?php

namespace App\Domain\Exception\TimeSheet;

use App\Domain\Exception\DomainException;

class TimeSheetNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("Exceptions.User.TimeSheetNotFound", 404, ["%id%" => $id]);
    }
}
