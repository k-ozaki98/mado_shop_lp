import { normalize, zeroPadding, Semaphore } from './utils'
import observer from './canvas-player-observer'

export default class {
  id
  imgDir
  imgExt
  imgCount
  fps
  rate

  frameData = []
  #semaphore = new Semaphore()

  constructor(options = {}) {
    this.id = options.id
    this.imgDir = options.imgDir
    this.imgExt = options.imgExt
    this.imgCount = options.imgCount
    this.fps = options.fps
    this.rate = normalize(1, 0, this.imgCount) * 100

    this.#load()
  }

  #load() {
    for (let i = 0; i < this.imgCount; i++) {
      this.#loadImg(i)
    }
  }

  async #loadImg(i) {
    const release = await this.#semaphore.enter()

    const id = zeroPadding(i, 4)
    const imgPath = this.imgDir + id + '.' + this.imgExt
    const frame = {
      id,
      img: new Image(),
      complete: false
    }
    frame.img.src = imgPath
    frame.img.onload = () => {
      frame.complete = true
      observer.trigger('loading', {
        name: this.id,
        loadProgress: this.#getLoadProgress()
      })
      release()
    }
    this.frameData.push(frame)
  }

  #getLoadProgress() {
    let count = 0
    this.frameData.forEach((data) => {
      if (data.complete) {
        count++
      }
    })
    return normalize(count, 0, this.imgCount)
  }
}
