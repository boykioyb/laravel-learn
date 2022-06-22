@extends('master')

@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">
                            @if(session()->has('status'))
                                <div class="mb-4 alert alert-{{ session('status') ? 'success' : 'danger' }}">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @include('posts.form',[
                                'postView' => $postController,
                                'action' => route('post.update')
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
