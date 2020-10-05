@extends('layouts.main')
@section('content')
<div class="main">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" id="contact-form">
                @csrf
                <div class="title"><label class="label-input100" for="message">Մուտքագրել տեքստը․․․</label></div>
                    <div class="text" style="font-family: monospace, monospace; border-radius: 5px; border: 3px solid #2d3748; background-color: #1a202c; overflow: auto; width:500px; height: 300px; padding: 5px" id="message" contenteditable="true"></div>
                <br>
                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        Ստուգել
                    </button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>

@endsection


