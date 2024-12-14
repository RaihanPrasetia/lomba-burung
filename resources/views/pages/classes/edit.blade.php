@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('class.index') }}">Class</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit Class</h3>
                    </div>

                    <form action="{{ route('class.update', $class->id) }}" method="POST">
                        <h3 class="text-center mt-4 text-bold">{{ $class->name }}</h3>
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Class</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $class->name) }}" placeholder="Masukan nama class" required>
                            </div>

                            <div class="form-group">
                                <label>Pilih Perlombaan</label>
                                <select class="form-control" name="competition_id" required>
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}"
                                            {{ $class->competition_id == $competition->id ? 'selected' : '' }}>
                                            {{ $competition->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pilih Juri</label><br>
                                @foreach ($judges as $judge)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="judge_{{ $judge->id }}"
                                            value="{{ $judge->id }}" name="judge_id[]"
                                            {{ $class->class_participants->pluck('judge_id')->contains($judge->id) ? 'checked' : '' }}>
                                        <label for="judge_{{ $judge->id }}"
                                            class="custom-control-label">{{ $judge->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Pilih Criteria</label><br>
                                @foreach ($criterias as $criteria)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox"
                                            id="criteria_{{ $criteria->id }}" value="{{ $criteria->id }}"
                                            name="criteria_id[]"
                                            {{ $class->class_criterias->pluck('criteria_id')->contains($criteria->id) ? 'checked' : '' }}>
                                        <label for="criteria_{{ $criteria->id }}"
                                            class="custom-control-label">{{ $criteria->name }} -
                                            <span>{{ $criteria->weight }}</span></label>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
