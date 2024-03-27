<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Customer;
use App\Order;
use App\Feedback;
use App\Payment;
use App\Cart;
use App\Image;
use App\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    // public function run()
    // {
    //     // Create users
    //     $users = factory(User::class, 10)->create();

    //     // Create products with stocks
    //     $products = factory(Product::class, 20)->create()->each(function ($product) {
    //         $product->stock()->save(factory(Stock::class)->make());
    //     });

    //     // Create customers
    //     $customers = factory(Customer::class, 10)->create(['users_id' => $users->random()->id]);

    //     // Create orders with payments
    //     $orders = factory(Order::class, 10)->create(['customers_id' => $customers->random()->id])->each(function ($order) {
    //         $order->payment()->save(factory(Payment::class)->make());
    //     });

    //     // Create feedbacks
    //     $feedbacks = factory(Feedback::class, 10)->create([
    //         'customers_id' => $customers->random()->id,
    //         'products_id' => $products->random()->id,
    //     ]);

    //     // Create carts
    //     $carts = factory(Cart::class, 10)->create([
    //         'customers_id' => $customers->random()->id,
    //         'products_id' => $products->random()->id,
    //     ]);

    //     // Create images for users
    //     $users->each(function ($user) {
    //         $user->image()->save(factory(Image::class)->make());
    //     });

    //     // Attach products to orders
    //     $orders->each(function ($order) use ($products) {
    //         $order->products()->attach(
    //             $products->random(rand(1, 5))->pluck('id')->toArray(),
    //             ['quantity' => rand(1, 5)]
    //         );
    //     });
    // }
}
