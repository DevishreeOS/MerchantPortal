@extends('master')
@section('maincontent')
<div class="container">
  <div class="row">
  @foreach ($users as $row)
  <div class="col-md-4">
      <div class="thumbnail">
      <img src="data:image/png;base64,{{ chunk_split(base64_encode(($row->CompanyLogo))) }}"  height="180" width="150"/>
  <div class="caption">
           <center> <a href="{{url('name/'.$row->CompanyName)}}">{{$row->CompanyName}}</a></center>
          </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
@endsection
@section('sidemenu')
<a href="{{url('clientRegister')}}">Add</a>
<a href="{{url('clientdetails')}}">View</a>
@endsection
@section('stylecontent')
<style>
.sidenav{
  height:700px;
}
</style>
@endsection


