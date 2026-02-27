@extends('layouts.main')
@section('content')
<main class="flex-1 h-full overflow-y-auto overflow-x-hidden">
<div class="max-w-[800px] mx-auto p-6 md:p-8 space-y-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:px-6 lg:px-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Profile</h1>
            <p class="text-slate-500 mt-1">Overview of your profile<span class="font-medium text-slate-900"></span></p>
        </div>
    </div>
    <div class="py-4">
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
</div>
</main>
@endsection
