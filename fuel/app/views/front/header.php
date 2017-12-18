<header>
  <div class="container-wrap">
    <div class="logo-wrap pos-left">
      <div class="logo">
        <div class="container" style="max-width: 1296px;">
          <?= "<a ".MyView::link_to("/", ["class" => "logo logo-position"]).">".Asset::img('layout/logo.png')."</a>"; ?>
        </div>
      </div>
    </div>





    <div class="navi-wrap">

      <?
         $header_link = [
             'simple_simulations'   => ['uri' => '/simple_simulations/new',   'name' => 'ガス料金<br>シミュレーション'],
             'local_contents'       => ['uri' => '/local_contents',           'name' => '地域別<br>ガス料金検索'],
             'lpgas'                => ['uri' => '/categories/lpgas',         'name' => 'プロパンガス<br>(LPガス)記事一覧']
         ];

         foreach($header_link as $hl => $h){ ?>
         <div class="navi">

        <? if($_SERVER['REQUEST_URI'] == $h['uri']){
             $hash = ['class' => 'active']?>
             <?= '<a '.MyView::link_to($h['uri'], $hash).'>'.$h['name'].'</a>'?>
        <? }else{ ?>
             <?= MyView::link_to($h['name'], $h['uri'])?>
        <? } ?>

         </div>
      <? }?>
    </div>






<!-- <div class="logo-wrap pos-right">
      <div class="enepi-tel">
-->
    <span class="tel-link-img">
        <div><?= Asset::img('layout/enepi_tel.png', array('class' => 'tel', 'alt' => 'Img tel'));?></div>
    </span>
<!-- </div>
    </div>
 -->
  </div>
</header>