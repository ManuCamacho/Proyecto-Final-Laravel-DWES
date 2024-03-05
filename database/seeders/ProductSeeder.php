<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'PlayStation 5',
                'price' => 500,
                'description' => 'Videoconsola Sony',
                'image' => 'https://cdn.idealo.com/folder/Product/202304/9/202304941/s11_produktbild_max/sony-playstation-5-ps5-2-dualsense-wireless-controller.jpg',
                'stock' => 50
            ],
            [
                'name' => 'PlayStation 4',
                'price' => 400,
                'description' => 'Videoconsola Sony',
                'image' => 'https://m.media-amazon.com/images/I/51czx+lS31L._AC_UF894,1000_QL80_.jpg',
                'stock' => 40
            ],
            [
                'name' => 'PlayStation 3',
                'price' => 300,
                'description' => 'Videoconsola Sony',
                'image' => 'https://i0.wp.com/hitechgamez.in/wp-content/uploads/2023/04/PS3-2.jpg?fit=1000%2C1000&ssl=1',
                'stock' => 30
            ],
            [
                'name' => 'PlayStation 2',
                'price' => 200,
                'description' => 'Videoconsola Sony',
                'image' => 'https://m.media-amazon.com/images/I/712J5AHfS0L._AC_UF894,1000_QL80_.jpg',
                'stock' => 20
            ],
            [
                'name' => 'PlayStation 1',
                'price' => 100,
                'description' => 'Videoconsola Sony',
                'image' => 'https://i.etsystatic.com/33678685/r/il/8afef2/4423273773/il_fullxfull.4423273773_ql56.jpg',
                'stock' => 10
            ],
            [
                'name' => 'Nintendo Switch',
                'price' => 350,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxQKgV.webp',
                'stock' => 50
            ],
            [
                'name' => 'Xbox Series X',
                'price' => 450,
                'description' => 'Videoconsola Microsoft',
                'image' => 'https://iili.io/JVxQkhu.webp',
                'stock' => 15
            ],
            [
                'name' => 'Nintendo Wii',
                'price' => 100,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxQQhg.png',
                'stock' => 8
            ],
            [
                'name' => 'Asus Rog Ally',
                'price' => 700,
                'description' => 'Videoconsola Asus',
                'image' => 'https://iili.io/JVxLdcN.png',
                'stock' => 10
            ],
            [
                'name' => 'PlayStation Vita',
                'price' => 120,
                'description' => 'Videoconsola Sony',
                'image' => 'https://m.media-amazon.com/images/I/71Lm5LFl1hL._AC_UF894,1000_QL80_.jpg',
                'stock' => 2
            ],
            [
                'name' => 'Nintendo Gamecube',
                'price' => 300,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxLwxa.jpg',
                'stock' => 1
            ],
            [
                'name' => 'Nintendo Ds',
                'price' => 40,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://c1.neweggimages.com/ProductImage/68-100-048-09.jpg',
                'stock' => 200
            ],
            [
                'name' => 'Steam Deck',
                'price' => 600,
                'description' => 'Videoconsola Steam',
                'image' => 'https://images.stockx.com/images/Valves-Steam-Deck-512-GB.jpg?fit=fill&bg=FFFFFF&w=1200&h=857&fm=jpg&auto=compress&dpr=2&trim=color&updated_at=1626981525&q=60',
                'stock' => 12
            ],
            [
                'name' => 'Game boy Advance',
                'price' => 300,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxZ5Cb.png',
                'stock' => 3
            ],
            [
                'name' => 'Nintendo 64',
                'price' => 250,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxZscl.jpg',
                'stock' => 1
            ],
            [
                'name' => 'PlayStation Portable',
                'price' => 70,
                'description' => 'Videoconsola Sony',
                'image' => 'https://iili.io/JVxtliG.jpg',
                'stock' => 25
            ],
            [
                'name' => 'Nintendo 3DS',
                'price' => 150,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://m.media-amazon.com/images/I/712J5AHfS0L._AC_UF894,1000_QL80_.jpg',
                'stock' => 15
            ],
            [
                'name' => 'Game Boy Color',
                'price' => 200,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxg97s.jpg',
                'stock' => 20
            ],
            [
                'name' => 'Game Boy',
                'price' => 300,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxg3hl.jpg',
                'stock' => 20
            ],
            [
                'name' => 'Xbox 360',
                'price' => 135,
                'description' => 'Videoconsola Microsoft',
                'image' => 'https://iili.io/JVxgn2e.jpg',
                'stock' => 15
            ],
            [
                'name' => 'Playstation Potal',
                'price' => 220,
                'description' => 'Videoconsola Sony',
                'image' => 'https://iili.io/JVxgtuj.webp',
                'stock' => 100
            ],
            [
                'name' => 'Nintendo 2DS',
                'price' => 140,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxsTTg.jpg',
                'stock' => 40
            ],
            [
                'name' => 'Nintedo NES',
                'price' => 400,
                'description' => 'Videoconsola Nintendo',
                'image' => 'https://iili.io/JVxsVZG.jpg',
                'stock' => 20
            ],
            [
                'name' => 'Sega DreamCast',
                'price' => 300,
                'description' => 'Videoconsola Sega',
                'image' => 'https://iili.io/JVxiV1V.jpg',
                'stock' => 10
            ],
            [
                'name' => 'Sega MegaDrive',
                'price' => 400,
                'description' => 'Videoconsola Sega',
                'image' => 'https://iili.io/JVx4B5u.jpg',
                'stock' => 5
            ]
            
        ];
        Product::insert($products);
    }
}