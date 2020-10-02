@extends('layouts.main')
@section('content')
<div class="main">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" id="contact-form">
                @csrf
                <div class="title"><label class="label-input100" for="message">Մուտագրել տեքստը․․․</label></div>
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
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    .main{
        margin: 80px auto;
        text-align: center;
    }
    .text{
        width:800px;
        margin:0 auto;
    }
    .contact100-form-btn{
        font-size: 15px;
        padding: 10px;
        background-color: #1a202c;
        color: #a0aec0;
    }
    body{
        background-color: #c3d4c6;
        color: #a0aec0;
    }

    .title{
        font-size: 25px;
        width: auto;
        height: auto;
        margin-bottom: 20px;
        color: #1a202c;
    }

    .wrong {
        display: inline-block;
        position: relative;
        text-decoration-color: red;
        text-decoration-line: underline;
        text-decoration-style: wavy;
    }

</style>
@endsection


