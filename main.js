function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

document.addEventListener("DOMContentLoaded", () => {
    const isSuccess = get('success');
    if (isSuccess === 'true') {
        document.querySelector('.form').classList.add('hidden')
        document.querySelector('.send').classList.remove('hidden')
    }
    
})