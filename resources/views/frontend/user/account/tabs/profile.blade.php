<table class="table table-striped table-hover">
    
    <tr>
        <th>{{ trans('labels.frontend.user.profile.username') }}</th>
        <td>{{ !empty($logged_in_user->username) ? $logged_in_user->username : '' }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.email') }}</th>
        <td>{{ !empty($logged_in_user->email) ? $logged_in_user->email : '' }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
        <td>{{ $logged_in_user->created_at }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
        <td>{{ $logged_in_user->updated_at }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
    </tr>
</table>