<?php

add_shortcode( 'gcs_reserva_limpieza', 'gcs_reserva_limpieza_func' );

function gcs_reserva_limpieza_func( $atts ){
  // enqueue javascript and css here
  $gcs_holidays = get_gcs_holidays();
  $limpiezas = get_cleaning_dates();
  wp_enqueue_style( 'gcs_reserva_limpieza_css', plugin_dir_url(__FILE__).'css/main.css', array(), GCS_Version, 'screen' );
  wp_enqueue_style( 'gcs_calendar_css', plugin_dir_url(__FILE__).'dist/calendar.css', array(), '02', 'screen' );
  wp_enqueue_script( 'gcs_reserva_limpieza_js', plugin_dir_url(__FILE__).'dist/main.js', array(), GCS_Version, true );
  wp_localize_script( 'gcs_reserva_limpieza_js', 'gcs_reserva_limpieza', array(
    'habitaciones'  => array(),
    'gcs_holidays'  => $gcs_holidays,
    'limpiezas'     => $limpiezas,
    'ajaxurl'       => admin_url('admin-ajax.php'),
    'security'      => wp_create_nonce('gcs_reserva_nonce'),
    'redirect'      => wc_get_checkout_url()
  ));
  ob_start();
?>
    <div class="reserva-limpieza">
      <div class="formulario-reserva">
        <h3>Reserva tu limpieza</h3>
        <form action="#0" method="post" name="formulario-reserva">
          <h4>Datos de la Propiedad</h4>
          <div class="datos-de-propiedad">
            <div class="input span-2">
              <label for="ubicacion">Ubicación</label>
              <select name="ubicacion" id="ubicacion-select">
              <?php
                  $args = array(
                    'post_type'       => 'product',
                    'posts_per_page'  => -1,
                    'product_cat'     => 'ubicacion',
                    'orderby'         => 'title',
                    'order'           => 'ASC'
                  );
                  $ubicacion = new WP_Query($args);
                  while ( $ubicacion->have_posts() ) : $ubicacion->the_post();
                    ?>
                      <option
                        data-price="<?php echo get_post_meta(get_the_ID(), '_price', true); ?>"
                        data-id="<?php echo get_the_ID(); ?>"
                      >
                        <?php echo get_the_title(); ?>
                      </option>
                    <?php
                  endwhile;
                  wp_reset_query();
                ?>
              </select>
            </div>
            <div class="input">
              <label for="cantidad-habitaciones">Habitaciones</label>
              <select name="cantidad-habitaciones" id="cantidad-habitaciones">
                <?php for($i = 1; $i <= 5; $i += 1) : ?>
                  <?php if ($i === 1) : ?>
                    <option>
                      <?php echo $i; ?> habitación
                    </option>
                  <?php else : ?>
                    <option >
                      <?php echo $i; ?> habitaciones
                    </option>
                  <?php endif; ?>
                <?php endfor; ?>
              </select>
            </div>
            <div class="input">
              <label for="cantidad-banos">Baños</label>
              <select name="cantidad-banos" id="cantidad-banos">
                <?php for($i = 1; $i <= 5.5; $i += 0.5) : ?>
                  <?php if ($i === 1) : ?>
                    <option><?php echo $i; ?> Baño</option>
                  <?php else : ?>
                    <option><?php echo $i; ?> Baños</option>
                  <?php endif; ?>
                <?php endfor; ?>
              </select>
            </div>
            <div class="input span-2">
              <label for="clean-area">Área aproximada en  m<sup>2</sup></label>
              <select name="clean-area" id="clean-area">
                <?php
                  $args = array(
                    'post_type'       => 'product',
                    'posts_per_page'  => -1,
                    'product_cat'     => 'area',
                    'orderby'         => 'title',
                    'order'           => 'ASC'
                  );
                  $area = new WP_Query($args);
                  while ( $area->have_posts() ) : $area->the_post();
                    ?>
                      <option
                        data-price="<?php echo get_post_meta( get_the_ID(), '_price', true ); ?>"
                        data-id="<?php echo get_the_ID(); ?>"
                      >
                        <?php echo get_the_title(); ?>
                      </option>
                    <?php
                  endwhile;
                  wp_reset_query();
                ?>
              </select>
            </div>
            <div class="input span-2">
              <label for="propiedad">Tipo de Propiedad</label>
              <select name="propiedad" id="tipo-propiedad">
                <?php
                  $args = array(
                    'post_type'       => 'product',
                    'posts_per_page'  => -1,
                    'product_cat'     => 'tipo-de-propiedad',
                    'order'           => 'ASC'
                  );
                  $tipo_de_propiedad = new WP_Query($args);
                  while ( $tipo_de_propiedad->have_posts() ) : $tipo_de_propiedad->the_post();
                    ?>
                      <option
                        data-id="<?php echo get_the_ID(); ?>"
                      >
                        <?php echo get_the_title(); ?>
                      </option>
                    <?php
                  endwhile;
                  wp_reset_query();
                ?>
              </select>
            </div>
          </div>
          <h4>Tipo de Limpieza</h4>
          <p>Limpieza Recomendada: <span id="limpieza-recomendada"></span></p>
          <div class="tipo-limpieza radios">
            <?php
              $args = array(
                'post_type'       => 'product',
                'posts_per_page'  => -1,
                'product_cat'     => 'tipo-de-limpieza',
                'order'           => 'ASC'
              );
              $tipo_de_limpieza = new WP_Query($args);
              while ( $tipo_de_limpieza->have_posts() ) : $tipo_de_limpieza->the_post();
                ?>
                  <label
                    for="general"
                    data-hab="<?php echo get_field('area'); ?>"
                    class="<?php if ( get_field('area') ) echo 'profunda-8-horas hidden-button'; ?>"
                  >
                    <input
                      type="radio"
                      name="tipo-limpieza"
                      class="<?php if ( get_field('area') ) echo 'input-profunda-8-horas'; ?>"
                      id="<?php echo get_post_meta( get_the_ID(), 'selector_id', true ); ?>"
                      value="<?php echo the_title(); ?>"
                      <?php if(get_post_meta( get_the_ID(), 'checked', true )) echo 'checked'; ?>
                      data-price="<?php echo get_post_meta( get_the_ID(), '_price', true ); ?>"
                      data-id="<?php echo get_the_ID(); ?>"
                    >
                    <p>
                      <?php echo the_content(); ?>
                    </p>
                  </label>
                <?php
              endwhile;
              wp_reset_query();
            ?>
            <a href="https://greencservices.com/caracteristicas-de-la-limpieza-basica-eco-green/" class="caracteristicas">
              Ver características limpieza eco green. &raquo;
            </a>
            <a href="https://greencservices.com/caracteristicas-de-la-limpieza-basica-extendida/" class="caracteristicas">
              Ver características limpieza básica extendida &raquo;
            </a>
            <a href="https://greencservices.com/caracteristicas-de-la-limpieza-limpieza-profunda-8-horas/" class="caracteristicas">
              Ver caracteristicas limpieza profunda 8 horas &raquo;
            </a>
          </div>
          <h4>Servicios Extra</h4>
          <p>
            Los servicios extras incurren costos adicionales. Para no incurrir en costo por
            tiempo adicional recomendamos seleccionar un máximo de dos por día.
          </p>
          <div class="servicios-extras radios">
            <?php
              $args = array(
                'post_type'       => 'product',
                'posts_per_page'  => -1,
                'product_cat'     => 'servicios-extra',
                'order'           => 'ASC'
              );
              $servicios_extra = new WP_Query($args);
              while ( $servicios_extra->have_posts() ) : $servicios_extra->the_post();
                ?>
                  <label
                    class="<?php if (get_post_meta( get_the_ID(), 'limpieza_destacada', true )) echo 'limpieza-destacada hidden-button'; ?>"
                    data-area="<?php echo get_post_meta(get_the_ID(), 'area', true); ?>"
                  >
                    <input
                      type="checkbox"
                      value="<?php echo get_the_title(); ?>"
                      <?php if (get_post_meta( get_the_ID(), 'checked', true )) echo 'checked'; ?>
                      data-price="<?php echo get_post_meta( get_the_ID(), '_price', true ); ?>"
                      data-id="<?php echo get_the_ID(); ?>"
                    >
                      <?php echo the_content(); ?>
                      <?php the_title( '<p>', '</pre>' ); ?>
                      <p class="small">
                        <?php 
                          if ( get_post_meta( get_the_ID(), 'nebulizacion', true ) ) {
                            echo get_post_meta( get_the_ID(), 'nebulizacion', true );
                          }
                        ?>
                      </p>
                      <p>
                        <span class="big">+<?php echo get_post_meta( get_the_ID(), '_price', true );?></span>
                      </p>
                  </label>
                <?php
              endwhile;
              wp_reset_query();
            ?>
            <p></p>
            <p></p>
            <p>
              <a href="https://greencservices.com/caracteristicas-de-la-sanitizacion-y-nebulizacion-en-frio/">
                Ver Características de la Neublización en Frío.
              </a>
            </p>
          </div>
          <h4>Agendar Próxima Visita</h4>
          <p>
            Seleccione las fechas para reservar las citas. Puede seleccionar todas las fechas que necesite
            a la recurrencia que necesite.
          </p>
          <div class="calendar" id="calendar"></div>
          <h4>Horario</h4>
          <p>
            Seleccione la hora para la próxima reserva.
          </p>
          <div class="hour-buttons radios">
            <label for="horario-limpieza">
              <input
                type="radio"
                class="horario-limpieza"
                name="horario-limpieza"
                id="hora-8-am"
                value="8:00 a.m."
                checked="checked"
              >
              <p>
                8:00 a.m.
              </p>
            </label>
            <label for="horario-limpieza">
              <input
                type="radio"
                class="horario-limpieza"
                name="horario-limpieza"
                id="hora-100-pm"
                value="1:00 p.m."
              >
              <p>
                1:00 p.m.
              </p>
            </label>
          </div>
        </form>
      </div>
      <div class="resumen-servicio">
        <div class="resumen">
          <h4>Resumen de Servicio</h4>
          <div class="resumen-header">
            <div id="ubicacion"></div>
            <div id="metraje"></div>
            <div id="cuartos"></div>
            <div id="propiedad"></div>
          </div>
          <ul class="servicios" id="servicios"></ul>
          <p>Próximas fechas:</p>
          <ul class="fechas" id="fechas"></ul>
          <p>Horario preferido: <span class="horario-elegido"></span></p>
          <div class="total">
            <p>Total:</p>
            <p id="reserva-limpieza-total"></p>
          </div>
          <button id="ir-a-caja">Reservar</button>
          <p class="error-message-reserva hidden-button"></p>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        <?php
          $args = array(
            'post_type'       => 'product',
            'posts_per_page'  => -1,
            'product_cat'     => 'habitaciones',
            'orderby'         => 'title',
            'order'           => 'ASC'
          );
          $ubicacion = new WP_Query($args);
          while ( $ubicacion->have_posts() ) : $ubicacion->the_post();
        ?>
        /**
         * Popula el arreglo habitaciones con el WP_Query
         * a los productos de categoría habitaciones
         * para tener sus precios y compararlos
         * con la selección del usuario de
         * habitaciones y baños.
         */
          gcs_reserva_limpieza.habitaciones.push({
            habitaciones: "<?php echo get_the_title(); ?>",
            precio: "<?php echo get_post_meta( get_the_ID(), '_price', true ); ?>",
            dataId: "<?php echo get_the_ID(); ?>"
          })
        <?php
          endwhile;
          wp_reset_query();
        ?>
      })
    </script>
  <?php
	return ob_get_clean();
}
