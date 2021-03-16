// Скрипт для показа превьюшки

let loadFile = (event) => {
    let reader = new FileReader();
    reader.onload = () => {
        let wrap = document.getElementsByClassName('form__file-wrap')[0];
        wrap.style.display = 'block';
        let output = document.getElementsByClassName('form__file-annotation')[0];
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

const file = document.getElementsByClassName("form__file")[0];

file.addEventListener('change', loadFile);
