@extends('layouts.app')

@section('content')   

<div class="card">
    <div class="card-header">
        Profile
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ $user->profile_image }}" alt="Profile Image" class="img-fluid">
            </div>
            <div class="col-md-9">
                <h5 class="card-title">{{ $user->nom }} {{ $user->prenom }}</h5>
                <p class="card-text">
                    <strong>Username :</strong> {{ $user->pseudo }}<br>
                    <strong>Email :</strong> {{ $user->email }}<br>
                    <strong>Date of Birth :</strong> {{ $user->date_naissance->format('d/m/Y') }}
                </p>
                <div class="btn-group" role="group" aria-label="Profile Actions">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection