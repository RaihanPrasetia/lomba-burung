@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Criteria</a></li>
                        <li class="breadcrumb-item active">Create</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- left column -->
                <div>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buat Criteria</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('criteria.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Criteria</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan nama criteria" required>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Bobot (0-1)</label>
                                    <input type="number" step="any" class="form-control" id="weight" name="weight"
                                        placeholder="Masukkan bobot criteria (contoh: 0.5)" required>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" required>
                                        <option value="benefit">Benefit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
