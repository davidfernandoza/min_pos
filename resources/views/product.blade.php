@extends('layouts.app')

@section('content')
	<product-list :category="{{$category}}"/>
@endsection
