<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Log;

class UserController extends Controller
{
    
    public function index()
    {
        try
        {
            $users=DB::select('select CompanyLogo,CompanyName from tblclientdetails');
            Log::info("Get List of ClientDetails successfully");
            return view('image',['users'=>$users]);
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function display($name)
    {
        try
        {
            $ClientDetails=DB::select('select ClientID,CompanyLogo from tblclientdetails where CompanyName=?',[$name]);
            foreach($ClientDetails as $Client)
            $ClientID=$Client->ClientID;
            $CompanyLogo=$Client->CompanyLogo;
            session()->put('clientID',$ClientID);
            $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$ClientID]);
            $ProductImageList=DB::select('select Image,ProductImage,ProductName,ProductID,SubCategoryID from tblproductspecification where ClientID=?', [$ClientID]);
            $SizeList=DB::select('select Size from tblproductspecification where ClientID=?',[0]);
            $BrandList=DB::select('select Brand  from tblproductspecification where SubCategoryID=? ',[0]);
            $AmountList=DB::select('select Amount  from tblproductspecification where SubCategoryID=? ',[0]);
            Log::info("Get Category,Subcategory and ProductDetails successfully");
            return view('ClientDetails',compact('CategoryList','CompanyLogo','ProductImageList','SizeList','BrandList','AmountList'));
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    
    public function getSubCategory(Request $request) 
    {
        try
        {
            $SubCategoryList=DB::select('select SubCategoryName,SubCategoryID from tblsubcategorydetails where CategoryID=?',[$request->id]);
            Log::info("Get SubCategoryDetails successfully");
            return response()->json($SubCategoryList);
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
        
    }
    public function getProductImage(Request $request)
    {
        try
        {
            $ProductImageList=DB::select('select Image,ProductImage,ProductName,ProductID,SubCategoryID from tblproductspecification where SubCategoryID=?',[$request->id]);
            $CompanyLogo=DB::select('select CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
            foreach($CompanyLogo as $Client)
            $CompanyLogo=$Client->CompanyLogo;    
            $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
            $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$request->id]);
            $BrandList=DB::select('select Brand,count(Brand) as BrandCount from tblproductspecification where SubCategoryID=? group by Brand',[$request->id]);
            $AmountList=$request->session()->get('AmountList');
            session()->put('id',$request->id);
            Log::info("Get ProductImages successfully");
            return view('ClientDetails',compact('CompanyLogo','ProductImageList','CategoryList','SizeList','BrandList','AmountList'));
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
        
    }
    public function getImage(Request $request)
    {
        try
        {
            $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$request->id]);
            session()->put('id',$request->id);
            Log:info("Get Size details successfully");
            return Response::json( $SizeList);
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }

    }
   /* public function getCount()
    {
        $str="Hello";
        $str1="World";
        $arrstr= array($str,$str1);
        echo join(",",$arrstr);
        $str=$str.'(';
        echo $str;
        
    }*/
    public function getImg(Request $request)
    {
        try
        {
            $BrandList=DB::select('select Brand,count(Brand) as BrandCount from tblproductspecification where SubCategoryID=? group by Brand',[$request->id]);
            Log::info("Get Brand details successfully");
            return Response::json( $BrandList);
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function getAmount(Request $request)
    {
        try
        {
            $AmountList=DB::select('select min(Amount) as MinAmount,max(Amount) as MaxAmount from tblproductspecification where SubCategoryID=? group by Amount',[$request->id]);
            $fixedAmount=10000.00;
            $minAmount=0;
            $maxAmount=0;
            foreach($AmountList as $Amount)
            {
                if(!$minAmount)
                {
                $minAmount=$Amount->MinAmount;
                }
                $maxAmount=$Amount->MaxAmount;
                
            }
            for($i=$minAmount;$i<=$maxAmount;)
            {
                $tempMinAmount=$i;
                $tempMaxAmount=$i+$fixedAmount;
                $join=$tempMinAmount.'-'.$tempMaxAmount;
                $array[]=$join;
                $i=$tempMaxAmount;
            }
            session()->put('AmountList',$array);
            Log::info("Get Amount Details successfully");
            return response()->json($array);
            
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
  /*  public function getFilterImage(Request $request)
    {
        $ProductImageList=DB::select('select ProductImage from tblproductspecification where  Size in (?)',[$request->size]);
        $CompanyLogo=DB::select('select CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
        foreach($CompanyLogo as $Client)
        $CompanyLogo=$Client->CompanyLogo;    
        $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
        $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$request->session()->get('id')]);
        $BrandList=DB::select('select Brand,count(Brand) as BrandCount from tblproductspecification where SubCategoryID=? group by Brand',[$request->session()->get('id')]);
        $AmountList=$request->session()->get('AmountList');
        return view('ClientDetails',compact('CompanyLogo','ProductImageList','CategoryList','SizeList','BrandList','AmountList')); 
        echo $request->size;
    }*/
    public function check(Request $request)
    {
        try
        {
            $size=$request->size;
            $brand=$request->brand;
            $stringamount=$request->amount;
            $color=$request->color;
            $filterwhere="";
            $filteramount="";
            if($size)
            {
                $sizearray=explode(",",$size);
                $sizejoin="";
                foreach($sizearray as $sizesplit)
                {
                    if($sizejoin)
                    {
                        $sizejoin.=",";
                    }
                    $sizejoin.="'".$sizesplit."'";
                    
                }
                $filterwhere.=" and Size in ($sizejoin)";
            }
            if($brand)
            {
                $brandarray=explode(",",$brand);
                $brandjoin="";
                foreach($brandarray as $brandsplit)
                {
                    if($brandjoin)
                    {
                        $brandjoin.=",";
                    }
                    $brandjoin.="'".$brandsplit."'";
                    
                }
                $filterwhere.=" and Brand in ($brandjoin)";
            }
            //echo $stringamount;
            if($stringamount)
            {
            $stringarray=explode(",",$stringamount);
            $amountjoin="";
            for($i=0;$i<sizeOf($stringarray);$i++)
            {
                //echo $stringarray[$i];
                if(strpos($stringarray[$i],"-")!==false)
                {
                $amountsplit=explode("-",$stringarray[$i]);
                $minAmount=$amountsplit[0];
                $maxAmount=$amountsplit[1];
                $amount1='  Amount between '. $minAmount.' and '. $maxAmount.'';
                if(!$filteramount)
                {
                    $filteramount.=" and".$amount1;
                }
                else{
                    $filteramount.=" or".$amount1;
                }
                if($filteramount)
                {
                    $filteramount=substr_replace($filteramount,"(",4,0);
                    $filteramount=substr_replace($filteramount,")",strlen($filteramount),0);
                    //echo $filteramount;
                }
            }
            }
        }
        if($color)
            {
                $colorarray=explode(",",$color);
                $colorjoin="";
                foreach($colorarray as $colorsplit)
                {
                    if($colorjoin)
                    {
                        $colorjoin.=",";
                    }
                    $colorjoin.="'".$colorsplit."'";
                    
                }
                $filterwhere.=" and Color in ($colorjoin)";
            }
            
            $ProductImageList=DB::select('select Image,ProductImage,ProductName,ProductID,SubCategoryID from tblproductspecification where SubCategoryID=?'.$filterwhere.$filteramount,[$request->session()->get('id')]);
            $CompanyLogo=DB::select('select CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
            foreach($CompanyLogo as $Client)
            $CompanyLogo=$Client->CompanyLogo;    
            $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
            $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$request->session()->get('id')]);
            $BrandList=DB::select('select Brand,count(Brand) as BrandCount from tblproductspecification where SubCategoryID=? group by Brand',[$request->session()->get('id')]);
            $AmountList=$request->session()->get('AmountList');
            Log::info("Get Filter image successfully");
            return view('ClientDetails',compact('CompanyLogo','ProductImageList','CategoryList','SizeList','BrandList','AmountList')); 
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }       

    }
   /* public function checkAmount(Request $request)
    {
        $stringamount="11990.00-14999,14999-17999";
        $stringarray=explode(",",$stringamount);
        $amountjoin="";
        $filteramount="";
        for($i=0;$i<sizeOf($stringarray);$i++)
        {
            echo $stringarray[$i];
            $amountsplit=explode("-",$stringarray[$i]);
            $minAmount=$amountsplit[0];
            $maxAmount=$amountsplit[1];
            $amount1='  Amount between '. $minAmount.' and '. $maxAmount.'';
            if(!$filteramount)
            {
                $filteramount.=" and".$amount1;
            }
            else{
                $filteramount.=" or".$amount1;
            }
            if($filteramount)
            {
                $filteramount=substr_replace($filteramount,"(",4,0);
                $filteramount=substr_replace($filteramount,")",strlen($filteramount),0);
                echo $filteramount;
            }
        }
        
        $ProductImageList=DB::select('select ProductName from tblproductspecification where SubCategoryID=?'.$filteramount,[4000]);
        print_r($ProductImageList);
        echo $filteramount;
    }*/
   /* public function modal()
    {
        return view('AmountDetails');
    }*/
    public function getColor(Request $request)
    {
        try
        {
            $color=DB::select('select distinct Color from tblproductspecification where SubCategoryID=?',[$request->id]);
            Log::info("Get color details successfully");
            return response()->json($color);
        }
        
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
   /* public function checkcolor(Request $request)
    {
        echo $request->color;
        $color=$request->color;
        $filterwhere="";
        if($color)
        {
            $colorarray=explode(",",$color);
            $colorjoin="";
            foreach($colorarray as $colorsplit)
            {
                if($colorjoin)
                {
                    $colorjoin.=",";
                }
                $colorjoin.="'".$colorsplit."'";
                
            }
            $filterwhere.=" and Color in ($colorjoin)";
        }
        $color=DB::select('select ProductName from tblproductspecification where SubCategoryID=?'.$filterwhere,[4000]);
        print_r($color);

    }*/
    public function getdemo(Request $request)
    {
        $image=DB::select('select Image,ProductName,ProductID,SubCategoryID from tblproductspecification where SubCategoryID=?',[$request->id]);
        return response()->json($image);
    }
    public function demolist(Request $request)
    {
        try
        {
            $size=$request->size;
            $brand=$request->brand;
            $stringamount=$request->amount;
            $color=$request->color;
            $filterwhere="";
            $filteramount="";
            if(count($size)>1)
            {
               // $sizearray=explode(",",$size);
                $sizejoin="";
                foreach($size as $sizesplit)
                {
                    if($sizejoin)
                    {
                        $sizejoin.=",";
                    }
                    $sizejoin.="'".$sizesplit."'";
                    
                }
                $filterwhere.=" and Size in ($sizejoin)";
            }
            if(count($brand)>1)
            {
                //$brandarray=explode(",",$brand);
                $brandjoin="";
                foreach($brand as $brandsplit)
                {
                    if($brandjoin)
                    {
                        $brandjoin.=",";
                    }
                    $brandjoin.="'".$brandsplit."'";
                    
                }
                $filterwhere.=" and Brand in ($brandjoin)";
            }
            //echo $stringamount;
            if(count($stringamount)>1)
            {
            //$stringarray=explode(",",$stringamount);
            $amountjoin="";
            for($i=0;$i<sizeOf($stringamount);$i++)
            {
                //echo $stringarray[$i];
                if(strpos($stringamount[$i],"-")!==false)
                {
                $amountsplit=explode("-",$stringamount[$i]);
                $minAmount=$amountsplit[0];
                $maxAmount=$amountsplit[1];
                $amount1='  Amount between '. $minAmount.' and '. $maxAmount.'';
                if(!$filteramount)
                {
                    $filteramount.=" and".$amount1;
                }
                else{
                    $filteramount.=" or".$amount1;
                }
                if($filteramount)
                {
                    $filteramount=substr_replace($filteramount,"(",4,0);
                    $filteramount=substr_replace($filteramount,")",strlen($filteramount),0);
                    //echo $filteramount;
                }
            }
            }
        }
       if(count($color)>1)
            {
               // $colorarray=explode(",",$color);
                $colorjoin="";
                foreach($color as $colorsplit)
                {
                    if($colorjoin)
                    {
                        $colorjoin.=",";
                    }
                    $colorjoin.="'".$colorsplit."'";
                    
                }
                $filterwhere.=" and Color in ($colorjoin)";
            }
            
            //echo $filterwhere;
            $ProductImageList=DB::select('select Image,ProductName,ProductID,SubCategoryID from tblproductspecification where SubCategoryID=?'.$filterwhere.$filteramount,[$request->session()->get('id')]);
           /* $CompanyLogo=DB::select('select CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
            foreach($CompanyLogo as $Client)
            $CompanyLogo=$Client->CompanyLogo;    
            $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
            $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$request->session()->get('id')]);
           // $BrandList=DB::select('select Brand,count(Brand) as BrandCount from tblproductspecification where SubCategoryID=? group by Brand',[$request->session()->get('id')]);
           // $AmountList=$request->session()->get('AmountList');
            Log::info("Get Filter image successfully");
            //return view('ClientDetails',compact('CompanyLogo','ProductImageList','CategoryList','SizeList','BrandList','AmountList')); */
            return response()->json($ProductImageList);
            //$SizeList=$request->size;
            //return response()->json($SizeList);
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }       

    }
    public function getSubCategoryName(Request $request)
    {
        $SubCategoryName=DB::select('select SubCategoryName from tblsubcategorydetails where SubCategoryID=?',[$request->id]);
        return response()->json($SubCategoryName);
    }
    public function getCategoryName(Request $request)
    {
        $CategoryName=DB::select('select CategoryName from tblcategorydetails where CategoryID=?',[$request->id]);
        return response()->json($CategoryName);
    }
    public function breadcrumbcategory(Request $request)
    {
        $categoryID=$request->categoryID;
        $ClientDetails=DB::select('select ClientID,CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
        foreach($ClientDetails as $Client)
        $ClientID=$Client->ClientID;
        $CompanyLogo=$Client->CompanyLogo;
        session()->put('clientID',$ClientID);
        $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
        $ProductImageList=DB::select('select Image,ProductImage,ProductName,ProductID,SubCategoryID from tblproductspecification where ClientID=? and CategoryID=?', [$request->session()->get('clientID'),$categoryID]);
        $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where CategoryID=? group by Size',[0]);
        $BrandList=DB::select('select Brand,count(Brand) as BrandCount  from tblproductspecification where CategoryID=?  group by Brand ',[0 ]);
        $AmountList=DB::select('select Amount  from tblproductspecification where CategoryID=?',[0]);
        Log::info("Get Category,Subcategory and ProductDetails successfully");
        return view('ClientDetails',compact('CategoryList','CompanyLogo','ProductImageList','SizeList','BrandList','AmountList'));
    }
    public function breadcrumbsubcategory(Request $request)
    {
        $subcategoryID=$request->subcategoryID;
        $ClientDetails=DB::select('select ClientID,CompanyLogo from tblclientdetails where ClientID=?',[$request->session()->get('clientID')]);
        foreach($ClientDetails as $Client)
        $ClientID=$Client->ClientID;
        $CompanyLogo=$Client->CompanyLogo;
        session()->put('clientID',$ClientID);
        $CategoryList=DB::select('select  CategoryName,CategoryID from tblcategorydetails where ClientID=?', [$request->session()->get('clientID')]);
        $ProductImageList=DB::select('select Image,ProductImage,ProductName,ProductID,SubCategoryID from tblproductspecification where ClientID=? and SubCategoryID=?', [$request->session()->get('clientID'),$subcategoryID]);
        $SizeList=DB::select('select Size,count(Size) as SizeCount from tblproductspecification where SubCategoryID=? group by Size',[$subcategoryID]);
        $BrandList=DB::select('select Brand,count(Brand) as BrandCount  from tblproductspecification where SubCategoryID=?  group by Brand ',[$subcategoryID ]);
        $AmountList=$request->session()->get('AmountList');
        Log::info("Get Category,Subcategory and ProductDetails successfully");
        return view('ClientDetails',compact('CategoryList','CompanyLogo','ProductImageList','SizeList','BrandList','AmountList'));
    }

}
