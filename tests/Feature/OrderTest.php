<?php

namespace Tests\Feature;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    protected User $user;
    protected Cart $cart;
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->cart = Cart::factory()->create(['user_id' => $this->user->id]);
        $this->product = Product::factory()->create(['price' => 100]);
    }

    /** @test */
    public function test_store_order()
    {
        $this->withoutExceptionHandling();
        CartItem::factory()->create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'quantity' => 2,
            'price' => 200
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/orders', [
            'address' => 'Lenina 34',
            'city' => 'Moscow',
            'country' => 'Russia',
        ]);
        $response->dump();

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'order' => [
                         'id',
                         'status',
                         'location',
                         'items',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
        $this->assertDatabaseHas('orders', [
            'cart_id' => $this->cart->id,
            'user_id' => $this->user->id
        ]);
        $this->assertDatabaseHas('order_items', ['product_id' => $this->product->id]);
        $this->assertDatabaseHas('locations', ['address' => 'Lenina 34']);
    }

    public function test_unauthenticated_user_cannot_create_order()
    {
        $response = $this->postJson('/api/orders', [
            'address' => 'Lenina 34',
            'city' => 'Moscow',
            'country' => 'Russia'
        ]);

        $response->assertStatus(401)
             ->assertJsonStructure([
                 'message'
             ])
             ->assertJson(['message' => 'Unauthenticated.']);
    }
}   

