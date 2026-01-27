<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductGrid extends Component
{
    public $categories;
    public $products = [];
    public $selectedCategory = null;
    public $search = '';

    public function mount($categories, $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function selectProduct($productId)
    {
        $this->dispatch('productSelected', productId: $productId);
    }

    public function render()
    {
        // Ensure we have a collection, and if products is already a collection, use it directly
        $filteredProducts = $this->products instanceof \Illuminate\Support\Collection 
            ? $this->products 
            : collect($this->products);

        if ($this->selectedCategory) {
            $filteredProducts = $filteredProducts->filter(function ($product) {
                return $product->category_id == $this->selectedCategory;
            });
        }

        if ($this->search) {
            $filteredProducts = $filteredProducts->filter(function ($product) {
                return stripos($product->name, $this->search) !== false
                    || stripos($product->sku, $this->search) !== false;
            });
        }

        return view('livewire.product-grid', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
