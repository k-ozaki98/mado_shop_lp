const hmbBtn = document.querySelector('.js-hmb-btn')
const menu = document.querySelector('.menu-sp')
let isOpen = false

/**
 * メニューを開く処理を行います。
 */
const open = () => {
  hmbBtn.classList.add('active')
  menu.classList.add('open')
  document.body.classList.add('is-menu-open')
  document.body.style.overflow = 'hidden'
  isOpen = true
}

/**
 * メニューを閉じる処理を行います。
 */
const close = () => {
  hmbBtn.classList.remove('active')
  menu.classList.remove('open')
  document.body.classList.remove('is-menu-open')
  document.body.style.overflow = 'visible'
  isOpen = false
}

/**
 * ハンバーガーメニューを初期化します。
 */
export const initHmbMenu = () => {
  if (!hmbBtn) return

  hmbBtn.addEventListener('click', () => {
    if (isOpen) {
      close()
    } else {
      open()
    }
  })
}
