export function initForm() {
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
    
    // フォーム送信時のバリデーション
    form.addEventListener('submit', function(event) {
      alert("")
      // 必須フィールドをチェック
      let firstErrorField = null;
      let hasError = false;
      
      // 全ての必須フィールドをチェック
      form.querySelectorAll('[required]').forEach(function(field) {
        // フィールドが空か、セレクトボックスの場合はデフォルト値のまま
        if (!field.value || (field.tagName === 'SELECT' && field.value === '' || field.value === '-- 選択してください --')) {
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
            requiredFields.forEach(function(field) {
              // blur時のイベントを設定（既に設定されているのでここでは追加設定不要）
            });
          }
        }, 100);
      });
    }
  });
  
  // エラーメッセージを表示する関数
  function addErrorMessage(field, message) {
    const errorMsg = document.createElement('div');
    errorMsg.className = 'form__error';
    errorMsg.textContent = message;
    errorMsg.style.color = '#ff0000';
    errorMsg.style.fontSize = '14px';
    errorMsg.style.marginTop = '5px';
    errorMsg.style.display = 'block';
    
    // エラーメッセージを入力フィールドの直後に配置
    field.insertAdjacentElement('afterend', errorMsg);
  }
  
  // エラーメッセージを探す関数
  function findErrorMessage(field) {
    // 次の要素がエラーメッセージかチェック
    let nextEl = field.nextElementSibling;
    if (nextEl && nextEl.classList.contains('form__error')) {
      return nextEl;
    }
    return null;
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
}