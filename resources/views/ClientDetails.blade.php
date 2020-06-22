@extends('master')
@section('stylecontent')
<style>
.sidenav .lblSideMenu{
  padding: 3px 3px 3px 3px;
  text-decoration: none;
  font-size: 15px;
  color: MediumPurple;
  display: block;
}
.sidenav .lblFilterMenu{
  margin-left:20px;
  color:MediumPurple;
}
.sidenav .chkValues{
  margin-left:15px;
}
.sidenav{
  margin-top:160px;
}
</style>
<style>
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 10px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
</style>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.picker { 
            display: block; 
            position: relative; 
            padding-left: 45px; 
            margin-bottom: 15px; 
            cursor: pointer; 
            font-size: 20px; 
        } 
          
        /* Hide the default checkbox */ 
       /* input[type=checkbox] { 
            visibility: hidden; 
        } */
          
        /* Creating a custom checkbox 
        based on demand */ 
        .geekmark { 
            position: absolute; 
            top: 0; 
            left: 0; 
            height: 25px; 
            width: 25px; 
         } 
          
        /* Specify the background color to be 
        shown when hovering over checkbox */ 
        .picker:hover input ~ .geekmark { 
        } 
          
        /* Specify the background color to be 
        shown when checkbox is active */ 
        .picker input:active ~ .geekmark { 
        } 
          
        /* Specify the background color to be 
        shown when checkbox is checked */ 
        .picker input:checked ~ .geekmark { 
        } 
          
        /* Checkmark to be shown in checkbox */ 
        /* It is not be shown when not checked */ 
        .geekmark:after { 
            content: ""; 
            position: absolute; 
            display: none; 
        } 
          
        /* Display checkmark when checked */ 
        .picker input:checked ~ .geekmark:after { 
            display: block; 
        } 
          
        /* Styling the checkmark using webkit */ 
        /* Rotated the rectangle by 45 degree and  
        showing only two border to make it look 
        like a tickmark */ 
        .picker .geekmark:after { 
            left: 8px; 
            bottom: 5px; 
            width: 6px; 
            height: 12px; 
            border: solid white; 
            border-width: 0 4px 4px 0; 
            -webkit-transform: rotate(45deg); 
            -ms-transform: rotate(45deg); 
            transform: rotate(45deg); 
        }
</style>
@endsection
@section('scriptcontent')
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('change','.category',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getsubCategory')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
        console.log(data);
        op+='<option value="0" selected disabled>Select SubCategory</option>';
        for(var i=0;i<data.length;i++)
        {
          op+='<option value="'+data[i].SubCategoryID+'">'+data[i].SubCategoryName+'</option>';

        }
        div.find('.subcategory').html("");
        div.find('.subcategory').append(op);
      }
    });
  });
 });
 </script>
 
 <script type="text/javascript">
 $(document).ready(function(){
  $(document).on('change','.category',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getCategoryName')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
        console.log(data);
        op+='<ul class="breadcrumb"><li><a href="#">Home</a></li>';
        for(var i=0;i<data.length;i++)
        {
          op+='<li class="categoryName"><a href="{{URL::to('/')}}/breadcrumbcategory/'+categoryID+'">'+data[i].CategoryName+'</a></li>';

        }
        $("#dynamicBreadCrumbs").html("");
        $("#dynamicBreadCrumbs").append(op);
        
      }
    });
  });
 });

 $(document).ready(function(){
  $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
         $.ajax({
      type:'get',
      url:'{!!URL::to('getsubCategoryName')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
        console.log(data);
        $('.subCategoryName').html("");

        for(var i=0;i<data.length;i++)
        {
          op+='<li class="subCategoryName"><a href="{{URL::to('/')}}/breadcrumbsubcategory/'+categoryID+'">'+data[i].SubCategoryName+'</a></li>';

        }
        op+="</ul>";
        $('.categoryName').after(op);
         
      }
    });
      
  }); 
});

$(document).ready(function(){
  $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getImage')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
         op+='<label class="lblSideMenu">Size</label>';
         for(var i=0;i<data.length;i++)
         {
           
            op+='<input class="chkValues" type="checkbox" name="Size" value="'+data[i].Size+'"/><label for="'+data[i].Size+'">'+data[i].Size+'</label><span class="badge badge-pill badge-dark">'+data[i].SizeCount+'</span><br/>';
           
         }  
         $("#sizelist").html("");
         $("#sizelist").append(op);
      }
      
    });
  }); 
});
  $(document).ready(function(){
  $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getdemo')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
         op+='<div class="container"><div class="row">';
         for(var i=0;i<data.length;i++)
         {
           op+='<div class="col-md-2"><div class="thumbnail" ><div class="card" style="background-color:Beige;" id="demo">';
           op+='<img style="margin-left:30px;margin-top:10px;" class="img-rounded" src="{{URL::to('/')}}/images/'+data[i].Image+'" height="180" width="80"/>';
           op+='<div class="caption"><a href="{{URL::to('/')}}/product/'+data[i].ProductID+'/'+data[i].SubCategoryID+'"><h5 style="margin-left:15px;color:DarkMagenta;"><b><i>'+data[i].ProductName+'</i></b></h5></a></div>';
           op+="</div></div></div>";
         }  
         $("#imgdemo").html("");
         $("#imgdemo").append(op);
      }
    });
  }); 
  });
   $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getImg')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
        op+='<label class="lblSideMenu">Brand</label>';
         for(var i=0;i<data.length;i++)
         {
           
            op+='<input class="chkValues" type="checkbox" name="Brand" value="'+data[i].Brand+'"/><label for="'+data[i].Brand+'">'+data[i].Brand+'</label><span class="badge badge-pill badge-dark">'+data[i].BrandCount+'</span><br/>';
           
         }  
         $("#brandlist").html("");
         $("#brandlist").append(op);
      }
    });
  });
  $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getAmount')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
        op+='<label class="lblSideMenu">Amount</label>';
         for(var i=0;i<data.length;i++)
         {
           op+='<input class="chkValues" type="checkbox" name="Amount" value="'+data[i]+'"/><label for="'+data[i]+'">'+data[i]+'</label><br>';
         }  
         $("#amountlist").html("");
         $("#amountlist").append(op);
      }
      
    });
  });
  $(document).on('change','.subcategory',function(){
    var categoryID=$(this).val();
    var div=$(this).parent();
    var op="";
    $.ajax({
      type:'get',
      url:'{!!URL::to('getColor')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
        op+='<label class="lblSideMenu">Color</label>';
         for(var i=0;i<data.length;i++)
         {
          op+='<label class="picker"><input type="checkbox" name="Color" value="'+data[i].Color+'"/><span class="geekmark" style="background-color:'+data[i].Color+';"></span></label>';
         }  
         $("#color").html("");
         $("#color").append(op);
      }
      
    });
  });
  
  
    $(document).ready(function() {
       // $("button").click(function(){
        $(document).on('change', 'input[type="checkbox"]', function(){
            var op="";
            var size = [];
            size.push(0);
            $.each($("input[name='Size']:checked"), function(){            
                size.push($(this).val());
            });
           // alert("My favourite sports are: " + size.join(", "));
            var brand=[];
            brand.push(0);
            $.each($("input[name='Brand']:checked"), function(){            
                brand.push($(this).val());
            });
           // alert("My favourites sports are: " + brand.join(", "));
            var amount=[];
            amount.push(0);
            $.each($("input[name='Amount']:checked"), function(){            
                amount.push($(this).val());
            });
           // alert("My favourites sports are: " + amount.join(", "));
            var color = [];
            color.push(0);
            $.each($("input[name='Color']:checked"), function(){            
                color.push($(this).val());
            });
           // alert("My favourite sports are: " + color.join(", "));
           // var link=document.getElementById("result");
            //link.href="";
            //.href="{{url('check/')}}"+"/"+size+"/"+brand+"/"+amount+"/"+color;
            $.ajax({
              type:'get',
              url:'{!!URL::to('demolist')!!}',
              data:{'size':size,'brand':brand,'amount':amount,'color':color},
              success:function(data)
                 {
                console.log(data);
                op+='<div class="container"><div class="row">';
         for(var i=0;i<data.length;i++)
         {
           op+='<div class="col-md-2"><div class="thumbnail" ><div class="card" style="background-color:Beige;" id="demo">';
           op+='<img style="margin-left:30px;margin-top:10px;" class="img-rounded" src="{{URL::to('/')}}/images/'+data[i].Image+'" height="180" width="80"/>';
           op+='<div class="caption"><a href="{{URL::to('/')}}/product/'+data[i].ProductID+'/'+data[i].SubCategoryID+'"><h5 style="margin-left:15px;color:DarkMagenta;"><b><i>'+data[i].ProductName+'</i></b></h5></a></div>';
           op+="</div></div></div>";
         }  
         $("#imgdemo").html("");
         $("#imgdemo").append(op);     
          }
            });
        });
    });
</script>
@endsection
@section('subMenu')
{{csrf_field()}}
<div class="Container box">
<div class="form-group">
<img src="data:image/png;base64,{{ chunk_split(base64_encode(($CompanyLogo))) }}"  height="20" width="90"/>
<label>Category</label>
<select name="categorylist" class="category" >
<option value="0" disabled="true" selected="true">--Select Category--</option>
@foreach($CategoryList as $category)
<option value="{{$category->CategoryID}}">{{$category->CategoryName}}</option>
@endforeach
</select>
<label>SubCategory</label>
<select name="subcategorylist" class="subcategory" id="subcategory"  >
<option value="0" disabled="true" selected="true">--Select SubCategory--</option>
</select>
<!--<button type="button" id="filter">Filter</button>-->
<hr/>
</div>
</div >
@endsection
<!--<div style="width:75%; float:right;">-->
@section('maincontent')
{{csrf_field()}}
<div id="imgdemo">
<div class="container">

<div class="row">
@foreach($ProductImageList as $product)

  <div class="col-md-2">
  <div class="thumbnail" >
<div class="card" style="background-color:Beige;" id="demo">
<img id="img" style="margin-left:30px;margin-top:10px;" class="img-rounded" src="data:image/png;base64,{{ chunk_split(base64_encode(($product->ProductImage))) }}"  height="180" width="80"/>

<div class="caption">
<a href="{{url('product/'.$product->ProductID.'/'.$product->SubCategoryID)}}"><h5 style="margin-left:15px;color:DarkMagenta;"><b><i>{{$product->ProductName}}</i></b></h5></a>
</div>
</div>
</div>
</div>
@endforeach
</div>
</div>
</div>
<!--</div>-->
<!--<div style="width:25%; float:left;">

</div>-->
@section('sidemenu')
<div id="sizelist" name="sizelist" class="sizelist">
<label class="lblSideMenu">Size</label>
@foreach($SizeList as $Size)
<input class="chkValues" type="checkbox" value="{{$Size->Size}}" name="Size"/><label for="{{$Size->Size}}">{{$Size->Size}}</label><span class="badge badge-pill badge-dark">{{$Size->SizeCount}}</span><br/>
@endforeach
</div>
<hr/>
<div id="brandlist" name="brandlist" class="brandlist">
<label class="lblSideMenu">Brand</label>
@foreach($BrandList as $Brand)
<input class="chkValues" type="checkbox" value="{{$Brand->Brand}}" name="Brand"/><label for="{{$Brand->Brand}}">{{$Brand->Brand}}</label><span class="badge badge-pill badge-dark">{{$Brand->BrandCount}}</span><br/>
@endforeach
</div>
<hr/>
<div id="amountlist" name="amountlist" class="amountlist">
<label class="lblSideMenu">Amount</label>
@foreach($AmountList as $Amount)
<input class="chkValues" type="checkbox" value="{{$Amount}}" name="Amount"/><label for="{{$Amount}}">{{$Amount}}</label><br/>
@endforeach
</div>
<hr/>
<label class="lblSideMenu">Color</label>

<!-- Trigger/Open The Modal -->
<button id="myBtn">PickColor</button>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h6>Color Picker</h6>
    </div>
    <div class="modal-body">
    <div id="color" class="changecolor"> 
    </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>

@endsection
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
@endsection
@section('breadcrumbs')
<div id="dynamicBreadCrumbs">

</div>
@endsection


