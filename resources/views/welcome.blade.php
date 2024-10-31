<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100"><style>
    body {
        background-color: #f8f9fa;
    }
    .container-fluid {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .img-fluid {
        max-height: 400px;
        object-fit: cover;
    }
</style>
    <div class="container-fluid px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 mb-4">Bienvenue à la Photothèque des Archives Nationales du Cameroun</h1>
                <p class="lead mb-5">Découvrez notre riche collection d'images et interagissez avec notre communauté.</p>
               <center> <img src="{{ asset('storage/images/OLC.jpeg')}}" class="img-fluid rounded mb-4" alt="Bienvenue à la Photothèque">
                </center> <p class="lead mb-4">Explorez les trésors historiques et culturels du Cameroun à travers notre vaste collection d'images.</p>
                <a href="/login" class="btn btn-primary btn-lg">Commencer l'exploration</a>
            </div>
        </div>
    </div>

