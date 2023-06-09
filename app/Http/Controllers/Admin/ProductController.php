<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Statu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            $dd = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category')
                ->orderByDesc('id')
                ->get();
            // $dd = Produit::get();
            // return view('admin.product.index');
            return view('admin.product.index', ["dd" => $dd]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            $data = Category::get();
            return view('admin.product.create', ['data' => $data]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {

            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'prix' => 'required|numeric|min:0.01',
                'quantite' => 'required|integer|min:0',
                'category' => 'required|integer|min:1'
            ]);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);

            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['image'] = $image->storeAs($imageName);
            $data['prix'] = $request->prix;
            $data['quantité'] = $request->quantite;
            $data['category_id'] = $request->category;

            $data['created_at'] = date('Y-m-d H:i:s');
            Produit::create($data);

            return redirect()->route('admin.products.index')->with('success', 'product has been created successfully.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            $data = Produit::select('*')->find($id);
            $cat = Category::get();
            return view("admin.product.edit", ['data' => $data, 'cat' => $cat]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'prix' => 'required|numeric|min:0.01',
                'quantite' => 'required|integer|min:0',
                'category' => 'required|integer|min:1'
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/images', $imageName);
                $data['image'] = $image->storeAs($imageName);
            }

            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['prix'] = $request->prix;
            $data['quantité'] = $request->quantite;
            $data['category_id'] = $request->category;
            $data['updated_at'] = date('Y-m-d H:i:s');
            Produit::where('id', $id)->update($data);
            return redirect()->route("admin.products.index")->with('success', 'product has been edited successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            if ($user->is_admin) {
                // ------------------------------
                Produit::where('id', $id)->delete();
                return redirect()->route('admin.products.index')->with('success', 'product has been deleted successfully.');
            } else {
                return redirect()->route("client.produit.index");
            }
        }

    }

    public function export()
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            if ($user->is_admin) {
                // ------------------------------
                return Excel::download(new ProductExport, 'produits.xlsx');
            } else {
                return redirect()->route("client.produit.index");
            }
        }

    }
    public function import()
    {
                Excel::import(new ProductImport, request()->file('file'));
                return redirect()->route('admin.products.index')->with('success', 'Products have been uploaded successfully.');
    }
    public function commandes()
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            if ($user->is_admin) {
                // ------------------------------
                $cart = DB::table('commandes')
                    ->join('status', 'commandes.status_id', '=', 'status.id')
                    ->join('users', 'users.id', '=', 'commandes.user_id')
                    ->select('commandes.*', 'status.name as status_name', 'users.name', 'users.email')
                    ->orderByDesc('created_at')
                    ->get();
                // return $cart;
                return view('admin.product.commandes', ["cart" => $cart]);
            } else {
                return redirect()->route("client.produit.index");
            }
        }
    }
    public function changestatus(Request $request, string $id)
    {
        $user = Auth::user();
        if ($user->is_blocked) {
            return view('blocked.index');
        } else {
            if ($user->is_admin) {
                // ------------------------------
                $commande = Commande::find($id);
                $commande->status_id = $request->status;
                $commande->save();

                return redirect()->route('mail')->with('commande', $commande);
                // return $commande;
                // return back()->with('success', 'Status updated successfully.');
            } else {
                return redirect()->route("client.produit.index");
            }
        }

    }
}
