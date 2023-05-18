<?php

// /api/products CRUD [GET, POST, PUT, DELETE] auth

use App\Models\Product;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

it('Product Controller', function () {
    actingAs(App\Models\User::factory()->create());
    $product = Product::factory()->create();
    getJson('/api/products')->assertJsonStructure(['data' => [['id', 'name', 'price']]]);
    getJson('/api/products/'.$product->id)->assertJsonStructure(['data' => ['id', 'name', 'price']]);
    postJson('/api/products', ['name' => 'test', 'price' => 100])->assertJsonStructure(['data' => ['id', 'name', 'price']]);
    putJson('/api/products/'.$product->id, ['name' => 'test', 'price' => 100])->assertJsonStructure(['data' => ['id', 'name', 'price']]);
    deleteJson('/api/products/'.$product->id)->assertNoContent();
});
