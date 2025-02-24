export class FormHandler {
    // FormHandlerクラスに追加
validateForm() {
    let isValid = true;
    const errors = [];
  
    // 必須フィールドのチェック
    document.querySelectorAll('.form__input, .form__select, .form__textarea').forEach(field => {
      // 必須フィールドのみチェック
      if (field.closest('.form__wrap') && field.closest('.form__wrap').previousElementSibling && 
          field.closest('.form__wrap').previousElementSibling.querySelector('.form__required')) {
        
        if (!field.value || (field.tagName === 'SELECT' && field.value === '-- 選択してください --')) {
          isValid = false;
          field.style.borderColor = '#ff0000';
          
          // エラーメッセージの追加
          const errorMsg = document.createElement('span');
          errorMsg.className = 'form__error-message';
          errorMsg.textContent = 'このフィールドは必須です';
          errorMsg.style.color = '#ff0000';
          errorMsg.style.fontSize = '12px';
          errorMsg.style.display = 'block';
          errorMsg.style.marginTop = '5px';
          
          // 既存のエラーメッセージを削除
          const existingError = field.parentNode.querySelector('.form__error-message');
          if (existingError) {
            existingError.remove();
          }
          
          field.parentNode.appendChild(errorMsg);
          errors.push(field);
        }
      }
    });
  
    // 動的に追加した窓情報の必須フィールドをチェック
    document.querySelectorAll('.window-info').forEach(windowInfo => {
      const countField = windowInfo.querySelector('input[name^="count-"]');
      const placeField = windowInfo.querySelector('select[name^="place-"]');
      
      if (countField && !countField.value) {
        isValid = false;
        countField.style.borderColor = '#ff0000';
        
        const errorMsg = document.createElement('span');
        errorMsg.className = 'form__error-message';
        errorMsg.textContent = '枚数を入力してください';
        errorMsg.style.color = '#ff0000';
        errorMsg.style.fontSize = '12px';
        errorMsg.style.display = 'block';
        errorMsg.style.marginTop = '5px';
        
        const existingError = countField.parentNode.querySelector('.form__error-message');
        if (existingError) {
          existingError.remove();
        }
        
        countField.parentNode.appendChild(errorMsg);
        errors.push(countField);
      }
      
      if (placeField && (!placeField.value || placeField.value === '-- 選択してください --')) {
        isValid = false;
        placeField.style.borderColor = '#ff0000';
        
        const errorMsg = document.createElement('span');
        errorMsg.className = 'form__error-message';
        errorMsg.textContent = '場所を選択してください';
        errorMsg.style.color = '#ff0000';
        errorMsg.style.fontSize = '12px';
        errorMsg.style.display = 'block';
        errorMsg.style.marginTop = '5px';
        
        const existingError = placeField.parentNode.querySelector('.form__error-message');
        if (existingError) {
          existingError.remove();
        }
        
        placeField.parentNode.appendChild(errorMsg);
        errors.push(placeField);
      }
    });
  
    // エラーがあれば最初のエラーフィールドへスクロール
    if (errors.length > 0) {
      errors[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      setTimeout(() => {
        errors[0].focus();
      }, 500);
    }
  
    return isValid;
  }

  constructor() {
      this.windowCount = 1;
      this.maxWindows = 5;
      this.init();
  }

  init() {
    const form = document.querySelector('.wpcf7-form');
    if (form) {
    form.addEventListener('submit', (e) => {
        // 「入力内容を確認」ボタンがクリックされた場合のみバリデーション
        const submitButton = e.submitter;
        if (submitButton && submitButton.value === '入力内容を確認') {
        if (!this.validateForm()) {
            e.preventDefault();
        }
        }
    });
    }
      const addButton = document.querySelector('.form__add-window');
      if (addButton) {
          addButton.addEventListener('click', () => this.addWindow());
      }

      document.addEventListener('click', (e) => {
          if (e.target.matches('.window-info__remove')) {
              this.removeWindow(e.target.closest('.window-info'));
          }
          if (e.target.matches('.js-file-btn')) {
              const fileWrapper = e.target.closest('.window-info__file-wrapper');
              const fileInput = fileWrapper.querySelector('.form__file');
              fileInput.click();
          }
      });

      // ファイル選択時の処理
      document.addEventListener('change', (e) => {
          if (e.target.matches('.form__file')) {
              const fileWrapper = e.target.closest('.window-info__file-wrapper');
              const fileNameSpan = fileWrapper.querySelector('.window-info__file-name');
              if (e.target.files.length > 0) {
                  fileNameSpan.textContent = e.target.files[0].name;
              } else {
                  fileNameSpan.textContent = '';
              }
          }
      });
  }

  addWindow() {
      if (this.windowCount >= this.maxWindows) {
          alert('窓の追加は最大5つまでです');
          return;
      }

      this.windowCount++;
      const newWindow = this.createWindowTemplate(this.windowCount);
      
      const addButton = document.querySelector('.form__add-btn');
      addButton.insertAdjacentHTML('beforebegin', newWindow);

      if (this.windowCount >= this.maxWindows) {
          document.querySelector('.form__add-btn').style.display = 'none';
      }
  }

  removeWindow(windowElement) {
      windowElement.remove();
      this.windowCount--;

      // 窓情報の番号を振り直す
      const windowInfos = document.querySelectorAll('.window-info');
      windowInfos.forEach((info, index) => {
          const num = index + 1;
          info.querySelector('.window-info__title').textContent = `窓の情報（${num}）`;
          info.dataset.windowCount = num;
          
          // 各input要素のname属性を更新
          info.querySelectorAll('input, select').forEach(input => {
              input.name = input.name.replace(/\d+/, num);
          });
      });

      // 追加ボタンを再表示
      document.querySelector('.form__add-btn').style.display = 'block';
  }

  createWindowTemplate(num) {
    return `
        <div class="window-info" data-window-count="${num}">
            <h4 class="window-info__title">窓の情報（${num}）</h4>
            <button type="button" class="window-info__remove">×</button>
            
            <div class="window-info__size">
                <label class="form__label">
                    <span class="form__optional">任意</span>
                    <span class="form__text">サイズ</span>
                </label>
                <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                            <span class="window-info__label">高さ</span>
                            <input type="text" name="height-${num}" class="form__input-s"> 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                            <span class="window-info__label">幅</span>
                            <input type="text" name="width-${num}" class="form__input-s"> 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                            <span class="window-info__label">窓枠</span>
                            <input type="text" name="frame-${num}" class="form__input-s">
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
                    <input type="file" name="photo-${num}" class="form__file">
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
                    <input type="number" name="count-${num}" class="form__input-s" min="1" required>
                </div>
            </div>

            <div class="window-info__place">
                <label class="form__label">
                    <span class="form__required">必須</span>
                    <span class="form__text">場所</span>
                </label>
                <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        <select name="place-${num}" class="form__select" required>
                            <option value="">-- 選択してください --</option>
                            <option value="リビング">リビング</option>
                            <option value="寝室">寝室</option>
                            <option value="キッチン">キッチン</option>
                            <option value="浴室">浴室</option>
                            <option value="トイレ">トイレ</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    `;
}
}

export function initForm() {
  new FormHandler();

  document.addEventListener('wpcf7invalid', function(event) {
    // フォームの要素を取得
    const form = document.querySelector('.wpcf7-form');
    if (!form) return;
    
    // 必須フィールドをチェック
    let firstErrorField = null;
    
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
      'preferred-month': '月を入力してください',
      'preferred-day': '日を入力してください'
    };
    
    // 全ての必須フィールドをチェック
    form.querySelectorAll('.wpcf7-validates-as-required').forEach(function(field) {
      // フィールドが空か、セレクトボックスの場合はデフォルト値のまま
      if (!field.value || (field.tagName === 'SELECT' && field.value === '-- 選択してください --')) {
        // エラースタイルを適用
        field.style.borderColor = '#ff0000';
        
        // エラーメッセージが既にあるか確認
        const existingError = field.parentNode.querySelector('.custom-error-message');
        if (!existingError) {
          // エラーメッセージを作成
          const errorMsg = document.createElement('span');
          errorMsg.className = 'custom-error-message';
          errorMsg.style.color = '#ff0000';
          errorMsg.style.fontSize = '12px';
          errorMsg.style.display = 'block';
          errorMsg.style.marginTop = '5px';
          
          // フィールド名からカスタムメッセージを取得
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
          
          errorMsg.textContent = message;
          
          // メッセージを表示
          field.parentNode.appendChild(errorMsg);
        }
        
        // 最初のエラーフィールドを記録
        if (!firstErrorField) {
          firstErrorField = field;
        }
      }
    });
    
    // 最初のエラーフィールドにスクロールとフォーカス
    if (firstErrorField) {
      setTimeout(function() {
        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstErrorField.focus();
      }, 100);
    }
    
    // 全体のエラーメッセージを非表示
    const responseOutput = document.querySelector('.wpcf7-response-output');
    if (responseOutput) {
      responseOutput.style.display = 'none';
    }
  });
  
  // 入力中にエラー表示をクリア
  document.addEventListener('input', function(e) {
    if (e.target.closest('.wpcf7-form')) {
      e.target.style.borderColor = '';
      const errorMsg = e.target.parentNode.querySelector('.custom-error-message');
      if (errorMsg) {
        errorMsg.remove();
      }
    }
  });
}