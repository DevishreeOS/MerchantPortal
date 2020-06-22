<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
<style>
.pagination li {
    display: inline;
    margin-left: 0.5em;
    margin-right: 0.5em;
}
</style>
</head>
<body>
<div class="container">

<div class="row">
@foreach($productDetails as $product)

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
<div class="pagination">{{  $productDetails->links() }}</div>
</body>
</html>
