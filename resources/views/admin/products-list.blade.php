@extends('layouts.admin')

@section('content')
	<product-list-admin :products="{{$products}}"/>
@endsection
