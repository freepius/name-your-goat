/**
 * Return a random integer between min and max (both included).
 *
 * @param {number} min
 * @param {number} max
 */
function getRandomInt (min, max) {
  min = Math.ceil(min)
  max = Math.floor(max)
  return Math.floor(Math.random() * (max - min + 1)) + min
}

/**
 * Apply a random rotation to each 'goat card'.
 */
document.querySelectorAll('.goat-card').forEach((e) => {
  e.style.transform = 'rotate(' + getRandomInt(-20, 20) + 'deg)'
  e.style.zIndex = getRandomInt(0, 10)
})

/************************************************
 * Modal component
 ***********************************************/

/**
 * Close the .modal currently open.
 */
function closeModal () {
  const modal = document.querySelector('.modal:target')
  const close = modal.querySelector('nav > a[rel="parent"]')

  if (modal) {
    window.location = close ? close.href : '#'
  }
}

/**
 * Go to the previous .modal (if exists).
 */
function previousModal () {
  const prev = document.querySelector('.modal:target > nav > a[rel="prev"]')

  if (prev) {
    window.location = prev.href
  }
}

/**
 * Go to the next .modal (if exists).
 */
function nextModal () {
  const next = document.querySelector('.modal:target > nav > a[rel="next"]')

  if (next) {
    window.location = next.href
  }
}

/**
 * Events manager
 */
document.addEventListener('keyup', (e) => {
  switch (e.key) {
    case 'Escape':
      closeModal()
      break

    case 'ArrowLeft':
      previousModal()
      break

    case 'ArrowRight':
      nextModal()
      break
  }
}, false)
