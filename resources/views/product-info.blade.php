@extends('layouts.app')

@section('content')
	<product-info :product="{{$product}}" auth_id="{{isset(Auth::user()->id)? Auth::user()->id: ''}}"/>
@endsection
