<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProduitguestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            $cat = DB::table('categories as c')
                ->leftJoin('products as p', 'c.id', '=', 'p.category_id')
                ->select('c.id', 'c.name', DB::raw('COUNT(p.id) as count'))
                ->groupBy('c.id', 'c.name')
                ->orderByDesc('count')
                ->get();

            $dd = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category')
                ->orderByDesc('id')
                ->get();
            return view('guest.index', ["dd" => $dd, "cat" => $cat]);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                }
            }
        }

    }
    public function show(string $id)
    {
        $user = Auth::user();
        if (!$user) {
            // -------------------------------
            $data = Produit::select('*')->find($id);
            $cat = DB::table('categories as c')
                ->leftJoin('products as p', 'c.id', '=', 'p.category_id')
                ->select('c.id', 'c.name', DB::raw('COUNT(p.id) as count'))
                ->groupBy('c.id', 'c.name')
                ->orderByDesc('count')
                ->get();
            return view('guest.show', ['data' => $data, 'cat' => $cat]);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                    // return "client";
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     function cart(string $id)
    {
        $user = Auth::user();
        if (!$user) {
            $idproduit = $id;
            $cookieData = request()->cookie('cart');

            if ($cookieData) {
                $idsArray = json_decode($cookieData, true);
                $idsArray[] = $idproduit;
            } else {
                $idsArray = [$idproduit];
            }

            $cookieValue = json_encode($idsArray);
            $cookie = cookie('cart', $cookieValue, 60000);
            return redirect()->back()->withCookie($cookie);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                    // return "client";
                }
            }
        }
    }
    public function category(string $id)
    {
        $user = Auth::user();
        if (!$user) {
            // -------------------------------
            $dd = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category')
                ->where('category_id', $id)
                ->orderByDesc('id')
                ->get();
            $cat = DB::table('categories as c')
                ->leftJoin('products as p', 'c.id', '=', 'p.category_id')
                ->select('c.id', 'c.name', DB::raw('COUNT(p.id) as count'))
                ->groupBy('c.id', 'c.name')
                ->orderByDesc('count')
                ->get();
            return view('guest.category', ['dd' => $dd, 'cat' => $cat]);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                }
            }
        }
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            // -------------------------------
            $dd = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category')
                ->where('products.name', 'like', '%' . $request->search . '%')
                ->orderByDesc('id')
                ->get();

            $cat = DB::table('categories as c')
                ->leftJoin('products as p', 'c.id', '=', 'p.category_id')
                ->select('c.id', 'c.name', DB::raw('COUNT(p.id) as count'))
                ->groupBy('c.id', 'c.name')
                ->orderByDesc('count')
                ->get();

            return view('guest.search', ["dd" => $dd, "cat" => $cat, "search" => $request->search]);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                }
            }
        }
    }

    public function shopping()
    {
        $user = Auth::user();
        if (!$user) {
            $myArray = json_decode(request()->cookie('cart'), true);
            $products = Produit::whereIn('id', $myArray)->get();
            $counts = array_count_values($myArray);

            for ($i = 0; $i < count($products); $i++) {
                foreach ($counts as $k => $v) {
                    if ($products[$i]->id == $k) {
                        $products[$i]->count = $v;
                    }
                }
            }
            return view('guest.shopping', ["cart" => $products]);
        } else {
            if ($user->is_blocked) {
                return view('blocked.index');
            } else {
                if ($user->is_admin) {
                    return redirect()->route('admin.products.index');
                } else {
                    return redirect()->route('client.produit.index');
                }
            }
        }
    }


}
