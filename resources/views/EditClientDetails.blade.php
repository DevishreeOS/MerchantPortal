@extends('master')
@section('maincontent')
@foreach($clientDetails as $client)

<form method="post" action="{{url('updateClientDetails/'.$client->ClientID)}}" enctype="multipart/form-data">
@csrf
<div class="form-group">
<label class="col-md-4 text-right">Enter CompanyName</label>
<div class="col-md-4">
<input type="text" name="companyName" class="form-control input-sm" value="{{$client->CompanyName}}"/>
</div>
</div>
<br/><br/>
<div class="form-group">
<label class="col-md-4 text-right">Select CompanyLogo</label>
<div class="col-md-4">
<input type="file" name="companyLogo"/>
<img src="data:image/png;base64,{{ chunk_split(base64_encode(($client->CompanyLogo))) }}"  height="80" width="200"/>
<input type="hidden" name="hiddenImage" value="data:image/png;base64,{{ chunk_split(base64_encode(($client->CompanyLogo))) }}"/> 
</div>
</div>
<br/><br/><br/><br/><br/>
@endforeach
<div class="form-group text-center">
<input type="submit" name="edit" class="btn btn-primary input-sm" value="Update"/>
</div>
</form>
@endsection
@section('sidemenu')
<a href="{{url('clientRegister')}}">Add</a>
<a href="{{url('clientdetails')}}">View</a>
@endsection

