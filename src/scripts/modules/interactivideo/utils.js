/**
 * 指定されたIDとデータ配列からデータを検索します。
 *
 * @param {string} id - 検索するID
 * @param {Array} data - データ配列
 * @returns {any} - 検索されたデータ
 */
export const findData = (id = '', data = []) => {
  const d = data.find((element) => element.id === id)
  return d
}

/**
 * FPSをミリ秒単位に変換します。
 *
 * @param {number} fps - FPS値
 * @returns {number} - ミリ秒単位の値
 */
export const fpsToMs = (fps) => {
  const ms = 1e3 / fps
  return ms
}

/**
 * 指定された値を最小値と最大値の範囲で正規化します。
 *
 * @param {number} value - 正規化する値
 * @param {number} minValue - 最小値
 * @param {number} maxValue - 最大値
 * @returns {number} - 正規化された値
 */
export const normalize = (value, minValue, maxValue) => {
  if (minValue === maxValue) {
    return 0
  }
  return (value - minValue) / (maxValue - minValue)
}

/**
 * 指定された数字を指定された桁数になるようにゼロパディングします。
 *
 * @param {number} number - ゼロパディングする数字
 * @param {number} length - 桁数
 * @returns {string} - ゼロパディングされた文字列
 */
export const zeroPadding = (number, length) => {
  let str = String(number)

  if (str.length >= length) {
    return str
  } else {
    const diff = length - str.length
    for (let i = 0; i < diff; i++) {
      str = '0' + str
    }
    return str
  }
}

/**
 * イベントを監視するObserverクラスです。
 */
export class Observer {
  constructor() {
    this.listeners = {}
  }

  /**
   * イベントに対してコールバック関数を登録します。
   *
   * @param {string} event - イベント名
   * @param {Function} func - コールバック関数
   */
  on(event, func) {
    if (!this.listeners[event]) {
      this.listeners[event] = []
    }
    this.listeners[event].push(func)
  }

  /**
   * イベントの監視を解除します。
   *
   * @param {string} event - イベント名
   * @param {Function} func - コールバック関数
   */
  off(event, func) {
    if (!this.listeners[event]) {
      this.listeners[event] = []
    }
    this.listeners[event].push(func)
  }

  /**
   * 登録されたイベントのコールバック関数を呼び出します。
   *
   * @param {string} event - イベント名
   * @param {object} args - 引数オブジェ
   */
  trigger(event, args) {
    if (!this.listeners[event]) {
      return
    }
    const ref = this.listeners[event]
    for (let i = 0, len = ref.length; i < len; i++) {
      const listener = ref[i]
      if (typeof listener === 'function') listener(args)
    }
  }
}

/**
 * Semaphoreクラスは、指定されたオプションに基づいてセマフォの制御を行います。
 */
export class Semaphore {
  constructor(options = {}) {
    this.MAX_ROOMS = options.max || 10
    this.rooms = []
    this.waitingList = []
  }

  /**
   * ルームに入室します。
   *
   * @returns {Promise<void>} - 入室が許可されるまで待機するPromise
   */
  enter() {
    const promise = new Promise((resolve) => {
      this.waitingList.push(resolve)
    })
    this.tryNext()
    return promise
  }

  /**
   * ルームから退室します。
   *
   * @param {Symbol} room - 退室するルームの識別子
   */
  release(room) {
    this.rooms = this.rooms.filter((r) => r !== room)
    this.tryNext()
  }

  /**
   * 次の入室リクエストを処理します。
   */
  tryNext() {
    if (this.rooms.length >= this.MAX_ROOMS) return
    const next = this.waitingList.shift()
    if (!next) return

    const room = Symbol('')
    this.rooms.push(room)

    next(() => {
      this.release(room)
    })
  }
}
