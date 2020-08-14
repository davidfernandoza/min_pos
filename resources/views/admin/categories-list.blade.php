@extends('layouts.admin')

@section('content')
<admin-body :data="{{$categories}}" view_type="categories"/>
@endsection
