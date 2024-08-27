@extends('layouts.app')

@section('styles')
<style>
    /* Modal styles for simplicity */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
</style>
@stop

@section('content')
<section class="content">
    <div class="col-12">
        <div class="box">
            <div class="box-header no-border">
                <h3 class="box-title">Profile</h3>
            </div>
        </div>
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')

    </div>
</section>
@stop
