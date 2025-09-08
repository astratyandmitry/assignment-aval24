<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Client\Enums\Region;
use App\Domain\Loan\Policy\LoanEligibilityPolicy;
use App\Domain\Loan\Rules\AgeRangeRule;
use App\Domain\Loan\Rules\MinimumCreditScoreRule;
use App\Domain\Loan\Rules\MinimumMonthlyIncomeRule;
use App\Domain\Loan\Rules\PeriodDaysRangeRule;
use App\Domain\Loan\Rules\RegionAllowedRule;
use App\Domain\Loan\Rules\RegionIncreaseInterestRateRule;
use App\Domain\Loan\Rules\RegionRandomDeclineRule;
use Carbon\Laravel\ServiceProvider;

final class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LoanEligibilityPolicy::class,
            fn(): LoanEligibilityPolicy => new LoanEligibilityPolicy(
                baseInterestRate: 0.10,
                rules: [
                    new AgeRangeRule(min: 18, max: 60),
                    new MinimumMonthlyIncomeRule(min: 1000),
                    new MinimumCreditScoreRule(min: 500),
                    new PeriodDaysRangeRule(min: 30, max: 90),
                    new RegionAllowedRule(regions: Region::cases()),
                    new RegionRandomDeclineRule(region: Region::PR),
                    new RegionIncreaseInterestRateRule(region: Region::OS, increasePercentage: 0.05),
                ])
        );
    }
}
