<x-admin-layout>
<div>
    <section class="section">
                <div class="section-header">
                    <h1>{{ __('Dashboard') }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>                                              
                    </div>
                </div>

                <div class="section-body">
                    @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif

                    <h2 class="section-title">{{ __('You are logged in!') }}</h2>

                </div>
    </section>
</div>
</x-admin-layout>
