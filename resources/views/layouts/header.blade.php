<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="description" content="A web-based system using laravel framework for domestic violence's emergency rescue">
    <meta name="keywords" content="Domestic Violence">
    <meta name="author" content="Aiman Shahran">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Request::is('/','home'))
        <title>{{ config ('app.name', 'Laravel') }}</title>
    @elseif(View::hasSection('title'))
        <title> @yield('title') | {{ config ('app.name', 'Laravel') }}</title>
    @else
        <title>{{ ucwords(str_replace(array( '-', '.', 'index', 'show'), ' ', Request::route()->getName())) }} | {{ config ('app.name', 'Laravel') }}</title>
    @endif

    @yield('content')
</html>
