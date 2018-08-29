let body = document.getElementsByClassName('post_body');
let fbody = document.getElementsByClassName('featured_body');
let listTab = document.getElementById('list-tab');
let listContent =  document.getElementById('nav-tabContent');

let tabs = listTab.children;
let tabContent = listContent.children;

let tabClass = 'list-group-item list-group-item-action';
let contentClass = 'tab-pane fade';

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

tabTrigger();
function tabTrigger(event, tab) {
	for(var i = 0; i < tabs.length;i++){
	tabs[i].className = tabClass;
	console.log(tabs[i].className);
	}
	for(var i = 0; i < tabContent.length;i++){
	tabContent[i].className = contentClass;
	console.log(tabContent[i].className);
	}
}
var url_string = window.location.href;
var url = new URL(url_string);
var param = url.searchParams.get("tab");

var clickedTab = 'list-'+ param +'-list';
var clickedContent = 'list-'+param;
console.log(clickedTab)
console.log(clickedContent)

let activeTab = document.getElementById(clickedTab)
let activeContent= document.getElementById(clickedContent)

activeTab.className = tabClass + ' active';
activeContent.className = contentClass + ' show active';
console.log(activeContent);
