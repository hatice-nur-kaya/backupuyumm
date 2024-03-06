@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('log-viewer.index')}}" target="_blank" class="btn btn-primary">Log Viewer</a>
                        <button class="btn btn-secondary">Telescope</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
