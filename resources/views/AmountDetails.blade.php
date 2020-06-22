<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
.main { 
            display: block; 
            position: relative; 
            padding-left: 45px; 
            margin-bottom: 15px; 
            cursor: pointer; 
            font-size: 20px; 
        } 
          
        /* Hide the default checkbox */ 
        input[type=checkbox] { 
            visibility: hidden; 
        } 
          
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
        .main:hover input ~ .geekmark { 
        } 
          
        /* Specify the background color to be 
        shown when checkbox is active */ 
        .main input:active ~ .geekmark { 
        } 
          
        /* Specify the background color to be 
        shown when checkbox is checked */ 
        .main input:checked ~ .geekmark { 
        } 
          
        /* Checkmark to be shown in checkbox */ 
        /* It is not be shown when not checked */ 
        .geekmark:after { 
            content: ""; 
            position: absolute; 
            display: none; 
        } 
          
        /* Display checkmark when checked */ 
        .main input:checked ~ .geekmark:after { 
            display: block; 
        } 
          
        /* Styling the checkmark using webkit */ 
        /* Rotated the rectangle by 45 degree and  
        showing only two border to make it look 
        like a tickmark */ 
        .main .geekmark:after { 
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
<script>
$(document).ready(function() {
        $(".btncolor").click(function(){
     var op="";
     var categoryID=2007;
    $.ajax({
      type:'get',
      url:'{!!URL::to('getColor')!!}',
      data:{'id':categoryID},
      success:function(data)
      {
         console.log(data);
         for(var i=0;i<data.length;i++)
         {
           
            op+='<label class="main"><input type="checkbox" name="Color" value="'+data[i].Color+'"/><span class="geekmark" style="background-color:'+data[i].Color+';"></span></label>';
           
         }  
         $("#color").html("");
         $("#color").append(op);
      }
    });
  });
});
$(document).ready(function() {
        $("#filter").click(function(){
            var color = [];
            color.push(0);
            $.each($("input[name='Color']:checked"), function(){            
                color.push($(this).val());
            });
            alert("My favourite sports are: " + color.join(", "));
            
            var link=document.getElementById("result");
            //link.href="";
            link.href="{{url('checkcolor/')}}"+"/"+color;
        
        });
    });

</script>
</head>
<body>

<h2>Color</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn">PickColor</button>
<button id="filter">Filter</button>
<a id="result">Fetch</a>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <button type="button" class="btncolor">Get</button>
      <h2>Color Picker</h2>
    </div>
    <div class="modal-body">
    <div id="color" class="changecolor"> 
    </div>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

</div>

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
</body>
</html>
