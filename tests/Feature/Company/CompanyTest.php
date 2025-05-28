<?php

namespace Tests\Feature\Company;

use App\Models\{Company, Employee};

it('can have many employees', function () {
   $company = Company::factory()->create();

   Employee::factory()->count(3)->create([
       'company_id' => $company->id,
   ]);
   expect($company->employees()->count())->toBe(3);
});