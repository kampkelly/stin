@extends('lte_admin.layout.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Innovations
        <small>here you can find all innovations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/lte-admin"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="/lte-admin/innovations" class="active">Innovations</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Approved  <span class="badge">{{$count_approvedinnovations}}</span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Image</th>
                  <th>Title</th>
                  <th style="width: 40px">Decline</th>
                  <th style="width: 40px">Ft.</th>
                  <th style="width: 40px">User</th>
                </tr>
                @foreach($approved_innovations as $innovation)
                    <tr>
                      <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank"> <img src="/uploads/startup_photos/{{$innovation->image}}" style="height: 40px; width: 40px;" class="img-circle"></a></td>
                      <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank">{{$innovation->title}}</a></td>
                      <td><span class="badge bg-red"><a href="/admin/innovations/decline/{{$innovation->slug}}" style="color: white;">Decline</a></span></td>
                      <td>{{$innovation->featured}}</td>
                      <td><a href="/dashboard#/innovator/profile/{{$innovation->user->username}}" target="blank">
                         @if($innovation->user->image != 'default_profile.jpeg')
                              <img src="{{ asset('uploads/profile-pic/'.$innovation->user->image) }}" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @else
                              <img src="https://api.adorable.io/avatars/181/{{$innovation->user->email}}.png" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @endif
                            </a></td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $approved_innovations->links() }}</div>
            </div>
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pending  <span class="badge">{{$count_pendinginnovations}}</span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">Image</th>
                  <th>Title</th>
                  <th style="width: 40px">Approve</th>
                  <th style="width: 40px">Decline</th>
                  <th style="width: 40px">Ft</th>
                  <th style="width: 40px">User</th>
                </tr>
                @foreach($pending_innovations as $innovation)
                <tr>
                  <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank"> <img src="/uploads/startup_photos/{{$innovation->image}}" style="height: 40px; width: 40px;" class="img-circle"></a></td>
                  <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank">{{$innovation->title}}</a></td>
                  <td><span class="badge bg-success"><a href="/admin/innovations/approve/{{$innovation->slug}}" style="color: white;">Approve</a></span></td>
                  <td><span class="badge bg-red"><a href="/admin/innovations/decline/{{$innovation->slug}}" style="color: white;">Decline</a></span></td>
                  <td>{{$innovation->featured}}</td>
                  <td>
                    <a href="/dashboard#/innovator/profile/{{$innovation->user->username}}" target="blank">
                        @if($innovation->user->image != 'default_profile.jpeg')
                              <img src="{{ asset('uploads/profile-pic/'.$innovation->user->image) }}" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @else
                              <img src="https://api.adorable.io/avatars/181/{{$innovation->user->email}}.png" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @endif
                    </a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
               <div class="text-center">{{ $pending_innovations->links() }}</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Declined  <span class="badge">{{$count_declinedinnovations}}</span></h3>

              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10px">Image</th>
                  <th>Title</th>
                  <th style="width: 40px">Approve</th>
                  <th style="width: 40px">Ft</th>
                  <th style="width: 40px">User</th>
                </tr>
                @foreach($declined_innovations as $innovation)
                <tr>
                  <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank"> <img src="/uploads/startup_photos/{{$innovation->image}}" style="height: 40px; width: 40px;" class="img-circle"></a></td>
                  <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank">{{$innovation->title}}</a></td>
                  <td><span class="badge bg-success"><a href="/admin/innovations/approve/{{$innovation->slug}}" style="color: white;">Approve</a></span></td>
                  <td>{{$innovation->featured}}</td>
                  <td>
                    <a href="/dashboard#/innovator/profile/{{$innovation->user->username}}" target="blank">
                        @if($innovation->user->image != 'default_profile.jpeg')
                              <img src="{{ asset('uploads/profile-pic/'.$innovation->user->image) }}" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @else
                              <img src="https://api.adorable.io/avatars/181/{{$innovation->user->email}}.png" alt="{{$innovation->user->username}}" style="height: 25px; width: 25px;" class="img-circle">
                          @endif
                    </a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
             <div class="box-footer clearfix">
               <div class="text-center">{{ $declined_innovations->links() }}</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

             <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Innovations  <span class="badge">{{$count_allinnovations}}</span></h3>

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
                  <th>Title</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Featured</th>
                  <th>Owner</th>
                </tr>
                @foreach($innovations as $innovation)
                    <tr>
                      <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank"> <img src="/uploads/startup_photos/{{$innovation->image}}" style="height: 40px; width: 40px;" class="img-circle"></a></td>
                      <td><a href="/dashboard#/innovation/{{$innovation->slug}}" target="blank">{{$innovation->title}}</a></td>
                      <td>{{$innovation->created_at}}</td>
                      <td>
                          @if($innovation->status == 'approved')
                            <span class="label label-success">{{$innovation->status}}</span>
                          @elseif($innovation->status == 'pending')
                            <span class="label label-warning">{{$innovation->status}}</span>
                          @else
                            <span class="label label-danger">{{$innovation->status}}</span>
                          @endif
                      </td>
                      <td>{{$innovation->featured}}</td>
                      <td><a href="/dashboard#/innovator/profile/{{$innovation->user->username}}" target="blank">{{$innovation->user->fullname}}</a></td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $innovations->links() }}</div>
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
