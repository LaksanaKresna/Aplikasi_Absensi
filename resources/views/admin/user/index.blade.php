@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $page }}</p>
                <div class="row">
                    <div class="col-12">
                        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('user.create') }}">Tambah</a>
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Username
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                        <th>
                                            Dibuat
                                        </th>
                                        
                                        <th class="text-center">
                                            Opsi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                
                                
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ roleDesc($user->role_id) }}
                                        </td>
                                        <td>
                                            {{ $user->created_at }}
                                        </td>
                                
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                
                                                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-sm btn-primary m-1">Ubah</a>
                                                <form action="{{ route('user.destroy',$user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('yakin hapus data ini?')"
                                                        class="btn btn-sm btn-danger m-1">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection