export class FormHandler {
    // FormHandlerクラスに追加
    validateForm() {
      let isValid = true;
      const errors = [];
    
      // 必須フィールドのチェック
      document.querySelectorAll('.form__input, .form__select, .form__textarea').forEach(field => {
        // 非表示の窓情報内のフィールドはスキップ
        if (field.closest('.window-info') && field.closest('.window-info').style.display === 'none') {
          return;
        }
        
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
    
      // 表示されている窓情報の必須フィールドをチェック
      document.querySelectorAll('.window-info').forEach(windowInfo => {
        // 非表示の窓情報はスキップ
        if (windowInfo.style.display === 'none') {
          return;
        }
        
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
  
    // 窓情報の表示/非表示の初期設定
    initWindowInfoDisplay() {
      // 2つ目以降の窓情報を非表示に
      const windowInfos = document.querySelectorAll('.window-info');
      windowInfos.forEach((info, index) => {
        if (index >= 1) { // 1番目以外を非表示
          info.style.display = 'none';
          
          // 非表示窓情報内の必須入力フィールドのrequired属性を一時的に削除
          const requiredFields = info.querySelectorAll('[required]');
          requiredFields.forEach(field => {
            field.removeAttribute('required');
            // 後で戻せるように印をつけておく
            field.dataset.wasRequired = 'true';
          });
        }
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
        nextWindow.style.display = 'block';
        
        // 表示された窓情報内のrequired属性を復活させる
        const markedFields = nextWindow.querySelectorAll('[data-was-required="true"]');
        markedFields.forEach(field => {
          field.setAttribute('required', '');
        });
      }
  
      // 最大数に達したらボタンを非表示
      if (this.visibleWindows >= this.maxWindows) {
        document.querySelector('.form__add-btn').style.display = 'none';
      }
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
        // 非表示の窓情報内のフィールドはスキップ
        if (field.closest('.window-info') && field.closest('.window-info').style.display === 'none') {
          return;
        }
        
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
    // フォーム送信をデバッグするコード
document.querySelector('.wpcf7-form').addEventListener('submit', function(e) {
    console.log('フォーム送信イベント:', e);
    console.log('送信ボタンの値:', e.submitter ? e.submitter.value : 'submitter not found');
    
    // フォームに含まれるフィールド一覧を出力
    const formData = new FormData(this);
    console.log('フォームデータ:');
    for (let [key, value] of formData.entries()) {
      console.log(`${key}: ${value}`);
    }
  });
  }