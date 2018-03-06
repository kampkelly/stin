
<div style="height: 200px;">
	<form class="form-horizontal" role="form" method="POST" action="/newlogin" style="color: black;" >
                    {{ csrf_field() }}
                    <input type="text" name="email">
                    <input type="password" name="password">
                    <input type="submit" name="submit" value="submit">

                 </form>    
