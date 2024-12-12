@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('class.index') }}">CLass</a></li>
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
                            <h3 class="card-title">Buat Class</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('class.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Class</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan nama class" required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Perlombaan</label>
                                    <select class="form-control" name="competition_id" required>
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Juri</label><br>
                                    @foreach ($judges as $judge)
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox"
                                                id="judge_{{ $judge->id }}" value="{{ $judge->id }}"
                                                name="judge_id[]">
                                            <label for="judge_{{ $judge->id }}" class="custom-control-label">
                                                {{ $judge->name }}</label>
                                        </div>
                                    @endforeach
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
