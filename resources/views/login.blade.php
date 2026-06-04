@extends('plantilla')

@section('contenido')

<div class="container my-5">


<div class="CONTENEDOR-INFO mx-auto text-white"
     style="
     max-width: 550px;
     background: rgba(30, 41, 59, 0.85);
     backdrop-filter: blur(15px);
     border-radius: 20px;
     border: 1px solid rgba(255,255,255,0.1);
     box-shadow: 0 15px 40px rgba(0,0,0,0.4);
     padding: 2.5rem;">

    <h2 class="fw-bold text-center mb-4 text-white"
        style="font-family: 'Playfair Display', serif; letter-spacing: 2px;">
        INICIAR SESIÓN
    </h2>

    @if ($errors->any())
        <div class="alert alert-danger py-2 mb-4"
             style="
             border-radius: 12px;
             background: rgba(220, 53, 69, 0.2);
             border: 1px solid rgba(220, 53, 69, 0.4);
             color: #f8d7da;">
            <ul class="mb-0 small fw-bold" style="padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-bold text-uppercase"
                   style="color: #cbd5e1;">
                Correo Electrónico
            </label>

            <input type="email"
                   name="email"
                   class="form-control text-white"
                   value="{{ old('email') }}"
                   placeholder="ejemplo@gmail.com"
                   required
                   style="
                   background: rgba(15, 23, 42, 0.8);
                   border: 1px solid rgba(148, 163, 184, 0.3);
                   border-radius: 12px;
                   padding: 12px;">
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-uppercase"
                   style="color: #cbd5e1;">
                Contraseña
            </label>

            <input type="password"
                   name="password"
                   class="form-control text-white"
                   placeholder="Ingresá tu contraseña"
                   required
                   style="
                   background: rgba(15, 23, 42, 0.8);
                   border: 1px solid rgba(148, 163, 184, 0.3);
                   border-radius: 12px;
                   padding: 12px;">
        </div>

        <button type="submit"
                class="w-100 py-3 border-0 fw-bold text-uppercase"
                style="
                background: linear-gradient(135deg,#0ea5e9,#2563eb);
                color:white;
                border-radius:12px;
                letter-spacing:1px;">
            Ingresar
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small mb-0" style="color:#94a3b8;">
            ¿No tenés cuenta?
            <a href="{{ url('/registro') }}"
               class="text-decoration-none fw-bold"
               style="color:#38bdf8;">
                Registrate acá
            </a>
        </p>
    </div>

</div>


</div>
@endsection
