@extends('layouts.master')
 
@section('content')
  <p>This will be overwrite</p>
@stop
 
@section('sidebar')
  @parent
   
  <a href=”#”>Section specific links will get appended…</a>
@stop