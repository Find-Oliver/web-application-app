@include('employees._styles')

@php($isEditing = isset($employee) && $employee->exists)

<form class="employee-form" action="{{ $isEditing ? route('employees.update', $employee) : route('employees.store') }}" method="POST">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="employee-form-grid">
        <div class="employee-field">
            <label for="employee_code">Employee code</label>
            <input id="employee_code" name="employee_code" value="{{ old('employee_code', $employee?->employee_code) }}" maxlength="50" required autocomplete="off">
            @error('employee_code') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="email">Work email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $employee?->email) }}" maxlength="100" required autocomplete="email">
            @error('email') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="first_name">First name</label>
            <input id="first_name" name="first_name" value="{{ old('first_name', $employee?->first_name) }}" maxlength="100" required autocomplete="given-name">
            @error('first_name') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="middle_name">Middle name</label>
            <input id="middle_name" name="middle_name" value="{{ old('middle_name', $employee?->middle_name) }}" maxlength="100" autocomplete="additional-name">
            @error('middle_name') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="last_name">Last name</label>
            <input id="last_name" name="last_name" value="{{ old('last_name', $employee?->last_name) }}" maxlength="100" required autocomplete="family-name">
            @error('last_name') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="suffix">Suffix</label>
            <input id="suffix" name="suffix" value="{{ old('suffix', $employee?->suffix) }}" maxlength="20" placeholder="Jr., Sr., III">
            @error('suffix') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="phone">Phone</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', $employee?->phone) }}" maxlength="20" required autocomplete="tel">
            @error('phone') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="date_of_birth">Date of birth</label>
            <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee?->date_of_birth?->format('Y-m-d')) }}" max="{{ now()->subDay()->toDateString() }}" required>
            @error('date_of_birth') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select gender</option>
                @foreach (['Male', 'Female', 'Other'] as $gender)
                    <option value="{{ $gender }}" @selected(old('gender', $employee?->gender) === $gender)>{{ $gender }}</option>
                @endforeach
            </select>
            @error('gender') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="department_id">Department</label>
            <select id="department_id" name="department_id" required>
                <option value="">Select department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @selected((string) old('department_id', $employee?->department_id) === (string) $department->id)>{{ $department->department_name }}</option>
                @endforeach
            </select>
            @error('department_id') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="position_id">Position</label>
            <select id="position_id" name="position_id" required>
                <option value="">Select position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" @selected((string) old('position_id', $employee?->position_id) === (string) $position->id)>{{ $position->position_name }}</option>
                @endforeach
            </select>
            @error('position_id') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="employment_status">Employment status</label>
            <select id="employment_status" name="employment_status" required>
                @foreach (['Active', 'Inactive', 'On Leave', 'Terminated'] as $status)
                    <option value="{{ $status }}" @selected(old('employment_status', $employee?->employment_status ?? 'Active') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('employment_status') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="date_hired">Date hired</label>
            <input id="date_hired" type="date" name="date_hired" value="{{ old('date_hired', $employee?->date_hired?->format('Y-m-d')) }}" required>
            @error('date_hired') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field wide">
            <label for="address">Address</label>
            <textarea id="address" name="address" required autocomplete="street-address">{{ old('address', $employee?->address) }}</textarea>
            @error('address') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="emergency_contact">Emergency contact name</label>
            <input id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact', $employee?->emergency_contact) }}" maxlength="100">
            @error('emergency_contact') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
        <div class="employee-field">
            <label for="emergency_contact_phone">Emergency contact phone</label>
            <input id="emergency_contact_phone" type="tel" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $employee?->emergency_contact_phone) }}" maxlength="20">
            @error('emergency_contact_phone') <div class="employee-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="employee-form-actions">
        <button class="employee-button" type="submit">{{ $isEditing ? 'Save changes' : 'Create employee' }}</button>
        <a class="employee-button secondary" href="{{ $isEditing ? route('employees.show', $employee) : route('employees.index') }}">Cancel</a>
    </div>
</form>
