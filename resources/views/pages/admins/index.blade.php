@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   
                    Admin Portal
                </div>

                <div class="card-body">
                <template>
  
                    <div class="flex-center position-ref full-height">
                        <div class="content">
                        
                            <user-list :cuser='{{Auth::user()}}'></user-list>
                            
                        </div>
                    </div>

                </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
