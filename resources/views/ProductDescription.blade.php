@extends('master')
@section('stylecontent')
<style>
.sidenav{
height:auto;
width:0px;
}
.show {

  width:400px;
  height:400px;
}

.main{
  margin-left:10px;
}
.subMenu
{
  height:0px;
}
</style>
<style>
.checkedrate {
  color: orange;
}
.unchecked{
  color:DarkKhaki;
}
</style>
@endsection
@section('maincontent')
@foreach($productDetails as $product)
<div style="width:40%; float:left;height:800px;">
<div class="show" href="data:image/png;base64,{{ chunk_split(base64_encode(($product->ProductImage))) }}">
<img id="show-img" style="margin:80px;" src="data:image/png;base64,{{ chunk_split(base64_encode(($product->ProductImage))) }}"  height="650" width="80%"/>
</div>
</div>
<div style="width:60%; float:right;height:800px;">
<h3 style="margin:30px;color:DarkSalmon;"><b><i>{{strtoupper($product->ProductName)}} </i></b></h3>
<h3 style="margin:30px;color:Red;"><b><i>Rs.{{$product->Amount}}</i></b></h3>
<div style="margin:30px;">
<span  class="fa fa-star <?php echo ($product->Rating >= 1)?"checkedrate":"unchecked";?>"></span>
<span  class="fa fa-star <?php echo ($product->Rating >= 2)?"checkedrate":"unchecked"; ?>"></span>
<span  class="fa fa-star <?php echo ($product->Rating >= 3)?"checkedrate":"unchecked"; ?>"></span>
<span  class="fa fa-star <?php echo ($product->Rating >= 4)?"checkedrate":"unchecked"; ?>"></span>
<span  class="fa fa-star <?php echo ($product->Rating >= 5)?"checkedrate":"unchecked"; ?>"></span>
</div>
<h4 style="margin:30px;color:IndianRed;"><label>ProductSpecification:</label></h4>
<h4 style="margin-left:150px;color:LightSeaGreen;"><b>Size:</b><b style="margin-left:40px;color:Sienna;">{{$product->Size}}</b></h4>
<h4 style="margin-left:139px;margin-top:15px;color:LightSeaGreen;"><b>Color:</b><b style="margin-left:40px;color:Sienna;">{{$product->Color}}</b></h4>
<h4 style="margin-left:135px;margin-top:15px;color:LightSeaGreen;"><b>Brand:</b><b style="margin-left:40px;color:Sienna;">{{$product->Brand}}</b></h4>
<h4 style="margin:30px;color:IndianRed;"><label>InternalOperations:</label></h4>
@foreach($internalOperationsArray as $internalOperations)
<h4 style="margin-left:140px;margin-top:15px;color:SlateGrey;"><b><i>{{$internalOperations}}</i></b></h4>
@endforeach
<h4 style="margin-left:30px;margin-top:30px;margin-bottom:20px;color:IndianRed;"><label>ProductDescription:</label></h4>
@foreach($productDescriptionArray as $productDescription)
<h5 style="margin-left:150px;color:Indigo;">{{$productDescription}}</h5>
@endforeach
</div>
@endforeach
<br/>
<div>
<h4 style="margin:30px;color:IndianRed;"><b><i>SimilarProducts:</i></b></h4>
<div class="container">
<div class="row">
@foreach($similarProducts as $product)
<div class="col-md-2">
<div class="thumbnail">
<div class="card">
<img id="img" src="data:image/png;base64,{{ chunk_split(base64_encode(($product->ProductImage))) }}"  height="180" width="80"/>
<div class="caption">
<a href="{{url('product/'.$product->ProductID.'/'.$product->SubCategoryID)}}"><h5><b>{{$product->ProductName}}</b></h5> </a>
</div>
</div>
</div>
</div>
@endforeach
</div>
</div>
</div>
<div class="pagination">{{  $similarProducts->links() }}</div>
@endsection
@section('breadcrumbs')
<ul class="breadcrumb">
  <li><a href="#">Home</a></li>
  @foreach($subCategoryDetails as $subCategory)
  <li><a href="{{url('breadcrumbsubcategory/'.$subCategory->SubCategoryID)}}">{{$subCategory->SubCategoryName}}</a></li>
  @endforeach
  @foreach($productDetails as $product)
  <li><a href="#">{{$product->ProductName}}</a></li>
  @endforeach
</ul>
@endsection
