<div style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center">
            {{-- <img height="80" width="150" src="{{ $logo ?? '' }}"> --}}
        </div>
        <div style="margin-bottom: 20px;">
            <h1 style="color: #333;">{{ $emailData['subject'] ?? '' }}</h1>
            <p>OTP is : {{ $emailData['email_otp'] }}</p>
        </div>
    </div>

</div>