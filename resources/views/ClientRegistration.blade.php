@extends('master')
@section('maincontent')
<form method="post" action='/saveClientDetails' enctype="multipart/form-data">
@csrf
<div class="form-group">
<label class="col-md-4 text-right">Enter CompanyName</label>
<div class="col-md-4">
<input type="text" name="companyName" class="form-control input-sm"/>
</div>
</div>
<br/><br/>
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
@endsection
@section('sidemenu')
<a href="{{url('clientRegister')}}">Add</a>
<a href="{{url('clientdetails')}}">View</a>
@endsection
