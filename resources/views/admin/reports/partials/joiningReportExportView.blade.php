
@if($joiningData->count())
    <table>
        <thead>
        <tr>
            <th style="width: 50px;"> Sl No</th>
            <th style="width: 98px;"> Username</th>
            <th style="width: 96px;"> First Name</th>
            <th style="width: 95px;"> Last Name</th>
            <th style="width: 75px;"> Sponsor</th>
            <th style="width: 163px;"> Email</th>
            <th style="width:107px;"> Joining Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($joiningData as $user)
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $user->username }} </td>
                <td> {{ $user->profile->first_name }} </td>
                <td> {{ $user->profile->last_name }} </td>
                <td> {{ $user->sponsor_id }} </td>
                <td> {{ $user->email }} </td>
                <td> {{ date('Y-m-d', strtotime($user->created_at)) }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {{ __('No joinings found') }}
@endif
