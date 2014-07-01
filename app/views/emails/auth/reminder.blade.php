To reset your password, complete this form: {{ URL::to('password/reset', array($token)) }}.

This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.