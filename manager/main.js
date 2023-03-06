function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

document.addEventListener("DOMContentLoaded", () => {
    const isPassword = get('password');
    if (isPassword === 'wrong') {
        document.querySelector('.password-error').classList.add('opacity-full')
    }
})