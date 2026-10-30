@extends('layouts.app')

@section('content')
    @include('portfolio.partials.hero')
    @include('portfolio.partials.about')
    @include('portfolio.partials.projects')
    @include('portfolio.partials.experience')
    @include('portfolio.partials.skills')
    @include('portfolio.partials.certifications')
    @include('portfolio.partials.education')
    @include('portfolio.partials.contact')
    @include('portfolio.partials.preview-modal')
    @include('portfolio.partials.i18n-dictionary')
@endsection
