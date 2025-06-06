<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('can have many employees', function () {
    $company = Company::factory()->create();

    Employee::factory()->count(3)->create([
        'company_id' => $company->id,
    ]);
    expect($company->employees->count())->toBe(3);
});

test('can see company on index page', function () {
    $company = Company::factory()->create();
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user)
        ->get(route('dashboard'))
        ->assertSee($company->name);
});
