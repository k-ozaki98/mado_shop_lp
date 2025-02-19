
/**
 * ページの先頭までスクロールします。
 */
const scrollToTop = () => {
  const scrollOptions = {
    top: 0,
    behavior: 'smooth'
  }
  window.scrollTo(scrollOptions)
}

/**
 * ページトップボタンを初期化します。
 * 
 * @param {string} pagetopId - ページトップボタンのID。
 * @param {number} pagetopInTrigger - ページトップボタンが表示されるスクロール位置の閾値。
 */
export const initPageTop = (pagetopId = 'js-pagetop', pagetopInTrigger) => {
  const pagetop = document.getElementById(pagetopId)

  /**
   * ページトップボタンがクリックされたときにページの先頭までスクロールします。
   * @param {Event} event - クリックイベントオブジェクト。
   */
  pagetop.addEventListener('click', (event) => {
    event.preventDefault()
    scrollToTop()
  })

  /**
   * ウィンドウのスクロールイベントを監視し、スクロール位置に応じてページトップボタンの表示状態を切り替えます。
   */
  window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop
    const isDown = scrollTop > pagetopInTrigger

    if (isDown) {
      pagetop.classList.add('active')
    } else {
      pagetop.classList.remove('active')
    }
  })
}