// form.js
export const initForm = () => {
  console.log('確認')
  const form = document.getElementById('contact-form');
  if (!form) return;
  console.log('リターン')

  // エラーメッセージを表示する関数
  const showError = (element, message) => {
    console.log('エラー表示')
    // 既存のエラーメッセージがあれば削除
    removeError(element);
    
    // エラーメッセージ要素を作成
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.color = '#d9534f';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    
    // 入力要素の親要素にエラーメッセージを挿入
    element.parentNode.appendChild(errorDiv);
    
    // 入力フィールドにエラースタイルを適用
    element.classList.add('error-input');
    element.style.borderColor = '#d9534f';
  };
  
  // エラーメッセージを削除する関数
  const removeError = (element) => {
    console.log('削除')
    const parent = element.parentNode;
    const errorDiv = parent.querySelector('.error-message');
    if (errorDiv) {
      errorDiv.remove();
    }
    element.classList.remove('error-input');
    element.style.borderColor = '';
  };
  
  // フォームのバリデーション
  const validateForm = () => {
    console.log('ばりで')
    let isValid = true;
    
    // 必須フィールドのチェック
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
      if (!field.value.trim()) {
        const fieldName = field.previousElementSibling ? 
                         field.previousElementSibling.textContent.trim() : 
                         field.name;
        showError(field, `${fieldName}を入力してください`);
        isValid = false;
      } else {
        removeError(field);
      }
    });
    
    // 窓の情報の特別なチェック
    const windowInfos = document.querySelectorAll('.window-info');
    windowInfos.forEach((windowInfo, index) => {
      const windowNumber = index + 1;
      
      // 枚数のチェック
      const countInput = windowInfo.querySelector(`input[name="count-${windowNumber}"]`);
      if (countInput && (!countInput.value.trim() || parseInt(countInput.value) < 1)) {
        showError(countInput, '窓の枚数を入力してください（1以上）');
        isValid = false;
      }
      
      // 場所のチェック
      const placeSelect = windowInfo.querySelector(`select[name="place-${windowNumber}"]`);
      if (placeSelect && !placeSelect.value) {
        showError(placeSelect, '窓の場所を選択してください');
        isValid = false;
      }
    });
    
    return isValid;
  };
  
  // フォーム送信時のバリデーション
  console.log("ugo")
  form.addEventListener('submit', (e) => {
    console.log('未入力')
    // バリデーション実行
    const isValid = validateForm();
    
    // バリデーションに失敗した場合は送信を中止
    if (!isValid) {
      e.preventDefault();
      
      // エラーメッセージをスクロールして表示
      const firstError = document.querySelector('.error-message');
      if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      
      // ユーザーに通知
      const formErrors = document.querySelector('.form-errors');
      if (!formErrors) {
        const errorNotice = document.createElement('div');
        errorNotice.className = 'form-errors';
        errorNotice.style.backgroundColor = '#f8d7da';
        errorNotice.style.color = '#721c24';
        errorNotice.style.padding = '15px';
        errorNotice.style.marginBottom = '20px';
        errorNotice.style.border = '1px solid #f5c6cb';
        errorNotice.style.borderRadius = '4px';
        
        const errorMessage = document.createElement('p');
        errorMessage.className = 'form-errors__message';
        errorMessage.style.margin = '0';
        errorMessage.style.fontWeight = 'bold';
        errorMessage.textContent = '入力内容に誤りがあります。修正してください。';
        
        errorNotice.appendChild(errorMessage);
        form.parentNode.insertBefore(errorNotice, form);
      }
    }
  });
  
  // 窓を追加するボタンのイベント設定
  const setupWindowButtons = () => {
    const addWindowButton = document.querySelector('.form__add-window');
    if (addWindowButton) {
      addWindowButton.addEventListener('click', () => {
        // 追加後のバリデーションフィールドの再設定などを行う場合はここに実装
      });
    }
    
    // ファイル選択ボタンの処理
    const setupFileButtons = () => {
      const fileButtons = document.querySelectorAll('.js-file-btn');
      fileButtons.forEach(button => {
        button.addEventListener('click', function() {
          const fileInput = this.parentNode.querySelector('.form__file');
          fileInput.click();
        });
      });
      
      const fileInputs = document.querySelectorAll('.form__file');
      fileInputs.forEach(input => {
        input.addEventListener('change', function() {
          const fileName = this.value.split('\\').pop();
          const fileNameDisplay = this.parentNode.querySelector('.window-info__file-name');
          if (fileNameDisplay) {
            fileNameDisplay.textContent = fileName || '';
          }
        });
      });
    };
    
    // ファイル選択ボタンのイベント設定
    setupFileButtons();
  };
  
  // 初期設定
  setupWindowButtons();

  // 入力フィールドの変更時にエラーを消去
  form.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('input', () => {
      removeError(field);
    });
    
    field.addEventListener('change', () => {
      removeError(field);
    });
  });
};