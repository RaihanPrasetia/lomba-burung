@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Criteria</a></li>
                        <li class="breadcrumb-item active">Edit</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- left column -->
                <div>
                    <!-- general form elements -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Criteria </span>
                            </h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('criteria.update', $criteria->id) }}" method="POST">
                            <h3 class="text-center mt-4 text-bold">{{ $criteria->name }}</h3>
                            @csrf
                            @method('PATCH') <!-- Untuk mendukung HTTP PATCH -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Criteria</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $criteria->name }}" placeholder="Masukan nama criteria" required>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Bobot (0-1)</label>
                                    <input type="number" step="0.01" class="form-control" id="weight" name="weight"
                                        value="{{ old('weight', $criteria->weight) }}" placeholder="Masukan bobot criteria"
                                        min="0" max="100" required>
                                    @error('weight')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" required>
                                        <option value="benefit">Benefit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
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
