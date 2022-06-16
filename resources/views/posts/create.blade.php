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
                        <div class="mb-4 card card-primary">
                            @if(isset($status))
                                <div class="alert alert-{{ $status ? 'success' : 'danger' }}">
                                    {{ $message }}
                                </div>
                            @endif
                            @include('posts.form',[
                                'action' => route('post.create')
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection