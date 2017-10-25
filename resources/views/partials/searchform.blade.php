<div class="container" id="searchdiv" style="padding: 0px 5px 0px 5px; display: none;">
    <form action="/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                placeholder="Search innovations, people, etc..."> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" style="height: 1.35em;"></span>
                </button>
            </span>
        </div>
    </form>
</div>  