<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    static public function getCategories(): string
    {
        $values = self::where('status', 1)->get();
        $options = '';
        foreach ($values as $val)
        {
            $options .='<option value='.$val['id'].'>'.$val['name'].'</option>';
        }
        return $options;
    }

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
}
