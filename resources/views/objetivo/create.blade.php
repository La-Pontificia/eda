@extends('layouts.maintenance')

@section('template_title')
    {{ __('Create') }} Objetivo
@endsection

@section('content-2')
    <section class="content container-fluid" style="z-index:2">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Objetivo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('objetivos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('objetivo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
