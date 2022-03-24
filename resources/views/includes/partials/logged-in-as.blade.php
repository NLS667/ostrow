@if ($logged_in_user && session()->has("admin_user_id") && session()->has("temp_user_id"))
<div id="message">
    <div style="padding: 5px;">
	    <div class="alert alert-warning logged-in-as">
	        Jesteś aktualnie zalogowany jako {{ $logged_in_user->first_name }}. <a href="{{ route("auth.logout-as") }}">Re-Loguj jako {{ session()->get("admin_user_name") }}</a>.
	    </div><!--alert alert-warning logged-in-as-->
	</div>
</div>
@endif