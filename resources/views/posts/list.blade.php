@extends('master')

@section('content')
    <div class="content-wrapper" style="min-height: 1604.44px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>

                    <div class="card-tools">
                        <a href="{{ route('post.create.ui') }}" class="btn btn-info">
                            Thêm mới
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(session()->has('status'))
                        <div class="mb-4 alert alert-{{ session('status') ? 'success' : 'danger' }}">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 20%">
                                Tiêu đề
                            </th>
                            <th style="width: 30%">
                                Slug
                            </th>
                            <th>
                                Trạng thái
                            </th>
                            <th>
                                Thời gian tạo
                            </th>
                            <th>
                                Thời gian cập nhật
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($postList as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->title }}
                                </td>
                                <td>
                                    {{ $item->slug }}
                                </td>
                                <td class="project-state">
                                    @if($item->status == 1)
                                        <span class="badge badge-success">Thành công</span>
                                    @else
                                        <span class="badge badge-danger">Thất bại</span>
                                    @endif
                                </td>
                                <td>
                                    {{  \Carbon\Carbon::parse($item->created_at)->format('H:i d/m/Y') }}
                                </td>

                                <td>
                                    {{  \Carbon\Carbon::parse($item->updated_at)->format('H:i d/m/Y') }}
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('post.edit',['id' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="{{ route('post.delete',['id' => $item->id] ) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
