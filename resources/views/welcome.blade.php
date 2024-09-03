@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 mb-4">Bienvenue à la Photothèque des Archives Nationales du Cameroun</h1>
                <p class="lead mb-5">Découvrez notre riche collection d'images et interagissez avec notre communauté.</p>
               <center> <img src="{{ asset('storage/images/OLC.jpeg')}}" class="img-fluid rounded mb-4" alt="Bienvenue à la Photothèque">
                </center> <p class="lead mb-4">Explorez les trésors historiques et culturels du Cameroun à travers notre vaste collection d'images.</p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Commencer l'exploration</a>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
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
@endsection
