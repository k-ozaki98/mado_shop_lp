const hmbBtn = document.querySelectorAll('.js-hmb-btn')
const menu = document.querySelectorAll('.menu-sp')
let isOpen = false

/**
 * メニューを開く処理を行います。
 */
const open = () => {
  hmbBtn.forEach(button => button.classList.add('active'))
  menu.forEach(item => item.classList.add('open'))
  document.body.classList.add('is-menu-open')
  document.body.style.overflowY = 'hidden'
  isOpen = true
}

/**
 * メニューを閉じる処理を行います。
 */
const close = () => {
  hmbBtn.forEach(button => button.classList.remove('active'))
  menu.forEach(item => item.classList.remove('open'))
  document.body.classList.remove('is-menu-open')
  document.body.style.overflowY = 'visible'
  isOpen = false
}

/**
 * メニュー内のリンクをクリックした際にメニューを閉じる処理を追加します。
 */
const closeMenuOnLinkClick = () => {
  menu.forEach(m => {
    const links = m.querySelectorAll('a'); // メニュー内のすべてのリンクを取得
    links.forEach(link => {
      link.addEventListener('click', () => {
        close(); // リンククリック時にメニューを閉じる
      });
    });
  })
}

/**
 * ハンバーガーメニューを初期化します。
 */
export const initHmbMenu = () => {
  if (!hmbBtn || !menu) return

  hmbBtn.forEach(button => {
    button.addEventListener('click', () => {
      if (isOpen) {
        close()
      } else {
        open()
      }
    })
  })

  // メニュー内リンクをクリックしたときにメニューを閉じる処理を追加
  closeMenuOnLinkClick()
}