const textarea = document.getElementsByTagName('textarea')[0];

textarea.addEventListener('keydown', resize);

function resize() {
  let el = this;
  setTimeout(function() {
    el.style.cssText = 'height:60; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  }, 1);
}
