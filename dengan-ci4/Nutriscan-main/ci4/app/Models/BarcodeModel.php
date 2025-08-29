<?php

namespace App\Models;

use CodeIgniter\Model;

class BarcodeModel extends Model
{
    protected $table = 'scan_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','barcode', 'product_name', 'sugars', 'calories'];
}
