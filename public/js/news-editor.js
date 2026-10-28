
const labelFile = document.getElementById("label-file");
const inputFile = document.getElementById("input-file");
const imgView = document.getElementById("img-view");

inputFile.addEventListener("change", uploadImage)

function uploadImage(){
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imgView.style.backgroundImage = `url(${imgLink})`;
    imgView.textContent = "";
    imgView.classList.remove("border-dashed", "border-primary");
}

tinymce.init({
    selector: '#content',
    language: 'pt-BR',
    height: 600,
    menubar: false,
    branding: false,
    promotion: false,
    plugins: [
        'autolink',
        'lists',
        'link',
        'table',
        'code',
        'wordcount'
    ],
    toolbar: [
        'undo redo | blocks | bold italic underline',
        'alignleft aligncenter alignright | bullist numlist',
        'blockquote | link table | removeformat code'
    ].join(' | '),
    block_formats: 'Parágrafo=p; Subtítulo=h2; Seção=h3; Citação=blockquote',
    content_style: `
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.7;
            max-width: 900px;
            margin: 20px auto;
        }
        h2, h3 {
            line-height: 1.3;
        }
        blockquote {
            border-left: 4px solid #6f42c1;
            padding-left: 16px;
            color: #555;
        }
    `,
    browser_spellcheck: true,
    statusbar: true,
    resize: true
});
