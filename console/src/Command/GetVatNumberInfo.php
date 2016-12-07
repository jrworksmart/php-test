<?php

namespace Chronotruck\Command;

use Chronotruck\Vat\VatValidatorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetVatNumberInfo extends Command
{
    /**
     * @var VatValidatorInterface
     */
    private $vatValidator;

    /**
     * @param VatValidatorInterface $vatValidator
     */
    public function __construct(VatValidatorInterface $vatValidator)
    {
        $this->vatValidator = $vatValidator;
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('check-vat-number');

        $this->addArgument('vatNumber', InputArgument::REQUIRED);
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vatNumber = $input->getArgument('vatNumber');

        if ($this->vatValidator->validate($vatNumber)) {
            $output->writeln(sprintf('Vat number <comment>%s</comment> <info>is valid !</info>', $vatNumber));
        } else {
            $output->writeln(sprintf('Vat number <comment>%s</comment> <error>is not valid !</error>', $vatNumber));
        }
    }
}
