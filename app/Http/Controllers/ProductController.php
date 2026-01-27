<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Department;
use App\Services\AuditService;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'department']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $products = $query->paginate(20)->appends($request->query());
        $categories = Category::where('active', true)->get();
        $departments = Department::where('active', true)->get();

        return view('products.index', compact('products', 'categories', 'departments'));
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|unique:products,sku',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'department_id' => 'nullable|exists:departments,id',
            'is_commissionable' => 'boolean',
            'commission_type' => 'nullable|in:fixed,percentage,tiered',
            'commission_value' => 'nullable|numeric|min:0',
            'taxable' => 'boolean',
            'active' => 'boolean',
        ]);

        $product = Product::create($validated);

        AuditService::log('create_order', 'Product', $product->id, "Product {$product->name} created");

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'department_id' => 'nullable|exists:departments,id',
            'is_commissionable' => 'boolean',
            'commission_type' => 'nullable|in:fixed,percentage,tiered',
            'commission_value' => 'nullable|numeric|min:0',
            'taxable' => 'boolean',
            'active' => 'boolean',
        ]);

        $oldValues = $product->toArray();
        $product->update($validated);

        AuditService::log('edit_order', 'Product', $product->id, "Product {$product->name} updated", $oldValues, $product->toArray());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
}
