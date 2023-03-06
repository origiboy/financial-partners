document.addEventListener('DOMContentLoaded', () => {
    
    document.querySelectorAll('.item__button').forEach(element => element.addEventListener('click', (e) => {
        document.querySelector('.popup-wrapper').classList.add('popup-wrapper_open')
        document.querySelector('.popup__id').value = e.target.dataset.id
        console.log(document.querySelector('.popup__id').value)
    }))
    document.querySelector('.popup-wrapper-for-click').addEventListener('click', (e) => {
        document.querySelector('.popup-wrapper').classList.remove('popup-wrapper_open')
    })
})

