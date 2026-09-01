<?php

namespace Database\Seeders;

use App\Enums\CustomerTier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTierSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdminUsers();
        $this->seedTierSamples();
    }

    private function seedAdminUsers(): void
    {
        $adminEmails = collect(explode(',', (string) env('ADMIN_EMAILS', '')))
            ->map(static fn (string $email): string => trim($email))
            ->filter();

        foreach ($adminEmails as $email) {
            $defaultName = Str::of((string) $email)
                ->before('@')
                ->replace(['.', '-', '_'], ' ')
                ->title()
                ->value();

            $admin = User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $defaultName !== '' ? $defaultName : 'Admin',
                    'tier' => CustomerTier::Platinum->value,
                    'password' => $this->seedPassword(),
                ],
            );

            $admin->forceFill(['email_verified_at' => now()])->save();
        }
    }

    private function seedTierSamples(): void
    {
        foreach (CustomerTier::cases() as $tier) {
            $customer = User::query()->updateOrCreate(
                ['email' => $tier->value.'@example.com'],
                [
                    'name' => $tier->label().' Customer',
                    'tier' => $tier->value,
                    'password' => $this->seedPassword(),
                ],
            );

            $customer->forceFill(['email_verified_at' => now()])->save();
        }
    }

    private function seedPassword(): string
    {
        return (string) env('SEED_USER_PASSWORD', 'password');
    }
}
