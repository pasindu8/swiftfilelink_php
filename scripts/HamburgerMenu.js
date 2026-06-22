const ham=document.getElementById('ham');
const drawer=document.getElementById('drawer');
ham.addEventListener('click',()=>{
  ham.classList.toggle('open');
  drawer.classList.toggle('open');
});
drawer.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{
  ham.classList.remove('open');
  drawer.classList.remove('open');
}));