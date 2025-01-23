@extends('layouts.frontend')
@section('content')
<div class="container min-vh-100 d-flex flex-column justify-content-center">
            <div class="text-center">
                <h1 class="display-3 font-weight-bold text-dark">Connect with Pet Lovers in Your Community</h1>
                <p class="lead text-secondary">Share the joy of pet care. Earn credits by caring for others' pets and use them when you need care for your own.</p>
                <a href="#" class="btn btn-danger btn-lg mt-3">Start Exploring</a>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title h5 font-weight-bold text-dark">List Your Pets</h2>
                            <p class="card-text text-secondary">Add your pets to our community and find trusted caregivers when you need them.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title h5 font-weight-bold text-dark">Care for Pets</h2>
                            <p class="card-text text-secondary">Browse available pets and offer your care services to earn credits.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title h5 font-weight-bold text-dark">Earn & Use Credits</h2>
                            <p class="card-text text-secondary">Build up your credit balance by pet sitting and use them for your own pets.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <h2 class="display-5 font-weight-bold text-dark">Simple, Transparent Pricing</h2>
                <p class="lead text-secondary">Choose the perfect plan for your pet care needs</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h3 class="card-title h5 font-weight-bold text-dark">Free</h3>
                            <p class="card-text text-secondary">$0/month</p>
                            <ul class="list-unstyled text-secondary mb-4">
                                <li>1 pet profile</li>
                                <li>1 request per month</li>
                                <li>Email notifications</li>
                            </ul>
                            <a href="#" class="btn btn-danger btn-lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100 bg-light">
                        <div class="card-body text-center">
                            <h3 class="card-title h5 font-weight-bold text-dark">Standard</h3>
                            <p class="card-text text-secondary">$9.99/month</p>
                            <ul class="list-unstyled text-secondary mb-4">
                                <li>Up to 3 pet profiles</li>
                                <li>3 requests per month</li>
                                <li>Email notifications</li>
                                <li>SMS notifications</li>
                            </ul>
                            <a href="#" class="btn btn-danger btn-lg">Subscribe</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h3 class="card-title h5 font-weight-bold text-dark">Premium</h3>
                            <p class="card-text text-secondary">$19.99/month</p>
                            <ul class="list-unstyled text-secondary mb-4">
                                <li>Unlimited pet profiles</li>
                                <li>5 requests per month</li>
                                <li>Email notifications</li>
                                <li>SMS notifications</li>
                            </ul>
                            <a href="#" class="btn btn-danger btn-lg">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="#" class="text-danger">View full plan details →</a>
            </div>

            <div class="accordion mt-5" id="faqAccordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What is Pet Care Community?
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body">
                        Pet Care Community is a platform where pet owners can connect with trusted caregivers to look after their pets.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How do I earn credits?
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                    <div class="card-body">
                        You can earn credits by offering pet care services to other members of the community.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How do I use my credits?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                    <div class="card-body">
                        You can use your credits to request pet care services from other members of the community.
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-secondary">&copy; <?php echo date('Y'); ?> Pet Care Community. All rights reserved.</p>
        </div>
        </div>

        
@endsection