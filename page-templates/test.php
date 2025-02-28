<?php

get_header('', ['pageId' => '']); 
?>

<main>

  <section class="contact" id="contact">
    <div class="l-inner">
      <div class="contact__inner">
        <h2 class="contact__title">お問い合わせフォーム</h2>

        <form id="contact-form" method="post" action="/confirm/" enctype="multipart/form-data">
          <div class="form">
            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">お名前</span>
              </label>
              <div class="form__wrap">
                <input type="text" name="your-name" class="form__input" required value="<?php echo isset($form_data['your-name']) ? esc_attr($form_data['your-name']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">メールアドレス</span>
              </label>
              <div class="form__wrap">
                <input type="email" name="your-email" class="form__input" required value="<?php echo isset($form_data['your-email']) ? esc_attr($form_data['your-email']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">郵便番号</label>
              <div class="form__wrap">
                <input type="text" name="zip" class="form__input" value="<?php echo isset($form_data['zip']) ? esc_attr($form_data['zip']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required is-pc-tab">必須</span>
                <span class="form__text">住所</span>
              </label>
              <div class="form__wrap">
                <label class="form__label">
                  <span class="form__required is-sp">必須</span>
                  <span class="form__address-text">都道府県</span>
                </label>
                <div class="form__select-wrap">
                  <select name="prefecture" class="form__select" required>
                    <option value="">-- 選択してください --</option>
                    <?php
                      $prefectures = [
                          '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', 
                          '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', 
                          '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', 
                          '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', 
                          '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', 
                          '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', 
                          '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
                      ];
                      foreach ($prefectures as $prefecture) {
                          $selected = (isset($form_data['prefecture']) && $form_data['prefecture'] === $prefecture) ? 'selected' : '';
                          echo '<option value="' . esc_attr($prefecture) . '" ' . $selected . '>' . esc_html($prefecture) . '</option>';
                      }
                      ?>
                  </select>
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">市区町村・番地</span>
                  </label>
                  <input type="text" name="city" class="form__input" required value="<?php echo isset($form_data['city']) ? esc_attr($form_data['city']) : ''; ?>">
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">建物名・部屋番号</span>
                  </label>
                  <input type="text" name="building" class="form__input"  value="<?php echo isset($form_data['building']) ? esc_attr($form_data['building']) : ''; ?>">
                </div>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">電話番号</span>
              </label>
              <div class="form__wrap">
                <input type="tel" name="tel" class="form__input" required value="<?php echo isset($form_data['tel']) ? esc_attr($form_data['tel']) : ''; ?>">
              </div>
            </div>

            <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">お住まいのタイプ</span>
              </label>
              <div class="form__select-wrap">
                <select name="house-type" class="form__select" required>
                  <option value="">-- 選択してください --</option>
                  <option value="戸建て" <?php echo (isset($form_data['house-type']) && $form_data['house-type'] === '戸建て') ? 'selected' : ''; ?>>戸建て</option>
                  <option value="マンション" <?php echo (isset($form_data['house-type']) && $form_data['house-type'] === 'マンション') ? 'selected' : ''; ?>>マンション</option>
                </select>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">リフォームしたい箇所</span>
              </label>
              <div class="form__select-wrap">
                <select name="reform-place" class="form__select" required>
                  <option value="">-- 選択してください --</option>
                  <option value="窓" <?php echo (isset($form_data['reform-place']) && $form_data['reform-place'] === '窓') ? 'selected' : ''; ?>>窓</option>
                  <option value="玄関ドア" <?php echo (isset($form_data['reform-place']) && $form_data['reform-place'] === '玄関ドア') ? 'selected' : ''; ?>>玄関ドア</option>
                </select>
              </div>
            </div>

            <!-- 窓の情報 -->
            <?php
            // 既存の窓情報を取得
            $window_count = 1; // デフォルト
            if (isset($form_data)) {
                foreach ($form_data as $key => $value) {
                    if (preg_match('/^count-(\d+)$/', $key, $matches)) {
                        $window_count = max($window_count, intval($matches[1]));
                    }
                }
            }
            
            // 最初の窓情報フォーム
            ?>
            <div class="window-info" data-window-count="1">
              <h4 class="window-info__title">窓の情報（1）</h4>
              
              <div class="window-info__size">
                <label class="form__label">
                  <span class="form__optional">任意</span>
                  <span class="form__text">サイズ</span>
                </label>
                <div class="window-info__wrap">
                  <div class="window-info__size-inputs">
                    <div class="window-info__item">
                      <span class="window-info__label">高さ</span>
                      <input type="text" name="height-1" class="form__input-s" value="<?php echo isset($form_data['height-1']) ? esc_attr($form_data['height-1']) : ''; ?>">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">幅</span>
                      <input type="text" name="width-1" class="form__input-s" value="<?php echo isset($form_data['width-1']) ? esc_attr($form_data['width-1']) : ''; ?>">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">窓枠</span>
                      <input type="text" name="frame-1" class="form__input-s" value="<?php echo isset($form_data['frame-1']) ? esc_attr($form_data['frame-1']) : ''; ?>">
                    </div>
                  </div>
                  <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                  <div class="window-info__btn">
                    <a href="">窓の測り方</a>
                  </div>
                </div>
              </div>

              <div class="window-info__image">
                <label class="form__label">
                  <span class="form__optional">任意</span>
                  写真画像
                </label>
                <div class="window-info__file-wrapper">
                  <input type="file" name="photo-1" class="form__file" value="<?php echo isset($form_data['photo-1']) ? esc_attr($form_data['photo-1']) : ''; ?>">
                  <span class="window-info__file-name"></span>
                  <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                  <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                </div>
              </div>
              <div class="window-info__count">
                <label class="form__label">
                  <span class="form__required">必須</span>
                  <span class="form__text">枚数</span>
                </label>
                <div class="window-info__wrap window-info__wrap--unit">
                  <input type="number" name="count-1" class="form__input-s" min="1" required value="<?php echo isset($form_data['count-1']) ? esc_attr($form_data['count-1']) : ''; ?>">
                </div>
              </div>

              <div class="window-info__place">
                <label class="form__label">
                  <span class="form__required">必須</span>
                  <span class="form__text">場所</span>
                </label>
                <div class="window-info__wrap">
                  <div class="form__select-wrap">
                    <select name="place-1" class="form__select" required>
                      <option value="">-- 選択してください --</option>
                      <option value="LDK" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === 'LDK') ? 'selected' : ''; ?>>LDK</option>
                      <option value="浴室" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === '浴室') ? 'selected' : ''; ?>>浴室</option>
                      <option value="和室" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === '和室') ? 'selected' : ''; ?>>和室</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form__add-btn">
              <button type="button" class="form__add-window">窓を追加する</button>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__optional">任意</span>
                <span class="form__text">現地調査希望日</span>
              </label>
              <div class="form__wrap">
                <input type="text" name="preferred-date" id="preferred-date" class="form__input datepicker" readonly>
                
                <div class="form__radio-group">
                  <label class="form__radio-label">
                    <input type="radio" name="preferred-time" value="午前" class="form__radio">
                    <span>午前中</span>
                  </label>
                  <label class="form__radio-label">
                    <input type="radio" name="preferred-time" value="午後" class="form__radio">
                    <span>午後</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">その他</label>
              <div class="form__wrap">
                <textarea name="other" class="form__textarea" value="<?php echo isset($form_data['other']) ? esc_attr($form_data['other']) : ''; ?>"></textarea>
              </div>
            </div>

            <div class="form__submit">
              <input type="submit" class="form__button" value="入力内容を確認">
            </div>
          </div>
        </form>


      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

<script>
  jQuery(document).ready(function($) {
    // Datepicker初期化
    $('.datepicker').datepicker({
      dateFormat: 'yy/mm/dd',
      minDate: 1, // 明日から選択可能
      beforeShowDay: function(date) {
        // 土日を選択不可に
        // var day = date.getDay();
        // return [day != 0 && day != 6, ''];

        // 全日選択可能
        return [true, ''];
      }
    });
  });

  jQuery(document).ready(function($) {
    const $container = $('.form');
    const $addButton = $('.form__add-window');
    let windowCount = $('.window-info').length;
    
    // 窓追加ボタンの表示/非表示を更新
    function updateAddButtonVisibility() {
      if (windowCount >= 5) {
        $('.form__add-btn').hide();
      } else {
        $('.form__add-btn').show();
      }
    }
    
    // 初期表示時にボタン表示を更新
    updateAddButtonVisibility();
    
    $addButton.on('click', function() {
      windowCount++;
      
      if (windowCount > 5) {
        alert('窓の追加は最大5つまでです');
        windowCount--;
        return;
      }

      // テンプレートをクローン
      const $template = $('.window-info').first().clone();
      
      // 新しい窓の属性を更新
      $template.attr('data-window-count', windowCount);
      $template.find('input, select').each(function() {
        const oldName = $(this).attr('name');
        if (oldName && oldName.includes('-1')) {
          $(this).attr('name', oldName.replace(/-1/, `-${windowCount}`));
          $(this).val('');
        }
      });
      
      // タイトルを更新
      $template.find('.window-info__title').text(`窓の情報（${windowCount}）`);

      // 削除ボタンを追加
      if (!$template.find('.window-info__remove').length) {
        const $removeButton = $('<button type="button" class="window-info__remove">×</button>');
        $template.prepend($removeButton);
      }

      $template.find('.window-info__file-name').text('');

      $container.find('.form__add-btn').before($template);
      
      // 削除ボタンのイベント
      $template.find('.window-info__remove').on('click', function() {
        $(this).closest('.window-info').remove();
        windowCount--;
        updateAddButtonVisibility();
      });
      
      // ボタン表示を更新
      updateAddButtonVisibility();
    });
    
    // 既存の削除ボタンのイベント
    $container.on('click', '.window-info__remove', function() {
      $(this).closest('.window-info').remove();
      windowCount--;
      updateAddButtonVisibility();
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
  // フォームの要素を取得
  const form = document.getElementById('contact-form');
  if (!form) return;
  
  // カスタムエラーメッセージを定義
  const customMessages = {
    'your-name': 'お名前を入力してください',
    'your-email': 'メールアドレスを入力してください',
    'zip': '郵便番号を入力してください',
    'prefecture': '都道府県を選択してください',
    'city': '市区町村・番地を入力してください',
    'building': '建物名・部屋番号を入力してください',
    'tel': '電話番号を入力してください',
    'house-type': 'お住まいのタイプを選択してください',
    'reform-place': 'リフォームしたい箇所を選択してください',
    'preferred-date': '希望日を入力してください'
  };
  
  // エラーメッセージを表示する関数
  function addErrorMessage(field, message) {
    const errorMsg = document.createElement('div');
    errorMsg.className = 'form__error';
    errorMsg.textContent = message;
    errorMsg.style.color = '#ff0000';
    errorMsg.style.fontSize = '14px';
    errorMsg.style.marginTop = '5px';
    errorMsg.style.display = 'block';
    
    // エラーメッセージを入力フィールドの親要素に追加
    const parent = field.parentElement;
    if (parent) {
      // 既存のエラーメッセージがあれば削除
      const existingError = parent.querySelector('.form__error');
      if (existingError) {
        existingError.remove();
      }
      parent.appendChild(errorMsg);
    } else {
      // 親要素がない場合は直後に追加
      field.insertAdjacentElement('afterend', errorMsg);
    }
  }
  
  // エラーメッセージを探す関数
  function findErrorMessage(field) {
    const parent = field.parentElement;
    if (parent) {
      return parent.querySelector('.form__error');
    }
    // 親要素がない場合は次の要素をチェック
    return field.nextElementSibling && field.nextElementSibling.classList.contains('form__error') ? 
           field.nextElementSibling : null;
  }
  
  // メールアドレスのバリデーション関数
  function isValidEmail(email) {
    const pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return pattern.test(email);
  }
  
  // 電話番号のバリデーション関数
  function isValidTel(tel) {
    // ハイフンありなしどちらも許可
    const pattern = /^(0\d{1,4}-\d{1,4}-\d{4}|\d{10,11})$/;
    return pattern.test(tel);
  }
  
  // 郵便番号のバリデーション関数
  function isValidZip(zip) {
    // ハイフンありなしどちらも許可
    const pattern = /^(\d{3}-\d{4}|\d{7})$/;
    return pattern.test(zip);
  }
  
  // フォーム送信時のバリデーション
  form.addEventListener('submit', function(event) {
    // 必須フィールドをチェック
    let firstErrorField = null;
    let hasError = false;
    
    // 全ての必須フィールドをチェック
    form.querySelectorAll('[required]').forEach(function(field) {
      // フィールドが空か、セレクトボックスの場合はデフォルト値のまま
      if (!field.value || (field.tagName === 'SELECT' && (field.value === '' || field.value === '-- 選択してください --'))) {
        // エラースタイルを適用
        field.style.borderColor = '#ff0000';
        field.style.backgroundColor = '#fff8f8';
        
        // エラーメッセージが既にあるか確認
        let existingError = findErrorMessage(field);
        if (!existingError) {
          // エラーメッセージを作成
          let message = 'このフィールドは必須です';
          
          // 通常のフィールド名チェック
          if (customMessages[field.name]) {
            message = customMessages[field.name];
          } 
          // 動的フィールド名（count-1, place-2など）のチェック
          else {
            // count-* パターンのフィールド
            if (/^count-\d+$/.test(field.name)) {
              message = '枚数を入力してください';
            } 
            // place-* パターンのフィールド
            else if (/^place-\d+$/.test(field.name)) {
              message = '場所を選択してください';
            }
          }
          
          // エラーメッセージを表示
          addErrorMessage(field, message);
        }
        
        // 最初のエラーフィールドを記録
        if (!firstErrorField) {
          firstErrorField = field;
        }
        
        hasError = true;
      }
    });
    
    // エラーチェック: メールアドレス
    const emailField = form.querySelector('input[name="your-email"]');
    if (emailField && emailField.value && !isValidEmail(emailField.value)) {
      if (!findErrorMessage(emailField)) {
        addErrorMessage(emailField, '有効なメールアドレスを入力してください');
      }
      emailField.style.borderColor = '#ff0000';
      emailField.style.backgroundColor = '#fff8f8';
      if (!firstErrorField) firstErrorField = emailField;
      hasError = true;
    }
    
    // エラーチェック: 電話番号
    const telField = form.querySelector('input[name="tel"]');
    if (telField && telField.value && !isValidTel(telField.value)) {
      if (!findErrorMessage(telField)) {
        addErrorMessage(telField, '有効な電話番号を入力してください');
      }
      telField.style.borderColor = '#ff0000';
      telField.style.backgroundColor = '#fff8f8';
      if (!firstErrorField) firstErrorField = telField;
      hasError = true;
    }
    
    // エラーチェック: 郵便番号（入力されている場合）
    const zipField = form.querySelector('input[name="zip"]');
    if (zipField && zipField.value && !isValidZip(zipField.value)) {
      if (!findErrorMessage(zipField)) {
        addErrorMessage(zipField, '有効な郵便番号を入力してください（例: 123-4567）');
      }
      zipField.style.borderColor = '#ff0000';
      zipField.style.backgroundColor = '#fff8f8';
      if (!firstErrorField) firstErrorField = zipField;
      hasError = true;
    }
    
    // エラーがある場合は送信をキャンセル
    if (hasError) {
      event.preventDefault();
      
      // 最初のエラーフィールドにスクロールとフォーカス
      if (firstErrorField) {
        setTimeout(function() {
          firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
          firstErrorField.focus();
        }, 100);
      }
    }
  });
  
  // 入力中にエラー表示をクリア
  form.addEventListener('input', function(e) {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') {
      e.target.style.borderColor = '';
      e.target.style.backgroundColor = '';
      
      const errorMsg = findErrorMessage(e.target);
      if (errorMsg) {
        errorMsg.remove();
      }
    }
  });
  
  // blur時のバリデーション（フォーカスが外れた時）
  form.addEventListener('blur', function(e) {
    if ((e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') && 
        e.target.hasAttribute('required')) {
      
      // 必須フィールドで値がない場合
      if (!e.target.value || (e.target.tagName === 'SELECT' && (e.target.value === '' || e.target.value === '-- 選択してください --'))) {
        e.target.style.borderColor = '#ff0000';
        e.target.style.backgroundColor = '#fff8f8';
        
        // メッセージが既にあるか確認
        if (!findErrorMessage(e.target)) {
          let message = 'このフィールドは必須です';
          
          // メッセージの取得
          if (customMessages[e.target.name]) {
            message = customMessages[e.target.name];
          } else if (/^count-\d+$/.test(e.target.name)) {
            message = '枚数を入力してください';
          } else if (/^place-\d+$/.test(e.target.name)) {
            message = '場所を選択してください';
          }
          
          addErrorMessage(e.target, message);
        }
      }
    }
    
    // メールアドレスのバリデーション
    if (e.target.name === 'your-email' && e.target.value && !isValidEmail(e.target.value)) {
      e.target.style.borderColor = '#ff0000';
      e.target.style.backgroundColor = '#fff8f8';
      if (!findErrorMessage(e.target)) {
        addErrorMessage(e.target, '有効なメールアドレスを入力してください');
      }
    }
    
    // 電話番号のバリデーション
    if (e.target.name === 'tel' && e.target.value && !isValidTel(e.target.value)) {
      e.target.style.borderColor = '#ff0000';
      e.target.style.backgroundColor = '#fff8f8';
      if (!findErrorMessage(e.target)) {
        addErrorMessage(e.target, '有効な電話番号を入力してください');
      }
    }
    
    // 郵便番号のバリデーション
    if (e.target.name === 'zip' && e.target.value && !isValidZip(e.target.value)) {
      e.target.style.borderColor = '#ff0000';
      e.target.style.backgroundColor = '#fff8f8';
      if (!findErrorMessage(e.target)) {
        addErrorMessage(e.target, '有効な郵便番号を入力してください（例: 123-4567）');
      }
    }
  }, true);
  
  // 窓追加ボタンがクリックされた後の処理
  const addWindowBtn = document.querySelector('.form__add-window');
  if (addWindowBtn) {
    addWindowBtn.addEventListener('click', function() {
      // 遅延を設けて新しい窓情報が追加された後に処理
      setTimeout(function() {
        const newWindow = document.querySelector('.window-info:last-child');
        if (newWindow) {
          // 新しい窓情報の必須項目を取得
          const requiredFields = newWindow.querySelectorAll('[required]');
          // 既に全体のイベントリスナーが設定されているので、個別には追加不要
        }
      }, 100);
    });
  }
  
  // ファイル選択ボタンの処理
  const fileButtons = document.querySelectorAll('.js-file-btn');
  fileButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      const fileInput = this.parentNode.querySelector('.form__file');
      if (fileInput) {
        fileInput.click();
      }
    });
  });
  
  // ファイル選択時の表示
  const fileInputs = document.querySelectorAll('.form__file');
  fileInputs.forEach(function(input) {
    input.addEventListener('change', function() {
      const fileName = this.value.split('\\').pop();
      const fileNameDisplay = this.parentNode.querySelector('.window-info__file-name');
      if (fileNameDisplay) {
        fileNameDisplay.textContent = fileName || '';
      }
    });
  });
});

  
</script>

