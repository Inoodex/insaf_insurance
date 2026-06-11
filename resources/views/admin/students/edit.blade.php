@extends('admin.layouts.master')

@section('title', 'Edit Student')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Edit Student: {{ $student->full_name }}</h2>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to List
        </a>
    </div>

    <div class="panel mt-6">
        <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="form-group">
                    <label for="full_name">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" id="full_name" class="form-input" required value="{{ old('full_name', $student->full_name) }}" />
                    @error('full_name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-input" required value="{{ old('email', $student->email) }}" />
                    @error('email') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="passport_number">Passport Number <span class="text-danger">*</span></label>
                    <input type="text" name="passport_number" id="passport_number" class="form-input" required value="{{ old('passport_number', $student->passport_number) }}" />
                    @error('passport_number') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-input" required value="{{ old('date_of_birth', $student->date_of_birth->format('Y-m-d')) }}" />
                    @error('date_of_birth') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="nationality">Nationality <span class="text-danger">*</span></label>
                    <input type="text" name="nationality" id="nationality" class="form-input" required value="{{ old('nationality', $student->nationality) }}" />
                    @error('nationality') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="country_of_origin">Country of Origin <span class="text-danger">*</span></label>
                    <input type="text" name="country_of_origin" id="country_of_origin" class="form-input" required value="{{ old('country_of_origin', $student->country_of_origin) }}" />
                    @error('country_of_origin') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-input" value="{{ old('phone_number', $student->phone_number) }}" />
                    @error('phone_number') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="institute_name">Institute Name <span class="text-danger">*</span></label>
                    <input type="text" name="institute_name" id="institute_name" class="form-input" required value="{{ old('institute_name', $student->institute_name) }}" />
                    @error('institute_name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="institute_phone">Institute Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="institute_phone" id="institute_phone" class="form-input" value="{{ old('institute_phone', $student->institute_phone) }}" />
                    @error('institute_phone') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="institute_address">Institute Address <span class="text-danger">*</span></label>
                    <textarea name="institute_address" id="institute_address" class="form-textarea" required rows="2">{{ old('institute_address', $student->institute_address) }}</textarea>
                    @error('institute_address') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="btn btn-primary px-10">Update Student</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
