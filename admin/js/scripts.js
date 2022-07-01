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

  $("#checkBoxSelectAll").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});
