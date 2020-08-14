@extends('layouts.admin')

@section('content')
	<admin-body :data="{{$products}}" view_type="products"/>
@endsection
