@extends('layout')

@section('content')
    <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Board</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as administrator!
                </div>
            </div>
        </div>
    </div>
        <button class="btn btn-primary" onclick="window.location='{{ route('export')}}'">
            exporteer overzicht
        </button>
</div>
@endsection
