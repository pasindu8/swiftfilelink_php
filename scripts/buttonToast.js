document.getElementById('sendBtn').addEventListener('click',e=>{
  e.preventDefault();
  const t=document.getElementById('toast');
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2800);
});