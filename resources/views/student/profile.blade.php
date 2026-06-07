@extends('student.layouts.app')

@section('title', 'User Profile')

@section('content')
    <div x-data="{}">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-[#4A3B75]">User Profile</h2>
                <div class="flex gap-4">
                    <button @click="$dispatch('open-modal', { name: 'edit-profile', tab: 'address' })" class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 text-[10px] font-bold text-[#8E79F0] uppercase tracking-widest hover:bg-gray-50">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Address
                    </button>
                    <button @click="$dispatch('open-modal', { name: 'edit-profile', tab: 'password' })" class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 text-[10px] font-bold text-[#8E79F0] uppercase tracking-widest hover:bg-gray-50">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Change Password
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-medium">
                    Please check the form for errors.
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="space-y-8">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-50">
                        <div class="space-y-6">
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Name</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700 uppercase tracking-wide">{{ $student->full_name }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Address</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700 leading-relaxed">{{ $student->institute_address }} {{ $student->address_2 }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Zip Code</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->zip_code ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">City</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->city ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Country</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->country_of_origin }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Phone Number</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->country_code }} {{ $student->phone_number }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Correspondence Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-50 relative">
                        <button @click="$dispatch('open-modal', { name: 'edit-profile', tab: 'correspondence' })" class="absolute top-8 right-8 w-9 h-9 rounded-full flex items-center justify-center transition-all student-icon-action" title="Edit correspondence address">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <h4 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-8">Correspondence</h4>
                        <div class="space-y-6">
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Name</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700 uppercase">{{ $student->correspondence_firstname }} {{ $student->correspondence_lastname }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Address</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->correspondence_address_1 }} {{ $student->correspondence_address_2 }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Zip Code</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->correspondence_zip_code ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">City</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->correspondence_city ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Country</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->correspondence_country ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Phone Number</span>
                                <span class="col-span-2 text-sm font-medium text-gray-700">{{ $student->correspondence_country_code }} {{ $student->correspondence_phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Image / Illustration -->
                <div class="hidden md:flex flex-col items-center justify-center pt-12 opacity-80">
                    <img src="{{ asset('assets/images/profile-illustration.png') }}" alt="Profile" class="max-h-[500px] object-contain opacity-90 mix-blend-multiply">
                </div>
            </div>
        </div>

        <!-- Unified Edit Profile Modal -->
        <div x-data="{ 
                open: @json($errors->any()), 
                tab: '{{ session('form_type', 'address') }}' 
             }" 
             @open-modal.window="if($event.detail.name === 'edit-profile') { open = true; tab = $event.detail.tab || 'address' }" 
             x-show="open" 
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/20 backdrop-blur-sm" 
             x-cloak x-transition>
            
            <div class="bg-white rounded-3xl p-12 w-full max-w-2xl shadow-2xl relative max-h-[90vh] overflow-y-auto" @click.away="open = false">
                <!-- Close Button -->
                <button @click="open = false" class="absolute top-6 left-6 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-200 transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>

                <!-- Modal Tabs -->
                <div class="flex justify-center gap-8 mb-12 border-b border-gray-50 pb-4">
                    <button @click="tab = 'address'" :class="tab === 'address' ? 'text-[#4A3B75] border-b-2 border-[#8E79F0]' : 'text-gray-500'" class="pb-2 text-[10px] font-bold uppercase tracking-widest transition-all">Address</button>
                    <button @click="tab = 'correspondence'" :class="tab === 'correspondence' ? 'text-[#4A3B75] border-b-2 border-[#8E79F0]' : 'text-gray-500'" class="pb-2 text-[10px] font-bold uppercase tracking-widest transition-all">Correspondence Address</button>
                    <button @click="tab = 'password'" :class="tab === 'password' ? 'text-[#4A3B75] border-b-2 border-[#8E79F0]' : 'text-gray-500'" class="pb-2 text-[10px] font-bold uppercase tracking-widest transition-all">Change Password</button>
                </div>

                <!-- Tab Content: Address -->
                <div x-show="tab === 'address'" x-transition>
                    <h3 class="text-3xl font-bold text-[#4A3B75] text-center mb-12">Edit Address</h3>
                    <form action="{{ route('student.profile.address') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Address 1</label>
                                <input type="text" name="institute_address" value="{{ old('institute_address', $student->institute_address) }}" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('institute_address') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Address 2</label>
                                <input type="text" name="address_2" value="{{ old('address_2', $student->address_2) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('address_2') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Country</label>
                                <input type="text" name="country_of_origin" value="{{ old('country_of_origin', $student->country_of_origin) }}" placeholder="Enter country name" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('country_of_origin') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Zip Code</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code', $student->zip_code) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('zip_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">City</label>
                                <input type="text" name="city" value="{{ old('city', $student->city) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('city') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Country Code</label>
                                <input type="text" name="country_code" value="{{ old('country_code', $student->country_code ?? '+ 880') }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('country_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('phone_number') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-12 flex justify-center">
                            <button type="submit" class="px-12 py-4 bg-gradient-to-r from-[#8E79F0] to-[#A294F9] text-white rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-purple-100 hover:scale-105 transition-transform">Save</button>
                        </div>
                    </form>
                </div>

                <!-- Tab Content: Correspondence -->
                <div x-show="tab === 'correspondence'" x-transition>
                    <h3 class="text-3xl font-bold text-[#4A3B75] text-center mb-12">Edit Correspondence Address</h3>
                    <form action="{{ route('student.profile.correspondence') }}" method="POST">
                        @csrf
                        <div class="mb-8 flex items-center gap-4">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="is_company" value="1" {{ old('is_company', $student->is_company) ? 'checked' : '' }} class="hidden peer">
                                <div class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center bg-gray-50 peer-checked:border-[#8E79F0] peer-checked:bg-[#8E79F0] transition-all">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" class="peer-checked:block"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>
                                <span class="text-xs font-medium text-gray-400">I'm a company</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Firstname</label>
                                <input type="text" name="correspondence_firstname" value="{{ old('correspondence_firstname', $student->correspondence_firstname) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_firstname') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Lastname</label>
                                <input type="text" name="correspondence_lastname" value="{{ old('correspondence_lastname', $student->correspondence_lastname) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_lastname') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Gender</label>
                                <div class="flex bg-gray-50/50 p-1 rounded-full w-max border border-gray-50">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="correspondence_gender" value="male" class="hidden peer" {{ old('correspondence_gender', $student->correspondence_gender) == 'male' ? 'checked' : '' }}>
                                        <span class="px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest inline-block transition-all peer-checked:bg-gradient-to-r peer-checked:from-[#8E79F0] peer-checked:to-[#A294F9] peer-checked:text-white text-gray-300">Male</span>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="correspondence_gender" value="female" class="hidden peer" {{ old('correspondence_gender', $student->correspondence_gender) == 'female' ? 'checked' : '' }}>
                                        <span class="px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest inline-block transition-all peer-checked:bg-gradient-to-r peer-checked:from-[#8E79F0] peer-checked:to-[#A294F9] peer-checked:text-white text-gray-300">Female</span>
                                    </label>
                                </div>
                                @error('correspondence_gender') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Address 1</label>
                                <input type="text" name="correspondence_address_1" value="{{ old('correspondence_address_1', $student->correspondence_address_1) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_address_1') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Address 2</label>
                                <input type="text" name="correspondence_address_2" value="{{ old('correspondence_address_2', $student->correspondence_address_2) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_address_2') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Country</label>
                                <input type="text" name="correspondence_country" value="{{ old('correspondence_country', $student->correspondence_country) }}" placeholder="Enter country name" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_country') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Zip Code</label>
                                <input type="text" name="correspondence_zip_code" value="{{ old('correspondence_zip_code', $student->correspondence_zip_code) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_zip_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">City</label>
                                <input type="text" name="correspondence_city" value="{{ old('correspondence_city', $student->correspondence_city) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_city') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Country Code</label>
                                <input type="text" name="correspondence_country_code" value="{{ old('correspondence_country_code', $student->correspondence_country_code) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_country_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                                <input type="text" name="correspondence_phone" value="{{ old('correspondence_phone', $student->correspondence_phone) }}" class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('correspondence_phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-12 flex justify-center">
                            <button type="submit" class="px-12 py-4 bg-gradient-to-r from-[#8E79F0] to-[#A294F9] text-white rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-purple-100 hover:scale-105 transition-transform">Save</button>
                        </div>
                    </form>
                </div>

                <!-- Tab Content: Password -->
                <div x-show="tab === 'password'" x-transition>
                    <h3 class="text-3xl font-bold text-[#4A3B75] text-center mb-12">Change Password</h3>
                    <form action="{{ route('student.profile.password') }}" method="POST">
                        @csrf
                        <div class="space-y-8 max-w-md mx-auto">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Old Password</label>
                                <input type="password" name="current_password" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('current_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="relative">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">New Password</label>
                                <input type="password" name="password" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                                @error('password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">New Password Again</label>
                                <input type="password" name="password_confirmation" required class="w-full border-b border-gray-300 py-2 outline-none focus:border-[#8E79F0] text-sm font-medium text-gray-700">
                            </div>
                        </div>
                        <div class="mt-12 flex justify-center">
                            <button type="submit" class="px-12 py-4 bg-gradient-to-r from-[#8E79F0] to-[#A294F9] text-white rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-purple-100 hover:scale-105 transition-transform">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
