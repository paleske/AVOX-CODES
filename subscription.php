async function chk(){
  let device = localStorage.getItem('deviceId') || 'DEV_'+Math.random().toString(36).substr(2,9);
  localStorage.setItem('deviceId', device);

  let fd = new FormData();
  fd.append('action','check_subscription');
  fd.append('device', device);
  
  let r = await fetch('subscription.php', {method:'POST', body:fd});
  let data = await r.json(); // HIZO BRACKETS MBILI ULAZIONA NI HII LINE!
  
  if(data.paid){
    document.getElementById('t').innerHTML = "✅ Paid";
    return 1;
  } else {
    if(data.days_left > 0){
      document.getElementById('t').innerHTML = "🎁 Siku "+data.days_left+" zimebaki";
      return 1;
    } else {
      document.getElementById('a').style.display='none';
      document.getElementById('lk').style.display='block';
      return 0;
    }
  }
}