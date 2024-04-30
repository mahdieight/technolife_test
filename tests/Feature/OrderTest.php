<?php

namespace Tests\Feature;

use App\Models\Order;
use Database\Seeders\OrderSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Enums\Order\OrderStatusEnum;


class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_success_index_users_endpoint(): void
    {

        $this->seed(UserSeeder::class);
        $this->seed(OrderSeeder::class);

        $response = $this->get('/api/backoffice/orders');

        $response->assertStatus(201);

        $response->assertJsonCount(3, 'data.docs.0');
        $response->assertJsonCount(4, 'data.docs.0.user');

        $response->assertJsonStructure([
            'message',
            'data' => [
                'docs' => [
                    '*' => [
                        'amount',
                        'status',
                        'user',
                    ],
                ],
                'meta' => [
                    'perPage',
                    'totalDocs',
                    'totalPages',
                    'currentPage',
                    'nextPage',
                    'prevPage',
                ],
            ],
            'errors',
        ]);
    }

    public function test_index_users_status_filter_endpoint(): void
    {

        $this->seed(UserSeeder::class);
        $this->seed(OrderSeeder::class);

        $response = $this->get('/api/backoffice/orders?status=doing');

        $data = $response->json();

        $collection = collect($data["data"]["docs"]);
        $statuses = $collection->pluck("status")->toArray();
        $unique_statuses = array_unique($statuses);
        $asset_status = ["doing"];

        $this->assertEqualsCanonicalizing($unique_statuses, $asset_status);
    }


    public function test_user_orders_filter_by_nationalcode_endpoint(): void
    {

        $user = User::factory()->create();

        $this->seed(UserSeeder::class);
        $this->seed(OrderSeeder::class);

        $user->orders()->create([
            'status' => OrderStatusEnum::DOING->value,
            'amount' => fake()->numberBetween(0, 999999),
        ]);


        $response = $this->get('/api/backoffice/orders?national_code=' . $user->national_code);

        $data = $response->json();

        $collection = collect($data["data"]["docs"]);
        $user_national_codes = $collection->pluck("user.national_code")->toArray();
        $unique_national_codes = array_unique($user_national_codes);
        $asset_user_national_codes = [$user->national_code];

        $this->assertEqualsCanonicalizing($unique_national_codes, $asset_user_national_codes);
    }

   
}
