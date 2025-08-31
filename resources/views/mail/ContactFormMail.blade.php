<div>
    {{-- <div style="margin: auto;">
        <img src={{ asset(image/cachelogos/jpfitnesslogo2025-500x500.webp) }} alt="JP Fitness Logo" style="width: 200px; height: auto;">
    </div> --}}
    <div>
        <p>You have received a new message from the contact form on your website.</p>
        <p>Here are the details:</p>
        <p>
            Name: {{ $contactData['name'] }} <br>
            Email: {{ $contactData['email'] }} <br>
            Phone Number: {{ $contactData['number'] }} <br>
        </p>
        <p>Message:</p>
        <div style="background-color: #cdcccc; padding: 10px 20px; border-radius: 5px;">
            {!! $contactData['message'] !!}
        </div>
        <p>Regards, <br> Your Website Team</p>
    </div>
</div>