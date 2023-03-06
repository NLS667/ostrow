@extends('frontend.layouts.app')

@section('content')
@include('frontend.includes.header')
<div class="main">
    <div class="section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="title">Teltopanel</h2>
                    <h5 class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend eget metus ac venenatis. Ut porta urna ante, vitae tempor mauris facilisis quis. Integer ligula felis, tempus ut nisi at, mattis cursus ipsum. Donec faucibus sagittis ligula, sit amet ultrices nisi malesuada vel</h5>
                    <br>
                    <a href="#" class="btn btn-primary-blue btn-round">Szczegóły</a>
                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-primary-blue">
                            <i class="nc-icon nc-album-2"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Teltopanel 1</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend eget metus ac venenatis.</p>
                            <a href="#pkp" class="btn btn-link btn-primary-blue">{{ trans('buttons.general.see_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-primary-blue">
                            <i class="nc-icon nc-bulb-63"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Teltopanel 2</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend eget metus ac venenatis.</p>
                            <a href="#pkp" class="btn btn-link btn-primary-blue">{{ trans('buttons.general.see_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-primary-blue">
                            <i class="nc-icon nc-chart-bar-32"></i>
                        </div>
                         <div class="description">
                            <h4 class="info-title">Teltopanel 3</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend eget metus ac venenatis.</p>
                            <a href="#pkp" class="btn btn-link btn-primary-blue">{{ trans('buttons.general.see_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-primary-blue">
                            <i class="nc-icon nc-sun-fog-29"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Teltopanel 4</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend eget metus ac venenatis.</p>
                            <a href="#pkp" class="btn btn-link btn-primary-blue">{{ trans('buttons.general.see_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section landing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="text-center">{{ trans('frontpage.contact.title') }}</h2>
                    <form class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ trans('frontpage.contact.fields.name.label') }}</label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-single-02"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ trans('frontpage.contact.fields.name.placeholder') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>{{ trans('frontpage.contact.fields.email.label') }}</label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                             <i class="nc-icon nc-email-85"></i>
                                         </span>
                                     </div>
                                    <input type="text" class="form-control" placeholder="{{ trans('frontpage.contact.fields.email.placeholder') }}">
                                </div>
                            </div>
                        </div>
                        <label>{{ trans('frontpage.contact.fields.message.label') }}</label>
                        <textarea class="form-control" rows="4" placeholder="{{ trans('frontpage.contact.fields.message.placeholder') }}"></textarea>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button class="btn btn-primary-blue btn-lg btn-fill">{{ trans('frontpage.contact.button') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>       
@endsection