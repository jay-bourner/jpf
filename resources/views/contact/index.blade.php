@extends('layouts.master')

@section('content')
    @if(session('success'))
        {{ session('success') }}
    @endif
    <div class="contact-page">
        <div>
            <div class="contact-header">
                <h1>Contact</h1>
                <p>If you want to get in touch with me, just fill in the form below and I will get back to you as soon as I can.</p>
            </div>
            <div class="contact-content">
                <div class="contact-image">
                    <img src="image/contact/Jaime-chilling.jpg" alt="">
                </div>
                <div class="contact-form">
                    <form action="contact/submit" method="post" id="contact-form">
                        @csrf
                        <fieldset>
                            <div class="jp-form-group">
                                <label for="name">Name:</label>
                                <input value="{{ old('name') }}" class="jp-input jp-input--md @error('name') is-invalid @enderror" type="text" id="name" name="name" aria-describeedby="nameInput">
                                @error('name')
                                    <div id="nameInput" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="jp-form-group">
                                <label for="email">Email: </label>
                                <input value="{{ old('email') }}" class="jp-input jp-input--md @error('email') is-invalid @enderror" type="email" id="email" name="email" aria-describeedby="emailInput">
                                @error('name')
                                    <div id="emailInput" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="jp-form-group">
                                <label for="email">Number:</label>
                                <input value="{{ old('tel') }}" class="jp-input jp-input--md" type="tel" id="tel" name="tel">
                            </div>
                            <div class="jp-form-group">
                                <label for="message">Message:</label>
                                <textarea class="jp-input @error('message') is-invalid @enderror" id="message" name="message" rows="20" aria-describeedby="messageInput">{{ old('message') }}</textarea>
                                @error('name')
                                    <div id="messageInput" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="jp-form-group jp-form-footer">
                                <button class="jp-btn jp-btn--md jp-btn-grn" type="submit">Send</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection