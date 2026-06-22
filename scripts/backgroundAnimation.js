const canvas=document.getElementById('particles');
const ctx=canvas.getContext('2d');
let W,H,pts=[];

function resize(){
  W=canvas.width=window.innerWidth;
  H=canvas.height=window.innerHeight;
}
resize();
window.addEventListener('resize',resize);


const COLORS=['rgba(245,196,0,','rgba(0,176,255,','rgba(0,230,118,','rgba(255,87,34,'];

function mkPt(){
  return{
    x:Math.random()*W,y:Math.random()*H,
    vx:(Math.random()-0.5)*0.35,vy:(Math.random()-0.5)*0.35,
    r:Math.random()*1.8+0.4,
    col:COLORS[Math.floor(Math.random()*COLORS.length)],
    a:Math.random()*0.55+0.15
  };
}

for(let i=0;i<90;i++)pts.push(mkPt());

function draw(){
  ctx.clearRect(0,0,W,H);
  for(let i=0;i<pts.length;i++){
    const p=pts[i];
    p.x+=p.vx;p.y+=p.vy;
    if(p.x<0||p.x>W)p.vx*=-1;
    if(p.y<0||p.y>H)p.vy*=-1;

    ctx.beginPath();
    ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
    ctx.fillStyle=p.col+p.a+')';
    ctx.fill();

    for(let j=i+1;j<pts.length;j++){
      const q=pts[j];
      const dx=p.x-q.x,dy=p.y-q.y;
      const d=Math.sqrt(dx*dx+dy*dy);
      if(d<120){
        ctx.beginPath();
        ctx.moveTo(p.x,p.y);ctx.lineTo(q.x,q.y);
        ctx.strokeStyle=p.col+(0.12*(1-d/120))+')';
        ctx.lineWidth=0.5;
        ctx.stroke();
      }
    }
  }
  requestAnimationFrame(draw);
}
draw();