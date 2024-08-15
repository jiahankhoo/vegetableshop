<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\product;
Use App\Models\cart_id;


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
        product::create([
            "id"=>1,
            "p_name"=>"carrot",
            "p_desc"=>"Carrot is a biennial, belonging to the family Apiaceae, and is an important vegetable for its fleshy edible, colorful roots",
            "p_price"=>"12.50",
        ]);
        product::create([
            "id"=>2,
            "p_name"=>"broccoli",
            "p_desc"=>"roccoli (Brassica oleracea var. italica) is an edible green plant in the cabbage family (family Brassicaceae, genus Brassica) whose large flowering head, stalk and small associated leaves are eaten as a vegetable",
            "p_price"=>"10.00",
        ]);
        product::create([
            "id"=>3,
            "p_name"=>"Spinach",
            "p_desc"=>"A leafy green vegetable, high in iron, vitamins A and C, and other essential nutrients. It can be eaten raw in salads or cooked in various dishes, often contributing a mild and slightly sweet flavor",
            "p_price"=>"8.90",
        ]);
        product::create([
            "id"=>4,
            "p_name"=>"Tomato",
            "p_desc"=>"Often mistaken for a vegetable, the tomato is technically a fruit but commonly used as a vegetable in cooking. It's juicy, red when ripe, and packed with lycopene, an antioxidant linked to many health benefits.",
            "p_price"=>"12.50",
        ]);
        product::create([
            "id"=>5,
            "p_name"=>"Cucumber",
            "p_desc"=>"A long, green vegetable with a high water content, making it refreshing and hydrating. It has a mild flavor and is often used in salads, sandwiches, or as a crunchy snack",
            "p_price"=>"12.50",
        ]);
        product::create([
            "id"=>6,
            "p_name"=>"Bell Pepper",
            "p_desc"=>"Also known as sweet pepper, it comes in various colors including green, red, yellow, and orange. Bell peppers are crisp and juicy, rich in vitamins A and C, and add a sweet or slightly bitter taste to dishes",
            "p_price"=>"5.90",
        ]);
        product::create([
            "id"=>7,
            "p_name"=>"Zucchini",
            "p_desc"=>"A type of summer squash with a soft, edible skin. Zucchini is versatile, mild in flavor, and can be grilled, sautéed, or baked. It is low in calories and high in vitamin C, potassium, and fiber",
            "p_price"=>"10.50",
        ]);
        product::create([
            "id"=>8,
            "p_name"=>"Cauliflower",
            "p_desc"=>"A cruciferous vegetable with a compact head made up of undeveloped white flower buds. It has a mild flavor and is rich in fiber, vitamins C and K, and antioxidants. It can be eaten raw or cooked and is often used as a low-carb substitute for grains and legumes",
            "p_price"=>"11.50",
        ]);
        product::create([
            "id"=>9,
            "p_name"=>"Eggplant",
            "p_desc"=>"Also known as aubergine, it has a deep purple skin and soft, spongy flesh. Eggplant is rich in fiber and antioxidants, particularly nasunin, a compound that gives it its purple color. It has a slightly bitter taste when raw but becomes tender and creamy when cooked.
",
            "p_price"=>"20.50",
        ]);
        product::create([
            "id"=>10,
            "p_name"=>"Lettuce",
            "p_desc"=>"A leafy green vegetable commonly used in salads and sandwiches. There are several varieties, such as iceberg, romaine, and butterhead, each with a slightly different texture and flavor. Lettuce is low in calories but high in water content and vitamins A and K.",
            "p_price"=>"3.50",
        ]);
        //cart_id::create([
          //  'cart_id'=>0,
       // ]);
    }
}
