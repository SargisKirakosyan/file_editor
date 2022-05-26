$('.CodeMirror').attr('onkeydown', 'isKeyPressed(event)');

function copy(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Text successfully copied");
}
function isKeyPressed(event) {
    if (event.ctrlKey && event.keyCode === 83) {
        $('#save').click();
        event.preventDefault();
        return false;
    } else {
        return false;
       }
}
function printList() {
    window.print();
};