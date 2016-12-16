<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Product extends Model {
    /*
     * table name
     * */
    protected $table = 'products';

    /*
     * rule for validation
     * */
    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'url' => 'required',
        'link_preview' => 'required',
        'status' => 'required'
    ];

    /*
     * validate data
     * */
    public function validation($data) {
        return Validator::make($data, $this->rules);
    }

    /*
     * related with category table
     * */
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /*
     * related with author table
     * */
    public function author() {
        return $this->belongsTo('App\Models\Author', 'author_id', 'id');
    }
}