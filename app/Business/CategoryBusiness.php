<?php
namespace App\Business;
use App\Commons\Constant;
use App\Models\Category;
use App\Models\Product;

class CategoryBusiness {

    /**
     * @return mixed
     */
    public function getAll() {
        return Category::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllData() {
        $category = Category::with('products')->get();
        return $category;
    }

    /**
     * @return mixed
     */
    public function getProductList($number = '') {
        $products = Category::has('products')->with(['products' => function($query) {
            $query->orderBy('price', 'asc');
            }])->get()->map(function($category) use ($number) {
            $category->products = $category->products->where('status', Constant::STATUS_PUBLIC);

            if($number != '') {
                $category->products = $category->products->take($number);
            }

            return $category;
        });
        return $products;
    }

    public function getBreadCumbAndProductNumber($idCategory) {
        $category = Category::find($idCategory);
        $count = 0;
        $data = array(
            'bread' => array(),
            'count' => $count
        );
        if($category->deep == 1) {
            $arr = array('id' => $category->child->id, 'slug' => $category->child->slug, 'name' =>$category->child->name);
            array_push($data['bread'], $arr);
            array_push($data['bread'], array('id' => $category->id, 'slug' => $category->slug, 'name' =>$category->name ) );
        } else {
            array_push($data['bread'], array('id' => $category->id, 'slug' => $category->slug, 'name' =>$category->name) );
        }

        foreach($category->parent as $item) {
            if ($category->deep == 0) {
                foreach($item->parent as $child) {
                    $count = $count + $child->products->count();
                }
            }

            if ($category->deep == 1) {
                $count = $count + $item->products->count();
            }
        }

        $data['count'] = $count;

        return $data;
    }

    /**
     * get list category
     * @param $id
     * @return mixed
     */
    public function getListCategory($id = Constant::DEFAULT_VARIABLE) {
        $category = $this->getAll();
        $arrCategory = array(
            '0' => Constant::ROOT,
        );
        foreach($category as $item) {
            if ($item->id != $id) {
                $arrCategory[$item->id] = ($item->child == null ? 'Root' : $item->child->name) .'-'.  $item->name;
            }
        }
        return $arrCategory;
    }

    public function filterCategoryByID($listID) {
        $arrayID = explode(',', $listID);
        $categories = Category::whereIn('id', $arrayID)->get();
        return $categories;
    }

    public function searchProduct($data) {
        $arrayCategoryID = array();
        $products = Product::where('status', Constant::STATUS_PUBLIC);
        if(isset($data['child'])) {
            foreach($data['child'] as $id) {
                $category = Category::find($id);
                if($category->deep == 1) {
                    foreach($category->parent as $child) {
                        array_push($arrayCategoryID, $child->id);
                    }
                } else {
                    if(!in_array($id, $arrayCategoryID)) {
                        array_push($arrayCategoryID, (int)$id);
                    }
                }
            }
            $products = $products->whereIn('category_id', $arrayCategoryID);
        }

        if(isset($data['priceFrom']) && $data['priceFrom'] !== "") {
            $products = $products->where('price', '>=', $data['priceFrom']);
        }
        if(isset($data['priceTo']) && $data['priceTo'] !== "") {
            $products = $products->where('price', '<=', $data['priceTo']);
        }
        if(isset($data['priceFrom']) && isset($data['priceTo'])) {
            $products = $products->where('price', '>=', $data['priceFrom'])->where('price', '<=', $data['priceTo']);
        }
        if(isset($data['text-search'])) {
            $products = $products->where('name', 'like', '%' .$data['text-search'] . '%');
        }

        $count = $products->count();
        $products = $products->paginate(9);

        $arrayViewData = array($products, $count);
        return $arrayViewData;
    }
}