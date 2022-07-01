tinymce.intit({ selector: "textarea" });

$(document).ready(function () {
  //EDITOR CKEDITOR
  ClassicEditor.create(document.querySelector("#body"))
    .then((editor) => {
      console.log(editor);
    })
    .catch((error) => {
      console.error(error);
    });

  //REST OF THE CODE
});
