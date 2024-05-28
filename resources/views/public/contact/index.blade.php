@extends('public')

@section('title', 'Nous contacter')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Nous contacter</h2>
        <p>
            Oui, bien sur vous pouvez nous contacter. Mais veuillez tous simplement reformulez votre message sous 
            forme de lettre et de nous l'envoyer. Une fois que vous nous avez contacter, nous vous envoyerons peut-être
            une lettre de retour.
        </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Localisation:</h4>
                <p>Afrique, Madagascar, Antananarivo</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>educa@educa.mg</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Téléphone:</h4>
                <p>+261 00 00 000 00</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="{{route('Public.Contact.send')}}" method="post"  class="php-email-form">
              @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre nom" required>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                      <input type="text" name="prenon" class="form-control" id="prenon" placeholder="Votre prénon" required>
                    </div>
                </div>
                <div class="form-group mt-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Votre Addresse E-mail" required>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Sujet de conversation" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="introduction" rows="5" placeholder="Quelques phrase pour introduire la lettre" required></textarea>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="contenu" rows="5" placeholder="Le contenu de la lettre" required></textarea>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="fin" rows="5" placeholder="Quelques phrase pour finir la lettre" required></textarea>
                </div>
                @if (session('success'))
                  <div class="my-3">
                      <p style="color: green">
                        {{session('success')}}
                      </p>
                  </div>
                @endif
                @if (session('error'))
                  <div class="my-3">
                      <p style="color: rgb(194, 28, 28)">
                        {{session('error')}}
                      </p>
                  </div>
                @endif
                
              <div class="text-center"><button type="submit">Envoyer</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
@endsection