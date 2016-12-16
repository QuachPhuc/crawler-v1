<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model {

    /*
     * table name
     * */
    protected $table = 'categories';

    /*
     * this rule for date insert
     * */
    protected $rules = [
        'name' => 'required',
        'status' => 'required',
        'description' => 'required'
    ];

    /*
     * validation data before insert into DB
     * */
    public function validation($data) {
        return Validator::make($data, $this->rules);
    }

    /*
     * relation ship
     * */
    public function parent() {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function child() {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    /*
     * Relationship with product table
     * */
    public function products() {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}