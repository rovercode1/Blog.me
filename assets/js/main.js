let body = document.getElementsByClassName('post_body');

for(var i = 0; i < body.length;i++){
	if(body[i].innerHTML.length > 170){
	body[i].innerHTML = body[i].innerHTML.substring(0, 170) + '...'
  }
}
