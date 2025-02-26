export class FormHandler {
    
    constructor() {
      this.visibleWindows = 1; // 表示中の窓情報数
      this.maxWindows = 5;     // 最大窓情報数
      this.init();
    }
  
    init() {
      // 窓情報の表示/非表示を初期設定
      // this.initWindowInfoDisplay();
      
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
  
  }
  
  export function initForm() {
    const formHandler = new FormHandler();
  
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