<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorAndProductsSeeder extends Seeder
{
    public function run(): void
    {

        // Create 1 vendor
        $vendorId = DB::table('users')->insertGetId([
            'name' => 'Selam Grocery PLC',
            'email' => 'selam.grocery@example.com',
            'phone_number' => '+251911223344',
            'password' => Hash::make('password123'),
            'role' => 'Vendor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2 products per sub-category
        $products = [
            'Fruits & Vegetables' => [
                'Fresh Fruits' => [
                    ['name' => 'Mama Fresh Mango', 'price' => 150.00, 'stock_quantity' => 100, 'description' => 'Juicy Ethiopian mangoes from local farms.', 'product_image' => 'products/mango.jpg'],
                    ['name' => 'Awash Oranges', 'price' => 120.00, 'stock_quantity' => 80, 'description' => 'Sweet oranges grown in Awash region.', 'product_image' => 'products/oranges.jpg'],
                ],
                'Fresh Vegetables' => [
                    ['name' => 'Ethiopian Kale (Gomen)', 'price' => 50.00, 'stock_quantity' => 200, 'description' => 'Fresh kale for traditional Ethiopian dishes.', 'product_image' => 'products/kale.jpg'],
                    ['name' => 'Local Tomatoes', 'price' => 60.00, 'stock_quantity' => 150, 'description' => 'Ripe tomatoes from Arsi farms.', 'product_image' => 'products/tomatoes.jpg'],
                ],
                'Organic Produce' => [
                    ['name' => 'Organic Avocado', 'price' => 80.00, 'stock_quantity' => 90, 'description' => 'Organic avocados from Sidama.', 'product_image' => 'products/avocado.jpg'],
                    ['name' => 'Organic Carrots', 'price' => 70.00, 'stock_quantity' => 120, 'description' => 'Fresh organic carrots from local farms.', 'product_image' => 'products/carrots.jpg'],
                ],
                'Herbs & Spices' => [
                    ['name' => 'Berbere Spice Mix', 'price' => 100.00, 'stock_quantity' => 50, 'description' => 'Authentic Ethiopian berbere spice blend.', 'product_image' => 'products/berbere.jpg'],
                    ['name' => 'Mitmita Spice', 'price' => 90.00, 'stock_quantity' => 60, 'description' => 'Spicy Ethiopian mitmita for seasoning.', 'product_image' => 'products/mitmita.jpg'],
                ],
            ],
            'Dairy & Eggs' => [
                'Milk & Cream' => [
                    ['name' => 'Shola Milk', 'price' => 60.00, 'stock_quantity' => 200, 'description' => 'Fresh pasteurized milk from Shola Dairy.', 'product_image' => 'products/milk.jpg'],
                    ['name' => 'Mama Fresh Cream', 'price' => 120.00, 'stock_quantity' => 80, 'description' => 'Rich cream for cooking and desserts.', 'product_image' => 'products/cream.jpg'],
                ],
                'Cheese' => [
                    ['name' => 'Ethiopian Ayib Cheese', 'price' => 150.00, 'stock_quantity' => 60, 'description' => 'Traditional Ethiopian cottage cheese.', 'product_image' => 'products/ayib.jpg'],
                    ['name' => 'Selam Gouda Cheese', 'price' => 200.00, 'stock_quantity' => 50, 'description' => 'Locally produced gouda cheese.', 'product_image' => 'products/gouda.jpg'],
                ],
                'Yogurt' => [
                    ['name' => 'Mama Fresh Yogurt', 'price' => 80.00, 'stock_quantity' => 100, 'description' => 'Creamy yogurt from local farms.', 'product_image' => 'products/yogurt.jpg'],
                    ['name' => 'Natural Probiotic Yogurt', 'price' => 90.00, 'stock_quantity' => 90, 'description' => 'Probiotic-rich yogurt.', 'product_image' => 'products/probiotic_yogurt.jpg'],
                ],
                'Butter & Margarine' => [
                    ['name' => 'Kibe (Spiced Butter)', 'price' => 180.00, 'stock_quantity' => 70, 'description' => 'Traditional Ethiopian spiced butter.', 'product_image' => 'products/kibe.jpg'],
                    ['name' => 'Selam Margarine', 'price' => 100.00, 'stock_quantity' => 80, 'description' => 'Vegetable-based margarine.', 'product_image' => 'products/margarine.jpg'],
                ],
                'Eggs' => [
                    ['name' => 'Farm-Fresh Eggs (12)', 'price' => 90.00, 'stock_quantity' => 200, 'description' => 'Fresh eggs from local poultry farms.', 'product_image' => 'products/eggs.jpg'],
                    ['name' => 'Organic Free-Range Eggs (12)', 'price' => 120.00, 'stock_quantity' => 150, 'description' => 'Organic eggs from free-range chickens.', 'product_image' => 'products/organic_eggs.jpg'],
                ],
            ],
            'Meat & Seafood' => [
                'Fresh Meat' => [
                    ['name' => 'Ethiopian Beef Tibs', 'price' => 300.00, 'stock_quantity' => 50, 'description' => 'Fresh beef cuts for tibs.', 'product_image' => 'products/beef_tibs.jpg'],
                    ['name' => 'Local Lamb Chops', 'price' => 350.00, 'stock_quantity' => 40, 'description' => 'Tender lamb chops from local farms.', 'product_image' => 'products/lamb_chops.jpg'],
                ],
                'Seafood' => [
                    ['name' => 'Nile Perch Fillet', 'price' => 400.00, 'stock_quantity' => 30, 'description' => 'Fresh Nile perch from Lake Tana.', 'product_image' => 'products/nile_perch.jpg'],
                    ['name' => 'Tilapia Fillet', 'price' => 350.00, 'stock_quantity' => 35, 'description' => 'Fresh tilapia from Ethiopian lakes.', 'product_image' => 'products/tilapia.jpg'],
                ],
                'Processed Meats' => [
                    ['name' => 'Awash Sausages', 'price' => 200.00, 'stock_quantity' => 60, 'description' => 'Spiced sausages from Awash Foods.', 'product_image' => 'products/sausages.jpg'],
                    ['name' => 'Ethiopian Beef Jerky', 'price' => 250.00, 'stock_quantity' => 50, 'description' => 'Traditional dried beef strips.', 'product_image' => 'products/beef_jerky.jpg'],
                ],
            ],
            'Bakery & Bread' => [
                'Bread & Rolls' => [
                    ['name' => 'Difo Dabo (Ethiopian Bread)', 'price' => 50.00, 'stock_quantity' => 100, 'description' => 'Traditional Ethiopian homemade bread.', 'product_image' => 'products/difo_dabo.jpg'],
                    ['name' => 'Ambasha Bread', 'price' => 60.00, 'stock_quantity' => 90, 'description' => 'Spiced Ethiopian flatbread.', 'product_image' => 'products/ambasha.jpg'],
                ],
                'Cakes & Pastries' => [
                    ['name' => 'Selam Chocolate Cake', 'price' => 300.00, 'stock_quantity' => 20, 'description' => 'Rich chocolate cake by Selam Bakery.', 'product_image' => 'products/chocolate_cake.jpg'],
                    ['name' => 'Honey Pastry', 'price' => 150.00, 'stock_quantity' => 30, 'description' => 'Traditional Ethiopian honey pastry.', 'product_image' => 'products/honey_pastry.jpg'],
                ],
                'Cookies & Biscuits' => [
                    ['name' => 'Mama Fresh Biscuits', 'price' => 80.00, 'stock_quantity' => 80, 'description' => 'Crispy biscuits from Mama Fresh.', 'product_image' => 'products/biscuits.jpg'],
                    ['name' => 'Oat Cookies', 'price' => 90.00, 'stock_quantity' => 70, 'description' => 'Healthy oat cookies.', 'product_image' => 'products/oat_cookies.jpg'],
                ],
                'Frozen Bakery' => [
                    ['name' => 'Frozen Injera', 'price' => 120.00, 'stock_quantity' => 50, 'description' => 'Frozen teff injera for convenience.', 'product_image' => 'products/injera.jpg'],
                    ['name' => 'Frozen Croissants', 'price' => 150.00, 'stock_quantity' => 40, 'description' => 'Ready-to-bake croissants.', 'product_image' => 'products/croissants.jpg'],
                ],
                'Baking Mixes' => [
                    ['name' => 'Teff Flour Mix', 'price' => 100.00,'stock_quantity' => 60, 'description' => 'Teff flour for injera preparation.', 'product_image' => 'products/teff_flour.jpg'],
                    ['name' => 'Pancake Mix', 'price' => 80.00, 'stock_quantity' => 70, 'description' => 'Easy-to-use pancake mix.', 'product_image' => 'products/pancake_mix.jpg'],
                ],
            ],
            'Pantry Staples' => [
                'Rice & Grains' => [
                    ['name' => 'Ethiopian Teff Grain', 'price' => 150.00, 'stock_quantity' => 100, 'description' => 'High-quality teff for injera.', 'product_image' => 'products/teff_grain.jpg'],
                    ['name' => 'Basmati Rice', 'price' => 120.00, 'stock_quantity' => 90, 'description' => 'Premium basmati rice.', 'product_image' => 'products/basmati_rice.jpg'],
                ],
                'Pasta & Noodles' => [
                    ['name' => 'Selam Spaghetti', 'price' => 70.00, 'stock_quantity' => 80, 'description' => 'Locally produced spaghetti.', 'product_image' => 'products/spaghetti.jpg'],
                    ['name' => 'Instant Noodles', 'price' => 50.00, 'stock_quantity' => 100, 'description' => 'Quick-cook noodles.', 'product_image' => 'products/noodles.jpg'],
                ],
                'Canned Goods' => [
                    ['name' => 'Canned Shiro', 'price' => 90.00, 'stock_quantity' => 70, 'description' => 'Ethiopian shiro powder in cans.', 'product_image' => 'products/shiro.jpg'],
                    ['name' => 'Canned Tomatoes', 'price' => 60.00, 'stock_quantity' => 80, 'description' => 'Canned tomatoes for sauces.', 'product_image' => 'products/canned_tomatoes.jpg'],
                ],
                'Cooking Oils' => [
                    ['name' => 'Niger Seed Oil', 'price' => 200.00, 'stock_quantity' => 50, 'description' => 'Traditional Ethiopian cooking oil.', 'product_image' => 'products/niger_oil.jpg'],
                    ['name' => 'Sunflower Oil', 'price' => 180.00, 'stock_quantity' => 60, 'description' => 'Pure sunflower oil.', 'product_image' => 'products/sunflower_oil.jpg'],
                ],
                'Spices & Seasonings' => [
                    ['name' => 'Awash Berbere', 'price' => 100.00, 'stock_quantity' => 70, 'description' => 'Spicy Ethiopian berbere blend.', 'product_image' => 'products/berbere.jpg'],
                    ['name' => 'Mitmita Seasoning', 'price' => 90.00, 'stock_quantity' => 60, 'description' => 'Hot mitmita spice mix.', 'product_image' => 'products/mitmita.jpg'],
                ],
            ],
            'Beverages' => [
                'Water & Sparkling Water' => [
                    ['name' => 'Highland Spring Water', 'price' => 30.00, 'stock_quantity' => 200, 'description' => 'Pure Ethiopian spring water.', 'product_image' => 'products/highland_water.jpg'],
                    ['name' => 'Ambo Sparkling Water', 'price' => 40.00, 'stock_quantity' => 150, 'description' => 'Carbonated mineral water.', 'product_image' => 'products/ambo_water.jpg'],
                ],
                'Soft Drinks' => [
                    ['name' => 'Mirinda Orange', 'price' => 35.00, 'stock_quantity' => 100, 'description' => 'Refreshing orange soft drink.', 'product_image' => 'products/mirinda.jpg'],
                    ['name' => 'Pepsi Cola', 'price' => 35.00, 'stock_quantity' => 100, 'description' => 'Classic cola drink.', 'product_image' => 'products/pepsi.jpg'],
                ],
                'Juices' => [
                    ['name' => 'Awash Mango Juice', 'price' => 50.00, 'stock_quantity' => 80, 'description' => 'Pure mango juice from Awash.', 'product_image' => 'products/mango_juice.jpg'],
                    ['name' => 'Guava Juice', 'price' => 50.00, 'stock_quantity' => 80, 'description' => 'Natural guava juice.', 'product_image' => 'products/guava_juice.jpg'],
                ],
                'Tea & Coffee' => [
                    ['name' => 'Ethiopian Yirgacheffe Coffee', 'price' => 200.00, 'stock_quantity' => 50, 'description' => 'Premium coffee beans from Yirgacheffe.', 'product_image' => 'products/yirgacheffe.jpg'],
                    ['name' => 'Selam Black Tea', 'price' => 80.00, 'stock_quantity' => 70, 'description' => 'Aromatic black tea.', 'product_image' => 'products/black_tea.jpg'],
                ],
                'Alcoholic Beverages' => [
                    ['name' => 'St. George Beer', 'price' => 50.00, 'stock_quantity' => 100, 'description' => 'Popular Ethiopian beer.', 'product_image' => 'products/st_george_beer.jpg'],
                    ['name' => 'Tej (Honey Wine)', 'price' => 150.00, 'stock_quantity' => 40, 'description' => 'Traditional Ethiopian honey wine.', 'product_image' => 'products/tej.jpg'],
                ],
            ],
            'Snacks & Sweets' => [
                'Chips & Crackers' => [
                    ['name' => 'Mama Fresh Potato Chips', 'price' => 50.00, 'stock_quantity' => 80, 'description' => 'Crispy potato chips.', 'product_image' => 'products/potato_chips.jpg'],
                    ['name' => 'Spiced Crackers', 'price' => 40.00, 'stock_quantity' => 90, 'description' => 'Spicy Ethiopian crackers.', 'product_image' => 'products/crackers.jpg'],
                ],
                'Nuts & Seeds' => [
                    ['name' => 'Roasted Kolo', 'price' => 70.00, 'stock_quantity' => 100, 'description' => 'Traditional Ethiopian roasted barley snack.', 'product_image' => 'products/kolo.jpg'],
                    ['name' => 'Sunflower Seeds', 'price' => 60.00, 'stock_quantity' => 90, 'description' => 'Roasted sunflower seeds.', 'product_image' => 'products/sunflower_seeds.jpg'],
                ],
                'Candy & Chocolates' => [
                    ['name' => 'Selam Milk Chocolate', 'price' => 80.00, 'stock_quantity' => 70, 'description' => 'Creamy milk chocolate.', 'product_image' => 'products/milk_chocolate.jpg'],
                    ['name' => 'Hard Candy Mix', 'price' => 50.00, 'stock_quantity' => 80, 'description' => 'Assorted fruit-flavored candies.', 'product_image' => 'products/hard_candy.jpg'],
                ],
                'Popcorn' => [
                    ['name' => 'Ethiopian Popcorn', 'price' => 40.00, 'stock_quantity' => 100, 'description' => 'Lightly salted popcorn.', 'product_image' => 'products/popcorn.jpg'],
                    ['name' => 'Caramel Popcorn', 'price' => 50.00, 'stock_quantity' => 80, 'description' => 'Sweet caramel-coated popcorn.', 'product_image' => 'products/caramel_popcorn.jpg'],
                ],
                'Snack Bars' => [
                    ['name' => 'Teff Energy Bar', 'price' => 60.00, 'stock_quantity' => 70, 'description' => 'Nutritious teff-based energy bar.', 'product_image' => 'products/teff_bar.jpg'],
                    ['name' => 'Honey Nut Bar', 'price' => 65.00, 'stock_quantity' => 60, 'description' => 'Honey and nut snack bar.', 'product_image' => 'products/honey_nut_bar.jpg'],
                ],
            ],
            'Frozen Foods' => [
                'Frozen Meals' => [
                    ['name' => 'Frozen Doro Wat', 'price' => 200.00, 'stock_quantity' => 50, 'description' => 'Pre-cooked Ethiopian chicken stew.', 'product_image' => 'products/doro_wat.jpg'],
                    ['name' => 'Frozen Misir Wat', 'price' => 150.00, 'stock_quantity' => 60, 'description' => 'Frozen lentil stew.', 'product_image' => 'products/misir_wat.jpg'],
                ],
                'Frozen Vegetables' => [
                    ['name' => 'Frozen Gomen', 'price' => 80.00, 'stock_quantity' => 70, 'description' => 'Frozen Ethiopian kale.', 'product_image' => 'products/frozen_gomen.jpg'],
                    ['name' => 'Frozen Mixed Vegetables', 'price' => 90.00, 'stock_quantity' => 60, 'description' => 'Mixed frozen vegetables.', 'product_image' => 'products/mixed_vegetables.jpg'],
                ],
                'Frozen Fruits' => [
                    ['name' => 'Frozen Mango Chunks', 'price' => 100.00, 'stock_quantity' => 50, 'description' => 'Frozen mango pieces.', 'product_image' => 'products/frozen_mango.jpg'],
                    ['name' => 'Frozen Strawberries', 'price' => 120.00, 'stock_quantity' => 40, 'description' => 'Frozen strawberries for smoothies.', 'product_image' => 'products/frozen_strawberries.jpg'],
                ],
                'Ice Cream & Desserts' => [
                    ['name' => 'Mama Fresh Vanilla Ice Cream', 'price' => 150.00, 'stock_quantity' => 50, 'description' => 'Creamy vanilla ice cream.', 'product_image' => 'products/vanilla_ice_cream.jpg'],
                    ['name' => 'Chocolate Dessert', 'price' => 160.00, 'stock_quantity' => 40, 'description' => 'Frozen chocolate dessert.', 'product_image' => 'products/chocolate_dessert.jpg'],
                ],
                'Frozen Pizza' => [
                    ['name' => 'Veggie Pizza', 'price' => 200.00, 'stock_quantity' => 30, 'description' => 'Frozen vegetable pizza.', 'product_image' => 'products/veggie_pizza.jpg'],
                    ['name' => 'Spicy Pizza', 'price' => 220.00, 'stock_quantity' => 30, 'description' => 'Frozen pizza with berbere spices.', 'product_image' => 'products/spicy_pizza.jpg'],
                ],
            ],
            'Personal Care & Household' => [
                'Cleaning Supplies' => [
                    ['name' => 'Selam Dish Soap', 'price' => 80.00, 'stock_quantity' => 100, 'description' => 'Effective dishwashing soap.', 'product_image' => 'products/dish_soap.jpg'],
                    ['name' => 'Floor Cleaner', 'price' => 90.00, 'stock_quantity' => 80, 'description' => 'Multi-surface floor cleaner.', 'product_image' => 'products/floor_cleaner.jpg'],
                ],
                'Personal Hygiene' => [
                    ['name' => 'Ethiopian Soap Bar', 'price' => 50.00, 'stock_quantity' => 100, 'description' => 'Natural soap with local herbs.', 'product_image' => 'products/soap_bar.jpg'],
                    ['name' => 'Shampoo', 'price' => 120.00, 'stock_quantity' => 70, 'description' => 'Gentle shampoo for daily use.', 'product_image' => 'products/shampoo.jpg'],
                ],
                'Paper Products' => [
                    ['name' => 'Toilet Paper (4 Rolls)', 'price' => 80.00, 'stock_quantity' => 100, 'description' => 'Soft toilet paper rolls.', 'product_image' => 'products/toilet_paper.jpg'],
                    ['name' => 'Paper Towels', 'price' => 90.00, 'stock_quantity' => 80, 'description' => 'Absorbent paper towels.', 'product_image' => 'products/paper_towels.jpg'],
                ],
                'Laundry Supplies' => [
                    ['name' => 'Selam Detergent', 'price' => 150.00, 'stock_quantity' => 60, 'description' => 'Powerful laundry detergent.', 'product_image' => 'products/detergent.jpg'],
                    ['name' => 'Fabric Softener', 'price' => 100.00, 'stock_quantity' => 70, 'description' => 'Softens and freshens clothes.', 'product_image' => 'products/fabric_softener.jpg'],
                ],
                'Baby Products' => [
                    ['name' => 'Baby Diapers', 'price' => 200.00, 'stock_quantity' => 50, 'description' => 'Comfortable baby diapers.', 'product_image' => 'products/diapers.jpg'],
                    ['name' => 'Baby Wipes', 'price' => 80.00, 'stock_quantity' => 80, 'description' => 'Gentle baby wipes.', 'product_image' => 'products/baby_wipes.jpg'],
                ],
            ],
            'Health & Wellness' => [
                'Vitamins & Supplements' => [
                    ['name' => 'Vitamin C Tablets', 'price' => 150.00, 'stock_quantity' => 50, 'description' => 'Immune-boosting vitamin C.', 'product_image' => 'products/vitamin_c.jpg'],
                    ['name' => 'Multivitamin Capsules', 'price' => 200.00, 'stock_quantity' => 40, 'description' => 'Daily multivitamin supplement.', 'product_image' => 'products/multivitamin.jpg'],
                ],
                'Protein Powders' => [
                    ['name' => 'Teff Protein Powder', 'price' => 250.00, 'stock_quantity' => 30, 'description' => 'Ethiopian teff-based protein powder.', 'product_image' => 'products/teff_protein.jpg'],
                    ['name' => 'Whey Protein', 'price' => 300.00, 'stock_quantity' => 25, 'description' => 'High-quality whey protein.', 'product_image' => 'products/whey_protein.jpg'],
                ],
                'Health Foods' => [
                    ['name' => 'Chia Seeds', 'price' => 120.00, 'stock_quantity' => 60, 'description' => 'Nutritious chia seeds.', 'product_image' => 'products/chia_seeds.jpg'],
                    ['name' => 'Quinoa', 'price' => 150.00, 'stock_quantity' => 50, 'description' => 'Healthy quinoa grains.', 'product_image' => 'products/quinoa.jpg'],
                ],
                'Gluten-Free Products' => [
                    ['name' => 'Gluten-Free Teff Flour', 'price' => 130.00, 'stock_quantity' => 60, 'description' => 'Gluten-free teff flour for baking.', 'product_image' => 'products/gluten_free_teff.jpg'],
                    ['name' => 'Gluten-Free Pasta', 'price' => 100.00, 'stock_quantity' => 70, 'description' => 'Gluten-free pasta.', 'product_image' => 'products/gluten_free_pasta.jpg'],
                ],
                'Organic Snacks' => [
                    ['name' => 'Organic Kolo Snack', 'price' => 80.00, 'stock_quantity' => 80, 'description' => 'Organic roasted barley snack.', 'product_image' => 'products/organic_kolo.jpg'],
                    ['name' => 'Organic Dried Fruit Mix', 'price' => 100.00, 'stock_quantity' => 70, 'description' => 'Mix of organic dried fruits.', 'product_image' => 'products/dried_fruit.jpg'],
                ],
            ],
        ];

        
        foreach ($products as $categoryName => $subCategories) {
            $category = DB::table('categories')->where('name', $categoryName)->first();
            if (!$category) {
                continue; // Skip if category not found
            }

            foreach ($subCategories as $subCategoryName => $items) {
                $subCategory = DB::table('sub_categories')
                    ->where('name', $subCategoryName)
                    ->where('category_id', $category->id)
                    ->first();

                if (!$subCategory) {
                    continue; 
                }

                foreach ($items as $item) {
                    $price = $item['price'];
                    $discount = rand(0, 1) ? rand(5, 20) : null; // Randomly apply discount
                    $final_price = $discount ? $price - $discount : $price;

                    DB::table('products')->insert([
                        'name' => $item['name'],
                        'product_image' => $item['product_image'],
                        'price' => $price,
                        'stock_quantity' => $item['stock_quantity'],
                        'expire_date' => now()->addMonths(rand(3, 12)),
                        'discount' => $discount,
                        'final_price' => $final_price,
                        'description' => $item['description'],
                        'sold' => false,
                        'vendor_id' => $vendorId,
                        'sub_category_id' => $subCategory->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}