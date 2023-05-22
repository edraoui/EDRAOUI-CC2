<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Produit;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Produit([
            'name' => $row['name'],
            'image' => $row['image'],
            'description' => $row['description'],
            'prix' => $row['prix'],
            'category_id' => $row['category_id'],
            'quantité' => $row['quantite'],
        ]);
    }
}
