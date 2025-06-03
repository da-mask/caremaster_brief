<?php

namespace Tests\Feature\Company;

use App\Models\{Employee, User};

use function Pest\Laravel\actingAs;



test('can delete employee', function () {
    $employee = Employee::factory()->create();
    /** @var User $user */
    $user = User::factory()->create();
    expect(Employee::count())->toBe(1);
    $companyId = $employee->company_id;
    actingAs($user)
        ->delete(route('employees.destroy', $employee->id))
        ->assertRedirect(route('companies.edit', $companyId));
    expect(Employee::count())->toBe(0);
});
    
    

