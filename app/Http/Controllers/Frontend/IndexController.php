<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class IndexController extends Controller
{
    public function Index()
    {
        $categories = Category::Where('status', 1)->orderBy('category_name', 'ASC')->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        // Filter the cached products to get featured products
        $featured = Product::with('category', 'subcategory', 'subsubcategory')->where('featured', 1)->inRandomOrder()->limit(30)->get();

        return view('frontend.index', compact('categories', 'featured', 'currency'));
    }

    public function storageCalc()
    {

        return view('frontend.quotationbuilder.storage_calculator');

    }

    public function UserLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::id();
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {
        if ($request->file('profile_photo_path')) {
            @unlink(public_path($request->old_image));
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/user_images/'.$name_gen);
            $save_url = 'upload/user_images/'.$name_gen;

            User::findOrFail(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_photo_path' => $save_url,
            ]);

            return redirect()->route('dashboard');
        } else {
            User::findOrFail(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return redirect()->route('dashboard');
        }
    }

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserUpdatePassword(Request $request)
    {

        $validatedata = $request->validate([
            'current password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        $hashedPassword = User::find($id)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
        }
    }

    public function ProductDetails($slug, $product_id)
    {
        $id = decrypt($product_id);
        $product = Product::findOrFail($id);

        $saleController = new SaleController();
        $stock = $saleController->getStock($id);

        if ($product->subsubcategory_id !== null) {
            $relatedproduct = Product::where('subsubcategory_id', $product->subsubcategory_id)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        } elseif ($product->subcategory_id !== null) {
            $relatedproduct = Product::where('subcategory_id', $product->subcategory_id)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        } else {
            $relatedproduct = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }

        // $relatedproduct now contains the related products from the cached data
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $multiImg = MultiImg::where('product_id', $id)->get();

        return view('frontend.product.product_details', compact('product', 'multiImg', 'relatedproduct', 'currency', 'stock'));
    }

    public function TagWiseProduct($tag)
    {
        $products = Product::where('status', 1)->where('product_tags', $tag)->where('product_tags', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }

    public function CategoryWiseProduct($slug, $category_id)
    {
        $id = decrypt($category_id);
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();

        $CategoryWiseProducts = Product::where('category_id', $id)->get();

        $CategoryWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.category_view', compact('CategoryWiseProducts', 'currency', 'latest_products'));
    }

    public function CategoryBrandWiseProduct($category_slug, $category_id, $brand_id)
    {
        // return [$category_id,$brand_id,$category_slug];

        $categoryId = decrypt($category_id);
        $brandId = base64_decode($brand_id); // Use base64_decode() instead of 64_decode()
        $brand = Brand::findOrFail($brandId);
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();

        $CategoryBrandWiseProducts = Product::where('status', 1)
            ->where('category_id', $categoryId)
            ->where('brand_id', $brandId)
            ->get();

        $CategoryBrandWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.category_brand_wise_product', compact('CategoryBrandWiseProducts', 'brand', 'currency', 'latest_products'));
    }

    public function SubCategoryWiseProduct($slug, $subcategory_id)
    {
        $id = decrypt($subcategory_id);
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $SubCategoryWiseProducts = Product::where('subcategory_id', $id)->get();
        $SubCategoryWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.subcategory_view', compact('SubCategoryWiseProducts', 'currency', 'latest_products'));
    }

    public function SubCategoryBrandWiseProduct($subcategory_slug, $subcategory_id, $brand_id)
    {
        $subCategoryId = decrypt($subcategory_id);
        $brandId = base64_decode($brand_id); // Use base64_decode() instead of 64_decode()
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $brand = Brand::findOrFail($brandId);
        $SubcategoryBrandWiseProducts = Product::where('status', 1)
            ->where('subcategory_id', $subCategoryId)
            ->where('brand_id', $brandId)
            ->get();
        $SubcategoryBrandWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.subcategory_brand_wise_product', compact('SubcategoryBrandWiseProducts', 'brand', 'currency', 'latest_products'));
    }

    public function SubSubCatWiseProduct($slug, $subsubcategory_id)
    {
        // return $subsubcategory_id;
        $id = decrypt($subsubcategory_id);
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $SubSubCategoryWiseProducts = Product::where('subsubcategory_id', $id)->get();
        $SubSubCategoryWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.subsubcategory_view', compact('SubSubCategoryWiseProducts', 'currency', 'latest_products'));
    }

    public function SubSubCategoryBrandWiseProduct($subsubcategory_slug, $subsubcategory_id, $brand_id)
    {

        $subSubCategoryId = decrypt($subsubcategory_id);
        $brandId = base64_decode($brand_id); // Use base64_decode() instead of 64_decode()
        $latest_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(7)->get();
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $brand = Brand::findOrFail($brandId);
        $SubsubcategoryBrandWiseProducts = Product::where('status', 1)
            ->where('subsubcategory_id', $subSubCategoryId)
            ->where('brand_id', $brandId)
            ->get();
        $SubsubcategoryBrandWiseProducts->map(function ($product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID

            return $product;
        });

        return view('frontend.product.subsubcategory_brand_wise_product', compact('SubsubcategoryBrandWiseProducts', 'brand', 'currency', 'latest_products'));
    }

    public function ProductViewAjax($id)
    {

        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $flavour = $product->product_flavour;
        $product_flavour = explode(',', $flavour);

        return response()->json([
            'currency' => $currency,
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
            'flavour' => $product_flavour,

        ]);
    }

    //      public function ProductSearch(Request $request) {
    //       $userInput = $request->input('user_input');

    //       // Use Laravel Scout to search products based on user input
    //       $products = Product::search($userInput)->take(5)->get();

    //       $availableTags = [];

    //       foreach ($products as $product) {
    //           // Create an array for each product with relevant data
    //           $productData = [
    //               'label' => $product->product_name,
    //               'image' => $product->product_thambnail, // Replace with actual thumbnail URL
    //               'price' => '$' . $product->selling_price, // Adjust price formatting if needed
    //               // You can add more data fields here if needed
    //           ];

    //           $availableTags[] = $productData; // Add the product data to the availableTags array
    //       }

    //       return response()->json($availableTags);
    //   }

    // Controller method for product search using cached data
    public function ProductSearch(Request $request)
    {
        $userInput = $request->input('user_input');

        // Retrieve all products from cache
        $allProducts = Cache::get('all_products', []);

        // Filter products based on user input
        $filteredProducts = collect($allProducts)->filter(function ($product) use ($userInput) {
            return strpos(strtolower($product->product_name), strtolower($userInput)) !== false;
        })->take(5);

        $availableTags = [];

        foreach ($filteredProducts as $product) {
            $productData = [
                'label' => $product->product_name,
                'image' => $product->product_thambnail,
                'price' => '$'.$product->selling_price,
            ];
            $availableTags[] = $productData;
        }

        return response()->json($availableTags);
    }

    // public function AllSearchResult()
    // {
    //    $searchTerm = request()->query('search');
    //       // Initialize an empty array to store all search results
    //  $allSearchResults = [];

    //  // Set the number of results to fetch per request
    //  $perPage = 100; // Adjust this number as needed

    //  // Initialize a page variable to start at page 0
    //  $page = 0;

    //  do {
    //      // Retrieve search results for the current page
    //      $searchResults = Product::search($searchTerm)->paginate($perPage, ['*'], 'page', $page);

    //      // Append the current page's results to the allSearchResults array
    //      $allSearchResults = array_merge($allSearchResults, $searchResults->items());

    //      // Increment the page number
    //      $page++;

    //  } while ($searchResults->hasMorePages());

    //    $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
    //    return view('frontend.product.all_search_result', compact('searchProducts', 'currency', 'searchTerm'));

    // }

    // public function AllSearchResult()
    // {
    //    $searchTerm = request()->query('search');
    //    // Initialize an empty array to store all search results
    //    $allSearchResults = Product::search($searchTerm)->get();

    //    return count($allSearchResults);
    //    $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
    //    return view('frontend.product.all_search_result', compact('allSearchResults', 'currency', 'searchTerm'));
    // }

    public function AllSearchResult()
    {
        $searchTerm = request()->query('search');

        // Use the "paginate" method to retrieve all search results without pagination
        $allSearchResultsData = Product::search($searchTerm)->paginate(PHP_INT_MAX);

        $allSearchResults = $allSearchResultsData->items();

        foreach ($allSearchResults as &$product) {
            $product->enc_id = encrypt($product->id); // Assuming you want to encrypt the ID
        }

        // $allSearchResults = Product::search($searchTerm)->get();
        //dd($allSearchResults);

        // Extract the data from the pagination object
        //return $allSearchResultsData = $allSearchResults->items();

        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();

        return view('frontend.product.all_search_result', compact('allSearchResults', 'currency', 'searchTerm'));
    }

    // public function AllSearchResult()
    // {
    //    $searchTerm = request()->query('search');
    //    $allProducts = Cache::get('all_products');
    //    $searchWords = explode(' ', $searchTerm);

    //    // Filter the products based on matching all words in the search term
    //    $searchProductsCollection = collect($allProducts)->filter(function ($product) use ($searchWords) {
    //       foreach ($searchWords as $searchWord) {
    //          if (stripos($product['product_name'], $searchWord) === false) {
    //             return false;
    //          }
    //       }
    //       return true;
    //    });

    //    // Convert the filtered collection to an array
    //    $searchProducts = $searchProductsCollection->values()->shuffle();

    //    // Now $searchProducts contains the filtered results as an object
    //    $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
    //    return view('frontend.product.all_search_result', compact('searchProducts', 'currency', 'searchTerm'));
    // }

    public function SearchProduct(Request $request)
    {
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $item = $request->searchField;
        $products = Product::where('product_name', 'LIKE', "%$item%")->limit(5)->get();

        // return view('frontend.product.search_product',compact('products'));
        return response()->json([$products, $currency]);
    }
}
