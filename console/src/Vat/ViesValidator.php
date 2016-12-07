<?php

namespace Chronotruck\Vat;

use DragonBe\Vies\Vies;

class ViesValidator implements VatValidatorInterface
{
    /**
     * @var Vies
     */
    private $viesService;

    /**
     * @param Vies $viesService
     */
    public function __construct(Vies $viesService)
    {
        $this->viesService = $viesService;
    }

    /**
     * @param string $vatNumber
     *
     * @return bool
     */
    public function validate($vatNumber)
    {
        $countryCode = substr($vatNumber, 0, 2);
        $number = substr($vatNumber, 2);

        $response = $this->viesService->validateVat($countryCode, $number);

        return $response->isValid();
    }
}
