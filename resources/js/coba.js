document.addEventListener('keydown', function (event) {
  if (event.key === 'f12' || (event.ctrlKey && event.shiftKey && event.key === 'I')) {
    event.preventDefault();
  }
});