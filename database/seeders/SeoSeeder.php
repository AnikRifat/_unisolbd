<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seo = [
            'meta_title' => 'Best ecommerce web site',
            'meta_author' => 'minhaz',
            'meta_keyword' => 'vapes',
            'meta_description' => 'eCommerce Product Description SEO. The meta description is a quick description that appears in search engine results beneath your product page title',
            'google_analytics' => 'lets you measure your advertising ROI',

        ];
        Seo::insert($seo);

    }
}
