<?php

use function Pest\Laravel\get;

test('can see welcome page', function () {
    expect(get('/'))->toBeInertiaView('Welcome');
});