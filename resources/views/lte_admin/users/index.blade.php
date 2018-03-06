@extends('lte_admin.layout.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Users
        <small>here you can find all users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/lte-admin"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="/lte-admin/users" class="active">Users</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      @if(checkPermission(['superadmin']))
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Admins  <span class="badge">{{$count_admins}}</span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Image</th>
                  <th>Name</th>
                  <th style="width: 40px">Type</th>
                </tr>
                @foreach($admins as $admin)
                    <tr>
                      <td>
                        <a href="/dashboard#/innovation/{{$admin->username}}" target="blank"> 
                           @if($admin->image != 'default_profile.jpeg')
                              <img src="{{ asset('uploads/profile-pic/'.$admin->image) }}" class="img-circle" alt="{{$admin->username}}" style="height: 40px; width: 40px;" >
                          @else
                              <img src="https://api.adorable.io/avatars/181/{{$admin->email}}.png" class="img-circle" style="height: 40px; width: 40px;"  alt="{{$admin->username}}">
                          @endif
                        </a>
                      </td>
                      <td>{{$admin->fullname}}</td>
                      <td>
                        @if($admin->is_permission == 4)
                        Admin
                        @else
                        Superadmin
                        @endif
                      </td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $admins->links() }}</div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Users  <span class="badge">{{$count_users}}</span></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th class="hidden">Type</th>
                  <th>Status</th>
                  <th>Subscription</th>
                  <th class="hidden">Put on hold</th>
                  <th class="hidden">Block</th>
                  <th class="hidden">Approve</th>
                  <th>Date</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                      <td>
                        <a href="/dashboard#/innovator/profile/{{$user->username}}" target="blank">
                          @if($user->image != 'default_profile.jpeg')
                              <img src="{{ asset('uploads/profile-pic/'.$user->image) }}" class="img-circle" alt="{{$user->username}}" style="height: 40px; width: 40px;" >
                          @else
                              <img src="https://api.adorable.io/avatars/181/{{$user->email}}.png" class="img-circle" style="height: 40px; width: 40px;"  alt="{{$user->username}}">
                          @endif
                       </a>
                      </td>
                      <td><a href="/dashboard#/innovator/profile/{{$user->username}}" target="blank">{{$user->fullname}}</a></td>
                      <td class="hidden">{{$user->is_permission}}</td>
                      <td>{{$user->status}}</td>
                      @if($user->subscription('main')) 
                        <td>{{ $user->subscription('main')->braintree_plan }}</td>
                      @else
                        <td>None</td>
                      @endif
                      <td class="hidden"><a href="/admin/innovators/hold/{{$user->username}}" class="btn btn-info btn-xs">Put on hold</a></td>
                      <td class="hidden"><a href="/admin/innovators/block/{{$user->username}}" class="btn btn-danger btn-xs">Block</a></td>
                      <td class="hidden"><a href="/admin/innovators/approve/{{$user->username}}" class="btn btn-success btn-xs">Approve</a></td>
                      <td>{{$user->created_at}}</td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $users->links() }}</div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
