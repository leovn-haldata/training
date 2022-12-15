<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'mst_product';

    protected $fillable = [
        'product_name',
        'description',
        'product_image',
        'product_price',

    ];

    static function getStatus()
    {
        return collect([
            [ 'val' => 0, 'status' => 'Ngừng bán'],
            [ 'val' => 1, 'status' => 'Đang bán'],
        ]);
    }
}
