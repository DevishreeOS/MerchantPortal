<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Log;

class ProductDetailsController extends Controller
{
    public function showProductDetails(Request $request)
    {
        try
        {
            $productDetails=DB::select('select ProductName,ProductImage,Size,Color,Rating,Amount,InternalOperation,ProductDescription,Brand from tblproductspecification where ProductID=? and SubCategoryID=?',[$request->productID,$request->subCategoryID]);
            foreach($productDetails as $product)
            {
                $internalOperations=$product->InternalOperation;
                $productDescription=$product->ProductDescription;
            }
            $internalOperationsArray=explode(',',$internalOperations);
            $productDescriptionArray=explode('.',$productDescription);
            $subCategoryDetails=DB::select('select SubCategoryID,SubCategoryName from tblsubcategorydetails where SubCategoryID=?',[$request->subCategoryID]);
            $similarProducts=DB::table('tblproductspecification')->where('ProductID','NOT LIKE',$request->productID)->where('SubCategoryID',$request->subCategoryID)->paginate(4);
            Log::info("Get brief details about particular products successfully");
            return view('ProductDescription',compact('productDetails','internalOperationsArray','productDescriptionArray','similarProducts','subCategoryDetails'));
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
        
    }
    public function master()
    {
        return view ('master');
    }
    public function breadcrumbs()
    {
        $productdetails=DB::select('select CategoryID,SubCategoryID from tblproductspecification where ProductID=?',[5003]);
        return view('Breadcrumbs',compact('productdetails'));
    }
    public function index()
    {
        return view('demoimage');
    }
    public function demosave(Request $request)
    {
        $image=$request->file('companyLogo');
        $new_name=rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'),$new_name);
        DB::insert('update tblproductspecification set Image=? where ProductID=?',[$new_name,5008]);
        echo "updated";

    }
    public function show()
    {
        $image=DB::select('select image from image');
        return view('show',compact('image'));
    }
    public function starrating(Request $request)
    {
        $rating=DB::select('select Rating from tblproductspecification where ProductID=?',[5003]);
        return view('StarRating',compact('rating'));
    }
    
}
