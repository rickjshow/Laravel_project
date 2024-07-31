<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('codigo', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%");
        }

        $products = $query->get();

        return view('index', compact('products'));
    }

    public function create()
    {
        return view('formulario', ['product' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'codigo' => 'required|integer|unique:product,codigo',
            'descricao' => 'required|string|max:255'
        ], [
            'name.required' => 'O nome do produto é obrigatório.',
            'codigo.required' => 'O código do produto é obrigatório.',
            'codigo.unique' => 'Já existe um produto com esse código.',
            'descricao.required' => 'A descrição do produto é obrigatória.',
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->codigo = $request->input('codigo');
        $product->descricao = $request->input('descricao');
        $product->save();

        return redirect('product')->with('success', 'Inserido com sucesso!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('formulario', compact('product'));
    }

    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'codigo' => [
                'required',
                'integer',
                (new Unique('product', 'codigo'))->ignore($product->id),
            ],
            'descricao' => 'required|string|max:255'
        ], [
            'name.required' => 'O nome do produto é obrigatório.',
            'codigo.required' => 'O código do produto é obrigatório.',
            'codigo.unique' => 'Já existe um produto com esse código.',
            'descricao.required' => 'A descrição do produto é obrigatória.',
        ]);

        $product->name = $request->input('name');
        $product->codigo = $request->input('codigo');
        $product->descricao = $request->input('descricao');
        $product->save();

        return redirect('product')->with('success', 'Atualizado com sucesso!');
    }

    public function delete(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('product')->with('success', 'Item Excluido com sucesso!');
    }
}
