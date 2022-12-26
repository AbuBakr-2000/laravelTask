<?php
?><div>
    <div>
        User : {{ $application->user->name }}
    </div>
    <div>Application</div>
    <div>Id : {{ $application->id }}</div>
    <div>Subject : {{ $application->subject }}</div>
    <div>Message : {{ $application->message }}</div>
    <div>Send At : {{ $application->created_at }}</div>
</div>

<?php
