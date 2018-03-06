@extends('lte_admin.layout.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Categories
        <small>here you can find all categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/lte-admin"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="/lte-admin/categories" class="active">Categories</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">



      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Categories  <span class="badge">{{$count_categories}}</span></h3>

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
                  <th>Description</th>
                  <th>Date</th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                      <td><a href="/dashboard#/category/{{$category->id}}" target="blank"> <img src="/static-pics/categories/{{$category->image}}" style="height: 40px; width: 40px;" class="img-circle" alt="{{$category->id}}"></a></td>
                      <td><a href="/dashboard#/category/{{$category->id}}" target="blank">{{$category->name}}</a></td>
                      <td>{{$category->description}}</td>
                      <td>{{$category->created_at}}</td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <div class="text-center">{{ $categories->links() }}</div>
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
              <h3 class="box-title">Create New Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/categories" method="post" value="PUT" role="form" files="true" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" name="image" id="image">

                  <p class="help-block"><small>Not more than 500kb.</small></p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Create Category</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!--create category-->

<h4 class="text-center">Edit Categories</h4> <hr>
      <!--form here-->
         <div class="row">
          @foreach($categories as $category)
            <div class="col-lg-6">
                <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$category->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/category/{{$category->id}}" method="post" value="PUT" role="form" files="true" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name" value="{{$category->name}}">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{$category->description}}">
                </div>
                <div class="form-group">
                  <label for="image">New image</label>
                  <input type="file" name="image" id="image">

                  <p class="help-block"><small>Not more than 500kb.</small></p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-warning">Edit</button>
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
