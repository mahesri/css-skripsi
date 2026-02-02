@extends('layouts.app')

@section('content')

 <section class="bg-gray-50">

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

         <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">

          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

              <h1 class="text-xl md:text-2xl font-bold leading-tight ">Complete Your Career Profile</h1>

              <p class="mt-2">Halo, {{ $userName  ?? 'User' }}</p>

        <form action="{{ route('profile.store') }}" method="post">
            @csrf

            {{-- SKILL --}}
            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="skills">
                    Enter skills within the scope of information technology, creative industries, and accounting <small>(separate with commas)</small>
                </label>
                <input
                    type="text"
                    name="skills"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="e.g : accounting, excel, tax"
                    required
                    autofocus
                >
            </div>

            {{-- EXPERIENCE --}}
            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="years_experience">
                    Work Experience (Years)
                </label>
                <input
                    type="number"
                    name="years_experience"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    min="0"
                    required
                >
            </div>

            {{-- PREFERRED ROLE --}}
            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="preferred_role">
                    Preferred Career Role
                </label>
                <select name="preferred_role" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                    <option value="">-- No specific preference --</option>

                    @foreach($roles as $role)
                        <option value="{{$role->role_name}}">{{ $role->role_name }}</option>
                    @endforeach

                </select>

                <small class="text-muted">
                    This choice will influence the recommendation by 25%
                </small>
            </div>

            <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg
              px-4 py-3 mt-6">
                Get Career Recommendations
            </button>
        </form>

    </div>
    </div>
    </div>

 </section>
@endsection
