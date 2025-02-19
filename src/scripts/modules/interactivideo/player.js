import { Observer } from './utils'

/**
 * このクラスはビデオプレーヤーの制御を行うクラスです。
 */
export default class {
  player
  #fps
  #timeFrame
  #timeFrameArr = []
  #countFrame = 0
  #targetFrame = 0
  #currentFrame = -1

  #isVideoLoad = false
  #isSeeking = false
  #observer = new Observer()

  /**
   * VideoPlayerクラスのコンストラクタです。
   * @param {string} id - ビデオ要素のID名
   */
  constructor(id) {
    this.player = document.getElementById(id)
    this.#fps = Number(this.player.dataset.fps) || 15
    this.#timeFrame = Math.floor((1 / this.#fps) * 10000) / 10000

    this.#playerEvents()
  }

  /**
   * イベントリスナーを登録します。
   * @param {string} eventName - イベント名。現在は"playing"イベントのみをサポートしています。
   * @param {function} callback - コールバック関数
   */
  on(eventName, callback) {
    switch (eventName) {
      case 'playing':
        this.#observer.on(eventName, callback)
        break

      default:
        console.error(
          `This event name "${eventName}" can't be used. Supported event name is "playing".`
        )
        break
    }
  }

  /**
   * 動画データを読み込みます。
   */
  load() {
    let videoSrc = this.player.dataset.src || ''
    if (window.innerWidth < 768) {
      videoSrc = this.player.dataset.src_sp || this.player.dataset.src
    }
    const xhr = new XMLHttpRequest()
    xhr.open('GET', videoSrc, true)
    xhr.responseType = 'blob'
    xhr.onload = (e) => {
      if (e.currentTarget.status === 200) {
        const myBlob = e.currentTarget.response
        const vid = (window.webkitURL || window.URL).createObjectURL(myBlob)
        this.player.src = vid
      }
    }
    xhr.send()
  }

  /**
   * 進捗率（0～1に正規化された値）に基づいてプレーヤーを再生します。
   * @param {number} progress - 進捗率
   */
  playWithProgress(progress) {
    if (!this.#isVideoLoad) return
    this.#targetFrame = Math.floor(progress * this.#countFrame)
  }

  /**
   * 次のフレームを取得します。
   * @returns {number} - 次のフレームのインデックス
   */
  #getNextFrame() {
    let nextFrame = this.#targetFrame
    const diff = nextFrame - this.#currentFrame
    if (diff > 1) {
      if (diff > 10) {
        nextFrame = this.#currentFrame + 2
      } else {
        nextFrame = this.#currentFrame + 1
      }
    } else if (diff < -1) {
      if (diff < -10) {
        nextFrame = this.#currentFrame - 2
      } else {
        nextFrame = this.#currentFrame - 1
      }
    }
    return nextFrame
  }

  /**
   * タイムフレームの配列を取得します。
   * @returns {number[]} - タイムフレームの配列
   */
  #getTimeFrameArr() {
    const timeFrameArr = []
    for (let i = 0; i < this.#countFrame; i++) {
      timeFrameArr.push(this.#timeFrame * i)
    }
    return timeFrameArr
  }

  /**
   * プレーヤー関連のイベントリスナーを設定します。
   */
  #playerEvents() {
    this.player.addEventListener('seeking', () => {
      this.#isSeeking = true
    })
    this.player.addEventListener('seeked', () => {
      this.#isSeeking = false
    })
    this.player.addEventListener('loadedmetadata', () => {
      this.#isVideoLoad = true

      this.#countFrame = Math.floor(this.player.duration / this.#timeFrame)
      this.#timeFrameArr = this.#getTimeFrameArr(
        this.#timeFrame,
        this.#countFrame
      )

      this.#render()
    })
  }

  /**
   * プレーヤーのレンダリングを行います。
   */
  #render() {
    requestAnimationFrame(this.#render.bind(this))

    if (this.#isSeeking) return
    if (this.#currentFrame === this.#targetFrame) return

    const nextFrame = this.#getNextFrame()
    if (!this.#timeFrameArr[nextFrame]) return

    this.player.currentTime = this.#timeFrameArr[nextFrame]
    this.player.pause()
    this.#currentFrame = nextFrame

    this.#observer.trigger('playing', {
      player: this.player
    })
  }
}
