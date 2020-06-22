@extends('master')
@section('stylecontent')
<style>
.pagination li {
    display: inline;
    margin-left: 0.5em;
    margin-right: 0.5em;
}
</style>
@endsection
@section('maincontent')  
<table class="table table-bordered">
<thead>
<tr>
<th width="10%">CompanyName</th>
<th width="10%">CompanyLogo</th>
<th width="20%">Action</th>
</tr>
</thead>
<tbody>
@foreach($clientList as $client)
<tr>
<td width="10%">{{ $client->CompanyName }}</td>
<td width="10%"><img src="data:image/png;base64,{{ chunk_split(base64_encode(($client->CompanyLogo))) }}"  height="80" width="200"/></td>
<td><a href="{{url('showClientDetails/'.$client->ClientID)}}" class="btn btn-primary">View</a><a href="{{url('editClientDetails/'.$client->ClientID)}}" class="btn btn-warning">Edit</a><a href="{{url('deleteClientDetails/'.$client->ClientID)}}" class="btn btn-danger">Delete</a></td>
</tr>
@endforeach
</tbody>
</table>
<div class="pagination">{{  $clientList->links() }}</div>
@endsection
@section('sidemenu')
<a href="{{url('clientRegister')}}">Add</a>
<a href="{{url('clientdetails')}}">View</a>
@endsection
