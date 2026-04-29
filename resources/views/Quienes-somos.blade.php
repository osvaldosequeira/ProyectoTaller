@extends('plantilla') <!-- Hereda la estructura principal del layout -->

@section('contenido') <!-- Inicio de la sección de contenido -->

<!-- Contenedor principal de la página informativa -->
<div class="CONTENEDOR-INFO">
    
    <!-- Título de la página -->
    <h2 class="TITULO-PAGINA">Quiénes Somos</h2>
    
    <!-- Sección de introducción -->
    <section class="seccion-texto">
        
        <p>
    En Esencia Retro nacimos con una visión clara: revivir la pasión del fútbol a través de su historia, 
    rescatando aquellos momentos que dejaron una huella imborrable en el tiempo. Somos apasionados del deporte, 
    pero, por sobre todo, valoramos esas escenas que marcaron generaciones: goles inolvidables, finales épicas 
    y camisetas que representan mucho más que un equipo, convirtiéndose en verdaderos símbolos culturales.
</p>


<p>
    Nuestra marca surge en Corrientes con el propósito de conectar a las personas con la esencia más auténtica 
    del fútbol: su pasado. Buscamos que cada producto no solo sea una prenda, sino una forma de revivir emociones, 
    recordar historias y mantener viva la identidad de este deporte que une a millones de personas alrededor del mundo.
</p>
    </section>

    
    <section class="seccion-texto">
        <h4>¿A qué nos dedicamos?</h4>
        
       
        <p>
            Nos especializamos en ofrecer mystery box de indumentaria deportiva retro, centradas en 
            competiciones icónicas como los mundiales, la Champions League y la Copa Libertadores.
        </p>

        
        <p>
            Cada caja es una experiencia única: no sabés qué camiseta te va a tocar, pero sí sabés 
            que va a tener historia, identidad y un valor emocional que va más allá de lo estético.
        </p>
    </section>

    
    <section class="seccion-texto">
        <h4>¿Cómo lo hacemos?</h4>
        
        
        <p>
            Seleccionamos cuidadosamente cada prenda, priorizando calidad, autenticidad y relevancia histórica.
            Nuestro equipo investiga, curaduriza y elige camisetas que representen momentos importantes 
            del fútbol mundial.
        </p>

        
        <p>
            No se trata solo de vender ropa, sino de entregar una pieza de historia en cada box.
            Además, cuidamos cada detalle: desde la elección de las camisetas hasta la presentación final.
        </p>
    </section>

    
    <section class="seccion-texto">
        <h4>Nuestro Compromiso</h4>
        
        
        <p>
            Trabajamos con compromiso, seriedad y pasión. Entendemos que cada cliente confía en nosotros 
            para recibir algo especial, y por eso mantenemos altos estándares en cada proceso.
        </p>

        
        <p>
            En Esencia Retro, no improvisamos: construimos experiencias.
        </p>
    </section>

    <!-- Sección del equipo de trabajo -->
    <section class="seccion-staff">
        <h4>       Nuestro Staff</h4>
        
        <!-- Fila para mostrar el equipo -->
        <div >
            
            <!-- Columna de fundadores -->
            <div class="col-md-6">
                <div class="staff-card">
                    <h6>Sequeira Osvaldo  | Ibarra Samuel </h6>
                    <p>Fundadores</p>
                </div>
            </div>
            <h4>       Secciones</h4>
            <!-- Columna del equipo-->
            <div class="col-md-6">
                <div class="staff-card">
                    <h6>Equipo de diseño</h6>
                    <p>Especialistas Vintage</p>
                </div>
            </div>
        
        </div>
    </section>
</div>

@endsection 