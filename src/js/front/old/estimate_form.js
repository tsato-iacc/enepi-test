if ($('#register_form_old').length) {

  // PTEngine
  window._pt_lt = new Date().getTime();
  window._pt_sp_2 = [];
  _pt_sp_2.push('setAccount,1498b80c');
  var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
  (function() {
      var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
      atag.src = _protocol + 'js.ptengine.jp/pta.js';
      var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
      stag.src = _protocol + 'js.ptengine.jp/pts.js';
      var s = document.getElementsByTagName('script')[0]; 
      s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
  })();

  // Leave page event
  window.onbeforeunload = function(e){
    e.returnValue = 'このサイトを離れてもよろしいですか？';
  }
  $('input[type="submit"], input[type="image"], input[type="button"]').on('click', function() {
    window.onbeforeunload = null;
  });

  $(function() {
  
    // Checkbox
    var houseKindSelect = $('[name="lpgas_contact\[house_kind\]"]');
    var ownershipKindSelect = $('[name="lpgas_contact\[ownership_kind\]"]');
    houseKindSelect.on('change', function(e) {
      var v = $(e.target).val();
      var txt = ownershipKindSelect.parent().find(".js-text");
      if (v === "detached") {
        ownershipKindSelect.val("owner").hide();
        txt.text(ownershipKindSelect.find('option:selected').text());
      } else {
        ownershipKindSelect.val('').show();
        txt.text('');
      }
    });
    houseKindSelect.trigger('change');
    
    var estimateTypeRadio = $('input[name="lpgas_contact\[estimate_kind\]"]');
    estimateTypeRadio.on('change', estimateTypeChanged);
    estimateTypeRadio.trigger('change');

    // Btn
    var target = '';
    $(".md-btn").on('click', function(e){
      e.preventDefault();

      // Get the second class of "btn" class
      target = $(this).get(0).className.split(" ")[1];
      // Set the target modal window
      target = $(".modal." + target);
      // Show modal window
      if ( target.is(":hidden") ) {
        target.fadeIn(600);
        // $(".container").addClass("bg-blur");
      } else {
        target.hide();
        // $(".container").removeClass("bg-blur");
      }
    });
    
    // Hide modal window
    $(".close, .modal").on('click', function(){
      $(".modal").hide();
      // $(".container").removeClass("bg-blur");
    });
  });

  function DisableButton(b)
  {
    b.disabled = true;
    b.form.submit();
  }

  function estimateTypeChanged(evt) {
    var $node = $(evt.target);

    var val = $node.prop('checked') && $node.val();
    switch(val) {
    case "change_contract": // 現住所の見積もり
      $('.js-show-on-estimate-type-new-contract').hide();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').addClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').addClass('required');
      break;
    case "new_contract": // 新規契約
      $('.js-show-on-estimate-type-new-contract').show();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').removeClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').removeClass('required');
      break;
    default:
      $('.js-show-on-estimate-type-new-contract').hide();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').addClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').addClass('required');
    }
  }
}
