@extends('layout.template')
@section('content')
    <div class="d-flex">
        <p class="col h3 mb-0">Profil</p>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/12/User_icon_2.svg" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                    <p class="text-muted mb-1 mt-2">
                        <?php
                        if (auth()->user()->level == 'superadmin') {
                            echo 'Super Admin';
                        } elseif (auth()->user()->level == 'admin') {
                            echo 'Admin';
                        } else {
                            echo 'User';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ auth()->user()->username }}</p>
                        </div>
                    </div>

                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
