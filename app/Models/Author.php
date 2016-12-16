<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Author extends Model {
    protected $table = 'authors';

    protected $rules = [
        'name' => 'required',
        'image' => 'image|mimes:jpeg,jpg,png,gif'
    ];

    public function validation($data) {
        return Validator::make($data, $this->rules);
    }

    public function products() {
        return $this->hasMany('App\Models\Product', 'author_id', 'id');
    }
}