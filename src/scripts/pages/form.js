export class FormHandler {
    
    constructor() {
      this.visibleWindows = 1; // 表示中の窓情報数
      this.maxWindows = 5;     // 最大窓情報数
      this.init();
    }
  
    init() {
      // 窓情報の表示/非表示を初期設定
      this.initWindowInfoDisplay();
      
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
        addButton.addEventListener('click', () => this.showNextWindow());
      }

      // 窓の削除ボタンのイベントリスナーを追加
      document.addEventListener('click', (e) => {
        if (e.target.matches('.window-info__remove')) {
          this.removeWindow(e.target);
        }
      });
  
      document.addEventListener('click', (e) => {
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

    // 窓の削除メソッドを追加
    removeWindow(removeButton) {
      const windowInfo = removeButton.closest('.window-info');
      const windowCount = parseInt(windowInfo.getAttribute('data-window-count'));
      
      // 最初の窓は削除できない
      if (windowCount === 1) return;
      
      // 窓を非表示にし、フィールドの必須属性を削除
      windowInfo.style.display = 'none';
      this.markRequiredFields(windowInfo, false);
      
      // 枚数と場所フィールドのrequired属性を削除
      const countField = windowInfo.querySelector(`[name^="count-${windowCount}"]`);
      const placeField = windowInfo.querySelector(`[name^="place-${windowCount}"]`);
      
      if (countField) {
        countField.removeAttribute('required');
        countField.name = countField.name.replace('*', '');
        countField.classList.remove('wpcf7-validates-as-required');
      }
      
      if (placeField) {
        placeField.removeAttribute('required');
        placeField.name = placeField.name.replace('*', '');
        placeField.classList.remove('wpcf7-validates-as-required');
      }
      
      // 表示中の窓の数を減らす
      this.visibleWindows--;
      
      // 追加ボタンを再表示
      const addButton = document.querySelector('.form__add-window');
      if (addButton) {
        addButton.style.display = 'block';
      }
      
      // 入力内容をクリア
      const inputFields = windowInfo.querySelectorAll('input, select, textarea');
      inputFields.forEach(field => {
        field.value = '';
        // ファイル入力の場合は特別に対応
        if (field.type === 'file') {
          const fileNameSpan = field.closest('.window-info__file-wrapper').querySelector('.window-info__file-name');
          if (fileNameSpan) {
            fileNameSpan.textContent = '';
          }
        }
      });
    }
  
    // 窓情報の表示/非表示の初期設定
    initWindowInfoDisplay() {
      // 2つ目以降の窓情報を非表示に
      const windowInfos = document.querySelectorAll('.window-info');
      windowInfos.forEach((info, index) => {
        if (index >= 1) { // 1番目以外を非表示
          info.style.display = 'none';
          
          // この時点では非表示の窓情報内の必須フィールドは required 属性を一時的に削除
          // ただし後で復元できるようにマークしておく
          this.markRequiredFields(info, false);
        }
      });
    }
  
    // required 属性をマークまたは復元する
    markRequiredFields(container, setRequired) {
      // 必須マークがついている要素を取得
      const requiredLabels = container.querySelectorAll('.form__label .form__required');
      
      requiredLabels.forEach(label => {
        // ラベルに対応する入力フィールドを見つける
        const wrap = label.closest('.form__label').nextElementSibling;
        if (!wrap) return;
        
        // 入力フィールドまたはセレクトボックスを取得
        const fields = wrap.querySelectorAll('input, select, textarea');
        
        fields.forEach(field => {
          if (setRequired) {
            // required属性を設定
            field.setAttribute('required', '');
            field.classList.add('wpcf7-validates-as-required');
          } else {
            // required属性を一時的に削除
            field.removeAttribute('required');
            // 後で戻せるようにマークしておく
            field.dataset.wasRequired = 'true';
          }
        });
      });
    }
  
    // 次の窓情報を表示する
    showNextWindow() {
      if (this.visibleWindows >= this.maxWindows) {
        alert('窓の追加は最大5つまでです');
        return;
      }
  
      this.visibleWindows++;
      const nextWindow = document.querySelector(`.window-info[data-window-count="${this.visibleWindows}"]`);
      
      if (nextWindow) {
        // 表示する前に必須フィールドを復元
        this.markRequiredFields(nextWindow, true);
        
        // 以下の特定のフィールドには手動でrequired属性を追加する
        // Contact Form 7はフィールド名に * が付いているものを必須と認識するため
        const countField = nextWindow.querySelector(`[name="count-${this.visibleWindows}"]`);
        const placeField = nextWindow.querySelector(`[name="place-${this.visibleWindows}"]`);
        
        if (countField) {
          countField.setAttribute('required', '');
          // nameの値を*付きに変更して必須フィールドとして認識させる
          countField.name = `count-${this.visibleWindows}*`;
          countField.classList.add('wpcf7-validates-as-required');
        }
        
        if (placeField) {
          placeField.setAttribute('required', '');
          // nameの値を*付きに変更して必須フィールドとして認識させる
          placeField.name = `place-${this.visibleWindows}*`;
          placeField.classList.add('wpcf7-validates-as-required');
        }
        
        // 表示
        nextWindow.style.display = 'block';
      }
  
      // 最大数に達したらボタンを非表示
      if (this.visibleWindows >= this.maxWindows) {
        document.querySelector('.form__add-btn').style.display = 'none';
      }
    }
  
    // フォームのバリデーション
    validateForm() {
      let isValid = true;
      const errors = [];
      
      // 表示されている窓情報をすべて検証
      document.querySelectorAll('.window-info').forEach(windowInfo => {
        // 非表示の窓情報はスキップ
        if (windowInfo.style.display === 'none') {
          return;
        }
        
        // 窓情報のカウント番号（data-window-count属性の値）を取得
        const windowCount = windowInfo.getAttribute('data-window-count');
        
        // 窓情報ごとに必ず確認すべき必須フィールド
        const countField = windowInfo.querySelector(`[name^="count-${windowCount}"]`);
        const placeField = windowInfo.querySelector(`[name^="place-${windowCount}"]`);
        
        // 枚数フィールドの検証
        if (countField && (!countField.value || countField.value < 1)) {
          isValid = false;
          countField.style.borderColor = '#ff0000';
          this.addErrorMessage(countField);
          errors.push(countField);
        }
        
        // 場所フィールドの検証
        if (placeField && (!placeField.value || placeField.value === '-- 選択してください --')) {
          isValid = false;
          placeField.style.borderColor = '#ff0000';
          this.addErrorMessage(placeField);
          errors.push(placeField);
        }
        
        // その他の必須フィールドをチェック
        const requiredLabels = windowInfo.querySelectorAll('.form__label .form__required');
        
        requiredLabels.forEach(label => {
          const wrap = label.closest('.form__label').nextElementSibling;
          if (!wrap) return;
          
          const fields = wrap.querySelectorAll('input, select, textarea');
          
          fields.forEach(field => {
            // すでにチェック済みの枚数と場所フィールドはスキップ
            if (field === countField || field === placeField) {
              return;
            }
            
            // フィールドの値が空か、セレクトボックスでデフォルト値の場合
            if (!field.value || (field.tagName === 'SELECT' && field.value === '-- 選択してください --')) {
              isValid = false;
              field.style.borderColor = '#ff0000';
              
              // エラーメッセージを作成
              this.addErrorMessage(field);
              errors.push(field);
            }
          });
        });
      });
      
      // すべての必須フィールド（窓情報以外）をチェック
      document.querySelectorAll('.form__required:not(.is-sp)').forEach(requiredLabel => {
        // 窓情報内のラベルはスキップ（すでに上でチェック済み）
        if (requiredLabel.closest('.window-info')) {
          return;
        }
        
        const wrap = requiredLabel.closest('.form__label').nextElementSibling;
        if (!wrap) return;
        
        const fields = wrap.querySelectorAll('input, select, textarea');
        
        fields.forEach(field => {
          if (!field.value || (field.tagName === 'SELECT' && field.value === '-- 選択してください --')) {
            isValid = false;
            field.style.borderColor = '#ff0000';
            
            this.addErrorMessage(field);
            errors.push(field);
          }
        });
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
    
    // エラーメッセージを追加
    addErrorMessage(field) {
      // 既存のエラーメッセージを削除
      const existingError = field.parentNode.querySelector('.form__error-message');
      if (existingError) {
        existingError.remove();
      }
      
      // エラーメッセージの作成
      const errorMsg = document.createElement('span');
      errorMsg.className = 'form__error-message';
      errorMsg.style.color = '#ff0000';
      errorMsg.style.fontSize = '12px';
      errorMsg.style.display = 'block';
      errorMsg.style.marginTop = '5px';
      
      // フィールドタイプに応じてメッセージを設定
      if (field.name.startsWith('count-')) {
        errorMsg.textContent = '枚数を入力してください';
      } else if (field.name.startsWith('place-')) {
        errorMsg.textContent = '場所を選択してください';
      } else if (field.name === 'your-name-confirm') {
        errorMsg.textContent = 'お名前を入力してください';
      } else if (field.name === 'your-email-confirm') {
        errorMsg.textContent = 'メールアドレスを入力してください';
      } else if (field.name === 'tel-confirm') {
        errorMsg.textContent = '電話番号を入力してください';
      } else if (field.name === 'city-confirm') {
        errorMsg.textContent = '市区町村・番地を入力してください';
      } else if (field.name === 'building') {
        errorMsg.textContent = '建物名・部屋番号を入力してください';
      } else if (field.name === 'prefecture') {
        errorMsg.textContent = '都道府県を選択してください';
      } else if (field.name === 'house-type') {
        errorMsg.textContent = 'お住まいのタイプを選択してください';
      } else if (field.name === 'reform-place') {
        errorMsg.textContent = 'リフォームしたい箇所を選択してください';
      } else {
        errorMsg.textContent = 'このフィールドは必須です';
      }
      
      // エラーメッセージをフィールドの親要素に追加
      field.parentNode.appendChild(errorMsg);
    }
  }
  
  export function initForm() {
    const formHandler = new FormHandler();
  
    // 入力中にエラー表示をクリア
    document.addEventListener('input', function(e) {
      const field = e.target;
      if (field.closest('.wpcf7-form')) {
        field.style.borderColor = '';
        const errorMsg = field.parentNode.querySelector('.form__error-message');
        if (errorMsg) {
          errorMsg.remove();
        }
      }
    });
  
    const form = document.querySelector('.wpcf7-form');
    if (form) {
      form.addEventListener('submit', function(e) {
        const submitButton = e.submitter;
        
        // 「入力内容を確認」ボタンがクリックされた場合のみバリデーション
        if (submitButton && submitButton.value === '入力内容を確認') {
          // すべての表示中の窓情報のフィールドを処理
          document.querySelectorAll('.window-info').forEach(windowInfo => {
            // 非表示の窓情報はスキップ
            if (windowInfo.style.display === 'none') {
              return;
            }
            
            const windowCount = windowInfo.getAttribute('data-window-count');
            const countField = windowInfo.querySelector(`[name^="count-${windowCount}"]`);
            const placeField = windowInfo.querySelector(`[name^="place-${windowCount}"]`);
            
            // 枚数と場所フィールドに必須属性を追加
            if (countField) {
              countField.setAttribute('required', '');
              if (!countField.name.includes('*')) {
                countField.name = countField.name + '*';
              }
            }
            
            if (placeField) {
              placeField.setAttribute('required', '');
              if (!placeField.name.includes('*')) {
                placeField.name = placeField.name + '*';
              }
            }
          });
          
          // バリデーション実行
          if (!formHandler.validateForm()) {
            e.preventDefault();
            return false;
          }
        }
      });
    }
  
    // CF7のイベントを監視
    document.addEventListener('wpcf7invalid', function(event) {
      formHandler.validateForm();
      
      const responseOutput = document.querySelector('.wpcf7-response-output');
      if (responseOutput) {
        responseOutput.style.display = 'none';
      }
    });
  }