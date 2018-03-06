@extends('lte_admin.layout.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage News
        <small>here you can find all news</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/lte-admin"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="/lte-admin/news" class="active">News</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">



      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All News  <span class="badge">{{$count_news}}</span></h3>

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
                  <th>S/N</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Delete</th>
                  <th>Date</th>
                </tr>
                @foreach($news as $index=>$new)
                    <tr>
                      <td>{{$index + 1}}</td>
                      <td><a href="/dashboard#/category/{{$new->id}}" target="blank">{{$new->title}}</a></td>
                      <td> {{str_limit($new->body, $limit = 100)}}</td>
                      <td><a href="/admin/post/delete/{{$new->slug}}" class="btn btn-danger btn-xs">Delete</a></td>
                      <td>{{$new->created_at}}</td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $news->links() }}</div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>

      <!--create category-->
       <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create News</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/posts" method="post" value="PUT" role="form" files="true" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="post_title" id="name" placeholder="News Title">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="body" class="form-control" id="description" placeholder="Description" rows="3"></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-info btn-block">Create News</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!--create category-->

<h4 class="text-center">Edit News</h4> <hr>
      <!--form here-->
         <div class="row">
          @foreach($news as $new)
            <div class="col-lg-6">
                <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$new->title}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/post/{{$new->slug}}" method="post" value="PUT" role="form" files="true" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="post_title" id="name" placeholder="New Title" value="{{$new->title}}">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="body" class="form-control" id="description" placeholder="Description" rows="3">{{$new->body}}</textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-warning">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        @endforeach
      </div>
      <!--form here-->
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
