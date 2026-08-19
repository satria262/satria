<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();

        $stores = [];
        foreach ($users as $user) {
            $stores[] = Store::create([
                'user_id' => $user->id,
                'name' => $user->name . "'s Store",
                'address' => fake()->address(),
            ]);
        }

        $employees = [];
        foreach ($stores as $store) {
            foreach (range(1, 3) as $_) {
                $employees[] = Employee::create([
                    'store_id' => $store->id,
                    'name' => fake()->name(),
                    'position' => fake()->jobTitle(),
                ]);
            }
        }

        foreach ($employees as $employee) {
            EmployeeDetail::create([
                'employee_id' => $employee->id,
                'employee_number' => fake()->unique()->numberBetween(1000, 9999),
                'date_of_joining' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            ]);
        }

        $products = [];
        foreach ($stores as $store) {
            foreach (range(1, 4) as $_) {
                $products[] = Product::create([
                    'store_id' => $store->id,
                    'name' => fake()->word() . ' ' . fake()->word(),
                    'price' => fake()->numberBetween(10000, 200000),
                    'stock' => fake()->numberBetween(10, 100),
                ]);
            }
        }

        foreach ($products as $product) {
            ProductDetail::create([
                'product_id' => $product->id,
                'description' => fake()->sentence(12),
                'weight' => fake()->numberBetween(100, 2000),
            ]);
        }

        foreach ($users as $user) {
            foreach (range(1, 2) as $_) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => fake()->randomElement(['completed', 'uncompleted']),
                ]);

                $orderProducts = collect($products)->random(2);
                foreach ($orderProducts as $product) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => fake()->numberBetween(1, 5),
                        'unit_price' => $product->price,
                    ]);
                }

                $amount = OrderDetail::where('order_id', $order->id)
                    ->get()
                    ->sum(fn ($detail) => $detail->quantity * $detail->unit_price);

                Payment::create([
                    'order_id' => $order->id,
                    'method' => fake()->randomElement(['cash', 'credit_card', 'transfer']),
                    'amount' => $amount,
                ]);
            }
        }
    }
}
