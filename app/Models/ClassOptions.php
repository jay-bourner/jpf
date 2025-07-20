<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassOptions extends Model
{
    use HasFactory;

    protected $table = 'class_options';

    public function getClassOptions($id)
    {
        return $this->where('class_id', $id)->get();
    }
}
