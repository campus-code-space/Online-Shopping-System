<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('sub_categories')->truncate();
        DB::table('categories')->truncate();

        $categories = [
            'Fruits & Vegetables' => [
                'Fresh Fruits',
                'Fresh Vegetables',
                'Organic Produce',
                'Herbs & Spices',
            ],
            'Dairy & Eggs' => [
                'Milk & Cream',
                'Cheese',
                'Yogurt',
                'Butter & Margarine',
                'Eggs',
            ],
            'Meat & Seafood' => [
                'Fresh Meat',
                'Seafood',
                'Processed Meats',
            ],
            'Bakery & Bread' => [
                'Bread & Rolls',
                'Cakes & Pastries',
                'Cookies & Biscuits',
                'Frozen Bakery',
                'Baking Mixes',
            ],
            'Pantry Staples' => [
                'Rice & Grains',
                'Pasta & Noodles',
                'Canned Goods',
                'Cooking Oils',
                'Spices & Seasonings',
            ],
            'Beverages' => [
                'Water & Sparkling Water',
                'Soft Drinks',
                'Juices',
                'Tea & Coffee',
                'Alcoholic Beverages',
            ],
            'Snacks & Sweets' => [
                'Chips & Crackers',
                'Nuts & Seeds',
                'Candy & Chocolates',
                'Popcorn',
                'Snack Bars',
            ],
            'Frozen Foods' => [
                'Frozen Meals',
                'Frozen Vegetables',
                'Frozen Fruits',
                'Ice Cream & Desserts',
                'Frozen Pizza',
            ],
            'Personal Care & Household' => [
                'Cleaning Supplies',
                'Personal Hygiene',
                'Paper Products',
                'Laundry Supplies',
                'Baby Products',
            ],
            'Health & Wellness' => [
                'Vitamins & Supplements',
                'Protein Powders',
                'Health Foods',
                'Gluten-Free Products',
                'Organic Snacks',
            ],
        ];

        foreach ($categories as $categoryName => $subCategories) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($subCategories as $subCategoryName) {
                DB::table('sub_categories')->insert([
                    'name' => $subCategoryName,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
