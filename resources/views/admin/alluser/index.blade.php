@extends('layouts.dashboard')

@section('categories')
 active show-sub 
 @endsection

 @section('Add Category')
 active  
 @endsection


@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add User</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-body">Add User</div>
               <div class="card-header">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-18p">Image</th>
                            <th class="wd-18p">Name</th>
                            <th class="wd-18p">Email</th>
                            <th class="wd-18p">Number</th>
                            <th class="wd-18p">Role</th>
                            <th class="wd-18p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                          <tr>
                             <td><img width="80" style="border-radius: 50%;" src="{{ asset($user->image) }}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                              @if ($user->role_id == 1)
                                <span class="badge badge-pill badge-success">Admin</span>
                                 @elseif ($user->role_id == 2)
                                  <span class="badge badge-pill badge-info">User</span>
                                    @elseif ($user->role_id == 3)
                                  <span class="badge badge-pill badge-primary">Author</span>
                                    @elseif ($user->role_id == 4)
                                  <span class="badge badge-pill badge-danger">Moderate</span>
                                
                              @endif
                            </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('admin/user/soft') }}/{{ $user->id }}"  type="button" class="btn btn-danger btn-sm" title="Soft Delete"><i class="fa fa-trash"></i></a>
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
           <br>
           <div class="card">
            <div class="card-body">Trash Data</div>
            <div class="card-header">
             <div class="card pd-20 pd-sm-40">
                 <div class="table-wrapper">
                   <table id="datatable2" class="table display responsive nowrap">
                     <thead>
                       <tr>
                           <th class="wd-18p">Image</th>
                            <th class="wd-18p">Name</th>
                            <th class="wd-18p">Email</th>
                            <th class="wd-18p">Number</th>
                            <th class="wd-18p">Role</th>
                            <th class="wd-18p">Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($trashed as $trash)
                       <tr>
                        <td><img width="80" style="border-radius: 50%;" src="{{ asset($trash->image) }}"></td>
                        <td>{{ $trash->name }}</td>
                        <td>{{ $trash->email }}</td>
                        <td>{{ $trash->phone }}</td>
                        <td>
                              @if ($trash->role_id == 1)
                                <span class="badge badge-pill badge-success">Admin</span>
                                @else
                                <span class="badge badge-pill badge-info">User</span>
                              @endif
                            </td>
                            
                         <td>
                           <div class="btn-group" role="group" aria-label="Basic example">
                             <a href="{{ url('admin/user/restore') }}/{{ $trash->id }}" class="btn btn-info btn-sm" title="restore"><i class="fa fa-arrow-up"></i></a>
                             <a href="{{ url('admin/user/delete') }}/{{ $trash->id }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
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