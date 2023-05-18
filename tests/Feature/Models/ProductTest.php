<?php

use App\Models\Product;
use Cknow\Money\Money;

it('can create Product', function () {
    $product = Product::factory()->create();

    expect($product)->toBeInstanceOf(Product::class);
    expect($product->id)->toBeInt();
    expect($product->getFillable())->toBeArray();


    test()->assertDatabaseCount('products', 1)
    ->expectsDatabaseQueryCount(1)
    ->assertModelExists($product);
});


// it can cast price as Money
it('can cast price as Money', function () {
    $product = Product::factory()->create([
        'price' => 1000
    ]);

    expect($product->price)->toBeInstanceOf(Money::class);
    expect($product->price->getAmount())->toBe('1000');
});

// scope active
it('can scope active', function () {
    Product::factory()->create([
        'is_active' => true
    ]);

    Product::factory()->create([
        'is_active' => false
    ]);

    expect(Product::active()->count())->toBe(1);
});
