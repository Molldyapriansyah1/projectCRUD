@extends ('layouts.layout')

@section('content')
    <!-- Form untuk mengedit data user -->
    <form action="{{ route('kelola.akun.update', $user['id']) }}" method="POST">
        @csrf
        @method('PATCH')
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="form-group">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" name="name" id="name" value="{{ $user['name'] }}" class="form-control">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> 
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user['email'] }}" class="form-control">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="role" class="form-label">Role:</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ old('role', $user['role']) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user['role']) == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Ubah Data :</button>
    </form>
@endsection

