<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{-- {{$title}}  --}}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            @vite(['resources/scss/light/assets/authentication/auth-cover.scss'])
            @vite(['resources/scss/dark/assets/authentication/auth-cover.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="auth-container d-flex">

                <div class="container mx-auto align-self-center">

                    <div class="row">

                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                            <div class="auth-cover-bg-image"></div>
                            <div class="auth-overlay"></div>

                            <div class="auth-cover">

                                <div class="position-relative">

                                    <img src="{{ Vite::asset('resources/images/auth-cover.svg') }}" alt="auth-img">

                                    <h2 class="mt-5 text-white font-weight-bolder px-2">Join the community of expert
                                        developers</h2>
                                    <p class="text-white px-2">It is easy to setup with great customer experience. Start
                                        your 7-day free trial</p>
                                </div>

                            </div>

                        </div>

                        <div
                            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror" />
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" />
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember-me" />
                                            <label class="form-check-label" for="remember-me"> Remember me </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </form>
                                </div>

                            </div>

                            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
                            <x-slot:footerFiles>

                                </x-slot>
                                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
