<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $products = Produit::get();

        $data = [
            'title' => 'Ed-Shop',
            'date' => date('d/m/Y'),
            'products' => $products
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('Ed-shop.pdf');
    }
}
