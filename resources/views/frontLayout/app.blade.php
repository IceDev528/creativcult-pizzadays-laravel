<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('frontLayout.header')

@include('frontLayout.navbar')
	          
	  @yield('content')
	     
 @include('frontLayout.footer')