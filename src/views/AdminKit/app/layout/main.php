<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('app/layout/header');

echo '<!-- Begin page content -->';
echo '<main class="flex-shrink-0">';
echo '  <div class="container">';

$this->load->view($pagina);

echo '  </div>';
echo '</main>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
$this->load->view('app/layout/footer');