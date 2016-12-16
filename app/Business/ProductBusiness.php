<?php
namespace App\Business;
use App\Commons\Constant;
use App\Models\Product;

class ProductBusiness {
    /**
     * @return mixed
     */
    public function getAll() {
        return Product::all();
    }

    /**
     * Public page
     * @param $id
     * @return mixed
     */
    public function getProductListByLastCategory($id, $PriceOrder, $priceFrom = '', $priceTo = '') {
        $products = Product::where('category_id', $id)->where('status', Constant::STATUS_PUBLIC);
            if($priceFrom != '' && $priceTo != '') {
                $products = $products->whereBetween('votes', array($priceFrom, $priceTo));
            }
            $products = $products->orderBy('price', $PriceOrder)->paginate(9);
        return $products;
    }

    /**
     * Public page
     * @param $id
     * @return mixed
     */
    public function getProductByCategory($id, $idPro = '') {
        $products = Product::where('category_id', $id)->where('status', Constant::STATUS_PUBLIC);
        if($idPro != '') {
            $products = $products->where('id', '<>', $idPro);
        }
        $products = $products->orderBy('created_at', 'DESC')->get();
        return $products ;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProductByID($id) {
        return Product::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRelateProduct($id) {
        $categoryID = $this->getProductByID($id)->category->id;
        $relate = $this->getProductByCategory($categoryID, $id)->take(10);
        return $relate;
    }
}