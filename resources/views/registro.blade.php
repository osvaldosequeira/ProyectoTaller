@extends('plantilla')

@section('contenido')
<div class="container my-5">
    <div class="CONTENEDOR-INFO mx-auto text-white" style="max-width: 600px; background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3); padding: 2.5rem;">
        
        <h2 class="fw-bold text-center mb-4" style="font-family: 'Playfair Display', serif; tracking-wider">
            REGISTRO DE USUARIO
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger py-2 mb-4" style="border-radius: 12px; background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.4); color: #f8d7da;">
                <ul class="mb-0 small fw-bold" style="list-style-type: square; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/registro') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-warning">Nombre Completo</label>
                <input type="text"
                       name="nombre"
                       class="form-control text-white"
                       style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px;"
                       placeholder="Ingresá tu nombre"
                       value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-warning">Correo Electrónico (Exclusivo @gmail.com)</label>
                <input type="email"
                       name="email"
                       class="form-control text-white"
                       style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px;"
                       placeholder="tu_usuario@gmail.com"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase text-warning">Contraseña</label>
                <input type="password"
                       name="password"
                       class="form-control text-white"
                       style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px;"
                       placeholder="Mínimo 8 caracteres, 1 mayúscula y letras" required>
                <div class="form-text text-muted-50 small mt-1" style="font-size: 0.75rem; color: #cbd5e1;">
                    *Requisito: Debe contener al menos 8 caracteres, una letra mayúscula y letras minúsculas.
                </div>
            </div>

            <button type="submit" class="BTN-COMPRAR w-100 py-3 border-0 fw-bold text-uppercase tracking-wide" style="border-radius: 12px; transition: all 0.3s ease;">
                Registrarse
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="small text-muted mb-0">¿Ya tenés una cuenta registrada? <a href="{{ url('/login') }}" class="text-info text-decoration-none fw-bold">Iniciá sesión acá</a></p>
        </div>
    </div>
</div>
@endsection