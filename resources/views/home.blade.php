@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <template>
  
                <div class="flex-center position-ref full-height">
                    <div class="content">
                        <example-component></example-component>
                    </div>
                </div>

                </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
