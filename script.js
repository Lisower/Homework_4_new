const Button = document.getElementById('Button');
const Popup = document.getElementById('Popup');
const Form = document.getElementById('Form');

Button.addEventListener('click', () => {
    Popup.style.display = 'block';
});

window.addEventListener('popstate', () => {
    Popup.style.display = 'none';
});
