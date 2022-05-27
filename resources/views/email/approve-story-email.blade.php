<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
    </head>

    <body style="margin-top:20px;">
        <center style="width: 100%; background-color: #f5f6fa;">
            <table class="body-wrap" style="width: 100%; background-color: #f6f6f6;" bgcolor="#f6f6f6">
                <tbody>
                    <tr>
                        <td style="padding: 30px 30px 20px">
                            {{ __("Hello") }},
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 30px 20px">
                            <p>{{ __("Please approve the pending story below.") }}</p><br>
                            <p>{{ __("Title") . ': ' . $story->title }}</p>
                            <p>{{ __("Description") . ':' }}</p>
                            <p>{!! $story->description !!}</p>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 30px 20px">
                            <a href="{{ route('admin.story.approve', [ 'token' => $story->id.md5($story->user->email) ]) }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-decoration:none;text-transform: uppercase; padding: 0 30px">{{ __('Approve Story') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 30px">
                            <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">or</h4>
                            <p style="margin-bottom: 10px;">{{ __('If the button above does not work, paste this link into your web browser:') }}</p>
                            <a href="#" style="color: #6576ff; text-decoration:none;word-break: break-all;">{{ route('admin.story.approve', [ 'token' => $story->id.md5($story->user->email) ]) }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </body>
</html>
