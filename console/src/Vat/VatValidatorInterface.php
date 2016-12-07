<?php

namespace Chronotruck\Vat;

interface VatValidatorInterface
{
    /**
     * @param string $vatNumber
     *
     * @return bool
     */
    public function validate($vatNumber);
}
