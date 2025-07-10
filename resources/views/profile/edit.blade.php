 @extends('website.layout.content')
 @section('webcontent')
     <main class="main">

         <!-- Page Title -->
         <div class="page-title light-background">
             <div class="container">
                 <nav class="breadcrumbs">
                     <ol>
                         <li><a href="index.html">Home</a></li>
                         <li class="current">Account</li>
                     </ol>
                 </nav>
                 <h1>Account</h1>
             </div>
         </div><!-- End Page Title -->
         <!-- Account Section -->
         <section id="account" class="account section">

             <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                 <!-- Mobile Sidebar Toggle Button -->
                 <div class="sidebar-toggle d-lg-none mb-3">
                     <button class="btn btn-toggle" type="button" data-bs-toggle="collapse"
                         data-bs-target="#profileSidebar" aria-expanded="false" aria-controls="profileSidebar">
                         <i class="bi bi-list me-2"></i> Profile Menu
                     </button>
                 </div>

                 <div class="row">
                     <div class="col-lg-9 profile-content aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                         <div class="tab-content" id="profileTabsContent">
                             <!-- Personal Info Tab -->
                             <div class="tab-pane active show fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                 <div class="tab-header">
                                     <h2>Personal Information</h2>
                                 </div>
                                    @include('profile.partials.update-profile-information-form')
                             </div>
                             <div class="tab-pane active show fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                 <div class="tab-header">
                                     <h2>Remove Account</h2>
                                 </div>
                                    @include('profile.partials.delete-user-form')
                             </div>

                         </div>
                     </div>
                 </div>

             </div>

         </section><!-- /Account Section -->

     </main>
 @endsection

 {{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
