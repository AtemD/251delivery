@extends('layouts.app')

@section('title', '| Welcome')

@section('content')
    <div class="jumbotron text-center">
        <div class="container">
            
            <h1 class="h1">251<span class="text-success">Delivery</span></h1>
            <p class="lead">Your favorite restaurants and meals, delivered to you.</p>
            <hr class="my-4">

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <form class="form" role="form" method="GET" class="form-control" action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('city_name') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="city">Select your city</label>
                                            <select class="custom-select form-control mb-2 mr-sm-2" id="city" name="city_name" required>
                                                <option value="" selected>Select your city...</option>
                                                    <option value="Hawassa">Hawassa</option>
                                                    <option value="Hawassa">Addis</option>
                                            </select>
                
                                            @if ($errors->has('city_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-success btn-block mb-2">Search Items &raquo;</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="/uploads/website/menu.jpg" height="300" width="120"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Do you own a restaurant?</h5>
                        <p class="card-text"><a href="#" class="text-success">Add your restaurant.</a></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card  mb-4 shadow-sm">
                    <img src="/uploads/website/roller.jpg" height="300" width="120" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Deliver the food</h5>
                        <p class="card-text"><a href="#" class="text-success">Sign up to deliver.</a></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card  mb-4 shadow-sm">
                    <img src="/uploads/website/grocery.jpg" height="300" width="120"  class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Want food delivered to you?</h5>
                        <p class="card-text"><a href="/register" class="text-success">Sign up for special service.</a></p>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
@endsection

