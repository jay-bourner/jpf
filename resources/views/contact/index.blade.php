@extends('layouts.master')

@section('content')
    <div class="contact-page">
        <div>
            <div class="contact-header">
                <h1>Contact</h1>
                <p>If you want to get in touch with me, just fill in the form below and I will get back to you as soon as I can.</p>
            </div>
            <div class="contact-content">
                <div class="contact-image">
                    <img src="{{ $data['image']['src'] }}" alt="{{ $data['image']['alt'] }}">
                </div>
                <div class="contact-form">
                    @if(session('success'))
                        <div class="success-message">
                            <span class="svg-icon svg-icon--check-circle"></span>
                            <div class="success-text">
                                {{ session('success') }}
                            </div>
                        </div>
                    @else
                        <form action="{{ route('contact.submit') }}" method="post" id="contact-form">
                            @csrf
                            <div>
                                <div class="jp-form-group required @error('email') has-error @enderror">
                                    <label for="name">Name:</label>
                                    <input value="{{ old('name') }}" class="jp-input jp-input--md" type="text" id="name" name="name" aria-describeedby="nameInput">
                                    @error('name')
                                        <span class="svg-icon svg-icon--warning-circle warning"></span>
                                        <div id="nameInput" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="jp-form-group required @error('email') has-error @enderror">
                                    <label for="email">Email: </label>
                                    <input value="{{ old('email') }}" class="jp-input jp-input--md" type="email" id="email" name="email" aria-describeedby="emailInput">
                                    @error('email')
                                        <span class="svg-icon svg-icon--warning-circle warning"></span>
                                        <div id="emailInput" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="jp-form-group">
                                    <label for="email">Number:</label>
                                    <input value="{{ old('tel') }}" class="jp-input jp-input--md" type="tel" id="tel" name="tel">
                                </div>
                                <div class="jp-form-group required @error('message') has-error @enderror">
                                    <label for="message">Message:</label>
                                    <textarea class="jp-input" id="message" name="message" rows="20" aria-describeedby="messageInput">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="svg-icon svg-icon--warning-circle warning"></span>
                                        <div id="messageInput" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="jp-form-group jp-form-footer">
                                    <button class="jp-btn jp-btn--md jp-btn-grn" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection