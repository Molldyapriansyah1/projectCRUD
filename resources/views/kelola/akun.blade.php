@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Kelola Akun</h1>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
    @endif
    @if (Session::get('failed'))
        <div class="alert alert-danger">{{ Session::get('failed')}}</div>
    @endif
    <table class="table table-bordered table-striped">
        {{-- Create New Account button --}}
        <a href="{{ route('kelola.akun.create') }}" class="btn btn-success">Create New Account</a>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td class="d-flex">
                        {{-- Edit button --}}
                        <a href="{{ route('kelola.akun.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                    </td>
                    <td>
                        {{-- Delete button with form --}}
                        <form action="{{ route('kelola.akun.delete', $item['id']) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>    
    </table>  
    <div class="d-flex justify-content-end">
        {{-- Pagination links --}}
        {{ $users->links() }}
    </div>
</div>
@endsection



