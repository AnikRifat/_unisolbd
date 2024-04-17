<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seo>
 */
class SeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'meta_title' => 'Best ecommerce web site',
            'meta_author' => 'minhaz',
            'meta_keyword' => 'vapes',
            'meta_description' => 'eCommerce Product Description SEO. The meta description is a quick description that appears in search engine results beneath your product page title',
            'google_analytics' => 'lets you measure your advertising ROI'
            
        ];
    }
}
