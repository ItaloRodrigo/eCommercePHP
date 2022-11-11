<!-- Nav -->
<?php require_once "inc/nav_2.php" ?>


      <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="assets/images/bg-contacts.jpg">
          <div class="breadcrumbs-custom-body parallax-content context-dark">
            <div class="container">
              <h2 class="breadcrumbs-custom-title">Contactos</h2>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">Contactos</li>
            </ul>
          </div>
        </div>
      </section>

    <?php 
      if(isset($_GET['output'])){
        if($_GET['output']){
          echo '
          <div class="alert alert-success" role="alert">
            Email enviado com sucesso!
          </div>
          ';
        }else{
          echo '
          <div class="alert alert-danger" role="alert">
            Algo deu errado!
          </div>
          ';
        }
      }
    
    ?>

      <!-- Get in touch-->
      <section class="section section-xl bg-default text-md-left">
        <div class="container">
          <div class="title-classic">
            <h3 class="title-classic-title">Contacta-nos</h3>
            <p class="title-classic-subtitle">Estamos disponíveis 24/7 por E-mail ou Whatsapp. Também podes usar <br class="d-none d-lg-block">este formulário para esclarecer todas as tuas questões.</p>
          </div>
          <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="assets/bat/rd-mailform.php">
            <div class="row row-20 row-md-30">
              <div class="col-lg-8">
                <div class="row row-20 row-md-30">
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input type="hidden" name="form-type" value="contact"/>
                      <input class="form-input" id="contact-first-name-2" type="text" name="first-name" data-constraints="@Required"/>
                      <label class="form-label" for="contact-first-name-2">Primeiro Nome</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-last-name-2" type="text" name="last-name" data-constraints="@Required"/>
                      <label class="form-label" for="contact-last-name-2">Último Nome</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required"/>
                      <label class="form-label" for="contact-email-2">E-mail</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-phone-2" type="text" name="phone" data-constraints="@Numeric"/>
                      <label class="form-label" for="contact-phone-2">Contacto</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-wrap">
                  <label class="form-label" for="contact-message-2">Mensagem</label>
                  <textarea class="form-input textarea-lg" id="contact-message-2" name="message" data-constraints="@Required"></textarea>
                </div>
              </div>
            </div>
            <button class="button button-lg button-primary button-zakaria" type="submit" id="btn_cnt">Enviar Mensagem</button>
          </form>
        </div>
      </section>
      <!-- Get in touch-->
      <section class="section section-xl bg-gray-4">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-sm-6 col-md-4">
              <h4>Contactos</h4>
              <ul class="contacts-classic">
                <li>Whatsapp : <a href="tel:#">966 666 666</a>
                </li>
                <li></a>
                </li>
              </ul>
            </div>
            <div class="col-sm-6 col-md-4">
              <h4>Disponibilidade</h4>
              <div class="contacts-classic"><a href="#">Disponivel 24/7 Online <br></a></div>
            </div>
            <div class="col-sm-6 col-md-4">
              <h4>E-mails</h4>
              <ul class="contacts-classic">
                <li><a href="mailTo:#">geral@chipmatica.com</a></li>
                <li><a href="mailTo:#">encomendas@chipmatica.com</a></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
<!-- Page Footer-->
<?php require_once "inc/footer_2.php" ?>