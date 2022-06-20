@extends('layouts.plantilla')
@section('content')
<div class="mt-5">
    <section id="contact" class="mt-5">
        <img src="https://img.icons8.com/ios/50/FFFFFF/contact-card.png"/> 
        <h2 class="module-title font-alt">Contacto</h2>
        <div class="contact-container">
            @foreach($contactos as $contacto)
                <div class="contact-box">
                    <p><b>{{$contacto->titulo}}</b></p>
                    <p>{{$contacto->nombre}}</p>
                    @if($contacto->correo)
                        <p>Correo: <a href="mailto:{{$contacto->correo}}">{{$contacto->correo}}</a></p>
                    @endif
                    @if($contacto->telefono)
                        <p>Teléfono: <a href="tel:{{$contacto->telefono}}">{{$contacto->telefono}}</a></p>
                    @endif

                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection