Dear <strong>{{ $users->name }}</strong>, <br /><br />

We received a request to reset your password for your Tachyon account. If you did not request a password reset, please
ignore this email. Otherwise, you can reset your password using the link below: <br>

<a href="{{route('resetPasswordPage', $user->email)}}"><strong>Reset Password</strong></a><br>
If you have any questions or encounter any issues, feel free to reach out to us. Our support team is here to assist
you.<br/>

Best regards,<br />
Tachyon Tech.
