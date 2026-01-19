<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // まずカテゴリの固定データを投入
        $this->call([
            CategorySeeder::class,
        ]);

        // 次に contacts テーブルにダミーデータを35件作成
        \App\Models\Contact::factory(35)->create();
    }
}
