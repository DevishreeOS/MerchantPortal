@extends('master')
@section('maincontent')
@foreach($clientDetails as $client)
<div aling="center" style="margin-left:180px;">
<img src="data:image/png;base64,{{ chunk_split(base64_encode(($client->CompanyLogo))) }}"  height="80" width="200"/>
<h5>CompanyName-{{$client->CompanyName}}</h5>
<h5>CreatedBy-{{$client->CreatedBy}}</h5>
<h5>UpdatedBy-{{$client->UpdatedBy}}</h5>
<h5>CreatedOn-{{$client->CreatedOn}}</h5>
<h5>UpdatedOn-{{$client->UpdatedOn}}</h5>
@endforeach
</div>
@endsection
@section('sidemenu')
<a href="{{url('clientRegister')}}">Add</a>
<a href="{{url('clientdetails')}}">View</a>
@endsection
