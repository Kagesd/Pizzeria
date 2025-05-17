<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use PHPUnit\Framework\Attributes\Test;

class CartTest extends TestCase
{
    
    use RefreshDatabase;

    protected User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /** @test */
    public function it_adds_product_to_cart()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->user, 'api')
                         ->postJson('/api/cart', [
                             'product_id' => $product->id,
                             'quantity' => 2,
                             'price' => $product->price,
                         ])
                         ->assertStatus(201);

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_cannot_add_to_cart_without_auth()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $response = $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $response->assertStatus(401);
    }
    
}