@extends('layout.sidenav-layout')
@section('content')

@include('District.customer-create')
@include('District.customer-list')
@include('District.customer-update')
@include('District.customer-delete')

@endsection