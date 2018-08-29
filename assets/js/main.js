let body = document.getElementsByClassName('post_body');
let fbody = document.getElementsByClassName('featured_body');


for(var i = 0; i < body.length;i++){
	if(body[i].innerHTML.length > 170){
	body[i].innerHTML = body[i].innerHTML.substring(0, 170) + '...'
  }
}

for(var i = 0; i < fbody.length;i++){
	if(fbody[i].innerHTML.length > 570){
	fbody[i].innerHTML = fbody[i].innerHTML.substring(0, 570) + '...'
  }
}
