<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <meta name="referrer" content="origin">

  <%= display_meta_tags({
    site: Dh::Application.config.site_name,
    separator: "|",
    charset: 'utf-8',
    reverse: true,
  })%>

  <meta property="fb:app_id" content="590655641075329">

  <%= stylesheet_link_tag 'estimate_presentation', media: 'all' %>
  <%= javascript_include_tag 'estimate_presentation' %>
  <script src='//www.google.com/jsapi'></script>
  <%= csrf_meta_tags %>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-66015925-1', 'auto');
    ga('send', 'pageview');
  </script>

  <style>
    .alert-success {
      color: hsl(121, 33%, 35%);
      background-color: hsl(103, 44%, 89%);
      border-color: hsl(93, 44%, 85%);
    }

    .alert-danger {
      color: #a94442;
      background-color: #f2dede;
      border-color: #ebccd1;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid hsla(0, 0%, 0%, 0);
      border-radius: 4px;
    }
  </style>

  <% if enechange_tag_is_required? %>
    <%= render 'shared/enechange_tag_manager' %>
  <% end %>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NCCZDM6');</script>
<!-- End Google Tag Manager -->

  <%= yield :head %>
</head>
<body>
  <% if enechange_tag_is_required? %>
    <%= render 'shared/enechange_tag_manager_noscript' %>
  <% end %>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <header>
    <nav class="navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <span class="logo"></span>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="navbar-item">
              <div class="hidden_pc">
                <%= image_tag "estimate_presentation/img_tel.png", :class => 'tel' %>
              </div>
              <div class="hidden_sp">
              <span class="tel_nav"><i class="fa fa-hand-o-down" aria-hidden="true"></i>ここをタッチしてお電話できます！</span>
                <div class="btn_tel">
                  <a href="tel:0120771664"  onclick="ga('send', 'event', 'tel', 'click', 'contact_btn_sp', {'nonInteraction': 1});">
                    <%= image_tag "estimate_presentation/img_tel.png", :class => 'tel' %>
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <% unless @__no_drawer_menu %>
    <div class="drawer-side-menu">
      <%= link_to root_url do %>
        <%= image_tag asset_url("logo.png") %>
      <% end %>

      <ul>
        <% categories_depth_1.each do |cate_d1| %>
          <% d2 = categories_depth_2.select { |cate_d2| cate_d2['path_name_prog'].split("/")[0] == cate_d1['path_name_prog'] } %>

          <% if d2.size > 0 %>
            <span class="drawer-sub-heading"><%= cate_d1['name'] %></span>
            <% d2.each do |cate_d2| %>
              <li><%= link_to cate_d2['short_name'], category_path(cate_d2) %></li>
            <% end %>
          <% end %>
        <% end %>
        <li class="special"><%= link_to '切り替え相談', Rails.application.config.form_path %></li>
      </ul>
    </div>
    <div class="drawer-side-menu-overlay"></div>
  <% end %>

  <% if request.path_info == "/" %>
    <%= yield :cover %>
  <% elsif @__no_breadcrumb %>
    <div class="no-breadcrumb"></div>
  <% else %>
    <div class="breadcrumb">
      <div class="container">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
          <% breadcrumbs.each.with_index do |crumb, idx| %>
            <% is_last = breadcrumbs.size - 1 <= idx %>

            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
              <%= link_to crumb.path, itemprop: 'item' do %>
                <span itemprop="name"><%= crumb.name %></span></a>
              <% end %>

              <meta itemprop="position" content="<%= (idx + 1).to_i %>">
              <% if !is_last %>»<% end %>
            </li>
          <% end %>
        </ol>
      </div>
    </div>
  <% end %>

  <div class="page">
    <div class="main no-sidebar">
      <div class="page-content">
        <div class="estimate">
          <div class="container">
            <%= render "shared/bs_flash" %>

            <div class="container pc">
              <% if @contact.sent_estimate_req? %>
              <%= image_tag "estimate_presentation/new_step_img_02.png" %>
              <% else %>
              <%= image_tag "estimate_presentation/new_step_img_03.png" %>
              <% end %>
            </div>
            <div class="hidden_pc">
              <div class="catch_area">
                <h1>連絡を希望する会社を選びましょう！</h1>
              </div>
            </div>
            <div class="hidden_sp">
              <h1>連絡を希望する会社を選びましょう！</h1>
            </div>

          <% if @contact.pin.present? && @contact.pin != params[:pin] %>
            <div class="container section">
              <h2 class="header"><%= @contact.name %>様 マッチング会社一覧</h2>
              <div class="text-center">
                <div class="big" style="text-decoration: underline"><b>登録の電話番号宛にSMSにて認証コードを送りました</b></div>
                <p>
                  お客様の登録の電話番号宛にマイページの認証コードをSMS（ショートメッセージ）にてお送りしました。<br>
                  SMS本文中の認証コード４桁を以下の欄に入力して、<br>
                  ご提案内容を確認し、連絡を希望する会社を選択しましょう！
                </p>
              </div>
              <div>
                <div class="text-center">
                  <%= form_tag url_for, method: :get do %>
                    <%= hidden_field_tag :token, params[:token] %>
                    <div class="form-group" style="margin-top: 1.5em">
                      <label>認証コード(4桁)</label>
                      <%= number_field_tag :pin, class: 'form-control' %>
                    </div>
                    <div class="form-group">
                      <%= submit_tag "提案内容を見る", class: 'btn btn-primary' %>
                    </div>
                  <% end %>
                </div>

                <div class="row">
                  <div class="col-md-4 col-md-offset-2">
                    <h3>届かない方・固定電話の方</h3>

                    <p>
                      以下の電話番号宛にSMS（ショートメッセージ）をお送りしました。もし届いていないようでしたら「再度SMSで送る」ボタンを押してください。うまくいかない場合は携帯電話の国際SMS（ショートメッセージサービス）を有効にしてください。<u>固定電話の方は「音声確認をする」ボタンを押してください</u>
                  </p>
                  </div>
                  <div class="col-md-4">
                    <h3>入力した電話番号が間違っていた方</h3>

                    <p>
                      左下の入力された電話番号では無い場合、お手数ですが<u>「再入力はこちら」のボタンを押し</u>、もう一度電話番号を入力しましょう。<br>
                      わからない場合はエネピ運営事務局までご連絡ください。
                    </p>
                  </div>
                </div>

                <div class="text-center" style="font-size: 1.4em; margin-top: 1em; margin-bottom: 1em">
                  電話番号: <%= @contact.tel %>
                </div>

                <div class="row text-center">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                      <div class="col-md-4">
                        <%= link_to(
                          "再度SMSを送る",
                          "javascript:void(0)",
                          data: {ajax: 1, href: lpgas_contact_resend_pin_path(@contact, token: params[:token])},
                          class: 'btn btn-secondary',
                        ) %>
                      </div>
                      <div class="col-md-4">
                        <%= link_to(
                          "音声確認する",
                          "javascript:void(0)",
                          data: {ajax: 1, href: lpgas_contact_resend_pin_path(@contact, token: params[:token], tel: 1)},
                          class: 'btn btn-secondary',
                        ) %>
                      </div>
                      <% re_cv_params = {contact_id: @contact.id, token: params[:token], pr: @contact.pr_tracking_parameter.try!(:name)} %>
                      <% re_cv_url = if @contact.from_kakaku?
                                          endpoint = "https://propanegas.kakaku.com"
                                          if Rails.env.staging?
                                             endpoint = "https://stg.kakaku.enepi.jp"
                                          elsif Rails.env.development?
                                             endpoint = ""
                                          end
                                          "#{endpoint}#{new_kakaku_lpgas_contact_path(re_cv_params)}"
                                     elsif @contact.from_enechange?
                                       new_enechange_lpgas_contact_path(re_cv_params)
                                     else
                                       Rails.application.config.form_path + "?" + re_cv_params.to_query
                                     end %>
                      <div class="col-md-4">
                        <%= link_to(
                          "再入力はこちら",
                          re_cv_url,
                          class: 'btn btn-secondary'
                        ) %></b>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <h3>音声確認について</h3>
                    <p>
                      固定電話または携帯電話による電話番号認証システムを導入しています。現在応答できる電話番号を入力してください。「音声確認をする」をクリックすると表示されている電話番号に、認証コード４桁をお伝えする自動音声が流れます。流れない場合、電話番号が間違っているかもしれませんので、「再入力はこちら」のボタンから再度正しい番号を入力しましょう。
                    </p>
                  </div>
                </div>
              </div>

              <div class="row text-center" style="font-size: 1.4em; margin-top: 3em;">
                <div class="col-md-2 col-md-offset-4">
                 <a href="mailto:info@enepi.jp">info@enepi.jp</a>
                </div>
                <div class="col-md-2">
                 <a href="tel:0120-771-664">0120-771-664</a>
                </div>
              </div>

              <script>
                window.onbeforeunload = function(e){
                  e.returnValue = 'このサイトを離れてもよろしいですか？';
                }

                $('input[type="submit"], input[type="image"], input[type="button"]').on('click', function() {
                  window.onbeforeunload = null;
                });
              </script>
            </div>
          <% else %>
            <%= yield %>
          <% end %>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer">
      <div class="container">
        <div class="clearfix">
          <div class="footer-logo text-center"></div>
        </div>
        <div class="footer-copyright text-center">© 2016 enepi</div>
      </div>
    </div>
  </footer>

  <%= yield :tail %>


<!-- Yahoo Code for your Target List -->
<script type="text/javascript" language="javascript">
/* <![CDATA[ */
var yahoo_retargeting_id = 'OHJ9T2SB5Y';
var yahoo_retargeting_label = '';
var yahoo_retargeting_page_type = '';
var yahoo_retargeting_items = [{item_id: '', category_id: '', price: '', quantity: ''}];
/* ]]> */
</script>
<script type="text/javascript" language="javascript" src="https://b92.yahoo.co.jp/js/s_retargeting.js"></script>
<!-- Yahoo Code for your Target List END-->


<!-- YDN -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 835778474;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/835778474/?guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- YDN END -->



<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '593069570863388');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=593069570863388&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<script src="https://ca.iacc.tokyo/js/ca.js"></script>
<script>
capv();
</script>


  <div class="hidden_sp">
    <nav class="navbar navbar-fixed-bottom fixed_button_area">
      <div class="container">
        <a href="tel:0120771664"  onclick="ga('send', 'event', 'tel', 'click', 'contact_btn_sp', {'nonInteraction': 1});" class="btn btn-tel"><i class="fa fa-phone ico_tel" aria-hidden="true"></i>電話でのお問い合わせはこちら</a>
      </div>
    </nav>
  </div>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCCZDM6"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
</body>
</html>
