<%= search_form_for [:admin, @q] do |f| %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :name_eq, required: false, label: "名前が等しい" %>
      <%= f.input :name_cont, required: false, label: "名前を含む" %>
      <%= f.input :tel_eq, required: false, label: "電話番号が等しい" %>
      <%= f.input :email_eq, required: false, label: "メールアドレスが等しい" %>
    </div>
  </div>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :prefecture_code_eq, collection: JpPrefecture::Prefecture.all.map { |p| [p.name, p.code] }, required: false, label: "都道府県" %>
      <%= f.input :new_prefecture_code_eq, collection: JpPrefecture::Prefecture.all.map { |p| [p.name, p.code] }, required: false, label: "都道府県(開設先)" %>
      <%= f.input :house_kind_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:house_kind), required: false, label: "物件種別" %>
      <%= f.input :ownership_kind_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:ownership_kind), required: false, label: "所有種別" %>
      <%= f.input :status_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:status), required: false, label: "ステータス" %>
      <%= f.input :user_status_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:user_status), required: false, label: "小ステータス" %>
      <div class="form-group">
        <label class="control-label">見積り進行状況</label>
        <%= select_tag :estimate_progress, options_for_select(['', '連絡済み', '訪問済み', '委任状獲得済み', '工事予定', '工事完了'], params[:estimate_progress]), class: 'form-control' %>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <div class="form-group">
        <label>問い合わせ日</label>
        <%= text_field_tag :created_at_gte, params[:created_at_gte], class: 'datepicker form-control left-side' %> ~
        <%= text_field_tag :created_at_lte, params[:created_at_lte], class: 'datepicker form-control' %>
      </div>
      <div class="form-group">
        <label>紹介日</label>
        <div class="form-inline">
          <%= text_field_tag :estimate_at_gte, params[:estimate_at_gte], class: 'datepicker form-control left-side' %> ~
          <%= text_field_tag :estimate_at_lte, params[:estimate_at_lte], class: 'datepicker form-control' %>
        </div>
      </div>
    </div>
  </div>

  <%= f.button :submit %>
<% end %>
<div class="form-group">
  <div class="btn-group" role="group" aria-label="...">
    <span class="btn btn-default">検索結果: <%= @contacts.total_count %>件</span>
    <% if @having_browsing_rights.present? %>
      <% if @contacts.total_count < 1000 %>
        <%= link_to "現在の検索条件でCSVをダウンロード", url_for(params.merge(format: :csv)), class: 'btn btn-default' %>
      <% else %>
        <%= link_to "現在の検索条件でCSVをダウンロード", 'javascript:void(0)', class: 'btn btn-default', disabled: true %>
      <% end %>
    <% end %>
    <% if @having_browsing_rights.present? %>
      <%= link_to "現在の検索条件で「対応履歴」CSVをダウンロード", 'javascript:void(0)', class: 'btn btn-default js-download-calling-history-csv' %>
    <% end %>
  </div>
</div>

<script>
  document.querySelector('.js-download-calling-history-csv').addEventListener('click', function() {
    swal({title: "csv を作成中です", text: "このまましばらくお待ち下さい。", showConfirmButton: false})

    var parser = document.createElement('a');
    parser.href = location.href;
    parser.search = parser.search ? parser.search + "&calling_history_csv=1" : "?calling_history_csv=1";
    $.ajax({
      type: 'GET',
      url: parser.href,
      dataType: 'json'
    })
    .done(function(data) {
      var i = -1;
      monitor = function() {
        $.ajax({
          type: 'HEAD',
          url: data.head_url
        })
        .done(function() {
          if (i !== -1) {
            clearInterval(i)
          }
//          swal.close()

          swal({
            title: "csv 作成しました",
            html: true,
            text: "パスワードは <br><pre>"+data.password+"</pre> です。"
          }, function() {
            window.open(data.get_url);
          })
        })
        .fail(function(err) {
          console.log(err)
          if (err.status === 404) {
            // waiting uploading
          } else {
            alert('エラーが発生しました');
            clearInterval(i)
          }
        })
      }
      i = setInterval(monitor, 3000)
      monitor()
      console.log(i)
    })
    .fail(function() {
      alert('エラーが発生しました');
    });

  })
</script>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <th>ID</th>
      <th>価格</th>
      <th>お名前</th>
      <th>問い合わせ<br>日時</th>
      <th>経由元</th>
      <th>電話番号</th>
      <th>
        <ul>
          <li>都道府県</li>
        </ul>
      </th>
      <th>開設先<br>都道府県</th>
      <th>自動<br>見積もり</th>
      <th>提示画面<br>閲覧済み</th>
      <th>見積もり数</th>
      <th>問い合わせ</th>
      <th>
        <ul>
          <li>管理者メモ</li>
          <li>対応履歴</li>
        </ul>
      </th>
    </tr>
  </thead>
  <tbody>
    <% @contacts.each do |c| %>
      <tr>
        <td>
          <% if c.callings.reject { |c| c.archived? }.size > 0 %>
            <i class="fa fa-phone"></i>
          <% end %>
        </td>
        <td><%= c.id %></td>
        <td><%= boolean_label c.from_kakaku? %></td>
        <td style="width: 6em"><%= c.name %></td>
        <td style="width: 4em"><%= format_datetime! c.created_at %></td>
        <td style="width: 4em"><%= c.pr_tracking_parameter.try!(:display_name) || "無し" %></td>
        <td><%= c.tel %></td>
        <td style="width: 4em">
          <ul>
            <% if c.prefecture.present? %>
              <li><%= c.prefecture.name %></li>
            <% else %>
              <li></li>
            <% end %>
            <li>種別(<%= c.estimate_kind ? c.enum_value_i18n(:estimate_kind).gsub(/の見積もり$/, "") : "" %>)</li>
          </ul>
        </td>
        <% if c.new_prefecture_name.present? %>
          <td><%= c.new_prefecture_name %></td>
        <% else %>
          <td></td>
        <% end %>
        <td><% if c.sent_auto_estimate_req %>◯<% else %>×<% end %></td>
        <td><%= c.enum_value_i18n(:is_seen) %></td>
        <td style="width: 6em">
          <ul>
            <li>送客(<%= c.estimates.size %>件)</li>
            <li>集合住宅(<%= boolean_label c.apartment_owner? %>)</li>
          </ul>
        </td>
        <td>
          <ul>
            <li>
              <span class="status <%= c.status %>">
                <%= c.enum_value_i18n(:status) %>
                <% unless c.no_action? %>
                  <br>(<%= c.enum_value_i18n(:user_status) %>)
                <% end %>
              </span>

              <% if c.estimate_progress.present? %>
                <% if c.estimate_progress == '未連絡' %>
                  <span class="status pending"><%= c.estimate_progress %></span>
                <% else %>
                  <span class="status contracted"><%= c.estimate_progress %></span>
                <% end %>
                <br>
              <% end %>
              <% unless c.status_reason_unknown? %>
                理由: <%= c.enum_value_i18n(:status_reason) %>
              <% end %>
            </li>
            <li><%= link_to '編集', edit_admin_lpgas_contact_path(c) %></li>
            <li><%= link_to '提示画面', lpgas_contact_path(c, token: c.token, pin: c.pin), target: "_blank" %></li>
            <li><%= lpgas_contact_cancel_link(c) %></li>
            <% if c.callings.reject { |c| c.archived? }.size == 0 %>
              <li><%= link_to '架電リストに追加', admin_lpgas_contact_calling_path(c), class: 'btn btn-default btn-xs', method: 'post' %></li>
            <% end %>
          </ui>
        </td>
        <td>
          <div data-scroll-y-container="1" style="margin-bottom: 0.4em">
            <%= newline_to_br c.admin_memo %>
          </div>
          <div data-scroll-y-container="1">
            <%= newline_to_br c.calling_histories.sorted.map(&:one_line_string).take(20).join("\n") %>
          </div>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>

<%= paginate @contacts %>
