<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data to ensure clean state
        Schema::disableForeignKeyConstraints();
        DB::table('order_items')->delete();
        DB::table('orders')->delete();
        DB::table('wishlists')->delete();
        DB::table('products')->delete();
        DB::table('categories')->delete();
        Schema::enableForeignKeyConstraints();

        // Admin & Test Users
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'admin2'],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@example.com',
                'role' => 'admin',
                'password' => bcrypt('1234'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'role' => 'user',
                'password' => bcrypt('password'),
            ]
        );

        // KhilafStore Categories
        $categories = [
            ['name' => 'Action Figure', 'slug' => 'action-figure', 'image' => 'action_figure.jpg'],
            ['name' => 'Book',          'slug' => 'book',          'image' => 'book.jpg'],
            ['name' => 'Keychain',      'slug' => 'keychain',      'image' => 'keychain.jpg'],
            ['name' => 'Acrylic Figure','slug' => 'acrylic-figure','image' => 'acrylic_figure.jpg'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[$cat['slug']] = Category::create([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'image' => $cat['image']
            ]);
        }

        // KhilafStore Products
        $products = [
            [
                'name' => 'Naruto Shippuden Action Figure',
                'category_slug' => 'action-figure',
                'description' => 'Naruto Shippuden poseable action figure with detailed sculpt and multiple accessories.',
                'price' => 250000,
                'stock' => 30,
                'image' => 'naruto_figure.jpg'
            ],
            [
                'name' => 'One Piece Luffy Action Figure',
                'category_slug' => 'action-figure',
                'description' => 'High-quality Monkey D. Luffy figure in Gear 5 form. Collector edition.',
                'price' => 350000,
                'stock' => 20,
                'image' => 'luffy_figure.jpg'
            ],
            [
                'name' => 'Demon Slayer Tanjiro Action Figure',
                'category_slug' => 'action-figure',
                'description' => 'Tanjiro Kamado action figure with water breathing special effects stand.',
                'price' => 280000,
                'stock' => 25,
                'image' => 'tanjiro_figure.jpg'
            ],
            [
                'name' => 'Attack on Titan Artbook',
                'category_slug' => 'book',
                'description' => 'Official Attack on Titan full-color art book featuring character designs and storyboards.',
                'price' => 180000,
                'stock' => 40,
                'image' => 'aot_artbook.jpg'
            ],
            [
                'name' => 'One Piece Color Walk Vol.1',
                'category_slug' => 'book',
                'description' => 'Official One Piece color illustration collection by Eiichiro Oda.',
                'price' => 150000,
                'stock' => 50,
                'image' => 'op_colorwalk.jpg'
            ],
            [
                'name' => 'Naruto Metal Keychain',
                'category_slug' => 'keychain',
                'description' => 'Premium metal Naruto Konoha symbol keychain, perfect for bags and keys.',
                'price' => 35000,
                'stock' => 100,
                'image' => 'naruto_keychain.jpg'
            ],
            [
                'name' => 'Demon Slayer Hashira Keychain Set',
                'category_slug' => 'keychain',
                'description' => 'Set of 9 Hashira keychains from Demon Slayer, double-sided acrylic.',
                'price' => 55000,
                'stock' => 80,
                'image' => 'hashira_keychain.jpg'
            ],
            [
                'name' => 'Gojo Satoru Acrylic Figure',
                'category_slug' => 'acrylic-figure',
                'description' => 'Gojo Satoru acrylic stand from Jujutsu Kaisen, full-color double-sided print.',
                'price' => 75000,
                'stock' => 60,
                'image' => 'gojo_acrylic.jpg'
            ],
            [
                'name' => 'Levi Ackerman Acrylic Figure',
                'category_slug' => 'acrylic-figure',
                'description' => 'Captain Levi Ackerman acrylic stand with premium UV protection print.',
                'price' => 70000,
                'stock' => 55,
                'image' => 'levi_acrylic.jpg'
            ],
            [
                'name' => 'Zero Two Acrylic Figure',
                'category_slug' => 'acrylic-figure',
                'description' => 'Zero Two from Darling in the FranXX, high-res full-color acrylic figure stand.',
                'price' => 80000,
                'stock' => 45,
                'image' => 'zerotwo_acrylic.jpg'
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['description'],
                'price' => $p['price'],
                'stock' => $p['stock'],
                'category_id' => $categoryModels[$p['category_slug']]->id,
                'image' => $p['image']
            ]);
        }

        // Dummy Orders
        $user = User::where('role', 'user')->first();
        if ($user) {
            $order1 = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . rand(10000, 99999),
                'status' => 'delivered',
                'total_price' => 45000
            ]);
            
            $trending = Product::take(2)->get();
            foreach($trending as $product) {
                 OrderItem::create([
                    'order_id' => $order1->id,
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => $product->price
                ]);
            }
        }
    }
}
