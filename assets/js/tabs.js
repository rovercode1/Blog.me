
function tabTrigger(event, tab) {
  let listTab = document.getElementById('list-tab');
  let listContent =  document.getElementById('nav-tabContent');

  let tabs = listTab.children;
  let tabContent = listContent.children;

  let tabClass = 'list-group-item list-group-item-action';
  let contentClass = 'tab-pane fade';
	for(var i = 0; i < tabs.length;i++){
	tabs[i].className = tabClass;
	// console.log(tabs[i].className);
	}
	for(var i = 0; i < tabContent.length;i++){
	tabContent[i].className = contentClass;
	// console.log(tabContent[i].className);
	}
  var url_string = window.location.href;
  var url = new URL(url_string);
  var param = url.searchParams.get("tab");

  var clickedTab = 'list-'+ param +'-list';
  var clickedContent = 'list-'+param;
  // console.log(clickedTab)
  // console.log(clickedContent)

  let activeTab = document.getElementById(clickedTab)
  let activeContent= document.getElementById(clickedContent)

  activeTab.className = tabClass + ' active';
  activeContent.className = contentClass + ' show active';
  // console.log(activeContent);
}
