<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 first-row" id="firstDiv">    
    <div class="container-fluid">
    <div style="height: 0px;"></div>
        <div class="pan panel-defult row admin">
        <a href="#">Admin Panel</a>
                <p class="small" style="text-decoration: underline;">{{Auth::user()->fullname}}</p>
                <ul class="list-unstyled">
                    <li><a href="#innovate-items" data-toggle="collapse"><i class="glyphicon glyphicon-plus"></i>Innovations</a>
                        <ul class="nav collapse" id="innovate-items">
                            <li style="padding-bottom:0px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"></i><a href="/admin/all_innovations"> View all</a>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:0px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/approved_innovations">Approved</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:1px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/pending_innovations">Pending</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/declined_innovations">Declined</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </li>                    
                    <li><a href="#category-items" data-toggle="collapse"><i class="glyphicon glyphicon-plus"></i>Categories</a>
                        <ul class="nav collapse" id="category-items">
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"></i><a href="/admin/categories"> View all</a>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/category/new">New</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#user-items" data-toggle="collapse"><i class="glyphicon glyphicon-plus"></i>Users</a>
                        <ul class="nav collapse" id="user-items">
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"></i><a href="/admin/"> View all</a>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/innovators">Innovators</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/investors">Investors</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/users/subscribed">Subscribed</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/blocked_users">Blocked</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            @if(checkPermission(['superadmin']))
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                              <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/admin_users">Admins</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li><a href="#post-items" data-toggle="collapse"><i class="glyphicon glyphicon-plus"></i>Posts</a>
                        <ul class="nav collapse" id="post-items">
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"></i><a href="/admin/posts"> View all</a>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li style="padding-bottom:3px;">
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-11">
                                    <i class="glyphicon glyphicon-pencil"><a href="/admin/post/new">New</a></i>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </li>
                </ul>
           
        </div>
        </div>
</div>

