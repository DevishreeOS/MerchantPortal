<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>
<body>
<form method="post" action='/demosave' enctype="multipart/form-data">
@csrf
<div class="form-group">
<label class="col-md-4 text-right">Select CompanyLogo</label>
<div class="col-md-4">
<input type="file" name="companyLogo"/>
</div>
</div>
<br/><br/>
<div class="form-group text-center">
<input type="submit" name="save" class="btn btn-primary input-sm" value="Add"/>
</div>
</form>
</body>
</html>

