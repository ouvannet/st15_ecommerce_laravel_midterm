<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Clothing', 'slug' => 'clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Books', 'slug' => 'books', 'description' => 'Books and literature'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'description' => 'Home and garden products'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);

            // Create products for each category with images
            $products = [
                'Electronics' => [
                    ['name' => 'iPhone 15 Pro', 'price' => 999.99, 'stock' => 50, 'image' => 'https://www.icomroma.com/vendita/wp-content/uploads/2023/10/titanio-nero-600x600.jpg'],
                    ['name' => 'MacBook Pro M3', 'price' => 1999.99, 'stock' => 25, 'image' => 'https://s3.ap-southeast-1.amazonaws.com/uploads-store/uploads/all/hv3GqmpMV4beMd5zloQruplspg4UhxUToGMVmqF9.png'],
                    ['name' => 'AirPods Pro', 'price' => 249.99, 'stock' => 100, 'image' => 'https://crdms.images.consumerreports.org/f_auto,w_600/prod/products/cr/models/411891-noise-canceling-headphones-apple-airpods-pro-2nd-generation-with-magsafe-case-usb-c-10036575.png'],
                    ['name' => 'iPad Air', 'price' => 599.99, 'stock' => 30, 'image' => 'https://media.ldlc.com/r705/ld/products/00/06/13/36/LD0006133652.jpg'],
                    ['name' => 'Samsung Galaxy S24', 'price' => 899.99, 'stock' => 45, 'image' => 'https://gadgetbd.com/wp-content/uploads/2024/01/Samsung-S24-Ultra-Titanium-Grey.jpg'],
                    ['name' => 'Sony WH-1000XM5', 'price' => 399.99, 'stock' => 60, 'image' => 'https://angkormeas.com/wp-content/uploads/2024/05/sony-WH-1000XM5-white.jpg?v=1748162272'],
                ],
                'Clothing' => [
                    ['name' => 'Premium Cotton T-Shirt', 'price' => 29.99, 'stock' => 200, 'image' => 'https://ogfightwear.com/cdn/shop/files/Classic.Cotton.TShirt_Black.2_ce33e34e-53e7-4454-8de6-e7ca83cf343b.jpg?v=1690387619&width=1445'],
                    ['name' => 'Designer Jeans', 'price' => 89.99, 'stock' => 150, 'image' => 'https://cdn11.bigcommerce.com/s-rokk2/images/stencil/500x659/products/19766/94597/1745952451.1280.1280__68354.1746286276.jpg?c=2'],
                    ['name' => 'Running Sneakers', 'price' => 129.99, 'stock' => 75, 'image' => 'https://en-ae.sssports.com/dw/image/v2/BDVB_PRD/on/demandware.static/-/Sites-akeneo-master-catalog/default/dw50fa7498/sss/SSS2/N/K/F/D/6/SSS2_NKFD6033_001_197597074559_2.jpg?sw=700&sh=700&sm=fit'],
                    ['name' => 'Winter Jacket', 'price' => 199.99, 'stock' => 60, 'image' => 'https://images-eu.ssl-images-amazon.com/images/I/71Si0pcROzL._AC_UL600_SR600,600_.jpg'],
                    ['name' => 'Casual Dress', 'price' => 79.99, 'stock' => 80, 'image' => 'https://i5.walmartimages.com/seo/Clearance-Kids-Clothes-Girls-Dresses-Size-10-12-Casual-Pink-Dress-Casual-Crew-Neck-Casual-Flowy-Swing-Tween-Sundress-Pockets-Tea-Party-Dresses-Birthd_6092f35d-a2d8-400c-aaa1-cfc43ea72434.d022fcad9b3d341dfdbdf1a7240c332a.jpeg?odnHeight=320&odnWidth=320&odnBg=FFFFFF'],
                    ['name' => 'Leather Boots', 'price' => 159.99, 'stock' => 40, 'image' => 'https://www.conalfootwear.com/cdn/shop/files/WRIGHT-MPX806067A-SIENNA-BROWN07.jpg?v=1691448819&width=1800'],
                ],
                'Books' => [
                    ['name' => 'JavaScript: The Complete Guide', 'price' => 49.99, 'stock' => 80, 'image' => 'https://m.media-amazon.com/images/I/91hUer84PpL.jpg'],
                    ['name' => 'The Great Gatsby', 'price' => 19.99, 'stock' => 120, 'image' => 'https://www.madejacksonhole.com/cdn/shop/files/The-Great-Gatsby-Graphic-Image.jpg?v=1731697755'],
                    ['name' => 'Master Chef Cookbook', 'price' => 34.99, 'stock' => 90, 'image' => 'https://images.squarespace-cdn.com/content/v1/61fd45a3516c797174f2ab23/1649019609573-8LFZI9MQO9UQKDA9D2CB/cookbook%2B%281%29.png'],
                    ['name' => 'Steve Jobs Biography', 'price' => 24.99, 'stock' => 70, 'image' => 'https://gyaanstore.com/cdn/shop/files/stevejobs.png?v=1702833351'],
                    ['name' => 'Learn Python Programming', 'price' => 39.99, 'stock' => 65, 'image' => 'https://cdn.penguin.co.in/wp-content/uploads/2024/01/9781718502086-scaled.jpg'],
                    ['name' => 'Art of War', 'price' => 16.99, 'stock' => 95, 'image' => 'https://bookholics.lk/wp-content/uploads/2024/05/The-Art-of-War.jpg'],
                ],
                'Home & Garden' => [
                    ['name' => 'Ceramic Plant Pot', 'price' => 25.99, 'stock' => 300, 'image' => 'https://m.media-amazon.com/images/I/81+kQPBFJzL.jpg'],
                    ['name' => 'Professional Garden Tools Set', 'price' => 89.99, 'stock' => 40, 'image' => 'https://images.thdstatic.com/productImages/2de4433d-dd02-4246-b4c4-8a47ddcd249e/svn/black-garden-tool-sets-b0bjk1fhsq-64_1000.jpg'],
                    ['name' => 'Modern Table Lamp', 'price' => 79.99, 'stock' => 85, 'image' => 'https://www.tiffanylightingdirect.co.uk/cdn/shop/products/06E5F552-9DE7-8249-AFEF-5D95CC3F0B20.jpg?v=1744853794'],
                    ['name' => 'Luxury Throw Pillow', 'price' => 34.99, 'stock' => 150, 'image' => 'https://margecarson.com/cdn/shop/files/ALCHEMY-GOLD-22-INCH-PATTERNED-PILLOW-MP-141.png?v=1708549574'],
                    ['name' => 'Outdoor Furniture Set', 'price' => 599.99, 'stock' => 20, 'image' => 'https://hips.hearstapps.com/hmg-prod/images/aecojoy-aluminum-outdoor-furniture-set-7-pieces-sectional-sofa-patio-conversation-set-light-gray-7fbd049b-f4a2-45ce-a3ca-3a82342ff9b9-a051191a21da4011145664383c95aae5.jpeg?crop=1.00xw:1.00xh;0,0&resize=1200:*'],
                    ['name' => 'Smart Home Thermostat', 'price' => 249.99, 'stock' => 55, 'image' => 'https://m.media-amazon.com/images/I/71CznSVO40L._UF1000,1000_QL80_.jpg'],
                ],
            ];

            if (isset($products[$category->name])) {
                foreach ($products[$category->name] as $productData) {
                    Product::create([
                        'name' => $productData['name'],
                        'slug' => \Str::slug($productData['name']),
                        'description' => 'High-quality ' . strtolower($productData['name']) . ' with excellent features and durability. Perfect for everyday use with premium materials and modern design.',
                        'price' => $productData['price'],
                        'stock' => $productData['stock'],
                        'image' => $productData['image'],
                        'category_id' => $category->id,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
