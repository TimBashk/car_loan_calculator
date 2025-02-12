<?php

namespace App\Services;

use App\DTO\PaymentProgramDto;
use App\Repository\PaymentProgramRepository;

class PaymentProgramChoiceService
{
    private const INIT_PAYMENT_300 = 3*100*1000;
    private const INIT_PAYMENT_500 = 5*100*1000;
    private const INIT_PAYMENT_1000 = 1000*1000;
    private const LOAN_TERM = 3*12;
    private const DEFAULT_PROGRAM = 'default_program';
    private const LESS_300_LESS_3 = 'less_300_less_3';
    private const LESS_500_LESS_3 = 'less_500_less_3';
    private const LESS_1000_LESS_3 = 'less_1000_less_3';
    private const LESS_300_MORE_3 = 'less_300_more_3';
    private const LESS_500_MORE_3 = 'less_500_more_3';
    private const LESS_1000_MORE_3 = 'less_1000_more_3';
    private const MONTH_COUNT = 12;

    public function __construct(
        private PaymentProgramRepository $programRepository
    )
    {
    }

    public function getProgramByParams(int $price, int $initialPayment, int $loanTerm): PaymentProgramDto
    {
        $alias = $this->getAlias($initialPayment, $loanTerm);
        $program = $this->programRepository->findOneBy(['alias' => $alias], []);

        $paymentProgram = new PaymentProgramDto(
            $program->getId(),
            $program->getInterestRate(),
            $program->getTitle()
        );

        $monthlyPayment = $this->calculateMonthlyPayment($price, $loanTerm, $paymentProgram->getInterestRate());
        $paymentProgram->setMonthlyPayment($monthlyPayment);

        return $paymentProgram;
    }

    private function calculateMonthlyPayment(int $price, int $loanTerm, float $interestRate): int
    {
        $percent = $interestRate / self::MONTH_COUNT;
        $sum = $price * (0.01 * $percent + 0.01 * $percent / (pow(1 + 0.01 * $percent, $loanTerm) - 1));

        return round($sum, 2, 2);
    }

    private function getAlias(int $initialPayment, int $loanTerm): string
    {
        if ($initialPayment < self::INIT_PAYMENT_300 && $loanTerm < self::LOAN_TERM) {
            return self::LESS_300_LESS_3;
        }

        if ($initialPayment > self::INIT_PAYMENT_300 && $initialPayment < self::INIT_PAYMENT_500 && $loanTerm < self::LOAN_TERM) {
            return self::LESS_500_LESS_3;
        }

        if ($initialPayment >= self::INIT_PAYMENT_500 && $initialPayment < self::INIT_PAYMENT_1000 && $loanTerm < self::LOAN_TERM) {
            return self::LESS_1000_LESS_3;
        }

        if ($initialPayment < self::INIT_PAYMENT_300 && $loanTerm > self::LOAN_TERM) {
            return self::LESS_300_MORE_3;
        }

        if ($initialPayment > self::INIT_PAYMENT_300 && $initialPayment < self::INIT_PAYMENT_500 && $loanTerm > self::LOAN_TERM) {
            return self::LESS_500_MORE_3;
        }

        if ($initialPayment >= self::INIT_PAYMENT_500 && $initialPayment < self::INIT_PAYMENT_1000 && $loanTerm > self::LOAN_TERM) {
            return self::LESS_1000_MORE_3;
        }

        return self::DEFAULT_PROGRAM;
    }
}